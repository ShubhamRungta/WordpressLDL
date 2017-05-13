<?php 
sh_custom_header();
$Settings = get_option(SH_NAME); 
$PostSettings = get_post_meta( get_the_ID(), '_'.sh_set($post, 'post_type').'_settings', true); 
$sidebar = sh_set( $PostSettings, 'sidebar') ? sh_set( $PostSettings, 'sidebar' ) : '';
$col_class = sh_set( $PostSettings, 'sidebar') ? 'col-md-9' : 'col-md-12';
$sidebar_position = (sh_set($PostSettings , 'sidebar_pos') == 'left')? 'switch' : '' ;
$benifits = explode( ',' , sh_set($PostSettings , 'benifits')); 
?>
<div class="top-image"> <img src="<?php echo sh_set($PostSettings , 'top_image'); ?>" alt="" /></div>
<!-- Page Top Image -->
<section class="inner-page <?php echo $sidebar_position ;?>">
    <div class="container">
		<div class="row">
			<div class="left-content <?php echo $col_class; ?>">	
            <?php if(have_posts()): while(have_posts()): the_post(); ?>
				<div class="single-service">
					<span><i class="<?php echo sh_set($PostSettings , 'font_awesome'); ?>"></i></span>
					<h2><?php the_title(); ?></h2>
                    <?php the_content(); ?>
					<div class="benifits">
						<h4><?php _e("BENEFITS:" , SH_NAME); ?></h4>
						<ul>
                        <?php foreach($benifits as $b): ?>
							<li><i class="icon-check"></i><?php echo $b ; ?></li>
						<?php endforeach ; ?>
						</ul>
					</div>
				</div>
            <?php  endwhile ; endif; ?>
			</div>
			<?php if($sidebar): ?>
			<div class="sidebar col-md-3">
				<?php dynamic_sidebar($sidebar); ?>
			</div>
            <?php endif; ?>
		</div>
	</div>
</section> 
<section>
	<div class="container">
		<div class="row">
			<div class="block"></div>
			<div class="col-md-12">
				<div class="sec-heading">
					<h2><strong><?php _e("RELATED" , SH_NAME); ?> </strong><?php _e("SERVICES" , SH_NAME); ?></h2>
				</div>			
			</div>
			<div class="services">
			<?php $args = array('post_type'=>'dict_services' , 'posts_per_page'=> 6) ; 
				  $services = get_posts($args);
				  foreach($services as $service):	
				  $service_meta = get_post_meta(sh_set($service , 'ID'), '_dict_services_settings' , true); 
				  ?>
					<div class="col-md-2">
						<div class="box">
							<i class="<?php echo sh_set($service_meta , 'font_awesome'); ?>"></i>
							<h4><a href="<?php echo get_permalink(sh_set($service , 'ID')); ?>"><?php echo sh_set($service , 'post_title'); ?></a></h4>
						</div>
					</div>
			<?php endforeach; ?>	
			</div>
		</div>
	</div>
</section>
<?php get_footer(); ?>