<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * Override this template by copying it to yourtheme/woocommerce/content-single-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product;
?>

<?php
	/**
	 * woocommerce_before_single_product hook
	 *
	 * @hooked woocommerce_show_messages - 10
	 */
	 do_action( 'woocommerce_before_single_product' );
?>


<?php
	/**
	 * woocommerce_show_product_images hook
	 *
	 * @hooked woocommerce_show_product_sale_flash - 10
	 * @hooked woocommerce_show_product_images - 20
	 */
	//do_action( 'woocommerce_before_single_product_summary' );
?>



	<div class="post">
    	
        <div class="single-product-page">
        
        	<div class="row">
            
            	<div class="col-md-5">
                	<?php woocommerce_get_template( 'single-product/sale-flash.php' ); ?>
                	<?php the_post_thumbnail('270x200'); ?>
                </div>
                
                <div class="col-md-7">
                	<h1><?php the_title(); ?></h1>
                    <ul class="post-meta">
                        <li><?php the_date(); ?></li>
                        
                        <li><?php woocommerce_get_template( 'single-product/meta.php' ); ?></li>
                        
                        <li><?php echo $product->get_price_html(); ?></li>
                        
                    </ul>

                    <div class="row">
                        <div class="post-desc">
                            <?php the_excerpt(); ?>
                        </div>
                    </div>
                    
                    <div class="row">
                    	<?php do_action( 'woocommerce_' . $product->product_type . '_add_to_cart'  ); ?>
                    </div>
                    
                </div>
                
			</div>
            
		</div>
        
        
        <div class="post-desc">
        	<?php woocommerce_get_template( 'single-product/share.php' ); ?>
            
            <?php //woocommerce_get_template( 'single-product/sale-flash.php' ); ?>
        </div>
 		
        <?php
			/**
			 * woocommerce_after_single_product_summary hook
			 *
			 * @hooked woocommerce_output_product_data_tabs - 10
			 * @hooked woocommerce_output_related_products - 20
			 */
			do_action( 'woocommerce_after_single_product_summary' );
		?>
               
	</div>

	<?php
        /**
         * woocommerce_single_product_summary hook
         *
         * @hooked woocommerce_template_single_title - 5
         * @hooked woocommerce_template_single_price - 10
         * @hooked woocommerce_template_single_excerpt - 20
         * @hooked woocommerce_template_single_add_to_cart - 30
         * @hooked woocommerce_template_single_meta - 40
         * @hooked woocommerce_template_single_sharing - 50
         */
        //do_action( 'woocommerce_single_product_summary' );
    ?>



<?php do_action( 'woocommerce_after_single_product' ); ?>