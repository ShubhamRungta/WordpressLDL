<?php 

class SH_Donation
{
	var $_settings;
	var $_paypal;
	var $_paypal_settings;
	
	function __construct()
	{
		require_once(get_template_directory().'/framework/modules/libpaypal.php');
		$this->_settings = get_option(SH_NAME);
		
		//Create the authentication
		$pp_type = (sh_set($this->_settings, 'paypal_type') == 'sandbox') ? true : false;
		$auth = new PaypalAuthenticaton(sh_set($this->_settings, 'paypal_username'), sh_set($this->_settings, 'paypal_api_username'), sh_set($this->_settings, 'paypal_api_password'), sh_set($this->_settings, 'paypal_api_signature'), $pp_type);
		
		//Create the paypal object
		$this->_paypal = new Paypal($auth);
		$this->_paypal_settings = new PaypalSettings();
		$this->_paypal_settings->allowMerchantNote = true;
		$this->_paypal_settings->logNotifications = true;
		
		//the base url
		$this->return_url =  'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
	}
	
	/**
	 * This method is used to return button output or echo output
	 *
	 * @param	$settings	array	array of settings.
	 * return	null
	 */
	function button( $settings = array() )
	{

		$action = $this->_paypal->getButtonAction(); //get button action
		
		/** merge settings */
		
		$this->args = $settings;
		$default = array('currency_code'=>'USD', 'cmd'=>'_donations', 'item_name'=>__('Donation', SH_NAME), 'label'=>__('DONATE NOW', SH_NAME), 'amount'=>10, );
		$this->args = wp_parse_args( $this->args, $default );
		
		/** get donation button params */
		$products = array();
		$params = $this->_paypal->getButtonParams($products, $this->action('paid'), $this->action('cancel'), $this->action('notify')); //get params for the form
		
		/*unset($params['currency_code']);
		unset($params['amount']);*/
		//printr($this->args);
		$params['currency_code'] = sh_set( $this->args, 'currency_code'  );
		$params['cmd'] = '_donations';
		$params['amount'] = sh_set( $this->args, 'amount'  );
		$params['item_name'] = sh_set( $this->args, 'item_name'  );
		
		//if ( is_user_logged_in() ) {
			/** Create donation button */
			$output = '<form action="'.$action.'" method="post">';
			
			foreach($params as $key => $value){
				$output .= '<input type="hidden" name="'.$key.'" value="'.$value.'"/>';
			}
			$donation_data = get_option(SH_NAME);
			if(sh_set($donation_data , 'donate_method') == 'true'){		   
				$output .= '<input type="text" name="amount" id="textfield" value="" placeholder="'.__('ENTER YOUR AMOUNT PLEASE', SH_NAME).'">';
			}
			
			$output .= '<button type="submit" class="'. sh_set($this->args, 'btn_class', 'donate-btn' ).'">'. sh_set($this->args, 'label', __('DONATE NOW', SH_NAME) ).'</button>';
			$output .= '</form>';
		//}else{
			//$output = '<a href="'.wp_login_url( get_permalink() ).'" title="'.__( 'Login', SH_NAME ).'">'.__( 'Login', SH_NAME ).'</a>';
		//}
		
		if( sh_set( $this->args, 'echo' ) ) echo $output;
		else return $output;
	}

	
	/**
	 * This method is used to return button output or echo output
	 *
	 * @param	$settings	array	array of settings.
	 * return	null
	 */
	function recuring_payment( $settings = array() )
	{
		$this->args = $settings;
		$donation_data = get_option(SH_NAME);
		
		if(isset($_SESSION['causes_page']) && sh_set($_SESSION, 'causes_page') == true){
			$currency_code = sh_set($_SESSION, 'sh_currency_code');
			$currency_symbol = sh_set($_SESSION, 'sh_currency_symbol');
			$sh_donation_collected = sh_set($_SESSION, 'sh_donation_collected');
		}else{
			$currency_code = sh_set($donation_data, 'paypal_currency_code');
			$currency_symbol = sh_set($donation_data, 'paypal_currency');
			$sh_donation_collected = sh_set($donation_data, 'paypal_raised');
		}
		$output = '';
				$output .=  '<form method="post" action="">
					<input type="hidden" value="Lifeline" name="item_name">
					<input type="hidden" value="'.$currency_code.'" name="currency_code">
					<input type="hidden" value="'.$sh_donation_collected.'" name="raised_amount">
					<input type="hidden" value="'.$currency_symbol.'" name="currency_symbol">
					<input id="billing-period" type="hidden" value="" name="billing_period">
					<input id="billing-frequency" type="hidden" value="" name="billing_frequency">
					<input type="text" placeholder="ENTER YOUR AMOUNT PLEASE" value="" id="textfield" name="amount">';
					if(isset($_SESSION['causes_page']) && sh_set($_SESSION, 'causes_page') == true){
						$output .='<input type="hidden" value="'.sh_set($_SESSION, 'causes_id').'" name="couses_id">';
					}
					$output .='<button class="donate-btn" type="submit" name="recurring_pp_submit">'.__('DONATE NOW', SH_NAME).'</button>
				</form>';

		if( sh_set( $this->args, 'echo' ) ) echo $output;
		else return $output;
	}
	
