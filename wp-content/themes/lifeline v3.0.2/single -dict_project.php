<?php 
sh_custom_header();
$Settings = get_option(SH_NAME); 
$PageSettings  = get_post_meta(get_the_ID(), '_post_settings', true);
$PostSettings = get_post_meta( get_the_ID(), '_'.sh_set($post, 'post_type').'_settings', true); 
$videos = sh_set($Settings , 'videos') ;
$attachments = get_posts(array('post_type'=>'attachment', 'post_parent'=>get_the_ID() , 'showposts' => -1) );
$sidebar = sh_set( $PageSettings, 'sidebar') ? sh_set( $PageSettings, 'sidebar' ) : 'default-sidebar';
$sidebar_position = (sh_set($PageSettings , 'sidebar_pos') == 'left')? 'switch' : '' ;
?>

<?php if( sh_set($PageSettings , 'top_image') ): ?>
	<div class="top-image"> <img src="<?php echo sh_set($PageSettings , 'top_image'); ?>" alt="" /></div>
<?php else: ?>
	<div class="no-top-image"></div>
<?php endif; ?>
<!-- Page Top Image -->
	
<section class="inner-page <?php echo $sidebar_position ;?>">
	
    <div class="container">
    
		<div class="left-content col-md-9">
        
			<div id="post-<?php the_ID(); ?>" <?php post_class("post"); ?>>
            
            	<?php while( have_posts() ): the_post();?>
                
                	<?php if( sh_set( $PostSettings , 'format' ) == 'image' ):?>
                    	
                        <?php if( has_post_thumbnail() ):?>
                        
                        	<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_post_thumbnail('1170x455'); ?></a>
                        
                        <?php endif;?>
                    
                    <?php elseif( sh_set( $PostSettings , 'format' ) == 'slider' ): ?>
                    
                    	<!--<script type="text/javascript">
							jQuery(document).ready(function($){
								$('#layerslider').layerSlider({
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
					    </script>-->
                    
                        <div id="layerslider-container-fw">
                        
                        	<div id="layerslider" style="width: 100%; height: 375px; margin: 0px auto; ">
                            
                            	<?php foreach($attachments as $attachment):?>

                                    <div class="ls-layer" style="transition2d: 5; slidedelay: 8000;" > <?php echo wp_get_attachment_image( $attachment->ID, '870x374' ); ?> </div>
                                    <!-- Slide -->

                                <?php endforeach; ?>

                            </div>
                            
                        </div>
                        
                    <?php elseif( sh_set( $PostSettings , 'format' ) == 'video' ): ?>
                    
                        <div class="video-post">
                            <?php the_post_thumbnail( '870x374' ); ?>
                            <a class="html5lightbox" href="<?php echo sh_set($videos, 0);?>" title=""><i class="icon-play"></i></a>
                        </div>
					
					<?php endif;?>
                    
                    <span class="category"><?php _e('Categorized', SH_NAME); ?>; <?php the_category(',', ''); ?></span><!-- Categories -->
                    <h1><?php the_title(); ?></h1>
                    <ul class="post-meta">
                    
                        <li><a href="" title=""><i class="icon-calendar-empty"></i><span><?php echo get_the_date('F'); ?></span> <?php echo get_the_date('d,Y'); ?></a></li>
                        
                        <?php 
						$Author = get_the_author();
						if( !empty( $Author ) ) :?>
                        
                            <li><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>" title=""><i class="icon-user"></i><?php echo _e( 'By', SH_NAME );?> <?php echo get_the_author();?></a></li>
                       
                        <?php endif;?>
                        
                        <?php if( sh_set( $PostSettings, 'location' ) ) :?>
                        
                            <li><a href="" title=""><i class="icon-map-marker"></i><?php echo _e( 'In', SH_NAME ).' '.sh_set( $PostSettings, 'location' );?></a></li>
                        
                        <?php endif;?>
    
                    </ul>
                    
                    <div class="post-desc"><p><?php the_content(); ?></p></div>
    
                    <div class="cloud-tags">
                        <?php the_tags('<h3 class="sub-head">'.__('Tags Clouds', SH_NAME).'</h3>', ''); ?>
                    </div><!-- Tags -->	
    
                    <?php if( is_single() && comments_open() ) comments_template(); ?>
                    
                <?php endwhile;?>
					
			</div>

		</div>
		
		<?php if(sh_set( $PageSettings, 'sidebar')): ?> <div class="sidebar col-md-3">
        
        	<?php dynamic_sidebar( $sidebar ); ?>
        
		</div>
        <?php endif ; ?>
        
	</div>

</section> 

<?php get_footer(); ?>