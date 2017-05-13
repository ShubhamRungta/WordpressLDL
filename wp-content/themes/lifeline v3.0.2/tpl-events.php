<?php 
/* Template Name: Events */

sh_custom_header();
$Settings = get_option(SH_NAME) ;
$PageSettings  = get_post_meta(get_the_ID(), '_page_settings', true);
$paged = get_query_var('paged');
$sidebar = sh_set( $PageSettings, 'sidebar') ? sh_set( $PageSettings, 'sidebar' ) : '';
$sidebar_position = (sh_set($PageSettings , 'sidebar_pos') == 'left')? 'switch' : '' ;
$col_class = ($sidebar) ? 'col-md-9' : 'col-md-12' ;
?>
<div class="top-image"><img src="<?php echo sh_set($PageSettings , 'top_image'); ?>" alt="" /> </div>
<!-- Page Top Image -->

<section class="inner-page <?php echo $sidebar_position ; ?>">

    <div class="container">
    
      <div class="page-title">
      
		  <?php echo sh_get_title( get_the_title(), 'h1', 'span', FALSE );?>
        
      </div>
      <!-- Page Title -->
      <div class="row" >
      <div class="left-content <?php echo $col_class; ?>">

          <?php $query = new WP_Query( 'post_type=dict_event&paged='.$paged ); ?>
          <div class="remove-space">
		  <?php while( $query->have_posts() ): $query->the_post(); ?>
          
          <?php $EventSettings = get_post_meta( get_the_ID(), '_dict_event_settings', true );?>
          
          <div class="row">
          
          	  <?php if( has_post_thumbnail() ): ?>
                    <div class="col-md-5">
                         <div class="event-post-image"> 
                                  
                                          <?php the_post_thumbnail('370x252'); ?> <img class="map" src="<?php echo get_template_directory_uri();?>/images/map.jpg" alt="" /> 
                                          
                                          <i class="icon-map-marker"></i> 
                                          
                                          <a href="<?php echo the_permalink();?>" title=""><span></span></a> 
                    
                                      </div>
                    </div>
              <?php endif; ?>
              
              <div class="col-md-7  event-post-detail">
              
                  <h2><a href="<?php echo the_permalink();?>" title=""><?php the_title(); ?></a></h2>
                  
                  <ul class="post-meta">
                  
                      <li><a href="<?php echo the_permalink();?>" title=""><i class="icon-user"></i><?php _e( 'by', SH_NAME );?> <?php echo sh_set( $EventSettings, 'organizer' );?></a></li>
                      <li><a href="<?php echo the_permalink();?>" title=""><i class="icon-calendar-empty"></i><span><?php echo date('F', strtotime( sh_set( $EventSettings, 'start_date') ) ); ?></span> <?php echo date('d, Y', strtotime( sh_set( $EventSettings, 'start_date') ) ); ?></a></li>
                      <li><a href="<?php echo the_permalink();?>" title=""><i class="icon-map-marker"></i><?php _e( 'In', SH_NAME );?> <?php echo sh_set( $EventSettings, 'location' );?></a></li>
                  </ul>
                  <p><?php echo substr( get_the_content(), 0, 155 );?></p>
              </div>
          </div>
          <?php
          endwhile;
          wp_reset_query();
		  ?>
          </div>
          <?php _the_pagination( array( 'total' => $query->max_num_pages ) );?>

      </div>
      
     <?php if($sidebar): ?> <div class="sidebar col-md-3"><?php dynamic_sidebar( $sidebar ); ?></div><?php endif; ?>
      </div>
    </div>
    
</section>

<?php get_footer();?>