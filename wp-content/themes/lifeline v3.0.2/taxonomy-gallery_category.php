<?php 
sh_custom_header();
$settings  = array();//get_post_meta(get_the_ID(), '_page_settings', true);
$sidebar = '';
$col_class = 'col-md-12';

?>


<div class="top-image"> <img src="<?php echo get_template_directory_uri(); ?>/images/moving-bg.png" alt="" /> </div>

<section class="inner-page">

    <div class="container">
            <div class="page-title">
                <?php echo sh_get_title( single_term_title('Gallery Category: ', false), 'h1', 'span', FALSE );?>
            </div>
    </div>
   


	<div class="container">
    
    	<div class="row">

            <div class="<?php echo $col_class ;?>">
                 <?php while( have_posts() ): the_post(); ?>
                      
					  
                      <?php 
					    $cols = 3;
						$marginsarr = '';
					  	$columns = array(1 => 'col-md-12' , 2 => 'col-md-6' , 3 =>'col-md-4' , 4 => 'col-md-3');
						$max_limit_arr = array(1 => 6 , 2 => 3 , 3 => 2 , 4 => 2);
						$col_class = sh_set($columns , $cols);
						if($cols == 1 || $cols == 2) $featured_image_size = "1170x455";
						elseif($cols == 3) $featured_image_size = "370x252";
						elseif($cols == 4) $featured_image_size = "270x155";
						$max_limit = sh_set($max_limit_arr , $cols); 
						
						$output = '';
						//$output.= '<div class="col-md-12">' ;
						//$output .= '<ul class="gallery-tabs nav nav-tabs" id="myTab">' ;
						
						//$taxonomies = sh_get_categories( array( 'taxonomy' => 'gallery_category' , 'hide_empty' => false));
						$galleries = array(); 
						$count = 1;
						
						
						//$output.='</ul>';
						
						//$output.= '<div class="gallery-content tab-content" id="myTabContent">' ;
						
						$count_2 = 1 ;
						
							
							$active_class_ = ($count_2 == 1 ) ? 'active' : '' ;
							
							//$output.= '<div id="cat_" class="tab-pane fade in '.$active_class_.'">
							//				<div class="row">' ;
							

								
								
							
								$output.= '<div class="'.$col_class.'">';
				
								$featured_image =  sh_set( wp_get_attachment_image_src( get_post_thumbnail_id( ), $featured_image_size ) , 0); 
								
								$output.= '<div class="gallery-image"><img src="'.$featured_image.'" alt="" />';
									
								$output.= '<span>'.get_the_term_list( get_the_id(), 'gallery_category', '', ' / ', '' ).'</span>' ;
								
								$output.= '<div class="image-lists"><ul>';
								
								$Settings = get_post_meta( get_the_id(), '_dict_gallery_settings', true );
								
								$GalleryAttachments = get_posts( array( 'post_type' => 'attachment', 'post__in' => explode( ',', sh_set( $Settings, 'gallery' ) ) ) );
								
								$limiter = 1 ;
								
								foreach($GalleryAttachments as $thumb_image):	
									
									$Thumb = sh_set( wp_get_attachment_image_src( sh_set( $thumb_image , 'ID' ) , '150x150' ), '0' );
									$LargeThumb = sh_set( wp_get_attachment_image_src( sh_set( $thumb_image , 'ID' ) , '1170x455' ), '0' );
											
									$output.='<li>
												<a class="html5lightbox" href="'.$LargeThumb.'" data-group="group1" title="">
													<img src="'.$Thumb.'" alt="" />
												</a>
											  </li>';
									if($limiter < $max_limit) $limiter++;
									else break ;
											  
								endforeach; 		  
								$output.='</ul></div>' ;
								
								
									
								$output.= '</div>' ;
								
								$output.='<h3 class="image-title"><a href="'.get_permalink(get_the_id()).'" title="">'.get_the_title( get_the_id() ).'</a></h3>';
								
								$output.= '</div>'; 
								

							
							//$output.='		</div>
							//		  </div>';
							$count_2++ ;

						
						//$output.= '</div></div>' ;
						//$output.= ( in_array('bottom' , (array)$marginsarr)) ? '<div class="block"></div>' : ''; 
						
						echo $output;
					  ?>
                      
                      
                 <?php endwhile; ?>
                 
                 <div class="pagination-area"><?php _the_pagination();?></div>
            </div>

        </div>
        
    </div>
</div>




</section>
<?php get_footer(); ?>


