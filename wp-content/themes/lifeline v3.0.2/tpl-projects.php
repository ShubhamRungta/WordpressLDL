<?php 
/* Template Name: Projects */

sh_custom_header(); 
$settings  = get_post_meta(get_the_ID(), '_page_settings', true);
$paged = get_query_var('paged');
$sidebar = sh_set( $settings, 'sidebar') ? sh_set( $settings, 'sidebar' ) : '';
$sidebar_position = (sh_set($settings , 'sidebar_pos') == 'left')? 'switch' : '' ;
$col_class = (sh_set( $settings, 'sidebar')) ? 'col-md-9' : 'col-md-12' ;
?>

<div class="top-image"> <img src="<?php echo sh_set($settings , 'top_image'); ?>" alt="" /> </div>
<!-- Page Top Image -->

<section class="inner-page <?php echo $sidebar_position ;?>">
  <div class="container">
    <div class="page-title"> <?php echo sh_get_title( get_the_title(), 'h1', 'span', FALSE );?> </div>
    <div class="row" >
      <div class="left-content <?php echo $col_class; ?>"> 
        <!-- Page Title -->
        <?php $Posts = query_posts( 'post_type=dict_project&posts_per_pag='.$paged );?>
        <div class="remove-space">
        <div class="row">
          <?php while(have_posts()): the_post();?>
            <?php $ProjectSettings = get_post_meta( get_the_ID(), '_dict_project_settings', true );?>
            <div class="col-md-3">
              <div class="story">
                <div class="story-img"> <?php the_post_thumbnail( '370x252' )?>
                  <h5><?php echo substr( get_the_title(), 0, 32 );?></h5>
                  <a href="<?php the_permalink();?>" title="<?php the_title();?>"><span></span></a> </div>
                <div class="story-meta"> <span><i class="icon-calendar-empty"></i><?php echo get_the_date('m-d-y', get_the_ID()); ?></span> <span><i class="icon-map-marker"></i>
                  <?php _e("In " , SH_NAME) ; ?>
                  <?php echo sh_set( $ProjectSettings, 'location' );  ?></span>
                  <p>
                    <?php _e("Needed Donation " , SH_NAME) ; ?>
                    <strong>$ <?php echo sh_set( $ProjectSettings, 'amount_needed' ); ?></strong></p>
                </div>
                <p><?php echo substr( get_the_content(), 0, 158 );?></p>
              </div>
            </div>
          <?php
           endwhile;
            wp_reset_query();
            ?>
            </div>
        </div>
        <?php _the_pagination();?>
      </div>
      <?php if(sh_set( $settings, 'sidebar')): ?>
      <div class="sidebar col-md-3">
        <?php dynamic_sidebar( $sidebar ); ?>
      </div>
      <?php endif; ?>
    </div>
  </div>
</section>
<?php get_footer();?>
