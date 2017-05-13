<?php 

/** function widget($args, $instance) see @ WP_Widget::widget */
/** function update($new_instance, $old_instance) see @ WP_Widget::update */
/** function form($instance) see @ WP_Widget::form */

//People Reviews
class SH_people_reviews extends WP_Widget
{
	function __construct()
	{
		parent::__construct( /* Base ID */'PeopleReviews', /* Name */__('People Reviews',SH_NAME), array( 'description' => __('This widgtes is used to add People Reviews to Footer', SH_NAME ) ) );
	}

	function widget($args, $instance)
	{
		
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );
		$sub_title = apply_filters( 'widget_sub_title', $instance['sub_title'] );
		$number_of_reviews = apply_filters( 'widget_number_of_reviews', $instance['number_of_reviews'] );

		echo $before_widget;

		echo $before_title.'<strong><span>'.substr( $title, 0, 1 ).'</span>'.substr( $title, 1 ).'</strong> '.$sub_title.$after_title; 
		
		$Records = '';
		$args = array( 'post_type' => 'dict_testimonials', 'orderby' => 'date', 'order' => 'DESC', 'posts_per_page' => $number_of_reviews );
		$loop = new WP_Query( $args );
		
		if( $loop->have_posts()) : while( $loop->have_posts() ): $loop->the_post();
			
		$FirstLetter = substr( strip_tags( get_the_content() ), 0, 1 );
		$RemainingReviews = substr( strip_tags( get_the_content() ), 1 );

		$Settings = get_post_meta( get_the_ID(), '_dict_testimonials_settings', true );
		
		$Records .= '<li>
						<div class="review"> <i>'.$FirstLetter.'</i>
						  <p><span>'.substr( $FirstLetter, 1 ).'</span> '.$RemainingReviews.'</p>
						</div>
						<div class="from">
						  <h6>'.sh_set( $Settings, 'name' ).'</h6>
						  <span>'.sh_set( $Settings, 'designation' ).', '.sh_set( $Settings, 'location' ).'</span> </div>
					  </li>';
		endwhile; 
		
		endif;
		
		wp_reset_query();
		?>
            <div class="footer_carousel">
                <ul class="slides">
                    <?php echo $Records;?>
                </ul>
            </div>
            
            <script>
		 jQuery(document).ready(function($){
			if( $('.footer_carousel').length ){
			$('.footer_carousel').flexslider({
				animation: "slide",
				animationLoop: false,
				slideShow:false,
				controlNav: true,	
				maxItems: 1,
				pausePlay: false,
				mousewheel:false,
				start: function(slider){
				  $('body').removeClass('loading');
				}
			});
			}
		});
			</script>
		<?php echo $after_widget;
	}
	
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['sub_title'] = strip_tags($new_instance['sub_title']);
		$instance['number_of_reviews'] = $new_instance['number_of_reviews'];
		return $instance;
	}

	function form($instance)
	{
		$title = ($instance) ? esc_attr($instance['title']) : _e('People', SH_NAME);
		$sub_title = ($instance) ? esc_attr($instance['sub_title']) : __('Reviews', SH_NAME);
		$number_of_reviews = ($instance) ? esc_attr($instance['number_of_reviews']) : '' ;?>
        
        <p>
            <label for="<?php echo $this->get_field_id('title');?>"><?php _e('Title:', SH_NAME);?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title');?>" name="<?php echo $this->get_field_name('title');?>" type="text" value="<?php echo $title;?>" />
        </p>
         <p>
            <label for="<?php echo $this->get_field_id('sub_title');?>"><?php _e('Sub Title:', SH_NAME);?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('sub_title');?>" name="<?php echo $this->get_field_name('sub_title');?>" type="text" value="<?php echo $sub_title;?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('number_of_reviews');?>"><?php _e('Number Of Reviews:', SH_NAME);?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('number_of_reviews');?>" name="<?php echo $this->get_field_name('number_of_reviews');?>" type="text" value="<?php echo $number_of_reviews;?>" />
        </p>
        <?php 
	}
}

// Flicker Gallery
class SH_Flickr extends WP_Widget
{
	function __construct()
	{
		parent::__construct( /* Base ID */'SH_Flickr', /* Name */__('Flickr Feed',SH_NAME), array( 'description' => __('Fetch the latest feed from Flickr', SH_NAME )) );
	}
	
	function widget($args, $instance)
	{
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );
		$sub_title = apply_filters( 'widget_sub_title', $instance['sub_title'] );
		$flickr_id = apply_filters( 'widget_flickr_id', $instance['flickr_id'] );
		$number = apply_filters( 'widget_number', $instance['number'] );
	
		echo $before_widget;

		echo $before_title.'<strong><span>'.substr( $title, 0, 1 ).'</span>'.substr( $title, 1 ).'</strong> '.$sub_title.$after_title;
		
		$limit = ( $number ) ? $number : 9;?>
            <div class="flickr-images">
               <script type="text/javascript">
                    jQuery(document).ready(function($) {
                     $('.flickr-images').jflickrfeed({
                      limit: <?php echo $limit;?> ,
                      qstrings: {id: '<?php echo $instance['flickr_id']; ?>'},
                      itemTemplate: '<a href="{{link}}"><img src="{{image_s}}" alt="{{title}}" /></a>'
                     });
                    });
               </script>
            </div><?php
			
