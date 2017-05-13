<?php
/**
 * Customer processing order email
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates/Emails/Plain
 * @version     2.2.0
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
echo $email_heading . "\n\n";
echo __( "Your order has been received and is now being processed. Your order details are shown below for your reference:", SH_NAME ) . "\n\n";
echo "****************************************************\n\n";
do_action( 'woocommerce_email_before_order_table', $order, $sent_to_admin, $plain_text );
echo sprintf( __( 'Order number: %s', SH_NAME), $order->get_order_number() ) . "\n";
echo sprintf( __( 'Order date: %s', SH_NAME), date_i18n( wc_date_format(), strtotime( $order->order_date ) ) ) . "\n";
do_action( 'woocommerce_email_order_meta', $order, $sent_to_admin, $plain_text );
echo "\n" . $order->email_order_items_table( $order->is_download_permitted(), true, ($order->status=='processing') ? true : false, '', '', true );
echo "----------\n\n";
if ( $totals = $order->get_order_item_totals() ) {
	foreach ( $totals as $total ) {
		echo $total['label'] . "\t " . $total['value'] . "\n";
	}
}
echo "\n****************************************************\n\n";
do_action( 'woocommerce_email_after_order_table', $order, $sent_to_admin, $plain_text );
echo __( 'Your details', SH_NAME ) . "\n\n";
if ( $order->billing_email )
	echo __( 'Email:', SH_NAME ); echo $order->billing_email . "\n";
if ( $order->billing_phone )
	echo __( 'Tel:', SH_NAME ); ?> <?php echo $order->billing_phone . "\n";
wc_get_template( 'emails/plain/email-addresses.php', array( 'order' => $order ) );
echo "\n****************************************************\n\n";
echo apply_filters( 'woocommerce_email_footer_text', get_option( 'woocommerce_email_footer_text' ) );