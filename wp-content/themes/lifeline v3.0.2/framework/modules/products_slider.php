<?php
$t = &$GLOBALS['_sh_base'];

$default = array('post_type' => 'wpsc-product');
$arg = wp_parse_args( sh_set($args, 'args'), $default );
//if( sh_set(sh_set( $args, 'args'), 'taxonomy') ) printr( $args );
$query = new WP_Query( $arg );//printr($query);

if( $query->have_posts() ) : ?>


<ul class="<?php echo sh_set($args, 'ul_class', 'slides'); ?>">
	
    <?php $count = 1; ?>
	<?php while( $query->have_posts() ): $query->the_post();?>
    
        <?php if( sh_set( $args, 'lis' ) ): ?><li class="<?php echo sh_set($args, 'span'); ?>">
		<?php elseif( $count == 1 ): ?><li><?php endif; ?>
        
        <?php if( !sh_set( $args, 'lis' ) ): ?>
        <div class="<?php echo sh_set($args, 'span', 'span4'); ?>">
        <?php endif; ?>
        
            <div class="wdt-product">
                <div class="wdt-products-wrapper">
                    <div class="wdt-product active show">
                        <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                        	<?php echo sh_get_product_thumbnail( wpsc_the_product_id(), sh_set( $args, 'image_size', 'product-slider') );?>
                        </a>
                        
                        <h4><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h4>

                        <div data-score="<?php echo sh_get_rating(get_the_ID());?>" class="starrating" data-id="<?php echo get_the_ID(); ?>"></div>
                        
                        <div class="wdt-pricing">
                        	
                        	<span class="amount"><?php wpsc_the_product_price_display( array( 'price_text'=>'%s', 'output_old_price' => false, 'output_you_save'  => false, ) ); ?></span>
                        </div>
                        <div class="wdt-cart">
                            <div class="wdt-cart-bar">
                                <?php if(wpsc_product_has_stock() && $t->alloption('hide_addtocart_button') == 0 &&  $t->alloption('addtocart_or_buynow') !='1') : ?>
                                    <form class="product_form"  enctype="multipart/form-data" action="<?php echo wpsc_this_page_url(); ?>" method="post" name="product_<?php echo wpsc_the_product_id(); ?>" id="product_<?php echo wpsc_the_product_id(); ?>" >
                                        <input type="hidden" value="add_to_cart" name="wpsc_ajax_action"/>
                                        <input type="hidden" value="<?php echo wpsc_the_product_id(); ?>" name="product_id"/>
                                        <button type="submit" name="Buy" class="wpsc_buy_button" id="product_<?php echo wpsc_the_product_id(); ?>_submit_button"><i class="icon-shopping-cart"></i><?php _e('Add To Cart', SH_NAME); ?></button>
                                        <div class="wpsc_loading_animation">
                                            <img title="" alt="<?php esc_attr_e( 'Loading', 'wpsc' ); ?>" src="<?php echo wpsc_loading_animation_url(); ?>" />
                                        </div><!--close wpsc_loading_animation-->
                                    </form>
                                <?php else: ?>
                                	<a href="<?php the_permalink(); ?>" title="<?php _e('Buy Now', SH_NAME); ?>"><?php _e('Buy Now', SH_NAME);?></a>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="wdt-overlay">
                            <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><span class="amount"><?php wpsc_the_product_price_display( array( 'price_text'=>'%s', 'output_old_price' => false, 'output_you_save'  => false, ) ); ?></span></a>
                            
                        </div>
                    </div>
                </div>
            </div>
        
        <?php if( !sh_set( $args, 'lis' ) ): ?>
        </div>
        <?php endif; ?>
        
		
		<?php $count++; ?>
		<?php if( sh_set( $args, 'lis' ) ): ?></li>
		<?php elseif( $count == 4 ): ?></li><?php $count = 1; ?><?php endif; ?>
    <?php endwhile;?>

</ul>
<?php endif; ?>
<?php wp_reset_query();?>
