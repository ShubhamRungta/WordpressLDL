<?php
/*
Plugin Name: Contact Form 7 Style
Plugin URI: http://wordpress.reea.net/contact-form-7-style/
Description: Simple style customization and templating for Contact Form 7 forms. Requires Contact Form 7 plugin installed.
Version: 3.1.2
Author: Johnny, dorumarginean, mlehelsz, MirceaR
Author URI: http://cf7style.com
License: GPL2
@Author: Johnny, dorumarginean, mlehelsz, MirceaR
*/

/**
 *	Include the plugin options
 */
define( 'WPCF7S_PLUGIN', __FILE__ );	
define( 'WPCF7S_PLUGIN_DIR', untrailingslashit( dirname( WPCF7S_PLUGIN ) ) );
define( 'WPCF7S_LOCATION',plugin_dir_url( WPCF7S_PLUGIN ) );
define( 'WPCF7S_PLUGIN_VER', '3.1.2' );


function get_predefined_cf7_style_template_data() {
	require 'predefined-templates.php';
	$templates = json_decode( $templates_string, true );	
	return $templates;
}// end of get_predefined_cf7_style_template_data
/**
 * Get contact form 7 id
 * 
 * Back compat for CF7 3.9 
 * @see http://contactform7.com/2014/07/02/contact-form-7-39-beta/
 * 
 * @param $cf7 Contact Form 7 object
 * @since 0.1.0
 */		
function get_form_id( $cf7 ) {
	if ( version_compare( WPCF7_VERSION, '3.9-alpha', '>' ) ) {
	    if (!is_object($cf7)) {
	        return false;
	    }
	    return $cf7->id();
	}
}

/**
 * Add cf7skins classes to the CF7 HTML form class
 * 
 * Based on selected template & style
 * eg. class="wpcf7-form cf7t-fieldset cf7s-wild-west"
 * 
 * @uses 'wpcf7_form_class_attr' filter in WPCF7_ContactForm->form_html()
 * @uses wpcf7_get_current_contact_form()
 * @file wp-content\plugins\contact-form-7\includes\contact-form.php
 * 
 * @param $class is the CF7 HTML form class
 * @since 0.0.1
 */		
function form_class_attr( $class, $id ) {

	// Get the current CF7 form ID
	$cf7 = wpcf7_get_current_contact_form();  // Current contact form 7 object
	$form_id = get_form_id( $cf7 );
	$template_class ='';
	$cf7_style_id = get_post_meta( $form_id, 'cf7_style_id' );
	if ( isset( $cf7_style_id[0] ) ) {
		$cf7_style_data = get_post( $cf7_style_id[0], OBJECT );
		$template_class = ( has_term( 'custom-style', 'style_category', $cf7_style_data ) ) ? 
			"cf7-style-" . $cf7_style_id[0] :  $cf7_style_data->post_name;
	}	

	// Return the modified class
	return $template_class;
}
function active_styles() {

	$args = array( 
		'post_type'=>'wpcf7_contact_form',
		'post_status'=>'publish',
		'posts_per_page'=> -1
	);
	$active_styles = array();
	$forms = new WP_Query( $args );

	if( $forms->have_posts() ) :
		while( $forms->have_posts() ) : $forms->the_post();
			$form_title = get_the_title();
			$id = get_the_ID();
			$style_id = get_post_meta( $id, 'cf7_style_id', true );
			if ( ! empty( $style_id ) || $style_id != 0 ) {
				$active_styles[] = $style_id;
			}
		endwhile;
		wp_reset_postdata();
	endif; 
	return $active_styles;
}

