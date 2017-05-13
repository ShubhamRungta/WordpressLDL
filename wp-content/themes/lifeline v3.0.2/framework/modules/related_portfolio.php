<?php $query = new WP_Query(array('post_type'=>'bistro_portfolio', 'showposts'=>4, 'tax_query' => array(array('taxonomy' => 'portfolio_category','field' => 'id','terms' => wp_get_post_terms( get_the_ID(), 'portfolio_category', array('fields'=>'ids'))) ))); //printr($query);?>					
<h2 class="page-header"><span><?php _e('Related Portfolio Items', SH_NAME); ?></span></h2>
<div class="sidebar-line"><span></span></div>
<ul class="thumbnails">
    <?php while( $query->have_posts() ): $query->the_post(); ?>
    <li class="span3">
        <div class="thumbnail"> 
        	<?php if( has_post_thumbnail() ): ?>
            <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
            	<?php the_post_thumbnail(array(271, 198), array('class'=>'img-polaroid') ); ?>
            </a>
            <?php endif; ?>
            <div class="caption">
                <h3 class="h5"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
            </div>
        </div>
    </li>
    <?php endwhile; ?>
    <?php wp_reset_query(); ?>
</ul>