		echo $after_widget;
	}
	
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['sub_title'] = strip_tags($new_instance['sub_title']);
		$instance['flickr_id'] = $new_instance['flickr_id'];
		$instance['number'] = $new_instance['number'];
		
		return $instance;
	}
	
	function form($instance)
	{
		wp_enqueue_script('flickrjs');
		$title = ($instance) ? esc_attr($instance['title']) : __('Flicker', SH_NAME);
		$sub_title = ($instance) ? esc_attr($instance['sub_title']) : __('Feed', SH_NAME);
		$flickr_id = ($instance) ? esc_attr($instance['flickr_id']) : '';
		$number = ( $instance ) ? esc_attr($instance['number']) : 8;?>
		  
        <p>
            <label for="<?php echo $this->get_field_id('title');?>"><?php _e('Title:', SH_NAME);?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title');?>" name="<?php echo $this->get_field_name('title');?>" type="text" value="<?php echo $title;?>" />
        </p>
         <p>
            <label for="<?php echo $this->get_field_id('sub_title');?>"><?php _e('Sub Title:', SH_NAME);?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('sub_title');?>" name="<?php echo $this->get_field_name('sub_title');?>" type="text" value="<?php echo $sub_title;?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('flickr_id');?>"><?php _e('Flickr ID:', SH_NAME);?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('flickr_id');?>" name="<?php echo $this->get_field_name('flickr_id');?>" type="text" value="<?php echo $flickr_id;?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('number');?>"><?php _e('Number of Tweets:', SH_NAME);?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('number');?>" name="<?php echo $this->get_field_name('number');?>" type="text" value="<?php echo $number;?>" />
        </p>
        <?php 
	}
}

//Contact Us
class SH_Contact_US extends WP_Widget
{
	function __construct()
	{
		parent::__construct( /* Base ID */'ContactUs', /* Name */__('Contact Us',SH_NAME), array( 'description' => __('This widgtes is used to add Contact Us details to Footer', SH_NAME )) );
	}
	
	function widget($args, $instance)
	{
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );
		$sub_title = apply_filters( 'widget_sub_title', $instance['sub_title'] );
		$address = apply_filters( 'widget_address', $instance['address'] );
		$phone_no = apply_filters( 'widget_phone_no', $instance['phone_no'] );
		$email_id = apply_filters( 'widget_email_id', $instance['email_id'] );
		$web_address = apply_filters( 'widget_web_address', $instance['web_address'] );

		echo $before_widget;
		
		$TitleFirstLetter = substr( $title, 0, 1 );
		
		echo $before_title.'<strong><span>'.substr( $title, 0, 1 ).'</span>'.substr( $title, 1 ).'</strong> '.$sub_title.$after_title;?>
            <ul class="contact-details">
                <li>
                    <span><i class="icon-home"></i><?php _e("ADDRESS" , SH_NAME) ;?></span>
                    <p><?php echo $address;?></p>
                </li>
                <li>
                    <span><i class="icon-phone-sign"></i><?php _e("PHONE NO" , SH_NAME) ;?></span>
                    <p><?php echo $phone_no;?></p>
                </li>
                <li>
                    <span><i class="icon-envelope-alt"></i><?php _e("EMAIL ID" , SH_NAME) ;?></span>
                    <p><a href="mailto:<?php echo $email_id; ?>"><?php echo $email_id;?></a></p>
                </li>
                <li>
                    <span><i class="icon-link"></i><?php _e("WEB ADDRESS" , SH_NAME) ;?></span>
                    <p><a href="<?php echo $web_address; ?>"><?php echo $web_address;?></a></p>
                </li>
            </ul>
		<?php echo $after_widget;
	}
	
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['sub_title'] = strip_tags($new_instance['sub_title']);
		$instance['address'] = $new_instance['address'];
		$instance['phone_no'] = $new_instance['phone_no'];
		$instance['email_id'] = $new_instance['email_id'];
		$instance['web_address'] = $new_instance['web_address'];
		return $instance;
	}
	
	function form($instance)
	{
		$title = ($instance) ? esc_attr($instance['title']) : __('Contact', SH_NAME);
		$sub_title = ($instance) ? esc_attr($instance['sub_title']) : __('Us', SH_NAME);
		$address = ($instance) ? esc_attr($instance['address']) : '';
		$phone_no = ($instance) ? esc_attr($instance['phone_no']) : '';
		$email_id = ($instance) ? esc_attr($instance['email_id']) : '';
		$web_address = ($instance) ? esc_attr($instance['web_address']) : '';?>
        
        <p>
            <label for="<?php echo $this->get_field_id('title');?>"><?php _e('Title:', SH_NAME);?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title');?>" name="<?php echo $this->get_field_name('title');?>" type="text" value="<?php echo $title;?>" />
        </p>
         <p>
            <label for="<?php echo $this->get_field_id('sub_title');?>"><?php _e('Sub Title:', SH_NAME);?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('sub_title');?>" name="<?php echo $this->get_field_name('sub_title');?>" type="text" value="<?php echo $sub_title;?>" />
        </p>
        <p>    
            <label for="<?php echo $this->get_field_id('address');?>"><?php _e('Address:', SH_NAME);?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('address');?>" name="<?php echo $this->get_field_name('address');?>" type="text" value="<?php echo $address;?>" /> 
        </p>
        <p>    
            <label for="<?php echo $this->get_field_id('phone_no');?>"><?php _e('Phone Number:', SH_NAME);?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('phone_no');?>" name="<?php echo $this->get_field_name('phone_no');?>" type="text" value="<?php echo $phone_no;?>" /> 
        </p>
         <p>    
            <label for="<?php echo $this->get_field_id('email_id');?>"><?php _e('Email:', SH_NAME);?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('email_id');?>" name="<?php echo $this->get_field_name('email_id');?>" type="text" value="<?php echo $email_id;?>" /> 
        </p>
         <p>    
            <label for="<?php echo $this->get_field_id('web_address');?>"><?php _e('Website URL:', SH_NAME);?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('web_address');?>" name="<?php echo $this->get_field_name('web_address');?>" type="text" value="<?php echo $web_address;?>" />  
        </p>
        <?php 
	}
}

