<?php 


	

	sh_custom_header();

	global $post_type ;

	$settings  = get_post_meta(get_the_ID(), '_page_settings', true);

	$sidebar = sh_set( $settings, 'sidebar') ? sh_set( $settings, 'sidebar' ) : '';

	$col_class = sh_set( $settings, 'sidebar') ? 'col-md-9': '';

	$paged = get_query_var('paged');

	$theme_options = get_option(SH_NAME);

	$section_class = (sh_set($settings , 'header' )== 'true'  ) ? 'inner-page' : '' ;

?>

<?php if(sh_set($settings , 'header' ) == 'true') : ?> 

	<?php if( sh_set($settings , 'top_image') ): ?>

        <div class="top-image"> <img src="<?php echo sh_set($settings , 'top_image'); ?>" alt="" /></div>

    <?php else: ?>

        <div class="no-top-image"></div>

    <?php endif; ?>

<?php endif; ?>



<section class="<?php echo $section_class; ?>">

<?php if(sh_set($settings , 'header' )== 'true') : ?>

    <div class="container">

		<div class="page-title">

			<?php echo sh_get_title( get_the_title(), 'h1', 'span', FALSE );?>

		</div>

    </div>

<?php endif; ?>



<div class="container"><div class="row">

        <div class="left-content  <?php echo $col_class ;?>">

             <?php while( have_posts() ): the_post();?>

             <?php 

			 		if( has_post_thumbnail() ):

					 	the_post_thumbnail( '270x155',  array( 'class' => 'page_thumb' ) );

					endif;

			 ?>  

                  <?php the_content(); ?>

             <?php endwhile; ?>

        </div>

        <?php if($sidebar) : ?>

        <div class="sidebar col-md-3 pull-right">

            <?php dynamic_sidebar($sidebar); ?>

        </div>

    </div>

</div>

<?php endif; ?>

</section>

<?php get_footer(); ?>