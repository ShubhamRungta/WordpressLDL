<?php ob_start(); ?>
<div class="shop">
	<ul id="" class="slides">
		<?php while( $query->have_posts() ): $query->the_post(); 
			global $product;?>
			
			<?php if( ($query->current_post % 2 ) == 0 ) :?>
			<li>
				<div class="row">
			<?php endif; ?>
			
					<?php $Price = ( $price_html = $product->get_price_html() ) ? '<span>' . str_replace( array( '<del>', '</del>', '<ins>', '</ins>' ), array( '<i>', '</i>', '', '' ), $price_html ) . '</span>': ''; ?>
					<div class="col-md-6">
						<div class="item">
							<?php the_post_thumbnail( '570x291' ); ?>
							<div class="item-detail">
								<h3><a href="<?php the_permalink();?>"><?php echo sh_character_limit( 20, get_the_title(get_the_id()) ); ?></a></h3>
								<?php echo $Price; ?> <?php woocommerce_template_loop_add_to_cart(); ?> </div>
						</div>
					</div>
			
			<?php if( ( ($query->current_post+1) % 2 ) == 0 || $query->current_post + 1 == $query->post_count ):?>
				</div>
			</li>
			<?php endif; ?>
			
		<?php endwhile; ?>
	</ul>
</div>
<script>
jQuery(document).ready(function($){
	if( $(".shop").length > 0 ){
		$('.shop').flexslider({
			animation: "slide",
			animationLoop: false,
			controlNav: false,	
			maxItems: 1,
			pausePlay: false,
			mousewheel:false,	
			start: function(slider){
			  $('body').removeClass('loading');
			}
		});
	}
});
</script> 

<?php $output = ob_get_contents();
ob_end_clean();

