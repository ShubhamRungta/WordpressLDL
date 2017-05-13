<?php


/** A function to fetch the categories from wordpress */
function sh_get_categories($arg = false)

{

	global $wp_taxonomies;

	if( ! empty($arg['taxonomy']) && ! isset($wp_taxonomies[$arg['taxonomy']]))

	{

		register_taxonomy( $arg['taxonomy'], 'sh_'.$arg['taxonomy']);

	}	

	$categories = get_categories($arg);

	$cats = array();

	$cat[] = __('All Categories', SH_NAME);

	foreach($categories as $category)

	{

		$cats[$category->term_id] = $category->name;

	}

	return $cats;

}

function sh_excerpt($pos, $limit = 127)
{
	$string = is_object( $pos ) ? do_shortcode( sh_set( $pos, 'post_content' ) ) : $pos;

	return sh_character_limit( $limit, strip_tags( $string ) );
}

function sh_get_sidebars()
{
	global $wp_registered_sidebars;

	$sidebars = !($wp_registered_sidebars) ? get_option('wp_registered_sidebars') : $wp_registered_sidebars;
	
	$data = array('' => __('No Sidebar', SH_NAME));
	foreach( (array)$sidebars as $sidebar)
	{
		$data[sh_set($sidebar, 'id')] = sh_set($sidebar, 'name');
	}
	return $data;
}


if ( ! function_exists('character_limiter'))
{
	function character_limiter($str, $n = 500, $end_char = '&#8230;', $allowed_tags = false)
	{
		if($allowed_tags) $str = strip_tags($str, $allowed_tags);
		if (strlen($str) < $n)	return $str;
		$str = preg_replace("/\s+/", ' ', str_replace(array("\r\n", "\r", "\n"), ' ', $str));

		if (strlen($str) <= $n) return $str;

		$out = "";
		foreach (explode(' ', trim($str)) as $val)
		{
			$out .= $val.' ';
			
			if (strlen($out) >= $n)
			{
				$out = trim($out);
				return (strlen($out) == strlen($str)) ? $out : $out.$end_char;
			}		
		}
	}
}


function get_social_icons()
{
	$t = $GLOBALS['_sh_base'];
	$options = $t->alloption('wp_bistro');//printr($options);
	$icons = array('facebook'=>__('Like us on Facebook', SH_NAME), 'twitter'=>__('Follow us on Twitter', SH_NAME), 'google-plus'=>__('Circle Us on Google Plus', SH_NAME), 'linkedin'=>__('Follow us on Linkedin', SH_NAME), 'xing'=>__('Follow us on Xing', SH_NAME), 'pinterest'=>__('Follow us on Pinterest', SH_NAME));			
	if( $options ):?>
    <ul class="social">
    	<?php foreach( $icons as $i => $str ): ?>
        	<?php if( $url = sh_set( $options, $i ) ): ?>
        		<li><a href="<?php echo $url; ?>" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="<?php echo $str; ?>"><i class="icon-<?php echo $i; ?>"></i></a></li>
        	<?php endif; ?>
        <?php endforeach; ?>
    </ul>
    <?php endif;
	
}

function sh_get_posts_array( $post_type = 'post' )
{
	global $wpdb;

	$res = $wpdb->get_results( "SELECT `ID`, `post_title` FROM `" .$wpdb->prefix. "posts` WHERE `post_type` = '$post_type' AND `post_status` = 'publish' ", ARRAY_A );
	$return = array();
	foreach( $res as $r) $return[sh_set($r, 'ID')] = sh_set($r, 'post_title');
	
	return $return;
}


if( !function_exists( 'bistro_slug' ) )
{
	function bistro_slug( $string )
	{
		$string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
		return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
	}
}

