<?php

//include(get_template_directory().'/includes/resource/awesom_icons.php');

$settings = array();

$settings['page'] = array(
						array('section_name' => 'Header Settings',
							  'section_id' => 'header',
							  'position' => 'normal',
							  'fields' =>  array(
											'is_home' => 
												array(
													'type' => 'checkbox', //builtin fields include:
													'id' => 'is_home',
													'title' => __('Make Homepage', SH_NAME),
													'desc' => __(" " , SH_NAME),
													'help' => __("Make This is a Homepage" , SH_NAME),
													),
											'header' => 
												array(
													'type' => 'radio', //builtin fields include:
													'id' => 'header',
													'title' => __('Show Header', SH_NAME),
													'options' => array('true'=>'True', 'false'=>'False'),
													'attributes' => array('style'=>'width:40%' ),
													'help' => __("Make it false If This is a Homepage" , SH_NAME),
													),
											'top_image'=> 
												array(
													'type' => 'upload', //builtin fields include:
													'id' => 'top_image',
													'title' => __('Top Image', SH_NAME),
													'attributes' => array( 'placeholder'=>__('Upload Page Top Image', SH_NAME) ),
													),
											'post_type'=> 
												array(
													'type' => 'select', //builtin fields include:
													'id' => 'tpl_post_type',
													'title' => __('Select Category', SH_NAME),
													'options' => sh_get_categories(array('hide_empty' => FALSE)),
													'help' => __("Note: This Option is only work for 'Our Mission' and 'Recent News' Template, Otherwise leave it" , SH_NAME),
													),
											)
								),
						array('section_name' => 'Sidebar Settings',
							  'section_id' => 'sidebar',
							  'position' => 'side',
							  'fields' =>  array(
											'sidebar'=> 
												array(
													'type' => 'select', //builtin fields include:
													'id' => 'sidebar',
													'title' => __('Sidebar', SH_NAME),
													'options' => sh_get_sidebars(),
													'help' => __("This Option is Not Supported in Default Page Template" , SH_NAME),
													),
											'sidebar_pos' => array(
																'type' => 'radio', //builtin fields include:
																'id' => 'sidebar_pos',
																'title' => __('Sidebar Postion', SH_NAME),
																'options' => array( 'left' => 'Left' , 'right'=> 'Right' ),
																'attributes' => array('style'=>'width:40%' ),
															),
											)
								),
						array('section_name' => 'SEO Settings',
							  'section_id' => 'seo_settings',
							  'position' => 'normal',
							  'fields' =>  array(
											'meta_title'=> 
												array(
													'type' => 'text', //builtin fields include:
													'id' => 'meta_title',
													'title' => __('Meta Title', SH_NAME),
													'help' => __("Enter Meta Title." , SH_NAME),
													),
											'meta_desc'=> 
												array(
													'type' => 'textarea', //builtin fields include:
													'id' => 'meta_desc',
													'title' => __('Meta Description', SH_NAME),
													'help' => __("Enter Meta Description." , SH_NAME),
													),
											'meta_keywords'=> 
												array(
													'type' => 'textarea', //builtin fields include:
													'id' => 'meta_keywords',
													'title' => __('Meta Key Words', SH_NAME),
													'help' => __("Enter Meta Key Words." , SH_NAME),
													),
											)
								),
);

$settings['product'] = array(
						array('section_name' => 'Header Settings',
							  'section_id' => 'header',
							  'position' => 'normal',
							  'fields' =>  array(
											'top_image'=> 
												array(
													'type' => 'upload', //builtin fields include:
													'id' => 'top_image',
													'title' => __('Top Image', SH_NAME),
													'help' => __("This is short help" , SH_NAME),
													'attributes' => array( 'placeholder'=>__('Upload Page Top Image', SH_NAME) ),
													),
											)
								),
);


