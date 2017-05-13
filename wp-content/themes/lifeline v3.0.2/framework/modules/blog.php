<?php while( have_posts() ): the_post(); ?>
    <article class="post row-fluid">
        <div class="span5 blog-img">
            <div class="wdt-product">
                <div class="wdt-products-wrapper">
                    <div class="wdt-product active show"> 
                    	<a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>"> 
                        	<?php the_post_thumbnail( 'blog-listing' ); ?>
						</a>
                        <ul class="post-meta">
                            <li><i class="icon-fixed-width icon-user"></i> <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?> " class="url fn"><?php the_author(); ?></a></li>
                            <li><i class="icon-fixed-width icon-calendar"></i> <?php echo get_the_date(); ?></li>
                            <li><i class="icon-fixed-width icon-comments"></i> <a href="<?php the_permalink(); ?>#comments"><?php echo comments_number(); ?></a></li>
                        </ul>
                        <div class="wdt-overlay zoom-hover"><span class="amount zoom"><i class="icon-link"></i></span></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="span7">
            <h2 class="post-title"><a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
            <?php the_excerpt(); ?>
            <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="read-more"><?php _e('read more', SH_NAME); ?> &rarr;</a> 
		</div>
    </article>
<?php endwhile; ?>