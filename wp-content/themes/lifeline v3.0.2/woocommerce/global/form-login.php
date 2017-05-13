<?php
/**
 * Login form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.1.0
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
if ( is_user_logged_in() ) 
	return;
?>
<form method="post" class="login" <?php if ( $hidden ) echo 'style="display:none;"'; ?>>
	<?php do_action( 'woocommerce_login_form_start' ); ?>
	<?php if ( $message ) echo wpautop( wptexturize( $message ) ); ?>
	<div class="row">
    	<div class="col-md-6 co-form half-field">
        <p class="form-row form-row-first">
            <label for="username"><?php _e( 'Username or email', SH_NAME ); ?> <span class="required">*</span></label>
            <input type="text" class="input-text" name="username" id="username" />
        </p>
        </div>
        <div class="col-md-6 co-form half-field">
        <p class="form-row form-row-last">
            <label for="password"><?php _e( 'Password', SH_NAME ); ?> <span class="required">*</span></label>
            <input class="input-text" type="password" name="password" id="password" />
        </p>
        </div>
        <div class="clear"></div>
    
        <?php do_action( 'woocommerce_login_form' ); ?>
    	
        <div class="col-md-12 co-form half-field">
        	<label for="rememberme" class="inline">
                <input name="rememberme" type="checkbox" id="rememberme" value="forever" /> <?php _e( 'Remember me', SH_NAME ); ?>
            </label>
        </div>
        
        <div class="col-md-12 co-form half-field">
            <p class="form-row">
                <?php wp_nonce_field( 'woocommerce-login' ); ?>
                <input type="submit" class="cart-btn pull-left" name="login" value="<?php _e( 'Login', SH_NAME ); ?>" />
                <input type="hidden" name="redirect" value="<?php echo esc_url( $redirect ) ?>" />                
            </p>
        </div>
        <div class="col-md-6 co-form half-field">
            <p class="lost_password">
                <a href="<?php echo esc_url( wc_lostpassword_url() ); ?>"><?php _e( 'Lost your password?', SH_NAME ); ?></a>
            </p>
    	</div>
        <div class="clear"></div>
    
        <?php do_action( 'woocommerce_login_form_end' ); ?>
	</div>
</form>