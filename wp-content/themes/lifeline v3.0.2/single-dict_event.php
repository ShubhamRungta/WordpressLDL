<?php 
global $post_type;
sh_custom_header(); 
$ThemeSettings = get_option( SH_NAME );
$settings  = get_post_meta(get_the_ID(), '_dict_event_settings', true);
$sidebar = sh_set( $settings, 'sidebar' );
$col_class = ($sidebar)? 'col-md-9' : 'col-md-12' ; 
$sidebar_position = (sh_set($settings , 'sidebar_pos') == 'left')? 'switch' : '' ;?>
<div class="top-image"> <img src="<?php echo sh_set($settings , 'top_image'); ?>" alt="" /> </div>
<!-- Page Top Image -->

<section class="inner-page <?php echo $sidebar_position; ?>">

    <div class="container">
    <div class="row">
    
        <div class="left-content <?php echo $col_class ;?>">
        
          <?php
          while( have_posts() ): the_post();
          $EventSettings = get_post_meta( get_the_ID(), '_dict_event_settings', true );
          ?>
          
          <div id="post-<?php the_ID(); ?>" <?php post_class('post'); ?>>
          
          	  <?php if( has_post_thumbnail() ): ?>
                      <?php the_post_thumbnail('1170x455'); ?>  
              <?php endif; ?>
               <h1><?php the_title(); ?></h1>
               <div class="event-detail">
					<h2><?php _e("EVENT DETAILS :" , SH_NAME); ?></h2>
					
					<ul>
						<li><strong><?php _e("Start Date:" , SH_NAME); ?></strong><span><?php echo sh_set( $settings, 'start_date'  ); ?></span></li>
						<li><strong><?php _e("End Date:" , SH_NAME); ?></strong><span><?php echo  sh_set( $settings, 'end_date' ); ?></span></li>
						<li><strong><?php _e("Start Time:" , SH_NAME); ?></strong><span><?php echo sh_set( $EventSettings, 'start_time' );?></span></li>
						<li><strong><?php _e("End Time:" , SH_NAME); ?></strong><span><?php echo sh_set( $EventSettings, 'end_time' );?></span></li>
						<li><strong><?php _e("Location:" , SH_NAME); ?></strong><span><?php echo sh_set( $EventSettings, 'location' );?></span></li>
					</ul>
			  </div>
              
              <div class="event-detail">
					<h2><?php _e("ORGANIZER :" , SH_NAME); ?></h2>
					<ul>
						<li><strong><?php _e("Organized by:" , SH_NAME); ?></strong><span><?php echo sh_set( $EventSettings, 'organizer' );?></span></li>
						<li><strong><?php _e("Mobile:" , SH_NAME); ?></strong><span><?php echo sh_set( $EventSettings, 'contact' );?></span></li>
						<li><strong><?php _e("Email:" , SH_NAME); ?></strong><span><?php echo sh_set( $EventSettings, 'email' );?></span></li>
						<li><strong><?php _e("Website:" , SH_NAME); ?></strong><span><?php echo sh_set( $EventSettings, 'website' );?></span></li>
						<li><strong><?php _e("Address:" , SH_NAME); ?></strong><span><?php echo sh_set( $EventSettings, 'address' );?></span></li>
					</ul>
				</div>
               <?php the_content(); ?>
          </div>
          <?php endwhile;?>
          
           <?php if( sh_set( $ThemeSettings, 'page_comments_status' ) == 'true' ): ?> 
        
			<div class="comments"><?php comments_template();?></div>
			
         <?php endif;?>
        </div>
        
       <?php if($sidebar): ?>
    	<div class="sidebar col-md-3 pull-right"><?php dynamic_sidebar(sh_set($settings , 'sidebar', 'default-sidebar')); ?></div>
   	   <?php endif; ?>
        
    </div>
    </div>
    
</section>

<?php get_footer(); ?>