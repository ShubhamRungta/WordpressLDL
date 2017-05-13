<?php 
sh_custom_header() ; 
$Settings = get_option(SH_NAME) ;
?>

<?php if( sh_set( $Settings, '404_page_image' ) ) :?>
    <div class="top-image">
        <img src="<?php echo sh_set( $Settings, '404_page_image' );?>" alt="" />
    </div>
<?php endif;?>

<!--Page Top Image-->
<section class="inner-page">
    <div class="container">
        <div class="page-title">
            <h1><?php echo sh_set($Settings , '404_page_heading');?> <span><?php echo sh_set($Settings , '404_page_sub_heading') ;?></span></h1>
        </div>
        <!--Page Title-->
        <div class="error-page">
            <h2><?php echo sh_set($Settings , '404_page_main_title_colored') ;?></h2>
            <p><?php echo sh_set($Settings , '404_page_main_title_grey') ;?> <span><?php echo sh_set($Settings , '404_page_sub_title') ;?></span></p>
        </div>
    </div>
    <div class="error-page-search">
    	<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="row">
						<div class="col-md-4 col-md-offset-4">
                        	<div class="search-bar">
                            <form id="search-form" method="get">
                                <input name="s" value="<?php echo get_search_query() ; ?>" type="text" placeholder="<?php _e('Search' , SH_NAME ) ; ?>" class="search">
                                <input type="submit" value="" class="search-button">            
                            </form>
                        </div>
                        </div>
        			</div>
					<?php if( sh_set( $Settings, '404_page_contents_heading' ) ) :?>
                        <h3><?php echo sh_set( $Settings, '404_page_contents_heading' );?></h3>
                    <?php endif;?>
                    <?php if( sh_set( $Settings, '404_page_content' ) ) :?>
                        <p><?php echo sh_set( $Settings, '404_page_content' );?></p>
                    <?php endif;?>
                    <a href="" onclick="history.back();" title=""><?php _e("Go Back:" , SH_NAME); ?> </a>
				</div>
			</div>
		</div>
    </div>
</section>

<?php get_footer() ; ?>