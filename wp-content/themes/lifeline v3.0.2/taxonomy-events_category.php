<?php 
/* Template Name: Events */

sh_custom_header(); 
$settings  = get_post_meta(get_the_ID(), '_page_settings', true);
$paged = get_query_var('paged');
?>
<?php if( sh_set($PageSettings , 'top_image') ): ?>
	<?php if( sh_set($PageSettings , 'top_image') ): ?>
	<div class="top-image"> <img src="<?php echo sh_set($PageSettings , 'top_image'); ?>" alt="" /></div>
<?php else: ?>
	<div class="no-top-image"></div>
<?php endif; ?>
<?php else: ?>
	<div class="no-top-image"></div>
<?php endif; ?>
<!-- Page Top Image -->
<section class="inner-page">
  <div class="container">
    <div class="page-title">
      <?php echo sh_get_title( get_the_title(), 'h1', 'span', FALSE );?>
    </div>
    <!-- Page Title -->
    <div class="left-content nine-column">
      <?php
      $Posts = query_posts( 'post_type=dict_event&posts_per_pag='.$paged );
	  if( have_posts() ): while( have_posts() ): the_post();
	  $EventSettings = get_post_meta( get_the_ID(), '_dict_event_settings', true );
	  ?>
      <div id="post-<?php the_ID(); ?>" <?php post_class("event-post"); ?>>
        <div class="event-post-image"> <?php echo get_the_post_thumbnail( get_the_ID(), '270x155' )?> <img class="map" src="<?php echo get_template_directory_uri();?>/images/map.jpg" alt="" /> <i class="icon-map-marker"></i> <a href="<?php the_permalink();?>" title=""><span></span></a> </div>
        <div class="event-post-detail">
          <h2><a href="<?php the_permalink();?>" title="<?php echo get_the_title();?>"><?php echo get_the_title();?></a></h2>
          <?php
          $EventdateDetails = '';
          if( !empty( $EventSettings['start_date'] ) )
          {
              $Eventdate = new DateTime( $EventSettings['start_date'] );
              $EventdateDetails = '<li><a href="'.get_permalink().'" title=""><i class="icon-calendar-empty"></i><span>'.$Eventdate->format('F').'</span> '.$Eventdate->format('d, Y').'</a></li>';
          }
          else if( !empty( $EventSettings['end_date'] ) )
          {
              $Eventdate = new DateTime( $EventSettings['end_date'] );
              $EventdateDetails = '<li><a href="'.get_permalink().'" title=""><i class="icon-calendar-empty"></i><span>'.$Eventdate->format('F').'</span> '.$Eventdate->format('d, Y').'</a></li>';
          }
          ?>
          <ul class="post-meta">
            <?php 
            echo ( !empty( $Settings['organizer'] ) ) ? '<li><a href="'.get_permalink().'" title=""><i class="icon-user"></i>'._e('By', SH_NAME).' '.sh_set( $EventSettings, 'organizer' ).'</a></li>': '';
            echo $EventdateDetails;
            echo ( !empty( $EventSettings['location'] ) ) ? '<li><a href="'.get_permalink().'" title=""><i class="icon-map-marker"></i>'._e('In', SH_NAME).' '.sh_set( $EventSettings, 'location' ).'</a></li>': '';
            ?>
          </ul>
          <p><?php echo get_the_content();?></p>
        </div>
      </div>
      <?php
	  endwhile ;
	  endif ; 
	  wp_reset_query();
	  _the_pagination( array( 'total' => count( $Posts ) ) );
	  ?>
    </div>
    <div class="sidebar three-column pull-right">
      <?php dynamic_sidebar( sh_set( $settings, 'sidebar' ) ); ?>
    </div>
  </div>
</section>
<?php get_footer();?>