<?php 
/* Template Name: Our Mission */
sh_custom_header(); 
$settings  = get_post_meta(get_the_ID(), '_page_settings', true);
$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
$cat = sh_set( $settings, 'tpl_post_type' );
$sidebar = sh_set( $settings, 'sidebar') ? sh_set( $settings, 'sidebar' ) : '';
$sidebar_position = ( sh_set( $settings , 'sidebar_pos' ) == 'left' ) ? '' : '' ;
$col_class = ( $sidebar ) ? 'col-md-9' : 'col-md-12' ;
if( sh_set( $settings, 'sidebar') == '' )
{
	$inner_col = 'col-md-4';
}else
{
	$inner_col = 'col-md-6';
}

?>

<div class="top-image"> <img src="<?php echo sh_set($settings , 'top_image'); ?>" alt="" /> </div>
<section class="inner-page <?php echo $sidebar_position ;?>">
  <div class="container">
    <div class="page-title"> <?php echo sh_get_title( get_the_title(), 'h1', 'span', FALSE );?> </div>
    <!-- Page Title -->
     <?php if( $sidebar && sh_set( $settings , 'sidebar_pos' ) == 'left' ): ?>
      <div class="sidebar col-md-3">
        <?php dynamic_sidebar( $sidebar ); ?>
      </div>
      <?php endif; ?>
    <div class="<?php echo $col_class; ?>">
      <div class="remove-ext">
        <div class="row" >
                <?php // $Posts = query_posts( 'post_type=dict_causes&paged='.$paged);
				  $args = array('post_type'=> 'post' , 'cat' => (int)$cat, 'paged' => $paged );
				  $the_query = new WP_Query( $args );
				  ?>
                <?php if( $the_query-> have_posts() ): while( $the_query->have_posts() ): $the_query->the_post();?>
                <div class="<?php echo $inner_col; ?>">
                  <div class="single-mission">
						<div class="mission-img">
							<a href="<?php the_permalink()?>" title="<?php the_title()?>"><?php echo get_the_post_thumbnail( get_the_ID(), '470x318' );?></a>
						</div>
						<h3><a href="<?php the_permalink()?>" title="<?php the_title()?>">Countries with the most billionair</a></h3>
						<p><?php echo substr( get_the_content(), 0, 115 );?></p>
					</div>
                </div>
                <?php endwhile; endif; wp_reset_query();?>
        </div>
        <?php _the_pagination( array(  'total' => $the_query->max_num_pages, ) );?>
      </div>
    </div>
     <?php if( $sidebar && sh_set( $settings , 'sidebar_pos' ) == 'right' ): ?>
      <div class="sidebar col-md-3">
        <?php dynamic_sidebar( $sidebar ); ?>
      </div>
      <?php endif; ?>
  </div>
</section>
<?php get_footer();?>
