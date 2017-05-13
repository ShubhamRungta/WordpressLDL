<?php 
sh_custom_header();
$ThemeSettings = get_option( SH_NAME );
$PageSettings  = get_post_meta(get_the_ID(), '_page_settings', true);
$sidebar = sh_set( $ThemeSettings, 'archive_page_sidebar' );
$sidepos = sh_set( $ThemeSettings, 'archive_page_sidebar_pos' );
?>
<?php if( sh_set( $ThemeSettings, 'archive_page_image' ) ) :?>
    <div class="top-image">
        <img src="<?php echo sh_set( $ThemeSettings, 'archive_page_image' );?>" alt="" />
    </div>
<?php else:?>
	<div class="no-top-image"></div>
<?php endif; ?>
<!-- Page Top Image -->
<section class="inner-page">
    <div class="container">
    
        <div class="page-title">
        	<?php
			$BlogHeadingFont = sh_get_font_settings( array( 'blog_heading_font_size' => 'font-size', 'blog_heading_font_family' => 'font-family', 'blog_heading_font_style' => 'font-style', 'blog_heading_color' => 'color' ), ' style="', '"' );
			$BlogSubHeadingFont = sh_get_font_settings( array( 'blog_sub_heading_font_size' => 'font-size', 'blog_sub_heading_font_family' => 'font-family', 'blog_sub_heading_font_style' => 'font-style', 'blog_sub_heading_color' => 'color' ), ' style="', '"' );
			?>
			<h1<?php echo $BlogHeadingFont;?>>
			<?php if ( is_day() ) :
                printf( __( 'Daily Archives: %s', SH_NAME ), get_the_date() );
            elseif ( is_month() ) :
                printf( __( 'Monthly Archives: %s', SH_NAME ), get_the_date( _x( 'F Y', 'monthly archives date format', SH_NAME ) ) );
            elseif ( is_year() ) :
                printf( __( 'Yearly Archives: %s', SH_NAME ), get_the_date( _x( 'Y', 'yearly archives date format', SH_NAME ) ) );
            else :
                _e( 'Archives', SH_NAME );
            endif;?>
			</h1>
        </div>
    
		<?php if( $sidebar != '' && $sidepos == 'left' ) :?>
            <div class="col-md-3">
            	<?php dynamic_sidebar($sidebar); ?>
            </div>
        <?php endif;?>
        
		<?php if( $sidebar != '' ) :?>
            <div class="left-content col-md-9">
        <?php else:?>
        	<div class="left-content col-md-12">
        <?php endif; ?>  
            
		<?php while( have_posts() ): the_post(); ?>
        
        	<div class="blog-post">
        
                <h2><a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
            
                <?php $PostForamt = get_post_meta( get_the_ID() , 'format', true ); ?>
            
                <?php if( sh_set( $PostForamt , 'format' ) == 'image' ):?>
                    
                    <?php if( has_post_thumbnail() ):?>
                    
                        <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_post_thumbnail('1170x325'); ?></a>
                    
                    <?php endif;?>
                
                <?php elseif( sh_set( $PostForamt , 'format' ) == 'slider' ): ?>
                
                    <script type="text/javascript">
                        jQuery(document).ready(function($){
                            $('#layerslider<?php echo get_the_id();?>').layerSlider({
                                skinsPath : 'layerslider/skins/',
                                skin : 'defaultskin',
                                responsive: true,
                                responsiveUnder: 1200,			
                                pauseOnHover: false,
                                showCircleTimer: false,
                                navStartStop:false,
                                navButtons:false,
                            }); // LAYER SLIDER
                        });		
                    </script>
                
                    <div id="layerslider-container-fw">
                    
                        <div id="layerslider<?php echo get_the_id();?>" style="width: 100%; height: 375px; margin: 0px auto; ">
    
                            <?php $attachments = get_posts(array('post_type'=>'attachment', 'post_parent'=>get_the_ID() , 'showposts' => -1) );?>
                        
                            <?php foreach($attachments as $attachment): ?>
    
                                <div class="ls-layer" style="transition2d: 5; slidedelay: 8000;" > <?php echo wp_get_attachment_image( $attachment->ID, '1366x286' ); ?> </div>
                                <!-- Slide -->
    
                            <?php endforeach; ?>
    
                        </div>
                        
                    </div>
                    
                <?php elseif( sh_set( $PostForamt , 'format' ) == 'video' ): ?>
                
                    <div class="video-post">
                        <?php the_post_thumbnail( '1366x286' ); ?>
                        <a class="html5lightbox" href="<?php echo sh_set($videos, 0) ; ?>" title=""><i class="icon-play"></i></a>
                    </div>
                
                <?php endif;?>
                
                <div class="blog-post-details">
    
                    <ul class="post-meta">
                    
                        <li><a href="" title=""><i class="icon-calendar-empty"></i><span><?php echo get_the_date('F'); ?></span> <?php echo get_the_date('d,Y'); ?></a></li>
                        
                        <?php 
                        $Author = get_the_author();
                        if( !empty( $Author ) ) :?>
                        
                            <li><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>" title=""><i class="icon-user"></i><?php echo __( 'By', SH_NAME );?> <?php echo get_the_author();?></a></li>
                       
                        <?php endif;?>
                        
                        <li><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><i class="icon-share-alt"></i> <?php the_category(',', ''); ?></a></li>
                        
                        <?php if( sh_set( $PageSettings, 'location' ) ) :?>
                        
                            <li><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><i class="icon-map-marker"></i><?php echo __( 'In', SH_NAME ).' '.sh_set( $PageSettings, 'location' );?></a></li>
                        
                        <?php endif;?>
        
                    </ul>
                    
                    <div class="post-desc"><p><?php the_excerpt(); ?></p></div>
                
                </div>
                
			</div>                 
        <?php endwhile;?>
        
        <div class="pagination-area"><?php _the_pagination();?></div>
        </div>
        <?php if( $sidebar != '' && $sidepos == 'right' ) :?>
            <div class="col-md-3">
            	<?php dynamic_sidebar($sidebar); ?>
            </div>
        <?php endif;?>
        
        <?php if( sh_set( $ThemeSettings, 'page_comments_status' ) == 'true' ): ?> 
        
			<div class="comments"><?php comments_template();?></div>
			
         <?php endif;?>
    </div>
    
</section>
<?php get_footer(); ?>