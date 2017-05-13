<?php 
sh_custom_header();
$Settings = get_option(SH_NAME); 

$PageSettings  = get_post_meta(get_the_ID(), '_post_settings', true);
$PostSettings = get_post_meta( get_the_ID(), '_'.sh_set($post, 'post_type').'_settings', true); 
$videos = sh_set($Settings , 'videos') ;
$attachments = get_posts(array('post_type'=>'attachment', 'post_parent'=>get_the_ID() , 'showposts' => -1) );
$sidebar = sh_set( $PageSettings, 'sidebar') ? sh_set( $PageSettings, 'sidebar' ) : 'default-sidebar';
$col_class = sh_set( $PageSettings, 'sidebar') ? 'col-md-9' : 'col-md-12';
$sidebar_position = (sh_set($PageSettings , 'sidebar_pos') == 'left')? 'switch' : '' ;
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
<section class="inner-page <?php echo $sidebar_position ;?>">
  <div class="container">
    <div class="row">
      <div class="left-content <?php echo $col_class; ?>">
        <div id="post-<?php the_ID(); ?>" <?php post_class("post"); ?>>
          <?php while( have_posts() ): the_post();
                	if ( !post_password_required() ){ ?>
          <?php if( sh_set( $PostSettings , 'format' ) == 'image' ):?>
          <?php if( has_post_thumbnail() ):?>
          <?php the_post_thumbnail('1170x455'); ?>
          <?php endif;?>
          <?php elseif( sh_set( $PostSettings , 'format' ) == 'slider' ): ?>
          <div class="post-slider">
            <div class="tp-banner3" >
              <ul>
                <?php foreach($attachments as $attachment):?>
                <li data-transition="curtain-1" data-slotamount="7" data-masterspeed="500" > <?php echo wp_get_attachment_image( $attachment->ID, '1170x455' ); ?> </li>
                <!-- Slide -->
                <?php endforeach; ?>
              </ul>
            </div>
          </div>
          <?php elseif( sh_set( $PostSettings , 'format' ) == 'video' ): 
					$video_link = sh_set(sh_set($PostSettings, 'videos') , 0);
					$video_data = sh_grab_video( $video_link, $PostSettings );
					$thumb_size = (sh_set($PostSettings , 'sidebar')) ? 'style="width:870px; height:374px;"' : 'style="width:1170px; height:374px;"' ;
					?>
          <div class="video-post"> <img src="<?php echo sh_set( $video_data, 'thumb');?>"  alt="<?php echo sh_set( $video_data, 'title' ); ?>" /> <a class="html5lightbox" href="<?php echo $video_link ;?>" title=""><i class="icon-play"></i></a> </div>
          <?php endif;?>
          <span class="category">
          <?php _e('In', SH_NAME); ?>
          <?php the_category(',', ''); ?>
          </span><!-- Categories -->
          <h1>
            <?php the_title(); ?>
          </h1>
          <ul class="post-meta">
            <li><a href="" title=""><i class="icon-calendar-empty"></i><span><?php echo get_the_date('F'); ?></span> <?php echo get_the_date('d,Y'); ?></a></li>
            <?php 
                        $Author = get_the_author();
                        if( !empty( $Author ) ) :?>
            <li><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>" title=""><i class="icon-user"></i><?php echo __( 'By', SH_NAME );?> <?php echo get_the_author();?></a></li>
            <?php endif;?>
            <?php if( sh_set( $PostSettings, 'location' ) ) :?>
            <li><a href="" title=""><i class="icon-map-marker"></i><?php echo __( 'In', SH_NAME ).' '.sh_set( $PostSettings, 'location' );?></a></li>
            <?php endif;?>
          </ul>
          <div class="post-desc">
            <?php the_content(); ?>
            <?php wp_link_pages(); ?>
          </div>
          <?php } 
					else{ ?>
          <div class="post-desc">
            <?php the_content(); ?>
          </div>
          <?php
					}
					?>
          <div class="cloud-tags">
            <?php the_tags('<h3 class="sub-head">'.__('Tags Clouds', SH_NAME).'</h3>', ''); ?>
          </div>
          <!-- Tags -->
          <?php if( is_single() && comments_open() ) comments_template(); ?>
          <?php endwhile;?>
        </div>
      </div>
      <?php if( sh_set($PageSettings, 'sidebar')) : ?>
      <div class="sidebar col-md-3">
        <?php dynamic_sidebar( $sidebar ); ?>
      </div>
      <?php endif ; ?>
    </div>
  </div>
</section>
<?php get_footer(); ?>
