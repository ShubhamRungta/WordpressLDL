<?php 
sh_custom_header();
$ThemeSettings = get_option( SH_NAME );
$PageSettings  = get_post_meta(get_the_ID(), '_page_settings', true);
$IsWide = ( sh_set( $ThemeSettings, 'blog_layout' ) == 'wide' ) ? TRUE: FALSE;
$IsLeftSidebarLayout = ( sh_set( $ThemeSettings, 'blog_layout' ) == 'leftsidebar' ) ? TRUE: FALSE;?>

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

<section class="inner-page<?php echo ( $IsLeftSidebarLayout ) ? 'switch': '';?>">

    <div class="container">
    
        <div class="page-title">
        	<?php
			$BlogHeadingFont = sh_get_font_settings( array( 'blog_heading_font_size' => 'font-size', 'blog_heading_font_family' => 'font-family', 'blog_heading_font_style' => 'font-style', 'blog_heading_color' => 'color' ), ' style="', '"' );
			$BlogSubHeadingFont = sh_get_font_settings( array( 'blog_sub_heading_font_size' => 'font-size', 'blog_sub_heading_font_family' => 'font-family', 'blog_sub_heading_font_style' => 'font-style', 'blog_sub_heading_color' => 'color' ), ' style="', '"' );
			?>
			<h1<?php echo $BlogHeadingFont;?>>
				<?php $object = get_queried_object();
				$author_name = apply_filters('the_author', is_object($object) ? $object->display_name : null);
				printf( __( 'All posts by %s', SH_NAME ), '<a class="url fn n" href="' . esc_url( get_author_posts_url( sh_set($object, 'ID') ) ) . '" title="' . esc_attr( $author_name ) . '" rel="me">' . $author_name . '</a>' ); ?>			
			</h1>
        </div>
    
		<?php if( $IsWide === FALSE ) :?>
            <div class="left-content nine-column">
        <?php endif;?>
            
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
                        
                            <li><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) );?>" title=""><i class="icon-user"></i><?php echo __( 'By', SH_NAME );?> <?php echo the_author_meta( 'display_name' );?></a></li>
                       
                        <?php endif;?>
                        
                        <li><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><i class="icon-share-alt"></i> <?php the_category(',', ''); ?></a></li>
                        
                        <?php if( sh_set( $PageSettings, 'location' ) ) :?>
                        
                            <li><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><i class="icon-map-marker"></i><?php echo __( 'In', SH_NAME ).' '.sh_set( $PageSettings, 'location' );?></a></li>
                        
                        <?php endif;?>
        
                    </ul>
                    
                    <div class="post-desc"><?php the_excerpt(); ?></div>
                
                </div>
    
            </div>
    
        <?php endwhile;?>
        
        <div class="pagination-area"><?php _the_pagination();?></div>
                
        <?php if( $IsWide === FALSE ) :?>
            </div>
        <?php endif;?>
        
        <?php if( $IsWide === FALSE && is_active_sidebar('blog-sidebar') ):?>
            
            <div class="sidebar three-column pull-right"><?php dynamic_sidebar( 'blog-sidebar' ); ?></div>
            
        <?php endif;?>
        
        <?php if( sh_set( $ThemeSettings, 'page_comments_status' ) == 'true' ): ?> 
        
			<div class="comments"><?php comments_template();?></div>
			
         <?php endif;?>

    </div>
    
</section>

<?php get_footer(); ?>