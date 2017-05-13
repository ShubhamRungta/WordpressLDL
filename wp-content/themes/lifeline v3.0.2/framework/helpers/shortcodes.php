<?php
class SH_Shortcodes
{
    protected $keys;
    protected $toggle_count = 0;
    function __construct()
    {
        $GLOBALS['sh_toggle_count'] = 0;
        add_action('init', array($this, 'add'));
    }
    function add()
    {
        include(SH_FRW_DIR . 'resource/shortcodes.php');
        $this->keys = array_keys($options);
        foreach ($this->keys as $k) {
            if (method_exists($this, $k)) add_shortcode('sh_' . $k, array($this, $k));
        }
    }
    function recent_news($atts, $content = null)
    {
        extract(shortcode_atts(array(
                'number' => '',
                'title' => __('Recent News', SH_NAME),
                'category' => '',
                'sort_by' => 'date',
                'sorting_order' => 'DESC',
                'heading_style' => 'simple',
                ), $atts)
        );
        
        $News = $Thumb = '';
        wp_reset_query();
        $args = array('post_type' => 'post', 'posts_per_page' => $number, 'orderby' => $sort_by, 'order' => $sorting_order, 'cat' => (int)$category);
        //if($category != '') $args['category'] = array($category);
        $query = new WP_Query($args);
        //printr($query);
        $i = 1;
        if ($query->have_posts()): while ($query->have_posts()): $query->the_post();
            $Settings = get_post_meta(get_the_ID(), '_post_settings', true);
            if ($video_link = sh_set($Settings, 'video_link')) {
                $opt = get_post_meta(get_the_ID(), '_dictate_gal_videos', true);
                $video_data = sh_grab_video($video_link, $opt);
                $PostMedia = '<div class="image"> 
							  <img src="' . sh_set($video_data, 'thumb') . '" style="width:261px; height:207px;" alt="' . sh_set($video_data, 'title') . '" /> 
							  <a class="html5lightbox" rel="prettyPhoto" href="' . $video_link . '" title="' . sh_set($video_data, 'title') . '"> 
								  <span><i class="icon-play"></i></span> 
							  </a> 
						  </div>';
                $CarouselThumb = '<img src="' . sh_set($video_data, 'thumb') . '" style="width:131px; height:78px;" alt="' . sh_set($video_data, 'title') . '" />';
            } else {
                $PostAttchment = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'large');
                $PostMedia = '<div class="image">
							  ' . get_the_post_thumbnail(get_the_ID(), '370x252') . '
							  <a title="" href="' . sh_set($PostAttchment, 0) . '" rel="prettyPhoto" class="html5lightbox"><i class="icon-picture"></i></a>
						  </div>';
                $CarouselThumb = get_the_post_thumbnail(get_the_ID(), '270x155');
            }
            $News .= '<div id="news' . $i . '">
					<div class="row">
						<div class="col-md-6 desc">
						  <h3><a href="' . get_permalink() . '" title="">' . sh_character_limit(35, get_the_title()) . '</a></h3>
						  <p>' . sh_character_limit(340, get_the_content()) . '</p>
						</div>
						<div class="col-md-6">
							' . $PostMedia . '
						</div>
					</div>
				  </div>';
            $Thumb .= '<a href="#news' . $i . '">' . $CarouselThumb . '<span class="carusal-our-news">' . sh_character_limit(17, get_the_title()) . '</span></a>';
            $i++;
        endwhile;
        endif;
        wp_reset_query();
        wp_enqueue_script('carofredcsel');
        $output = '';
        
        
        $output .= '<div class="carusal-slider">
					  <div id="carousel-wrapper">
						<div id="carousel">
						  ' . $News . ' 
						</div>
					  </div>
					  <div id="thumbs-wrapper">
						<div id="thumbs">' . $Thumb . '</div>
						<a id="prev" href="#"><i class="icon-angle-left"></i></a> <a id="next" href="#"><i class="icon-angle-right"></i></a> </div>
					</div>
					<script>
					jQuery(document).ready(function($){
						 $(\'#carousel\').carouFredSel({
						  responsive: true,
						  circular: false,
						  auto: false,
						  items: {
						   visible: 1,
						   width: 20,
						  },
						  scroll: {
						   fx: \'directscroll\'
						  }
						 });
						 $(\'#thumbs\').carouFredSel({
						  responsive: true,
						  circular: false,
						  infinite: false,
						  auto: false,
						  prev: \'#prev\',
						  next: \'#next\',
						  items: {
						   visible: {
							min: 1,
							max: 6
						   },
						   width: 200,
						   height: \'80%\'
						  }
						 });
						 $(\'#thumbs a\').click(function() {
						  $(\'#carousel\').trigger(\'slideTo\', \'#\' + this.href.split(\'#\').pop() );
						  $(\'#thumbs a\').removeClass(\'selected\');
						  $(this).addClass(\'selected\');
						  return false;
						 });
					});
					</script>
					';
        
