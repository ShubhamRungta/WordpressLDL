<?php

$options = array();

global $current_user;
$user_roles = $current_user->roles;
$user_role = array_shift($user_roles);

if( $user_role && $user_role == 'causes_author' )
{
	$options['dict_causes'] = array(
								  'labels' => array(__( 'Cause', SH_NAME), __( 'Cause', SH_NAME )),
								  'slug' => 'cause',
								  'label_args' => array( 'menu_name' => __( 'Cause', SH_NAME )),
								  'supports' => array( 'title', 'editor', 'thumbnail' ),
								  'label' => __( 'Cause', SH_NAME ),
								  'args'=>array('menu_icon'=>get_template_directory_uri().'/images/Causes.png','map_meta_cap' => true, 'capabilities' => array(
										'edit_post' => 'edit_dict_causes',
										'edit_posts' => 'edit_dict_causess',
										'edit_others_posts' => 'edit_other_dict_causess',
										'publish_posts' => 'publish_dict_causess',
										'edit_publish_posts' => 'edit_publish_dict_causess',
										'read_post' => 'read_lessons',
										'read_private_posts' => 'read_private_dict_causess',
										'delete_post' => 'delete_dict_causes',
									),
									'capability_type' => array('dict_causess', 'dict_causesss'),
									),
							   );
}else{
		$options['dict_causes'] = array(
								  'labels' => array(__( 'Cause', SH_NAME), __( 'Cause', SH_NAME )),
								  'slug' => 'cause',
								  'label_args' => array( 'menu_name' => __( 'Cause', SH_NAME )),
								  'supports' => array( 'title', 'editor', 'thumbnail' ),
								  'label' => __( 'Cause', SH_NAME ),
								  'args'=>array('menu_icon'=>get_template_directory_uri().'/images/Causes.png' ),
							   );
}
$options['dict_testimonials'] = array(
									'labels' => array(__('Testimonial', SH_NAME), __('Testimonial', SH_NAME)),
									'slug' => 'testimonail',
									'label_args' => array('menu_name' => __('Testimonial', SH_NAME)),
									'supports' => array( 'title', 'editor', 'thumbnail' ),
									'label' => __('Testimonial', SH_NAME),
									'args'=>array('menu_icon'=>get_template_directory_uri().'/images/COmments.png')
								 );
$options['dict_project'] = array(
							  'labels' => array(__( 'Project', SH_NAME), __( 'Projects', SH_NAME )),
							  'slug' => 'project',
							  'label_args' => array( 'menu_name' => __( 'Projects', SH_NAME )),
							  'supports' => array( 'title', 'editor', 'thumbnail' ),
							  'label' => __( 'Projects', SH_NAME ),
							  'args'=>array('menu_icon'=>get_template_directory_uri().'/images/Projects.png')
						   );
$options['dict_event'] = array(
								'labels' => array(__('Event', SH_NAME), __('Events', SH_NAME)),
								'slug' => 'event',
								'label_args' => array('menu_name' => __('Events', SH_NAME)),
								'supports' => array( 'title', 'editor', 'thumbnail'),
								'label' => __('Events', SH_NAME),
								'args'=>array('menu_icon'=>get_template_directory_uri().'/images/Events.png')
							);
$options['dict_portfolio'] = array(
								'labels' => array(__( 'Portfolio', SH_NAME), __( 'Portfolios', SH_NAME )),
								'slug' => 'portfolio',
								'label_args' => array( 'menu_name' => __( 'Portfolios', SH_NAME )),
								'supports' => array( 'title', 'editor', 'thumbnail' ),
								'label' => __( 'Portfolios', SH_NAME ),
								'args'=>array('menu_icon'=>get_template_directory_uri().'/images/POrtfolio.png')
							 );
$options['dict_gallery'] = array(
								'labels' => array(__( 'Galleries', SH_NAME), __( 'Galleries', SH_NAME )),
								'slug' => 'galleries',
								'label_args' => array( 'menu_name' => __( 'Galleries', SH_NAME )),
								'supports' => array( 'title', 'thumbnail' ),
								'label' => __( 'Galleries', SH_NAME ),
								'args'=>array('menu_icon'=>get_template_directory_uri().'/images/Galleries.png')
							 );
$options['dict_team'] = array(
								'labels' => array(__('Team', SH_NAME), __('Teams', SH_NAME)),
								'slug' => 'team',
								'label_args' => array('menu_name' => __('Teams', SH_NAME)),
								'supports' => array( 'title', 'editor' , 'thumbnail'),
								'label' => __('Teams', SH_NAME),
								'args'=>array('menu_icon'=>get_template_directory_uri().'/images/team.png')
							);
$options['dict_services'] = array(
								'labels' => array(__('Service', SH_NAME), __('Service', SH_NAME)),
								'slug' => 'dict_services',
								'label_args' => array('menu_name' => __('Services', SH_NAME)),
								'supports' => array( 'title', 'editor', 'thumbnail' ),
								'label' => __('Service', SH_NAME),
								'args'=>array('menu_icon'=>get_template_directory_uri().'/images/Services.png')
							);
							