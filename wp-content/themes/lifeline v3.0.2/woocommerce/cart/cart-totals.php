<?php
/**
 * Cart totals
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.1.0
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
?>
<div class="cart-total cart-table <?php if ( WC()->customer->has_calculated_shipping() ) echo 'calculated_shipping'; ?>">
	<?php do_action( 'woocommerce_before_cart_totals' ); ?>
	
    <div class="cart-head">
	<h2><?php _e( 'Cart Totals', SH_NAME ); ?></h2>
    </div>
	<ul>
		<li class="cart-subtotal">
			<p><?php _e( 'Cart Subtotal', SH_NAME ); ?></p>
			<spn><?php wc_cart_totals_subtotal_html(); ?></span>
		</li>
		<?php foreach ( WC()->cart->get_coupons( 'cart' ) as $code => $coupon ) : ?>
			<li class="cart-discount coupon-<?php echo esc_attr( $code ); ?>">
				<p><?php wc_cart_totals_coupon_label( $coupon ); ?></p>
				<span><?php wc_cart_totals_coupon_html( $coupon ); ?></span>
			</li>
		<?php endforeach; ?>
		<?php if ( WC()->cart->needs_shipping() && WC()->cart->show_shipping() ) : ?>
			<?php do_action( 'woocommerce_cart_totals_before_shipping' ); ?>
			<?php wc_cart_totals_shipping_html(); ?>
			<?php do_action( 'woocommerce_cart_totals_after_shipping' ); ?>
		<?php endif; ?>
		<?php foreach ( WC()->cart->get_fees() as $fee ) : ?>
			<li class="fee">
				<p><?php echo esc_html( $fee->name ); ?></p>
				<span><?php wc_cart_totals_fee_html( $fee ); ?></span>
			</li>
		<?php endforeach; ?>
		<?php if ( WC()->cart->tax_display_cart == 'excl' ) : ?>
			<?php if ( get_option( 'woocommerce_tax_total_display' ) == 'itemized' ) : ?>
				<?php foreach ( WC()->cart->get_tax_totals() as $code => $tax ) : ?>
					<li class="tax-rate tax-rate-<?php echo sanitize_title( $code ); ?>">
						<p><?php echo esc_html( $tax->label ); ?></p>
						<span><?php echo wp_kses_post( $tax->formatted_amount ); ?></span>
					</li>
				<?php endforeach; ?>
			<?php else : ?>
				<li class="tax-total">
					<p><?php echo esc_html( WC()->countries->tax_or_vat() ); ?></p>
					<span><?php echo wc_price( WC()->cart->get_taxes_total() ); ?></span>
				</li>
			<?php endif; ?>
		<?php endif; ?>
		<?php foreach ( WC()->cart->get_coupons( 'order' ) as $code => $coupon ) : ?>
			<li class="order-discount coupon-<?php echo esc_attr( $code ); ?>">
				<p><?php wc_cart_totals_coupon_label( $coupon ); ?></p>
				<span><?php wc_cart_totals_coupon_html( $coupon ); ?></span>
			</li>
		<?php endforeach; ?>
		<?php do_action( 'woocommerce_cart_totals_before_order_total' ); ?>
		<li class="order-total">
			<p><?php _e( 'Order Total', SH_NAME ); ?></p>
			<span><?php wc_cart_totals_order_total_html(); ?></span>
		</li>
		<?php do_action( 'woocommerce_cart_totals_after_order_total' ); ?>
	</ul>
	<?php if ( WC()->cart->get_cart_tax() ) : ?>
		<p><small><?php
			$estimated_text = WC()->customer->is_customer_outside_base() && ! WC()->customer->has_calculated_shipping()
				? sprintf( ' ' . __( ' (taxes estimated for %s)', SH_NAME ), WC()->countries->estimated_for_prefix() . __( WC()->countries->countries[ WC()->countries->get_base_country() ], SH_NAME ) )
				: '';
			printf( __( 'Note: Shipping and taxes are estimated%s and will be updated during checkout based on your billing and shipping information.', SH_NAME ), $estimated_text );
		?></small></p>
	<?php endif; ?>
	<?php do_action( 'woocommerce_after_cart_totals' ); ?>
</div>