$settings['dict_testimonials'] = array(
						array('section_name' => 'Generel Settings',
							  'section_id' => 'general_info',
							  'position' => 'normal',
							  'fields' =>  array(
											'name' => 
												array(
												   'type' => 'text', //builtin fields include:
												   'id' => 'name',
												   'title' => __('Name', SH_NAME),
												   'attributes' => array( 'placeholder'=>__('Enter name', SH_NAME) ),
												  ),
											'designation'=> 
												array(
													'type' => 'text', //builtin fields include:
													'id' => 'designation',
													'title' => __('Designation', SH_NAME),
													'attributes' => array( 'placeholder'=>__('Enter designation', SH_NAME) ),
													),
											'location'=> 
												array(
												   'type' => 'text', //builtin fields include:
												   'id' => 'location',
												   'title' => __('Location', SH_NAME),
												   'attributes' => array( 'placeholder'=> __('Enter location', SH_NAME) ),
													),
											)
								),
						array('section_name' => 'SEO Settings',
							  'section_id' => 'seo_settings',
							  'position' => 'normal',
							  'fields' =>  array(
											'meta_title'=> 
												array(
													'type' => 'text', //builtin fields include:
													'id' => 'meta_title',
													'title' => __('Meta Title', SH_NAME),
													'help' => __("Enter Meta Title." , SH_NAME),
													),
											'meta_desc'=> 
												array(
													'type' => 'textarea', //builtin fields include:
													'id' => 'meta_desc',
													'title' => __('Meta Description', SH_NAME),
													'help' => __("Enter Meta Description." , SH_NAME),
													),
											'meta_keywords'=> 
												array(
													'type' => 'textarea', //builtin fields include:
													'id' => 'meta_keywords',
													'title' => __('Meta Key Words', SH_NAME),
													'help' => __("Enter Meta Key Words." , SH_NAME),
													),
											)
								),
);
$settings['dict_causes'] = array(
						array('section_name' => 'Donation Settings',
							  'section_id' => 'donation',
							  'position' => 'normal',
							  'fields' =>  array(
												'start_date' => array(
																	  'type' => 'date', //builtin fields include:
																	  'id' => 'start_date',
																	  'title' => __('Start Date', SH_NAME),
																	  'desc' => __('Enter event start date', SH_NAME),
																	  'attributes' => array( 'placeholder'=>'YYYY-MM-DD', 'style'=>'width:40%' ),
																	),
												'end_date'=>array(
															'type' => 'date', //builtin fields include:
															'id' => 'end_date',
															'title' => __('End Date', SH_NAME),
															'desc' => __('Enter event end date', SH_NAME),
															'attributes' => array( 'placeholder'=>'YYYY-MM-DD', 'style'=>'width:40%' ),
														  ),
												'currency_symbol' => array(
														   'type' => 'text', //builtin fields include:
														   'id' => 'currency_symbol',
														   'title' => __('Donation Neede Currency Symbol', SH_NAME),
														   'attributes' => array( 'placeholder' => __('Enter needed donation currency symbol', SH_NAME) ),
												),
												'currency_code' => array(
														   'type' => 'select', //builtin fields include:
														   'id' => 'currency_code',
														   'title' => __('Currency Code', SH_NAME),
														   'options' => sh_get_currencies()
												),
												'donation_needed'=> 
												array(
												   'type' => 'text', //builtin fields include:
												   'id' => 'donation_needed',
												   'title' => __('Donation Needed', SH_NAME),
												   'attributes' => array( 'placeholder' => __('Enter needed donation', SH_NAME) ),
													  ),
												'donation_collected'=>  
												array(
												   'type' => 'text', //builtin fields include:
												   'id' => 'donation_collected',
												   'title' => __('Donation Collected', SH_NAME),
												   'attributes' => array( 'placeholder' => __('Enter collected donation', SH_NAME) ),
													  ),
												)
								),
						array('section_name' => 'Video Link',
						  'section_id' => 'video_link',
						  'position' => 'normal',
						  'fields' =>  array(
										'video_link' => 
										array(
										   'type' => 'text', //builtin fields include:
										   'id' => 'video_link',
										   'title' => __('Video Link', SH_NAME),
										   'attributes' => array( 'placeholder'=> __('Enter video Link', SH_NAME) ),
											),
														
									)
						),
						array('section_name' => 'Donation Transactions',
						  'section_id' => 'donation_transactions',
						  'position' => 'normal',
						  'fields' =>  array(
										'transactions' => 
										 array(
											 'type' => 'transactions', //builtin fields include:
											 'id' => 'transactions',
											 'title' => __('Donations Trasactions', SH_NAME),
											 'attributes' => array( 'placeholder'=> __('Enter donation location', SH_NAME) ),
											),
														
										)
							),
						array('section_name' => 'Location',
						  'section_id' => 'location',
						  'position' => 'normal',
						  'fields' =>  array(
										'location' => 
										 array(
											 'type' => 'text', //builtin fields include:
											 'id' => 'location',
											 'title' => __('Location', SH_NAME),
											 'attributes' => array( 'placeholder'=> __('Enter donation location', SH_NAME) ),
											),
														
										)
							),
						array('section_name' => 'Gallery Settings',
						  'section_id' => 'causes_gallery_settings',
						  'position' => 'normal',
														'fields' =>  array(
														'gallery' =>  array(
																		'type' => 'gallery', //builtin fields include:
																		'id' => 'gallery',
																		'title' => __('Gallery', SH_NAME),
																		'class' => 'regular-text text-input',
																	),
														)
													),
						array('section_name' => 'Display Settings',
									  'section_id' => 'project_setting',
									  'position' => 'normal',
									  'fields' =>  array(
									  					'sidebar_pos' => array(
																'type' => 'radio', //builtin fields include:
																'id' => 'sidebar_pos',
																'title' => __('Sidebar Postion', SH_NAME),
																'options' => array( 'left' => 'Left' , 'right'=> 'Right' ),
																'attributes' => array('style'=>'width:40%' ),
															),
														'sidebar'=>  array(
																'type' => 'select', //builtin fields include:
																'id' => 'sidebar',
																'title' => __('Sidebar', SH_NAME),
																'options' => sh_get_sidebars(),
															),
														
														'top_image'=> array(
																'type' => 'upload', //builtin fields include:
																'id' => 'top_image',
																'title' => __('Top Image', SH_NAME),
																'attributes' => array( 'placeholder'=>__('Upload project Top Image', SH_NAME) ),
															),
														)
													),
						array('section_name' => 'SEO Settings',
							  'section_id' => 'seo_settings',
							  'position' => 'normal',
							  'fields' =>  array(
											'meta_title'=> 
												array(
													'type' => 'text', //builtin fields include:
													'id' => 'meta_title',
													'title' => __('Meta Title', SH_NAME),
													'help' => __("Enter Meta Title." , SH_NAME),
													),
											'meta_desc'=> 
												array(
													'type' => 'textarea', //builtin fields include:
													'id' => 'meta_desc',
													'title' => __('Meta Description', SH_NAME),
													'help' => __("Enter Meta Description." , SH_NAME),
													),
											'meta_keywords'=> 
												array(
													'type' => 'textarea', //builtin fields include:
													'id' => 'meta_keywords',
													'title' => __('Meta Key Words', SH_NAME),
													'help' => __("Enter Meta Key Words." , SH_NAME),
													),
											)
								),
);
$settings['dict_project'] = array(

						array('section_name' => 'Project Information',
							  'section_id' => 'informaton',
							  'position' => 'normal',
									'fields' =>  array(
														'date' =>  array(
																	'type' => 'date', //builtin fields include:
																	'id' => 'date',
																	'title' => __('Pick a date', SH_NAME),
																	'std' => '',
																	'attributes' => array( 'placeholder'=>__('Pick a Date', SH_NAME) ),
																),

														'location'=>  array(
																 'type' => 'text', //builtin fields include:
																 'id' => 'location',
																 'title' => __('Location', SH_NAME),
																 'attributes' => array( 'placeholder'=> __('Enter project location', SH_NAME) ),
																),
														)
													),
						array('section_name' => 'Amount Information',
										  'section_id' => 'amount_information',
										  'position' => 'normal',
										'fields' =>  array(
															'spent_amount_currency'=> array(
																	   'type' => 'text', //builtin fields include:
																	   'id' => 'spent_amount_currency',
																	   'title' => __('Spent Amount Currency', SH_NAME),
																	   'attributes' => array( 'placeholder' => __('Enter Currency Symbol.', SH_NAME) ),
																	  ),
															'spent_amount'=> array(
																	 'type' => 'text', //builtin fields include:
																	 'id' => 'spent_amount',
																	 'title' => __('Spent Amount', SH_NAME),
																	 'attributes' => array( 'placeholder' => __('Enter amount spent on this project.', SH_NAME) ),
																	),
															'amount_needed_currency'=> array(
																	 'type' => 'text', //builtin fields include:
																	 'id' => 'amount_needed_currency',
																	 'title' => __('Amount Needed Currency', SH_NAME),
																	 'attributes' => array( 'placeholder' => __('Enter Currency Symbol.', SH_NAME) ),
																	),
															'amount_needed'=> array(
																	 'type' => 'text', //builtin fields include:
																	 'id' => 'amount_needed',
																	 'title' => __('Amount Needed', SH_NAME),
																	 'attributes' => array( 'placeholder' => __('Enter amount needed for this project.', SH_NAME) ),
																	),
															'currency_code' => array(
																   'type' => 'select', //builtin fields include:
																   'id' => 'currency_code',
																   'title' => __('Currency Code', SH_NAME),
																   'options' => sh_get_currencies()
																	),
															)
														),
						array('section_name' => 'Donation Transactions',
							  'section_id' => 'donation_transactions',
							  'position' => 'normal',
							  'fields' =>  array(
											'transactions' => 
											 array(
												 'type' => 'transactions', //builtin fields include:
												 'id' => 'transactions',
												 'title' => __('Donations Trasactions', SH_NAME),
												 'attributes' => array( 'placeholder'=> __('Enter donation location', SH_NAME) ),
												),
											)
								),
						array('section_name' => 'Display Settings',
									  'section_id' => 'project_setting',
									  'position' => 'normal',
									  'fields' =>  array(
									  					'sidebar_pos' => array(
																'type' => 'radio', //builtin fields include:
																'id' => 'sidebar_pos',
																'title' => __('Sidebar Postion', SH_NAME),
																'options' => array( 'left' => 'Left' , 'right'=> 'Right' ),
																'attributes' => array('style'=>'width:40%' ),
															),
														'sidebar'=>  array(
																'type' => 'select', //builtin fields include:
																'id' => 'sidebar',
																'title' => __('Sidebar', SH_NAME),
																'options' => sh_get_sidebars(),
															),
														'font'=> array(
																'type' => 'select', //builtin fields include:
																'id' => 'font',
																'title' => __('Service Icon', SH_NAME),
																'options' => sh_font_awesome(),
															),
														'videos'=> array(
																  'type' => 'multi_text', //builtin fields include:
																  'id' => 'videos',
																  'title' => __('Videos', SH_NAME),
																  'class' => 'regular-text text-input',
															  ),
														'top_image'=> array(
																'type' => 'upload', //builtin fields include:
																'id' => 'top_image',
																'title' => __('Top Image', SH_NAME),
																'attributes' => array( 'placeholder'=>__('Upload project Top Image', SH_NAME) ),
															),
														)
													),
						array('section_name' => 'SEO Settings',
							  'section_id' => 'seo_settings',
							  'position' => 'normal',
							  'fields' =>  array(
											'meta_title'=> 
												array(
													'type' => 'text', //builtin fields include:
													'id' => 'meta_title',
													'title' => __('Meta Title', SH_NAME),
													'help' => __("Enter Meta Title." , SH_NAME),
													),
											'meta_desc'=> 
												array(
													'type' => 'textarea', //builtin fields include:
													'id' => 'meta_desc',
													'title' => __('Meta Description', SH_NAME),
													'help' => __("Enter Meta Description." , SH_NAME),
													),
											'meta_keywords'=> 
												array(
													'type' => 'textarea', //builtin fields include:
													'id' => 'meta_keywords',
													'title' => __('Meta Key Words', SH_NAME),
													'help' => __("Enter Meta Key Words." , SH_NAME),
													),
											)
								),
);
$settings['dict_portfolio'] = array(
						array('section_name' => 'Project Information',
								  'section_id' => 'informaton',
								  'position' => 'normal',
										'fields' =>  array(
															'location'=>  array(
																	 'type' => 'text', //builtin fields include:
																	 'id' => 'location',
																	 'title' => __('Location', SH_NAME),
																	 'attributes' => array( 'placeholder'=> __('Enter project location', SH_NAME) ),
																	),
															'leader'=>  array(
																	 'type' => 'text', //builtin fields include:
																	 'id' => 'leader',
																	 'title' => __('Leader', SH_NAME),
																	 'attributes' => array( 'placeholder'=> __('Enter project leader', SH_NAME) ),
																	),
															'task'=>  array(
																	 'type' => 'text', //builtin fields include:
																	 'id' => 'task',
																	 'title' => __('Task', SH_NAME),
																	 'attributes' => array( 'placeholder'=> __('Enter project Task', SH_NAME) ),
																	),
															)
														),
						array('section_name' => 'Display Settings',
										  'section_id' => 'project_setting',
										  'position' => 'normal',
										  'fields' =>  array(
															'sidebar_pos' => array(
																	'type' => 'radio', //builtin fields include:
																	'id' => 'sidebar_pos',
																	'title' => __('Sidebar Postion', SH_NAME),
																	'options' => array( 'left' => 'Left' , 'right'=> 'Right' ),
																	'attributes' => array('style'=>'width:40%' ),
																),
															'sidebar'=>  array(
																	'type' => 'select', //builtin fields include:
																	'id' => 'sidebar',
																	'title' => __('Sidebar', SH_NAME),
																	'options' => sh_get_sidebars(),
																),
															'top_image'=> array(
																	'type' => 'upload', //builtin fields include:
																	'id' => 'top_image',
																	'title' => __('Top Image', SH_NAME),
																	'attributes' => array( 'placeholder'=>__('Upload project Top Image', SH_NAME) ),
																),
															)
														),
						array('section_name' => 'SEO Settings',
							  'section_id' => 'seo_settings',
							  'position' => 'normal',
							  'fields' =>  array(
											'meta_title'=> 
												array(
													'type' => 'text', //builtin fields include:
													'id' => 'meta_title',
													'title' => __('Meta Title', SH_NAME),
													'help' => __("Enter Meta Title." , SH_NAME),
													),
											'meta_desc'=> 
												array(
													'type' => 'textarea', //builtin fields include:
													'id' => 'meta_desc',
													'title' => __('Meta Description', SH_NAME),
													'help' => __("Enter Meta Description." , SH_NAME),
													),
											'meta_keywords'=> 
												array(
													'type' => 'textarea', //builtin fields include:
													'id' => 'meta_keywords',
													'title' => __('Meta Key Words', SH_NAME),
													'help' => __("Enter Meta Key Words." , SH_NAME),
													),
											)
								),
);
$settings['dict_event'] = array(
						array('section_name' => 'Event Information',
							  'section_id' => 'event_information',
							  'position' => 'normal',
									'fields' =>  array(
														'start_date' => array(
																	  'type' => 'date', //builtin fields include:
																	  'id' => 'start_date',
																	  'title' => __('Start Date', SH_NAME),
																	  'desc' => __('Enter event start date', SH_NAME),
																	  'attributes' => array( 'placeholder'=>'YYYY-MM-DD', 'style'=>'width:40%' ),
																	),
														'end_date'=>array(
																	'type' => 'date', //builtin fields include:
																	'id' => 'end_date',
																	'title' => __('End Date', SH_NAME),
																	'desc' => __('Enter event end date', SH_NAME),
																	'attributes' => array( 'placeholder'=>'YYYY-MM-DD', 'style'=>'width:40%' ),
																  ),
														'start_time'=> array(
																  'type' => 'timepicker', //builtin fields include:
																  'id' => 'start_time',
																  'title' => __('Event Start Time', SH_NAME),
																  'desc' => __('Enter event start time', SH_NAME),
																  'attributes' => array( 'placeholder'=>'HH:MM', 'style'=>'width:40%' ),
																),
														'end_time'=> array(
																	'type' => 'timepicker', //builtin fields include:
																	'id' => 'end_time',
																	'title' => __('Event End Time', SH_NAME),
																	'desc' => __('Enter end time start time', SH_NAME),
																	'attributes' => array( 'placeholder'=>'HH:MM', 'style'=>'width:40%' ),
																  ),
														'location'=>array(
																	'type' => 'text', //builtin fields include:
																	'id' => 'location',
																	'title' => __('Event Location', SH_NAME),
																	'desc' => __('Enter event location', SH_NAME),
																	'attributes' => array(),
																  ),
														)
													),
						array('section_name' => 'Organizer Information',
							  'section_id' => 'organizer_information',
							  'position' => 'normal',
									'fields' =>  array(
														'organizer' => array(
																	'type' => 'text', //builtin fields include:
																	'id' => 'organizer',
																	'title' => __('Organizer', SH_NAME),
																	'desc' => __('Enter the name of the event organizer', SH_NAME),
																	'attributes' => array(),
																   ),
														'address'=>array(
																  'type' => 'text', //builtin fields include:
																  'id' => 'address',
																  'title' => __('Organizer Address', SH_NAME),
																  'desc' => __('Enter the address of the organizer', SH_NAME),
																  'attributes' => array(),
																 ),
														'contact'=> array(
																  'type' => 'text', //builtin fields include:
																  'id' => 'contact',
																  'title' => __('Contact Number', SH_NAME),
																  'desc' => __('Enter the contact number', SH_NAME),
																  'attributes' => array('placeholder'=>'1 (444) 4564', 'style'=>'width:40%;'),
																 ),
														'email'=> array(
																'type' => 'text', //builtin fields include:
																'id' => 'email',
																'title' => __('Email ID', SH_NAME),
																'desc' => __('Enter email ID', SH_NAME),
																'attributes' => array( 'placeholder'=>'example@email.com' ),
															   ),
														'website'=>array(
																  'type' => 'text', //builtin fields include:
																  'id' => 'website',
																  'title' => __('Website', SH_NAME),
																  'desc' => __('Enter event website', SH_NAME),
																  'attributes' => array( 'placeholder'=>'http://www.example.com' ),
																 ),
														)
													),
						array('section_name' => 'Display Settings',
							  'section_id' => 'display_events',
							  'position' => 'normal',
									'fields' =>  array(
														'sidebar_pos' => array(
																'type' => 'radio', //builtin fields include:
																'id' => 'sidebar_pos',
																'title' => __('Sidebar Postion', SH_NAME),
																'options' => array( 'left' => 'Left' , 'right'=> 'Right' ),
																'attributes' => array('style'=>'width:40%' ),
															),
														'sidebar'=>array(
																'type' => 'select', //builtin fields include:
																'id' => 'sidebar',
																'title' => __('Sidebar', SH_NAME),
																'options' => sh_get_sidebars(),
															),
														'top_image'=>  array(
																'type' => 'upload', //builtin fields include:
																'id' => 'top_image',
																'title' => __('Top Image', SH_NAME),
																'attributes' => array( 'placeholder'=>__('Upload Event Top Image', SH_NAME) ),
															),
														)
													),
						array('section_name' => 'SEO Settings',
							  'section_id' => 'seo_settings',
							  'position' => 'normal',
							  'fields' =>  array(
											'meta_title'=> 
												array(
													'type' => 'text', //builtin fields include:
													'id' => 'meta_title',
													'title' => __('Meta Title', SH_NAME),
													'help' => __("Enter Meta Title." , SH_NAME),
													),
											'meta_desc'=> 
												array(
													'type' => 'textarea', //builtin fields include:
													'id' => 'meta_desc',
													'title' => __('Meta Description', SH_NAME),
													'help' => __("Enter Meta Description." , SH_NAME),
													),
											'meta_keywords'=> 
												array(
													'type' => 'textarea', //builtin fields include:
													'id' => 'meta_keywords',
													'title' => __('Meta Key Words', SH_NAME),
													'help' => __("Enter Meta Key Words." , SH_NAME),
													),
											)
								),
);
$settings['dict_gallery'] = array(
						array('section_name' => 'Gallery Settings',
							  'section_id' => 'gallery_settings',
							  'position' => 'normal',
									'fields' =>  array(
														'sub_title' => array(
															  'type' => 'text', //builtin fields include:
															  'id' => 'sub_title',
															  'title' => __('Sub Title', SH_NAME),
															  ),
														'gallery'=> array(
															'type' => 'gallery', //builtin fields include:
															'id' => 'gallery',
															'title' => __('Gallery', SH_NAME),
															'class' => 'regular-text text-input',
														),
														'videos'=> array(
																	  'type' => 'multi_text', //builtin fields include:
																	  'id' => 'videos',
																	  'title' => __('Videos', SH_NAME),
																	  'class' => 'regular-text text-input',
																  ),
														)
													),
						array('section_name' => 'Display Settings',
									  'section_id' => 'gallery_display',
									  'position' => 'normal',
									  'fields' =>  array(
														'sidebar_pos' => 
														array(
															'type' => 'radio', //builtin fields include:
															'id' => 'sidebar_pos',
															'title' => __('Sidebar Postion', SH_NAME),
															'options' => array( 'left' => 'Left' , 'right'=> 'Right' ),
															'attributes' => array('style'=>'width:40%' ),
														),
														'sidebar'=> 
															array(
																'type' => 'select', //builtin fields include:
																'id' => 'sidebar',
																'title' => __('Sidebar', SH_NAME),
																'options' => sh_get_sidebars(),
															),
														'top_image' => array(
																'type' => 'upload', //builtin fields include:
																'id' => 'top_image',
																'title' => __('Top Image', SH_NAME),
																'help' => __("This is short help" , SH_NAME),
																'attributes' => array( 'placeholder'=>__('Upload Page Top Image', SH_NAME) ),
															),
														),
														
													),
						array('section_name' => 'SEO Settings',
							  'section_id' => 'seo_settings',
							  'position' => 'normal',
							  'fields' =>  array(
											'meta_title'=> 
												array(
													'type' => 'text', //builtin fields include:
													'id' => 'meta_title',
													'title' => __('Meta Title', SH_NAME),
													'help' => __("Enter Meta Title." , SH_NAME),
													),
											'meta_desc'=> 
												array(
													'type' => 'textarea', //builtin fields include:
													'id' => 'meta_desc',
													'title' => __('Meta Description', SH_NAME),
													'help' => __("Enter Meta Description." , SH_NAME),
													),
											'meta_keywords'=> 
												array(
													'type' => 'textarea', //builtin fields include:
													'id' => 'meta_keywords',
													'title' => __('Meta Key Words', SH_NAME),
													'help' => __("Enter Meta Key Words." , SH_NAME),
													),
											)
								),
);
$settings['post'] = array(
						array('section_name' => 'Post Settings',
							  'section_id' => 'post_Settings',
							  'position' => 'normal',
									'fields' =>  array(
														'location' => array(
															  'type' => 'text', //builtin fields include:
															   'id' => 'location',
															   'title' => __('Location', SH_NAME),
															   'attributes' => array( 'placeholder'=> __('Enter Location', SH_NAME) ),
															  ),
														'videos'=> array(
															  'type' => 'multi_text', //builtin fields include:
															  'id' => 'videos',
															  'title' => __('Videos', SH_NAME),
														  ),
														'format'=> array(
															'type' => 'radio', //builtin fields include:
															'id' => 'format',
															'title' => __('Post Format', SH_NAME),
															'options' => array('image'=>'Image', 'video'=>'Video', 'slider'=>'Slider'),
															'attributes' => array('style'=>'width:40%' ),
														),
														)
													),
						array('section_name' => 'Display Settings',
									  'section_id' => 'post_display',
									  'position' => 'normal',
									  'fields' =>  array(
														'sidebar_pos' => 
														array(
															'type' => 'radio', //builtin fields include:
															'id' => 'sidebar_pos',
															'title' => __('Sidebar Postion', SH_NAME),
															'options' => array( 'left' => 'Left' , 'right'=> 'Right' ),
															'attributes' => array('style'=>'width:40%' ),
														),
														'sidebar'=> 
														array(
															'type' => 'select', //builtin fields include:
															'id' => 'sidebar',
															'title' => __('Sidebar', SH_NAME),
															'options' => sh_get_sidebars(),
														),
														'top_image'=> 
														array(
															'type' => 'upload', //builtin fields include:
															'id' => 'top_image',
															'title' => __('Top Image', SH_NAME),
															'attributes' => array( 'placeholder'=>__('Upload Post Top Image', SH_NAME) ),
														),
														)
													),
						array('section_name' => 'SEO Settings',
							  'section_id' => 'seo_settings',
							  'position' => 'normal',
							  'fields' =>  array(
											'meta_title'=> 
												array(
													'type' => 'text', //builtin fields include:
													'id' => 'meta_title',
													'title' => __('Meta Title', SH_NAME),
													'help' => __("Enter Meta Title." , SH_NAME),
													),
											'meta_desc'=> 
												array(
													'type' => 'textarea', //builtin fields include:
													'id' => 'meta_desc',
													'title' => __('Meta Description', SH_NAME),
													'help' => __("Enter Meta Description." , SH_NAME),
													),
											'meta_keywords'=> 
												array(
													'type' => 'textarea', //builtin fields include:
													'id' => 'meta_keywords',
													'title' => __('Meta Key Words', SH_NAME),
													'help' => __("Enter Meta Key Words." , SH_NAME),
													),
											)
								),
);
$settings['dict_team'] = array(
						array('section_name' => 'Features Settings',
							  'section_id' => 'features_Settings',
							  'position' => 'normal',
									'fields' =>  array(
														'name' => array(
																  'type' => 'text', //builtin fields include:
																  'id' => 'name',
																  'title' => __('Name', SH_NAME),
																  'class' => 'regular-text text-input',
															  ),
														'designation' => array(
																	'type' => 'text', //builtin fields include:
																	'id' => 'designation',
																	'title' => __('Designation', SH_NAME),
																	'class' => 'regular-text text-input',
																),
														'experience' => array(
																	'type' => 'text', //builtin fields include:
																	'id' => 'experience',
																	'title' => __('Experience', SH_NAME),
																	'class' => 'regular-text text-input',
																),
														'gallery' => array(
																	'type' => 'gallery', //builtin fields include:
																	'id' => 'gallery',
																	'title' => __('Gallery', SH_NAME),
																	'class' => 'regular-text text-input',
																),
														)
													),
						array('section_name' => 'Contact Settngs',
							  'section_id' => 'contact_Settings',
							  'position' => 'normal',
									'fields' =>  array(
														'email' =>array(
																'type' => 'text', //builtin fields include:
																'id' => 'email',
																'title' => __('Email', SH_NAME),
																'class' => 'regular-text text-input',
															),
														'phone' => array(
																'type' => 'text', //builtin fields include:
																'id' => 'phone',
																'title' => __('Phone', SH_NAME),
																'class' => 'regular-text text-input',
															),
														'fb_link' => array(
																'type' => 'text', //builtin fields include:
																'id' => 'fb_link',
																'title' => __('Facebook Link', SH_NAME),
																'class' => 'regular-text text-input',
															),
														'gplus_link' => array(
																'type' => 'text', //builtin fields include:
																'id' => 'gplus_link',
																'title' => __('Google Plus Link', SH_NAME),
																'class' => 'regular-text text-input',
															),
														)
													),
						array('section_name' => 'Top Image',
							  'section_id' => 'top_img',
							  'position' => 'normal',
									'fields' =>  array(
														'top_image' =>
														array(
																'type' => 'upload', //builtin fields include:
																'id' => 'top_image',
																'title' => __('Top Image', SH_NAME),
																'attributes' => array( 'placeholder'=>__('Upload Team Top Image', SH_NAME) ),
															),
														)
													),
						array('section_name' => 'SEO Settings',
							  'section_id' => 'seo_settings',
							  'position' => 'normal',
							  'fields' =>  array(
											'meta_title'=> 
												array(
													'type' => 'text', //builtin fields include:
													'id' => 'meta_title',
													'title' => __('Meta Title', SH_NAME),
													'help' => __("Enter Meta Title." , SH_NAME),
													),
											'meta_desc'=> 
												array(
													'type' => 'textarea', //builtin fields include:
													'id' => 'meta_desc',
													'title' => __('Meta Description', SH_NAME),
													'help' => __("Enter Meta Description." , SH_NAME),
													),
											'meta_keywords'=> 
												array(
													'type' => 'textarea', //builtin fields include:
													'id' => 'meta_keywords',
													'title' => __('Meta Key Words', SH_NAME),
													'help' => __("Enter Meta Key Words." , SH_NAME),
													),
											)
								),
);
$settings['dict_services'] = array(
						array('section_name' => 'Servces Information',
							  'section_id' => 'services_info',
							  'position' => 'normal',
									'fields' =>  array(
														'font_awesome' =>  array(
																'type' => 'select', //builtin fields include:
																'id' => 'font_awesome',
																'title' => __('Service Icon', SH_NAME),
																'options' => sh_font_awesome(),
															),
														'benifits' =>  array(
																'type' => 'textarea', //builtin fields include:
																'id' => 'benifits',
																'title' => __('Benefits', SH_NAME),
																'help' => 'Enter Comma Seperated Benifits' ,
															),													
														)
													),
						array('section_name' => 'Display Options',
							  'section_id' => 'services_display',
							  'position' => 'normal',
									'fields' =>  array(
														'sidebar_pos' =>  array(
																		'type' => 'radio', //builtin fields include:
																		'id' => 'sidebar_pos',
																		'title' => __('Sidebar Postion', SH_NAME),
																		'options' => array( 'left' => 'Left' , 'right'=> 'Right' ),
																		'attributes' => array('style'=>'width:40%' ),
																	),
														'sidebar' =>  array(
																		'type' => 'select', //builtin fields include:
																		'id' => 'sidebar',
																		'title' => __('Sidebar', SH_NAME),
																		'options' => sh_get_sidebars(),
																	),
														 'top_image' =>
																array(
																'type' => 'upload', //builtin fields include:
																'id' => 'top_image',
																'title' => __('Top Image', SH_NAME),
																'attributes' => array( 'placeholder'=>__('Upload Services Top Image', SH_NAME) ),
															),
														)
													),
						array('section_name' => 'SEO Settings',
							  'section_id' => 'seo_settings',
							  'position' => 'normal',
							  'fields' =>  array(
											'meta_title'=> 
												array(
													'type' => 'text', //builtin fields include:
													'id' => 'meta_title',
													'title' => __('Meta Title', SH_NAME),
													'help' => __("Enter Meta Title." , SH_NAME),
													),
											'meta_desc'=> 
												array(
													'type' => 'textarea', //builtin fields include:
													'id' => 'meta_desc',
													'title' => __('Meta Description', SH_NAME),
													'help' => __("Enter Meta Description." , SH_NAME),
													),
											'meta_keywords'=> 
												array(
													'type' => 'textarea', //builtin fields include:
													'id' => 'meta_keywords',
													'title' => __('Meta Key Words', SH_NAME),
													'help' => __("Enter Meta Key Words." , SH_NAME),
													),
											)
								),

);