function cf7_style_custom_css_generator(){
	global $post;
	if( empty( $post ) ) {
		return false;
	}
	$args = array( 
		'post_type' => 'wpcf7_contact_form',
		'post_status' => 'publish',
		'posts_per_page' => -1
	);
	$forms = new WP_Query( $args );
	$total_num_posts = $forms->found_posts;
	$style = "";
	$cf7s_manual_style = html_entity_decode( stripslashes(get_option( 'cf7_style_manual_style', true )),ENT_QUOTES );
	$cf7s_manual_style = ( $cf7s_manual_style == '1' ) ? "" : $cf7s_manual_style;
	$cf7s_force_css = get_option( 'cf7_style_forcecss', true );
	$cf7s_force_css = (1 == $cf7s_force_css ) ? " !important" : "";
	$active_styles = array();
	$style_number = 0;
	if( $forms->have_posts() ) :
		while( $forms->have_posts() ) : $forms->the_post();
			$id = get_the_ID();
			$cf7s_id = get_post_meta( $id, 'cf7_style_id', true );
			$form_title = get_the_title($cf7s_id);
			if ( ( ! empty( $cf7s_id ) || $cf7s_id !== 0 ) && ! in_array( $cf7s_id, $active_styles ) ) {	
				array_push( $active_styles, $cf7s_id );
				$cf7_style_data = get_post( $cf7s_id, OBJECT );	
				$check_custom_style = has_term( 'custom-style', 'style_category', $cf7_style_data );
				/*Check if custom style or template*/
				$cf7s_slug = ( $check_custom_style ) ? $cf7s_id : sanitize_title( $form_title);
				/*check if custom again*/
				if( $check_custom_style ){
					$cf7s_custom_settings = maybe_unserialize( get_post_meta( $cf7s_id, 'cf7_style_custom_styler', true ));
					$cf7s_custom_settings = ( empty($cf7s_custom_settings) ) ? array() : $cf7s_custom_settings;
					$groundzero = "";
					$groundzero_hover = "";
					$groundone = "";
					$groundone_hover = "";
					$tempSave = "";
					$bleah = array();
					$bleah_hover = array();
					$i = 0;
					$i_hover = 0;
					$curr_tag_gen = "";
					$cur_property_gen = "";
					$the_hover = "no";
					foreach( $cf7s_custom_settings as $setting_key => $setting ){
						$setting_key_part = explode( "_", $setting_key );
						$classelem = "body .cf7-style." . ( ( is_numeric( $cf7s_slug ) ) ? "cf7-style-".$cf7s_slug : $cf7s_slug );
						$html_element = ( $setting_key_part[0] == "submit" || $setting_key_part[0] == "radio" || $setting_key_part[0] == "checkbox" ) ?
								 " input[type='". $setting_key_part[0]."']" : ( ( $setting_key_part[0] == "form" ) ? "" : (( $setting_key_part[0] == "wpcf7-not-valid-tip" || $setting_key_part[0] == "wpcf7-validation-errors" || $setting_key_part[0] == "wpcf7-mail-sent-ok" ) ?
								 " .". $setting_key_part[0] : ' '.$setting_key_part[0]) );
						$endtag = ( $i == 0 ) ? "" : "}\n";
						$endtag_hover = ( $i_hover == 0 ) ? "" : "}\n";
						$curr_tag_gen = $classelem.$html_element;
						if( $setting != "" ){
							$setting = ($setting_key_part[1] == "background-image") ? 'url("'.$setting.'")' : $setting;
							$cur_property_gen = "\t\t".$setting_key_part[1].": ".$setting.$cf7s_force_css. ";\n";
						}
						$the_hover = ( array_key_exists (3,$setting_key_part) && $setting_key_part[3] == "hover" ) ? "yes" :
							( array_key_exists (2,$setting_key_part) &&  $setting_key_part[2] == "hover" ) ? "yes" : "no";
						if($the_hover == "yes"){
							if( $groundzero_hover != $setting_key_part[0]){
								if(array_key_exists($i_hover,$bleah_hover)){
									$i_hover++;
								}
								$bleah_hover[$i_hover] = $endtag_hover.$curr_tag_gen.":hover {\n";
								$groundzero_hover =  $setting_key_part[0];
							}
							$i_hover++;
							if( $setting != "" ){
								if ( $groundone_hover != $setting_key_part[1]) {
									$groundone_hover = $setting_key_part[1];
									$tempSave  = $setting;
									if( $setting != "px" && $setting != "%" && $setting != "em" ){
										$bleah_hover[$i_hover]  = $cur_property_gen;
									}
								} else {
									$bleah_hover[--$i_hover] = ( $tempSave != "done" ) ? ( "\t\t".$setting_key_part[1].": ".$tempSave.$setting.$cf7s_force_css. ";\n") : "";
									$tempSave = "done";
								}
							}	
						} else {
							
							if( $groundzero != $setting_key_part[0]){
								if(array_key_exists($i,$bleah)){
									$i++;
								}
								$bleah[$i] = $endtag.$curr_tag_gen." {\n";
								$groundzero =  $setting_key_part[0];
							}
							$i++;
							if( $setting != "" ){
								if ( $groundone != $setting_key_part[1]) {
									$groundone = $setting_key_part[1];
									$tempSave = $setting;
									if( $setting != "px" && $setting != "%" && $setting != "em" ){
										$bleah[$i] = $cur_property_gen;
									}
								} else {
									$bleah[--$i] = ( $tempSave != "done" ) ? ( "\t\t".$setting_key_part[1].": ".$tempSave.$setting.$cf7s_force_css. ";\n") : "";
									$tempSave = "done";
								}
							}
						}
					}
					foreach ($bleah as  $style_line) {
						$style .= $style_line;
					}
					$style .= "}\n";
					foreach ($bleah_hover as  $style_line) {
						$style .= $style_line;
					}
					$style .= "}";
				}/*custom end*/
				$font_family = return_font_name( $cf7s_id );

				if( ! empty( $font_family ) && "none" !== $font_family ) {
					if (is_numeric($cf7s_slug)) {
						$cf7s_slug = "cf7-style-".$cf7s_slug;
					}
					$style .= "\n".'body .cf7-style.' . $cf7s_slug . ",\nbody .cf7-style." . $cf7s_slug . " input[type='submit'] {\n\t font-family: '" . $font_family . "',sans-serif;\n} ";
				}
				$style_number++;
			}/*Main if ends here*/
		endwhile;
		$style_manual = "";
		$style_start = "\n<style class='cf7-style' media='screen' type='text/css'>\n";
		if( !empty( $cf7s_manual_style ) ){
			$style_manual = "\n".$cf7s_manual_style."\n";
		}
		$cur_css = $style_start;
		if ( version_compare( phpversion() , '5.3', '>' ) ) {
			require_once 'inc/cssparser.php';
			$css = new CSSParser();
			$cssIndex = $css->ParseCSS($style);
			$cur_css .= $css->GetCSS($cssIndex);
		} else {
			$cur_css .= $style;
		}
		$cur_css .= $style_manual;
		if( ( $style_number !== 0 ) && $style_number == count( $active_styles ) ) {
			$cur_css .= "\n</style>\n";
		}
		$cur_css = str_replace(' 0px;', ' 0;', $cur_css);
		echo $cur_css;
		wp_reset_postdata();
	endif;	
}// end of cf7_style_custom_css_generator
function cf7_style_admin_scripts($hook){
	global $post_type;
	if (!wp_script_is( 'jquery', 'enqueued' )) {
		wp_enqueue_script('jquery');
	}
	wp_enqueue_style( "cf7-style-bar-style", WPCF7S_LOCATION . "css/admin-bar.css", array(), WPCF7S_PLUGIN_VER, "all");
	wp_enqueue_script( "cf7_style_overall", WPCF7S_LOCATION . "admin/js/overall-min.js", array('jquery'), WPCF7S_PLUGIN_VER, true );
	if( 'cf7_style_page_cf7style-css-editor' == $hook ){
		wp_enqueue_script( "cf7_style_codemirror_js", WPCF7S_LOCATION . "admin/js/codemirror.js", array( 'jquery' ), WPCF7S_PLUGIN_VER, true );
		wp_enqueue_style( "cf7-style-codemirror-style", WPCF7S_LOCATION . "admin/css/codemirror.css", array(), WPCF7S_PLUGIN_VER, "all" );
		wp_enqueue_script( "cf7-style-codemirror-mode", WPCF7S_LOCATION . "admin/js/mode/css/css.js",  array( 'jquery' ), WPCF7S_PLUGIN_VER, true );
	}
	if( 'cf7_style' == $post_type){
		wp_enqueue_style( 'wp-color-picker' );
		wp_enqueue_script( 'thickbox' );
		wp_enqueue_style( 'thickbox' );
		wp_enqueue_script( 'media-upload' );
	}
	if( 'plugins.php'== $hook || 'cf7_style' == $post_type || 'toplevel_page_wpcf7' == $hook || 'cf7_style_page_cf7style-css-editor' == $hook || 'cf7_style_page_system-status' == $hook || 'cf7_style_page_cf7style-settings' == $hook ){
		wp_enqueue_style('cf7-style-font-awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.6.2/css/font-awesome.min.css');
		wp_enqueue_style( "cf7-style-admin-style", WPCF7S_LOCATION . "admin/css/admin.css", false, WPCF7S_PLUGIN_VER, "all");  
		wp_enqueue_script( "cf7_style_admin_js", WPCF7S_LOCATION . "admin/js/admin-min.js", array( 'wp-color-picker', 'jquery' ), WPCF7S_PLUGIN_VER, true );
	}
}
function cf7_style_add_class( $class ){
	global $post;
	$class.= " cf7-style ".form_class_attr( $post, "no" );
	return $class;
}// end of cf7_style_add_class
/**
 *	Check if Contact Form 7 is activated
 */
