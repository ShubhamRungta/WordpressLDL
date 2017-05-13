<?php
// Portfolio

sh_custom_header();
global $posts; 
$Settings = get_option(SH_NAME) ;
$page_settings  = get_post_meta(get_the_ID(), '_page_settings', true);
$paged = get_query_var('paged');

$Style = array(
	'2column' => array( 'class' => 'col-md-6', 'PostBatch' => 2 ),
	'3column' => array( 'class' => 'col-md-4', 'PostBatch' => 3 ),
	'4column' => array( 'class' => 'col-md-3', 'PostBatch' => 4 )
);

$Col = sh_set( $Settings, 'portfolio_columns', '2column' );

$Posts = query_posts( 'post_type=dict_portfolio' );

$terms = get_terms( 'portfolio_category', array( 'hide_empty'=>0 ) );?>

<div class="top-image"> <img src="<?php echo sh_set($page_settings , 'top_image'); ?>" alt="" /> </div>

<section class="inner-page">
    
    <div class="container">
    
        <div class="page-title">
			<?php echo sh_get_title( get_the_title(), 'h1', 'span', FALSE );?>
        </div>
        
        <div class="controls">

            <ul>
            
               <li class="filter" data-filter="all">Show All</li>
               
                <?php foreach( $terms as $term ):?>
                
                    <li class="filter" data-filter="category_<?php echo sh_set($term , 'term_id'); ?>"><?php echo sh_set($term , 'name'); ?></li>
                    
                <?php endforeach;?>
                
            </ul>

        </div>
        
        <div id="Grid">
        
            <div class="row">
            
                <?php
				$chunk = array_chunk( $Posts, sh_set( sh_set( $Style, $Col ), 'PostBatch' ) );
				
				foreach( $chunk as $p ) :?>
				
					<div class="<?php echo sh_set( sh_set( $Style, $Col ), 'class' );?>">
                    
                    	<?php foreach( $p as $pos ) :
						$terms = wp_get_post_terms( sh_set( $pos, 'ID' ), 'portfolio_category' );
						$Class = '';
						$TermID = '';
						foreach( $terms as $tterm )
						{
							$Class .= ' category_'.sh_set( $tterm, 'term_id' );
							$TermID = sh_set( $tterm, 'term_id' );
						}
						?>
                        
                        	<div class="portfolio mix<?php echo $Class;?>" data-cat="<?php echo $TermID;?>"> 
                            
                                <?php echo get_the_post_thumbnail( sh_set( $pos, 'ID' ), '370x491' );?>
            
                                <div class="port-desc">
                                
                                    <a href=<?php echo get_permalink();?>""><h4><?php echo sh_character_limit( 30, sh_set( $pos, 'post_title' ) );?></h4></a>
                                    
                                    <p><?php echo sh_character_limit( 175, sh_set( $pos, 'post_content' ) );?></p>
                               
                                </div>
                              
                            </div>
                                
                        <?php endforeach;?>
                    
                    </div>
				
				<?php endforeach;?>

                <?php wp_reset_query();?>

            </div>
            
        </div>
        
    </div>
    
</section>

<?php get_footer();?>