        return $output;
    }
	
    function our_causes($atts, $content = null)
    {
        extract(shortcode_atts(array(
                'number' => '',
                'title' => __('Our Causes', SH_NAME),
                'cat' => '',
                'sort_by' => 'date',
                'sorting_order' => 'ASC',
                'donate_sec' => '',
                'heading_style' => 'simple',
                
            ), $atts)
        );
        $paypal_res = '';
        $single_page = (sh_set($_SESSION, 'sh_causes_page')) ? sh_set($_SESSION, 'sh_causes_page') : false;
        if ($single_page == true) unset($_SESSION['sh_causes_page']);
        if (isset($_GET['recurring_pp_return']) && $_GET['recurring_pp_return'] == 'return') {
            $paypal_res = require_once(get_template_directory() . '/framework/modules/pp_recurring/review.php');
        }
        $return_url = (is_home()) ? home_url() : get_permalink();
        
        $args = array('post_type' => 'dict_causes', 'posts_per_page' => $number, 'orderby' => $sort_by, 'order' => $sorting_order);
        if ($cat != '') $args['tax_query'] = array(array('taxonomy' => 'causes_category', 'field' => 'id', 'terms' => (int)$cat));
        $Posts = query_posts($args);
		
        $chunk_num = ($donate_sec == 'true') ? 3 : 4;
        $col_class_outer = ($donate_sec == 'true') ? 'col-md-9' : 'col-md-12';
        $col_class_inner = ($donate_sec == 'true') ? 'col-md-4' : 'col-md-3';
        $chunk = array_chunk($Posts, $chunk_num);
        $output = '';
        
        $output .= '<div class="row"><div class="' . $col_class_outer . '">';
        $output .= '<div class="our-causes">
						
						  <ul class="slides">';
        foreach ($chunk as $p) {
            $output .= '<li><div class="row">';
            foreach ($p as $pos) {
                $Settings = get_post_meta(sh_set($pos, 'ID'), '_dict_causes_settings', true);
                $output .= '<div class="' . $col_class_inner . '">
								<div class="causes-image">'
                    . get_the_post_thumbnail(sh_set($pos, 'ID'), '370x491') . '
									<div class="cause-heading">
										<h3>' . sh_excerpt(sh_set($pos, 'post_title'), 27) . '</h3>
										<p>' . __("in", SH_NAME) . ' ' . sh_set($Settings, 'location') . '</p>
									</div>
									<a href="' . get_permalink(sh_set($pos, 'ID')) . '" title="' . sh_set($pos, 'post_title') . '">
										<div class="our-causes-hover">
										  
										  <h3>' . sh_excerpt(sh_set($pos, 'post_title'), 27) . '</h3>
										  <span>' . __('in', SH_NAME) . ' <i>' . sh_set($Settings, 'location') . '</i></span>
										  <p>' . sh_excerpt($pos, 127) . '</p>
										  <span class="help"><strong>' . __('Help us', SH_NAME) . '</strong> ' . __('to collect', SH_NAME) . ':</span> <span class="needed-amount"><span>' . sh_set($Settings, 'currency_symbol') . '</span>' . sh_set($Settings, 'donation_needed') . ' </span> 
										</div>
									</a>
								</div>
							</div>';
            }
            $output .= '</div></li>
			<script>
				jQuery(document).ready(function($){
					if( $(\'.our-causes\').length ){
				$(\'.our-causes\').flexslider({
					animation: "slide",
					animationLoop: false,
					controlNav: true,	
					maxItems: 1,
					pausePlay: false,
					mousewheel:false,
					start: function(slider){
					$(\'body\').removeClass(\'loading\');
					}
				});
			}
		});
		</script>
				';
        }
        wp_reset_query();
        $paypal = $GLOBALS['_sh_base']->donation;
        if ($notif = $paypal->_paypal->handleNotification()) $paypal_res = $paypal->single_pament_result($notif);
        $output .= '</ul></div></div>';
        $donation_data = get_option(SH_NAME);
        $percent = (sh_set($donation_data, 'paypal_target')) ? (int)str_replace(',', '', sh_set($donation_data, 'paypal_raised')) / (int)str_replace(',', '', sh_set($donation_data, 'paypal_target')) : 0;
        $donation_percentage = $percent * 100;
        $symbol = (sh_set($donation_data, 'paypal_currency')) ? sh_set($donation_data, 'paypal_currency') : '$';
        $donation = '<div class="col-md-3">';
        $donation .= '<div class="donate-us-box">
					   <h5>' . __('Give Your Donations', SH_NAME) . '</h5>
					   <span>' . __('Donation Needed', SH_NAME) . '</span> <span class="amount-figures"><strong>' . $symbol . '</strong> ' . sh_set($donation_data, 'paypal_target') . '!</span> <span>' . __('Collected Donation', SH_NAME) . '</span> <span class="amount-figures coloured"><strong>' . $symbol . '</strong> ' . sh_set($donation_data, 'paypal_raised') . '!</span> 
					   <span class="cell"><i class="icon-phone"></i>' . sh_set($donation_data, 'paypal_contact') . '</span>';
        if (sh_set($donation_data, 'donate_method') == 'true') {
            $donation .= '<a  data-toggle="modal" data-target="#myModal"  class="donate-btn" title="">Donate Us</a>';
        
        }
        $donation .= '</div>
				   </div>';
        $output .= ($donate_sec == 'true') ? $donation : '';
        
                return $output;
    }
    function our_causes_2($atts, $content = null)
    {
        extract(shortcode_atts(array(
                'number' => '',
                'title' => 'Our Causes',
                'bg' => '',
                'blackish' => '',
                'cat' => '',
                'sort_by' => 'date',
                'heading_style' => 'simple',
                'sorting_order' => 'ASC'), $atts)
        );
        wp_enqueue_script('layersliderscript1');
        wp_enqueue_script('layersliderscript2');
        $args = array('post_type' => 'dict_causes', 'posts_per_page' => $number, 'orderby' => $sort_by, 'order' => $sorting_order);
        if ($cat != '') $args['tax_query'] = array(array('taxonomy' => 'causes_category', 'field' => 'id', 'terms' => $cat));
        $black_layer = ($blackish) ? 'blackish' : '';
        $Posts = query_posts($args);
        $attach = ($bg) ? wp_get_attachment_image_src($bg, 'large') : '';
        $bgimg = ($attach) ? sh_set($attach, 0) : get_template_directory_uri() . '/images/moving-bg.png';
		$output = '';
        $output .= '<div class="posts-carousel">
						<ul class="slides">';
        $chunk = array_chunk($Posts, 4);
        foreach ($chunk as $p) {
            $output .= '<li><div class="row">';
            foreach ($p as $pos) {
                $Settings = get_post_meta(sh_set($pos, 'ID'), '_dict_causes_settings', true);
                if (sh_set($Settings, 'video_link') && sh_set($Settings, 'video_link') != '') {
                    $video_link = sh_set($Settings, 'video_link');
                    $video_data = sh_grab_video($video_link, $Settings);
                    $PostMedia = '<div class="carou-post-img">
									  <img src="' . sh_set($video_data, 'thumb') . '" style="width:277px; height:190px;" alt="' . sh_set($video_data, 'title') . '" />
									  <a title="' . sh_set($video_data, 'title') . '" href="' . $video_link . '" class="html5lightbox"><i class="icon-play"></i></a>
								  </div>';
                } else if (sh_set($Settings, 'gallery')) {
                    $GalleryAttachments = get_posts(array('post_type' => 'attachment', 'post__in' => explode(',', sh_set($Settings, 'gallery'))));
                    $Slides = '';
                    foreach ($GalleryAttachments as $Attachment) {
                        $Thumb = sh_set(wp_get_attachment_image_src($Attachment->ID, '370x252'), '0');
                        $LargeImage = sh_set(wp_get_attachment_image_src($Attachment->ID, 'large'), '0');
                        $Slides .= '<li data-masterspeed="500" data-slotamount="7" data-transition="curtain-1">
						<img data-bgrepeat="no-repeat" data-bgposition="left top" data-bgfit="cover" alt="slidebg1" src="' . $Thumb . '" draggable="false"> </li>';
                        //$i++;
                    }
                    $PostMedia = '<div class="carou-post-img"><div class="tp-banner2">
										<ul>
										' . $Slides . '
									 </ul>
									</div></div>';
                } else {
                    $PostAttchment = wp_get_attachment_image_src(get_post_thumbnail_id(sh_set($pos, 'ID')), 'large');
                    $PostMedia = '<div class="carou-post-img">
									  ' . get_the_post_thumbnail(sh_set($pos, 'ID'), '370x252') . '
									  <a title="" href="' . sh_set($PostAttchment, 0) . '" class="html5lightbox"><i class="icon-picture"></i></a>
								  </div>';
                }
                $output .= '<div class="col-md-3">
								<div class="carou-post">
								   ' . $PostMedia . '
								   <h4>' . substr(strip_tags(sh_set($pos, 'post_title')), 0, 30) . '</h4>
								   <p>' . substr(strip_tags(sh_set($pos, 'post_content')), 0, 200) . '</p>
								   <a href="' . get_permalink(sh_set($pos, 'ID')) . '" title="">' . __('Read More', SH_NAME) . '</a> 
							   </div>
						   </div>';
            }
            $output .= '</div></li>';
        }
        $output .= '    </ul>
					  </div>
					  </div>
					  <script>
					  jQuery(document).ready(function($){
					  if( $(".posts-carousel").length > 0 ){
							$(".posts-carousel").flexslider({
								animation: "slide",
								animationLoop: false,
								controlNav: false,	
								maxItems: 1,
								pausePlay: false,
								mousewheel:false,
								start: function(slider){
								  $("body").removeClass("loading");
								}
							});
						}
					  });
					  </script>
					  ';
        wp_reset_query();
        return $output;
    }
    function our_causes_3($atts, $content = null)
    {
        extract(shortcode_atts(array(
                'number' => '',
                'title' => 'Our Causes',
                'cat' => '',
                'sort_by' => 'date',
                'sorting_order' => 'ASC',
                'heading_style' => 'simple',
                ), $atts)
        );
        wp_enqueue_script(array('bootstrap'));
        
        $args = array('post_type' => 'dict_causes', 'posts_per_page' => $number, 'orderby' => $sort_by, 'order' => $sorting_order);
        if ($cat != '') $args['tax_query'] = array(array('taxonomy' => 'causes_category', 'field' => 'id', 'terms' => $cat));
        $Posts = query_posts($args);
        $i = 1;
        $Cause = '';
        $PostNav = '';
        if (have_posts()): while (have_posts()): the_post();
            $PostClass = ($i == 1) ? 'tab-pane fade in active' : 'tab-pane fade';
            $NavClass = ($i == 1) ? 'active' : '';
            $Settings = get_post_meta(get_the_ID(), '_dict_causes_settings', true);
            $Cause .= '<div id="tab' . $i . '" class="' . $PostClass . '">

								<div class="cause-image"> 
									' . get_the_post_thumbnail(get_the_ID(), '1170x312') . '
									<div class="meta"> <span>' . __('In', SH_NAME) . ' <i>' . sh_set($Settings, 'location') . '</i></span> </div>
									<div class="cause-title">
										<h2><a href="' . get_permalink() . '">' . sh_excerpt(get_the_title(), 100) . '</a></h2>
									</div>
								</div>
								<div class="details">
									<div class="needed-amount">
										<h5><i>' . sh_set($Settings, 'currency_symbol') . '</i>' . sh_set($Settings, 'donation_needed') . '<span>' . __('Donation Needed', SH_NAME) . '</span></h5>
									</div>
									<p>' . sh_excerpt(get_the_content(), 500) . '</p>
								</div>
							</div>';
            $PostNav[] = '<li class="col-md-4"> <a data-toggle="tab" href="#tab' . $i . '"> ' . get_the_post_thumbnail(get_the_ID(), '1170x455') . ' <span>' . sh_excerpt(get_the_title(), 35) . '</span> </a> </li>';
            $i++;
        endwhile;
        endif;
        wp_reset_query();
        $nav = '';
        if ($PostNav) {
            foreach (array_chunk($PostNav, 3) as $chunk) {
                $nav .= '<li>
							<ul class="nav nav-tabs cause-tabber">';
                if (is_array($chunk)) {
                    foreach ($chunk as $ch) {
                        $nav .= $ch;
                    }
                }
                $nav .= '</ul>
						</li>';
            }
        }
        $output = '';
        
        $output .= '<div class="our-cause-sec">';
        
        $output .= '<div class="tab-content" id="myTabContent">' . $Cause . '</div>
						
							<div class="causes-carousel">
								<ul class="slides">
									' . $nav . '
								</ul>
							</div>
						
					</div>
					<script>
					jQuery(document).ready(function($){
					if( $(\'.causes-carousel\').length > 0 )
						{
						$(\'.causes-carousel\').flexslider({
							animation: "slide",
							animationLoop: false,
							controlNav: false,	
							pausePlay: false,
							mousewheel:false,
							start: function(slider){
							  $(\'body\').removeClass(\'loading\');
							}
						});
						}
					});
					</script>
					';
        
        return $output;
    }
    function our_causes_4($atts, $content = null)
    {
        extract(shortcode_atts(array(
                'number' => '',
                'title' => 'Our Causes',
                'cat' => '',
                'sort_by' => 'date',
                'sorting_order' => 'ASC',
                'heading_style' => 'simple',
                ), $atts)
        );
        
        $args = array('post_type' => 'dict_causes', 'posts_per_page' => $number, 'orderby' => $sort_by, 'order' => $sorting_order);
        if ($cat != '') $args['tax_query'] = array(array('taxonomy' => 'causes_category', 'field' => 'id', 'terms' => $cat));
        $Posts = query_posts($args);
        $TotalPosts = count($Posts);
        $PostBatch = 2;
        $EndingTagAppended = FALSE;
        $StrtingTag = '<div class="col-md-4">';
        $CloseTag = '</div>';
        $i = 1;
        $Cause = '';
        $NextBatch = TRUE;
        if (have_posts()): while (have_posts()): the_post();
            $NewSecStrtTag = ($TotalPosts < $PostBatch || $i == 1 || $EndingTagAppended === TRUE) ? $StrtingTag : '';
            if (!empty($NewSecStrtTag) && $NextBatch === TRUE) {
                $ImageSize = '370x491';
                $NextBatch = FALSE;
                $AlterStyle = TRUE;
            } else if (!empty($NewSecStrtTag) && $NextBatch === FALSE) {
                $ImageSize = '370x252';
                $NextBatch = TRUE;
                $AlterStyle = FALSE;
            } else if (empty($NewSecStrtTag) && $AlterStyle === TRUE) {
                $ImageSize = '370x252';
                $AlterStyle = FALSE;
            } else if (empty($NewSecStrtTag) && $AlterStyle === FALSE) {
                $ImageSize = '370x491';
                $AlterStyle = TRUE;
            }
            $NewSecCloseTag = ($i == $TotalPosts || ($TotalPosts < $PostBatch && $i == $TotalPosts) || ($i % $PostBatch == 0 && $i !== 1)) ? $CloseTag : '';
            $EndingTagAppended = ($i == $TotalPosts || ($TotalPosts < $PostBatch && $i == $TotalPosts) || ($i % $PostBatch == 0 && $i !== 1)) ? TRUE : FALSE;
            $Cause .= $NewSecStrtTag .
                '<div class="portfolio" data-cat="' . $i . '"> 
				      <a href="' . get_permalink() . '">' . get_the_post_thumbnail(get_the_ID(), $ImageSize) . '</a>
					  <div class="port-desc">
						<h4><a href="' . get_permalink() . '" title="' . get_the_title() . '">' . sh_excerpt(get_the_title(), 40) . '</a></h4>
						<p>' . sh_excerpt(get_the_content(), 300) . '</p>
					  </div>
				   </div>'
                . $NewSecCloseTag;
            $i++;
        endwhile;
        endif;
        wp_reset_query();
        $output = '';        
        $output .= '
					<div id="Grid">
					  <div class="row">
						' . $Cause . '
					  </div>
					</div>';
        
        return $output;
    }
    function donation($atts, $content = null)
    {
        extract(shortcode_atts(array(
            'title' => 'Donate Us',
            'heading_style' => 'simple',
            
        ), $atts));
        $paypal = $GLOBALS['_sh_base']->donation;
        
        $donation_data = get_option(SH_NAME);
        $output = '';
        $output .= '<div class="pull-right">';
        
        $output .= '
					 <div class="donate-us-box">
					   <h5>' . __('Give Your Donations', SH_NAME) . '</h5>
					   <span>' . __('Donation Needed', SH_NAME) . '</span> <span class="amount-figures"><strong>' . sh_set($donation_data, 'paypal_currency') . '</strong> 
					   ' . sh_set($donation_data, 'paypal_target') . '!</span> <span>' . __('Collection Donation', SH_NAME) . '</span> 
					   <span class="amount-figures coloured"><strong>' . sh_set($donation_data, 'paypal_currency') . '</strong> 
					   ' . sh_set($donation_data, 'paypal_raised') . '!</span> <span class="cell"><i class="icon-phone"></i>
					   ' . sh_set($donation_data, 'paypal_contact') . '</span> 
					 <a  data-toggle="modal" data-target="#myModal"  class="donate-btn" title="">'.__( 'Donate Us', SH_NAME ).'</a>
					 </div>
				   </div>';
        return $output;
    }
    function donation_2($atts, $content = null)
    {
        extract(shortcode_atts(array(
            
        ), $atts));
        $paypal = $GLOBALS['_sh_base']->donation;
        $paypal_res = '';
        $single_page = (sh_set($_SESSION, 'sh_causes_page')) ? sh_set($_SESSION, 'sh_causes_page') : false;
        if ($single_page == true) unset($_SESSION['sh_causes_page']);
        if (isset($_GET['recurring_pp_return']) && $_GET['recurring_pp_return'] == 'return') {
            $paypal_res = require_once(get_template_directory() . '/framework/modules/pp_recurring/review.php');
        }
        
        $donation_data = get_option(SH_NAME);
        if ($notif = $paypal->_paypal->handleNotification()) $paypal_res = $paypal->single_pament_result($notif);
        $return_url = (is_home()) ? home_url() : get_permalink();
        $percent = (sh_set($donation_data, 'paypal_target')) ? (int)str_replace(',', '', sh_set($donation_data, 'paypal_raised')) / (int)str_replace(',', '', sh_set($donation_data, 'paypal_target')) : 0;
        $donation_percentage = $percent * 100;
        $symbol = (sh_set($donation_data, 'paypal_currency')) ? sh_set($donation_data, 'paypal_currency') : '$';
        $output = '';
        
        $output .= '<div class="donation-bar">
					  <div class="amount pull-left">
						<p>' . __('Dontaions Needed', SH_NAME) . '</p>
						<span><strong>' . sh_set($donation_data, 'paypal_currency') . '</strong> ' . sh_set($donation_data, 'paypal_target') . '!</span> </div>
					  <div class="donate-now">';
        if (sh_set($donation_data, 'donate_method') == 'true') {
            $output .= '<a  data-toggle="modal" data-target="#myModal"  class="donate-btn" title="">'.__( 'Donate Us', SH_NAME ).'</a>';
        } else {
            $output .= $paypal->button(array('currency_code' => sh_set($donation_data, 'paypal_currency_code'), 'item_name' => get_bloginfo('name'), 'return' => $return_url));
        }
        $output .= '</div>
					  <div class="amount pull-right">
						<p>' . __('Collected Donations', SH_NAME) . '</p>
						<span><strong>' . sh_set($donation_data, 'paypal_currency') . '</strong> ' . sh_set($donation_data, 'paypal_raised') . '!</span> 
					  </div>
				   </div>';
        
        $output .= '<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">';
        if (isset($_GET['recurring_pp_return']) && $_GET['recurring_pp_return'] == 'return') {
            $output .= '<div class="donate-popup">' . $paypal_res . '</div>';
            $output .= '<script>
								jQuery(document).ready(function($){
									$(".donation-bar a.donate-btn").trigger("click");
								
								});
						</script>';
        } elseif ($notif = $paypal->_paypal->handleNotification() && isset($notif->ok)) {
            $output .= '<div class="donate-popup">' . $paypal_res . '</div>';
            $output .= '<script>
								jQuery(document).ready(function($){
									$(".donation-bar a.donate-btn").trigger("click");
								
								});
						</script>';
        } else {
            $output .= '<div class="donate-popup">
		<div class="cause-bar">
			<div class="cause-box"><h3><span>' . $symbol . '</span>' . sh_set($donation_data, 'paypal_target') . '</h3><i>' . __('NEEDED DONATION', SH_NAME) . '</i></div>
			<div class="cause-progress">
					<div class="progress-report">
					<h6>' . __('PHASES', SH_NAME) . '</h6>
					<span>' . $donation_percentage . '%</span>
					<div class="progress pattern">
						<div class="progress-bar" style="width: ' . $donation_percentage . '%"></div>
					</div>
				</div>
			</div>
			<div class="cause-box"><h3><span>' . $symbol . '</span>' . sh_set($donation_data, 'paypal_raised') . '</h3><i>' . __('COLLECTED DONATION', SH_NAME) . '</i></div>
			<div class="cause-box donate-drop-btn"><h4>' . __('DONATE NOW', SH_NAME) . '</h4></div>
		</div>
		<div class="donate-drop-down">
			<div class="recursive-periods">';
				$Settings = get_option(SH_NAME); 
				$value = sh_set($Settings , 'transactions_detail');
					if($value)
					{
						foreach($value as $val )
						{
							$txt = ucwords(str_replace('_', ' ', $val));
							$output .= '<a style="cursor:pointer;">'.__( $txt, SH_NAME ).'</a>';
						}
					}
			$output .='</div>
			<div class="amount-btns">';
					if( intval ( sh_set($Settings , 'pop_up_1st_value') ) != '') $output .= '<a style="cursor:pointer;">'.$symbol.'<span>'.sh_set($Settings , 'pop_up_1st_value').'</span></a>';
				if(intval ( sh_set($Settings , 'pop_up_2nd_value') ) != '') $output .= '<a style="cursor:pointer;">'.$symbol.'<span>'.sh_set($Settings , 'pop_up_2nd_value').'</span></a>';
				if(intval ( sh_set($Settings , 'pop_up_3rd_value') ) != '') $output .= '<a style="cursor:pointer;">'.$symbol.'<span>'.sh_set($Settings , 'pop_up_3rd_value').'</span></a>';
				if(intval ( sh_set($Settings , 'pop_up_4th_value') ) != '') $output .= '<a style="cursor:pointer;">'.$symbol.'<span>'.sh_set($Settings , 'pop_up_4th_value').'</span></a>';
				if(intval ( sh_set($Settings , 'pop_up_5th_value') ) != '') $output .= '<a style="cursor:pointer;">'.$symbol.'<span>'.sh_set($Settings , 'pop_up_5th_value').'</span></a>';
			$output .= '</div>';
            $output .= '<div class="other-amount">
					' . $paypal->button(array('item_name' => get_bloginfo('name'), 'amount' => 30, 'return' => $return_url)) . '
				</div>';
            if (!is_user_logged_in()) {
                $output .= '<form id="login" action="" method="post">
						<h1>Please Login OR Register first to make recursive donation</h1>
						<p class="status"></p>
						<label for="username">Username</label>
						<input id="username" type="text" name="username">
						<label for="password">Password</label>
						<input id="password" type="password" name="password">
						<a class="lost" href="' . wp_registration_url() . '">Register Now</a>
						<input class="submit_button" type="submit" value="Login" name="submit">
						<a class="close" href="">(close)</a>
						' . wp_nonce_field('ajax-login-nonce', 'security') . '
					</form>';
            }
            $output .= '</div>
				</div>';
        }
        $output .= '</div>';
        return $output;
    }
    function donation_3($atts, $content = null)
    {
        extract(shortcode_atts(array(
            'title' => '',
            
        ), $atts));
        $paypal_res = '';
        $single_page = (sh_set($_SESSION, 'sh_causes_page')) ? sh_set($_SESSION, 'sh_causes_page') : false;
        if ($single_page == true) unset($_SESSION['sh_causes_page']);
        if (isset($_GET['recurring_pp_return']) && $_GET['recurring_pp_return'] == 'return') {
            $paypal_res = require_once(get_template_directory() . '/framework/modules/pp_recurring/review.php');
        }
        $paypal = $GLOBALS['_sh_base']->donation;
        if ($notif = $paypal->_paypal->handleNotification()) $paypal_res = $paypal->single_pament_result($notif);
        $return_url = (is_home()) ? home_url() : get_permalink();
        
        $donation_data = get_option(SH_NAME);
        $percent = (sh_set($donation_data, 'paypal_target')) ? (int)str_replace(',', '', sh_set($donation_data, 'paypal_raised')) / (int)str_replace(',', '', sh_set($donation_data, 'paypal_target')) : 0;
        $donation_percentage = $percent * 100;
        $symbol = (sh_set($donation_data, 'paypal_currency')) ? sh_set($donation_data, 'paypal_currency') : '$';
        $output = '';
        
        $output .= '<div class="donate-us">
					  <h3>' . sh_character_limit(20, $title) . '</h3>
					  <span><i class="icon-phone"></i>' . sh_set($donation_data, 'paypal_contact') . '</span>
					  <div class="collected">
						<p>' . __('Collected Dontaions', SH_NAME) . '</p>
						<span><strong>' . sh_set($donation_data, 'paypal_currency') . '</strong> ' . sh_set($donation_data, 'paypal_raised') . '!</span> </div>
					  <div class="d-now">';
        if (sh_set($donation_data, 'donate_method') == 'true') {
            $output .= '<a  data-toggle="modal" data-target="#myModal"  class="donate-btn" title="">'.__( 'Donate Us', SH_NAME ).'</a>';
        } else {
            $output .= $paypal->button(array('currency_code' => sh_set($donation_data, 'paypal_currency_code'), 'item_name' => get_bloginfo('name'), 'return' => $return_url));
        }
        $output .= '</div>
				  </div>';
        
        $output .= '<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">';
        if (isset($_GET['recurring_pp_return']) && $_GET['recurring_pp_return'] == 'return') {
            $output .= '<div class="donate-popup">' . $paypal_res . '</div>';
            $output .= '<script>
								jQuery(document).ready(function($){
									$(".donate-us a.donate-btn").trigger("click");
								
								});
						</script>';
        } elseif ($notif = $paypal->_paypal->handleNotification() && isset($notif->ok)) {
            $output .= '<div class="donate-popup">' . $paypal_res . '</div>';
            $output .= '<script>
								jQuery(document).ready(function($){
									$(".donate-us a.donate-btn").trigger("click");
								
								});
						</script>';
        } else {
            $output .= '<div class="donate-popup">
		<div class="cause-bar">
			<div class="cause-box"><h3><span>' . $symbol . '</span>' . sh_set($donation_data, 'paypal_target') . '</h3><i>' . __('NEEDED DONATION', SH_NAME) . '</i></div>
			<div class="cause-progress">
					<div class="progress-report">
					<h6>' . __('PHASES', SH_NAME) . '</h6>
					<span>' . $donation_percentage . '%</span>
					<div class="progress pattern">
						<div class="progress-bar" style="width: ' . $donation_percentage . '%"></div>
					</div>
				</div>
			</div>
			<div class="cause-box"><h3><span>' . $symbol . '</span>' . sh_set($donation_data, 'paypal_raised') . '</h3><i>' . __('COLLECTED DONATION', SH_NAME) . '</i></div>
			<div class="cause-box donate-drop-btn"><h4>' . __('DONATE NOW', SH_NAME) . '</h4></div>
		</div>
		<div class="donate-drop-down">
			<div class="recursive-periods">';
			$Settings = get_option(SH_NAME); 
			$value = sh_set($Settings , 'transactions_detail');
				if($value)
				{
					foreach($value as $val )
					{
						$txt = ucwords(str_replace('_', ' ', $val));
						$output .= '<a style="cursor:pointer;">'.__( $txt, SH_NAME ).'</a>';
					}
				}
			$output .= '</div>
			<div class="amount-btns">';
				if( intval ( sh_set($Settings , 'pop_up_1st_value') ) != '') $output .= '<a style="cursor:pointer;">'.$symbol.'<span>'.sh_set($Settings , 'pop_up_1st_value').'</span></a>';
				if(intval ( sh_set($Settings , 'pop_up_2nd_value') ) != '') $output .= '<a style="cursor:pointer;">'.$symbol.'<span>'.sh_set($Settings , 'pop_up_2nd_value').'</span></a>';
				if(intval ( sh_set($Settings , 'pop_up_3rd_value') ) != '') $output .= '<a style="cursor:pointer;">'.$symbol.'<span>'.sh_set($Settings , 'pop_up_3rd_value').'</span></a>';
				if(intval ( sh_set($Settings , 'pop_up_4th_value') ) != '') $output .= '<a style="cursor:pointer;">'.$symbol.'<span>'.sh_set($Settings , 'pop_up_4th_value').'</span></a>';
				if(intval ( sh_set($Settings , 'pop_up_5th_value') ) != '') $output .= '<a style="cursor:pointer;">'.$symbol.'<span>'.sh_set($Settings , 'pop_up_5th_value').'</span></a>';
			$output .= '</div>';
            $output .= '<div class="other-amount">
					' . $paypal->button(array('item_name' => get_bloginfo('name'), 'amount' => 30, 'return' => $return_url)) . '
				</div>';
            if (!is_user_logged_in()) {
                $output .= '<form id="login" action="" method="post">
						<h1>Please Login OR Register first to make recursive donation</h1>
						<p class="status"></p>
						<label for="username">Username</label>
						<input id="username" type="text" name="username">
						<label for="password">Password</label>
						<input id="password" type="password" name="password">
						<a class="lost" href="' . wp_registration_url() . '">Register Now</a>
						<input class="submit_button" type="submit" value="Login" name="submit">
						<a class="close" href="">(close)</a>
						' . wp_nonce_field('ajax-login-nonce', 'security') . '
					</form>';
            }
            $output .= '</div>
				</div>';
        }
        $output .= '</div>';
        return $output;
    }
    function start_regular_donation($atts, $content = null)
    {
        extract(shortcode_atts(array(
            'title' => '',
            'sub_title' => '',
            'image' => '',
            'currency' => '$',
            'donation_needed' => '',
            'link_caption' => '',
            'text' => '',
            'heading_style' => 'simple',
            
        ), $atts));
        
        $title = sh_character_limit(25, $title);
        $SubTitle = (!empty($sub_title)) ? '<h5>' . sh_character_limit(26, $sub_title) . '</h5>' : '';
        $DonationNeeded = (!empty($donation_needed) || !empty($currency)) ? '<span>' . $currency . $donation_needed . ' </span>' : '';
        $output = '';
        
        
        $output .= '
					  <div class="donate-message">
					    ' . wp_get_attachment_image($image, '270x155') . '
						' . $SubTitle . '
						<p>' . $DonationNeeded . sh_character_limit(100, $text) . '</p>
						<a href="" title="">' . sh_character_limit(25, $link_caption) . '</a> 
					  </div>
				   ';
        
        return $output;
    }
    function ceo_message($atts, $content = null)
    {
        extract(shortcode_atts(array(
                'number' => '',
                'category' => '',
                'sort_by' => 'date',
                'sorting_order' => 'ASC',
				'overlap' =>	'',
            ), $atts)
        );
        $args = array('post_type' => 'dict_testimonials', 'posts_per_page' => $number, 'orderby' => $sort_by, 'order' => $sorting_order);
        if ($category != '') $args['tax_query'] = array(array('taxonomy' => 'testimonial_category', 'field' => 'id', 'terms' => (int)$category));
        $Posts = query_posts($args);
        $i = 1;
        $Message = $MessageNav = '';
        if (have_posts()): while (have_posts()): the_post();
            $Settings = get_post_meta(get_the_ID(), '_dict_testimonials_settings', true);
            $Message .= '<li>
						<div class="carusal-image-thumb"> 
							' . get_the_post_thumbnail(get_the_ID(), '150x150') . ' 
							<strong>' . sh_set($Settings, 'name') . ',</strong>
							<span class="carusal-image-thumb-name"> ' . sh_set($Settings, 'designation') . ' </span> 
						</div>
						<p>' . get_the_content() . '</p></a>
					 </li>';
            $i++;
        endwhile;
        endif;
        wp_reset_query();
		$output = '';
        $output .= '<div class="testimonial';
		if( $overlap == 'true' ): $output .= ' overlap'; endif;
		$output .= '">
			<div class="slideshow">
				<ul class="slides">
				  ' . $Message . '
				</ul>
			  </div>
		</div>
<script>
jQuery(document).ready(function($){
if( $(\'.slideshow\').length ){
		$(\'.slideshow\').flexslider({
			animation: "fade",
			animationLoop: false,
			slideShow:false,
			controlNav: true,	
			maxItems: 1,
			pausePlay: false,
			mousewheel:false,
			start: function(slider){
			  $(\'body\').removeClass(\'loading\');
			}
		});
	}
});
</script>';
        return $output;
    }
    /*function recent_news( $atts, $content = null )
	{
		extract( shortcode_atts( array( 
			'number' => '', 
			'title' => __('Recent News', SH_NAME), 
			'category' => '', 
			'sort_by' => 'date', 
			'sorting_order' => 'DESC',
			'heading_style' => 'simple' ,
			'margins' =>'' ), $atts ) 
		);
		$marginsarr = explode(',' , $margins);
		
		$News = $Thumb = '';
		wp_reset_query();
		$args = array('post_type' => 'post' , 'posts_per_page'=> $number , 'orderby' => $sort_by , 'order' => $sorting_order, 'category' => $category);
		//if($category != '') $args['category'] = array($category);
		
		$query = new WP_Query($args);
		//printr($query);
		
		$i = 1;
		
		if( $query->have_posts()): while( $query->have_posts() ): $query->the_post();
		
		$Settings = get_post_meta( get_the_ID(), '_post_settings', true );
		
		if( $video_link = sh_set( $Settings, 'video_link' ) )
		{
			$opt = get_post_meta( get_the_ID(), '_dictate_gal_videos', true );
			$video_data = sh_grab_video( $video_link, $opt );
			
			$PostMedia = '<div class="image"> 
							  <img src="'.sh_set( $video_data, 'thumb').'" style="width:261px; height:207px;" alt="'.sh_set( $video_data, 'title' ).'" /> 
							  <a class="html5lightbox" rel="prettyPhoto" href="'.$video_link.'" title="'.sh_set( $video_data, 'title' ).'"> 
								  <span><i class="icon-play"></i></span> 
							  </a> 
						  </div>';
			$CarouselThumb = '<img src="'.sh_set( $video_data, 'thumb').'" style="width:131px; height:78px;" alt="'.sh_set( $video_data, 'title' ).'" />';
		}
		else
		{
			$PostAttchment = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'large' );
			$PostMedia = '<div class="image">
							  '.get_the_post_thumbnail( get_the_ID(), '370x252' ).'
							  <a title="" href="'.sh_set( $PostAttchment, 0 ).'" rel="prettyPhoto" class="html5lightbox"><i class="icon-picture"></i></a>
						  </div>';
			$CarouselThumb = get_the_post_thumbnail( get_the_ID(), '270x155' );
		}
		
		$News .= '<div id="news'.$i.'">
					<div class="row">
						<div class="col-md-6 desc">
						  <h3><a href="'.get_permalink().'" title="">'.sh_character_limit( 35, get_the_title() ).'</a></h3>
						  <p>'.sh_character_limit( 340, get_the_content() ).'</p>
						</div>
						<div class="col-md-6">
							'.$PostMedia.'
						</div>
					</div>
				  </div>';
		$Thumb .= '<a href="#news'.$i.'">'.$CarouselThumb.'<span class="carusal-our-news">'.sh_character_limit( 17, get_the_title() ).'</span></a>';
		$i++;
		endwhile; 
		endif;
		wp_reset_query();
		wp_enqueue_script('carofredcsel');
		$output = '' ;
		$output.= ( in_array('top' , (array)$marginsarr)) ? '<div class="block"></div>' : ''; 
		$output .= ($heading_style == 'underline')? '<div class="sec-heading">
					'.sh_get_title( $title, 'h2', 'strong', TRUE ).'
				  </div>' : '' ;
		$output .= ($heading_style == 'modern')? '<div class="sec-title">
							'.sh_get_title( $title, 'h1', 'span', FALSE ).'
						</div>' : '' ;
		$output .= ($heading_style == 'simple')? '<div class="sec-heading2">
					'.sh_get_title( $title, 'h2', 'strong', TRUE ).'
				  </div>' : '' ;
		
		$output .= '<div class="carusal-slider">
					  <div id="carousel-wrapper">
						<div id="carousel">
						  '.$News.' 
						</div>
					  </div>
					  <div id="thumbs-wrapper">
						<div id="thumbs">'.$Thumb.'</div>
						<a id="prev" href="#"><i class="icon-angle-left"></i></a> <a id="next" href="#"><i class="icon-angle-right"></i></a> </div>
					</div>
					<script>
					jQuery(document).ready(function($){
						 $(\'#carousel\').carouFredSel({
						  responsive: true,
						  circular: false,
						  auto: false,
						  items: {
						   visible: 1,
						   width: 20,
						  },
						  scroll: {
						   fx: \'directscroll\'
						  }
						 });
						 $(\'#thumbs\').carouFredSel({
						  responsive: true,
						  circular: false,
						  infinite: false,
						  auto: false,
						  prev: \'#prev\',
						  next: \'#next\',
						  items: {
						   visible: {
							min: 1,
							max: 6
						   },
						   width: 200,
						   height: \'80%\'
						  }
						 });
						 $(\'#thumbs a\').click(function() {
						  $(\'#carousel\').trigger(\'slideTo\', \'#\' + this.href.split(\'#\').pop() );
						  $(\'#thumbs a\').removeClass(\'selected\');
						  $(this).addClass(\'selected\');
						  return false;
						 });
					});
					</script>
					';
		$output.= ( in_array('bottom' , (array)$marginsarr)) ? '<div class="block"></div>' : ''; 
		return $output ;
	}
	*/
    function recent_events($atts, $content = null)
    {
        extract(shortcode_atts(array(
                'title' => 'Recent Events',
                'number' => '',
                'category' => '',
                'sort_by' => 'date',
                'sorting_order' => 'ASC',
                'heading_style' => 'simple',
                ), $atts)
        );
        
        $args = array('post_type' => 'dict_event', 'posts_per_page' => $number, 'orderby' => $sort_by, 'order' => $sorting_order);
        if ($category) $args['tax_query'] = array(array('taxonomy' => 'event_category', 'field' => 'id', 'terms' => $category));
        query_posts($args);
        $Events = '';
        $i = 1;
        if (have_posts()): while (have_posts()): the_post();
            $Settings = get_post_meta(get_the_ID(), '_dict_event_settings', true);
            $PostThumbSize1 = ($i == 1) ? 'style="width:570px; height:184px;"' : 'style="width:100px; height:100px;"';
            $PostThumbSize2 = ($i == 1) ? '570x220' : '150x150';
            $EventOrganizer = ($i == 1 && sh_set($Settings, 'organizer')) ? '<li><a href="#" title=""><i class="icon-user"></i>' . __('by', SH_NAME) . ' ' . sh_set($Settings, 'organizer') . '</a></li>' : '';
            $EventdateDetails = '';
            if (sh_set($Settings, 'video_link')) {
                $video_link = sh_set($Settings, 'video_link');
                $video_data = sh_grab_video($video_link, $Settings);
                $PostMedia = '<div class="carou-post-img">
							  <img src="' . sh_set($video_data, 'thumb') . '" ' . $PostThumbSize1 . '  alt="' . sh_set($video_data, 'title') . '" />
							  <a title="' . sh_set($video_data, 'title') . '" href="' . $video_link . '" class="html5lightbox"><i class="icon-play"></i></a>
						  </div>';
            } else {
                //$PostMedia = get_the_post_thumbnail( get_the_ID(), $PostThumbSize );
                $PostAttchment = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'large');
                $PostMedia = '<div class="carou-post-img">
							  ' . get_the_post_thumbnail(get_the_ID(), $PostThumbSize2) . '
							  <a title="" href="' . sh_set($PostAttchment, 0) . '" class="html5lightbox"><i class="icon-picture"></i></a>
						  </div>';
            }
            if (!empty($Settings['start_date'])) {
                $Eventdate = new DateTime($Settings['start_date']);
                $EventdateDetails = '<li><a href="' . get_permalink() . '" title=""><i class="icon-calendar-empty"></i><span>' . $Eventdate->format('F') . '</span> ' . $Eventdate->format('d, Y') . '</a></li>';
            } else if (!empty($Settings['end_date'])) {
                $Eventdate = new DateTime($Settings['end_date']);
                $EventdateDetails = '<li><a href="' . get_permalink() . '" title=""><i class="icon-calendar-empty"></i><span>' . $Eventdate->format('F') . '</span> ' . $Eventdate->format('d, Y') . '</a></li>';
            }
            $Class = ($i == 1) ? 'recent-event' : 'recent-event  previous-event';
            $md_class = ($i == 1) ? 'col-md-12' : 'col-md-6';
            $Location = (sh_set($Settings, 'location')) ? '<li><a href="' . get_permalink() . '" title=""><i class="icon-map-marker"></i>in ' . sh_set($Settings, 'location') . '</a></li>' : '';
            $TitleLength = ($i == 1) ? 35 : 20;
            $Events .= '<div class="' . $md_class . '">
						<div class="' . $Class . '">
						  <div class="recent-event-img"> ' . $PostMedia . ' </div>
						  <h4><a href="' . get_permalink() . '" title="">' . sh_character_limit($TitleLength, get_the_title()) . '</a></h4>
						  <ul>
							' . $EventOrganizer . '
							' . $Location . '
							' . $EventdateDetails . '
						  </ul>
					   </div>
				   </div>';
            $i++;
        endwhile;
        endif;
        wp_reset_query();
        $output = '';
        
        
        $output .= '
				 
				  <div class="row">
					  ' . $Events . '
				  </div>
		';
        
        return $output;
    }
    function recent_events_2($atts, $content = null)
    {
        extract(shortcode_atts(array(
                'title' => 'Upcoming Events',
                'number' => 2,
                'category' => '',
                'sort_by' => 'date',
                'sorting_order' => 'ASC',
                'heading_style' => 'simple',
                ), $atts)
        );
        wp_enqueue_script(array('jquery-plugins', 'jquery-countdown-min'));
        $args = array('post_type' => 'dict_event', 'posts_per_page' => $number, 'orderby' => $sort_by, 'order' => $sorting_order);
        if ($category != '') $args['tax_query'] = array(array('taxonomy' => 'event_category', 'field' => 'id', 'terms' => (int)$category));
        $Posts = new WP_Query( $args );
        $Events = '';
        $count = 1;
        if ($Posts->have_posts()): while ($Posts->have_posts()): $Posts->the_post();
            $Settings = get_post_meta(get_the_ID(), '_dict_event_settings', true);
            $EventdateDetails = '';
            if (!empty($Settings['start_date'])) {
                $Eventdate = new DateTime($Settings['start_date']);
                $EventdateDetails = '<a href="' . get_permalink() . '" title=""><i class="icon-calendar-empty"></i><span>' . $Eventdate->format('F') . '</span> ' . $Eventdate->format('d, Y') . '</a>';
            } else if (!empty($Settings['end_date'])) {
                $Eventdate = new DateTime($Settings['end_date']);
                $EventdateDetails = '<a href="' . get_permalink() . '" title=""><i class="icon-calendar-empty"></i><span>' . $Eventdate->format('F') . '</span> ' . $Eventdate->format('d, Y') . '</a>';
            }
            $end_date = explode('-', sh_set($Settings, 'end_date'));
            $Location = (sh_set($Settings, 'location')) ? ' <a href="' . get_permalink() . '" title=""><i class="icon-map-marker"></i>In ' . sh_set($Settings, 'location') . '</a>' : '';
            $counter_class = "count-down" . $count;
            $variable = 'variable_' . $count;
            $Events .= '<div class="col-md-6">
						<div class="event">
						  <div class="event-thumb"> ' . get_the_post_thumbnail(get_the_ID(), '270x155') . '
							<div class="counter">
							  <ul class="' . $counter_class . '">
								   <li> <span class="days">00</span>
								   <p class="days_ref">DAYS</p>
								   </li>
								   <li> <span class="hours">00</span>
								   <p class="hours_ref">HOURS</p>
								   </li>
								   <li> <span class="minutes">00</span>
								   <p class="minutes_ref">MINTS</p>
								   </li>
								   <li> <span class="seconds">00</span>
								   <p class="seconds_ref">SECS</p>
								   </li>
							  </ul>
							</div>
						  </div>
						  <div class="event-intro">
							<h5><a href="' . get_permalink() . '" title="">' . sh_character_limit(35, get_the_title()) . '</a></h5>
							' . $EventdateDetails . $Location . ' 
						  </div>
					   </div>
				   </div>';
            $time = strtotime(sh_set($Settings, 'start_date'));
            $new_time = date('g:i a', $time);
            $date = strtotime(sh_set($Settings, 'start_date'));
            $c_t = date('g:i:s', $time);
            $c_d = date('m/d/Y', $date);
            $Events .= '<script>
					  jQuery(document).ready(function($){
						 jQuery(".' . $counter_class . '").downCount({
							date: "' . $c_d . ' ' . $c_t . '"
							});
					  });
					</script>
				   ';
            $count++;
        endwhile;
        endif;
        wp_reset_query();
        $output = '';
        
        $output .= '<div class="recent-events">';
        
        $output .= '<div class="row">
							' . $Events . '
						</div>
				  </div>';
        
        return $output;
    }
    function recent_events_3($atts, $content = null)
    {
        extract(shortcode_atts(array(
                'title' => 'Upcoming Event',
                'number' => '',
                'category' => '',
                'sort_by' => 'date',
                'sorting_order' => 'ASC',
                'heading_style' => 'simple',
                ), $atts)
        );
        
        $args = array('post_type' => 'dict_event', 'posts_per_page' => $number, 'orderby' => $sort_by, 'order' => $sorting_order);
        if ($category != '') $args['tax_query'] = array(array('taxonomy' => 'event_category', 'field' => 'id', 'terms' => $category));
        $Posts = query_posts($args);
        $Events = '';
        if (have_posts()): while (have_posts()): the_post();
            $Settings = get_post_meta(get_the_ID(), '_dict_event_settings', true);
            $EventdateDetails = '';
            if (sh_set($Settings, 'start_date')) {
                $Eventdate = new DateTime($Settings['start_date']);
                $EventdateDetails = '<li><a href="' . get_permalink() . '" title=""><i class="icon-calendar"></i>' . $Eventdate->format('M d Y') . '</a></li>';
            } else if (sh_set($Settings, 'end_date')) {
                $Eventdate = new DateTime($Settings['end_date']);
                $EventdateDetails = '<li><a href="' . get_permalink() . '" title=""><i class="icon-calendar"></i>' . $Eventdate->format('M d Y') . '</a></li>';
            }
            $TwitterLink = (sh_set($Settings, 'twitter_link')) ? '<li><a href="' . sh_set($Settings, 'twitter_link') . '" title=""><i class="icon-twitter"></i>' . __('Twitter Updates', SH_NAME) . '</a></li>' : '';
            $Organizer = (sh_set($Settings, 'organizer')) ? '<li><a href="' . get_permalink() . '" title=""><i class="icon-pencil"></i>' . sh_set($Settings, 'organizer') . '</a></li>' : '';
            $Events .= '<div class="upcoming-event"> 
					  <a href="' . get_permalink() . '" title="">' . get_the_post_thumbnail(get_the_ID(), '270x155') . '</a>
					  <h5>' . sh_character_limit(25, get_the_title()) . '</h5>
					  <ul>
						' . $TwitterLink . $EventdateDetails . $Organizer . '
					  </ul>
				   </div>';
        endwhile;
        endif;
        wp_reset_query();
        $title = sh_character_limit(20, $title);
        $output = '';
        
        
        $output .= $Events;
        
        return $output;
    }
    function successful_stories($atts, $content = null)
    {
        extract(shortcode_atts(array(
                'title' => 'Successful Stories',
                'number' => '',
                'category' => '',
                'sort_by' => 'date',
                'sorting_order' => 'ASC',
                'heading_style' => 'simple',
                ), $atts)
        );
        
        $args = array('post_type' => 'dict_project', 'posts_per_page' => $number, 'orderby' => $sort_by, 'order' => $sorting_order);
        if ($category != '') $args['tax_query'] = array(array('taxonomy' => 'project_category', 'field' => 'id', 'terms' => $category));
        $Posts = query_posts($args);
        $output = '';
        
        
        $output .= '
				  <div class="stories-carousel">
						<ul class="slides">';
        $chunk = array_chunk($Posts, 2);
        foreach ($chunk as $p) {
            $output .= '<li><div class="row">';
            foreach ($p as $pos) {
                $Settings = get_post_meta(sh_set($pos, 'ID'), '_dict_project_settings', true);
                $Location = (sh_set($Settings, 'location')) ? '<span><i class="icon-map-marker"></i>' . __('In', SH_NAME) . ' ' . sh_set($Settings, 'location') . '</span>' : '';
                $MoneySpent = (sh_set($Settings, 'spent_amount')) ? '<h6><i>' . sh_set($Settings, 'spent_amount_currency') . '</i> ' . sh_set($Settings, 'spent_amount') . '<span>' . __('Money Spent', SH_NAME) . '</span></h6>' : '';
                $output .= '<div class="col-md-6">
								<div class="story">
									<div class="story-img"> ' . get_the_post_thumbnail(sh_set($pos, 'ID'), '370x252') . '
									  <h5>' . sh_character_limit(25, sh_set($pos, 'post_title')) . '</h5>
									  <a href="' . get_permalink(sh_set($pos, 'ID')) . '" title=""><span></span></a> 
									</div>
									<div class="story-meta">
										<span><i class="icon-calendar-empty"></i>' . get_the_time(sh_set($pos, 'ID'), 'm-d-y') . '</span>
										<span><i class="icon-map-marker"></i>' . __("In ", SH_NAME) . ' ' . $Location . '</span>
										<p>' . __("Needed Donation ", SH_NAME) . '<strong>$ ' . sh_set($Settings, 'amount_needed') . '</strong></p>
									</div>
									<p>' . sh_character_limit(250, sh_set($pos, 'post_content')) . '</p>
									
								</div>
							</div>';
            }
            $output .= '</div></li>';
        }
        wp_reset_query();
        $output .= '	</ul>
					  </div>';
        
        return $output;
    }
    function welfare_projects($atts, $content = null)
    {
        extract(shortcode_atts(array(
                'title' => 'Our Welfare Projects',
                'number' => 6,
                'category' => '',
                'sort_by' => 'date',
                'sorting_order' => 'DESC',
                'heading_style' => 'simple',
                ), $atts)
        );
        
        $paypal = $GLOBALS['_sh_base']->donation;
        $args = array('post_type' => 'dict_project', 'posts_per_page' => $number, 'orderby' => $sort_by, 'order' => $sorting_order);
        if ($category != '') $args['tax_query'] = array(array('taxonomy' => 'project_category', 'field' => 'id', 'terms' => (int)$category));
       	$pro = new WP_Query( $args );
		$Project = '';		
		if( $pro->have_posts() ): while( $pro->have_posts() ): $pro->the_post();
            $Settings = get_post_meta(get_the_ID(), '_dict_project_settings', true);
            $Project .= '<div class="col-md-6">
						<div class="row">
							<div class="col-md-5">
								<div class="icon-box"> 
									<i style="color:' . sh_set($Settings, 'color', '#A5A4A4') . '" class="' . sh_set($Settings, 'font') . '"></i>
									<div class="need"><a href="' . get_permalink() . '">' . __('Donate Now', SH_NAME) . '</a></div>
								</div>
							</div>
							<div class="col-md-7">
								<div class="project-detail"> <a href="' . get_permalink() . '">' . sh_character_limit(18, get_the_title()) . '</a>
								  <span>' . __('NEEDED', SH_NAME) . ' $' . sh_set($Settings, 'amount_needed') . '</span>
								  <p>' . sh_excerpt(get_the_content(), 75) . ' </p>
							
								</div>
							</div>
						</div>
					 </div>';
        endwhile;
        endif;
        wp_reset_query();
        $output = '';
        
        
        $output .= '<div class="our-project-box">
						<div class="row">
						  ' . $Project . '
						</div>
					  </div>
				   ';
        
        return $output;
    }
    function welfare_projects_2($atts, $content = null)
    {
        extract(shortcode_atts(array(
                'title' => 'Our Welfare Projects',
                'number' => '',
                'category' => '',
                'sort_by' => 'date',
                'heading_style' => 'simple',
                'sorting_order' => 'ASC',
                ), $atts)
        );
        
        $paypal = $GLOBALS['_sh_base']->donation;
        $args = array('post_type' => 'dict_project', 'posts_per_page' => $number, 'orderby' => $sort_by, 'order' => $sorting_order);
        if ($category != '') $args['tax_query'] = array(array('taxonomy' => 'project_category', 'field' => 'id', 'terms' => $category));
        $Posts = query_posts($args);
        $Project = '';
        if (have_posts()): while (have_posts()): the_post();
            $Settings = get_post_meta(get_the_ID(), '_dict_project_settings', true);
            $Project .= '<div class="col-md-4">
						<div class="row">
							<div class="col-md-5">
								<div class="icon-box"> <i style="color:' . sh_set($Settings, 'color', '#A5A4A4') . '" class="' . sh_set($Settings, 'font') . '"></i>
									<div class="need"><a href="' . get_permalink() . '">' . __('Donate Now', SH_NAME) . '</a></div>
								</div>
							</div>
							<div class="col-md-7">
								<div class="project-detail"> <a href="' . get_permalink() . '">' . sh_character_limit(18, get_the_title()) . '</a>
									 <span>' . __('NEEDED', SH_NAME) . ' $' . sh_set($Settings, 'amount_needed') . '</span>
									<p>' . sh_excerpt(get_the_content(), 75) . '</p>
								</div>
							</div>
						</div>
					</div>';
        endwhile;
        endif;
        wp_reset_query();
        $output = '';
        
        
        $output .= '<div class="our-project-box">
					  <div class="row">
						' . $Project . '
					  </div>
					</div>';
        
        return $output;
    }
    function block_quotes($atts, $content = null)
    {
        extract(shortcode_atts(array('title' => '', 'blockquotes' => ''), $atts));
        $output = '<section class="element" id="blockquotes-style">
					  <h3 class="sub-head">' . $title . '</h3>
					  <blockquote><i class="icon-quote-left"></i>' . $blockquotes . '<i class="icon-quote-right"></i></blockquote>
				   </section>';
        return $output;
    }
    function boxed_block_quotes($atts, $content = null)
    {
        extract(shortcode_atts(array('title' => '', 'text1' => '', 'text2' => '', 'blockquotes' => ''), $atts));
        $TextBeforeBlockQuote = (!empty($text1)) ? '<p>' . $text1 . '</p><br />' : '';
        $TextAfterBlockQuote = (!empty($text2)) ? '<p>' . $text2 . '</p>' : '';
        $output = '<section class="element" id="blockquotes-style">
					  <h3 class="sub-head">' . $title . '</h3>
					  <blockquote><i class="icon-quote-left"></i>' . $text . '<i class="icon-quote-right"></i></blockquote>
				   </section>
				   
				   <section class="element" >
					  <h3 class="sub-head">' . $title . '</h3>
					  ' . $TextBeforeBlockQuote . '
					  <blockquote class="boxed-quote"><i class="icon-quote-left"></i>' . $blockquotes . '<i class="icon-quote-right"></i></blockquote>
					  ' . $TextAfterBlockQuote . '
				   </section>';
        return $output;
    }
    function highlight_text($atts, $content = null)
    {
        extract(shortcode_atts(array('text' => '', 'rounded' => ''), $atts));
        $Class = ($rounded = 1) ? 'highlight rounded' : 'highlight';
        return '<p class="highlight rounded">' . $text . '</p>';
    }
    function button($atts, $content = null)
    {
        extract(shortcode_atts(array('text' => '', 'link' => '', 'size' => 'small', 'color' => 'skyblue'), $atts));
        return '<a href="' . $link . '" title="' . $text . '" class="theme-btn ' . $color . ' ' . $size . '">' . $text . '</a>';
    }
    function list_item($atts, $content = null)
    {
        extract(shortcode_atts(array('text' => '', 'style' => 'icon-check'), $atts));
        return '<li><i class="' . $style . '"></i>' . $text . '</li>';
    }
    function alert_box($atts, $content = null)
    {
        extract(shortcode_atts(array('type' => 'done', 'title' => '', 'message' => ''), $atts));
        $title .= (!empty($title)) ? '! ' : '';
        if ($type == 'done') $Icon = 'icon-ok';
        else if ($type == 'attention') $Icon = 'icon-exclamation-sign';
        else if ($type == 'cancel') $Icon = 'icon-remove';
        else if ($type == 'warning') $Icon = 'icon-warning-sign';
        return '<div class="alert-box ' . $type . '"> <i class="' . $Icon . '"></i>
				  <h4>' . $title . '<span>' . $message . '</span></h4>
				</div>';
    }
    function social_media_icon($atts, $content = null)
    {
        extract(shortcode_atts(array('media' => 'social_facebook'), $atts));
        return '<i class="' . str_replace('_', ' ', $media) . '"></i>';
    }
    function progressbar($atts, $content = null)
    {
        extract(shortcode_atts(array('title' => '', 'percentage' => '0', 'pattren' => '', 'position' => 'within-progress-bar'), $atts));
        $Title = (!empty($title)) ? '<h6>' . $title . '</h6>' : '';
        $Top = ($position == 'top') ? '<span>' . $percentage . '%</span>' : '';
        $Middle = ($position == 'within-progress-bar') ? '<span>' . $percentage . '%</span>' : '';
        return '<div class="progress-report">
				  ' . $Title . $Top . '
				  <div class="progress pattern">
					<div class="progress-bar" style="width: ' . $percentage . '%"><span>' . $Middle . '</span></div>
				  </div>
				</div>';
    }
    function price_table($atts, $content = null)
    {
        extract(shortcode_atts(array(
            'title' => '',
            'sub_title' => '',
            'description' => '',
            'short_desc' => '',
            'currency' => '',
            'price' => '',
            'duration' => '',
            'option1' => '',
            'option2' => '',
            'option3' => '',
            'link' => ''
        ), $atts));
        $ShortDesc = (!empty($short_desc)) ? '<span><p>' . $short_desc . '</span>' : '';
        $Description = (!empty($description)) ? '<li class="table-desc"><p>' . $description . '</p></li>' : '';
        $Options = '';
        $Options .= (!empty($option1)) ? '<li><i class="icon-ok-sign"></i>' . $option1 . '</li>' : '';
        $Options .= (!empty($option2)) ? '<li><i class="icon-ok-sign"></i>' . $option2 . '</li>' : '';
        $Options .= (!empty($option3)) ? '<li><i class="icon-ok-sign"></i>' . $option3 . '</li>' : '';
        $output = '</ul>
				   <ul>
					  <li class="table-head">
						<h3>' . $title . '</h3>
						' . $ShortDesc . '
					  </li>
					  ' . $Description . '
					  ' . $Options . '
					  <li class="price-per-year"><i>' . $currency . '</i> ' . $price . '<span>' . $duration . '</span></li>
					  <li class="table-btn"><a href="' . $link . '" title="">' . __('Select Plan', SH_NAME) . '</a></li>
				   </ul>';
        return $output;
    }
    function charity_video($atts, $content = null)
    {
        extract(shortcode_atts(array(
                'title' => 'Charity Video',
                'heading_style' => 'simple',
                'video_title' => '',
                'video_link' => '',
                'description' => '',
                ), $atts)
        );
        
        $title = sh_character_limit(15, $title);
        $opt = get_post_meta(get_the_ID(), '_dictate_gal_videos', true);
		$url = 'http://vimeo.com/'.$video_link;
        $video_data = sh_grab_video($url, $opt);
        $output = '';
        
        
        $output .= ' <div class="charity-video">
					  <div class="row">
						<div class="col-md-6 desc">
						  <h3><a href="javascript:void(0)" title="">' . sh_character_limit(35, $video_title) . '</a></h3>
						  <p>' . sh_character_limit(310, $description) . '</p>
						</div>
						<div class="col-md-6">
							<div class="image"> <img src="' . sh_set($video_data, 'thumb') . '" style="width:270px; height:184px;" alt="' . sh_set($video_data, 'title') . '" /> <a class="html5lightbox" href="http://player.vimeo.com/video/' . $video_link . '" title="' . $video_title . '"> <span><i class="icon-play"></i></span> </a> </div>
					  	</div>
						</div>
					  </div>';
        
        return $output;
    }
    function charity_video2($atts, $content = null)
    {
        extract(shortcode_atts(array(
                'title' => '',
                'video_link' => '',
                'duration' => '',
                'projects' => '',
                'members' => '',
                'description' => '',
                ), $atts)
        );
        
        $opt = get_post_meta(get_the_ID(), '_dictate_gal_videos', true);
		$url = 'http://vimeo.com/'.$video_link;
        $video_data = sh_grab_video($url, $opt);
        $CharityDuration = (!empty($duration)) ? '<li><h6>' . $duration . '</h6><span>' . __("Years In Charity", SH_NAME) . '</span></li>' : '';
        $CharityProjects = (!empty($projects)) ? '<li><h6>' . $projects . '</h6><span>' . __("Project Handled", SH_NAME) . '</span></li>' : '';
        $StafMembers = (!empty($members)) ? '<li><h6>' . $members . '</h6><span>' . __("Staff Members", SH_NAME) . '</span></li>' : '';
        $output = '';
        
        $output .= '<div class="about-charity">
					  <div class="container">
						<div class="row">
						  <div class="about-charity-desc col-md-7">
							<h2>' . sh_character_limit(35, $title) . '</h2>
							<p>' . sh_character_limit(385, $description) . '</p>
							<ul>
							  ' . $CharityDuration . $CharityProjects . $StafMembers . '
							</ul>
						  </div>
						  <div class="col-md-5">
							<div class="about-charity-video"> <img src="' . sh_set($video_data, 'thumb') . '" style="width:470px; height:278px;" alt="' . sh_set($video_data, 'title') . '" /> <a class="html5lightbox" href="http://player.vimeo.com/video/' . $video_link . '" title="' . sh_set($video_data, 'title') . '"><span><i class="icon-play"></i></span></a> </div>
						  </div>
						</div>
					  </div>
				   </div>';
        
        return $output;
    }
    function team($atts, $content = null)
    {
        extract(shortcode_atts(array(
                'category' => '',
                'sort_by' => 'date',
                'number' => 10,
                'sorting_order' => 'ASC',
                ), $atts)
        );
        
        $args = array('post_type' => 'dict_team', 'posts_per_page' => $number, 'orderby' => $sort_by, 'order' => $sorting_order);
        if ($category != '') $args['tax_query'] = array(array('taxonomy' => 'team_category', 'field' => 'id', 'terms' => $category));
        $Posts = query_posts($args);
        $i = 1;
        $Records = '';
        if (have_posts()): while (have_posts()): the_post();
            global $post;
            $Settings = get_post_meta(get_the_ID(), '_dict_team_settings', true);
            $Name = (sh_set($Settings, 'name')) ? '<h3><a href="' . get_permalink() . '">' . sh_character_limit(30, sh_set($Settings, 'name')) . '</a></h3>' : '';
            $Designation = (sh_set($Settings, 'designation')) ? '<span>' . sh_character_limit(30, sh_set($Settings, 'designation')) . '</span>' : '';
            $FbLink = (sh_set($Settings, 'fb_link')) ? '<li><a href="' . sh_set($Settings, 'fb_link') . '" title=""><img src="' . get_template_directory_uri() . '/images/facebook.jpg" alt="" /></a></li>' : '';
            $GPlusLink = (sh_set($Settings, 'gplus_link')) ? '<li><a href="' . sh_set($Settings, 'gplus_link') . '" title=""><img src="' . get_template_directory_uri() . '/images/gplus.jpg" alt="" /></a></li>' : '';
            $Records .= '<div class="col-md-3">
					  <div class="staff-member"> ' . get_the_post_thumbnail(get_the_ID(), '570x570') . '
						<div class="member-intro">
						  ' . $Name . '
						  ' . $Designation . '
						</div>
						<div class="social-contacts">
						  <ul>
							' . $FbLink . '
							' . $GPlusLink . '
						  </ul>
						</div>
					  </div>
					 </div>';
        endwhile;
        endif;
        wp_reset_query();
        $output = '';
        
        $output .= '<div class="container">
					  <div class="staff">
						<div class="row">
						  ' . $Records . '
						</div>
					  </div>
				   </div>';
        
        return $output;
    }
    function shop_online($atts, $content = null)
    {
        extract(shortcode_atts(array(
                'number' => '',
                'title' => 'Shop Online For Donation',
                'heading_style' => 'simple',
                'category' => '',
                'sort_by' => 'date',
                'sorting_order' => 'ASC',
                ), $atts)
        );
        
        global $woocommerce, $product;
        //ob_start();
        $query_args = array(
            'posts_per_page' => $number,
            'post_type' => 'product',
        );
        $query_args['meta_query'] = array();
        $query_args['meta_query'][] = $woocommerce->query->stock_status_meta_query();
        $query = new WP_Query($query_args);
        include(get_template_directory() . '/framework/modules/product.php');
        return $output;
    }
    /*function our_blog($atts, $content = null)
    {
        extract(shortcode_atts(array(
                'title' => '',
                
            ), $atts)
        );
        
        $args = array('posts_per_page' => 3);
        $output = '';
        
        
        $output .= '<div class="main-blog row">';
        $posts = get_posts($args);
        foreach ($posts as $pos):
            $post_meta = get_post_meta(sh_set($pos, 'ID'), '_post_settings', true);
            $output .= '<div class="col-md-6"><div class="blog-post">';
            $image = wp_get_attachment_image_src(get_post_thumbnail_id(sh_set($pos, 'ID')), '1170x455');
            $output .= '<a class="blog-post-img" href="' . get_permalink(sh_set($pos, 'ID')) . '" title=""><img src="' . sh_set($image, 0) . '" alt=""></a>';
            $output .= '<h2><a href="' . get_permalink(sh_set($pos, 'ID')) . '" title="">' . get_the_title(sh_set($pos, 'ID')) . '</a></h2>';
            $output .= '<div class="blog-post-details">
					<ul class="post-meta">
						<li><a href="" title=""><i class="icon-calendar-empty"></i><span>' . get_the_time("M", sh_set($pos, 'ID')) . '</span> ' . get_the_time("d-Y", sh_set($pos, 'ID')) . '</a></li>
						<li><a href="" title=""><i class="icon-share-alt"></i>' . sh_set(sh_set(get_the_category(sh_set($pos, 'ID')), 0), 'name') . '</a></li>
						<li><a href="" title=""><i class="icon-map-marker"></i>' . __("In", SH_NAME) . ' ' . sh_set($post_meta, 'location') . '</a></li>
					</ul>';
            $output .= '<div class="post-desc"><p>' . substr(strip_tags(sh_set($pos, 'post_content')), 0, 150) . '</p></div>';
            $output .= '</div></div></div>';
        endforeach;
        wp_reset_query();
        $output .= '</div>';
        
        return $output;
    }*/
    function services($atts, $content = null)
    {
        extract(shortcode_atts(array(
                'sort_by' => '',
                'sorting_order' => '',
                
                'linked' => '',
                'overlap' => '',
            ), $atts)
        );
        
        $args = array('post_type' => 'dict_services', 'posts_per_page' => 6, 'orderby' => $sort_by, 'order' => $sorting_order);
        $services = get_posts($args);
        $output = '';
        
        $uphalf_class = ($overlap) ? 'up-half' : '';
        $output .= '
		<div class="' . $uphalf_class . '"><div class="services">';
        foreach ($services as $service):
            $meta = get_post_meta(sh_set($service, 'ID'), '_dict_services_settings', true);
            $output .= '<div class="col-md-2">
					<div class="box">
						<i class="' . sh_set($meta, 'font_awesome') . '"></i>';
            $output .= '<h4>';
            $output .= ($linked) ? '<a href="' . get_permalink(sh_set($service, 'ID')) . '">' : '';
            $output .= get_the_title(sh_set($service, 'ID'));
            $output .= ($linked) ? '</a>' : '';
            $output .= '</h4>';
            $output .= '
					</div>
				</div>';
        endforeach;
        $output .= '</div></div></div>';
        
        return $output;
        wp_reset_query();
    }
    function Gallery($atts, $content = null)
    {
        extract(shortcode_atts(array(
                
                'cols' => '',
                'num' => 10,
            ), $atts)
        );
        wp_enqueue_script(array('bootstrap'));
        
        $args = array('post_type' => 'dict_gallery', 'posts_per_page' => $num);
        $columns = array(1 => 'col-md-12', 2 => 'col-md-6', 3 => 'col-md-4', 4 => 'col-md-3');
        $max_limit_arr = array(1 => 6, 2 => 3, 3 => 2, 4 => 2);
        $col_class = sh_set($columns, $cols);
        if ($cols == 1 || $cols == 2) $featured_image_size = "1170x455";
        elseif ($cols == 3) $featured_image_size = "370x252";
        elseif ($cols == 4) $featured_image_size = "270x155";
        $max_limit = sh_set($max_limit_arr, $cols);
        $output = '';
        
        $output .= '<ul class="gallery-tabs nav nav-tabs" id="myTab">';
        $taxonomies = sh_get_categories(array('taxonomy' => 'gallery_category', 'hide_empty' => false));
        $galleries = array();
        $count = 1;
        foreach ($taxonomies as $id => $tax_name):
            $args['tax_query'] = array(array('taxonomy' => 'gallery_category', 'field' => 'id', 'terms' => $id));
            $galleries[$tax_name] = get_posts($args);
            $active_class = ($count == 1) ? 'active' : '';
            $output .= '<li class="' . $active_class . '"><a data-toggle="tab" href="#cat_' . $tax_name . '">' . $tax_name . '</a></li>';
            $count++;
        endforeach;
        $output .= '</ul>';
        $output .= '<div class="gallery-content tab-content" id="myTabContent">';
        $count_2 = 1;
        foreach ($galleries as $tax => $gal_posts):
            $active_class_ = ($count_2 == 1) ? 'active' : '';
            $output .= '<div id="cat_' . $tax . '" class="tab-pane fade in ' . $active_class_ . '">
							<div class="row">';
            foreach ($gal_posts as $gal):
                $output .= '<div class="' . $col_class . '">';
                $featured_image = sh_set(wp_get_attachment_image_src(get_post_thumbnail_id(sh_set($gal, 'ID')), $featured_image_size), 0);
                $output .= '<div class="gallery-image"><img src="' . $featured_image . '" alt="" />';
                $output .= '<span>' . get_the_term_list($gal->ID, 'gallery_category', '', ' / ', '') . '</span>';
                $output .= '<div class="image-lists"><ul>';
                $Settings = get_post_meta(sh_set($gal, 'ID'), '_dict_gallery_settings', true);
                $GalleryAttachments = get_posts(array('post_type' => 'attachment', 'post__in' => explode(',', sh_set($Settings, 'gallery'))));
                $limiter = 1;
                foreach ($GalleryAttachments as $thumb_image):
                    $Thumb = sh_set(wp_get_attachment_image_src(sh_set($thumb_image, 'ID'), '150x150'), '0');
                    $LargeThumb = sh_set(wp_get_attachment_image_src(sh_set($thumb_image, 'ID'), '1170x455'), '0');
                    $output .= '<li>
								<a class="html5lightbox" href="' . $LargeThumb . '" data-group="group' . sh_set($gal, 'ID') . '" title="">
									<img src="' . $Thumb . '" alt="" />
								</a>
							  </li>';
                    if ($limiter < $max_limit) $limiter++;
                    else break;
                endforeach;
                $output .= '</ul></div>';
                $output .= '</div>';
                $output .= '<h3 class="image-title"><a href="' . get_permalink(sh_set($gal, 'ID')) . '" title="">' . sh_set($gal, 'post_title') . '</a></h3>';
                $output .= '</div>';
            endforeach;
            $output .= '		</div>
					  </div>';
            $count_2++;
        endforeach;
        $output .= '</div>';
        
        wp_reset_query();
        return $output;
    }
    function portfolio_without_sidebar($atts, $content = null)
    {
        extract(shortcode_atts(array(
                
                'cols' => '',
                'num' => '',
            ), $atts)
        );
        wp_enqueue_script(array('jquery_isotope'));
        
        $args = array('post_type' => 'dict_portfolio', 'posts_per_page' => $num);
        $portfolios = get_posts($args);
        $page_meta = get_post_meta(get_the_ID(), '_page_settings', true);
        $columns = array(2 => 'col-md-6', 3 => 'col-md-4', 4 => 'col-md-3');
        $col_class = sh_set($columns, $cols);
        $output = '';
        
        $output .= '<section id="options"><div class="option-combo">
		<ul id="filter" class="option-set" data-option-key="filter"><li><a href="#show-all" data-option-value="*" class="selected">' . __("All", SH_NAME) . '</a></li>';
        $taxonomies = sh_get_categories(array('taxonomy' => 'portfolio_category'));
        foreach ($taxonomies as $tax_id => $tax_name):
            $output .= '<li><a href="#category' . $tax_id . '" data-option-value=".category' . $tax_id . '">' . $tax_name . '</a></li>';
        endforeach;
        $output .= '</ul></section>';
        $output .= '<div class="row"><div id="portfolio" class="variable-sizes bounceinup">';
        $loop_count = 1;
        foreach ($portfolios as $portfolio):
            $thumb_size = ($loop_count == 1) ? '370x491' : '370x252';
            $post_term = get_the_terms($portfolio, 'portfolio_category');
            $output .= '<div class="category' . sh_set(current($post_term), 'term_id') . ' ' . $col_class . '">
						<div class="portfolio">
							' . get_the_post_thumbnail(sh_set($portfolio, 'ID'), $thumb_size) . '
							<div class="port-desc">
								<h4><a href="' . get_permalink(sh_set($portfolio, 'ID')) . '">' . get_the_title(sh_set($portfolio, 'ID')) . '</a></h4>
								<p>' . substr(strip_tags(sh_set($portfolio, 'post_content')), 0, 200) . '</p>
							</div>
						</div>
					</div>';
            $loop_count++;
            if ($loop_count > 2) $loop_count = 1;
        endforeach;
        $output .= '</div></div></div>
		<script>
			jQuery(document).ready(function($){
			jQuery(function($){
			  var $portfolio = $(\'#portfolio\');
			
			  $portfolio.isotope({
				masonry: {
				  columnWidth: 1
				}
			  });
			  var $optionSets = $(\'#options .option-set\'),
				  $optionLinks = $optionSets.find(\'a\');
			  $optionLinks.click(function(){
				var $this = $(this);
				// don\'t proceed if already selected
				if ( $this.hasClass(\'selected\') ) {
				  return false;
				}
				var $optionSet = $this.parents(\'.option-set\');
				$optionSet.find(\'.selected\').removeClass(\'selected\');
				$this.addClass(\'selected\');
				var options = {},
					key = $optionSet.attr(\'data-option-key\'),
					value = $this.attr(\'data-option-value\');
				// parse \'false\' as false boolean
				value = value === \'false\' ? false : value;
				options[ key ] = value;
				if ( key === \'layoutMode\' && typeof changeLayoutMode === \'function\' ) {
				  // changes in layout modes need extra logic
				  changeLayoutMode( $this, options )
				} else {
				  // otherwise, apply new options
				  $portfolio.isotope( options );
				}
				return false;
			  });
			});
			});
			</script>
		';
        
        return $output;
    }
    function portfolio_with_sidebar($atts, $contents = null)
    {
        extract(shortcode_atts(array(
                
                'cols' => '',
                'num' => '',
            ), $atts)
        );
        wp_enqueue_script(array('jquery_isotope'));
        
        $args = array('post_type' => 'dict_portfolio', 'posts_per_page' => $num);
        $portfolios = get_posts($args);
        $page_meta = get_post_meta(get_the_ID(), '_page_settings', true);
        $sidebar = sh_set($page_meta, 'sidebar') ? sh_set($page_meta, 'sidebar') : 'default-sidebar';
        $columns = array(2 => 'col-md-6', 3 => 'col-md-4');
        $col_class = sh_set($columns, $cols);
        $output = '';
        
        $output .= '<div class="row"><div class="left-content col-md-9">
		<section id="options"><div class="option-combo">
		<ul id="filter" class="option-set" data-option-key="filter">
		<li><a href="#show-all" data-option-value="*" class="selected">' . __("All", SH_NAME) . '</a></li>';
        $taxonomies = sh_get_categories(array('taxonomy' => 'portfolio_category'));
        foreach ($taxonomies as $tax_id => $tax_name):
            $output .= '<li><a href="#category' . $tax_id . '" data-option-value=".category' . $tax_id . '">' . $tax_name . '</a></li>';
        endforeach;
        $output .= '</ul></div></section>';
        $output .= '<div class="row">
		<div id="portfolio" class="variable-sizes bounceinup">';
        $loop_count = 1;
        foreach ($portfolios as $portfolio):
            $thumb_size = ($loop_count == 1) ? '370x491' : '370x252';
            $post_term = get_the_terms($portfolio, 'portfolio_category');
            $output .= '<div class="category' . sh_set(current($post_term), 'term_id') . ' ' . $col_class . '">
						<div class="portfolio">
							' . get_the_post_thumbnail(sh_set($portfolio, 'ID'), $thumb_size) . '
							<div class="port-desc">
								<h4><a href="' . get_permalink(sh_set($portfolio, 'ID')) . '">' . get_the_title(sh_set($portfolio, 'ID')) . '</a></h4>
								<p>' . substr(strip_tags(sh_set($portfolio, 'post_content')), 0, 200) . '</p>
							</div>
						</div>
					</div>';
            $loop_count++;
            if ($loop_count > 2) $loop_count = 1;
        endforeach;
        $output .= '</div></div></div>';
        ob_start();
        dynamic_sidebar($sidebar);
        $dynamic_sidebar = ob_get_contents();
        ob_end_clean();
        $output .= '<div class="sidebar col-md-3 ">' . $dynamic_sidebar . '</div>';
        $output .= '</div>
		<script>
			jQuery(document).ready(function($){
			jQuery(function($){
			  var $portfolio = $(\'#portfolio\');
			
			  $portfolio.isotope({
				masonry: {
				  columnWidth: 1
				}
			  });
			  var $optionSets = $(\'#options .option-set\'),
				  $optionLinks = $optionSets.find(\'a\');
			  $optionLinks.click(function(){
				var $this = $(this);
				// don\'t proceed if already selected
				if ( $this.hasClass(\'selected\') ) {
				  return false;
				}
				var $optionSet = $this.parents(\'.option-set\');
				$optionSet.find(\'.selected\').removeClass(\'selected\');
				$this.addClass(\'selected\');
				var options = {},
					key = $optionSet.attr(\'data-option-key\'),
					value = $this.attr(\'data-option-value\');
				// parse \'false\' as false boolean
				value = value === \'false\' ? false : value;
				options[ key ] = value;
				if ( key === \'layoutMode\' && typeof changeLayoutMode === \'function\' ) {
				  // changes in layout modes need extra logic
				  changeLayoutMode( $this, options )
				} else {
				  // otherwise, apply new options
				  $portfolio.isotope( options );
				}
				return false;
			  });
			});
			});
			</script>
		';
        
        return $output;
    }
    function video_gallery($atts, $contents = null)
    {
        extract(shortcode_atts(array(
                
                'cols' => '',
                'play_options' => '',
                'links' => '',
            ), $atts)
        );
        
        $vid_links = explode(',', $links);
        $output = '';
        
        $output .= '<div class="gallery-content">
					<div class="row">';
        foreach ($vid_links as $vid):
            $video_data = sh_grab_video($vid, $vid_links);
            $output .= '<div class="col-md-' . $cols . '">';
            $output .= '';
            $output .= ($play_options == 'simple') ?
                '<div class="gallery-video"><iframe src="http://player.vimeo.com/video/' . sh_set($video_data, 'id') . '" ></iframe></div>'
                : '<div class="gallery-image"><img src="' . sh_set($video_data, 'thumb') . '" alt="" />
			<span>' . sh_set($video_data, 'title') . '</span>
			<div class="image-lists"><ul><li><a class="video-popup html5lightbox" href="http://player.vimeo.com/video/' . sh_set($video_data, 'id') . '" data-group="group1" title=""></a></li></ul></div>
						</div>';
            $output .= '<h3 class="image-title"><a href="#" title="">' . sh_set($video_data, 'title') . '</a></h3>
					</div>';
        endforeach;
        $output .= '</div></div>';
        
        return $output;
    }
    function leave_message($atts, $content = null)
    {
        extract(shortcode_atts(array(
            'title' => 'Leave A Message',
            'text' => '',
        ), $atts));
        $output = '<div class="message-box">
					<div class="message-box-title">			
						<span><i class="icon-envelope-alt"></i></span>
						<p>' . $title . '</p>
						<i class="icon-angle-up icon-angle-down"></i>
					</div>
					<div class="message-form" style="display: none;">
						<p>' . $text . '</p>
						<form id="lifeline_contactform_2" name="contactform" action="' . admin_url('admin-ajax.php?action=dictate_ajax_callback&subaction=sh_message_form_submit') . '" method="post">
							<div class="msgs"></div>
							<input type="text" placeholder="' . __("Name", SH_NAME) . '" value="" size="30" id="name" class="form-control" name="contact_name">
							<input type="text" placeholder="' . __("Email", SH_NAME) . '" value="" size="30" id="email" class="form-control" name="contact_email">
							<textarea placeholder="' . __("Your Message", SH_NAME) . '" class="form-control" id="comments" rows="3" name="contact_message"></textarea>
							<input type="submit" value="' . __("SEND MESSAGE", SH_NAME) . '" id="submit" class="submit-btn submit">
							</form>
					</div>
				</div>';
        $output .= '';
        return $output;
    }
    function qoutes_slider($atts, $content = null)
    {
        extract(shortcode_atts(array(
            'number' => 4,
            
        ), $atts));
        
        $options = get_option(SH_NAME);
        $output = '';
        
        $output .= '<section class="block">
						<div class="client-reviews">
							<ul class="slides">
					';
        for ($i = 0; $i <= $number; $i++) {
            $output .= '<li class="">
							<div class="reviews effect5">
								<h3><span>"</span>
								' . sh_set(sh_set($options, 'qoutation_text'), $i) . '
								<span>"</span></h3>
							</div>
						</li>';
        }
        $output .= '</ul>
			</div>
		</section>
		<script>
		jQuery(document).ready(function($){
		  $(\'.client-reviews\').flexslider({
			animation: "fade",
			animationLoop: false,
			slideShow:true,
			controlNav: false,	
			maxItems: 1,
			pausePlay: false,
			mousewheel:false,
			start: function(slider){
			  $(\'body\').removeClass(\'loadings\');
			}
			});	
		});
		</script>
		';
        
        return $output;
    }
    function issues_we_work($atts, $content = null)
    {
        extract(shortcode_atts(array(
            'section_title' => '',
            'heading_style' => 'simple',
            'number' => 4,
            'sort_by' => '',
            'sorting_order' => '',
            'category' => '',
            
        ), $atts));
        
        $args = array('post_type' => 'dict_causes', 'posts_per_page' => $number, 'orderby' => $sort_by, 'order' => $sorting_order);
        if ($category) $args['tax_query'] = array(array('taxonomy' => 'causes_category', 'field' => 'id', 'terms' => $category));
        query_posts($args);
        $output = '';
        
        
        if (have_posts()): while (have_posts()): the_post();
            $output .= '<div class="issue">
						' . get_the_post_thumbnail(get_the_ID(), "150x150") . '
						<h4>' . get_the_title(get_the_ID()) . '</h4>
				  </div>';
        endwhile; endif;
        wp_reset_query();
        
        $output .= '';
        return $output;
    }
    function latest_news_slider($atts, $content = null)
    {
        extract(shortcode_atts(array(
            'section_title' => '',
            'heading_style' => 'simple',
            'number' => 4,
            'sort_by' => '',
            'sorting_order' => '',
            'category' => '',
            
        ), $atts));
        
        $args = array('post_type' => 'post', 'posts_per_page' => $number, 'orderby' => $sort_by, 'order' => $sorting_order);
        if ($category) $args['tax_query'] = array(array('taxonomy' => 'category', 'field' => 'id', 'terms' => $category));
        $blog_posts = get_posts($args);
        $posts_chunks = array_chunk($blog_posts, 4);
        $output = '';
        
        $output .= '<section><div class="row"><div class="col-md-12">';
        
        $output .= '<div class="latest-news">
						<ul class="slides">';
        foreach ($posts_chunks as $chunk):
            $output .= '<li><div class="row">';
            foreach ($chunk as $c):
                $output .= '<div class="col-md-3">
					<div class="news">
						<div class="news-image">
							' . get_the_post_thumbnail(sh_set($c, 'ID'), "270x155") . '
							<a class="html5lightbox" href="images/blank.jpg"><i class="icon-search"></i></a>
						</div>
						<h3>' . get_the_title(sh_set($c, 'ID')) . '</h3>
						<p>' . substr(strip_tags(sh_set($c, 'post_content')), 0, 50) . '</p>
					</div>
				</div>';
            endforeach;
            $output .= '</div></li>';
        endforeach;
        $output .= '</ul></div></div></div></section>
		<script>
		jQuery(document).ready(function($){
		 $(\'.latest-news\').flexslider({
			animation: "slide",
			animationLoop: false,
			slideShow:false,
			controlNav: true,	
			maxItems: 1,
			pausePlay: false,
			mousewheel:false,
			start: function(slider){
			  $(\'body\').removeClass(\'loading\');
			}
			});	
		});
		</script>
		';
        
        return $output;
    }
    function projects_slider($atts, $content = null)
    {
        extract(shortcode_atts(array(
            'section_title' => '',
            'heading_style' => 'simple',
            'number' => 4,
            'sort_by' => '',
            'sorting_order' => '',
            'category' => '',
            
        ), $atts));
        
        $args = array('post_type' => 'dict_project', 'posts_per_page' => $number, 'orderby' => $sort_by, 'order' => $sorting_order);
        if ($category) $args['tax_query'] = array(array('taxonomy' => 'project_category', 'field' => 'id', 'terms' => $category));
        $posts = get_posts($args);
        $chunks = array_chunk($posts, 2);
        $output = '';
        
        $output .= '<section>';
        $output .= '<div class="ongoing-projects"><div class="row"><ul class="slides">';
        foreach ($chunks as $chunk):
            $output .= '<li>
					<div class="row">';
            foreach ($chunk as $c):
                $project_meta = get_post_meta(sh_set($c, 'ID'), '_dict_project_settings', true);
                $video = sh_set((array)sh_set($project_meta, 'videos'), 0);
                $video_data = sh_grab_video($video, '');
                $project_thumb = ($video) ?
                    '<img height="252" width="270" src="' . sh_set($video_data, 'thumb') . '" alt="" />
		<a class="html5lightbox" href="http://player.vimeo.com/video/' . sh_set($video_data, 'id') . '?color=ffffff" title="">
			<i class="icon-play"></i>
		</a>' : get_the_post_thumbnail($c->ID, array(270, 252));
                $output .= '
						<div class="col-md-6">
							<div class="row">
								<div class="col-md-6">
									<div class="ongoing-project-img">
										' . $project_thumb . '
									</div>
								</div>
								<div class="col-md-6">
									<div class="ongoing-project-detail">
										<h3>' . get_the_title(sh_set($c, 'ID')) . '</h3>
										' . substr(strip_tags(sh_set($c, 'post_content')), 0, 200) . '
										<a href="' . get_permalink(sh_set($c, 'ID')) . '" title="">' . __("Read More", SH_NAME) . '</a>
									</div>
								</div>
							</div>
						</div>';
            endforeach;
            $output .= '
					</div>
				</li>';
        endforeach;
        $output .= '</ul>
				</div>
			</div>
		</section>
		<script>
		jQuery(document).ready(function($){
		 $(\'.ongoing-projects\').flexslider({
			animation: "slide",
			animationLoop: false,
			slideShow:false,
			controlNav: false,	
			maxItems: 1,
			pausePlay: false,
			mousewheel:false,
			start: function(slider){
			  $(\'body\').removeClass(\'loading\');
			}
			});
		});
		</script>
		';
        
        return $output;
    }
	function welcome_box($atts, $content = null)
    {
        extract(shortcode_atts(array(
			'h_txt' => '',
            'h_desc' => '',
            'button_txt' => 'PURCHASE NOW',
            'button_url' => '',
        ), $atts));
		
		$output = '';
		$output .= '<div class="welcome-box">
						<h2>'.$h_txt.'</h2><p>'.$h_desc.'</p>					
						<a title="" href="'.$button_url.'" target="_blank"><span>'.$button_txt.'</span></a>					
					</div>';
		return $output;
    }
	
	function parallax_video($atts, $content = null)
    {
        extract(shortcode_atts(array(
			'video_id' => '',
        ), $atts));
		
		$output = '';
		$output .= '<div id="para_vid" class="parallax-video">
						<iframe name="video-iframe" src="http://player.vimeo.com/video/'.$video_id.'?autoplay=1&amp;title=0&amp;byline=0&amp;portrait=0&amp;loop=1" width="400" height="225"></iframe>
					</div>';
		return $output;
	}
	
    function causes_with_carousel($atts, $content = null)
    {
        extract(shortcode_atts(array(
            'section_title' => '',
            'section_desc' => '',
            'number' => 4,
            'category' => '',
            'sort_by' => '',
            'sorting_order' => '',
			'use_as' => '',
        ), $atts));
		
		$output ='';
		$args = array('post_type' => 'dict_causes', 'posts_per_page' => $number, 'orderby' => $sort_by, 'order' => $sorting_order);
        if ($category) $args['tax_query'] = array(array('taxonomy' => 'causes_category', 'field' => 'id', 'terms' => $category));
		$social = get_option(SH_NAME);
		
		$post = new WP_Query( $args );
		$output .= '<div class="full-section">';
		if( $use_as == 'Heading' ):
			$output .= '<div class="full-title">
						<div class="container">
							<span class="title-icon"><i class="icon-lightbulb"></i></span>
							<h2>'.$section_title.'</h2>
							<span>'.$section_desc.'</span>
						</div>
					</div>';
		endif;
		$output .= '<div class="big-carousel">
						<ul class="slides">';
						while( $post->have_posts() ): $post->the_post();
							$img = wp_get_attachment_image_src(get_the_id(), 'full');
							$output .= '<li>
								<div class="big-picture">
									<div class="fixed" style="background:url('.$img[0].');"></div>';
									if( has_post_thumbnail() ): $output .= get_the_post_thumbnail(get_the_id(), 'full'); endif;
								$output .= '<div class="short-desc">
										<h4>'.get_the_title().'</h4>
										<p>'.substr(get_the_content(), 0, 100 ).'</p>
										<a href="'.get_the_permalink().'" title="">'.__( 'Read more', SH_NAME ).'</a>
										<ul>
											<li><a href="'.sh_set($social, 'contact_facebook').'" title=""><i class="icon-facebook"></i></a></li>
											<li><a href="'.sh_set($social, 'contact_linkedin').'" title=""><i class="icon-linkedin"></i></a></li>
											<li><a href="'.sh_set($social, 'contact_gplus').'" title=""><i class="icon-google-plus"></i></a></li>
										</ul>
									</div>
								</div>
							</li>';
						endwhile; wp_reset_query();wp_reset_postdata();
						$output .='</ul>
					</div>
				</div>';
			$output .='
			<script>
				jQuery(window).load(function(){
				
				  jQuery(".big-carousel").flexslider({
					animation: "fade",
					animationLoop: false,
					slideShow:false,
					controlNav: false,	
					maxItems: 1,
					pausePlay: false,
					mousewheel:false,
					start: function(slider){
					  jQuery("body").removeClass("loading");
					}
					});
				});
			</script>';
			return $output;	
    }
	
	function services_with_pictures($atts, $content = null)
    {
        extract(shortcode_atts(array(
            'number' => 4,
            'layout' => '',
            'display' => '',
            'btn_text' => 'Read More',
            'sort_by' => '',
            'sorting_order' => '',
        ), $atts));
		
		$output ='';
		global $post;
		//$args = array('post_type' => 'dict_services', 'posts_per_page' => $number, 'orderby' => $sort_by, 'order' => $sorting_order);
		query_posts('post_type=dict_services&posts_per_page='.$number.'&orderby='.$sort_by.'&order='.$sorting_order);
		$output .= '<div class="row">';
		while( have_posts() ): the_post();
		$settings = get_post_meta( get_the_ID(), '_dict_services_settings', true );
		$con = explode( ' ', get_the_title(), 2 );
						$output .= '<div class="col-md-3">
							<div class="service">';
							if( $layout == "title_only" )
							{
								if( $display == "icon" )
								{
									$output .= '<i class="'.sh_set( $settings, 'font_awesome' ).'"></i>';
								}else{
									if( has_post_thumbnail() ): $output .= get_the_post_thumbnail( $post->ID, array(270, 155) ); endif;
								}
								
								$output .= '<h4>'.sh_set( $con, '0').' <span>'.sh_set( $con, '1').'</span></h4>
											<a href="'.get_the_permalink().'" title="">'.$btn_text.'</a>';
											
							}else{
								
								if( $display == "icon" )
								{
									$output .= '<i class="'.sh_set( $settings, 'font_awesome' ).'"></i>';
								}else{
									if( has_post_thumbnail() ): $output .= get_the_post_thumbnail( $post->ID, array(270, 155) ); endif;
								}
								
								$output .= '<h4>'.sh_set( $con, '0').' <span>'.sh_set( $con, '1').'</span></h4>
											<p>'.substr( get_the_content(), 0, 100 ).'</p>
											<a href="'.get_the_permalink().'" title="">'.$btn_text.'</a>';
							}
								
				$output .= '</div>
						</div>';
		endwhile; wp_reset_query();wp_reset_postdata();
		$output .= '</div>';
		
		return $output;
	}
	
	function charity_statics($atts, $content = null)
    {
        extract(shortcode_atts(array(
            'heading' => '',
            'desc' => '',
            'box1' => '',
            'box1_txt' => '',
			'box1_bg' => '',			
			'box2' => '',
            'box2_txt' => '',
			'box2_bg' => '',			
			'box3' => '',
            'box3_txt' => '',
			'box3_bg' => '',			
			'box4' => '',
            'box4_txt' => '',
			'box4_bg' => '',
        ), $atts));
		
		$output ='';
		
		$output .= '<div class="row">
						<div class="col-md-4">
							<div class="mission">
								<h4>'.$heading.'</h4>
								<p>'.$desc.'</p>
							</div>
						</div>
					<div class="col-md-8">
						<div class="row">
						<div class="remove-ext">';
						if( $box1 != "" )
						{
							$img = wp_get_attachment_image_src($box1_bg, 'thumbnail');
							$output .= '<div class="col-md-3">
											<div class="counting">
												<div style="background:url('.$img[0].')"></div>
												<h3 class="count">'.$box1.'</h3>
												<span>'.$box1_txt.'</span>
											</div>
										</div>';
						}
						
						if( $box2 != "" )
						{
							$img = wp_get_attachment_image_src($box2_bg, 'thumbnail');
							$output .= '<div class="col-md-3">
											<div class="counting">
												<div style="background:url('.$img[0].')"></div>
												<h3 class="count">'.$box2.'</h3>
												<span>'.$box2_txt.'</span>
											</div>
										</div>';
						}
						
						if( $box3 != "" )
						{
							$img = wp_get_attachment_image_src($box3_bg, 'thumbnail');
							$output .= '<div class="col-md-3">
											<div class="counting">
												<div style="background:url('.$img[0].')"></div>
												<h3 class="count">'.$box3.'</h3>
												<span>'.$box3_txt.'</span>
											</div>
										</div>';
						}
						
						if( $box4 != "" )
						{
							$img = wp_get_attachment_image_src($box4_bg, 'thumbnail');
							$output .= '<div class="col-md-3">
											<div class="counting">
												<div style="background:url('.$img[0].')"></div>
												<h3 class="count">'.$box4.'</h3>
												<span>'.$box4_txt.'</span>
											</div>
										</div>';
						}
			
		$output .= '</div></div></div></div>';
		
		return $output;
	}
	
	function our_mission_carousel( $atts, $content = null )
    {
        extract( shortcode_atts( array(
            'post_type' => '',
            'number' => 4,
			'sort_by' => '',
			'sorting_order' => '',
        ), $atts));
        
		$output = '';
		$counter = 1;
        $args = array( 'post_type' => $post_type, 'posts_per_page' => $number, 'orderby' => $sort_by, 'order' => $sorting_order );
		$posts = new WP_Query( $args );
		$output .= '<div class="mission-carousel">
						<ul class="slides"><li><div class="row">';							
							if( $posts->have_posts() ): while( $posts->have_posts() ): $posts->the_post();
								$output .= '';
								$output .='<div class="col-md-4">
											<div class="single-mission">
												<div class="mission-img">
													<a href="'.get_the_permalink().'" title="">';
														if( has_post_thumbnail() ): $output .= get_the_post_thumbnail( get_the_id(), array(270,155) ); endif;
										$output .='</div>
												<h3><a href="'.get_the_permalink().'" title="">'.get_the_title().'</a></h3>
												<p>'.substr( strip_tags( get_the_content() ), 0, 100).'</p>
											</div>
										</div>';
					if( $counter % 3 == 0 && $counter != $number ): $output.='</div></li><li><div class="row">'; endif;
					$counter++;
					endwhile; endif; wp_reset_query();
			$output .= '</li></ul>
					</div>';
		$output .= '<script>
					jQuery(window).load(function(){
					  jQuery(".mission-carousel").flexslider({
						animation: "slide",
						animationLoop: false,
						slideShow:false,
						controlNav: false,	
						maxItems: 1,
						pausePlay: false,
						mousewheel:false,
						start: function(slider){
						  jQuery("body").removeClass("loading");
						}
						});
					});
					</script>';
		return $output;
	}
	
	function sponsor( $atts, $content = null )
    {
        extract( shortcode_atts( array(
            'desc' => '',
            'image' => '',
			'btn_text' => '',
        ), $atts));
        $img = wp_get_attachment_image_src( $image, array(270,155) );
		$output = '<div class="sponsor">
					<img src="'.$img[0].'" alt="" />
					<div class="sponsor-desc">
						<p>'.rawurldecode( base64_decode( $desc ) ).'</p>
						<a data-toggle="modal" data-target="#myModal"  class="donate-btn" title="">'.$btn_text.'</a>
					</div>
				</div>';
		return $output;
	}
	
	function creative_recent_news($atts, $content = null)
    {
        extract(shortcode_atts(array(
                'number' => '',
                'title' => __('Recent News', SH_NAME),
                'category' => '',
                'sort_by' => 'date',
                'sorting_order' => 'DESC',
                'heading_style' => 'simple',
				'limit' => 70,
                ), $atts)
        );
        
		$output = '';
        //$term = get_category_by_slug(strtolower(str_replace(' ', '-', $category)));
        wp_reset_query();
        $args = array('post_type' => 'post', 'posts_per_page' => $number, 'orderby' => $sort_by, 'order' => $sorting_order, 'cat' => (int)$category);
        $posts = new WP_Query($args);
		
		$output .= '<div class="remove-ext">
						<div class="row">';
							if( $posts->have_posts() ): while( $posts->have_posts() ): $posts->the_post();
								$output .='<div class="col-md-6">
											<div class="recent-news">
												<div class="row">
													<div class="col-md-5">
														<a class="news-img" href="'.get_the_permalink().'" title="">';
															if( has_post_thumbnail() ): $output .= get_the_post_thumbnail( get_the_id(), array(370,252)); endif;
										 $output .='</a></div>
													<div class="col-md-7">
														<h4><a href="'.get_the_permalink().'" title="">'.get_the_title().'</a></h4>
														<p>'.substr( get_the_content(), 0, $limit ).'</p>
													</div>
												</div>
											</div>
										</div>';
							endwhile; endif; wp_reset_query();
			$output .= '</div>
					</div>';
		
		return $output;
	}
	
	function featured_posts( $atts, $content = null )
    {
        extract( shortcode_atts( array(
            'post_type' => '',
            'number' => 3,
			'sort_by' => '',
			'sorting_order' => '',
        ), $atts));
        
		$output = '';
        $args = array( 'post_type' => $post_type, 'posts_per_page' => $number, 'orderby' => $sort_by, 'order' => $sorting_order );
		$posts = new WP_Query( $args );
		
		$output .= '<div class="featured-posts">
						<div class="row">';
							if( $posts->have_posts() ): while( $posts->have_posts() ): $posts->the_post();
								$output .= '<div class="col-md-4">
												<div class="featured">
													<div class="featured-img">';
														if( has_post_thumbnail() ): $output .= get_the_post_thumbnail( get_the_id(), array(370,252)); endif;
											 $output .= '<a href="'.get_the_permalink().'" title=""><i class="icon-link"></i></a>
													</div>
													<div class="featured-details">
														<h3><a href="'.get_the_permalink().'" title="">'.get_the_title().'</a></h3>
														<p>'.substr( get_the_content(), 0, 100 ).'</p>
														<a href="'.get_the_permalink().'" title="">'.__( 'Read More', SH_NAME ).'</a>
													</div>
												</div>
											</div>';
							endwhile; endif; wp_reset_query();
			$output .= '</div>
					</div>';
			return $output;
	}
	
	function post_carousel( $atts, $content = null )
    {
        extract( shortcode_atts( array(
            'number' => '',
            'category' => '',
			'sort_by' => '',
			'sorting_order' => '',
        ), $atts));
		$output = '';
		$args = array('post_type' => 'post', 'posts_per_page' => $number, 'cat' => (int)$category, 'orderby' => $sort_by, 'order' => $sorting_order);
        //if ($cat != '') $args['tax_query'] = array(array('taxonomy' => 'causes_category', 'field' => 'id', 'terms' => $cat));
		query_posts( $args );
		$output .= '<div class="ongoing-projects">
						<div class="row">
							<ul class="slides">';
								while( have_posts() ): the_post();
									$meta  = get_post_meta( get_the_ID(), '_post_settings', true );														
						$output .= '<li>
										<div class="row">
											<div class="col-md-5">
												<div class="ongoing-project-img">';
													if( sh_set( $meta, 'videos' ) )
													{
														
														
														if( sh_set( $meta['videos'], '0' ) != "" )
														{
															$video_link = sh_set( $meta['videos'], '0' );
															$url = 'http://vimeo.com/'.$video_link;
															$video_data = sh_grab_video($url, '');
															$output .= '<img src="'.sh_set( $video_data, 'thumb' ).'" alt="" />';
															$output .= '<a class="html5lightbox" href="http://player.vimeo.com/video/'.sh_set( $video_data, 'id' ).'?color=ffffff" title=""><i class="icon-play"></i></a>';
														}
													}
													
									$output .= '</div>
											</div>
											<div class="col-md-7">
												<div class="ongoing-project-detail">
													<h3>'.get_the_title().'</h3>
													<p>'.sh_excerpt( get_the_content(), 200 ).'</p>
													<a href="'.get_the_permalink().'" title="">'.__( 'Read More', SH_NAME ).'</a>
												</div>
											</div>
										</div>
									</li>';
								endwhile; wp_reset_query();
				$output .= '</ul>
						</div>
					</div>';
				$output .= '<script>
								jQuery(window).load(function(){
								  jQuery(".ongoing-projects").flexslider({
									animation: "slide",
									animationLoop: false,
									slideShow:false,
									controlNav: false,	
									maxItems: 1,
									pausePlay: false,
									mousewheel:false,
									start: function(slider){
									 jQuery("body").removeClass("loading");
									}
								});
							});
							</script>';
		return $output;
	}
	
	function blockquote_carousel( $atts, $content = null )
	{
		extract( shortcode_atts( array( 
			'desc' => '',
			), $atts ) 
		);
		
		$output = '';
		$output .=' <div class="client-reviews">
						<ul class="slides">
							'.do_shortcode( $content ).'
						</ul>
					</div>';
		$output .= "<script>
						jQuery(window).load(function(){
							jQuery('.client-reviews').flexslider({
							animation: 'fade',
							animationLoop: true,
							slideShow:true,
							controlNav: false,	
							maxItems: 1,
							pausePlay: false,
							mousewheel:false,
							start: function(slider){
							  jQuery('body').removeClass('loading');
							}
							});
						});
					</script>";
		
		return $output;
	}
	
	function blockquote_text( $atts, $content = null )
	{
		extract( shortcode_atts( array( 
			'acc_content' => '',
			), $atts ) 
		);
		
		$output = '';		
		$output .= '<li>
						<div class="reviews effect5">
							<h3><span>"</span>
                				'.$acc_content.'
							<span>"</span></h3>
						</li>';

		return $output;
	}
	
	function causes_with_thumb( $atts, $content = null )
    {
        extract(shortcode_atts(array(
                'number' => '',
                'cat' => '',
                'sort_by' => 'date',
                'sorting_order' => 'ASC',                
            ), $atts)
        );
		
		$output = '';        
        $args = array('post_type' => 'dict_causes', 'posts_per_page' => $number, 'orderby' => $sort_by, 'order' => $sorting_order);
        if ($cat != '') $args['tax_query'] = array(array('taxonomy' => 'causes_category', 'field' => 'id', 'terms' => $cat));
		$query = new WP_Query( $args );
		while( $query->have_posts() ): $query->the_post();
			$output .= '<div class="issue">';
							if( has_post_thumbnail() ): $output .= get_the_post_thumbnail( get_the_ID(), array(80,80) ); endif;
			$output .= '<h4><a href="'.get_the_permalink().'">'.get_the_title().'</a></h4>
						</div>';
		endwhile; wp_reset_query();
		
		return $output;
	}
	
	function latest_news_carousel( $atts, $content = null )
    {
        extract( shortcode_atts( array(
            'number' => '',
            'cat' => '',
			'sort_by' => '',
			'sorting_order' => '',
        ), $atts));
		$output = '';
		$counter = 1;
		$args = array('post_type' => 'post', 'posts_per_page' => $number, 'category_name' => $cat, 'orderby' => $sort_by, 'order' => $sorting_order);
		query_posts( $args );
		$output .= '<div class="latest-news">
						<ul class="slides"><li><div class="row">';							
							if( have_posts() ): while( have_posts() ): the_post();
								$output .= '';
								$output .='<div class="col-md-4">
											<div class="news">
												<div class="news-image">';													
														if( has_post_thumbnail() ): $output .= get_the_post_thumbnail( get_the_id(), array(270,155) ); endif;
										$output .='<a href="'.get_the_permalink().'" title=""><i class="icon-link"></i></a></div>
												<h3>'.get_the_title().'</h3>
												<p>'.substr( get_the_content(), 0, 100).'</p>
											</div>
										</div>';
					if( $counter % 3 == 0 && $counter != $number ): $output.='</div></li><li>'; endif;
					$counter++;
					endwhile; endif; wp_reset_query();
			$output .= '</li></ul>';
			$output .= "<script>
						jQuery(window).load(function(){
							jQuery('.latest-news').flexslider({
								animation: 'slide',
								animationLoop: true,
								slideShow:false,
								controlNav: true,	
								maxItems: 1,
								pausePlay: false,
								mousewheel:false,
								start: function(slider){
								  jQuery('body').removeClass('loading');
								}
								});	
						});
					</script>";
		return $output;
	}
	
	function fancy_causes( $atts, $content = null )
    {
        extract( shortcode_atts( array(
            'post_id' => '',
        ), $atts));
		$output = '';
		$args = array(
				'p' => $post_id,
				'post_type' => 'dict_causes',
				'posts_per_page' => 1,
			);
		query_posts($args);
		while( have_posts() ): the_post();
		$Settings = get_post_meta( $post_id, '_dict_causes_settings', true);		
			$output .= '<div class="fancy-cause">';
							if( has_post_thumbnail() ): $output .= get_the_post_thumbnail( $post_id, array(370,252) ); endif;
				$output .= '<div class="fancy-cause-intro">
								<i>'.__( 'in', SH_NAME ).'&nbsp;<a href="'.get_the_permalink().'" title="">'.sh_set($Settings, 'location').'</a></i>
								<h3>'.get_the_title().'</h3>
								<span><strong>'.sh_set($Settings, 'currency_symbol').'</strong>&nbsp;'.sh_set($Settings, 'donation_needed').'&nbsp;<i>'.__( 'Donation Needed', SH_NAME ).'</i></span>
							</div>
							<div class="fancy-cause-hover">
								<p>'.sh_excerpt( get_the_content(), 150 ).'</p>
								<span>'.__( 'Help Us:', SH_NAME ).' <strong>'.sh_set($Settings, 'currency_symbol').'</strong> <i>'.sh_set($Settings, 'donation_needed').'</i></span>
								<span><a  data-toggle="modal" data-target="#myModal" title="">'.__( 'Donate Now', SH_NAME ).'</a><a href="'.get_the_permalink().'" title="">'.__( 'Read More', SH_NAME ).'</a></span>											
							</div>
						</div>';
		endwhile; wp_reset_query();
		return $output;
	}
	
	function fancy_causes_2( $atts, $content = null )
    {
        extract( shortcode_atts( array(
            'post_id' => '',
        ), $atts));
		$output = '';
		$args = array(
				'p' => $post_id,
				'post_type' => 'dict_causes',
				'posts_per_page' => 1,
			);
		query_posts($args);
		while( have_posts() ): the_post();
		$Settings = get_post_meta( $post_id, '_dict_causes_settings', true);		
			$output .= '<div class="our-cause">
							<div class="our-cause-img">';
							if( has_post_thumbnail() ): $output .= get_the_post_thumbnail( $post_id, array(370,252) ); endif;
				$output .= '<a href="'.get_the_permalink().'" title="'.get_the_title().'"><i class="icon-link"></i></a></div>
							<div class="our-cause-detail">
								<h3>'.get_the_title().'</h3>
								<span>'.__( 'in', SH_NAME ).'&nbsp;<a href="'.get_the_permalink().'" title="">'.sh_set($Settings, 'location').'</a></span>
								<p>'.sh_excerpt( get_the_content(), 150 ).'</p>
								<i>'.__( 'Help Us:', SH_NAME ).' <span>'.sh_set($Settings, 'currency_symbol').'</span> <strong>&nbsp;'.sh_set($Settings, 'donation_needed').'</strong></i>							
								<a  data-toggle="modal" data-target="#myModal" title="">'.__( 'Donate Now', SH_NAME ).'</a>
							</div>
						</div>';
		endwhile; wp_reset_query();
		return $output;
	}
	
	function donation_parallax_box( $atts, $content = null )
    {
        extract( shortcode_atts( array(
            'title' => '',
			'desc' => '',
			'button' => __( 'Take Action', SH_NAME ),
			'bg' => '',
        ), $atts));
		$output = '';
		$img = wp_get_attachment_image_src( $bg, 'full' );
		$output .= '<div class="fancy-donation">
						<img src="'.$img['0'].'" alt="" />
						<div class="donation-appeal">
							'.$title.'
							<p>'.$desc.'</p>
							<a href="#" data-toggle="modal" data-target="#myModal" title="">'.$button.'</a>
						</div>
					</div>';
		return $output;
	}
	
	function project_carousal_full_page( $atts, $content = null )
    {
        extract( shortcode_atts( array(
            'number' => '',
			'category' => '',
			'sort_by' => 'date',
			'sorting_order' => 'ASC',
        ), $atts));
		$output = '';
		$args = array('post_type' => 'dict_project', 'posts_per_page' => $number, 'orderby' => $sort_by, 'order' => $sorting_order);
        if ($category != '') $args['tax_query'] = array(array('taxonomy' => 'project_category', 'field' => 'id', 'terms' => $category));
        query_posts($args);		
		$output .= '<div class="wide-project-carousel">
						<ul class="slides">';
						while( have_posts() ): the_post();
						$Settings = get_post_meta( get_the_ID(), '_dict_project_settings', true );
							$output .= '<li class="wide-project">
											<div class="row">
												<div class="col-md-7">
													<div class="wide-project-detail">
														<h2><a href="'.get_the_permalink().'" title="'.get_the_title().'">'.get_the_title().'</a></h2>
														<h3>'.sh_set( $Settings, 'location' ).'</h3>
														<p>'.substr( strip_tags( get_the_content() ), 0, 500 ).'</p>
														<div class="money-spent"><h5><i>'.sh_set( $Settings, 'spent_amount_currency' ).'</i>'.sh_set( $Settings, 'spent_amount' ).'</h5><span>'.__( 'Money Spent', SH_NAME ).'</span></div>
														
													</div>
												</div>
												<div class="col-md-5">
													<div class="wide-project-img">';
														if( has_post_thumbnail() ): $output .= get_the_post_thumbnail( get_the_ID(), array(570, 570 ) ); endif;
										$output .= '</div>
												</div>
											</div>
										</li>';
						endwhile; wp_reset_query();
		$output .= '</ul></div>';
		$output .= '<script>
						jQuery(window).load(function(){
							jQuery(".wide-project-carousel").flexslider({
								animation: "fade",
								animationLoop: false,
								slideShow:false,
								controlNav: false,	
								maxItems: 1,
								pausePlay: false,
								mousewheel:false,
								start: function(slider){
								  jQuery("body").removeClass("loading");
								}
								});
						});
					</script>';
		return $output;
	}
	
	function causes_new_style( $atts, $content = null )
    {
        extract( shortcode_atts( array(
            'number' => '',
			'category' => '',
			'sort_by' => 'date',
			'sorting_order' => 'ASC',
        ), $atts));
		$output = '';
		$args = array('post_type' => 'dict_causes', 'posts_per_page' => $number, 'orderby' => $sort_by, 'order' => $sorting_order);
        if ($category != '') $args['tax_query'] = array(array('taxonomy' => 'causes_category', 'field' => 'id', 'terms' => $category));
        query_posts($args);		
		
		$output .= '<div class="charity-causes"><div class="row">';
					while( have_posts() ): the_post();
						$Settings = get_post_meta( get_the_ID(), '_dict_causes_settings', true );
						if( sh_set( $Settings, 'donation_collected' ) && sh_set( $Settings, 'donation_needed' ) )
						{
							$percent =  ((int)sh_set( $Settings, 'donation_collected' ) / (int)sh_set( $Settings, 'donation_needed' ) ) * 100;
						}else{
							$percent = 0;
						}
						
						$output .='<div class="col-md-4">
									<div class="charity-cause">
										<div class="charity-cause-img">';
											if( has_post_thumbnail() ): $output .= get_the_post_thumbnail( get_the_ID(), array(570, 570 ) ); endif;
							$output .='</div>
										<div class="charity-cause-detail">
											<h3><a href="'.get_the_permalink().'" title="'.get_the_title().'">'.get_the_title().'</a></h3>
											<p>'.substr( strip_tags( get_the_content() ),0, 100 ).'</p>
											<div class="progress progress-striped active">
												<div class="progress-bar progress-bar-striped active" role="progressbar" style="width: '.$percent.'%">
											</div>
											</div>
											<span>'.__( 'Needed Donation', SH_NAME ).' <i>'.sh_set( $Settings, 'donation_needed' ).'</i></span>
										</div>
										<div class="cause-location">
											<p>'.__( 'In', SH_NAME ).' <span>'.sh_set( $Settings, 'location' ).'</span></p>
										</div>
									</div><!-- Charity Cause -->
								</div>';
					endwhile; wp_reset_query();
		$output .= '</div></div>';
		
		return $output;
	}
	
	function urgent_cause_parallax( $atts, $content = null )
    {
        extract( shortcode_atts( array(
            'cause' => '',
			'bg' => '',
        ), $atts));
		$output = '';
		$args = array('post_type' => 'dict_causes', 'posts_per_page' => 1, 'p' => $cause);
        query_posts($args);		
		$img = wp_get_attachment_image_src( $bg, 'full' );
		$output .= '<div class="charity-causes"><div class="row">';
					while( have_posts() ): the_post();
						$Settings = get_post_meta( get_the_ID(), '_dict_causes_settings', true );
						if( sh_set( $Settings, 'donation_collected' ) && sh_set( $Settings, 'donation_needed' ) )
						{
							$percent =  ((int)sh_set( $Settings, 'donation_collected' ) / (int)sh_set( $Settings, 'donation_needed' ) ) * 100;
						}else{
							$percent = 0;
						}
						
						$output .='<div class="urgent-cause">
									<img src="'.$img['0'].'" alt="" />
									<span><img src="'.get_template_directory_uri().'/images/speaker.png" alt="" /></span>
									<h3>'.__( 'Our Urgent', SH_NAME ).' <span>'.__( 'Causes', SH_NAME ).'</span></h3>
									<h5>'.get_the_title().'</h5>
									<div class="progress progress-striped active">
										<div class="progress-bar progress-bar-striped active" role="progressbar" style="width: '.$percent.'%">
										</div>
									</div>
									<div class="urgent-progress">
										<span>'.__( 'Needed Donation', SH_NAME ).'</span>
										<i>'.round($percent).'%</i>
									</div>					
									<strong><i>'.sh_set( $Settings, 'currency_symbol' ).'</i>'.sh_set( $Settings, 'donation_collected' ).' / <i>'.sh_set( $Settings, 'currency_symbol' ).'</i>'.sh_set( $Settings, 'donation_needed' ).'</strong>
									<a href="#" data-toggle="modal" data-target="#myModal" title="">'.__( 'DONATE NOW', SH_NAME ).'</a>
								</div>';
					endwhile; wp_reset_query();
		$output .= '</div></div>';
		
		return $output;
	}
	
	function donation_parallax_full_page( $atts, $content = null )
    {
        extract( shortcode_atts( array(
            'title' => '',
			'subtitle' => '',
			'desc' => '',
			'btn_txt' => __( 'SPONSOR NOW', SH_NAME ),
        ), $atts));
		$ext = explode( ' ', $title, 2 );
		$output = '<div class="simple-parallax">
					<span>'.$subtitle.'</span>
					<h3>'.sh_set( $ext, '0' ).' <span>'.sh_set( $ext, '1' ).'</span></h3>
					<p>'.$desc.'</p>
					<a href="#" class="transparent-btn" data-toggle="modal" data-target="#myModal" title="">'.$btn_txt.'</a>
				</div>';
		return $output;
	}
	
	function modern_event_counter( $atts, $content = null )
    {
        extract( shortcode_atts( array(
            'cause' => '',
			'lap' => '',
        ), $atts));
		$args = array('post_type' => 'dict_event', 'posts_per_page' => 1, 'p' => $cause);
        query_posts($args);	
		$lap = ( $lap == 'true' )? 'overlap': '';
		$output = '';
		while( have_posts() ): the_post();
		$Settings = get_post_meta( get_the_ID(), '_dict_event_settings', true );
		$e_date =  new DateTime( sh_set( $Settings, 'end_date' ) );
		$output .= '<div class="upcoming-bar '.$lap.'">
					<div class="row">
						<div class="col-md-7">
							<div class="abt-upcoming-event">
								<span><img src="'.get_template_directory_uri().'/images/icon.png" alt="" /></span>
								<h3>'.get_the_title().'</h3>
								<ul>
									<li><a href="'.get_author_posts_url( get_the_author_meta( 'ID' ) ).'" title=""><i class="icon-user"></i> '.__( 'By', SH_NAME ).' '.get_the_author_meta( 'display_name' ).'</a></li>
									<li><a href="#" title=""><i class="icon-calendar"></i> '.get_the_date('F d, Y').'</a></li>
								</ul>
							</div>
						</div>
						<div class="col-md-5">
							<div class="upcoming-counter">
								<div class="count-down"></div>
							</div>
						</div>
					</div>
				</div>';
		$output .= '<script>
						jQuery(window).load(function(){
							var austDay = new Date();
							austDay = new Date( '.$e_date->format( 'Y , m, d' ).' );
							jQuery(".count-down").countdown({until: austDay});
						});
					</script>';
		endwhile; wp_reset_query();
	
	return $output;		
	}
	
	function charity_events_new( $atts, $content = null )
    {
        extract( shortcode_atts( array(
            'number' => '',
			'category' => '',
			'sort_by' => 'date',
			'sorting_order' => 'ASC',
        ), $atts));
		$output = '';
		$args = array('post_type' => 'dict_event', 'posts_per_page' => $number, 'orderby' => $sort_by, 'order' => $sorting_order);
        if ($category != '') $args['tax_query'] = array(array('taxonomy' => 'event_category', 'field' => 'id', 'terms' => $category));
        query_posts($args);		
		
		$output .= '<div class="charity-events"><div class="row">';
					while( have_posts() ): the_post();
						$Settings = get_post_meta( get_the_ID(), '_dict_event_settings', true );					
						$output .='<div class="col-md-4">
									<div class="charity-event">
										<div class="charity-event-img">';
											if( has_post_thumbnail() ): $output .= get_the_post_thumbnail( get_the_ID(), '570x570' ); endif;
											$output .='<a href="'.get_the_permalink().'" title="">'.__( 'Read More', SH_NAME ).'</a>
										</div>
										<div class="charity-event-detail">
											<i><strong>'.get_the_date( 'F' ).'</strong> '.get_the_date( 'd, Y' ).'</i>
											<h3><a href="'.get_the_permalink().'" title="">'.get_the_title().'</a></h3>
											<span><i class="icon-map-marker"></i> '.sh_set( $Settings, 'address' ).'</span>
											<p>'.substr( strip_tags( get_the_content() ),0, 80 ).'</p>
										</div>
									</div>
								</div>';
					endwhile; wp_reset_query();
		$output .= '</div></div>';
		
		return $output;
	}
}