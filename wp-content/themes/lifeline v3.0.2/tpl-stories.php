<?php 
sh_custom_header(); 
$settings  = get_post_meta(get_the_ID(), '_page_settings', true);
$paged = get_query_var('paged');
?>
<div class="top-image"> <img src="<?php echo sh_set($settings , 'top_image'); ?>" alt="" /> </div>
<!-- Page Top Image -->

<section class="inner-page">

    <div class="container">
    
        <div class="page-title">
        
			<?php echo sh_get_title( get_the_title(), 'h1', 'span', FALSE );?>
            
        </div>
        <!-- Page Title -->
    
        <div class="stroies">
        
			<?php $Posts = query_posts( 'post_type=dict_project&posts_per_pag='.$paged );?>
            
            <?php if( have_posts() ): while( have_posts() ): the_post();?>
            
            <?php $ProjectSettings = get_post_meta( get_the_ID(), '_dict_project_settings', true );?>
            
            <div class="story">
            
                <div class="story-img">
                
                    <?php echo get_the_post_thumbnail( get_the_ID(), '270x196' )?>
                    
                    <h5><?php echo substr( get_the_title(), 0, 32 );?></h5>
                    
                    <a href="<?php the_permalink();?>" title="<?php echo get_the_title();?>"><span></span></a>
                    
                </div>
                
                <div class="story-meta">
                    <span><i class="icon-calendar-empty"></i><?php echo get_the_time(get_the_ID() , 'm-d-y'); ?></span>
                    <span><i class="icon-map-marker"></i><?php _e("In " , SH_NAME) ; ?> <?php echo sh_set( $ProjectSettings, 'location' );  ?></span>
                    <p> <?php _e("Needed Donation " , SH_NAME) ; ?><strong>$ <?php echo sh_set( $ProjectSettings, 'amount_needed' ); ?></strong></p>
                </div>
                
                <p><?php echo substr( get_the_content(), 0, 158 );?></p>
                
            </div>
            
            <?php
            endwhile ;
            endif ; 
            wp_reset_query();
            ?>
        </div>
        
        <div class="pagination-area"><?php _the_pagination( array( 'total' => count( $Posts ) ) );?></div>
        
    </div>
    
</section>

<?php get_footer();?>