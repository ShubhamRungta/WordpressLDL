<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive.
 *
 * Override this template by copying it to yourtheme/woocommerce/archive-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates woocommerce_shop_page_id
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

sh_custom_header();

$Settings = get_option( SH_NAME );
$page_id = woocommerce_get_page_id( 'shop' );
$PageSettings  = get_post_meta(get_the_ID(), '_page_settings', true);
$Sidebar = sh_set( $PageSettings, 'sidebar' );
$IsWide = ( sh_set( $Settings, 'blog_layout' ) == 'wide' && empty( $Sidebar ) ) ? TRUE: FALSE;
$IsLeftSidebarLayout = ( sh_set( $Settings, 'blog_layout' ) == 'leftsidebar' ) ? TRUE: FALSE;
?>

<?php if( sh_set($PageSettings , 'top_image') ): ?>
	<div class="top-image"> <img src="<?php echo sh_set($settings , 'top_image'); ?>" alt="" /></div>
<?php endif; ?>
<?php if( sh_woo_pages( $page_id ) == 'true') : ?>
	<div class="no-top-image"></div>
<?php endif;  ?>
<section class="inner-page<?php echo ( $IsLeftSidebarLayout ) ? 'switch': '';?>">

	<div class="container">
    
    	<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
    
            <div class="page-title">
                  <h1><?php woocommerce_page_title(); ?></h1>
            </div>

        <?php endif; ?>
        
        <div class="row">

			<?php if( $Sidebar ) echo '<div class="left-content nine-column">';?>
    
            <?php
                /**
                 * woocommerce_before_main_content hook
                 *
                 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
                 * @hooked woocommerce_breadcrumb - 20
                 */
                do_action('woocommerce_before_main_content');
            ?>
        
                <?php do_action( 'woocommerce_archive_description' ); ?>
        
                <?php if ( have_posts() ) : ?>
        
                    <?php
                        /**
                         * woocommerce_before_shop_loop hook
                         *
                         * @hooked woocommerce_result_count - 20
                         * @hooked woocommerce_catalog_ordering - 30
                         */
                        do_action( 'woocommerce_before_shop_loop' );
                    ?>
        
                    <?php //woocommerce_product_loop_start(); ?>
        			<div class="featured-products">
                    <div class="row">
                        <?php woocommerce_product_subcategories(); ?>
        
                        <?php while ( have_posts() ) : the_post(); ?>
        
                            <?php woocommerce_get_template_part( 'content', 'product' ); ?>
        
                        <?php endwhile; // end of the loop. ?>
        			</div>
                    </div>
                    <?php //woocommerce_product_loop_end(); ?>
        
                    <?php
                        /**
                         * woocommerce_after_shop_loop hook
                         *
                         * @hooked woocommerce_pagination - 10
                         */
                        do_action( 'woocommerce_after_shop_loop' );
                    ?>
        
                <?php elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>
        
                    <?php woocommerce_get_template( 'loop/no-products-found.php' ); ?>
        
                <?php endif; ?>
        
            <?php
                /**
                 * woocommerce_after_main_content hook
                 *
                 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
                 */
                do_action('woocommerce_after_main_content');
            ?>
            
            <?php if( $Sidebar ) echo '</div>';?>
            
            <?php if( $IsWide === FALSE && is_active_sidebar( $Sidebar ) ):?>
            
                <div class="sidebar three-column pull-right"><?php dynamic_sidebar( $Sidebar ); ?></div>
                
            <?php endif;?>

        </div>
    
    </div>
    
</section>

<?php get_footer('shop'); ?>