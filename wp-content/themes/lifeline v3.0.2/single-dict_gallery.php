<?php
sh_custom_header();
global $posts ; 
$Settings = get_option(SH_NAME) ;
$page_settings  = get_post_meta(get_the_ID(), '_dict_gallery_settings', true);
$sidebar = sh_set( $page_settings, 'sidebar' );
$paged = get_query_var('paged');
$span_array = array( '2column'=>'span6', '3column'=>'span4', '4column'=>'span3');
$span_class = sh_set( $span_array, sh_set( $Settings, 'columns', '3column') );

$Records = '';
//$Posts = query_posts( 'post_type=dict_gallery' );

		
$i = 1;

if( have_posts() ): while( have_posts() ): the_post();

$PostTitle = get_the_title();
$Settings = get_post_meta( get_the_ID(), '_dict_gallery_settings', true );

$GalleryAttachments = get_posts( array( 'post_type' => 'attachment', 'showposts' => -1, 'post__in' => explode( ',', sh_set( $Settings, 'gallery' ) ) ) );
$Thumbnails = '';

foreach( $GalleryAttachments as $Attachment )
{
	if( $i == 1 )
	{
		$CoverImage = wp_get_attachment_image( $Attachment->ID, '1170x540' );
	}
	$LargeImage = wp_get_attachment_image( $Attachment->ID, '1170x540' );//sh_set( wp_get_attachment_image_src( $Attachment->ID, '1170x540' ), '0' );
	$Thumbnails .= '<li><a class="html5lightbox" href="'.$LargeImage.'" data-group="group1" title="">'.wp_get_attachment_image( $Attachment->ID, '68x61' ).'</a></li>';
	$i++;
	//$PostTitle = ( !empty( $PostTitle ) ) ? '<h3 class="image-title"><a href="#" title="">'.$PostTitle.'</a></h3>': '';
	$Records .= '<div class="col-md-12">
				  <div class="galley-image"> 
				  	<a href="'.wp_get_attachment_url( $Attachment->ID ).'" class="html5lightbox" title="">'.$LargeImage.'</a>
					
				  </div>
				  <h3 class="image-title">'.get_the_title( $Attachment->ID ).'</h3>
				</div>';
}


endwhile; 
endif;
wp_reset_query();
?>

<?php if( sh_set($Settings , 'top_image') ): ?>
	<div class="top-image"> <img src="<?php echo sh_set($Settings , 'top_image'); ?>" alt="" /></div>
<?php else: ?>
	<div class="no-top-image"></div>
<?php endif; ?>

<section class="inner-page">
    <div class="container">
      <div class="page-title">
        <?php echo sh_get_title( get_the_title(), 'h1', 'span', FALSE );?>
      </div>
      <div class="gallery-content tab-content" id="myTabContent">
        <div id="events" class="tab-pane fade active in">
          <div class="row">
            
			<?php if( $sidebar ): ?>
            <div class="col-md-9">
            <?php endif; ?>
			
			<?php echo $Records;?>
            
			<?php if( $sidebar ): ?>
            </div>
            <?php endif; ?>
          	
            <?php if( $sidebar ): ?>
            <div class="col-md-3">
            	<?php dynamic_sidebar( $sidebar ); ?>
            </div>
			<?php endif; ?>
            
          </div>
        </div>
      </div>
    </div>
</section>
<?php get_footer();?>