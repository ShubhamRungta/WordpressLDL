<?php 
/* Template Name: Our Causes */

sh_custom_header(); 
$settings  = get_post_meta(get_the_ID(), '_page_settings', true);
$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
$sidebar = sh_set( $settings, 'sidebar') ? sh_set( $settings, 'sidebar' ) : '';
$sidebar_position = (sh_set($settings , 'sidebar_pos') == 'left')? 'switch' : '' ;
$col_class = ($sidebar) ? 'col-md-9' : 'col-md-12' ;
$inner_col = ($sidebar) ? 'col-md-4' : 'col-md-3' ; 
?>

<div class="top-image"> <img src="<?php echo sh_set($settings , 'top_image'); ?>" alt="" /> </div>

<section class="inner-page <?php echo $sidebar_position ;?>">

    <div class="container">
    
            <div class="page-title">
            
                <?php echo sh_get_title( get_the_title(), 'h1', 'span', FALSE );?>
              
            </div>
        <!-- Page Title -->
        <div class="row" >
        <div class="left-content <?php echo $col_class; ?>">
        
            <div class="causes-page">
            <div class="remove-space">
                <div class="row">
                  <?php // $Posts = query_posts( 'post_type=dict_causes&paged='.$paged);
				  $args = array( 'post_type'=>'dict_causes' , 'paged' => $paged,  'tax_query'=> array( array ( 'taxonomy' => 'causes_category', 'terms' => array( 'Category 2' , ' '), 'field' => 'slug' ) ) );
				  $the_query = new WP_Query( $args );
				  ?>
                  
                  <?php if( $the_query-> have_posts() ): while( $the_query->have_posts() ): $the_query->the_post();?>
                  
                  <?php $CausesSettings = get_post_meta( get_the_ID(), '_dict_causes_settings', true );?>
                  
                  <div class="<?php echo $inner_col; ?>">
                  
                      <div class="causes-image"> <?php echo get_the_post_thumbnail( get_the_ID(), '370x491' );?>
					  
                     <a href="'the_permalink()'" >
					 
                          <div class="cause-heading">
                          
                              <h3><a href="<?php the_permalink(); ?>" ><?php echo substr( get_the_title(), 0, 27 );?></a></h3>
                             
							 <p><?php _e("in" , SH_NAME); ?> <?php  echo sh_set( $CausesSettings, 'location'  ); ?></p>
						
                          
                          </div>
						  
                        </a>  
						
                          <div class="our-causes-hover">
                              
                              <h3><a href="<?php the_permalink(); ?>" ><?php echo substr( get_the_title(), 0, 27 );?></a></h3>
                              
                              <span><?php _e( 'In', SH_NAME );?><i> <?php echo sh_set( $CausesSettings, 'location' );?></i></span>
                              
                              <p><?php echo substr( get_the_content(), 0, 127 );?></p>
                              
                              <span class="help"><strong><?php _e( 'Help us', SH_NAME );?></strong> <?php _e( 'to collect', SH_NAME );?>:</span> <span class="needed-amount"><span><?php echo sh_set( $CausesSettings, 'currency_symbol' );?></span><?php echo sh_set( $CausesSettings, 'donation_needed' );?> </span> 
                         
                          </div>
                          
                      </div>
                      
                  </div>
				  
                  
                  <?php endwhile; endif; wp_reset_query();?>
                  
                </div>
             </div>
             <?php _the_pagination( array(  'total' => $the_query->max_num_pages, ) );?>
              
            </div>
        </div>
        
        <?php if($sidebar): ?> <div class="sidebar col-md-3"><?php dynamic_sidebar( $sidebar ); ?></div><?php endif; ?>
        </div>
    </div>
    
</section>
<?php get_footer();?>