//News Letter Subscription
class SH_News_Letter_Subscription extends WP_Widget
{
	function __construct()
	{
		parent::__construct( /* Base ID */'NewsLetterSubscription', /* Name */__('News Letter Subscription',SH_NAME), array( 'description' => __('This widgtes is used to add news letter subscription form to Footer', SH_NAME )) );
	}
	
	function widget($args, $instance)
	{
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );
		$sub_title = apply_filters( 'widget_sub_title', $instance['sub_title'] );
		$text = apply_filters( 'widget_text', $instance['text'] );
		$rss_link = apply_filters( 'widget_rss_link', $instance['rss_link'] );
		$facebook_link = apply_filters( 'widget_facebook_link', $instance['facebook_link'] );
		$gplus_link = apply_filters( 'widget_gplus_link', $instance['gplus_link'] );
		$twitter_link = apply_filters( 'widget_twitter_link', $instance['twitter_link'] );
		$pinteres_link = apply_filters( 'widget_pinteres_link', $instance['pinteres_link'] );
		$ID = apply_filters( 'widget_ID', $instance['ID'] );
		?>

        <?php echo $before_widget ; ?>
        
        
        
        
        
        
          <form name="newletter_sub" method="post" action="http://feedburner.google.com/fb/a/mailverify" target="popupwindow">
            <div class="newsletter">
                <h4><strong><?php echo $title;?></strong> <?php echo $sub_title;?></h4>
                <p><?php echo $text;?></p>
                <input class="form-control" type="email"  name="email" value="" id="email" placeholder="<?php _e("domain@mail.com" , SH_NAME) ; ?>" />
                 <input type="hidden" id="uri" name="uri" value="<?php echo $ID; ?>">
				  <input type="hidden" value="en_US" name="loc">
            </div>
         
