<?php 
sh_custom_header();
$ThemeSettings = get_option( SH_NAME );
$sidebar = sh_set( $ThemeSettings, 'search_page_sidebar') ? sh_set( $ThemeSettings, 'search_page_sidebar' ) : 'default-sidebar';
$sidebar_position = (sh_set($ThemeSettings , 'search_page_sidebar_pos') == 'left')? 'switch' : '' ;
$post_types = get_post_types();
//printr($post_types);
?>

<div class="top-image"><img src="<?php echo sh_set($ThemeSettings , 'search_page_image'); ?>" alt="" /></div>
<!-- Page Top Image -->

<section class="inner-page  <?php echo $sidebar_position; ?> ">
	<div class="container">
		<div class="page-title">
			<h1><?php echo sh_set($ThemeSettings , 'search_page_heading');?></h1>
		</div><!-- Page Title -->        
		<div class="row">
			<div class="left-content col-md-9">
            	<h3 class="search-title"><?php _e("Search Result Found For:" ,  SH_NAME); ?> <span>"<?php echo get_search_query(); ?>"</span></h3>
             <div class="tab-content" id="myTabContent">
            <?php if(have_posts()){ while( have_posts() ): the_post(); 
				  global $post ; 
			?>					
					<div id="blog" class="">
						<div class="search-result">
							
							<div class="row">
								<div class="col-md-4">
									<a  class="search-image" href="<?php the_permalink();?>" title="">
										<?php the_post_thumbnail('270x155') ; ?>
									</a>
								</div>
								<div class="col-md-8">
									<div class="search-detail">
										<h4><a href="<?php the_permalink();?>" title=""><?php the_title();?></a></h4>
										<p><?php echo substr(strip_tags(get_the_content()) , 0 , 200);?></p>
									</div>
								</div>
							</div>
						</div>
					</div><!-- Blog -->
             <?php endwhile; }
			 else{ ?>
             <div id="all" class="tab-pane fade active in">
                    <div class="search-result">
                        
                        <p><?php _e("No results found. Please adjust your search term and try again." ,SH_NAME); ?></p>
                        <div class="row">
                            <div class="col-md-8">
                                <div class="search-bar">
                                  <form action="<?php echo home_url(); ?>" method="GET">
                                    <input type="text" name="s" placeholder="<?php _e("Enter Search Item" , SH_NAME); ?>" class="search">
                                    <input type="submit" value="" class="search-button">
                                   </form>
                                </div>						
                            </div>
                        </div>
                    </div>
                </div>
               <?php } ?>
             </div>
             </div>
            <div class="sidebar col-md-3 pull-right">
				<?php dynamic_sidebar($sidebar); ?>
			</div>        
    	</div>
       </div>
</section>
<?php get_footer(); ?>