function contact_form_7_check() {
	
	// WordPress active plugins
	$required_plugin = 'contact-form-7/wp-contact-form-7.php';
	$all_plugins = get_plugins();
	$active_plugins = get_option( 'active_plugins' );

	if(! array_key_exists( $required_plugin, $all_plugins)){
		$html = '<div class="error">';
		$html .= '<p>';
		$html .= __( "Contact form 7 - Style is an addon. Please install", "contact-form-7-style" ).' <a href="'.esc_url(admin_url('plugin-install.php?s=contact+form+7&tab=search&type=term' )).'">Contact form 7</a>.';
		$html .= '</p>';
		$html .= '</div><!-- /.updated -->';
		echo $html;
	} else if ( $active_plugins ) {
		if ( ! in_array( $required_plugin, $active_plugins )  ) {
			$html = '<div class="error">';
			$html .= '<p>';
			$html .= __( "Contact form 7 - Style is an addon. Please activate", "contact-form-7-style" ).' <a href="'.esc_url(wp_nonce_url(admin_url('plugins.php?action=activate&plugin=' . $required_plugin ), 'activate-plugin_' . $required_plugin)).'">Contact form 7</a>.';
			$html .= '</p>';
			$html .= '</div><!-- /.updated -->';
			echo $html;
		} else {
			// Get the cf7_style_cookie 
			$cf7_style_cookie = get_option( 'cf7_style_cookie' );
			if( $cf7_style_cookie != true ) {

				$html = '<div class="updated">';
				$html .= '<p>';
				$html .= __( "Contact Form 7 - Style addon is now activated. Navigate to", "contact-form-7-style" ).' <a href="' . get_bloginfo( "url" ) . '/wp-admin/edit.php?post_type=cf7_style">'.__( "Contact Style", "contact-form-7-style" ).'</a> '.__( "to get started.", "contact-form-7-style" );
				$html .= '</p>';
				$html .= '</div><!-- /.updated -->';
				echo $html; 
				update_option( 'cf7_style_cookie', true );
			} // end if !$cf7_style_cookie
			$cf7_style_templates = get_option( 'cf7_style_no_temps' );
			if($cf7_style_templates != "hide_box"){
				$box = '<div class="updated template-message-box">';
				$box .= '<p><label><input type="checkbox" name="custom_template_check" />'.__( "Click here, if you want to delete ALL predefined Contact Form 7 Style templates.", "contact-form-7-style" ).'</label></p>';
				$box .= '<p><small>'.__( "This works only if  the  predefined templates are not in the", "contact-form-7-style" ).' <a href="'.admin_url('edit.php?post_status=trash&post_type=cf7_style').'">'.__( "Trash", "contact-form-7-style" ).'</a>.</small></p>';
				$box .= '<div class="double-check hidden">';
				$box .= '<label>'.__( "Are you sure you want to remove? ", "contact-form-7-style" );
				$box .= '<br/><span>( '.__( "All Contact Form 7 Style predefined templates attached to your Contact Form 7 form will be removed", "contact-form-7-style" ).' ) &nbsp;&nbsp;</span>';
				$box .= '<span> '.__( "Yes", "contact-form-7-style" ).'</span><input type="radio" name="double_check_template" value="yes" />';
				$box .= '</label><label>';
				$box .= '<span> '.__( "No", "contact-form-7-style" ).'</span><input type="radio" name="double_check_template" value="no" checked="checked" /></label>';
				$box .= '<a href="#" class="confirm-remove-template button"> '.__( "Confirm", "contact-form-7-style" ).'</a>';
				$box .= '</div><a href="#" class="remove_template_notice">'.__( "Dismiss", "contact-form-7-style" ).'</a>';
				$box .= '<div style="clear:both;"></div>';
				$box .= '</div>';
				$screen = get_current_screen();
				if( !empty($screen) && ($screen->id == 'edit-cf7_style' || $screen->id == 'cf7_style') ){
					echo $box;
				}
			}		
		}		
	} // end if $active_plugins	
}
add_action( 'admin_notices', 'contact_form_7_check' );