          <?php
          if( !empty( $rss_link ) || !empty( $facebook_link ) || !empty( $google_plus_link ) || !empty( $twitter_link ) || !empty( $pinteres_link ) )
		  {
			  ?>
              <ul class="social-bar">
                  <?php
                  echo ( !empty( $rss_link ) ) ? '<li><a href="'.$rss_link.'" title=""  target="_blank" ><img src="'.get_template_directory_uri().'/images/rss.jpg" alt="" /></a></li>': '';
				  echo ( !empty( $facebook_link ) ) ? '<li><a href="'.$facebook_link.'" title="" target="_blank" ><img src="'.get_template_directory_uri().'/images/facebook.jpg" alt="" /></a></li>': '';
				  echo ( !empty( $gplus_link ) ) ? '<li><a href="'.$gplus_link.'" title="" target="_blank" ><img src="'.get_template_directory_uri().'/images/gplus.jpg" alt="" /></a></li>': '';
				  echo ( !empty( $twitter_link ) ) ? '<li><a href="'.$twitter_link.'" title="" target="_blank" ><img src="'.get_template_directory_uri().'/images/twitter-icon.jpg" alt="" /></a></li>': '';
				  echo ( !empty( $pinteres_link ) ) ? '<li><a href="'.$pinteres_link.'" title="" target="_blank" ><img src="'.get_template_directory_uri().'/images/pinterest.jpg" alt="" /></a></li>': '';?>
              </ul>
              <?php
		  }
		  ?>
          <div class="newsletter-btn">
              <input name="submit" type="submit" value="<?php _e("Submit" , SH_NAME) ;?>" />
          </div>
		   </form>
        <?php echo $after_widget ; ?>
		<?php
	}
	
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['sub_title'] = strip_tags($new_instance['sub_title']);
		$instance['text'] = $new_instance['text'];
		$instance['rss_link'] = $new_instance['rss_link'];
		$instance['facebook_link'] = $new_instance['facebook_link'];
		$instance['gplus_link'] = $new_instance['gplus_link'];
		$instance['twitter_link'] = $new_instance['twitter_link'];
		$instance['pinteres_link'] = $new_instance['pinteres_link'];
		$instance['ID'] = $new_instance['ID'];
		return $instance;
	}
	
	function form($instance)
	{
		$title = ($instance) ? esc_attr($instance['title']) : __('SIGNUP', SH_NAME);
		$sub_title = ($instance) ? esc_attr($instance['sub_title']) : __('NEWSLETTER', SH_NAME);
		$text = ($instance) ? esc_attr($instance['text']) :'';
		$rss_link = ($instance) ? esc_attr($instance['rss_link']) : '';
		$facebook_link = ($instance) ? esc_attr($instance['facebook_link']) :'';
		$gplus_link = ($instance) ? esc_attr($instance['gplus_link']) : '';
		$twitter_link = ($instance) ? esc_attr($instance['twitter_link']) : '';
		$pinteres_link = ($instance) ? esc_attr($instance['pinteres_link']) : '';
		$ID = ($instance) ? esc_attr($instance['ID']) : '';
		?>
        
        <p>
            <label for="<?php echo $this->get_field_id('title');?>"><?php _e('Title:', SH_NAME);?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title');?>" name="<?php echo $this->get_field_name('title');?>" type="text" value="<?php echo $title;?>" />
        </p>
         <p>
            <label for="<?php echo $this->get_field_id('sub_title');?>"><?php _e('Sub Title:', SH_NAME);?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('sub_title');?>" name="<?php echo $this->get_field_name('sub_title');?>" type="text" value="<?php echo $sub_title;?>" />
        </p>
        <p>    
            <label for="<?php echo $this->get_field_id('text');?>"><?php _e('Text:', SH_NAME);?></label>
            <textarea class="widefat" id="<?php echo $this->get_field_id('text');?>" name="<?php echo $this->get_field_name('text');?>" > <?php echo $text;?></textarea> 
        </p>
        
        <p>
            <label for="<?php echo $this->get_field_id('ID');?>"><?php _e('FeedBurner ID:', SH_NAME);?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('ID');?>" name="<?php echo $this->get_field_name('ID');?>" type="text" value="<?php echo $ID;?>" />
        </p>
        <p>    
            <label for="<?php echo $this->get_field_id('rss_link');?>"><?php _e('RSS Link:', SH_NAME);?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('rss_link');?>" name="<?php echo $this->get_field_name('rss_link');?>" type="text" value="<?php echo $rss_link;?>" /> 
        </p>
        <p>    
            <label for="<?php echo $this->get_field_id('facebook_link');?>"><?php _e('Facebook Link:', SH_NAME);?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('facebook_link');?>" name="<?php echo $this->get_field_name('facebook_link');?>" type="text" value="<?php echo $facebook_link;?>" /> 
        </p>
        <p>    
            <label for="<?php echo $this->get_field_id('gplus_link');?>"><?php _e('Gogle Plus Link:', SH_NAME);?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('gplus_link');?>" name="<?php echo $this->get_field_name('gplus_link');?>" type="text" value="<?php echo $gplus_link;?>" /> 
        </p>
        <p>    
            <label for="<?php echo $this->get_field_id('twitter_link');?>"><?php _e('Twitter Link:', SH_NAME);?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('twitter_link');?>" name="<?php echo $this->get_field_name('twitter_link');?>" type="text" value="<?php echo $twitter_link;?>" /> 
        </p>
        <p>    
            <label for="<?php echo $this->get_field_id('pinteres_link');?>"><?php _e('Pinteres Link:', SH_NAME);?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('pinteres_link');?>" name="<?php echo $this->get_field_name('pinteres_link');?>" type="text" value="<?php echo $pinteres_link;?>" /> 
        </p>
        <?php 
	}
}

//Galleries
class SH_Galleries extends WP_Widget
{
	function __construct()
	{
		parent::__construct( /* Base ID */'Galleries', /* Name */__('Galleries',SH_NAME), array( 'description' => __('This widgtes is used to add Galleries.', SH_NAME )) );
	}
	
	function widget($args, $instance)
	{
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );
		$sub_title = apply_filters( 'widget_sub_title', $instance['sub_title'] );
		$number = apply_filters( 'widget_number', $instance['number'] );

		echo $before_widget;
		echo $before_title.$title.' <span>'.$sub_title.'</span>'.$after_title;
		
		$Records = '';
		$CoverImage = '';
		
		$Posts = query_posts( 'post_type=dict_gallery&posts_per_page='.$number );
		
		if( have_posts() ): while( have_posts() ): the_post();

		$Records .= '<div class="col-md-4">
					   <a href="'.get_permalink().'" title="">'.get_the_post_thumbnail( get_the_ID(), '150x150' ).'</a>
					 </div>';
		endwhile; 
		endif;
		wp_reset_query();
		?>
            <div class="gallery row">
              <?php echo $Records;?>
            </div>
		<?php echo $after_widget;
	}
	
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['sub_title'] = strip_tags($new_instance['sub_title']);
		$instance['number'] = $new_instance['number'];
		return $instance;
	}
	
	function form($instance)
	{
		$title = ($instance) ? esc_attr($instance['title']) : __('Gallery', SH_NAME);
		$sub_title = ($instance) ? esc_attr($instance['sub_title']) : '';
		$number = ($instance) ? esc_attr($instance['number']) : '';?>
        
        <p>
            <label for="<?php echo $this->get_field_id('title');?>"><?php _e('Title:', SH_NAME);?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title');?>" name="<?php echo $this->get_field_name('title');?>" type="text" value="<?php echo $title;?>" />
        </p>
         <p>
            <label for="<?php echo $this->get_field_id('sub_title');?>"><?php _e('Sub Title:', SH_NAME);?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('sub_title');?>" name="<?php echo $this->get_field_name('sub_title');?>" type="text" value="<?php echo $sub_title;?>" />
        </p>
        <p>    
            <label for="<?php echo $this->get_field_id('number');?>"><?php _e('Number Of Galleries:', SH_NAME);?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('number');?>" name="<?php echo $this->get_field_name('number');?>" type="text" value="<?php echo $number;?>" /> 
        </p>
        <?php
	}
}

