<?php
/**
 * Thankyou page
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.2.0
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
?><div class="container"><?php
global $woocommerce;
if ( $order ) : ?>
	<?php if ( in_array( $order->status, array( 'failed' ) ) ) : ?>
		<p><?php _e( 'Unfortunately your order cannot be processed as the originating bank/merchant has declined your transaction.', SH_NAME ); ?></p>
		<p><?php
			if ( is_user_logged_in() )
				_e( 'Please attempt your purchase again or go to your account page.', SH_NAME );
			else
				_e( 'Please attempt your purchase again.', SH_NAME );
		?></p>
		<p>
			<a href="<?php echo esc_url( $order->get_checkout_payment_url() ); ?>" class="button pay"><?php _e( 'Pay', SH_NAME ) ?></a>
			<?php if ( is_user_logged_in() ) : ?>
			<a href="<?php echo esc_url( get_permalink( wc_get_page_id( 'myaccount' ) ) ); ?>" class="button pay"><?php _e( 'My Account', SH_NAME ); ?></a>
			<?php endif; ?>
		</p>
	<?php else : ?>
		<p><?php _e( 'Thank you. Your order has been received.', SH_NAME ); ?></p>
		<ul class="order_details">
			<li class="order">
				<?php _e( 'Order:', SH_NAME ); ?>
				<strong><?php echo $order->get_order_number(); ?></strong>
			</li>
			<li class="date">
				<?php _e( 'Date:', SH_NAME ); ?>
				<strong><?php echo date_i18n( get_option( 'date_format' ), strtotime( $order->order_date ) ); ?></strong>
			</li>
			<li class="total">
				<?php _e( 'Total:', SH_NAME ); ?>
				<strong><?php echo $order->get_formatted_order_total(); ?></strong>
			</li>
			<?php if ( $order->payment_method_title ) : ?>
			<li class="method">
				<?php _e( 'Payment method:', SH_NAME ); ?>
				<strong><?php echo $order->payment_method_title; ?></strong>
			</li>
			<?php endif; ?>
		</ul>
		<div class="clear"></div>
	<?php endif; ?>
	<?php do_action( 'woocommerce_thankyou_' . $order->payment_method, $order->id ); ?>
	<?php do_action( 'woocommerce_thankyou', $order->id ); ?>
<?php else : ?>
	<p><?php _e( 'Thank you. Your order has been received.', SH_NAME ); ?></p>
<?php endif; ?>
</div>