function cf7_style_create_post( $slug, $title, $image) {
	// Initialize the page ID to -1. This indicates no action has been taken.
	$post_id = -1;
	$was_deleted = get_option('cf7_style_deleted'); 
	if( null == get_page_by_title( $title, "OBJECT", "cf7_style" ) && $was_deleted != "yes" ) {
	// Set the post ID so that we know the post was created successfully
		$post_id = wp_insert_post(
			array(
				'comment_status' => 'closed',
				'ping_status' => 'closed',
				'post_name' => $slug,
				'post_title' => $title,
				'post_status' => 'publish',
				'post_type' => 'cf7_style'
			)
		);
		//if is_wp_error doesn't trigger, then we add the image
		if ( is_wp_error( $post_id ) ) {
			$errors = $post_id->get_error_messages();
			foreach ($errors as $error) {
				echo $error . '<br>'; 
			}
		} else {
			//wp_set_object_terms( $post_id, $category, 'style_category', false );
			update_post_meta( $post_id, 'cf7_style_image_preview', $image );
		}
	// Otherwise, we'll stop
	} else {
	// Arbitrarily use -2 to indicate that the page with the title already exists
		$post_id = -2;
	} // end if
} // end cf7_style_create_post
function cf7_style_add_taxonomy_filters() {
	global $typenow;
	// an array of all the taxonomyies you want to display. Use the taxonomy name or slug
	$taxonomies = array( 'style_category' );
	// must set this to the post type you want the filter(s) displayed on
	if( $typenow == 'cf7_style' ){
		foreach ( $taxonomies as $tax_slug ) {
			$tax_obj = get_taxonomy( $tax_slug );
			
			$tax_name = $tax_obj->labels->name;
			$terms = get_terms( $tax_slug );
			if( count( $terms ) > 0 ) {
				echo "<select name='$tax_slug' id='$tax_slug' class='postform'>";
				echo "<option value=''>Show All $tax_name</option>";
				foreach ( $terms as $term ) {
					$resultA = "<option value='".$term->slug."' selected='selected'>".$term->name .' (' . $term->count .')'."</option>";
					$resultB = "<option value='".$term->slug."'>".$term->name .' (' . $term->count .')'."</option>";
					echo ( isset( $_GET[$tax_slug] ) ) ? ( ( $_GET[$tax_slug] == $term->slug ) ? $resultA : $resultB ) : $resultB;
				}
				echo "</select>";
			}
		}
	}
}// end cf7_style_add_taxonomy_filters
function cf7_style_set_style_category_on_publish(  $ID, $post ) {
	$temporizator = 0;
	foreach ( get_predefined_cf7_style_template_data() as $predefined_post_titles ) {
		if( $post->post_title == $predefined_post_titles[ "title" ] ){
			$temporizator++;
		}	
	}
	if( 0 == $temporizator ) {
		wp_set_object_terms( $ID, 'custom style', 'style_category' );
	}
} // end cf7_style_set_style_category_on_publish
function cf7_style_create_posts(){
	update_option( 'cf7_style_no_temps', 'show_box' );
	update_option( 'cf7_style_welcome', 'show_box' );
	update_option( 'cf7_style_update_saved', 'yes' );
	update_option( 'cf7_style_allow_tracking', '5' );
	update_option( 'cf7_style_add_categories', '0' );
	
}
// Hook into the 'cf7_style_create_posts' action
// register_activation_hook( __FILE__, 'cf7_style_create_posts' ); 