function get_the_breadcrumb()
{
	global $_webnukes;
	$queried_object = get_queried_object();
	
	$breadcrumb = '';

	if ( ! is_home())
	{
		$breadcrumb .= '<li><a href="'.home_url().'">'.__('Home', SH_NAME).'</a></li>';
		
		/** If category or single post */
		if(is_category())
		{
			$breadcrumb .= '<li><span class="divider">/</span><a href="'.get_category_link(get_query_var('cat')).'">'.single_cat_title('', FALSE).'</a></li>';
		}
		elseif(is_tax())
		{
			$breadcrumb .= '<li><span class="divider">/</span><a href="'.get_term_link($queried_object).'">'.$queried_object->name.'</a></li>';
		}
		elseif(is_page()) /** If WP pages */
		{
			global $post;
			if($post->post_parent)
			{
                $anc = get_post_ancestors($post->ID);
                foreach($anc as $ancestor)
				{
                    $breadcrumb .= '<li><span class="divider">/</span><a href="'.get_permalink($ancestor).'">'.get_the_title($ancestor).'</a></li>';
                }
				$breadcrumb .= '<li><span class="divider">/</span>'.get_the_title($post->ID).'</li>';
				
            }else $breadcrumb .= '<li><span class="divider">/</span><a href="'.get_permalink().'">'.get_the_title().'</a></li>';
		}
		elseif (is_singular())
		{
			if($category = wp_get_object_terms(get_the_ID(), array('category', 'wpsc_product_category', 'portfolio_category')))
			{
				if( !is_wp_error($category) )
				{
					$breadcrumb .= '<li><span class="divider">/</span><a href="'.get_term_link(sh_set($category, '0')).'">'.sh_set( sh_set($category, '0'), 'name').'</a></li>';
					$breadcrumb .= '<li><span class="divider">/</span><a href="'.get_permalink().'">'.get_the_title().'</a></li>';
				}
			}else{
				$breadcrumb .= '<li><span class="divider">/</span><a href="'.get_permalink().'">'.get_the_title().'</a></li>';
			}
		}
		elseif(is_tag()) $breadcrumb .= '<li><span class="divider">/</span><a href="'.get_term_link($queried_object).'">'.single_tag_title('', FALSE).'</a></li>'; /**If tag template*/
		elseif(is_day()) $breadcrumb .= '<li><span class="divider">/</span><a href="">'.__('Archive for ', SH_NAME).get_the_time('F jS, Y').'</a></li>'; /** If daily Archives */
		elseif(is_month()) $breadcrumb .= '<li><span class="divider">/</span><a href="' .get_month_link(get_the_time('Y'), get_the_time('m')) .'">'.__('Archive for ', SH_NAME).get_the_time('F, Y').'</a></li>'; /** If montly Archives */
		elseif(is_year()) $breadcrumb .= '<li><span class="divider">/</span><a href="'.get_year_link(get_the_time('Y')).'">'.__('Archive for ', SH_NAME).get_the_time('Y').'</a></li>'; /** If year Archives */
		elseif(is_author()) $breadcrumb .= '<li><a href="'. esc_url( get_author_posts_url( get_the_author_meta( "ID" ) ) ) .'">'.__('Archive for ', SH_NAME).get_the_author().'</a></li>'; /** If author Archives */
		elseif(is_search()) $breadcrumb .= '<li><span class="divider">/</span>'.__('Search Results for ', SH_NAME).get_search_query().'</li>'; /** if search template */
		elseif(is_404()) $breadcrumb .= '<li><span class="divider">/</span>'.__('404 - Not Found', SH_NAME).'</li>'; /** if search template */
		else $breadcrumb .= '<li><span class="divider">/</span><a href="'.get_permalink().'">'.get_the_title().'</a></li>'; /** Default value */
	}

	return '<ul class="breadcrumb">'.$breadcrumb.'</ul>';
}





function sh_register_user( $data )
{
	//printr($data);
	$user_name = sh_set( $data, 'user_login' );
	$user_email = sh_set( $data, 'user_email' );
	$user_pass = sh_set( $data, 'user_password' );
	$policy = sh_set( $data, 'policy_agreed');
	
	$user_id = username_exists( $user_name );
	$message = '<div class="alert-error" style="margin-bottom:10px;padding:10px"><h5>'.__('You must agreed the policy', SH_NAME).'</h5></div>';;
	if( !$policy ) $message = '';
	if ( !$user_id && email_exists($user_email) == false ) {

		if( $policy ){

			$random_password = ( $user_pass ) ? $user_pass : wp_generate_password( $length=12, $include_standard_special_chars=false );
			$user_id = wp_create_user( $user_name, $random_password, $user_email );
			if ( is_wp_error($user_id) && is_array( $user_id->get_error_messages() ) ) 
			{
				foreach($user_id->get_error_messages() as $message)	$message .= '<div class="alert-error" style="margin-bottom:10px;padding:10px"><h5>'.$message.'</h5></div>';
			}
			else $message = '<div class="alert-success" style="margin-bottom:10px;padding:10px"><h5>'.__('Registration Successful - An email is sent', SH_NAME).'</h5></div>';
		}
		
	} else {
		$message .= '<div class="alert-error" style="margin-bottom:10px;padding:10px"><h5>'.__('Username or email already exists.  Password inherited.', SH_NAME).'</h5></div>';
	}

	return $message;
}


