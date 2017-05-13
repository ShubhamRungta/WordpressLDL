<?php $t = $GLOBALS['_sh_base'];

$query = '';
$query = new WP_Query( array('post_type' => 'bistro_service', 'showposts'=>4) ); //printr($query);?>

<?php if( $query->have_posts()):?>
<div class="services">

	<h2 class="widget-title"><span><?php _e('Services', SH_NAME); ?></span></h2>
    <div class="sidebar-line"><span></span></div>
    
    <div class="row-fluid">
    	
		<?php while( $query->have_posts()): $query->the_post(); ?>
            <div class="span3">
                <div class="box">
                    <?php $meta = $t->get_cache('_bistro_bistro_service_settings', 'postmeta');//print_r($meta);//get_post_meta(get_the_ID(), '_bistro_bistro_service_settings', true); ?>
                    <span class="icon featured-icon icon-<?php echo _font_awesome(sh_set($meta, 'font_awesome'));?>"></span>
                    <h2><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
                    <p><?php the_excerpt(); ?></p>
            	</div>
            </div>
        <?php endwhile; ?>

    </div>
    
</div>
<?php endif; 
wp_reset_query();
?>