function cf7style_load_elements(){

	$labels = array(
			'name'                	=> _x( 'Contact Styles', 'Post Type General Name', 'contact-form-7-style' ),
			'singular_name'       	=> _x( 'Contact Style', 'Post Type Singular Name', 'contact-form-7-style' ),
			'menu_name'           	=> __( 'Contact Style', 'contact-form-7-style' ),
			'parent_item_colon'   	=> __( 'Parent Style:', 'contact-form-7-style' ),
			'all_items'           	=> __( 'All Styles', 'contact-form-7-style' ),
			'view_item'           	=> __( 'View Style', 'contact-form-7-style' ),
			'add_new_item'        	=> __( 'Add New', 'contact-form-7-style' ),
			'add_new'             	=> __( 'Add New', 'contact-form-7-style' ),
			'edit_item'           	=> __( 'Edit Style', 'contact-form-7-style' ),
			'update_item'         	=> __( 'Update Style', 'contact-form-7-style' ),
			'search_items'        	=> __( 'Search Style', 'contact-form-7-style' ),
			'not_found'           	=> __( 'Not found', 'contact-form-7-style' ),
			'not_found_in_trash'  	=> __( 'Not found in Trash', 'contact-form-7-style' )
		);
	$args = array(
		'label'               		=> __( 'cf7_style', 'contact-form-7-style' ),
		'description'         		=> __( 'Add/remove contact style', 'contact-form-7-style' ),
		'labels'              		=> $labels,
		'supports'            		=> array( 'title' ),
		'hierarchical'        		=> false,
		'taxonomies' 				=> array('style_category'), 
		'public'              		=> true,
		'show_ui'             		=> true,
		'show_in_menu'        		=> true,
		'show_in_nav_menus'   		=> false,
		'show_in_admin_bar'   		=> false,
		'menu_icon'					=> "dashicons-twitter",
		'menu_position'       		=> 28.555555,
		'can_export'          		=> true,
		'has_archive'         		=> false,
		'exclude_from_search' 		=> true,								
		'publicly_queryable'  		=> false,
		'capability_type'     		=> 'page'
	);
	/*register custom post type CF7_STYLE*/
	register_post_type( 'cf7_style', $args );

	$labels = array(
		'name'                       		=> _x( 'Categories', 'Taxonomy General Name', 'contact-form-7-style' ),
		'singular_name'              		=> _x( 'Categories', 'Taxonomy Singular Name', 'contact-form-7-style' ),
		'menu_name'                  		=> __( 'Categories', 'contact-form-7-style' ),
		'all_items'                  		=> __( 'All Categories', 'contact-form-7-style' ),
		'parent_item'                		=> __( 'Parent Categories', 'contact-form-7-style' ),
		'parent_item_colon'    				=> __( 'Parent Categories:', 'contact-form-7-style' ),
		'new_item_name'        				=> __( 'New Categories Name', 'contact-form-7-style' ),
		'add_new_item'               		=> __( 'Add New Categories', 'contact-form-7-style' ),
		'edit_item'                  		=> __( 'Edit Categories', 'contact-form-7-style' ),
		'update_item'                		=> __( 'Update Categories', 'contact-form-7-style' ),
		'separate_items_with_commas' 		=> __( 'Separate Categories with commas', 'contact-form-7-style' ),
		'search_items'               		=> __( 'Search Categories', 'contact-form-7-style' ),
		'add_or_remove_items'        		=> __( 'Add or remove Categories', 'contact-form-7-style' ),
		'choose_from_most_used'     		=> __( 'Choose from the most used Categories', 'contact-form-7-style' ),
		'not_found'                  		=> __( 'Not Found', 'contact-form-7-style' ),
	);
	$args = array(
		'labels'                => $labels,
		'hierarchical'          => true,
		'public'                => true,
		'show_ui'               => false,
		'show_admin_column' 	=> true,
		'show_in_nav_menus' 	=> false,
		'show_tagcloud'         => true,
	);
	//register tax
	register_taxonomy( 'style_category', array( 'cf7_style' ), $args );

	foreach ( get_predefined_cf7_style_template_data() as $style ) {
		cf7_style_create_post( strtolower( str_replace( " ", "-", $style['title'] ) ), $style['title'], $style['image'] );
	}
	if( get_option( 'cf7_style_add_categories', 0 ) == 0 ){
		$cf7_style_args = array(
			'post_type' => 'cf7_style',
			'posts_per_page' => '-1'
		);
		
		$cf7_style_query = new WP_Query( $cf7_style_args );
		if ( $cf7_style_query->have_posts() ) {
			while ( $cf7_style_query->have_posts() ) {
				$cf7_style_query->the_post();
				$temp_title = get_the_title();
				$temp_ID = get_the_ID();

				foreach ( get_predefined_cf7_style_template_data() as $style ) {
					if( $temp_title == wptexturize( $style[ 'title' ] ) ) {
						wp_set_object_terms( $temp_ID, $style[ 'category' ], 'style_category' );
					}
				}
			}
			wp_reset_postdata();
			update_option( 'cf7_style_add_categories', 1 );
		}
	}
	$cf7_style_update_saved = get_option( 'cf7_style_update_saved' );
	if( $cf7_style_update_saved == "yes" ) {
			$cf7_style_args = array(
				'post_type' 		=> 'cf7_style',
				'style_category' 	=> 'custom-style',
				'posts_per_page' 	=> '-1'
			);
			$cf7s_manual_old_style = "";
			$new_settings = array();
			$cf7_style_query = new WP_Query( $cf7_style_args );
			if ( $cf7_style_query->have_posts() ) {
				while ( $cf7_style_query->have_posts() ) {
					$cf7_style_query->the_post();
					$cur_style_id 		= get_the_ID();
					$cur_manual_style 	= get_post_meta( $cur_style_id, 'cf7_style_manual_style', true );
					$cur_custom_styles 	= maybe_unserialize( get_post_meta( $cur_style_id, 'cf7_style_custom_styles', true ));
					if($cur_manual_style){
						$cf7s_manual_old_style .= $cur_manual_style;
						update_post_meta( $cur_style_id, 'cf7_style_manual_style', '' );
					}
					if($cur_custom_styles){
						$cf7s_custom_old_settings = $cur_custom_styles;
						require_once( 'cf7-style-match-old.php' );
						$new_settings = get_new_styler_data( $cf7s_custom_old_settings );
						update_post_meta( $cur_style_id, 'cf7_style_manual_styles', '');
						update_post_meta( $cur_style_id, 'cf7_style_custom_styles', '');
						update_post_meta( $cur_style_id, 'cf7_style_custom_styler', $new_settings, "");
					}
				}
				wp_reset_postdata();
				if($cf7s_manual_old_style){
					update_option( 'cf7_style_manual_style', $cf7s_manual_old_style );
				}
			}
			update_option( 'cf7_style_update_saved', 'no' );
	}
	require_once( 'cf7-style-meta-box.php' );
	if ( ! is_admin() ) {
		add_action('wp_head', 'cf7_style_custom_css_generator');  
	}
}