	function single_pament_result($responce = array())
	{
		
		if(isset($responce->ok)){
			
			
		
			
		$theme_options = get_option(SH_NAME);
		
		$single_page = (sh_set($_SESSION, 'sh_causes_page')) ? sh_set($_SESSION, 'sh_causes_page') : false;
		
		if($single_page == true){
			$PostSettings = get_post_meta( sh_set($_SESSION, 'sh_causes_id'), '_dict_'.$_SESSION['sh_post_type'].'_settings', true); 
			if(sh_set($_SESSION, 'sh_post_type') == 'causes'){
				$target_amount = (sh_set($PostSettings, 'donation_collected')) ? (int)str_replace(',', '', sh_set($PostSettings, 'donation_collected'))+$responce->amount : '';
				if($target_amount > 0){
					$PostSettings['donation_collected'] = $target_amount;
				}
			}elseif(sh_set($_SESSION, 'sh_post_type') == 'project'){
				$target_amount = (sh_set($PostSettings, 'spent_amount')) ? (int)str_replace(',', '', sh_set($PostSettings, 'spent_amount'))+$responce->amount : '';
				if($target_amount > 0){
					$PostSettings['spent_amount'] = $target_amount;
				}
			}
			update_post_meta(sh_set($_SESSION, 'sh_causes_id'), '_dict_'.$_SESSION['sh_post_type'].'_settings', $PostSettings);
			
			$donation_transaction = array();
			$donation_transaction =(get_post_meta(sh_set($_SESSION, 'sh_causes_id'), 'single_causes_donation', true)) ? 			get_post_meta(sh_set($_SESSION, 'sh_causes_id'), 'single_causes_donation', true) : array();
			
			array_push($donation_transaction, array(
										'transaction_id' => $responce->transactionId,
										'transaction_type' => $responce->transactionType,
										'payment_type' => $responce->type,
										'order_time' => date('c', $responce->date),
										'amount' => $responce->amount,
										'currency_code' => $responce->currency,
										'fee_amount' => $responce->fee,
										'settle_amount' => $responce->currencyCorrect,
										'payment_status' => $responce->status,
										'pending_reason' => $responce->pendingReason,
										'payer_id' => $responce->buyer->id,
										'ship_to_name' => $responce->buyer->firstName.' '.$responce->buyer->lastName,
										'donation_type' => 'Single',
										 
									));
			
			update_post_meta(sh_set($_SESSION, 'sh_causes_id'), 'single_causes_donation', $donation_transaction);
		}
		else{
			

			$target_amount = (sh_set($theme_options, 'paypal_raised')) ? (int)str_replace(',', '', sh_set($theme_options , 'paypal_raised'))+sh_set($responce, 'amount') : '';
			if($target_amount > 0){
				$theme_options['paypal_raised'] = $target_amount;
			}
			update_option(SH_NAME, $theme_options);
			$donation_transaction = array();
			$donation_transaction =(get_option('general_donation')) ? get_option('general_donation') : array();
	
			
			array_push($donation_transaction, array(
										'transaction_id' => $responce->transactionId,
										'transaction_type' => $responce->transactionType,
										'payment_type' => $responce->type,
										'order_time' => date('c', $responce->date),
										'amount' => $responce->amount,
										'currency_code' => $responce->currency,
										'fee_amount' => $responce->fee,
										'settle_amount' => $responce->currencyCorrect,
										'payment_status' => $responce->status,
										'pending_reason' => $responce->pendingReason,
										'payer_id' => $responce->buyer->id,
										'ship_to_name' => $responce->buyer->firstName.' '.$responce->buyer->lastName,
										'donation_type' => 'Single',
										 
									));
			update_option('general_donation', $donation_transaction);
		}
		

		$user_data_old =(get_option('trasaction_user_data')) ? get_option('trasaction_user_data') : array();
		$user_data = array($responce->buyer->id => array(
														'fistname' => $responce->buyer->firstName,
														'lastName' => $responce->buyer->lastName,
														'email' => $responce->buyer->email,
														'business' => $responce->buyer->business,
														'phone' => $responce->buyer->phone,
														'status' => $responce->buyer->status,
														'addressCountry' => $responce->buyer->addressCountry,
														'addressCountryCode' => $responce->buyer->addressCountryCode,
														'addressZip' => $responce->buyer->addressZip,
														'addressState' => $responce->buyer->addressState,
														'addressCity' => $responce->buyer->addressCity,
														'addressStreet' => $responce->buyer->addressStreet,
														'addressName' => $responce->buyer->addressName,
														'addressStatus' => $responce->buyer->addressStatus,
													)
					);
		$user_data_new = array_merge($user_data_old, $user_data);
		update_option('trasaction_user_data', $user_data_new);
		
		return "Thank you for your payment.";
		}
	}
	
