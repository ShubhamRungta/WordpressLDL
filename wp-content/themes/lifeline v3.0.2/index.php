<?php 
global $wp_query, $post ;
sh_custom_header();
$theme_options = get_option( SH_NAME );
//printr($wp_query);
$PageSettings = array();
if( $wp_query->is_posts_page ) $PageSettings = get_post_meta(sh_set(get_queried_object(), 'ID'), '_page_settings', true);
else if( is_home() ) $PageSettings = sh_set($theme_options , 'home_page_settings');
$col_class = ( sh_set( $PageSettings, 'sidebar' ) ) ? 'col-md-9': 'col-md-12';
$sidebar_position = (sh_set($PageSettings , 'sidebar_pos') == 'left')? 'switch' : '' ;
//$attachments = get_posts(array('post_type' =>'attachment', 'post_parent'=>get_the_ID() , 'showposts' => -1) );
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
<section class="inner-page <?php echo $sidebar_position; ?>">
  <div class="container">
    <div class="page-title">
      <?php
				$BlogHeadingFont = sh_get_font_settings( array( 'blog_heading_font_size' => 'font-size', 'blog_heading_font_family' => 'font-family', 'blog_heading_font_style' => 'font-style', 'blog_heading_color' => 'color' ), ' style="', '"' );
				$BlogSubHeadingFont = sh_get_font_settings( array( 'blog_sub_heading_font_size' => 'font-size', 'blog_sub_heading_font_family' => 'font-family', 'blog_sub_heading_font_style' => 'font-style', 'blog_sub_heading_color' => 'color' ), ' style="', '"' );
				if( is_home() ) $Heading = __('Blog', SH_NAME);
				else if( sh_set( $settings, 'blog_heading' ) ) $Heading = sh_set( $settings, 'blog_heading' );
				else $Heading = the_title();
				if( sh_set( $PageSettings, 'blog_sub_heading_text' ) ) $SubHeading = sh_set( $PageSettings, 'blog_sub_heading_text' );
				else $SubHeading = sh_set($PageSettings, 'sub_title');
			?>
      <h1<?php echo $BlogHeadingFont;?>><?php echo $Heading;?><span<?php echo $BlogSubHeadingFont;?>><?php echo $SubHeading; ?></span></h1>
    </div>
    <div class="left-content <?php echo $col_class; ?>">
      <?php  while( have_posts() ): the_post(); ?>
      <?php $images = get_children( array ( 'post_parent' => $post->ID,	'post_type' => 'attachment', 'post_mime_type' => 'image' ) );?>
      <div id="post-<?php the_ID(); ?>" <?php post_class('blog-post'); ?>>
        <h2><a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>">
          <?php the_title(); ?>
          </a></h2>
        <?php $PostSettings = get_post_meta( get_the_ID(), '_'.sh_set($post, 'post_type').'_settings', true);?>
        <?php if( sh_set( $PostSettings , 'format' ) == 'image' ):?>
        <?php if( has_post_thumbnail() ):?>
        <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
        <?php the_post_thumbnail('1170x455'); ?>
        </a>
        <?php endif;?>
        <?php elseif( sh_set( $PostSettings , 'format' ) == 'slider' ): ?>
        <div class="post-slider">
          <div class="tp-banner4" >
            <ul>
              <?php foreach ( $images as $attachment_id => $attachment ):?>
              <li data-transition="curtain-1" data-slotamount="7" data-masterspeed="500" > <?php echo wp_get_attachment_image( $attachment_id, '1170x455' ); ?> </li>
              <!-- Slide -->
              <?php endforeach; ?>
            </ul>
          </div>
        </div>
        <?php elseif( sh_set( $PostSettings , 'format' ) == 'video' ): ?>
        <div class="video-post">
          <?php the_post_thumbnail( '1170x455' ); ?>
          <a class="html5lightbox" href="<?php echo sh_set(sh_set($PostSettings, 'videos'), 0) ; ?>" title=""><i class="icon-play"></i></a> </div>
        <?php endif;?>
        <div class="blog-post-details">
          <ul class="post-meta">
            <li><a href="<?php the_permalink(); ?>" title=""><i class="icon-calendar-empty"></i><span><?php echo get_the_date('F'); ?></span> <?php echo get_the_date('d,Y'); ?></a></li>
            <?php 
                        $Author = get_the_author();
                        if( !empty( $Author ) ) :?>
            <li><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>" title=""><i class="icon-user"></i><?php echo __( 'By', SH_NAME );?> <?php echo get_the_author();?></a></li>
            <?php endif;?>
            <li><i class="icon-share-alt"></i>
              <?php _e('In', SH_NAME); ?>
              ;
              <?php the_category(',', ''); ?>
            </li>
            <?php if( sh_set( $PageSettings, 'location' ) ) :?>
            <li><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><i class="icon-map-marker"></i><?php echo __( 'In', SH_NAME ).' '.sh_set( $PageSettings, 'location' );?></a></li>
            <?php endif;?>
          </ul>
          <div class="post-desc">
            <p>
              <?php the_excerpt('Read More...'); ?>
            </p>
          </div>
        </div>
      </div>
      <?php endwhile;?>
        <?php _the_pagination();?>
    </div>
    <?php if(sh_set( $PageSettings, 'sidebar' )):?>
    <div class="sidebar col-md-3 pull-right">
      <?php dynamic_sidebar( sh_set( $PageSettings, 'sidebar' ) ); ?>
    </div>
    <?php endif;?>
    <?php if( sh_set( $PageSettings, 'page_comments_status' ) == 'true' ): ?>
    <div class="comments">
      <?php comments_template();?>
    </div>
    <?php endif;?>
  </div>
</section>
<?php get_footer(); ?>
