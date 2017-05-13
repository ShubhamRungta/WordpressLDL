<?php
/**
 * The template for displaying product content within loops.
 *
 * Override this template by copying it to yourtheme/woocommerce/content-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product, $woocommerce_loop;

// Store loop count we're currently on
if ( empty( $woocommerce_loop['loop'] ) )
	$woocommerce_loop['loop'] = 0;

// Store column count for displaying the grid
if ( empty( $woocommerce_loop['columns'] ) )
	$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 4 );

// Ensure visibility
if ( ! $product->is_visible() )
	return;

// Increase loop count
$woocommerce_loop['loop']++;

// Extra post classes
$classes = array();
if ( 0 == ( $woocommerce_loop['loop'] - 1 ) % $woocommerce_loop['columns'] || 1 == $woocommerce_loop['columns'] )
	$classes[] = 'first';
if ( 0 == $woocommerce_loop['loop'] % $woocommerce_loop['columns'] )
	$classes[] = 'last';
$classes[] = 'col-md-4';
?>
<div  class="col-md-4">

	<?php do_action( 'woocommerce_before_shop_loop_item' ); ?>


		<?php
			/**
			 * woocommerce_before_shop_loop_item_title hook
			 *
			 * @hooked woocommerce_show_product_loop_sale_flash - 10
			 * @hooked woocommerce_template_loop_product_thumbnail - 10
			 */
			//do_action( 'woocommerce_before_shop_loop_item_title' );
			woocommerce_get_template( 'loop/sale-flash.php' );
			the_post_thumbnail('270x200');
		?>

		<h4><a href="<?php echo get_permalink();?>"><?php the_title(); ?></a></h4>
    	
        <div class="ratings clearfix">
			<?php woocommerce_get_template( 'loop/rating.php' ); ?>    
        </div>
		<?php
            /**
             * woocommerce_after_shop_loop_item_title hook
             *
             * @hooked woocommerce_template_loop_price - 10
             */
            //do_action( 'woocommerce_after_shop_loop_item_title' );
        ?>
        
        <div class="product-price clearfix">
        
        	<?php if ( $price_html = $product->get_price_html() ) : ?>
				<?php echo $price_html;?>
            <?php endif; ?>
    
            <?php do_action( 'woocommerce_after_shop_loop_item' ); ?>
            
        </div>
        
    <!--</a>-->

</div>