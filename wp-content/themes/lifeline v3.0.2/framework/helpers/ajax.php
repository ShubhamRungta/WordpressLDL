<?php

class SH_Ajax
{
	
	function __construct()
	{
		add_action( 'wp_ajax_dictate_ajax_callback', array( $this, 'ajax_handler' ) );
		add_action( 'wp_ajax_nopriv_dictate_ajax_callback', array( $this, 'ajax_handler' ) );
	}
	
	function ajax_handler()
	{
		$method = sh_set( $_REQUEST, 'subaction' );

		if( method_exists( $this, $method ) ) $this->$method();
		
		exit;
	}
	
	function sh_contact_form_submit()
	{
		if( !count( $_POST ) ) return;
		
		_load_class( 'validation', 'helpers', true );
		$t = &$GLOBALS['_sh_base'];
		$settings = get_option(SH_NAME);
	
		$t->validation->set_rules('contact_name','<strong>'.__('Name', SH_NAME).'</strong>', 'required|min_length[4]|max_lenth[30]');
		$t->validation->set_rules('contact_email','<strong>'.__('Email', SH_NAME).'</strong>', 'required|valid_email');
		$t->validation->set_rules('contact_message','<strong>'.__('Message', SH_NAME).'</strong>', 'required|min_length[5]');
		if( sh_set($settings, 'captcha_status') == 'true')
		{
			include_once( get_template_directory(). '/framework/modules/recaptchalib.php');
			$privatekey = sh_set( $settings, 'captcha_secret_key' );
			$resp = recaptcha_check_answer ( $privatekey,
                                        $_SERVER["REMOTE_ADDR"],
                                		$_POST["recaptcha_challenge_field"],
                                		$_POST["recaptcha_response_field"]);

			
			if( !$resp->is_valid )
			{
				$t->validation->_error_array['captcha'] = __('Invalid captcha entered, please try again.', SH_NAME);
			}
		}
		
		$messages = '';
		
		if($t->validation->run() !== FALSE && empty($t->validation->_error_array))
		{
			
			$name = $t->validation->post('contact_name');
			$email = $t->validation->post('contact_email');
			$message = $t->validation->post('contact_message');
			$contact_to = ( sh_set($settings, 'contact_email') ) ? sh_set($settings, 'contact_email') : get_option('admin_email');
			
			$headers = 'From: '.$name.' <'.$email.'>' . "\r\n";
			wp_mail($contact_to, __('Contact Us Message', SH_NAME), $message, $headers);
			
			$message = sh_set($settings, 'success_message') ? $settings['success_message'] : sprintf( __('Thank you <strong>%s</strong> for using our contact form! Your email was successfully sent and we will be in touch with you soon.',SH_NAME), $name);
	
			$messages = '<div class="alert alert-success">
							<p class="title">'.__('SUCCESS! ', SH_NAME).$message.'</p>
						</div>';
								
		}else
		{
			 if( is_array( $t->validation->_error_array ) )
			 {
				 foreach( $t->validation->_error_array as $msg )
				 {
					 $messages .= '<div class="alert alert-error">
										<p class="title">'.__('Error! ', SH_NAME).$msg.'</p>
									</div>';
				 }
			 }
		}
		echo $messages;exit;
		//return $messages;
	}
	
	function sh_message_form_submit()
	{
		if( !count( $_POST ) ) return;
		
		_load_class( 'validation', 'helpers', true );
		$t = &$GLOBALS['_sh_base'];
		$settings = get_option(SH_NAME);
	
		$t->validation->set_rules('contact_name','<strong>'.__('Name', SH_NAME).'</strong>', 'required|min_length[4]|max_lenth[30]');
		$t->validation->set_rules('contact_email','<strong>'.__('Email', SH_NAME).'</strong>', 'required|valid_email');
		$t->validation->set_rules('contact_message','<strong>'.__('Message', SH_NAME).'</strong>', 'required|min_length[5]');
		
		$messages = '';
		
		if($t->validation->run() !== FALSE && empty($t->validation->_error_array))
		{
			
			$name = $t->validation->post('contact_name');
			$email = $t->validation->post('contact_email');
			$message = $t->validation->post('contact_message');
			$contact_to = ( sh_set($settings, 'contact_email') ) ? sh_set($settings, 'contact_email') : get_option('admin_email');
			
			$headers = 'From: '.$name.' <'.$email.'>' . "\r\n";
			wp_mail($contact_to, __('Contact Us Message', SH_NAME), $message, $headers);
			
			$message = sh_set($settings, 'success_message') ? $settings['success_message'] : sprintf( __('Thank you <strong>%s</strong> for using our contact form! Your email was successfully sent and we will be in touch with you soon.',SH_NAME), $name);
	
			$messages = '<div class="alert alert-success">
							<p class="title">'.__('SUCCESS! ', SH_NAME).$message.'</p>
						</div>';
								
		}else
		{
			 if( is_array( $t->validation->_error_array ) )
			 {
				 foreach( $t->validation->_error_array as $msg )
				 {
					 $messages .= '<div class="alert alert-error">
										<p class="title">'.__('Error! ', SH_NAME).$msg.'</p>
									</div>';
				 }
			 }
		}
		echo $messages;exit;
		//return $messages;
	}
	
}