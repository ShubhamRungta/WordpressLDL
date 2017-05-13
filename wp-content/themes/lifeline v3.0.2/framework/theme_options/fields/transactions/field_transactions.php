<?php
class SH_Options_transactions extends SH_Options{	
	
	/**
	 * Field Constructor.
	 *
	 * Required - must call the parent constructor, then assign field and value to vars, and obviously call the render field function
	 *
	 * @since SH_Options 1.0
	*/
	function __construct($field = array(), $value ='', $parent){
		
		parent::__construct($parent->sections, $parent->args, $parent->extra_tabs);
		$this->field = $field;
		$this->value = $value;
		//$this->render();
		
	}//function
	
	
	
	/**
	 * Field Render Function.
	 *
	 * Takes the vars and outputs the HTML for the field in the settings
	 *
	 * @since SH_Options 1.0
	*/
	function render(){
		
		$class = (isset($this->field['class']))?$this->field['class']:'large-text';
		
		$placeholder = (isset($this->field['placeholder']))?' placeholder="'.esc_attr($this->field['placeholder']).'" ':'';
		
		/*echo '<textarea id="'.$this->field['id'].'" name="'.$this->args['opt_name'].'['.$this->field['id'].']" '.$placeholder.'class="'.$class.'" rows="6" >'.stripslashes(esc_attr($this->value)).'</textarea>';*/
		
		//echo "This is transactions reord page";
		global $post_type, $post;
		$user_ID = get_current_user_id();
		if($post_type == 'dict_causes' || $post_type == 'dict_project'){
			$transaction_array = get_post_meta($post->ID, 'single_causes_donation', true);
		}else{
			$transaction_array = get_option('general_donation');
		}
		
		if(!empty($transaction_array)){
		
		echo '<div id="donation_transactions">';
		echo '<div id="pdf" style="top:0 !important"><img src="'.get_stylesheet_directory_uri().'/images/status.gif" /></div>';
		echo '<div id="accordion">';
		foreach($transaction_array as $trasaction):
			echo '<h2>'.__('Payer ID:').''.sh_set($trasaction, 'ship_to_name').' '.sh_set($trasaction, 'payer_id').'<a data-id="'.sh_set($trasaction, 'transaction_id').'" id="admin_donwload_pdf">'.__( 'PDF', SH_NAME ).'</a></h2>
					<div class="content">
					  <ul>
						<li>
						  <table width="100%">
							<tr>
							  <td width="50%">'.__('Transacction ID').'</td>
							  <td>'.sh_set($trasaction, 'transaction_id').'</td>
							</tr>
						  </table>
						</li>
						<li>
						  <table width="100%">
							<tr>
							  <td width="50%">'.__('Transacction Type').'</td>
							  <td>'.sh_set($trasaction, 'transaction_type').'</td>
							</tr>
						  </table>
						</li>
						<li>
						  <table width="100%">
							<tr>
							  <td width="50%">'.__('Payment Type').'</td>
							  <td>'.sh_set($trasaction, 'payment_type').'</td>
							</tr>
						  </table>
						</li>
						<li>
						  <table width="100%">
							<tr>
							  <td width="50%">'.__('Order Time').'</td>
							  <td>'.sh_set($trasaction, 'order_time').'</td>
							</tr>
						  </table>
						</li>
						<li>
						  <table width="100%">
							<tr>
							  <td width="50%">'.__('Amount').'</td>
							  <td>'.sh_set($trasaction, 'amount').'</td>
							</tr>
						  </table>
						</li>
						<li>
						  <table width="100%">
							<tr>
							  <td width="50%">'.__('Currency Code').'</td>
							  <td>'.sh_set($trasaction, 'currency_code').'</td>
							</tr>
						  </table>
						</li>
						<li>
						  <table width="100%">
							<tr>
							  <td width="50%">'.__('Fee Amount').'</td>
							  <td>'.sh_set($trasaction, 'fee_amount').'</td>
							</tr>
						  </table>
						</li>
						<li>
						  <table width="100%">
							<tr>
							  <td width="50%">'.__('Settle Amount').'</td>
							  <td>'.sh_set($trasaction, 'settle_amount').'</td>
							</tr>
						  </table>
						</li>
						<li>
						  <table width="100%">
							<tr>
							  <td width="50%">'.__('Tax Amount').'</td>
							  <td>'.sh_set($trasaction, 'tax_amount').'</td>
							</tr>
						  </table>
						</li>
						<li>
						  <table width="100%">
							<tr>
							  <td width="50%">'.__('Exchange Rate').'</td>
							  <td>'.sh_set($trasaction, 'exchange_rate').'</td>
							</tr>
						  </table>
						</li>
						<li>
						  <table width="100%">
							<tr>
							  <td width="50%">'.__('Payment Status').'</td>
							  <td>'.sh_set($trasaction, 'payment_status').'</td>
							</tr>
						  </table>
						</li>
						<li>
						  <table width="100%">
							<tr>
							  <td width="50%">'.__('Pending Reason').'</td>
							  <td>'.sh_set($trasaction, 'pending_reason').'</td>
							</tr>
						  </table>
						</li>
						<li>
						  <table width="100%">
							<tr>
							  <td width="50%">'.__('Reason Code').'</td>
							  <td>'.sh_set($trasaction, 'reason_code').'</td>
							</tr>
						  </table>
						</li>
						<li>
						  <table width="100%">
							<tr>
							  <td width="50%">'.__('Donation Type').'</td>
							  <td>'.sh_set($trasaction, 'donation_type').'</td>
							</tr>
						  </table>
						</li>
					  </ul>
					</div>';
		endforeach;
		echo '</div></div>';
		echo '<script type="text/ecmascript">
				jQuery(document).ready(function($) {
					$(function() {
						$("#accordion .content").hide();
						$("#accordion h2:first").addClass("active").next().slideDown("slow");
						$("#accordion h2").click(function() {
							if($(this).next().is(":hidden")) {
								$("#accordion h2").removeClass("active").next().slideUp("slow");
								$(this).toggleClass("active").next().slideDown("slow");
							}
						});
					});
					
				jQuery("a#admin_donwload_pdf").on("click",function(){
				jQuery("div#pdf").show();
				var action = "admin_donwload_pdf";
				var data_id = jQuery(this).data("id"); 
				var ajaxdata = {	 
					action	: action,
					data_id: data_id,
				};
			 
				jQuery.post( ajaxurl, ajaxdata, function(res){ 
					jQuery("div#pdf").hide();
					window.location.href = "'.SH_URL.'/'.$user_ID.'_filename.pdf'.'";
				});
				return false;
			});
				});
			</script>';
			if( file_exists(SH_ROOT.'/'.$user_ID.'_filename.pdf') )
			{ 
				unlink(SH_ROOT.'/'.$user_ID.'_filename.pdf');
			}
			
		}else{
			echo __('There is no transaction', SH_NAME);
		}
		//echo (isset($this->field['desc']) && !empty($this->field['desc']))?'<br/><span class="description">'.$this->field['desc'].'</span>':'';
		
	}//function
	
	/**
	 * Enqueue Function.
	 *
	 * If this field requires any scripts, or css define this function and register/enqueue the scripts/css
	 *
	 * @since SH_Options 1.0
	*/
	function enqueue(){

		wp_enqueue_script(array('jquery', 'jquery-ui-accordion'));

		
	}//function
	
}//class
?>