//Popular Posts
class SH_Popular_Posts extends WP_Widget
{
	function __construct()
	{
		parent::__construct( /* Base ID */'PopularPosts', /* Name */__('Popular Posts',SH_NAME), array( 'description' => __('This widgtes is used to add Popular Posts in sidebar.', SH_NAME )) );
	}
	
	function widget($args, $instance)
	{
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );
		$sub_title = apply_filters( 'widget_sub_title', $instance['sub_title'] );
		$number = apply_filters( 'widget_number', $instance['number'] );

		echo $before_widget;
		echo $before_title.$title.' <span>'.$sub_title.'</span>'.$after_title;
		
		$Records = '';
		$CoverImage = '';
		
		$posts = query_posts( 'orderby=comment_count&order=DESC&post_type=post&posts_per_page='.$number );
		
		if( have_posts() ): while( have_posts() ): the_post();
		$NumberOFComments = get_comments_number( get_the_ID() );
		if( $NumberOFComments == 0 ) $NumberOFComments = '0 comments';
		else if( $NumberOFComments == 1 ) $NumberOFComments = '1 comment';
		else $NumberOFComments .= ' comments';
		?>
        <div class="popular-post"> 
          <?php echo get_the_post_thumbnail( get_the_ID(), '270x155' );?>
          <div class="popular-post-title">
            <h6><a href="<?php echo get_permalink();?>" title="<?php echo get_the_title();?>"><?php echo get_the_title();?></a></h6>
            <span><?php echo get_the_date('F d, Y').' / '.$NumberOFComments;?></span> </div>
        </div>
        <?php
		endwhile; 
		endif;
		wp_reset_query();
		echo $after_widget;
	}
	
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['sub_title'] = strip_tags($new_instance['sub_title']);
		$instance['number'] = $new_instance['number'];
		return $instance;
	}
	
	function form($instance)
	{
		$title = ($instance) ? esc_attr($instance['title']) : __('Popular', SH_NAME);
		$sub_title = ($instance) ? esc_attr($instance['sub_title']) : __('Posts', SH_NAME);
		$number = ($instance) ? esc_attr($instance['number']) : ''?>
        
        <p>
            <label for="<?php echo $this->get_field_id('title');?>"><?php _e('Title:', SH_NAME);?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title');?>" name="<?php echo $this->get_field_name('title');?>" type="text" value="<?php echo $title;?>" />
        </p>
         <p>
            <label for="<?php echo $this->get_field_id('sub_title');?>"><?php _e('Sub Title:', SH_NAME);?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('sub_title');?>" name="<?php echo $this->get_field_name('sub_title');?>" type="text" value="<?php echo $sub_title;?>" />
        </p>
        <p>    
            <label for="<?php echo $this->get_field_id('number');?>"><?php _e('Number Of Posts:', SH_NAME);?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('number');?>" name="<?php echo $this->get_field_name('number');?>" type="text" value="<?php echo $number;?>" /> 
        </p>
        <?php
	}
}

//Recent Events
class SH_Recent_Events extends WP_Widget
{
	function __construct()
	{
		parent::__construct( /* Base ID */'RecentEvents', /* Name */__('Recent Events',SH_NAME), array( 'description' => __('This widgtes is used to add Recent Events in sidebar.', SH_NAME )) );
	}
	
	function widget($args, $instance)
	{
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );
		$sub_title = apply_filters( 'widget_sub_title', $instance['sub_title'] );
		$number = apply_filters( 'widget_number', $instance['number'] );
		$orderby = apply_filters( 'widget_orderby', $instance['orderby'] );
		$order = apply_filters( 'widget_order', $instance['order'] );

		echo $before_widget;
		
		echo $before_title.$title.' <span>'.$sub_title.'</span>'.$after_title;
		
		$Records = '';
		$CoverImage = '';
		
		$Posts = query_posts( 'orderby='.$orderby.'&order='.$order.'&post_type=dict_event&posts_per_page='.$number );
		
		if( have_posts() ): while( have_posts() ): the_post();
		
		$NumberOFComments = get_comments_number( get_the_ID() );
		if( $NumberOFComments == 0 ) $NumberOFComments = '0 comments';
		else if( $NumberOFComments == 1 ) $NumberOFComments = '1 comment';
		else $NumberOFComments .= ' comments';
		
		$Settings = get_post_meta( get_the_ID(), '_dict_event_settings', true );
		
		$EventdateDetails = '';
		
