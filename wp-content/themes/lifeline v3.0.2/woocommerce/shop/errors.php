<?php
/**
 * Show error messages
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
if ( ! $errors ) return;
?>
<ul class="woocommerce-error">
	<?php foreach ( $errors as $error ) : ?>
		<li>
            <div class="alert-box attention">
                <i class="icon-exclamation-sign"></i>
                <h4><?php echo wp_kses_post( $error ); ?></h4>
            </div>
        </li>
	<?php endforeach; ?>
</ul>
