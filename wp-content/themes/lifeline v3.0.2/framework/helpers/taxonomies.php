<?php

class SH_Taxonomies

{

	function __construct()

	{
		// Hook into the 'init' action
		add_action( 'init', array($this, 'taxonomies'), 0 );
	}

	// Register Custom Taxonomy

	function taxonomies()  {

		/*$labels = array(
			'name'                       => _x( 'Categories', 'Categories', SH_NAME ),
			'singular_name'              => _x( 'Category', 'Category', SH_NAME ),
			'menu_name'                  => __( 'Categories', SH_NAME ),
			'all_items'                  => __( 'All Categories', SH_NAME ),
			'parent_item'                => __( 'Parent Category', SH_NAME ),
			'parent_item_colon'          => __( 'Parent Category:', SH_NAME ),
			'new_item_name'              => __( 'New Category Name', SH_NAME ),
			'add_new_item'               => __( 'Add New Category', SH_NAME ),
			'edit_item'                  => __( 'Edit Category', SH_NAME ),
			'update_item'                => __( 'Update Category', SH_NAME ),
			'separate_items_with_commas' => __( 'Separate Categories with commas', SH_NAME ),
			'search_items'               => __( 'Search Categories', SH_NAME ),
			'add_or_remove_items'        => __( 'Add or remove Categories', SH_NAME ),
			'choose_from_most_used'      => __( 'Choose from the most used Categories', SH_NAME ),
		);

		$rewrite = array(
			'slug'                       => 'lifeline_category',
			'with_front'                 => true,
			'hierarchical'               => true,
		);

		$args = array(
			'labels'                     => $labels,
			'hierarchical'               => true,
			'public'                     => true,
			'show_ui'                    => true,
			'show_admin_column'          => true,
			'show_in_nav_menus'          => true,
			'show_tagcloud'              => true,
			'rewrite'                    => $rewrite,
		);
		register_taxonomy( 'lifeline_category', array(), $args );*/
		
		$labels = array(
			'name'                       => _x( 'Categories', 'Categories', SH_NAME ),
			'singular_name'              => _x( 'Category', 'Category', SH_NAME ),
			'menu_name'                  => __( 'Categories', SH_NAME ),
			'all_items'                  => __( 'All Categories', SH_NAME ),
			'parent_item'                => __( 'Parent Category', SH_NAME ),
			'parent_item_colon'          => __( 'Parent Category:', SH_NAME ),
			'new_item_name'              => __( 'New Category Name', SH_NAME ),
			'add_new_item'               => __( 'Add New Category', SH_NAME ),
			'edit_item'                  => __( 'Edit Category', SH_NAME ),
			'update_item'                => __( 'Update Category', SH_NAME ),
			'separate_items_with_commas' => __( 'Separate Categories with commas', SH_NAME ),
			'search_items'               => __( 'Search Categories', SH_NAME ),
			'add_or_remove_items'        => __( 'Add or remove Categories', SH_NAME ),
			'choose_from_most_used'      => __( 'Choose from the most used Categories', SH_NAME ),
		);

		$rewrite = array(
			'slug'                       => 'testimonial_category',
			'with_front'                 => true,
			'hierarchical'               => true,
		);

		$args = array(
			'labels'                     => $labels,
			'hierarchical'               => true,
			'public'                     => true,
			'show_ui'                    => true,
			'show_admin_column'          => true,
			'show_in_nav_menus'          => true,
			'show_tagcloud'              => true,
			'rewrite'                    => $rewrite,
		);
		
		register_taxonomy( 'testimonial_category', array( 'dict_testimonials' ), $args );
		
		$labels = array(
			'name'                       => _x( 'Categories', 'Categories', SH_NAME ),
			'singular_name'              => _x( 'Category', 'Category', SH_NAME ),
			'menu_name'                  => __( 'Categories', SH_NAME ),
			'all_items'                  => __( 'All Categories', SH_NAME ),
			'parent_item'                => __( 'Parent Category', SH_NAME ),
			'parent_item_colon'          => __( 'Parent Category:', SH_NAME ),
			'new_item_name'              => __( 'New Category Name', SH_NAME ),
			'add_new_item'               => __( 'Add New Category', SH_NAME ),
			'edit_item'                  => __( 'Edit Category', SH_NAME ),
			'update_item'                => __( 'Update Category', SH_NAME ),
			'separate_items_with_commas' => __( 'Separate Categories with commas', SH_NAME ),
			'search_items'               => __( 'Search Categories', SH_NAME ),
			'add_or_remove_items'        => __( 'Add or remove Categories', SH_NAME ),
			'choose_from_most_used'      => __( 'Choose from the most used Categories', SH_NAME ),
		);

		$rewrite = array(
			'slug'                       => 'project_category',
			'with_front'                 => true,
			'hierarchical'               => true,
		);

		$args = array(
			'labels'                     => $labels,
			'hierarchical'               => true,
			'public'                     => true,
			'show_ui'                    => true,
			'show_admin_column'          => true,
			'show_in_nav_menus'          => true,
			'show_tagcloud'              => true,
			'rewrite'                    => $rewrite,
		);
		
		register_taxonomy( 'project_category', array( 'dict_project' ), $args );
		
		$labels = array(
			'name'                       => _x( 'Categories', 'Categories', SH_NAME ),
			'singular_name'              => _x( 'Category', 'Category', SH_NAME ),
			'menu_name'                  => __( 'Categories', SH_NAME ),
			'all_items'                  => __( 'All Categories', SH_NAME ),
			'parent_item'                => __( 'Parent Category', SH_NAME ),
			'parent_item_colon'          => __( 'Parent Category:', SH_NAME ),
			'new_item_name'              => __( 'New Category Name', SH_NAME ),
			'add_new_item'               => __( 'Add New Category', SH_NAME ),
			'edit_item'                  => __( 'Edit Category', SH_NAME ),
			'update_item'                => __( 'Update Category', SH_NAME ),
			'separate_items_with_commas' => __( 'Separate Categories with commas', SH_NAME ),
			'search_items'               => __( 'Search Categories', SH_NAME ),
			'add_or_remove_items'        => __( 'Add or remove Categories', SH_NAME ),
			'choose_from_most_used'      => __( 'Choose from the most used Categories', SH_NAME ),
		);

		$rewrite = array(
			'slug'                       => 'portfolio_category',
			'with_front'                 => true,
			'hierarchical'               => true,
		);

		$args = array(
			'labels'                     => $labels,
			'hierarchical'               => true,
			'public'                     => true,
			'show_ui'                    => true,
			'show_admin_column'          => true,
			'show_in_nav_menus'          => true,
			'show_tagcloud'              => true,
			'rewrite'                    => $rewrite,
		);
		
		register_taxonomy( 'portfolio_category', array( 'dict_portfolio' ), $args );
		
		$labels = array(
			'name'                       => _x( 'Categories', 'Categories', SH_NAME ),
			'singular_name'              => _x( 'Category', 'Category', SH_NAME ),
			'menu_name'                  => __( 'Categories', SH_NAME ),
			'all_items'                  => __( 'All Categories', SH_NAME ),
			'parent_item'                => __( 'Parent Category', SH_NAME ),
			'parent_item_colon'          => __( 'Parent Category:', SH_NAME ),
			'new_item_name'              => __( 'New Category Name', SH_NAME ),
			'add_new_item'               => __( 'Add New Category', SH_NAME ),
			'edit_item'                  => __( 'Edit Category', SH_NAME ),
			'update_item'                => __( 'Update Category', SH_NAME ),
			'separate_items_with_commas' => __( 'Separate Categories with commas', SH_NAME ),
			'search_items'               => __( 'Search Categories', SH_NAME ),
			'add_or_remove_items'        => __( 'Add or remove Categories', SH_NAME ),
			'choose_from_most_used'      => __( 'Choose from the most used Categories', SH_NAME ),
		);

		$rewrite = array(
			'slug'                       => 'team_category',
			'with_front'                 => true,
			'hierarchical'               => true,
		);

		$args = array(
			'labels'                     => $labels,
			'hierarchical'               => true,
			'public'                     => true,
			'show_ui'                    => true,
			'show_admin_column'          => true,
			'show_in_nav_menus'          => true,
			'show_tagcloud'              => true,
			'rewrite'                    => $rewrite,
		);
		
		register_taxonomy( 'team_category', array( 'dict_team' ), $args );
		
		$labels = array(
			'name'                       => _x( 'Categories', 'Categories', SH_NAME ),
			'singular_name'              => _x( 'Category', 'Category', SH_NAME ),
			'menu_name'                  => __( 'Categories', SH_NAME ),
			'all_items'                  => __( 'All Categories', SH_NAME ),
			'parent_item'                => __( 'Parent Category', SH_NAME ),
			'parent_item_colon'          => __( 'Parent Category:', SH_NAME ),
			'new_item_name'              => __( 'New Category Name', SH_NAME ),
			'add_new_item'               => __( 'Add New Category', SH_NAME ),
			'edit_item'                  => __( 'Edit Category', SH_NAME ),
			'update_item'                => __( 'Update Category', SH_NAME ),
			'separate_items_with_commas' => __( 'Separate Categories with commas', SH_NAME ),
			'search_items'               => __( 'Search Categories', SH_NAME ),
			'add_or_remove_items'        => __( 'Add or remove Categories', SH_NAME ),
			'choose_from_most_used'      => __( 'Choose from the most used Categories', SH_NAME ),
		);

		$rewrite = array(
			'slug'                       => 'gallery_category',
			'with_front'                 => true,
			'hierarchical'               => true,
		);

		$args = array(
			'labels'                     => $labels,
			'hierarchical'               => true,
			'public'                     => true,
			'show_ui'                    => true,
			'show_admin_column'          => true,
			'show_in_nav_menus'          => true,
			'show_tagcloud'              => true,
			'rewrite'                    => $rewrite,
		);
		
		register_taxonomy( 'gallery_category', array( 'dict_gallery' ), $args );
		
		$labels = array(
			'name'                       => _x( 'Categories', 'Categories', SH_NAME ),
			'singular_name'              => _x( 'Category', 'Category', SH_NAME ),
			'menu_name'                  => __( 'Categories', SH_NAME ),
			'all_items'                  => __( 'All Categories', SH_NAME ),
			'parent_item'                => __( 'Parent Category', SH_NAME ),
			'parent_item_colon'          => __( 'Parent Category:', SH_NAME ),
			'new_item_name'              => __( 'New Category Name', SH_NAME ),
			'add_new_item'               => __( 'Add New Category', SH_NAME ),
			'edit_item'                  => __( 'Edit Category', SH_NAME ),
			'update_item'                => __( 'Update Category', SH_NAME ),
			'separate_items_with_commas' => __( 'Separate Categories with commas', SH_NAME ),
			'search_items'               => __( 'Search Categories', SH_NAME ),
			'add_or_remove_items'        => __( 'Add or remove Categories', SH_NAME ),
			'choose_from_most_used'      => __( 'Choose from the most used Categories', SH_NAME ),
		);

		$rewrite = array(
			'slug'                       => 'event_category',
			'with_front'                 => true,
			'hierarchical'               => true,
		);

		$args = array(
			'labels'                     => $labels,
			'hierarchical'               => true,
			'public'                     => true,
			'show_ui'                    => true,
			'show_admin_column'          => true,
			'show_in_nav_menus'          => true,
			'show_tagcloud'              => true,
			'rewrite'                    => $rewrite,
		);
		
		register_taxonomy( 'event_category', array( 'dict_event' ), $args );
		
		$labels = array(
			'name'                       => _x( 'Categories', 'Categories', SH_NAME ),
			'singular_name'              => _x( 'Category', 'Category', SH_NAME ),
			'menu_name'                  => __( 'Categories', SH_NAME ),
			'all_items'                  => __( 'All Categories', SH_NAME ),
			'parent_item'                => __( 'Parent Category', SH_NAME ),
			'parent_item_colon'          => __( 'Parent Category:', SH_NAME ),
			'new_item_name'              => __( 'New Category Name', SH_NAME ),
			'add_new_item'               => __( 'Add New Category', SH_NAME ),
			'edit_item'                  => __( 'Edit Category', SH_NAME ),
			'update_item'                => __( 'Update Category', SH_NAME ),
			'separate_items_with_commas' => __( 'Separate Categories with commas', SH_NAME ),
			'search_items'               => __( 'Search Categories', SH_NAME ),
			'add_or_remove_items'        => __( 'Add or remove Categories', SH_NAME ),
			'choose_from_most_used'      => __( 'Choose from the most used Categories', SH_NAME ),
		);

		$rewrite = array(
			'slug'                       => 'causes_category',
			'with_front'                 => true,
			'hierarchical'               => true,
		);
		
		global $current_user;
		$user_roles = $current_user->roles;
		$user_role = array_shift($user_roles);

		if( $user_role && $user_role == 'causes_author' )
		{
			$args = array(
				'labels'                     => $labels,
				'hierarchical'               => true,
				'public'                     => true,
				'show_ui'                    => true,
				'show_admin_column'          => true,
				'show_in_nav_menus'          => true,
				'show_tagcloud'              => true,
				'rewrite'                    => $rewrite,
				'capabilities' 				 => array(
													'manage_terms' => 'manage_causes_category', //by default only admin
													'edit_terms' => 'manage_causes_category',
													'delete_terms' => 'manage_causes_category',
													'assign_terms' => 'edit_dict_causess'
												),
			);
		}else{
			$args = array(
				'labels'                     => $labels,
				'hierarchical'               => true,
				'public'                     => true,
				'show_ui'                    => true,
				'show_admin_column'          => true,
				'show_in_nav_menus'          => true,
				'show_tagcloud'              => true,
				'rewrite'                    => $rewrite,
				);
		}
		
		register_taxonomy( 'causes_category', array( 'dict_causes' ), $args );
		
	}
}