		if( !empty( $Settings['start_date'] ) )
		{
			$Eventdate = new DateTime( $Settings['start_date'] );
			$EventdateDetails = $Eventdate->format('F d, Y').' / ';
		}
		else if( !empty( $Settings['end_date'] ) )
		{
			$Eventdate = new DateTime( $Settings['end_date'] );
			$EventdateDetails = $Eventdate->format('F d, Y').' / ';
		}
		?>
        <div class="popular-post"> 
          <?php echo get_the_post_thumbnail( get_the_ID(), '270x103' );?>
          <div class="popular-post-title">
            <h6><a href="<?php echo get_permalink();?>" title="<?php echo get_the_title();?>"><?php echo get_the_title();?></a></h6>
            <span><?php echo $EventdateDetails.$NumberOFComments;?></span> </div>
        </div>
        <?php
		endwhile; 
		endif;
		wp_reset_query();
		echo $after_widget;
	}
	
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['sub_title'] = strip_tags($new_instance['sub_title']);
		$instance['number'] = $new_instance['number'];
		$instance['orderby'] = $new_instance['orderby'];
		$instance['order'] = $new_instance['order'];
		return $instance;
	}
	
	function form($instance)
	{
		$title = ($instance) ? esc_attr($instance['title']) : __('Recent', SH_NAME);
		$sub_title = ($instance) ? esc_attr($instance['sub_title']) : __('Events', SH_NAME);
		$number = ($instance) ? esc_attr($instance['number']) : '';
		$orderby = ($instance) ? esc_attr($instance['orderby']) : __('date', SH_NAME);
		$order = ($instance) ? esc_attr($instance['order']) : __('ASC', SH_NAME);
		
		$OrderByOptions = $OrderOptions = '';
		
		$OptArray1 = array('date'=>'Date','title'=>'Title' ,'name'=>'Name' ,'author'=>'Author','comment_count' =>'Comment Count','random' =>'Random' );
		foreach( $OptArray1 as $k => $v )
		{
			$SelectedOrderByOption = ( $k == $orderby ) ? ' selected="selected"': '';
			$OrderByOptions .= '<option value="'.$k.'"'.$SelectedOrderByOption.'>'.$v.'</option>';
		}
		
		$OptArray2 = array( 'ASC' => 'Ascending Order','DESC' => 'Descending order' );
		foreach( $OptArray2 as $k => $v )
		{
			$SelectedOrderOption = ( $k == $orderby ) ? ' selected="selected"': '';
			$OrderOptions .= '<option value="'.$k.'"'.$SelectedOrderOption.'>'.$v.'</option>';
		}
		?>
        
        <p>
            <label for="<?php echo $this->get_field_id('title');?>"><?php _e('Title:', SH_NAME);?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title');?>" name="<?php echo $this->get_field_name('title');?>" type="text" value="<?php echo $title;?>" />
        </p>
         <p>
            <label for="<?php echo $this->get_field_id('sub_title');?>"><?php _e('Sub Title:', SH_NAME);?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('sub_title');?>" name="<?php echo $this->get_field_name('sub_title');?>" type="text" value="<?php echo $sub_title;?>" />
        </p>
        <p>    
            <label for="<?php echo $this->get_field_id('number');?>"><?php _e('Number Of Events:', SH_NAME);?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('number');?>" name="<?php echo $this->get_field_name('number');?>" type="text" value="<?php echo $number;?>" /> 
        </p>
        <p>    
            <label for="<?php echo $this->get_field_id('orderby');?>"><?php _e('Order By:', SH_NAME);?></label>
            <select class="widefat" id="<?php echo $this->get_field_id('orderby');?>" name="<?php echo $this->get_field_id('orderby');?>">
              <?php echo $OrderByOptions;?>
            </select>
        </p>
        <p>    
            <label for="<?php echo $this->get_field_id('order');?>"><?php _e('Order:', SH_NAME);?></label>
            <select class="widefat" id="<?php echo $this->get_field_id('order');?>" name="<?php echo $this->get_field_id('order');?>">
              <?php echo $OrderOptions;?>
            </select>
        </p>
        <?php
	}
}

//Video Widget
class SH_Video extends WP_Widget
{
	function __construct()
	{
		parent::__construct( /* Base ID */'Video', /* Name */__('Video',SH_NAME), array( 'description' => __('This widgtes is used to add Video to sidebar.', SH_NAME )) );
	}
	