function sh_comments_list($comment, $args, $depth)
{
	$GLOBALS['comment'] = $comment; ?>
        
    <li>
    	<div id="comment-<?php comment_ID();?>" class="comment">
        	
			<?php /** check if this comment author not have approved comments befor this */
            if($comment->comment_approved == '0' ) : ?>
                <em><?php /** print message below */
                _e( 'Your comment is awaiting moderation.', SH_NAME ); ?></em>
                <br />
            <?php endif; ?>
			<?php echo get_avatar( $comment, 73 ); ?>
            <?php /** check if thread comments are enable then print a reply link */
			comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] , 'before'=>'<div class="reply">' , 'after'=>'</div>' ) ) ); ?>
			<h5><?php comment_author(); ?> </h5>
            <i>
            	<span><?php comment_date( 'M' ); ?></span>
                <?php comment_date( 'd, Y' ); ?>
                <?php _e('at', SH_NAME); ?>
                <?php comment_date( 'h:i' ); ?>
                <span><?php comment_date( 'a' ); ?></span>
            </i>
            <p> <?php comment_text(); ?></p>
		</div>
        
    			
	<?php
}



/**
 * Outputs a complete commenting form for use within a template.
 * Most strings and form fields may be controlled through the $args array passed
 * into the function, while you may also choose to use the comment_form_default_fields
 * filter to modify the array of default fields if you'd just like to add a new
 * one or remove a single field. All fields are also individually passed through
 * a filter of the form comment_form_field_$name where $name is the key used
 * in the array of fields.
 *
 * @since 3.0.0
 * @param array $args Options for strings, fields etc in the form
 * @param mixed $post_id Post ID to generate the form for, uses the current post if null
 * @return void
 */