function cf7_style_frontend_scripts(){
	if (!wp_script_is( 'jquery', 'enqueued' )) {
		wp_enqueue_script('jquery');
	}
	if(is_user_logged_in()){
		wp_enqueue_style( "cf7-style-bar-style", WPCF7S_LOCATION . "css/admin-bar.css", array(), WPCF7S_PLUGIN_VER, "all");
	}
	wp_enqueue_style( "cf7-style-frontend-style", WPCF7S_LOCATION . "css/frontend.css", array(), WPCF7S_PLUGIN_VER, "all");
	wp_enqueue_style( "cf7-style-responsive-style", WPCF7S_LOCATION . "css/responsive.css", array(), WPCF7S_PLUGIN_VER, "all");
	wp_enqueue_script( "cf7-style-frontend-script", WPCF7S_LOCATION . "js/frontend-min.js", array( 'jquery' ), WPCF7S_PLUGIN_VER, true);
}
function cf7style_toolbar_link($wp_admin_bar) {
	$args = array(
		'id' => 'cf7-style',
		'title' => 'Contact Form 7 Style', 
		'href' => admin_url("edit.php?post_type=cf7_style"), 
		'meta' => array(
			'class' => 'contact-style', 
			'title' => 'Contact Form 7 Style',
			'html' => '<span class="admin-style-icon"><i class="dashicons-before dashicons-twitter" aria-hidden="true"></i></span>'
		)
	);
	$wp_admin_bar->add_node($args);
}
function cf7style_update_db_check() {
	if (get_option( 'cf7_style_plugin_version' ) != WPCF7S_PLUGIN_VER) {
	    cf7_style_create_posts();
	    update_option( 'cf7_style_plugin_version', WPCF7S_PLUGIN_VER );
	}
}

function cf7style_check_deleted( $postid ){
	global $post_type;   
	if ( $post_type != 'cf7_style' ) return;
	$check_deleted = get_option('cf7_style_deleted');
	$clr_form_args = array(
		'post_type' => 'wpcf7_contact_form',
		'posts_per_page' => -1,
		'meta_key' => 'cf7_style_id',
		'meta_value' => $postid
	);
	$form_query = new WP_Query( $clr_form_args );
	if ( $form_query->have_posts() ) {
		while ( $form_query->have_posts() ) {
			$form_query->the_post();
			/*form id*/
			update_post_meta( get_the_ID(), 'cf7_style_id', '');
		}
		wp_reset_postdata();
	}
	if("yes" != $check_deleted){
		update_option( 'cf7_style_no_temps', 'hide_box' );
		update_option('cf7_style_deleted','yes');
	}
}

