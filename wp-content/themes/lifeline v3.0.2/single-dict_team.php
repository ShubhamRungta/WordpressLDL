<?php 
sh_custom_header(); 
$settings  = get_post_meta(get_the_ID(), '_dict_team_settings', true);
$sh_options = get_option(SH_NAME);
$sidebar = sh_set( $settings, 'sidebar' );
$col_class = ($sidebar)? 'col-md-9' : 'col-md-12' ; 
$sidebar_position = (sh_set($settings , 'sidebar_pos') == 'left')? 'switch' : '' ;
?>

<div class="top-image"><img src="<?php echo sh_set($settings , 'top_image'); ?>" alt="" /></div>
<!-- Page Top Image -->

<section class="inner-page <?php echo $sidebar_position; ?>">
  <div class="container">
    <div class="row">
      <div class="<?php echo $col_class ;?>" >
        <?php
              //$Posts = query_posts( 'post_type=dict_team&posts_per_pag='.$paged );
              if( have_posts() ): while( have_posts() ): the_post();
              $Settings = get_post_meta( get_the_ID(), '_dict_team_settings', true );
              
              $GalleryAttachments = get_posts( array( 'post_type' => 'attachment', 'post__in' => explode( ',', sh_set( $Settings, 'gallery' ) ) , 'posts_per_page' => 6 ) );
              $Thumb = $LargeImage = $Thumbnails = '';
              $i = 1;
              $CoverImage = '';
              foreach( $GalleryAttachments as $Attachment )
              {
                  $LargeImageClass = ( $i == 1 ) ? ' active': '';
                  $ThumbClass = ( $i == 1 ) ? ' class="active"': '';
                  $ThumbSrc = sh_set( wp_get_attachment_image_src( $Attachment->ID, '170x116' ), '0' );
                  $Thumb .= '<li'.$ThumbClass.'><a href="#profile-pic'.$i.'" data-toggle="tab"><img alt="" src="'.$ThumbSrc.'"></a></li>';
                  $LargeImageSrc = sh_set( wp_get_attachment_image_src( $Attachment->ID, '570x531' ), '0' );
                  $LargeImage .= '<div class="tab-pane fade in'.$LargeImageClass.'" id="profile-pic'.$i.'"> <img alt="" src="'.$LargeImageSrc.'"> </div>';
                  $i++;
              }
              ?>
        <div id="post-<?php the_ID(); ?>" <?php post_class('profile-page'); ?>>
         <div class="row">
          <?php 
                  if( isset( $LargeImage ) && !empty( $LargeImage ) ) : ?>
                          <div class="col-md-6">
                            <div id="myTabContent" class="tab-content profile-tabs-content"> <?php echo $LargeImage;?> </div>
                            <ul id="myTab" class="nav nav-tabs profile-tabs">
                              <?php echo $Thumb;?>
                            </ul>
                          </div>
                      
          <?php
                  endif;
                  ?>
          <div class="col-md-6">
            <?php
                  if( sh_set( $Settings, 'name' ) ) : ?>
            <h1><i class="icon-user"></i><?php echo sh_set( $Settings, 'name' );?></h1>
            <?php
                  endif;
                  
                  if( sh_set( $Settings, 'designation' ) ) : ?>
            <span class="designation"><?php echo sh_set( $Settings, 'designation' );?></span>
            <?php
                  endif;
                  
                  if( sh_set( $Settings, 'experience' ) || sh_set( $Settings, 'email' ) || sh_set( $Settings, 'phone' ) ) : ?>
            <ul class="profile-info">
              <?php
                          if( sh_set( $Settings, 'experience' ) ): ?>
              <li> <span><i class="icon-lightbulb"></i>Experience:</span>
                <p><?php echo sh_set( $Settings, 'experience' );?></p>
              </li>
              <?php
                          endif;
                          if( sh_set( $Settings, 'email' ) ): ?>
              <li> <span><i class="icon-envelope"></i>Email:</span>
                <p><?php echo sh_set( $Settings, 'email' );?></p>
              </li>
              <?php
                          endif;
                          if( sh_set( $Settings, 'phone' ) ): ?>
              <li> <span><i class="icon-phone"></i>Phone:</span>
                <p><?php echo sh_set( $Settings, 'phone' );?></p>
              </li>
              <?php
                          endif; ?>
            </ul>
            <?php
                  endif;
                  ?>
            <p><?php echo get_the_content();?></p>
          </div>
          </div>
        </div>
        <?php
              endwhile ;
              endif ; 
              wp_reset_query();
              ?>
      </div>
      <?php if($sidebar): ?>
      <div class="sidebar col-md-3 pull-right">
        <?php dynamic_sidebar(sh_set($settings , 'sidebar', 'default-sidebar')); ?>
      </div>
      <?php endif; ?>
      <div class="col-md-12">
          <div class="join-team">
            <div class="col-md-12">
              <h2><?php echo sh_set($sh_options , 'team_title'); ?></h2>
              <p><?php echo sh_set($sh_options , 'team_text'); ?></p>
              <a title="" href="<?php echo sh_set($sh_options , 'team_link'); ?>">
              <?php _e("Join Our Team" , SH_NAME); ?>
              </a> </div>
          </div>
        </div>
      </div>
  </div>
</section>
<?php get_footer(); ?>
