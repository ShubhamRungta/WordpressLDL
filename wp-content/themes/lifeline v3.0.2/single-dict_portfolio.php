<?php 
sh_custom_header();
$Settings = get_option(SH_NAME); 
$PostSettings = get_post_meta( get_the_ID(), '_'.sh_set($post, 'post_type').'_settings', true); 
$attachments = get_posts(array('post_type'=>'attachment', 'post_parent'=>get_the_ID() , 'showposts' => -1) );
$sidebar = sh_set( $PostSettings, 'sidebar') ? sh_set( $PostSettings, 'sidebar' ) : 'default-sidebar';
?>

<div class="top-image"><img src="<?php echo sh_set($PostSettings , 'top_image'); ?>" alt="" /></div>
<!-- Page Top Image -->
	
<section class="inner-page<?php echo ( sh_set( $Settings, 'page_sidebar_position' ) == 'left' ) ? ' switch': '';?>">
	
    <div class="container">
    
		<div class="left-content nine-column">
        
			<div  id="post-<?php the_ID(); ?>" <?php post_class("post"); ?>>
            
            	<?php while( have_posts() ): the_post();?>
                
                	<?php the_post_thumbnail('1170x455'); ?>
                                        
                    <h1><?php the_title(); ?></h1>
					
					<ul class="post-meta">
                        
                        <?php 
						if( sh_set( $PostSettings, 'leader' )  ) :?>
                        
                            <li><i class="icon-user"></i><?php echo sh_set( $PostSettings, 'leader' ) ;?></li>
                       
                        <?php endif;?>
                        
                        <?php if( sh_set( $PostSettings, 'location' ) ) :?>
                        
                            <li><i class="icon-map-marker"></i><?php echo __( 'In', SH_NAME ).' '.sh_set( $PostSettings, 'location' );?></li>
                        
                        <?php endif;?>
                        <?php if( sh_set( $PostSettings, 'task' ) ) :?>
                        
                            <li><i class="icon-map-marker"></i><?php echo sh_set( $PostSettings, 'task' );?></li>
                        
                        <?php endif;?>
                    
                    </ul>
                    
                    <div class="post-desc">
                    	<?php the_content(); ?>
                    </div>
    
                    <div class="cloud-tags">
                        <?php the_tags('<h3 class="sub-head">'.__('Tags Clouds', SH_NAME).'</h3>', ''); ?>
                    </div><!-- Tags -->	
    
                     <?php if( sh_set( $Settings, 'page_comments_status' ) == 'true' ): ?> 
        
                        <div class="comments"><?php comments_template();?></div>
                        
                     <?php endif;?>
                    
                <?php endwhile;?>
					
			</div>

		</div>
		
		<div class="sidebar three-column pull-right">
        
        	<?php dynamic_sidebar( $sidebar ); ?>
        
		</div>
        
	</div>

</section> 

<?php get_footer(); ?>