	function widget($args, $instance)
	{
		extract( $args );
		$title = apply_filters( 'widget_title', sh_set($instance, 'title') );
		$sub_title = apply_filters( 'widget_sub_title', sh_set($instance, 'sub_title') );
		$number = apply_filters( 'widget_number', sh_set($instance, 'number') );
		$posttype = apply_filters( 'widget_posttype', sh_set($instance, 'posttype') );
		
		$posttype = ( !empty( $posttype ) ) ? $posttype: 'dict_gallery';

		echo $before_widget;
		echo $before_title.$title.' <span>'.$sub_title.'</span>'.$after_title;
		
		$Posts = query_posts( 'orderby=comment_count&order=DESC&post_type='.$posttype.'&posts_per_page='.$number );
		
		if( have_posts() ): while( have_posts() ): the_post();

		$PostTitle = get_the_title();
		$Settings = get_post_meta( get_the_ID(), '_dict_gallery_settings', true );
		$Records = '' ;
		if( !empty( $Settings ) )
		{
			$GalleryAttachments = get_posts( array( 'post_type' => 'attachment', 'post__in' => explode( ',', sh_set( $Settings, 'gallery' ) ) ) );
			$i = 1;
			$opt = get_post_meta( get_the_ID(), '_dictate_gal_videos', true );
			foreach( (array)sh_set($Settings, 'videos') as $new_a )
			{
				$video_data = sh_grab_video( $new_a, $opt );
				if( $i == 1 )
				{
					$Records .= '<div class="sidebar-video"> 
								  <img src="'.sh_set( $video_data, 'thumb').'" style="width:270; height:203px;" alt="'.sh_set( $video_data, 'title' ).'" /> 
								  <h6>'.sh_character_limit( 20, get_the_title() ).'</h6>
								  <span><a class="html5lightbox" href="'.$new_a.'" title="'.sh_set( $video_data, 'title' ).'"></a></span>
								</div>';
					$i++;
				}
			}
		}
		endwhile; 
		endif;
		wp_reset_query();
		?>
            <?php echo $Records;?>
		<?php echo $after_widget;
	}
	
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['sub_title'] = strip_tags($new_instance['sub_title']);
		$instance['number'] = $new_instance['number'];
		$instance['posttype'] = $new_instance['posttype'];
		return $instance;
	}
	
	function form($instance)
	{
		$title = ($instance) ? esc_attr($instance['title']) : __('Popular', SH_NAME);
		$sub_title = ($instance) ? esc_attr($instance['sub_title']) : __('Video', SH_NAME);
		$number = ($instance) ? esc_attr($instance['number']) : '';
		$posttype = ($instance) ? esc_attr($instance['posttype']) : __('dict_gallery', SH_NAME);
		
		$post_types = get_post_types( '', 'names' );
		$Options = '';
		foreach ( $post_types as $post_type ) {
			$Value = str_replace( 'dict', '', $post_type );
			$Value = str_replace( '_', ' ', $Value );
			$SelectedType = ( $posttype == $post_type ) ? ' selected="selected"': '';
			$Options .= '<option value="'.$post_type.'"'.$SelectedType.'>'.ucwords( $Value ).'</option>';
		}
		?>
        <p>
            <label for="<?php echo $this->get_field_id('title');?>"><?php _e('Title:', SH_NAME);?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title');?>" name="<?php echo $this->get_field_name('title');?>" type="text" value="<?php echo $title;?>" />
        </p>
         <p>
            <label for="<?php echo $this->get_field_id('sub_title');?>"><?php _e('Sub Title:', SH_NAME);?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('sub_title');?>" name="<?php echo $this->get_field_name('sub_title');?>" type="text" value="<?php echo $sub_title;?>" />
        </p>
        <p>    
            <label for="<?php echo $this->get_field_id('number');?>"><?php _e('Number Of Videos:', SH_NAME);?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('number');?>" name="<?php echo $this->get_field_name('number');?>" type="text" value="<?php echo $number;?>" /> 
        </p>
        <p>    
            <label for="<?php echo $this->get_field_id('posttype');?>"><?php _e('Video From:', SH_NAME);?></label>
            <select class="widefat" id="<?php echo $this->get_field_id('posttype');?>" name="<?php echo $this->get_field_id('posttype');?>">
              <?php echo $Options;?>
            </select>
        </p>
        <?php
	}
}
//Donate Us Widget
class SH_Donate_Us extends WP_Widget
{
	function __construct()
	{
		parent::__construct( /* Base ID */'DonateUs', /* Name */__('Donate Us',SH_NAME), array( 'description' => __('This widgtes is used to add Donate Us to sidebar.', SH_NAME )) );
	}
	
	function widget($args, $instance)
	{
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );
		$sub_title = apply_filters( 'widget_sub_title', $instance['sub_title'] );
		$contactno = apply_filters( 'widget_contactno', $instance['contactno'] );
		$currency = apply_filters( 'widget_currency', $instance['currency'] );
		$collecteddonation = apply_filters( 'widget_collecteddonation', $instance['collecteddonation'] );

		echo $before_widget;
		echo $before_title.$title.' <span>'.$sub_title.'</span>'.$after_title;
		?>
            <div class="donate-us">
                <h3><?php  _e( 'Give Your Donations', SH_NAME );?></h3>
                <span><i class="icon-phone"></i><?php echo $contactno;?></span>
                <div class="collected">
                  <p><?php  _e( 'Collected Donations', SH_NAME );?></p>
                  <span><strong><?php echo $currency;?></strong> <?php echo sh_character_limit( 6, $collecteddonation );?>!</span> </div>
               <div class="d-now"> <a  data-toggle="modal" data-target="#myModal"  class="donate-btn" title=""><?php  _e( 'Donate Now', SH_NAME );?></a> </div>
                