add_action('admin_bar_menu', 'cf7style_toolbar_link', 999);

add_action( 'admin_enqueue_scripts', 'cf7_style_admin_scripts' );
add_action( 'wp_enqueue_scripts', 'cf7_style_frontend_scripts' );
add_action( 'init', 'cf7style_load_elements' );
add_action( 'restrict_manage_posts', 'cf7_style_add_taxonomy_filters' );
add_action( 'publish_cf7_style', 'cf7_style_set_style_category_on_publish', 10, 2 );
add_filter( 'wpcf7_form_class_attr', 'cf7_style_add_class' );
add_filter( 'manage_cf7_style_posts_columns', 'cf7_style_event_table_head');
add_action( 'manage_cf7_style_posts_custom_column', 'cf7_style_event_table_content', 10, 2 );
add_action( 'plugins_loaded', 'cf7style_update_db_check' );
add_action( 'before_delete_post', 'cf7style_check_deleted' );

function cf7_style_event_table_head( $defaults ) {
    $new = array();
    foreach( $defaults as $key=>$value) {
        if( $key=='title') {  // when we find the date column
          	$new['preview-style']  = 'Preview Style';
        }    
        $new[$key]=$value;
    }  
    return $new;
}
function cf7_style_event_table_content( $column_name, $post_id ) {
	//    cf7_style_image_preview
	if ( $column_name == 'preview-style' ) {
		$img_src = get_post_meta( $post_id, 'cf7_style_image_preview', true );
		echo "<a href='".admin_url() ."post.php?post=".$post_id."&action=edit"."'><span class='thumb-preview'><img src='" . plugins_url() ."/"."contact-form-7-style". ( empty( $img_src ) ? "/images/default_form.jpg" : $img_src ) . "' alt='".get_the_title( $post_id )."' title='".get_the_title( $post_id )."'/><div class='previewed-img'><img src='" . plugins_url() ."/"."contact-form-7-style". ( empty( $img_src ) ? "/images/default_form.jpg" : $img_src ) . "' alt='".get_the_title( $post_id )."' title='Edit ".get_the_title( $post_id )." Style'/></div></span></a>"	;
	}
}
 
/**
 * Reset the cf7_style_cookie option
 */
function cf7_style_deactivate() {
	update_option( 'cf7_style_cookie', false );
	update_option( 'cf7_style_add_categories', 0 );
}
register_deactivation_hook( __FILE__, 'cf7_style_deactivate' );

/*
 * Function created for deactivated Contact Form 7 Designer plugin.
 * This is because styles of that plugin is in conflict with ours. 
 * No one should add an id in the html tag.
 */
function deactivate_contact_form_7_designer_plugin() {
    if ( is_plugin_active('contact-form-7-designer/cf7-styles.php') ) {
        deactivate_plugins('contact-form-7-designer/cf7-styles.php');
        add_action( 'admin_notices', 'cf7_designer_deactivation_notice' );
    }
}
add_action('admin_init', 'deactivate_contact_form_7_designer_plugin');

/*
 * notice for the user
 */
function cf7_designer_deactivation_notice() { ?>
    <div class="error">
        <p><?php _e( "You cannot activate CF7 Designer while CF7 Style is activated!", "contact-form-7-style" ) ?></p>
    </div>
<?php }

/*
 * Tracking feature
 */
require_once( 'misc/tracking.php' );
/*
 * Welcome panel
 */
require_once( 'misc/welcome.php' );
/*
 * Slider meta box in CF7
 */
require_once( 'inc/slider_meta_box.php' );
/*
 * global css page
 */
require_once( 'inc/editor_page.php' );

/**
 * System status
 */
require_once( 'inc/system_status.php' );


/*
 * Remove Predefined templates
 */