function sh_comment_form( $args = array(), $post_id = null ) {
	if ( null === $post_id )
		$post_id = get_the_ID();
	else
		$id = $post_id;

	$commenter = wp_get_current_commenter();
	$user = wp_get_current_user();
	$user_identity = $user->exists() ? $user->display_name : '';

	$args = wp_parse_args( $args );
	if ( ! isset( $args['format'] ) )
		$args['format'] = current_theme_supports( 'html5', 'comment-form' ) ? 'html5' : 'xhtml';

	$req      = get_option( 'require_name_email' );
	$aria_req = ( $req ? " aria-required='true'" : '' );
	$html5    = 'html5' === $args['format'];
	$fields   =  array(
		'author' => '<label>' . __( 'Full Name', SH_NAME  ) . ( $req ? ' <span>*</span>' : '' ) . '</label> ' .
		            '<input class="form-control input-field" name="author"  type="text" value="' . esc_attr( $commenter['comment_author'] ).'"' . $aria_req . ' />',
		'email'  => '<label>' . __( 'Email Address', SH_NAME  ) . ( $req ? ' <span>*</span>' : '' ) . '</label> ' .
		            '<input class="form-control input-field" id="email" name="email" ' . ( $html5 ? 'type="email"' : 'type="text"' ) . ' value="' . esc_attr(  $commenter['comment_author_email'] ) . '"'. $aria_req . ' />',
		'url'    => '<label for="url">' . __( 'Website', SH_NAME ) . '</label> ' .
		            '<input class="form-control input-field" id="url" name="url" ' . ( $html5 ? 'type="url"' : 'type="text"' ) . ' value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" />',
		
	);

	$required_text = sprintf( ' ' . __('Required fields are marked %s', SH_NAME ), '<span class="required">*</span>' );
	$defaults = array(
		'fields'               => apply_filters( 'comment_form_default_fields', $fields ),
		'comment_field'        => '<label>' . _x( 'Message', 'noun', SH_NAME  ) . '</label><textarea class="form-control input-field" rows="7" name="comment"></textarea>',
		'must_log_in'          => '<p class="must-log-in">' . sprintf( __( 'You must be <a href="%s">logged in</a> to post a comment.' ), wp_login_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ) . '</p>',
		'logged_in_as'         => '<p class="logged-in-as">' . sprintf( __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>', SH_NAME  ), get_edit_user_link(), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ) . '</p>',
		'comment_notes_before' => '<h3 class="sub-head">'.__("Send Us Message" , SH_NAME).'</h3><p><span>*</span></p>',
		'comment_notes_after'  => '<p class="form-allowed-tags">' . sprintf( __( 'You may use these <abbr title="HyperText Markup Language">HTML</abbr> tags and attributes: %s', SH_NAME  ), ' <code>' . allowed_tags() . '</code>' ) . '</p>',
		'id_form'              => 'commentform',
		'id_submit'            => 'submit',
		'title_reply'          => __( '<i class="theme-icon big comment-icon"></i>Leave a Reply', SH_NAME  ),
		'title_reply_to'       => __( 'Leave a Reply to %s', SH_NAME  ),
		'cancel_reply_link'    => __( 'Cancel reply', SH_NAME  ),
		'label_submit'         => __( 'SEND MESSAGE', SH_NAME  ),
		'format'               => 'xhtml',
	);

	$args = wp_parse_args( $args, apply_filters( 'comment_form_defaults', $defaults ) );

	?>
    
    
		<?php if ( comments_open( $post_id ) ) : ?>
			<?php do_action( 'comment_form_before' ); ?>
			<div id="respond" class="comment-respond message form">
				
               <h4 id="reply-title" class="comment-reply-title"><?php comment_form_title( $args['title_reply'], $args['title_reply_to'] ); ?> <small><?php cancel_comment_reply_link( $args['cancel_reply_link'] ); ?></small></h4>
				
				<?php if ( get_option( 'comment_registration' ) && !is_user_logged_in() ) : ?>
					<?php echo $args['must_log_in']; ?>
					<?php do_action( 'comment_form_must_log_in_after' ); ?>
				<?php else : ?>
					<form action="<?php echo site_url( '/wp-comments-post.php' ); ?>" method="post" id="<?php echo esc_attr( $args['id_form'] ); ?>" class="comment-form"<?php echo $html5 ? ' novalidate' : ''; ?>>
						<?php do_action( 'comment_form_top' ); ?>
						<?php if ( is_user_logged_in() ) : ?>
							<?php 
							 echo $args['comment_notes_before'];
							echo apply_filters( 'comment_form_logged_in', $args['logged_in_as'], $commenter, $user_identity ); ?>
							<?php do_action( 'comment_form_logged_in_after', $commenter, $user_identity ); ?>
						<?php else : ?>
							<?php echo $args['comment_notes_before']; ?>
							<?php
							do_action( 'comment_form_before_fields' );
							foreach ( (array) $args['fields'] as $name => $field ) {
								echo apply_filters( "comment_form_field_{$name}", $field ) . "\n";
							}
							do_action( 'comment_form_after_fields' );
							?>
						<?php endif; ?>
						<?php echo apply_filters( 'comment_form_field_comment', $args['comment_field'] ); ?>
						<?php echo $args['comment_notes_after']; ?>
						<p class="form-submit">
							<button class="submit-btn" name="submit" type="submit" id="<?php echo esc_attr( $args['id_submit'] ); ?>" ><?php echo esc_attr( $args['label_submit'] ); ?></button>
							<?php comment_id_fields( $post_id ); ?>
						</p>
						<?php do_action( 'comment_form', $post_id ); ?>
					</form>
				<?php endif; ?>
			</div><!-- #respond -->
			<?php do_action( 'comment_form_after' ); ?>
		<?php else : ?>
			<?php do_action( 'comment_form_comments_closed' ); ?>
		<?php endif; ?>
	<?php
}


function sh_contact_form_submit()
{
	if( !count( $_POST ) ) return;
	
	
	_load_class( 'validation', 'helpers', true );
	$t = &$GLOBALS['_sh_base'];//printr($t);
	$settings = get_option('wp_bistro');

	/** set validation rules for contact form */
	$t->validation->set_rules('contact_name','<strong>'.__('Name', SH_NAME).'</strong>', 'required|min_length[4]|max_lenth[30]');
	$t->validation->set_rules('contact_email','<strong>'.__('Email', SH_NAME).'</strong>', 'required|valid_email');
	$t->validation->set_rules('contact_message','<strong>'.__('Message', SH_NAME).'</strong>', 'required|min_length[5]');
	if( sh_set($settings, 'captcha_status') == 'on')
	{
		if( sh_set( $_POST, 'contact_captcha') !== sh_set( $_SESSION, 'captcha'))
		{
			$t->validation->_error_array['captcha'] = __('Invalid captcha entered, please try again.', SH_NAME);
		}
	}
	
	$messages = '';
	
	if($t->validation->run() !== FALSE && empty($t->validation->_error_array))
	{
		
		$name = $t->validation->post('contact_name');
		$email = $t->validation->post('contact_email');
		$message = $t->validation->post('contact_message');
		$contact_to = ( sh_set($settings, 'contact_email') ) ? sh_set($settings, 'contact_email') : get_option('admin_email');
		
		$headers = 'From: '.$name.' <'.$email.'>' . "\r\n";
		wp_mail($contact_to, __('Contact Us Message', SH_NAME), $message, $headers);
		
		$message = sh_set($settings, 'success_message') ? $settings['success_message'] : sprintf( __('Thank you <strong>%s</strong> for using our contact form! Your email was successfully sent and we will be in touch with you soon.',SH_NAME), $name);

		$messages = '<div class="alert alert-success">
						<p class="title">'.__('SUCCESS! ', SH_NAME).$message.'</p>
					</div>';
							
	}else
	{
		 if( is_array( $t->validation->_error_array ) )
		 {
			 foreach( $t->validation->_error_array as $msg )
			 {
				 $messages .= '<div class="alert alert-error">
									<p class="title">'.__('Error! ', SH_NAME).$msg.'</p>
								</div>';
			 }
		 }
	}
	
	return $messages;
}


function sh_blog_excerpt_more( $more ) {
	return '';
}
add_filter('excerpt_more', 'sh_blog_excerpt_more');



function _the_pagination($args = array(), $echo = 1)
{
	
	global $wp_query;
	
	$default =  array(
	 'base' => str_replace( 99999, '%#%', esc_url( get_pagenum_link( 99999 ) ) ),
	 'format' => '?paged=%#%', 
	 'current' => max( 1, get_query_var('paged') ),
	 'total' => $wp_query->max_num_pages, 
	 'next_text' => __('<i class="icon-angle-right"></i>', SH_NAME), 
	 'prev_text' => __('<i class="icon-angle-left"></i>', SH_NAME), 
	 'type'=>'list');
						
	$args = wp_parse_args($args, $default);		
	?>
	<?php	
	$pagination = '<div class="pagination-area">'.paginate_links($args).'</div>';
	$pagination =  str_replace( "<ul class='page-numbers'>", '<ul class="pagination">', $pagination );
	
	if(paginate_links(array_merge(array('type'=>'array'),$args)))
	{
		if($echo) echo $pagination;
		return $pagination;
	}
}
function sh_include_file( $path, $args )
{
	if( file_exists( get_template_directory().DIRECTORY_SEPARATOR.$path ) ) 
	include( get_template_directory().DIRECTORY_SEPARATOR.$path );
}


function sh_create_donation_table()
{
	global $wpdb;

	$query = "CREATE TABLE IF NOT EXISTS `".$wpdb->prefix."donation` (
			  `id` int(11) NOT NULL AUTO_INCREMENT,
			  `user_id` varchar(20),
			  `transID` varchar(30) NOT NULL,
			  `status` varchar(20) NOT NULL,
			  `total` float NOT NULL,
			  `donalID` varchar(30) NOT NULL,
			  `donalName` varchar(120) NOT NULL,
			  `donalEmail` varchar(240) NOT NULL,
			  `note` text NOT NULL,
			  `data` text NOT NULL,
			  `date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
			  PRIMARY KEY (`id`)
			) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1";
	require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
	dbDelta($query);
}

function sh_blog_list_view()
{
	while( have_posts() ): the_post(); ?>
    
    <div class="blog-list">
        <div class="blog-list-img">
            <?php the_post_thumbnail( '770x264' ); ?>
            <div class="grid-hover-icon"><a title="" href="<?php the_permalink(); ?>"><i class="theme-icon chain"></i></a></div>
        </div><!-- Blog List Image -->

        <div class="blog-list-details">
            <div class="blog-post-meta">
                <div class="blog-list-date">
                    <span><?php echo get_the_date('d'); ?></span> <?php echo get_the_date('M'); ?> <span><?php echo get_the_date('Y'); ?></span>
                </div>
                <div class="blog-post-views">02 views</div>
            </div>
            <div class="blog-list-desc">
                <h3><a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                <ul>
                    <li><i class="theme-icon post-cat"></i>Posted in:  <?php the_category(); ?></li>
                    <li><i class="theme-icon comments"></i><a title="" href="#"><?php comments_number(); ?></a></li>
                </ul>
                <?php the_excerpt(); ?>
                <a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>" class="continue">Continue Reading</a>
            </div>
        </div><!-- Blog List Details -->
    </div>
    
    <?php endwhile;
}


function sh_blog_grid_view()
{
	while( have_posts() ): the_post();?>
    
    <div class="grid-view span4">
        <div class="grid-view-img">
            <?php the_post_thumbnail( '370x195' ); ?>
            <div class="grid-hover-icon"><a title="" href="<?php the_permalink(); ?>"><i class="theme-icon chain"></i></a></div>
        </div>
        <div class="post-date"><i class="theme-icon calender"></i><?php echo get_the_date(); ?></div>
        <h3><a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
        <span class="posted">Posted in; <?php the_category(); ?> </span>
        <?php the_excerpt(); ?>
        <a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>" class="continue"><?php _e('Continue Reading', SH_NAME);?></a>
    </div>
    
    <?php endwhile;
}


function sh_social_sharing()
{
	?>
    <ul>
        <li><a target="_blank" title="<?php _e('Share on Twitter', SH_NAME); ?>" href="https://twitter.com/intent/tweet?text=<?php the_title(); ?>&url=<?php echo urlencode(get_permalink()); ?>&related="><i class="theme-icon twitter"></i></a></li>
        <li><a target="_blank" title="<?php _e('Share on Facebook', SH_NAME); ?>" href="http://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(get_permalink()); ?>&display=popup"><i class="theme-icon facebook"></i></a></li>
        <li><a target="_blank" title="<?php _e('Share on Google Plus', SH_NAME); ?>" href="https://plus.google.com/share?url=<?php echo urlencode(get_permalink()); ?>&t=<?php the_title(); ?>"><i class="theme-icon gplus"></i></a></li>
        <li><a target="_blank" title="<?php _e('Share on Linkedin', SH_NAME); ?>" href="http://www.linkedin.com/shareArticle?mini=true&url=<?php echo urlencode(get_permalink()); ?>&title=<?php the_title(); ?>&ro=false&summary=<?php the_excerpt(); ?>&source="><i class="theme-icon linkedin"></i></a></li>
        <li><a target="_blank" title="<?php _e('Share on Vimeo', SH_NAME); ?>" href="http://vimeo.com"><i class="theme-icon vimeo"></i></a></li>
    </ul>
    <?php 
}


function sh_grab_video( $url, $opt )
{
	if( !esc_url($url) ) return;
	//$opt = get_post_meta( get_the_ID(), '_dictate_gal_videos', true );
	$key = md5( $url );
	
	if( sh_set( $opt, $key ) ) return sh_set( $opt, $key );
	
	$grab = new SH_grab( $url );
	$res = $grab->result();
	
	if( $res ) {
		$opt[$key] = sh_set( $res, '0' );
		update_post_meta( get_the_ID(), '_dictate_gal_videos', $opt );
		return sh_set( $res, '0' );
	}
	return false;
}

function sh_post_views()
{
	global $post;
	$id = sh_set($post, 'ID');
	if( !$id ) return;
	
	$meta = get_post_meta( $id, '_dict_post_views', true);

	$views = ( $meta ) ? $meta + 1 : 1;
	
	update_post_meta( $id, '_dict_post_views',  (int)$views ); 
	
	return $views;
}

function sh_google_fonts()
{

	$options = get_option( 'sh_google_fonts_array' );

	if( ! $options ) {
		
		$fp = @fopen( get_template_directory().'/framework/resource/default_fonts', 'r');
		if( !$fp ) return array();
		$read = fread($fp, 1024000);//printr(json_decode($read));
		
	}else return $options;
	

	$return = array();
	$style = array();
	
	if( $items = sh_set( json_decode($read), 'items' ) )
	{
		foreach( $items as $item )
		{
			if( $styles = sh_set( $item, 'variants') ){
				foreach( $styles as $s ) $style[$s] = $s;
			}
			$return[sh_set( $item, 'family' )] = sh_set( $item, 'family' );
		}
	}
	update_option( 'sh_google_fonts_array', array('family'=>$return, 'style'=>$style ) );
	return array('family'=>$return, 'style'=>$style );
}

function sh_font_awesome( $code = false )
{
	$pattern = '/\.(icon-(?:\w+(?:-)?)+):before\s+{\s*content:\s*"(.+)";\s+}/';
	$subject = file_get_contents(get_template_directory().'/font-awesome/css/font-awesome.css');
	
	preg_match_all($pattern, $subject, $matches, PREG_SET_ORDER);
	
	$icons = array();

	foreach($matches as $match){
		$value = str_replace( 'icon-', '', $match[1] );
		if( $code ) $icons[$match[1]] = stripslashes($match[2]);
		else $icons[$match[1]] = ucwords(str_replace('-', ' ', $value));//$match[2];
	}
	
	//$icons = var_export($icons, TRUE);
	//$icons = stripslashes($icons);
	
	//printr($icons);
	return $icons;
}

function sh_get_font_settings( $FontSettings = array(), $StyleBefore = '', $StyleAfter = '' )
{
	$i = 1;
	$settings = get_option( SH_NAME );
	$Style = '';
	foreach( $FontSettings as $k => $v )
	{
		$Style .= ( sh_set( $settings, $k )  ) ? $v.':'.sh_set( $settings, $k ).' !important ;': '';
	}
	return ( !empty( $Style ) ) ? $StyleBefore.$Style.$StyleAfter: '';
}

function sh_theme_color_scheme( $cookie = false )
{
	$swithc = sh_set(get_option(SH_NAME),'dep_radio');
	$styles = sh_set(get_option(SH_NAME), 'theme_general_color_scheme');
	$theme_general_color_scheme = sh_set(get_option(SH_NAME), 'theme_color_scheme');
	if( $theme_general_color_scheme && $swithc == 'opt2' ) {		
		//$_COOKIE['sh_color_scheme'] = isset( $_COOKIE['sh_color_scheme'] ) ? $_COOKIE['sh_color_scheme'] : $theme_general_color_scheme;
		echo '<link rel="stylesheet" type="text/css" href="'.get_template_directory_uri().'/css/'.$theme_general_color_scheme.'.css" />';
	
	}else if( $styles && $swithc == 'opt1' ) {
		$_COOKIE['sh_color_scheme'] = isset( $_COOKIE['sh_color_scheme'] ) ? $_COOKIE['sh_color_scheme'] : $styles;

		$custom_style = ( $cookie && isset( $_COOKIE['sh_color_scheme'] ) ) ? $_COOKIE['sh_color_scheme'] : $styles;
		$content = @file_get_contents(get_template_directory_uri().'/css/color.css');
		
		if( $custom_style ){
			
			
			$replace = str_replace('#04ade6', $custom_style, $content );
			$replace = str_replace('#1bb2e5', $custom_style, $replace);
			$replace = ( $custom_style ) ? $replace : $content ;
		}else $replace = $content;
		
		$output = "\n".'<style title="sh_color_scheme">'.$replace.'</style>';
		return $output ; 
	}
}

function sh_header_settings($settings = array())
{
	//$settings = get_option( SH_NAME );
	$settings = ( $settings ) ? $settings : get_option( SH_NAME );
	
	$return = array();

	$return['responsive'] = ( sh_set( $settings, 'layout_responsive_options' ) == 'true' ) ? true : false;
	
	$return['boxed'] = '';
	
	if( (is_home() || is_front_page()) && sh_set( $settings, 'home_page_boxed_layout_status') == 'true')
		$return['boxed'] = 'boxed';
	elseif(sh_set( $settings, 'boxed_layout_status') == 'true')
		$return['boxed'] = 'boxed';	
	
	if( sh_set($settings, 'layout_responsive_width') && sh_set($return, 'boxed') ) $return['width'] = ' width:'.sh_set($settings, 'layout_responsive_width').'px;'; 
	
	$return['pattern_image'] = ( sh_set( $return, 'boxed' ) && sh_set( $settings, 'layout_patron_image' ) ) ? 'background-image:url('.sh_set( $settings, 'layout_patron_image' ).');' : '';
	
	$return['pattern'] = ( sh_set( $return, 'boxed' ) && !sh_set( $settings, 'layout_patron_image' ) ) ? sh_set( $settings, 'layout_sidebar_patron', 'bg-body1' ) : '';
	
	return $return;
}

function sh_ajax_login(){
	
	wp_register_script('ajax-login-script', get_template_directory_uri() . '/js/ajax-login-script.js', '','', true); 
    wp_enqueue_script('ajax-login-script');

    wp_localize_script( 'ajax-login-script', 'ajax_login_object', array( 
        'ajaxurl' => admin_url( 'admin-ajax.php' ),
        'redirecturl' => $_SERVER['REQUEST_URI'],
        'loadingmessage' => __('Sending user info, please wait...', SH_NAME)
    ));

    // Enable the user with no privileges to run ajax_login() in AJAX
    add_action( 'wp_ajax_nopriv_ajaxlogin', 'ajax_login' );
}

// Execute the action only if the user isn't logged in
///if (!is_user_logged_in()) {
    add_action('init', 'sh_ajax_login');
//}

function ajax_login(){

    // First check the nonce, if it fails the function will break
    check_ajax_referer( 'ajax-login-nonce', 'security' );

    // Nonce is checked, get the POST data and sign user on
    $info = array();
    $info['user_login'] = $_POST['username'];
    $info['user_password'] = $_POST['password'];
    $info['remember'] = true;

    $user_signon = wp_signon( $info, false );
    if ( is_wp_error($user_signon) ){
        echo json_encode(array('loggedin'=>false, 'message'=>__('Wrong username or password.')));
    } else {
        echo json_encode(array('loggedin'=>true, 'message'=>__('Login successful')));
    }

    die();
}

function sh_get_paypal_button()
{
	$settings = get_option(SH_NAME);
	$paypal = $GLOBALS['_sh_base']->donation;
	$return_url = (is_home()) ? home_url() : $_SERVER['HTTP_REFERER'];
	$sh_currency_code = sh_set( $settings, 'currency_code', 'USD' );
	$single_page = (sh_set($_SESSION, 'sh_causes_page')) ? sh_set($_SESSION, 'sh_causes_page') : false;
		
	if(isset($_POST['period']) &&  $_POST['period'] == 'One Time' ){
		if($single_page == true){
			echo $paypal->button(array('currency_code'=>$sh_currency_code,'item_name'=>get_bloginfo('name'), 'amount'=>30, 'return'=>sh_set($_SESSION, 'sh_causes_url')));
		}else{
			echo $paypal->button(array('currency_code'=>$sh_currency_code,'item_name'=>get_bloginfo('name'), 'amount'=>30, 'return'=>$return_url));
		}
	}else{
		echo $paypal->recuring_payment(array('item_name'=>get_bloginfo('name'), 'amount'=>30, 'return'=>$return_url));
	}
	die();
}

add_action( 'wp_ajax_getbutton', 'sh_get_paypal_button' );
add_action( 'wp_ajax_nopriv_getbutton', 'sh_get_paypal_button' );


function sh_confirm_order()
{
	include(get_template_directory().'/framework/modules/pp_recurring/order_confirm.php');
	die();
}

add_action( 'wp_ajax_confirm_order', 'sh_confirm_order' );
add_action( 'wp_ajax_nopriv_confirm_order', 'sh_confirm_order' );

function sh_get_currencies()
{
	$currencies = array(
	'AUD' => 'Australian Dollar',
	'CAD' => 'Canadian Dollar',
	'EUR' => 'Euro',
	'GBP' => 'Pound Sterling',
	'JPY' => 'Japanese Yen',
	'USD' => 'U.S. Dollar',
	'NZD' => 'N.Z. Dollar',
	'CHF' => 'Swiss Franc',
	'HKD' => 'Hong Kong Dollar',
	'SGD' => 'Singapore Dollar',
	'SEK' => 'Swedish Krona',
	'DKK' => 'Danish Krone',
	'PLN' => 'Polish Zloty',
	'NOK' => 'Norwegian Krone',
	'HUF' => 'Hungarian Forint',
	'CZK' => 'Czech Koruna',
	'ILS' =>'Israeli New Sheqel',
	'MXN' => 'Mexican Peso',
	'BRL' => 'Brazilian Real',
	'MYR' => 'Malaysian Ringgit',
	'PHP' => 'Philippine Peso',
	'TWD' => 'New Taiwan Dollar',
	'THB' => 'Thai Baht',
	'TRY' =>'Turkish Lira',
	);
	return $currencies;
}
		