            </div>
		<?php echo $after_widget;
	}
	
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['sub_title'] = strip_tags($new_instance['sub_title']);
		$instance['contactno'] = $new_instance['contactno'];
		$instance['currency'] = $new_instance['currency'];
		$instance['collecteddonation'] = $new_instance['collecteddonation'];
		return $instance;
	}
	
	function form($instance)
	{
		$title = ($instance) ? esc_attr($instance['title']) : __('Donate', SH_NAME);
		$sub_title = ($instance) ? esc_attr($instance['sub_title']) : __('Us', SH_NAME);
		$contactno = ($instance) ? esc_attr($instance['contactno']) :'';
		$currency = ($instance) ? esc_attr($instance['currency']) :'';
		$collecteddonation = ($instance) ? esc_attr($instance['collecteddonation']) : '';

		?>
        <p>
            <label for="<?php echo $this->get_field_id('title');?>"><?php _e('Title:', SH_NAME);?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title');?>" name="<?php echo $this->get_field_name('title');?>" type="text" value="<?php echo $title;?>" />
        </p>
         <p>
            <label for="<?php echo $this->get_field_id('sub_title');?>"><?php _e('Sub Title:', SH_NAME);?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('sub_title');?>" name="<?php echo $this->get_field_name('sub_title');?>" type="text" value="<?php echo $sub_title;?>" />
        </p>
        <p>    
            <label for="<?php echo $this->get_field_id('contactno');?>"><?php _e('Contact Number:', SH_NAME);?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('contactno');?>" name="<?php echo $this->get_field_name('contactno');?>" type="text" value="<?php echo $contactno;?>" /> 
        </p>
        <p>    
            <label for="<?php echo $this->get_field_id('currency');?>"><?php _e('Currency:', SH_NAME);?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('currency');?>" name="<?php echo $this->get_field_name('currency');?>" type="text" value="<?php echo $currency;?>" /> 
        </p>
        <p>    
            <label for="<?php echo $this->get_field_id('collecteddonation');?>"><?php _e('Collected Donation:', SH_NAME);?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('collecteddonation');?>" name="<?php echo $this->get_field_name('collecteddonation');?>" type="text" value="<?php echo $collecteddonation;?>" /> 
        </p>
        <?php
	}
}

class sh_categories extends WP_Widget {

	public function __construct()
	{
		$widget_ops = array( 'classname' => 'sh_widget_categories', 'description' => __( "This widgtes is used in sidebar to show Categoreis of custom post types.", SH_NAME ) );
		parent::__construct( 'sh_categories', __( 'The Lifeline Categories', SH_NAME), $widget_ops );
	}

	public function widget( $args, $instance )
	{

		$c = !empty( $instance['count'] ) ? '1' : '0';
		$title 			=	isset( $instance['title'] ) ? $instance['title'] : '';
		$crop		=	explode( ' ', $title, 2 );
		echo $args['before_widget'];
		$cat_args = array( 
				'orderby'		 	=> 	'name',
				'show_count' 		=> 	$c ,
				'order'             => 	'ASC',
				'taxonomy'          =>  $instance['cat'],
			);
		?>
            <div class="sidebar-title">
                <h4><?php echo sh_set( $crop, '0' )?> <span><?php echo sh_set( $crop, '1' )?></span></h4>
            </div>
         	<ul class="sidebar-list">
				<?php
                $cat_args['title_li'] = '';
				//printr($cat_args);
                wp_list_categories( apply_filters( 'widget_categories_args', $cat_args ) );
                ?>
			</ul>
		<?php
		echo $args['after_widget'];
	}

	public function update( $new_instance, $old_instance ) {

		$instance = $old_instance;
		$instance['title']			=	strip_tags($new_instance['title']);
		$instance['count']			=	!empty($new_instance['count']) ? 1 : 0;
		$instance['cat']			=	strip_tags( $new_instance['cat'] );		
		
		return $instance;
	}

	public function form( $instance ) {
		
		$instance 		=	wp_parse_args( (array) $instance, array( 'title' => '') );
		$title 			=	isset( $instance['title'] ) ? $instance['title'] : '';
		$count 			=	isset($instance['count']) ? (bool) $instance['count'] : false;
		$cat 			=	isset( $instance['cat'] ) ? $instance['cat'] : '';
		
		$opt			=	array( 'testimonial_category' => 'Testimonials', 'project_category' => 'Project', 'portfolio_category' => 'portfolio', 'team_category' => 'Team', 'gallery_category' => 'Gallery', 'event_category' => 'Event');
?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title:', SH_NAME ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>
		<p>
		<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('count'); ?>" name="<?php echo $this->get_field_name('count'); ?>"<?php checked( $count ); ?> />
		<label for="<?php echo $this->get_field_id('count'); ?>"><?php _e( 'Show post counts', SH_NAME ); ?></label><br />
        <p>
         <label for="<?php echo $this->get_field_id('cat');?>"><?php _e('Select Post Type:', SH_NAME);?></label>
         <select class="widefat" id="<?php echo $this->get_field_id( 'cat' ); ?>" name="<?php echo $this->get_field_name( 'cat' ); ?>" >
         <?php foreach ( $opt as $k => $op ) : 	
                $selected = ( $cat == $k ) ? 'selected="selected"' : '';
                echo '<option value="'.$k.'" '.$selected.'>'.$op.'</option>';
              endforeach; ?>
         </select>
         </p>
<?php
	}

}