function cf7_style_remove_templates() {
	global $wpdb;
	update_option( 'cf7_style_deleted', 'yes' );
	update_option( 'cf7_style_add_categories', 0 );
	$del_args = array(
		'posts_per_page' => -1,
		'post_type' => 'cf7_style',
		'tax_query' => array(
			array(
				'taxonomy' => 'style_category',
				'field'    => 'slug',
				'terms'    => 'custom-style',
				'operator' => 'NOT IN',
			),
		),
	);
	$del_query = new WP_Query( $del_args );
	if ( $del_query->have_posts() ) {
		while ( $del_query->have_posts() ) {
			$del_query->the_post();
			$style_id = get_the_ID();
			$clr_form_args = array(
				'post_type' => 'wpcf7_contact_form',
				'posts_per_page' => -1,
				'meta_key' => 'cf7_style_id',
				'meta_value' => $style_id
			);
			$form_query = new WP_Query( $clr_form_args );
			if ( $form_query->have_posts() ) {
				while ( $form_query->have_posts() ) {
					$form_query->the_post();
					/*form id*/
					update_post_meta( get_the_ID(), 'cf7_style_id', '');
				}
				wp_reset_postdata();
			}
			wp_delete_post( $style_id,false);
		}
		wp_reset_postdata();
		print_r('success');
	}
	wp_die();
}
add_action( 'wp_ajax_cf7_style_remove_templates', 'cf7_style_remove_templates' );
function cf7_style_remove_box() {
	global $wpdb;
	update_option( 'cf7_style_no_temps', 'hide_box' );
	wp_die();
}
add_action( 'wp_ajax_cf7_style_remove_box', 'cf7_style_remove_box' );
function cf7_style_remove_welcome_box() {
	global $wpdb;
	update_option( 'cf7_style_welcome', 'hide_box' );
	wp_die();
}
add_action( 'wp_ajax_cf7_style_remove_welcome_box', 'cf7_style_remove_welcome_box' );

/**
 * Frontend edit link
 */

function cf7_style_frontend_edit_link( $form ) {

	if( is_user_logged_in() && current_user_can( 'manage_options' ) && !is_admin() && get_option( 'cf7_style_form_tooltip' ) == 1 ) {

		$cf7 = wpcf7_get_current_contact_form();  // Current contact form 7 object
		$form_id = get_form_id( $cf7 );
		$cf7_style_id = get_post_meta( $form_id, 'cf7_style_id', true );

		if( empty( $cf7_style_id ) ) {
			$form .= "<a href='" . admin_url( 'edit.php?post_type=cf7_style' ) . "' class='frontend-edit-style-link'>" . __( 'Add Style', 'contact-form-7-style' ) . "</a>";
		} else {
			$cf7_style_data = get_post( $cf7_style_id, OBJECT );
			$template_type  = ( has_term( 'custom-style', 'style_category', $cf7_style_data ) ) ? __( 'Edit custom style', 'contact-form-7-style' ) :  __( 'Edit predifined template', 'contact-form-7-style' );
			$form .= "<a href='" . admin_url( 'post.php?post=' . $cf7_style_id . '&action=edit' ) . "' class='frontend-edit-style-link'>" . $template_type . "</a>";	
		}
	}

	return $form;
}
add_filter( 'wpcf7_form_elements', 'cf7_style_frontend_edit_link' );


/**
 * Dashboard generate preview on user interaction
 */

function cf7_style_generate_preview_dashboard() {

	$form_id = sanitize_text_field( $_POST['form_id'] );
	$form_title = sanitize_text_field( $_POST['form_title'] );
	$form = "<div class='multiple-form-generated-preview preview-form-container'><h4>" . $form_title . "</h4>" . do_shortcode( '[contact-form-7 id="'. $form_id .'" title="'. $form_title .'"]' ) . "</div>";
	echo $form;

	wp_die();
}
add_action( 'wp_ajax_cf7_style_generate_preview_dashboard', 'cf7_style_generate_preview_dashboard' );

/**
* Dashboard generate custom style  desired properties
*/

function cf7_style_load_property() {

	$form_property = sanitize_text_field( $_POST['property'] );
	$form_panel = "";
	$saved_values = maybe_unserialize(get_post_meta( $post->ID, 'cf7_style_custom_styler', true ));
	$saved_values = (empty($saved_values)) ? array() : $saved_values;
	require 'plugin-options.php';
	foreach( $elements as $property => $property_value ) {
		if( $property == $form_property ) {
			if( $property_value['description'] != ""){
				$form_panel .= '<h4 class="description-title">'.$property_value['description'].'</h4>';
			}
			foreach( $property_value['settings'] as $sub_property_key => $sub_property_value ) {
				$property = strtolower( $property );
				$sub_property_slug = strtolower( $options[$sub_property_value]['slug'] );
				$style_element_name 	= strtolower($options[$sub_property_value]['name']);
				$half_width_class = ( $style_element_name == "box sizing" || $style_element_name == "display" || $style_element_name == "position" ||  $style_element_name == "width" || $style_element_name == "height") ? "half-size" : "";
				$form_panel .= '<div class="element-styling '.$half_width_class.' '.$style_element_name.'"><h3><span>&lt;'.$property.'&gt;</span> '.$style_element_name . '</h3>';
				if( $options[$sub_property_value]['type'] ) {
					$form_panel .= "<ul>";
					foreach( $options[$sub_property_value]['type'] as $key => $value ) {
						if( $key != "comming-soon"  ){
							$form_panel .= generate_property_fields( $key, $value, $property, $sub_property_slug, $saved_values, '');
							$form_panel .= generate_property_fields( $key, $value, $property, $sub_property_slug, $saved_values, '_hover');
						} else {
							$form_panel .= "<li></li>";
						}
					}
					$form_panel .= "</ul>";
					$form_panel .= "</div>";
				}
			}
		}
	}
	print_r($form_panel);
	wp_die();
}
add_action( 'wp_ajax_cf7_style_load_property', 'cf7_style_load_property' );