	/** create button return url with action */
	function action( $action )
	{
		$single_page = (sh_set($_SESSION, 'sh_causes_page')) ? sh_set($_SESSION, 'sh_causes_page') : false;
		
		if($single_page == true){
			$return = ( sh_set( $this->args, 'return' ) ) ? sh_set( $this->args, 'return' ) : $this->return_url;
		}else{
			$return = ( sh_set( $this->args, 'return' ) ) ? sh_set( $this->args, 'return' ).'/' : $this->return_url;
		}

		return add_query_arg( array( 'action'=>$action ), $return );
	}

	/**
	 * This function is used to save transaction into database.
	 * @param	$data	array	array of data transaction response from paypal.
	 * return	null
	 */
	function result( $data = array() )
	{
		global $wpdb;
		
		if( !$_POST ) return;
		 
		$data = !( $data ) ? $this->_paypal->handleNotification() : $data;
		
		if( !$data ) return;
		
		$array = array('transID'=>$data->transactionId, 'status'=>$data->status, 'total'=>$data->total, 'donalID'=>$data->buyer->id, 
						'donalName'=>$data->buyer->firstName.' ' .$data->buyer->lastName, 'donalEmail'=>$data->buyer->email, 'note'=>$data->products[0]->name,
						'data'=>serialize($data), 'date'=>date('Y-m-d H:i:s', $data->date )
						);
						
		if($transID = $wpdb->get_row("SELECT `transID` FROM `".$wpdb->prefix."donation` WHERE `transID` = '".$data->transactionId."'")){
			_e('<p class="errormsg donationmsg">The transaction is already in our record.</p>', SH_NAME);
		}
		elseif($data->status == 'Completed') {
			$result = $wpdb->insert('fw_donation', $array);
			if($result) echo '<p class="successmsg donationmsg">'.__('Thank you for your donation.',SH_NAME).'</p>';
		}
		else{
			$result = $wpdb->insert('fw_donation', $array);
			echo '<p class="errormsg donationmsg">'.__('Sorry! unfortunetly the transaction is failed.',SH_NAME).'</p>';
		}
	}
	
}