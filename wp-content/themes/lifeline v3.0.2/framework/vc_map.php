<?php
vc_map(array(
        "name" => __("Our Casuses With Donation", SH_NAME),
        "base" => "sh_our_causes",
        "class" => "",
        "icon" => 'our-casuses-with-donation',
        "category" => __('Lifeline', SH_NAME),
        "params" => array(
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => __("Number", SH_NAME),
                "param_name" => "number",
                "value" => '',
                "description" => __("Enter number of posts", SH_NAME)
            ),
            array(
                "type" => "dropdown",
                "holder" => "div",
                "class" => "",
                "heading" => __("Sort By", SH_NAME),
                "param_name" => "sort_by",
                "value" => array_flip(array('date' => __('Date', SH_NAME), 'title' => __('Title', SH_NAME), 'name' => __('Name', SH_NAME), 'author' => __('Author', SH_NAME), 'comment_count' => __('Comment Count', SH_NAME), 'random' => __('Random', SH_NAME))),
                "description" => __("Choose Sorting by.", SH_NAME)
            ),
            array(
                "type" => "dropdown",
                "holder" => "div",
                "class" => "",
                "heading" => __("Sorting Order", SH_NAME),
                "param_name" => "sorting_order",
                "value" => array(__('Ascending Order', SH_NAME) => 'ASC', __('Descending Order', SH_NAME) => 'DESC'),
                "description" => __("Choose Sorting Order.", SH_NAME)
            ),
            array(
                "type" => "dropdown",
                "holder" => "div",
                "class" => "",
                "heading" => __("Category", SH_NAME),
                "param_name" => "cat",
                "value" => array_flip(sh_get_categories(array('taxonomy' => 'causes_category'), false)),
                "description" => __("Choose Sorting Order.", SH_NAME)
            ),
            array(
                "type" => "dropdown",
                "holder" => "div",
                "class" => "",
                "heading" => __("Donation Section", SH_NAME),
                "param_name" => "donate_sec",
                "value" => array_flip(array('true' => 'True', 'fasle' => 'False')),
                "description" => __("Choose either you want to Display Donation Section in this Area or Not.", SH_NAME)
            ),
            
        )
    )
);
vc_map(array(
        "name" => __("Causes Paralex Slider", SH_NAME),
        "base" => "sh_our_causes_2",
        "class" => "",
        "icon" => 'our-casuses',
        "category" => __('Lifeline', SH_NAME),
        "params" => array(
            
            
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => __("Number", SH_NAME),
                "param_name" => "number",
                "value" => '',
                "description" => __("Enter number of posts", SH_NAME)
            ),
            array(
                "type" => "attach_image",
                "holder" => "div",
                "class" => "",
                "heading" => __("Background Image", SH_NAME),
                "param_name" => "bg",
                "value" => '',
                "description" => __("Upload Image.", SH_NAME)
            ),
            array(
                "type" => "checkbox",
                "holder" => "div",
                "class" => "",
                "heading" => __("Background Layer", SH_NAME),
                "param_name" => "blackish",
                "value" => array_flip(array('blackish' => 'Blackish')),
                "description" => __("Choose either you want to Display a Blackish layer on this section's Bakground or not.", SH_NAME)
            ),
            array(
                "type" => "dropdown",
                "holder" => "div",
                "class" => "",
                "heading" => __("Background Layer", SH_NAME),
                "param_name" => "bg_layer",
                "value" => array_flip(array('true' => __('True', SH_NAME), 'false' => __('False', SH_NAME))),
                "description" => __("Enable Background Layer.", SH_NAME)
            ),
            array(
                "type" => "dropdown",
                "holder" => "div",
                "class" => "",
                "heading" => __("Category", SH_NAME),
                "param_name" => "cat",
                "value" => array_flip(sh_get_categories(array('taxonomy' => 'causes_category'), true)),
                "description" => __("Choose Sorting Order.", SH_NAME)
            ),
            array(
                "type" => "dropdown",
                "holder" => "div",
                "class" => "",
                "heading" => __("Sort By", SH_NAME),
                "param_name" => "sort_by",
                "value" => array_flip(array('date' => __('Date', SH_NAME), 'title' => __('Title', SH_NAME), 'name' => __('Name', SH_NAME), 'author' => __('Author', SH_NAME), 'comment_count' => __('Comment Count', SH_NAME), 'random' => __('Random', SH_NAME))),
                "description" => __("Choose Sorting by.", SH_NAME)
            ),
            array(
                "type" => "dropdown",
                "holder" => "div",
                "class" => "",
                "heading" => __("Sorting Order", SH_NAME),
                "param_name" => "sorting_order",
                "value" => array(__('Ascending Order', SH_NAME) => 'ASC', __('Descending Order', SH_NAME) => 'DESC'),
                "description" => __("Choose Sorting Order.", SH_NAME)
            ),
        )
    )
);
vc_map(array(
        "name" => __("Causes Tabber Slider", SH_NAME),
        "base" => "sh_our_causes_3",
        "icon" => 'our-casuses',
        "class" => "",
        "category" => __('Lifeline', SH_NAME),
        "params" => array(
            
            
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => __("Number", SH_NAME),
                "param_name" => "number",
                "value" => '',
                "description" => __("Enter number of posts", SH_NAME)
            ),
            array(
                "type" => "dropdown",
                "holder" => "div",
                "class" => "",
                "heading" => __("Category", SH_NAME),
                "param_name" => "cat",
                "value" => array_flip(sh_get_categories(array('taxonomy' => 'causes_category'), true)),
                "description" => __("Choose Sorting Order.", SH_NAME)
            ),
            array(
                "type" => "dropdown",
                "holder" => "div",
                "class" => "",
                "heading" => __("Sort By", SH_NAME),
                "param_name" => "sort_by",
                "value" => array_flip(array('date' => __('Date', SH_NAME), 'title' => __('Title', SH_NAME), 'name' => __('Name', SH_NAME), 'author' => __('Author', SH_NAME), 'comment_count' => __('Comment Count', SH_NAME), 'random' => __('Random', SH_NAME))),
                "description" => __("Choose Sorting by.", SH_NAME)
            ),
            array(
                "type" => "dropdown",
                "holder" => "div",
                "class" => "",
                "heading" => __("Sorting Order", SH_NAME),
                "param_name" => "sorting_order",
                "value" => array(__('Ascending Order', SH_NAME) => 'ASC', __('Descending Order', SH_NAME) => 'DESC'),
                "description" => __("Choose Sorting Order.", SH_NAME)
            ),
            
        )
    )
);
vc_map(array(
        "name" => __("Causes Portfolio", SH_NAME),
        "base" => "sh_our_causes_4",
        "icon" => 'our-casuses',
        "class" => "",
        "category" => __('Lifeline', SH_NAME),
        "params" => array(
            
            
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => __("Number", SH_NAME),
                "param_name" => "number",
                "value" => '',
                "description" => __("Enter number of posts", SH_NAME)
            ),
            array(
                "type" => "dropdown",
                "holder" => "div",
                "class" => "",
                "heading" => __("Category", SH_NAME),
                "param_name" => "cat",
                "value" => array_flip(sh_get_categories(array('taxonomy' => 'causes_category'), true)),
                "description" => __("Choose Sorting Order.", SH_NAME)
            ),
            array(
                "type" => "dropdown",
                "holder" => "div",
                "class" => "",
                "heading" => __("Sort By", SH_NAME),
                "param_name" => "sort_by",
                "value" => array_flip(array('date' => __('Date', SH_NAME), 'title' => __('Title', SH_NAME), 'name' => __('Name', SH_NAME), 'author' => __('Author', SH_NAME), 'comment_count' => __('Comment Count', SH_NAME), 'random' => __('Random', SH_NAME))),
                "description" => __("Choose Sorting by.", SH_NAME)
            ),
            array(
                "type" => "dropdown",
                "holder" => "div",
                "class" => "",
                "heading" => __("Sorting Order", SH_NAME),
                "param_name" => "sorting_order",
                "value" => array(__('Ascending Order', SH_NAME) => 'ASC', __('Descending Order', SH_NAME) => 'DESC'),
                "description" => __("Choose Sorting Order.", SH_NAME)
            ),
            
        )
    )
);
vc_map( array(
			"name" => __("Donation", SH_NAME),
			"base" => "sh_donation",
			"icon" => 'sh_donation' ,
			
			"class" => "",
			"category" => __('Lifeline', SH_NAME),
			"params" => array(
			array(
	
					   "type" => "checkbox",
	
					   "holder" => "div",
	
					   "class" => "",
	
					   "heading" => __("Margins", SH_NAME),
	
					   "param_name" => "margins",
	
					   "value" => array_flip(array('top'=> 'Top Margine' , 'bottom' =>'Bottom Margine')),
	
					   "description" => __("Choose either you want to Display Donation Section in this Area or Not.", SH_NAME)
	
					),
				array(
				   "type" => "textfield",
				   "holder" => "div",
				   "class" => "",
				   "heading" => __("Title", SH_NAME),
				   "param_name" => "title",
				   "value" => '',
				   "description" => __("Enter Title for this Section.", SH_NAME)
				),
				
				array(
				   "type" => "dropdown",
				   "holder" => "div",
				   "class" => "",
				   "heading" => __("Heading Style", SH_NAME),
				   "param_name" => "heading_style",
				   "value" => array_flip(array('simple'=> 'Simple' , 'underline' =>'Underlined Heading' , 'modern' => 'Modern Heading')),
				   "description" => __("Choose the Heading style You want to choose.", SH_NAME)
				),
				
			)
	    )
);
vc_map( array(
			"name" => __("Donation Sidebox", SH_NAME),
			"base" => "sh_donation_2",
			"icon" => 'sh_donation' ,			
			"class" => "",
			"category" => __('Lifeline', SH_NAME),
			"params" => array(
					array(
					   "type" => "textfield",
					   "holder" => "div",
					   "class" => "",
					   "heading" => __(" ", SH_NAME),
					   "param_name" => "title",
					   "value" => '',
					   "description" => __(" ", SH_NAME)
				),			
			)
	    )
);
vc_map( array(
			"name" => __("Donation Wide Box", SH_NAME),
			"icon" => 'sh_donation' ,
			
			"base" => "sh_donation_3",
			"class" => "",
			"category" => __('Lifeline', SH_NAME),
			"params" => array(
				array(
				   "type" => "textfield",
				   "holder" => "div",
				   "class" => "",
				   "heading" => __(" ", SH_NAME),
				   "param_name" => "title",
				   "value" => '',
				   "description" => __(" ", SH_NAME)
				),
			)
	    )
);
vc_map(array(
        "name" => __("Start Regular Donation", SH_NAME),
        "base" => "sh_start_regular_donation",
        "icon" => 'regular-donation',
        "class" => "",
        "category" => __('Lifeline', SH_NAME),
        "params" => array(
            
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => __("Title", SH_NAME),
                "param_name" => "title",
                "value" => '',
                "description" => __("Enter main title.", SH_NAME)
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => __("Sub Title", SH_NAME),
                "param_name" => "sub_title",
                "value" => '',
                "description" => __("Enter sub title.", SH_NAME)
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => __("Currency", SH_NAME),
                "param_name" => "currency",
                "value" => '',
                "description" => __("Enter donation currency symbol.", SH_NAME)
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => __("Donation Needed", SH_NAME),
                "param_name" => "donation_needed",
                "value" => '',
                "description" => __("Enter needed donation amount.", SH_NAME)
            ),
            array(
                "type" => "attach_image",
                "holder" => "div",
                "class" => "",
                "heading" => __("Image", SH_NAME),
                "param_name" => "image",
                "value" => '',
                "description" => __("Upload Image.", SH_NAME)
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => __("Button Caption", SH_NAME),
                "param_name" => "link_caption",
                "value" => '',
                "description" => __("Enter Button Caption.", SH_NAME)
            ),
            array(
                "type" => "textarea",
                "holder" => "div",
                "class" => "",
                "heading" => __("Text", SH_NAME),
                "param_name" => "text",
                "value" => '',
                "description" => __("Upload Image.", SH_NAME)
            ),
            
        )
    )
);
vc_map(array(
        "name" => __("Testimonials", SH_NAME),
        "base" => "sh_ceo_message",
        "icon" => 'sh_testimonials',
        "class" => "",
        "category" => __('Lifeline', SH_NAME),
        "params" => array(
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => __("Number Of Messages", SH_NAME),
                "param_name" => "number",
                "value" => '',
                "description" => __("Number Of Messages", SH_NAME)
            ),
			array(
                "type" => "dropdown",
                "holder" => "div",
                "class" => "",
                "heading" => __("Overlap", SH_NAME),
                "param_name" => "overlap",
                "value" => array( __( 'True', SH_NAME ) => 'true', __( 'False', SH_NAME ) => 'false'),
                "description" => __("Make this section overlap.", SH_NAME)
            ),
            array(
                "type" => "dropdown",
                "holder" => "div",
                "class" => "",
                "heading" => __("Ctagory", SH_NAME),
                "param_name" => "category",
                "value" => array_flip(sh_get_categories(array('taxonomy' => 'testimonial_category', 'hide_empty' => false), true)),
                "description" => __("Choose Category.", SH_NAME)
            ),
            array(
                "type" => "dropdown",
                "holder" => "div",
                "class" => "",
                "heading" => __("Sort By", SH_NAME),
                "param_name" => "sort_by",
                "value" => array_flip(array('date' => __('Date', SH_NAME), 'title' => __('Title', SH_NAME), 'name' => __('Name', SH_NAME), 'author' => __('Author', SH_NAME), 'comment_count' => __('Comment Count', SH_NAME), 'rand' => __('Random', SH_NAME))),
                "description" => __("Choose Sorting by.", SH_NAME)
            ),
            array(
                "type" => "dropdown",
                "holder" => "div",
                "class" => "",
                "heading" => __("Sorting Order", SH_NAME),
                "param_name" => "sorting_order",
                "value" => array(__('No Sorting Order', SH_NAME) => '', __('Ascending Order', SH_NAME) => 'ASC', __('Descending Order', SH_NAME) => 'DESC'),
                "description" => __("Choose Sorting Order.", SH_NAME)
            ),
            
        )
    )
);
vc_map(array(
        "name" => __("Recent News", SH_NAME),
        "icon" => 'sh_recent_news',
        "base" => "sh_recent_news",
        "class" => "",
        "category" => __('Lifeline', SH_NAME),
        "params" => array(            
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => __("Number", SH_NAME),
                "param_name" => "number",
                "value" => '',
                "description" => __("Enter number of posts", SH_NAME)
            ),
            array(
                "type" => "dropdown",
                "holder" => "div",
                "class" => "",
                "heading" => __("Ctagory", SH_NAME),
                "param_name" => "category",
                "value" => array_flip( sh_get_categories(array('hide_empty' => FALSE )) ),
                "description" => __("Choose Category.", SH_NAME)
            ),
            array(
                "type" => "dropdown",
                "holder" => "div",
                "class" => "",
                "heading" => __("Sort By", SH_NAME),
                "param_name" => "sort_by",
                "value" => array_flip(array('date' => __('Date', SH_NAME), 'title' => __('Title', SH_NAME), 'name' => __('Name', SH_NAME), 'author' => __('Author', SH_NAME), 'comment_count' => __('Comment Count', SH_NAME), 'random' => __('Random', SH_NAME))),
                "description" => __("Choose Sorting by.", SH_NAME)
            ),
            array(
                "type" => "dropdown",
                "holder" => "div",
                "class" => "",
                "heading" => __("Sorting Order", SH_NAME),
                "param_name" => "sorting_order",
                "value" => array(__('Ascending Order', SH_NAME) => 'ASC', __('Descending Order', SH_NAME) => 'DESC'),
                "description" => __("Choose Sorting Order.", SH_NAME)
            ),
            
        )
    )
);
vc_map(array(
        "name" => __("Recent Events", SH_NAME),
        "base" => "sh_recent_events",
        "class" => "",
        "icon" => 'sh_recent-event',
        "category" => __('Lifeline', SH_NAME),
        "params" => array(
            
            
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => __("Number", SH_NAME),
                "param_name" => "number",
                "value" => '',
                "description" => __("Enter number of posts", SH_NAME)
            ),
            array(
                "type" => "dropdown",
                "holder" => "div",
                "class" => "",
                "heading" => __("Ctagory", SH_NAME),
                "param_name" => "category",
                "value" => array_flip(sh_get_categories(array('taxonomy' => 'event_category', 'hide_empty' => FALSE), true)),
                "description" => __("Choose Category.", SH_NAME)
            ),
            array(
                "type" => "dropdown",
                "holder" => "div",
                "class" => "",
                "heading" => __("Sort By", SH_NAME),
                "param_name" => "sort_by",
                "value" => array_flip(array('date' => 'Date', 'title' => 'Title', 'name' => 'Name', 'author' => 'Author', 'comment_count' => 'Comment Count', 'random' => 'Random')),
                "description" => __("Choose Sorting by.", SH_NAME)
            ),
            array(
                "type" => "dropdown",
                "holder" => "div",
                "class" => "",
                "heading" => __("Sorting Order", SH_NAME),
                "param_name" => "sorting_order",
                "value" => array('Ascending Order' => 'ASC', 'Descending Order' => 'DESC'),
                "description" => __("Choose Sorting Order.", SH_NAME)
            ),
            
        )
    )
);
vc_map(array(
        "name" => __("Upcoming Events Slider", SH_NAME),
        "base" => "sh_recent_events_2",
        "icon" => 'sh_recent-event',
        "class" => "",
        "category" => __('Lifeline', SH_NAME),
        "params" => array(
            
            
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => __("Number", SH_NAME),
                "param_name" => "number",
                "value" => '',
                "description" => __("Enter number of posts", SH_NAME)
            ),
            array(
                "type" => "dropdown",
                "holder" => "div",
                "class" => "",
                "heading" => __("Ctagory", SH_NAME),
                "param_name" => "category",
                "value" => array_flip(sh_get_categories(array('taxonomy' => 'event_category', 'hide_empty' => FALSE), true)),
                "description" => __("Choose Category.", SH_NAME)
            ),
            array(
                "type" => "dropdown",
                "holder" => "div",
                "class" => "",
                "heading" => __("Sort By", SH_NAME),
                "param_name" => "sort_by",
                "value" => array_flip(array('date' => __('Date', SH_NAME), 'title' => __('Title', SH_NAME), 'name' => __('Name', SH_NAME), 'author' => __('Author', SH_NAME), 'comment_count' => __('Comment Count', SH_NAME), 'random' => __('Random', SH_NAME))),
                "description" => __("Choose Sorting by.", SH_NAME)
            ),
            array(
                "type" => "dropdown",
                "holder" => "div",
                "class" => "",
                "heading" => __("Sorting Order", SH_NAME),
                "param_name" => "sorting_order",
                "value" => array(__('Ascending Order', SH_NAME) => 'ASC', __('Descending Order', SH_NAME) => 'DESC'),
                "description" => __("Choose Sorting Order.", SH_NAME)
            ),
            
        )
    )
);
vc_map(array(
        "name" => __("Upcomming Event", SH_NAME),
        "base" => "sh_recent_events_3",
        "class" => "",
        "icon" => 'upcoming-events',
        "category" => __('Lifeline', SH_NAME),
        "params" => array(
            
            
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => __("Number", SH_NAME),
                "param_name" => "number",
                "value" => '',
                "description" => __("Enter number of posts", SH_NAME)
            ),
            array(
                "type" => "dropdown",
                "holder" => "div",
                "class" => "",
                "heading" => __("Ctagory", SH_NAME),
                "param_name" => "category",
                "value" => array_flip(sh_get_categories(array('taxonomy' => 'event_category', 'hide_empty' => FALSE))),
                "description" => __("Choose Category.", SH_NAME)
            ),
            array(
                "type" => "dropdown",
                "holder" => "div",
                "class" => "",
                "heading" => __("Sort By", SH_NAME),
                "param_name" => "sort_by",
                "value" => array_flip(array('date' => __('Date', SH_NAME), 'title' => __('Title', SH_NAME), 'name' => __('Name', SH_NAME), 'author' => __('Author', SH_NAME), 'comment_count' => __('Comment Count', SH_NAME), 'random' => __('Random', SH_NAME))),
                "description" => __("Choose Sorting by.", SH_NAME)
            ),
            array(
                "type" => "dropdown",
                "holder" => "div",
                "class" => "",
                "heading" => __("Sorting Order", SH_NAME),
                "param_name" => "sorting_order",
                "value" => array(__('Ascending Order', SH_NAME) => 'ASC', __('Descending Order', SH_NAME) => 'DESC'),
                "description" => __("Choose Sorting Order.", SH_NAME)
            ),
            
        )
    )
);
vc_map(array(
        "name" => __("Successful Stories", SH_NAME),
        "base" => "sh_successful_stories",
        "icon" => 'successful-stories',
        "class" => "",
        "category" => __('Lifeline', SH_NAME),
        "params" => array(
            
            
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => __("Number", SH_NAME),
                "param_name" => "number",
                "value" => '',
                "description" => __("Enter number of posts", SH_NAME)
            ),
            array(
                "type" => "dropdown",
                "holder" => "div",
                "class" => "",
                "heading" => __("Ctagory", SH_NAME),
                "param_name" => "category",
                "value" => array_flip(sh_get_categories(array('taxonomy' => 'project_category', 'hide_empty' => FALSE))),
                "description" => __("Choose Category.", SH_NAME)
            ),
            array(
                "type" => "dropdown",
                "holder" => "div",
                "class" => "",
                "heading" => __("Sort By", SH_NAME),
                "param_name" => "sort_by",
                "value" => array_flip(array('date' => __('Date', SH_NAME), 'title' => __('Title', SH_NAME), 'name' => __('Name', SH_NAME), 'author' => __('Author', SH_NAME), 'comment_count' => __('Comment Count', SH_NAME), 'random' => __('Random', SH_NAME))),
                "description" => __("Choose Sorting by.", SH_NAME)
            ),
            array(
                "type" => "dropdown",
                "holder" => "div",
                "class" => "",
                "heading" => __("Sorting Order", SH_NAME),
                "param_name" => "sorting_order",
                "value" => array(__('Ascending Order', SH_NAME) => 'ASC', __('Descending Order', SH_NAME) => 'DESC'),
                "description" => __("Choose Sorting Order.", SH_NAME)
            ),
            
        )
    )
);
vc_map(array(
        "name" => __("Welfare Projects 2 Column", SH_NAME),
        "base" => "sh_welfare_projects",
        "class" => "",
        "icon" => 'welfare-project',
        "category" => __('Lifeline', SH_NAME),
        "params" => array(
            
            
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => __("Number", SH_NAME),
                "param_name" => "number",
                "value" => '',
                "description" => __("Enter number of posts", SH_NAME)
            ),
            array(
                "type" => "dropdown",
                "holder" => "div",
                "class" => "",
                "heading" => __("Ctagory", SH_NAME),
                "param_name" => "category",
                "value" => array_flip(sh_get_categories(array('taxonomy' => 'project_category', 'hide_empty' => FALSE))),
                "description" => __("Choose Category.", SH_NAME)
            ),
            array(
                "type" => "dropdown",
                "holder" => "div",
                "class" => "",
                "heading" => __("Sort By", SH_NAME),
                "param_name" => "sort_by",
                "value" => array_flip(array('date' => __('Date', SH_NAME), 'title' => __('Title', SH_NAME), 'name' => __('Name', SH_NAME), 'author' => __('Author', SH_NAME), 'comment_count' => __('Comment Count', SH_NAME), 'random' => __('Random', SH_NAME))),
                "description" => __("Choose Sorting by.", SH_NAME)
            ),
            array(
                "type" => "dropdown",
                "holder" => "div",
                "class" => "",
                "heading" => __("Sorting Order", SH_NAME),
                "param_name" => "sorting_order",
                "value" => array(__('Ascending Order', SH_NAME) => 'ASC', __('Descending Order', SH_NAME) => 'DESC'),
                "description" => __("Choose Sorting Order.", SH_NAME)
            ),
            
        )
    )
);
vc_map(array(
        "name" => __("Welfare Projects 3 Columns", SH_NAME),
        "base" => "sh_welfare_projects_2",
        "class" => "",
        "icon" => 'welfare-project',
        "category" => __('Lifeline', SH_NAME),
        "params" => array(
            
            
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => __("Number", SH_NAME),
                "param_name" => "number",
                "value" => '',
                "description" => __("Enter number of posts", SH_NAME)
            ),
            array(
                "type" => "dropdown",
                "holder" => "div",
                "class" => "",
                "heading" => __("Ctagory", SH_NAME),
                "param_name" => "category",
                "value" => array_flip(sh_get_categories(array('taxonomy' => 'project_category', 'hide_empty' => FALSE))),
                "description" => __("Choose Category.", SH_NAME)
            ),
            array(
                "type" => "dropdown",
                "holder" => "div",
                "class" => "",
                "heading" => __("Sort By", SH_NAME),
                "param_name" => "sort_by",
                "value" => array_flip(array('date' => __('Date', SH_NAME), 'title' => __('Title', SH_NAME), 'name' => __('Name', SH_NAME), 'author' => __('Author', SH_NAME), 'comment_count' => __('Comment Count', SH_NAME), 'random' => __('Random', SH_NAME))),
                "description" => __("Choose Sorting by.", SH_NAME)
            ),
            array(
                "type" => "dropdown",
                "holder" => "div",
                "class" => "",
                "heading" => __("Sorting Order", SH_NAME),
                "param_name" => "sorting_order",
                "value" => array(__('Ascending Order', SH_NAME) => 'ASC', __('Descending Order', SH_NAME) => 'DESC'),
                "description" => __("Choose Sorting Order.", SH_NAME)
            ),
            
        )
    )
);
vc_map(array(
        "name" => __("Leave A Message", SH_NAME),
        "base" => "sh_leave_message",
        "class" => "",
        "icon" => 'leave-a-message',
        "category" => __('Lifeline', SH_NAME),
        
        "params" => array(
            
            array(
                "type" => "textarea",
                "holder" => "div",
                "class" => "",
                "heading" => __("Text", SH_NAME),
                "param_name" => "text",
                "value" => '',
                "description" => __("Enter text.", SH_NAME)
            ),
            
        )
    )
);
vc_map(array(
        "name" => __("Block Quotes", SH_NAME),
        "base" => "sh_block_quotes",
        "class" => "",
        "icon" => 'sh_block-quotes',
        "category" => __('Lifeline', SH_NAME),
        "params" => array(
            
            
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => __("Block Quotes", SH_NAME),
                "param_name" => "blockquotes",
                "value" => '',
                "description" => __("Enter Block Quotes.", SH_NAME)
            ),
            
        )
    )
);
vc_map(array(
        "name" => __("Boxed Block Quotes", SH_NAME),
        "base" => "sh_boxed_block_quotes",
        "class" => "",
        "icon" => 'sh_block-quotes',
        "category" => __('Lifeline', SH_NAME),
        "params" => array(
             
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => __("Text Before Block Quotes", SH_NAME),
                "param_name" => "text1",
                "value" => '',
                "description" => __("Enter Text Before Block Quotes", SH_NAME)
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => __("Text After Block Quotes", SH_NAME),
                "param_name" => "text2",
                "value" => '',
                "description" => __("Enter Text After Block Quotes", SH_NAME)
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => __("Block Quotes", SH_NAME),
                "param_name" => "blockquotes",
                "value" => '',
                "description" => __("Enter Block Quotes.", SH_NAME)
            ),
            
        )
    )
);
vc_map(array(
        "name" => __("Button", SH_NAME),
        "base" => "sh_button",
        "class" => "",
        "icon" => 'sh_vc_button',
        "category" => __('Lifeline', SH_NAME),
        "params" => array(
            
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => __("Text", SH_NAME),
                "param_name" => "text",
                "value" => '',
                "description" => __("Enter button text", SH_NAME)
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => __("Button Link", SH_NAME),
                "param_name" => "Link",
                "value" => '',
                "description" => __("Enter Button Link", SH_NAME)
            ),
            array(
                "type" => "dropdown",
                "holder" => "div",
                "class" => "",
                "heading" => __("Size", SH_NAME),
                "param_name" => "size",
                "value" => array('small' => 'Small', 'medium' => 'Medium', 'large' => 'Large'),
                "description" => __("Choose button size.", SH_NAME)
            ),
            array(
                "type" => "dropdown",
                "holder" => "div",
                "class" => "",
                "heading" => __("Color", SH_NAME),
                "param_name" => "color",
                "value" => array('skyblue' => 'Sky Blue', 'green' => 'Green', 'dodgerblue' => 'Dodger Blue', 'blue' => 'Blue', 'limegreen' => 'Lime Green', 'silver' => 'Silver'),
                "description" => __("Choose button color.", SH_NAME)
            ),
            
        )
    )
);
vc_map(array(
        "name" => __("List Item", SH_NAME),
        "base" => "sh_list_item",
        "class" => "",
        "icon" => 'faqs',
        "category" => __('Lifeline', SH_NAME),
        "params" => array(
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => __("Text", SH_NAME),
                "param_name" => "text",
                "value" => '',
                "description" => __("Enter list contents", SH_NAME)
            ),
            array(
                "type" => "dropdown",
                "holder" => "div",
                "class" => "",
                "heading" => __("List Style", SH_NAME),
                "param_name" => "style",
                "value" => array('icon-check' => 'Check',
                    'icon-plus' => 'Plus',
                    'icon-minus' => 'Minus',
                    'icon-star' => 'Star',
                    'icon-angle-right' => 'Angle Right',
                    'icon-caret-right' => 'Caret Right',
                    'icon-sign-blank' => 'Square',
                    'icon-circle' => 'Circle',
                    'icon-remove' => 'Cross',
                    'icon-random' => 'Random',
                    'icon-thumbs-up-alt' => 'Thumbs Up',
                    'icon-thumbs-down-alt' => 'Thumbs Down',
                    'icon-undo' => 'Undo',
                    'icon-sort' => 'Sort',
                    'icon-angle-right' => 'Double Angle Right',
                    'icon-angle-left' => 'Double Angle Left',
                    'icon-quote-left' => 'Quotes',
                    'icon-spinner' => 'Spinner',
                ),
                "description" => __("Choose list style.", SH_NAME)
            ),
            
        )
    )
);
vc_map(array(
        "name" => __("List Item Style 2", SH_NAME),
        "base" => "sh_list_item",
        "class" => "",
        "icon" => 'sh_list-item',
        "category" => __('Lifeline', SH_NAME),
        "params" => array(
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => __("Title", SH_NAME),
                "param_name" => "title",
                "value" => '',
                "description" => __("Enter title", SH_NAME)
            ),
            array(
                "type" => "textarea",
                "holder" => "div",
                "class" => "",
                "heading" => __("Message", SH_NAME),
                "param_name" => "message",
                "value" => '',
                "description" => __("Enter message.", SH_NAME)
            ),
            array(
                "type" => "dropdown",
                "holder" => "div",
                "class" => "",
                "heading" => __("Type", SH_NAME),
                "param_name" => "type",
                "value" => array_flip(array('warning' => 'Warning', 'cancel' => 'Cancel', 'attention' => 'Attention', 'done' => 'Done')),
                "description" => __("Choose Alert Mesage Type.", SH_NAME)
            ),
            
        )
    )
);
vc_map(array(
        "name" => __("Social Media Icon", SH_NAME),
        "base" => "sh_social_media_icon",
        "class" => "",
        "icon" => 'sh_social-media',
        "category" => __('Lifeline', SH_NAME),
        "params" => array(
            array(
                "type" => "dropdown",
                "holder" => "div",
                "class" => "",
                "heading" => __("Social Media", SH_NAME),
                "param_name" => "media",
                "value" => array_flip(array('social_facebook' => 'facebook',
                    'social_flickr' => 'flickr',
                    'social_forst' => 'forst',
                    'social_google-plus' => 'google-plus',
                    'social_blogger' => 'blogger',
                    'social_lastfm' => 'lastfm',
                    'social_linkedin' => 'linkedin',
                    'social_wordpress' => 'wordpress',
                    'social_twitter' => 'twitter',
                    'social_tumbler' => 'tumbler',
                    'social_digg' => 'digg',
                    'social_dribble' => 'dribble',
                    'social_behance' => 'behance',
                    'social_addthis' => 'addthis',
                    'social_sharethis' => 'sharethis',
                    'social_rss' => 'rss',
                    'social_skype' => 'skype',
                    'social_deliciou' => 'deliciou',
                    'social_stumble' => 'stumble',
                    'social_vimeo' => 'vimeo',
                    'social_virb' => 'virb',
                    'social_mail' => 'mail',
                    'social_grooveshark' => 'grooveshark',
                    'social_infinte' => 'infinte',
                    'social_instagram' => 'instagram',
                    'social_evernote' => 'evernote',
                    'social_path' => 'path',
                    'social_myspace' => 'myspace',
                    'social-gray_play' => 'Gray Play',
                    'social-gray_google-plus' => 'Gray Google Plus',
                    'social-gray_facebook' => 'Gray Facebook',
                    'social-gray_tumbler' => 'Gray Tumbler',
                    'social-gray_twitter' => 'Gray Twitter',
                    'social-gray_sharethis' => 'Gray Sharethis',
                    'social-gray_msn' => 'Gary MSN',
                    'social-gray_flickr' => 'Gray Flicker',
                    'social-gray_linkedin' => 'Gray Linkedin',
                    'social-gray_vimeo' => 'Gary Vimeo',
                    'social-gray_gtalk' => 'Gray Gtalk',
                    'social-gray_skype' => 'Gray Skype',
                    'social-gray_found' => 'Gray Found',
                    'social-gray_rss' => 'Gray RSS',
                    'social-gray_buzz' => 'Gray Buzz',
                    'social-gray_yahoomessanger' => 'Gray Yahoo Messanger',
                    'social-gray_yahoo' => 'Gray Yahoo',
                    'social-gray_digg' => 'Gray Digg',
                    'social-gray_deleciou' => 'Gray Dilicious',
                    'social-gray_upcoming' => 'Gray Upcoming',
                    'social-gray_aim' => 'Gray Aim',
                    'social-gray_myspace' => 'Gray MySpace',
                    'social-gray_wikipedia' => 'Gray Wikipedia',
                    'social-gray_vcard' => 'Gray Vcard',
                    'social-gray_picasa' => 'Gray Picasa',
                    'social-gray_dribble' => 'Gray Dribble',
                    'social-gray_netvibes' => 'Gray Netvibes',
                    'social-gray_deviantart' => 'Gray Deviantart',
                    'social-gray_fireeagle' => 'Gray Fireeagle',
                    'social-gray_itunes' => 'Gray iTunes',
                    'social-gray_lastfm' => 'Gray Lastfm',
                    'social-gray_amazon' => 'Gray Amazon',
                    'social-gray_reddit' => 'Gray Reddit',
                    'social-gray_stumble' => 'Gray Stumble',
                    'social-gray_digg2' => 'Gray Digg 2',
                    'social-gray_orkut' => 'Gray Orkut')),
                "description" => __("Choose Alert Mesage Type.", SH_NAME)
            ),
            
        )
    )
);
vc_map(array(
        "name" => __("Progressbar", SH_NAME),
        "base" => "sh_progressbar",
        "class" => "",
        "icon" => 'sh_vc_progressbar',
        "category" => __('Lifeline', SH_NAME),
        "params" => array(
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => __("Title", SH_NAME),
                "param_name" => "title",
                "value" => '',
                "description" => __("Enter title", SH_NAME)
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => __("Percentage Value", SH_NAME),
                "param_name" => "percentage",
                "value" => '',
                "description" => __("Enter percentage value e.g. 10, 40, 75", SH_NAME)
            ),
            array(
                "type" => "dropdown",
                "holder" => "div",
                "class" => "",
                "heading" => __("Position", SH_NAME),
                "param_name" => "position",
                "value" => array_flip(array('top' => 'Top', 'within-progress-bar' => 'Within Progressbar')),
                "description" => __("Choose Percentage Value Position.", SH_NAME)
            ),
            
        )
    )
);
vc_map(array(
        "name" => __("Price Table", SH_NAME),
        "base" => "sh_price_table",
        "class" => "",
        "icon" => 'sh_price-table',
        "category" => __('Lifeline', SH_NAME),
        "params" => array(
            
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => __("Title", SH_NAME),
                "param_name" => "title",
                "value" => '',
                "description" => __("Enter title", SH_NAME)
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => __("Sub Title", SH_NAME),
                "param_name" => "sub_title",
                "value" => '',
                "description" => __("Enter Sub Title", SH_NAME)
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => __("Price", SH_NAME),
                "param_name" => "price",
                "value" => '',
                "description" => __("Enter Price", SH_NAME)
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => __("Currency Symbol", SH_NAME),
                "param_name" => "currency",
                "value" => '',
                "description" => __("Enter Currency Symbol", SH_NAME)
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => __("Option One Contents", SH_NAME),
                "param_name" => "option1",
                "value" => '',
                "description" => __("Enter Option One Contents", SH_NAME)
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => __("Option Two Contents", SH_NAME),
                "param_name" => "option3",
                "value" => '',
                "description" => __("Enter Option Two Contents", SH_NAME)
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => __("Option Three Contents", SH_NAME),
                "param_name" => "option3",
                "value" => '',
                "description" => __("Enter Option Three Contents", SH_NAME)
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => __("Redirect Link", SH_NAME),
                "param_name" => "link",
                "value" => '',
                "description" => __("Enter redirect link", SH_NAME)
            ),
            
        )
    )
);
vc_map(array(
        "name" => __("Charity Video", SH_NAME),
        "base" => "sh_charity_video",
        "class" => "",
        "icon" => 'sh_charity-video',
        "category" => __('Lifeline', SH_NAME),
        "params" => array(
            
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => __("Title", SH_NAME),
                "param_name" => "title",
                "value" => '',
                "description" => __("Enter main title of the section", SH_NAME)
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => __("Video Title", SH_NAME),
                "param_name" => "video_title",
                "value" => '',
                "description" => __("Enter title for video", SH_NAME)
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => __("Video ID", SH_NAME),
                "param_name" => "video_link",
                "value" => '',
                "description" => __("Enter the ID of the vimeo video like 102825514", SH_NAME)
            ),
            array(
                "type" => "textarea",
                "holder" => "div",
                "class" => "",
                "heading" => __("Video Description", SH_NAME),
                "param_name" => "description",
                "value" => '',
                "description" => __("Enter description.", SH_NAME)
            ),
            
        )
    )
);
vc_map(array(
        "name" => __("Charity Video 2", SH_NAME),
        "base" => "sh_charity_video2",
        "class" => "",
        "icon" => 'sh_charity-video',
        "category" => __('Lifeline', SH_NAME),
        "params" => array(
            
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => __("Title", SH_NAME),
                "param_name" => "title",
                "value" => '',
                "description" => __("Enter main title of the section", SH_NAME)
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => __("Video Link", SH_NAME),
                "param_name" => "video_link",
                "value" => '',
                "description" => __("Enter link for video", SH_NAME)
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => __("Duration", SH_NAME),
                "param_name" => "duration",
                "value" => '',
                "description" => __("Enter Duration", SH_NAME)
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => __("Projects", SH_NAME),
                "param_name" => "projects",
                "value" => '',
                "description" => __("Enter Projects", SH_NAME)
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => __("Members", SH_NAME),
                "param_name" => "members",
                "value" => '',
                "description" => __("Enter Members", SH_NAME)
            ),
            array(
                "type" => "textarea",
                "holder" => "div",
                "class" => "",
                "heading" => __("Video Description", SH_NAME),
                "param_name" => "description",
                "value" => '',
                "description" => __("Enter description.", SH_NAME)
            ),
            
        )
    )
);
vc_map(array(
        "name" => __("Team", SH_NAME),
        "base" => "sh_team",
        "class" => "",
        "icon" => 'sh_vc_team',
        "category" => __('Lifeline', SH_NAME),
        "params" => array(
            
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => __("Number Of Team Members", SH_NAME),
                "param_name" => "number",
                "value" => '',
                "description" => __("Number Of Team Members", SH_NAME)
            ),
            array(
                "type" => "dropdown",
                "holder" => "div",
                "class" => "",
                "heading" => __("Ctagory", SH_NAME),
                "param_name" => "category",
                "value" => array_flip(sh_get_categories(array('taxonomy' => 'team_category', 'hide_empty' => FALSE))),
                "description" => __("Choose Category.", SH_NAME)
            ),
            array(
                "type" => "dropdown",
                "holder" => "div",
                "class" => "",
                "heading" => __("Sort By", SH_NAME),
                "param_name" => "sort_by",
                "value" => array_flip(array('date' => __('Date', SH_NAME), 'title' => __('Title', SH_NAME), 'name' => __('Name', SH_NAME), 'author' => __('Author', SH_NAME), 'comment_count' => __('Comment Count', SH_NAME), 'random' => __('Random', SH_NAME))),
                "description" => __("Choose Sorting by.", SH_NAME)
            ),
            array(
                "type" => "dropdown",
                "holder" => "div",
                "class" => "",
                "heading" => __("Sorting Order", SH_NAME),
                "param_name" => "sorting_order",
                "value" => array(__('Ascending Order', SH_NAME) => 'ASC', __('Descending Order', SH_NAME) => 'DESC'),
                "description" => __("Choose Sorting Order.", SH_NAME)
            ),
            
        )
    )
);
vc_map(array(
        "name" => __("Shop Online", SH_NAME),
        "base" => "sh_shop_online",
        "class" => "",
        "icon" => 'sh_shop-online',
        "category" => __('Lifeline', SH_NAME),
        "params" => array(
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => __("Number", SH_NAME),
                "param_name" => "number",
                "value" => '',
                "description" => __("Enter number of Products", SH_NAME)
            ),
            array(
                "type" => "dropdown",
                "holder" => "div",
                "class" => "",
                "heading" => __("Sort By", SH_NAME),
                "param_name" => "sort_by",
                "value" => array_flip(array('date' => __('Date', SH_NAME), 'title' => __('Title', SH_NAME), 'name' => __('Name', SH_NAME), 'author' => __('Author', SH_NAME), 'comment_count' => __('Comment Count', SH_NAME), 'random' => __('Random', SH_NAME))),
                "description" => __("Choose Sorting by.", SH_NAME)
            ),
            array(
                "type" => "dropdown",
                "holder" => "div",
                "class" => "",
                "heading" => __("Sorting Order", SH_NAME),
                "param_name" => "sorting_order",
                "value" => array(__('Ascending Order', SH_NAME) => 'ASC', __('Descending Order', SH_NAME) => 'DESC'),
                "description" => __("Choose Sorting Order.", SH_NAME)
            ),
            
        )
    )
);
/*vc_map(array(
        "name" => __("Our Blog Slider", SH_NAME),
        "base" => "sh_our_blog",
        "class" => "",
        "icon" => 'sh_vc_blog',
        "category" => __('Lifeline', SH_NAME),
        "params" => array(
            
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => __("", SH_NAME),
                "param_name" => "title",
                "value" => '',
                "description" => __("", SH_NAME)
            ),
            
        )
    )
);*/
vc_map(array(
        "name" => __("Services", SH_NAME),
        "base" => "sh_services",
        "class" => "",
        "icon" => 'sh_vc_services',
        "category" => __('Lifeline', SH_NAME),
        "params" => array(
            
            array(
                "type" => "dropdown",
                "holder" => "div",
                "class" => "",
                "heading" => __("Sort By", SH_NAME),
                "param_name" => "sort_by",
                "value" => array_flip(array('date' => __('Date', SH_NAME), 'title' => __('Title', SH_NAME), 'name' => __('Name', SH_NAME), 'author' => __('Author', SH_NAME), 'comment_count' => __('Comment Count', SH_NAME), 'random' => __('Random', SH_NAME))),
                "description" => __("Choose Sorting by.", SH_NAME)
            ),
            array(
                "type" => "dropdown",
                "holder" => "div",
                "class" => "",
                "heading" => __("Sorting Order", SH_NAME),
                "param_name" => "sorting_order",
                "value" => array(__('Ascending Order', SH_NAME) => 'ASC', __('Descending Order', SH_NAME) => 'DESC'),
                "description" => __("Choose Sorting Order.", SH_NAME)
            ),
            array(
                "type" => "checkbox",
                "holder" => "div",
                "class" => "",
                "heading" => __("Linked to Deatiled Page ?", SH_NAME),
                "param_name" => "linked",
                "value" => array('linked' => 'Linked'),
                "description" => __("Click to link services to the Detail page.", SH_NAME)
            ),
            array(
                "type" => "checkbox",
                "holder" => "div",
                "class" => "",
                "heading" => __("Overlap Services?", SH_NAME),
                "param_name" => "overlap",
                "value" => array('overlap' => 'Overlap'),
                "description" => __("Click to Make this Section Overlap the Upper Section.", SH_NAME)
            )
        )
    )
);
vc_map(array(
        "name" => __("Gallery", SH_NAME),
        "base" => "sh_Gallery",
        "class" => "",
        "icon" => 'sh_gallery',
        "category" => __('Lifeline', SH_NAME),
        "params" => array(
            
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => __("Number", SH_NAME),
                "param_name" => "num",
                "description" => __("Enter Number of Galleries.", SH_NAME)
            ),
            array(
                "type" => "dropdown",
                "holder" => "div",
                "class" => "",
                "heading" => __("Columns", SH_NAME),
                "param_name" => "cols",
                "value" => array_flip(array(1 => '1 Column', 2 => '2 Columns', 3 => '3 Columns', 4 => '4 Columns')),
                "description" => __("Choose Number of Columns for Galleries.", SH_NAME)
            ),
        )
    )
);
vc_map(array(
        "name" => __("Portfoilo Wide", SH_NAME),
        "base" => "sh_portfolio_without_sidebar",
        "class" => "",
        "icon" => 'sh_portfolio',
        "category" => __('Lifeline', SH_NAME),
        "params" => array(
            
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => __("Number", SH_NAME),
                "param_name" => "num",
                "description" => __("Enter Number of Portfoilos.", SH_NAME)
            ),
            array(
                "type" => "dropdown",
                "holder" => "div",
                "class" => "",
                "heading" => __("Columns", SH_NAME),
                "param_name" => "cols",
                "value" => array_flip(array(2 => '2 Columns', 3 => '3 Columns', 4 => '4 Column',)),
                "description" => __("Choose Number of Columns for Galleries.", SH_NAME)
            ),
        )
    )
);
vc_map(array(
        "name" => __("Portfoilo With Sidebar", SH_NAME),
        "base" => "sh_portfolio_with_sidebar",
        "class" => "",
        "icon" => 'sh_portfolio',
        "category" => __('Lifeline', SH_NAME),
        "params" => array(
            
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => __("Number", SH_NAME),
                "param_name" => "num",
                "description" => __("Enter Number of Portfoilos.", SH_NAME)
            ),
            array(
                "type" => "dropdown",
                "holder" => "div",
                "class" => "",
                "heading" => __("Columns", SH_NAME),
                "param_name" => "cols",
                "value" => array_flip(array(2 => '2 Columns', 3 => '3 Columns')),
                "description" => __("Choose Number of Columns for Galleries.", SH_NAME)
            ),
        )
    )
);
vc_map(array(
        "name" => __("Video Gallery", SH_NAME),
        "base" => "sh_video_gallery",
        "class" => "",
        "category" => __('Lifeline', SH_NAME),
        "icon" => 'sh_gallery',
        "params" => array(
            
            array(
                "type" => "dropdown",
                "holder" => "div",
                "class" => "",
                "heading" => __("Columns", SH_NAME),
                "param_name" => "cols",
                "value" => array_flip(array(6 => '2 Columns', 4 => '3 Columns')),
                "description" => __("Choose Number of Columns for Galleries.", SH_NAME)
            ),
            array(
                "type" => "dropdown",
                "holder" => "div",
                "class" => "",
                "heading" => __("Play Options", SH_NAME),
                "param_name" => "play_options",
                "value" => array_flip(array('lightbox' => 'Play in Light Box', 'simple' => 'Simple Player')),
                "description" => __("Choose either video should play in Light Box or not .", SH_NAME)
            ),
            array(
                "type" => "textarea",
                "holder" => "div",
                "class" => "",
                "heading" => __("Video Links", SH_NAME),
                "param_name" => "links",
                "description" => __("Enter Comma Seperated Video Links.", SH_NAME)
            ),
        )
    )
);
vc_map(array(
        "name" => __("Qotes Slider", SH_NAME),
        "base" => "sh_qoutes_slider",
        "class" => "",
        "icon" => 'welfare-project',
        "category" => __('Lifeline', SH_NAME),
        
        "params" => array(
            
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => __("Number", SH_NAME),
                "param_name" => "number",
                "value" => '',
                "description" => __("Enter number of posts", SH_NAME)
            ),
        )
    )
);
vc_map(array(
        "name" => __("Causes(Issues We Are Working On)", SH_NAME),
        "base" => "sh_issues_we_work",
        "class" => "",
        "icon" => SH_URL.'/images/vc/Causes.png',
        "category" => __('Lifeline', SH_NAME),
        
        "params" => array(
            
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => __("Section Title", SH_NAME),
                "param_name" => "section_title",
                "value" => '',
                "description" => __("Enter Title fot this Section.", SH_NAME)
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => __("Number", SH_NAME),
                "param_name" => "number",
                "value" => '',
                "description" => __("Enter number of posts", SH_NAME)
            ),
            array(
                "type" => "dropdown",
                "holder" => "div",
                "class" => "",
                "heading" => __("Sort By", SH_NAME),
                "param_name" => "sort_by",
                "value" => array_flip(array('date' => __('Date', SH_NAME), 'title' => __('Title', SH_NAME), 'name' => __('Name', SH_NAME), 'author' => __('Author', SH_NAME), 'comment_count' => __('Comment Count', SH_NAME), 'random' => __('Random', SH_NAME))),
                "description" => __("Choose Sorting by.", SH_NAME)
            ),
            array(
                "type" => "dropdown",
                "holder" => "div",
                "class" => "",
                "heading" => __("Category", SH_NAME),
                "param_name" => "category",
                "value" => array_flip(sh_get_categories(array('taxonomy' => 'causes_category', 'hide_empty' => FALSE))),
                "description" => __('Choose Category. ', SH_NAME)
            ),
            array(
                "type" => "dropdown",
                "holder" => "div",
                "class" => "",
                "heading" => __("Sorting Order", SH_NAME),
                "param_name" => "sorting_order",
                "value" => array(__('Ascending Order', SH_NAME) => 'ASC', __('Descending Order', SH_NAME) => 'DESC'),
                "description" => __("Choose Sorting Order.", SH_NAME)
            ),
            
        )
    )
);
vc_map(array(
        "name" => __("Project Slider", SH_NAME),
        "base" => "sh_projects_slider",
        "class" => "",
        "icon" => SH_URL.'/images/vc/project.png',
        "category" => __('Lifeline', SH_NAME),
        
        "params" => array(
            
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => __("Section Title", SH_NAME),
                "param_name" => "section_title",
                "value" => '',
                "description" => __("Enter Title fot this Section.", SH_NAME)
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => __("Number", SH_NAME),
                "param_name" => "number",
                "value" => '',
                "description" => __("Enter number of posts", SH_NAME)
            ),
            array(
                "type" => "dropdown",
                "holder" => "div",
                "class" => "",
                "heading" => __("Sort By", SH_NAME),
                "param_name" => "sort_by",
                "value" => array_flip(array('date' => __('Date', SH_NAME), 'title' => __('Title', SH_NAME), 'name' => __('Name', SH_NAME), 'author' => __('Author', SH_NAME), 'comment_count' => __('Comment Count', SH_NAME), 'random' => __('Random', SH_NAME))),
                "description" => __("Choose Sorting by.", SH_NAME)
            ),
            array(
                "type" => "dropdown",
                "holder" => "div",
                "class" => "",
                "heading" => __("Category", SH_NAME),
                "param_name" => "category",
                "value" => array_flip(sh_get_categories(array('taxonomy' => 'causes_category', 'hide_empty' => FALSE))),
                "description" => __('Choose Category. ', SH_NAME)
            ),
            array(
                "type" => "dropdown",
                "holder" => "div",
                "class" => "",
                "heading" => __("Sorting Order", SH_NAME),
                "param_name" => "sorting_order",
                "value" => array(__('Ascending Order', SH_NAME) => 'ASC', __('Descending Order', SH_NAME) => 'DESC'),
                "description" => __("Choose Sorting Order.", SH_NAME)
            ),
            
        )
    )
);
vc_map(array(
        "name" => __("Latest News Slider", SH_NAME),
        "base" => "sh_latest_news_slider",
        "class" => "",
        "icon" => SH_URL.'/images/vc/news_new.png',
        "category" => __('Lifeline', SH_NAME),
        
        "params" => array(
            
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => __("Section Title", SH_NAME),
                "param_name" => "section_title",
                "value" => '',
                "description" => __("Enter Title fot this Section.", SH_NAME)
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => __("Number", SH_NAME),
                "param_name" => "number",
                "value" => '',
                "description" => __("Enter number of posts", SH_NAME)
            ),
            array(
                "type" => "dropdown",
                "holder" => "div",
                "class" => "",
                "heading" => __("Sort By", SH_NAME),
                "param_name" => "sort_by",
                "value" => array_flip(array('date' => __('Date', SH_NAME), 'title' => __('Title', SH_NAME), 'name' => __('Name', SH_NAME), 'author' => __('Author', SH_NAME), 'comment_count' => __('Comment Count', SH_NAME), 'random' => __('Random', SH_NAME))),
                "description" => __("Choose Sorting by.", SH_NAME)
            ),
            array(
                "type" => "dropdown",
                "holder" => "div",
                "class" => "",
                "heading" => __("Category", SH_NAME),
                "param_name" => "category",
                "value" => array_flip(sh_get_categories(array('taxonomy' => 'causes_category', 'hide_empty' => FALSE))),
                "description" => __('Choose Category. ', SH_NAME)
            ),
            array(
                "type" => "dropdown",
                "holder" => "div",
                "class" => "",
                "heading" => __("Sorting Order", SH_NAME),
                "param_name" => "sorting_order",
                "value" => array(__('Ascending Order', SH_NAME) => 'ASC', __('Descending Order', SH_NAME) => 'DESC'),
                "description" => __("Choose Sorting Order.", SH_NAME)
            ),
            
        )
    )
);
vc_map(array(
        "name" => __("Welcome Box", SH_NAME),
        "base" => "sh_welcome_box",
        "class" => "",
        "icon" => SH_URL.'/images/vc/welcome.png',
        "category" => __('Lifeline', SH_NAME),
        "params" => array(
			array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => __("Heading Text", SH_NAME),
                "param_name" => "h_txt",
                "value" => "",
                "description" => __("Enter the heading text of this section.", SH_NAME)
            ),
			array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => __("Description", SH_NAME),
                "param_name" => "h_desc",
                "value" => "",
                "description" => __("Enter the description of this section.", SH_NAME)
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => __("Button Text", SH_NAME),
                "param_name" => "button_txt",
                "value" => "",
                "description" => __("Enter the text of the button.", SH_NAME)
            ),
			array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => __("Button Url", SH_NAME),
                "param_name" => "button_url",
                "value" => "",
                "description" => __("Enter the url of the button.", SH_NAME)
            ),
        )
    )
);
vc_map(array(
        "name" => __("Full width Video", SH_NAME),
        "base" => "sh_parallax_video",
        "class" => "",
        "icon" => SH_URL.'/images/vc/full-video.png',
        "category" => __('Lifeline', SH_NAME),
        "params" => array(
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => __("Video ID", SH_NAME),
                "param_name" => "video_id",
                "value" => "",
                "description" => __("Enter the vimeo video id like '10259948' ", SH_NAME)
            ),
        )
    )
);
vc_map(array(
        "name" => __("Causes with carousel", SH_NAME),
        "base" => "sh_causes_with_carousel",
        "class" => "",
        "icon" => SH_URL.'/images/vc/qote-slider.png',
        "category" => __('Lifeline', SH_NAME),
        "params" => array(
			array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => __("Section Title", SH_NAME),
                "param_name" => "section_title",
                "value" => '',
                "description" => __("Enter Title fot this Section.", SH_NAME)
            ),
			array(
                "type" => "dropdown",
                "holder" => "div",
                "class" => "",
                "heading" => __("Use As", SH_NAME),
                "param_name" => "use_as",
                "value" => array( __('Heading', SH_NAME) => 'Heading', __('slider', SH_NAME) => 'Slider'),
                "description" => __("Select the option of this section.", SH_NAME)
            ),
			array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => __("Section Description", SH_NAME),
                "param_name" => "section_desc",
                "value" => '',
                "description" => __("Enter Description fot this Section.", SH_NAME)
            ),
			array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => __("Number", SH_NAME),
                "param_name" => "number",
                "value" => '',
                "description" => __("Enter number of posts", SH_NAME)
            ),
			array(
                "type" => "dropdown",
                "holder" => "div",
                "class" => "",
                "heading" => __("Category", SH_NAME),
                "param_name" => "category",
                "value" => array_flip(sh_get_categories(array('taxonomy' => 'causes_category', 'hide_empty' => FALSE))),
                "description" => __('Choose Category. ', SH_NAME)
            ),
             array(
                "type" => "dropdown",
                "holder" => "div",
                "class" => "",
                "heading" => __("Sort By", SH_NAME),
                "param_name" => "sort_by",
                "value" => array_flip(array('date' => __('Date', SH_NAME), 'title' => __('Title', SH_NAME), 'name' => __('Name', SH_NAME), 'author' => __('Author', SH_NAME), 'comment_count' => __('Comment Count', SH_NAME), 'random' => __('Random', SH_NAME))),
                "description" => __("Choose Sorting by.", SH_NAME)
            ),
            array(
                "type" => "dropdown",
                "holder" => "div",
                "class" => "",
                "heading" => __("Sorting Order", SH_NAME),
                "param_name" => "sorting_order",
                "value" => array(__('Ascending Order', SH_NAME) => 'ASC', __('Descending Order', SH_NAME) => 'DESC'),
                "description" => __("Choose Sorting Order.", SH_NAME)
            ),
        )
    )
);
vc_map(array(
        "name" => __("Services With Pictorial Icons", SH_NAME),
        "base" => "sh_services_with_pictures",
        "class" => "",
        "icon" => SH_URL.'/images/vc/services_new.png',
        "category" => __('Lifeline', SH_NAME),
        "params" => array(
			array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => __("Number", SH_NAME),
                "param_name" => "number",
                "value" => '',
                "description" => __("Enter number of posts", SH_NAME)
            ),
			array(
                "type" => "dropdown",
                "holder" => "div",
                "class" => "",
                "heading" => __("Layout", SH_NAME),
                "param_name" => "layout",
                "value" => array_flip(array('title_only' => __('Title Only', SH_NAME), 'title_desc' => __('Title With Description', SH_NAME))),
                "description" => __("Choose Display.", SH_NAME)
            ),
			array(
                "type" => "dropdown",
                "holder" => "div",
                "class" => "",
                "heading" => __("Display", SH_NAME),
                "param_name" => "display",
                "value" => array_flip(array('icon' => __('Icons', SH_NAME), 'picture' => __('Pictures', SH_NAME))),
                "description" => __("Choose Display.", SH_NAME)
            ),
			array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => __("Button Text", SH_NAME),
                "param_name" => "btn_text",
                "value" => '',
                "description" => __("Enter the text of the button.", SH_NAME)
            ),
             array(
                "type" => "dropdown",
                "holder" => "div",
                "class" => "",
                "heading" => __("Sort By", SH_NAME),
                "param_name" => "sort_by",
                "value" => array_flip(array('date' => __('Date', SH_NAME), 'title' => __('Title', SH_NAME), 'name' => __('Name', SH_NAME), 'author' => __('Author', SH_NAME), 'comment_count' => __('Comment Count', SH_NAME), 'random' => __('Random', SH_NAME))),
                "description" => __("Choose Sorting by.", SH_NAME)
            ),
            array(
                "type" => "dropdown",
                "holder" => "div",
                "class" => "",
                "heading" => __("Sorting Order", SH_NAME),
                "param_name" => "sorting_order",
                "value" => array(__('Ascending Order', SH_NAME) => 'ASC', __('Descending Order', SH_NAME) => 'DESC'),
                "description" => __("Choose Sorting Order.", SH_NAME)
            ),
        )
    )
);
vc_map(array(
        "name" => __("Charity Statics", SH_NAME),
        "base" => "sh_charity_statics",
        "class" => "",
        "icon" => SH_URL.'/images/vc/chairty.png',
        "category" => __('Lifeline', SH_NAME),
        "params" => array(
			array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => __("Heading", SH_NAME),
                "param_name" => "heading",
                "value" => '',
                "description" => __("Enter the Heading", SH_NAME)
            ),
			array(
                "type" => "textarea",
                "holder" => "div",
                "class" => "",
                "heading" => __("Deascription", SH_NAME),
                "param_name" => "desc",
                "value" => '',
                "description" => __("Enter the Deascription", SH_NAME)
            ),
			array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => __("First Box Statics", SH_NAME),
                "param_name" => "box1",
                "value" => '',
                "description" => __("Enter the First Box Statics Number", SH_NAME)
            ),
			array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => __("First Box Statics Text", SH_NAME),
                "param_name" => "box1_txt",
                "value" => '',
                "description" => __("Enter the First Box Statics text", SH_NAME)
            ),
			array(
                "type" => "attach_image",
                "holder" => "div",
                "class" => "",
                "heading" => __("First Box Background Image", SH_NAME),
                "param_name" => "box1_bg",
                "value" => '',
                "description" => __("Select the First Box Background Image", SH_NAME)
            ),
			
			array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => __("Secound Box Statics", SH_NAME),
                "param_name" => "box2",
                "value" => '',
                "description" => __("Enter the Secound Box Statics Number", SH_NAME)
            ),
			array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => __("Secound Box Statics Text", SH_NAME),
                "param_name" => "box2_txt",
                "value" => '',
                "description" => __("Enter the Secound Box Statics text", SH_NAME)
            ),
			array(
                "type" => "attach_image",
                "holder" => "div",
                "class" => "",
                "heading" => __("Secound Box Background Image", SH_NAME),
                "param_name" => "box2_bg",
                "value" => '',
                "description" => __("Select the Secound Box Background Image", SH_NAME)
            ),
			
			array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => __("Third Box Statics", SH_NAME),
                "param_name" => "box3",
                "value" => '',
                "description" => __("Enter the Third Box Statics Number", SH_NAME)
            ),
			array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => __("Third Box Statics Text", SH_NAME),
                "param_name" => "box3_txt",
                "value" => '',
                "description" => __("Enter the Third Box Statics text", SH_NAME)
            ),
			array(
                "type" => "attach_image",
                "holder" => "div",
                "class" => "",
                "heading" => __("Third Box Background Image", SH_NAME),
                "param_name" => "box3_bg",
                "value" => '',
                "description" => __("Select the Third Box Background Image", SH_NAME)
            ),
			
			array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => __("Fourth Box Statics", SH_NAME),
                "param_name" => "box4",
                "value" => '',
                "description" => __("Enter the Fourth Box Statics Number", SH_NAME)
            ),
			array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => __("Fourth Box Statics Text", SH_NAME),
                "param_name" => "box4_txt",
                "value" => '',
                "description" => __("Enter the Fourth Box Statics text", SH_NAME)
            ),
			array(
                "type" => "attach_image",
                "holder" => "div",
                "class" => "",
                "heading" => __("Fourth Box Background Image", SH_NAME),
                "param_name" => "box4_bg",
                "value" => '',
                "description" => __("Select the Fourth Box Background Image", SH_NAME)
            ),
        )
    )
);
vc_map(array(
        "name" => __("Our Mission Carousel", SH_NAME),
        "base" => "sh_our_mission_carousel",
        "class" => "",
        "icon" => SH_URL.'/images/vc/qote-slider.png',
        "category" => __('Lifeline', SH_NAME),
        "params" => array(
			array(
                "type" => "dropdown",
                "holder" => "div",
                "class" => "",
                "heading" => __("Post Type", SH_NAME),
                "param_name" => "post_type",
                "value" => array( 'Post' => 'post', 'Testimonial' => 'dict_testimonials', 'Causes' => 'dict_causes', 'Project' => 'dict_project', 'Event' => 'dict_event', 'Portfolio' => 'dict_portfolio','Team' => 'dict_team','Services' => 'dict_services' ),
                "description" => __("Select the post type.", SH_NAME)
            ),
			array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => __("Number", SH_NAME),
                "param_name" => "number",
                "value" => '',
                "description" => __("Enter number of posts", SH_NAME)
            ),
			array(
                "type" => "dropdown",
                "holder" => "div",
                "class" => "",
                "heading" => __("Sort By", SH_NAME),
                "param_name" => "sort_by",
                "value" => array_flip(array('date' => __('Date', SH_NAME), 'title' => __('Title', SH_NAME), 'name' => __('Name', SH_NAME), 'author' => __('Author', SH_NAME), 'comment_count' => __('Comment Count', SH_NAME), 'random' => __('Random', SH_NAME))),
                "description" => __("Choose Sorting by.", SH_NAME)
            ),
            array(
                "type" => "dropdown",
                "holder" => "div",
                "class" => "",
                "heading" => __("Sorting Order", SH_NAME),
                "param_name" => "sorting_order",
                "value" => array(__('Ascending Order', SH_NAME) => 'ASC', __('Descending Order', SH_NAME) => 'DESC'),
                "description" => __("Choose Sorting Order.", SH_NAME)
            ),
        )
    )
);
vc_map(array(
        "name" => __("Sponsor", SH_NAME),
        "base" => "sh_sponsor",
        "class" => "",
        "icon" => SH_URL.'/images/vc/qote-slider.png',
        "category" => __('Lifeline', SH_NAME),
        "params" => array(
			array(
                "type" => "textarea_raw_html",
                "holder" => "div",
                "class" => "",
                "heading" => __("Description", SH_NAME),
                "param_name" => "desc",
                "value" =>"",
                "description" => __("Enter Description.", SH_NAME)
            ),
			array(
                "type" => "attach_image",
                "holder" => "div",
                "class" => "",
                "heading" => __("Select Image", SH_NAME),
                "param_name" => "image",
                "value" => '',
                "description" => __("Select Images.", SH_NAME)
            ),
			array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => __("Button Text", SH_NAME),
                "param_name" => "btn_text",
                "value" => '',
                "description" => __("Enter the button text.", SH_NAME)
            ),
        )
    )
);
vc_map(array(
        "name" => __("Creative Recent News", SH_NAME),
        "icon" => '',
        "base" => "sh_creative_recent_news",
        "class" => "",
        "category" => __('Lifeline', SH_NAME),
        "params" => array(            
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => __("Number", SH_NAME),
                "param_name" => "number",
                "value" => '',
                "description" => __("Enter number of posts", SH_NAME)
            ),
			array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => __("Text Limit", SH_NAME),
                "param_name" => "limit",
                "value" => '',
                "description" => __("Enter the text limit of this section in integer", SH_NAME)
            ),
            array(
                "type" => "dropdown",
                "holder" => "div",
                "class" => "",
                "heading" => __("Ctagory", SH_NAME),
                "param_name" => "category",
                "value" => array_flip( sh_get_categories(array('hide_empty' => FALSE))),
                "description" => __("Choose Category.", SH_NAME)
            ),
            array(
                "type" => "dropdown",
                "holder" => "div",
                "class" => "",
                "heading" => __("Sort By", SH_NAME),
                "param_name" => "sort_by",
                "value" => array_flip(array('date' => __('Date', SH_NAME), 'title' => __('Title', SH_NAME), 'name' => __('Name', SH_NAME), 'author' => __('Author', SH_NAME), 'comment_count' => __('Comment Count', SH_NAME), 'random' => __('Random', SH_NAME))),
                "description" => __("Choose Sorting by.", SH_NAME)
            ),
            array(
                "type" => "dropdown",
                "holder" => "div",
                "class" => "",
                "heading" => __("Sorting Order", SH_NAME),
                "param_name" => "sorting_order",
                "value" => array(__('Ascending Order', SH_NAME) => 'ASC', __('Descending Order', SH_NAME) => 'DESC'),
                "description" => __("Choose Sorting Order.", SH_NAME)
            ),
            
        )
    )
);
vc_map(array(
        "name" => __("Featured Posts", SH_NAME),
        "base" => "sh_featured_posts",
        "class" => "",
        "icon" => "",
        "category" => __('Lifeline', SH_NAME),
        "params" => array(
			array(
                "type" => "dropdown",
                "holder" => "div",
                "class" => "",
                "heading" => __("Post Type", SH_NAME),
                "param_name" => "post_type",
                "value" => array( 'Post' => 'post', 'Testimonial' => 'dict_testimonials', 'Causes' => 'dict_causes', 'Project' => 'dict_project', 'Event' => 'dict_event', 'Portfolio' => 'dict_portfolio','Team' => 'dict_team','Services' => 'dict_services' ),
                "description" => __("Select the post type.", SH_NAME)
            ),
			array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => __("Number", SH_NAME),
                "param_name" => "number",
                "value" => '',
                "description" => __("Enter number of posts", SH_NAME)
            ),
			array(
                "type" => "dropdown",
                "holder" => "div",
                "class" => "",
                "heading" => __("Sort By", SH_NAME),
                "param_name" => "sort_by",
                "value" => array_flip(array('date' => __('Date', SH_NAME), 'title' => __('Title', SH_NAME), 'name' => __('Name', SH_NAME), 'author' => __('Author', SH_NAME), 'comment_count' => __('Comment Count', SH_NAME), 'random' => __('Random', SH_NAME))),
                "description" => __("Choose Sorting by.", SH_NAME)
            ),
            array(
                "type" => "dropdown",
                "holder" => "div",
                "class" => "",
                "heading" => __("Sorting Order", SH_NAME),
                "param_name" => "sorting_order",
                "value" => array(__('Ascending Order', SH_NAME) => 'ASC', __('Descending Order', SH_NAME) => 'DESC'),
                "description" => __("Choose Sorting Order.", SH_NAME)
            ),
        )
    )
);
vc_map(array(
        "name" => __("Post Video Carousel", SH_NAME),
        "icon" => '',
        "base" => "sh_post_carousel",
        "class" => "",
        "category" => __('Lifeline', SH_NAME),
        "params" => array(            
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => __("Number", SH_NAME),
                "param_name" => "number",
                "value" => '',
                "description" => __("Enter number of posts", SH_NAME)
            ),
            array(
                "type" => "dropdown",
                "holder" => "div",
                "class" => "",
                "heading" => __("Ctagory", SH_NAME),
                "param_name" => "category",
                "value" => array_flip(sh_get_categories(array('hide_empty' => FALSE))),
                "description" => __("Choose Category.", SH_NAME)
            ),
            array(
                "type" => "dropdown",
                "holder" => "div",
                "class" => "",
                "heading" => __("Sort By", SH_NAME),
                "param_name" => "sort_by",
                "value" => array_flip(array('date' => __('Date', SH_NAME), 'title' => __('Title', SH_NAME), 'name' => __('Name', SH_NAME), 'author' => __('Author', SH_NAME), 'comment_count' => __('Comment Count', SH_NAME), 'random' => __('Random', SH_NAME))),
                "description" => __("Choose Sorting by.", SH_NAME)
            ),
            array(
                "type" => "dropdown",
                "holder" => "div",
                "class" => "",
                "heading" => __("Sorting Order", SH_NAME),
                "param_name" => "sorting_order",
                "value" => array(__('Ascending Order', SH_NAME) => 'ASC', __('Descending Order', SH_NAME) => 'DESC'),
                "description" => __("Choose Sorting Order.", SH_NAME)
            ),
            
        )
    )
);
vc_map( array(
			"name" => __("Blockquote Carousel", SH_NAME),
			"base" => "sh_blockquote_carousel",
			"class" => "",
			"content_element" => true,
			"as_parent" => array( 'only' => 'sh_blockquote_text' ),
			"icon" => "",
			"content_element" => true,
			"show_settings_on_create" => false,
			"category" => __('Lifeline', SH_NAME),
			"params" => array(
				array(
				   "type" => "textfield",
				   "holder" => "div",
				   "class" => "",
				   "heading" => __(' ', SH_NAME),
				   "param_name" => "acc_content",
				   'value' => '',
				   "description" => __("", SH_NAME)
				),
			)
	    )
);
vc_map( array(
			"name" => __("Blockquote Text", SH_NAME),
			"base" => "sh_blockquote_text",
			"class" => "",
			"content_element" => true,
			"as_child" => array('only' => 'sh_blockquote_carousel'),
			"icon" => "",
			"category" => __('Lifeline', SH_NAME),
			"params" => array(
				array(
				   "type" => "textarea",
				   "holder" => "div",
				   "class" => "",
				   "heading" => __('Content', SH_NAME),
				   "param_name" => "acc_content",
				   'value' => '',
				   "description" => __("Enter the Content:", SH_NAME)
				),
			)
	    )
);
vc_map(array(
        "name" => __("Casuses with Thumb", SH_NAME),
        "base" => "sh_causes_with_thumb",
        "class" => "",
        "icon" => "",
        "category" => __('Lifeline', SH_NAME),
        "params" => array(
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => __("Number", SH_NAME),
                "param_name" => "number",
                "value" => '',
                "description" => __("Enter number of posts", SH_NAME)
            ),
			array(
                "type" => "dropdown",
                "holder" => "div",
                "class" => "",
                "heading" => __("Category", SH_NAME),
                "param_name" => "cat",
                "value" => array_flip(sh_get_categories(array('taxonomy' => 'causes_category'), false)),
                "description" => __("Choose Sorting Order.", SH_NAME)
            ),
            array(
                "type" => "dropdown",
                "holder" => "div",
                "class" => "",
                "heading" => __("Sort By", SH_NAME),
                "param_name" => "sort_by",
                "value" => array_flip(array('date' => __('Date', SH_NAME), 'title' => __('Title', SH_NAME), 'name' => __('Name', SH_NAME), 'author' => __('Author', SH_NAME), 'comment_count' => __('Comment Count', SH_NAME), 'random' => __('Random', SH_NAME))),
                "description" => __("Choose Sorting by.", SH_NAME)
            ),
            array(
                "type" => "dropdown",
                "holder" => "div",
                "class" => "",
                "heading" => __("Sorting Order", SH_NAME),
                "param_name" => "sorting_order",
                "value" => array(__('Ascending Order', SH_NAME) => 'ASC', __('Descending Order', SH_NAME) => 'DESC'),
                "description" => __("Choose Sorting Order.", SH_NAME)
            ),
        )
    )
);
vc_map(array(
        "name" => __("Latest News Carousel", SH_NAME),
        "base" => "sh_latest_news_carousel",
        "class" => "",
        "icon" => "",
        "category" => __('Lifeline', SH_NAME),
        "params" => array(
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => __("Number", SH_NAME),
                "param_name" => "number",
                "value" => '',
                "description" => __("Enter number of posts", SH_NAME)
            ),
            array(
                "type" => "dropdown",
                "holder" => "div",
                "class" => "",
                "heading" => __("Sort By", SH_NAME),
                "param_name" => "sort_by",
                "value" => array_flip(array('date' => __('Date', SH_NAME), 'title' => __('Title', SH_NAME), 'name' => __('Name', SH_NAME), 'author' => __('Author', SH_NAME), 'comment_count' => __('Comment Count', SH_NAME), 'random' => __('Random', SH_NAME))),
                "description" => __("Choose Sorting by.", SH_NAME)
            ),
            array(
                "type" => "dropdown",
                "holder" => "div",
                "class" => "",
                "heading" => __("Sorting Order", SH_NAME),
                "param_name" => "sorting_order",
                "value" => array(__('Ascending Order', SH_NAME) => 'ASC', __('Descending Order', SH_NAME) => 'DESC'),
                "description" => __("Choose Sorting Order.", SH_NAME)
            ),
            array(
                "type" => "dropdown",
                "holder" => "div",
                "class" => "",
                "heading" => __("Category", SH_NAME),
                "param_name" => "cat",
                "value" => sh_get_categories(array('hide_empty' => FALSE)),
                "description" => __("Choose Sorting Order.", SH_NAME)
            ),
        )
    )
);
vc_map(array(
        "name" => __("Fancy Causes", SH_NAME),
        "base" => "sh_fancy_causes",
        "class" => "",
        "icon" => "",
        "category" => __('Lifeline', SH_NAME),
        "params" => array(
            array(
                "type" => "dropdown",
                "holder" => "div",
                "class" => "",
                "heading" => __("Post", SH_NAME),
                "param_name" => "post_id",
                "value" => array_flip( sh_get_posts_array( 'dict_causes' ) ),
                "description" => __("Select Causes Post.", SH_NAME)
            ),
        )
    )
);
vc_map(array(
        "name" => __("Fancy Causes Style 2", SH_NAME),
        "base" => "sh_fancy_causes_2",
        "class" => "",
        "icon" => "",
        "category" => __('Lifeline', SH_NAME),
        "params" => array(
            array(
                "type" => "dropdown",
                "holder" => "div",
                "class" => "",
                "heading" => __("Post", SH_NAME),
                "param_name" => "post_id",
                "value" => array_flip( sh_get_posts_array( 'dict_causes' ) ),
                "description" => __("Select Causes Post.", SH_NAME)
            ),
        )
    )
);

vc_map(array(
        "name" => __("Donation Parallax Box", SH_NAME),
        "base" => "sh_donation_parallax_box",
        "class" => "",
        "icon" => "",
        "category" => __('Lifeline', SH_NAME),
        "params" => array(
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => __("Title", SH_NAME),
                "param_name" => "title",
                "value" => "",
                "description" => __("Enter your title.", SH_NAME)
            ),
			array(
                "type" => "textarea",
                "holder" => "div",
                "class" => "",
                "heading" => __("Description", SH_NAME),
                "param_name" => "desc",
                "value" => "",
                "description" => __("Enter your description.", SH_NAME)
            ),
			array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => __("Button Text", SH_NAME),
                "param_name" => "button",
                "value" => "",
                "description" => __("Enter Button Text.", SH_NAME)
            ),
			array(
                "type" => "attach_image",
                "holder" => "div",
                "class" => "",
                "heading" => __("Background Image", SH_NAME),
                "param_name" => "bg",
                "value" => "",
                "description" => __("Select your Background Image. For the best result plese selct 384x438 image size", SH_NAME)
            ),
        )
    )
);


vc_map(array(
        "name" => __("Projects Carousal Full Page", SH_NAME),
        "base" => "sh_project_carousal_full_page",
        "class" => "",
        "icon" => "",
        "category" => __('Lifeline', SH_NAME),
        "params" => array(
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => __("Number", SH_NAME),
                "param_name" => "number",
                "value" => '',
                "description" => __("Enter number of posts", SH_NAME)
            ),
            array(
                "type" => "dropdown",
                "holder" => "div",
                "class" => "",
                "heading" => __("Ctagory", SH_NAME),
                "param_name" => "category",
                "value" => array_flip(sh_get_categories(array('taxonomy' => 'project_category', 'hide_empty' => FALSE))),
                "description" => __("Choose Category.", SH_NAME)
            ),
            array(
                "type" => "dropdown",
                "holder" => "div",
                "class" => "",
                "heading" => __("Sort By", SH_NAME),
                "param_name" => "sort_by",
                "value" => array_flip(array('date' => __('Date', SH_NAME), 'title' => __('Title', SH_NAME), 'name' => __('Name', SH_NAME), 'author' => __('Author', SH_NAME), 'comment_count' => __('Comment Count', SH_NAME), 'random' => __('Random', SH_NAME))),
                "description" => __("Choose Sorting by.", SH_NAME)
            ),
            array(
                "type" => "dropdown",
                "holder" => "div",
                "class" => "",
                "heading" => __("Sorting Order", SH_NAME),
                "param_name" => "sorting_order",
                "value" => array(__('Ascending Order', SH_NAME) => 'ASC', __('Descending Order', SH_NAME) => 'DESC'),
                "description" => __("Choose Sorting Order.", SH_NAME)
            ),
        )
    )
);

vc_map(array(
        "name" => __("Causes New Style", SH_NAME),
        "base" => "sh_causes_new_style",
        "class" => "",
        "icon" => "",
        "category" => __('Lifeline', SH_NAME),
        "params" => array(
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => __("Number", SH_NAME),
                "param_name" => "number",
                "value" => '',
                "description" => __("Enter number of posts", SH_NAME)
            ),
            array(
                "type" => "dropdown",
                "holder" => "div",
                "class" => "",
                "heading" => __("Ctagory", SH_NAME),
                "param_name" => "category",
                "value" => array_flip(sh_get_categories(array('taxonomy' => 'causes_category', 'hide_empty' => FALSE))),
                "description" => __("Choose Category.", SH_NAME)
            ),
            array(
                "type" => "dropdown",
                "holder" => "div",
                "class" => "",
                "heading" => __("Sort By", SH_NAME),
                "param_name" => "sort_by",
                "value" => array_flip(array('date' => __('Date', SH_NAME), 'title' => __('Title', SH_NAME), 'name' => __('Name', SH_NAME), 'author' => __('Author', SH_NAME), 'comment_count' => __('Comment Count', SH_NAME), 'random' => __('Random', SH_NAME))),
                "description" => __("Choose Sorting by.", SH_NAME)
            ),
            array(
                "type" => "dropdown",
                "holder" => "div",
                "class" => "",
                "heading" => __("Sorting Order", SH_NAME),
                "param_name" => "sorting_order",
                "value" => array(__('Ascending Order', SH_NAME) => 'ASC', __('Descending Order', SH_NAME) => 'DESC'),
                "description" => __("Choose Sorting Order.", SH_NAME)
            ),
        )
    )
);

vc_map(array(
        "name" => __("Urgent Cause Parallax", SH_NAME),
        "base" => "sh_urgent_cause_parallax",
        "class" => "",
        "icon" => "",
        "category" => __('Lifeline', SH_NAME),
        "params" => array(
            array(
                "type" => "dropdown",
                "holder" => "div",
                "class" => "",
                "heading" => __("Select Cause:", SH_NAME),
                "param_name" => "cause",
                "value" => array_flip( vp_get_posts_custom( 'dict_causes' ) ),
                "description" => __("Select Cause", SH_NAME)
            ),
			array(
                "type" => "attach_image",
                "holder" => "div",
                "class" => "",
                "heading" => __("Background Image:", SH_NAME),
                "param_name" => "bg",
                "value" => "",
                "description" => __("Selec backgroun image", SH_NAME)
            ),
        )
    )
);

vc_map(array(
        "name" => __("Donation Parallax Full Page", SH_NAME),
        "base" => "sh_donation_parallax_full_page",
        "class" => "",
        "icon" => "",
        "category" => __('Lifeline', SH_NAME),
        "params" => array(
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => __("Section Title:", SH_NAME),
                "param_name" => "title",
                "value" => "",
                "description" => __("Enter the title of this section", SH_NAME)
            ),
			array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => __("Section Sub Title:", SH_NAME),
                "param_name" => "subtitle",
                "value" => "",
                "description" => __("Enter the sub title of this section", SH_NAME)
            ),
			array(
                "type" => "textarea",
                "holder" => "div",
                "class" => "",
                "heading" => __("Description:", SH_NAME),
                "param_name" => "desc",
                "value" => "",
                "description" => __("Enter the description", SH_NAME)
            ),
			array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => __("Button Text:", SH_NAME),
                "param_name" => "btn_txt",
                "value" => "",
                "description" => __("Enter the text of the button", SH_NAME)
            ),
        )
    )
);

vc_map(array(
        "name" => __("Modern Event Counter", SH_NAME),
        "base" => "sh_modern_event_counter",
        "class" => "",
        "icon" => "",
        "category" => __('Lifeline', SH_NAME),
        "params" => array(
            array(
                "type" => "dropdown",
                "holder" => "div",
                "class" => "",
                "heading" => __("Select Event:", SH_NAME),
                "param_name" => "cause",
                "value" => array_flip( vp_get_posts_custom( 'dict_event' ) ),
                "description" => __("Select Event", SH_NAME)
            ),
			array(
                "type" => "dropdown",
                "holder" => "div",
                "class" => "",
                "heading" => __("Overlap", SH_NAME),
                "param_name" => "lap",
                "value" => array( __( 'True', SH_NAME ) => 'true', __( 'False', SH_NAME ) => 'false' ),
            ),
        )
    )
);

vc_map(array(
        "name" => __("Charity Events New", SH_NAME),
        "base" => "sh_charity_events_new",
        "class" => "",
        "icon" => "",
        "category" => __('Lifeline', SH_NAME),
        "params" => array(
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => __("Number", SH_NAME),
                "param_name" => "number",
                "value" => '',
                "description" => __("Enter number of posts", SH_NAME)
            ),
            array(
                "type" => "dropdown",
                "holder" => "div",
                "class" => "",
                "heading" => __("Ctagory", SH_NAME),
                "param_name" => "category",
                "value" => array_flip(sh_get_categories(array('taxonomy' => 'event_category', 'hide_empty' => FALSE))),
                "description" => __("Choose Category.", SH_NAME)
            ),
            array(
                "type" => "dropdown",
                "holder" => "div",
                "class" => "",
                "heading" => __("Sort By", SH_NAME),
                "param_name" => "sort_by",
                "value" => array_flip(array('date' => __('Date', SH_NAME), 'title' => __('Title', SH_NAME), 'name' => __('Name', SH_NAME), 'author' => __('Author', SH_NAME), 'comment_count' => __('Comment Count', SH_NAME), 'random' => __('Random', SH_NAME))),
                "description" => __("Choose Sorting by.", SH_NAME)
            ),
            array(
                "type" => "dropdown",
                "holder" => "div",
                "class" => "",
                "heading" => __("Sorting Order", SH_NAME),
                "param_name" => "sorting_order",
                "value" => array(__('Ascending Order', SH_NAME) => 'ASC', __('Descending Order', SH_NAME) => 'DESC'),
                "description" => __("Choose Sorting Order.", SH_NAME)
            ),
        )
    )
);

class WPBakeryShortCode_sh_blockquote_carousel extends WPBakeryShortCodesContainer {
}
class WPBakeryShortCode_sh_blockquote_text extends WPBakeryShortCode {
}


function sh_custom_css_classes_for_vc_row_and_vc_column($class_string, $tag)
{
	$dir = ABSPATH . 'wp-content/plugins/js_composer/js_composer.php';
	$vc = get_plugin_data( $dir, $markup = true, $translate = true );
	
	if ($tag=='vc_row' || $tag=='vc_row_inner') {
    	//$class_string = str_replace('vc_row wpb_row vc_inner vc_row-fluid', '', $class_string);
		return;
  	}
	
	if ( $vc['Version'] <= '4.3.1' )
	{
		if( $tag=='vc_column' || $tag=='vc_column_inner' )
		{
			$class_string = str_replace('vc_span1', 'col-md-1', $class_string);
			$class_string = str_replace('vc_span2', 'col-md-2', $class_string);
			$class_string = str_replace('vc_span3', 'col-md-3', $class_string);
			$class_string = str_replace('vc_span4', 'col-md-4', $class_string);
			$class_string = str_replace('vc_span5', 'col-md-5', $class_string);
			$class_string = str_replace('vc_span6', 'col-md-6', $class_string);
			$class_string = str_replace('vc_span7', 'col-md-7', $class_string);
			$class_string = str_replace('vc_span8', 'col-md-8', $class_string);
			$class_string = str_replace('vc_span9', 'col-md-9', $class_string);
			$class_string = str_replace('vc_span10', 'col-md-10', $class_string);
			$class_string = str_replace('vc_span11', 'col-md-11', $class_string);
			$class_string = str_replace('vc_span12', 'col-md-12', $class_string);
		}
	}
	else
	{
		if ( $tag=='vc_column' || $tag=='vc_column_inner' )
		{
			$class_string = str_replace('vc_col-sm-1', 'col-md-1', $class_string);
			$class_string = str_replace('vc_col-sm-2', 'col-md-2', $class_string);
			$class_string = str_replace('vc_col-sm-3', 'col-md-3', $class_string);
			$class_string = str_replace('vc_col-sm-4', 'col-md-4', $class_string);
			$class_string = str_replace('vc_col-sm-5', 'col-md-5', $class_string);
			$class_string = str_replace('vc_col-sm-6', 'col-md-6', $class_string);
			$class_string = str_replace('vc_col-sm-7', 'col-md-7', $class_string);
			$class_string = str_replace('vc_col-sm-8', 'col-md-8', $class_string);
			$class_string = str_replace('vc_col-sm-9', 'col-md-9', $class_string);
			$class_string = str_replace('vc_col-sm-10', 'col-md-10', $class_string);
			$class_string = str_replace('vc_col-sm-11', 'col-md-11', $class_string);
			$class_string = str_replace('vc_col-sm-12', 'col-md-12', $class_string);
		}
	}
    return $class_string;
}
// Filter to Replace default css class for vc_row shortcode and vc_column
add_filter('vc_shortcodes_css_class', 'sh_custom_css_classes_for_vc_row_and_vc_column', 10, 2);
function vc_theme_vc_row($atts, $content = null)
{
    extract(shortcode_atts(array(
        'el_class' => '',
        'bg_image' => '',
        'bg_color' => '',
        'bg_image_repeat' => '',
        'font_color' => '',
        'posts_grid' => '',
        'padding' => '',
        'margin_bottom' => '',
        'container' => '',
        'gap' => '',
        'parallax' => '',
        'parallax_clr' => '',
        'parallax_bg' => '',
		'top_margin' => '',
		'bottom_margin' => '',
		'col_title' => '',
		'heading_style' => '',
		'pattren' => '',
		'sub_title' => '',
    ), $atts));
    $atts['base'] = '';
    wp_enqueue_style('js_composer_front');
    wp_enqueue_script('wpb_composer_front_js');
    wp_enqueue_style('js_composer_custom_css');
    $vc_row = new WPBakeryShortCode_VC_Row($atts);
    $el_class = $vc_row->getExtraClass($el_class);
    $output = '';
    $css_class = $el_class;
    $style = $vc_row->buildStyle($bg_image, $bg_color, $bg_image_repeat, $font_color, $padding, $margin_bottom);
    $output .= '<section class="block ' . $el_class . '';
	if($top_margin): $output .= ' remove-top'; endif;
	if($bottom_margin):  $output .= ' remove-bottom'; endif;
	$output .= '"><div class="container">';
    if ($parallax == 'true'):
        if ($parallax_bg):
            $img = wp_get_attachment_image_src($parallax_bg, 'full');
        else:
            $img = array('0' => '');
        endif;
        $output .= '<div class="fixed';
		if( $pattren == 1 ): $output .= ' pattern '; endif;
		$output .= ' ' . $parallax_clr . '" style="background:url(' . $img[0] . ');"></div>';
    endif;
	$output .= '<div class="row">';
	if( $heading_style !='' && $col_title != '' ):
		$output .= '<div class="col-md-12">';  
		$con = explode(' ', $col_title, 2);
		if( $heading_style == 'sec-heading' )
		{
			$output .='<div class="'.$heading_style.'">
						<h2><strong>'.sh_set($con, '0').'</strong> '.sh_set($con, '1').'</h2>
					</div>';
		}else if( $heading_style == 'sec-title' ){
			$output .='<div class="'.$heading_style.'">
						<h2><span>'.sh_set($con, '0').'</span> '.sh_set($con, '1').'</h2>
					</div>';
		}else if( $heading_style == 'sec-heading2' ){
			$output .='<div class="'.$heading_style.'">
						<h2>'.sh_set($con, '0').' <strong> '.sh_set($con, '1').'</strong></h2>
					</div>';
		}else if( $heading_style == 'sec-heading3' ){
			$output .='<div class="'.$heading_style.'">
						<h5>'.$sub_title.' </h5><h1> '.$col_title.'</h1>
					</div>';
		}else if( $heading_style == 'parallax' ){
			$output .='<div class="sec-heading3">
						<h2> '.$col_title.'</h2>
					</div>';
		}else if( $heading_style == 'sec-heading4' ){
			$output .='<div class="sec-heading4">
						<h2>'.sh_set($con, '0').' <span>'.sh_set($con, '1').'</span></h2>
						<p>'.$sub_title.'</p>
					</div>';
		}
		$output .= '</div>';  
	endif;
    $output .= wpb_js_remove_wpautop($content);
	$output .= '</div></div></section>';
    return $output;
}
function vc_theme_vc_column($atts, $content = null)
{
    extract(shortcode_atts(array('width' => '1/1', 'el_class' => '', 'col_title' =>'', 'sub_title' =>'', 'heading_style'=>''), $atts));
    $width = wpb_translateColumnWidthToSpan($width);
	$dir = ABSPATH . 'wp-content/plugins/js_composer/js_composer.php';
	$vc = get_plugin_data( $dir, $markup = true, $translate = true );
	
	if ( $vc['Version'] <= '4.3.1' )
	{
    	$width = str_replace( 'vc_span', 'col-md-', $width .' column' );
	}
	else
	{
		$width = str_replace( 'vc_col-sm-', 'col-md-', $width .' column' );
	}
	
    $el_class = ($el_class) ? ' ' . $el_class : '';
    $output = '<div class="' . $width . '">';
	if( $heading_style !='' && $col_title != '' ):  
		$con = explode(' ', $col_title, 2);
		if( $heading_style == 'sec-heading' )
		{
			$output .='<div class="'.$heading_style.'">
						<h2><strong>'.sh_set($con, '0').'</strong> '.sh_set($con, '1').'</h2>
					</div>';
		}else if( $heading_style == 'sec-title' ){
			$output .='<div class="'.$heading_style.'">
						<h2><span>'.sh_set($con, '0').'</span> '.sh_set($con, '1').'</h2>
					</div>';
		}else if( $heading_style == 'sec-heading2' ){
			$output .='<div class="'.$heading_style.'">
						<h2>'.sh_set($con, '0').' <strong> '.sh_set($con, '1').'</strong></h2>
					</div>';
		}else if( $heading_style == 'sec-heading3' ){
			$output .='<div class="'.$heading_style.'">
						<h5>'.$sub_title.' </h5><h1> '.$col_title.'</h1>
					</div>';
		}else if( $heading_style == 'parallax' ){
			$output .='<div class="sec-heading3">
						<h2> '.$col_title.'</h2>
					</div>';
		}else if( $heading_style == 'sec-heading4' ){
			$output .='<div class="sec-heading4">
						<h2>'.sh_set($con, '0').' <span>'.sh_set($con, '1').'</span></h2>
						<p>'.$sub_title.'</p>
					</div>';
		}
	endif;
    $output .= do_shortcode($content);
    $output .= '</div>';
    return $output;
}
$title = array(
	"type" => "textfield",
	"holder" => "div",
	"class" => "",
	"heading" => __("Enter the Title", SH_NAME),
	"param_name" => "col_title",
	"description" => __("Enter the title of this section.", SH_NAME)
);
$sub_title = array(
	"type" => "textfield",
	"holder" => "div",
	"class" => "",
	"heading" => __("Enter the Sub Title", SH_NAME),
	"param_name" => "sub_title",
	"description" => __("Enter the Sub title of this section. This is only work for Title with Subtitle heading style.", SH_NAME)
);
$heading_style = array(
	"type" => "dropdown",
	"holder" => "div",
	"class" => "",
	"heading" => __("Heading Style", SH_NAME),
	"param_name" => "heading_style",
	"value" => array( '' => '',  __('Title for Parallax', SH_NAME ) => 'parallax', __('Underline Title', SH_NAME ) => 'sec-heading', __('Modern Style', SH_NAME) => 'sec-title', __('Doubble Border Title', SH_NAME ) => 'sec-heading2', __('Title with Subtitle', SH_NAME) => 'sec-heading3', __('Innovative 2015', SH_NAME) => 'sec-heading4'),
	"description" => __("Choose the Heading style You want to choose.", SH_NAME)
);
$parallax = array(
	"type" => "dropdown",	
	"holder" => "div",	
	"class" => "",	
	"heading" => __("Parallax", SH_NAME),	
	"param_name" => "parallax",	
	"value" => array( 'False'=>'false', 'True'=>'true'),
	"description" => __("Make this section as parallax.", SH_NAME)
);
$parallax_clr = array(
    "type" => "dropdown",
    "holder" => "div",
    "class" => "",
    "heading" => __("Parallax Style", SH_NAME),
    "param_name" => "parallax_clr",
    "value" => array( __('No Layer', SH_NAME ) => 'no-layer', __('Whitish', SH_NAME ) => 'whitish', __('Blackish', SH_NAME) => 'blackish'),
    "description" => __("Chose Style for Parallax.", SH_NAME)
);
$parallax_img = array(
    "type" => "attach_image",
    "holder" => "div",
    "class" => "",
    "heading" => __("Parallax Background", SH_NAME),
    "param_name" => "parallax_bg",
    "description" => __("Make this section as parallax.", SH_NAME)
);
$top_margin = array(
    "type" => "checkbox",
    "holder" => "div",
    "class" => "",
    "heading" => __("Top Margin", SH_NAME),
    "param_name" => "top_margin",
	"value" => array('Top Margin'=> true),
    "description" => __("Remove top margin of this section.", SH_NAME)
);
$patren = array(
    "type" => "checkbox",
    "holder" => "div",
    "class" => "",
    "heading" => __("Pattern", SH_NAME),
    "param_name" => "pattren",
	"value" => array('Show Pattern'=> true),
    "description" => __("Check this if you are choosing some pattern as background.", SH_NAME)
);
$bottom_margin = array(
    "type" => "checkbox",
    "holder" => "div",
    "class" => "",
    "heading" => __("Bottom Margin", SH_NAME),
    "param_name" => "bottom_margin",
	"value" => array('Bottom Margin'=> true),
    "description" => __("Remove bottom margin of this section.", SH_NAME)
);
vc_add_param('vc_column', $title);
vc_add_param('vc_column', $sub_title);
vc_add_param('vc_column', $heading_style);
vc_add_param('vc_row', $title);
vc_add_param('vc_row', $sub_title);
vc_add_param('vc_row', $heading_style);
vc_add_param('vc_row', $parallax);
vc_add_param('vc_row', $parallax_clr);
vc_add_param('vc_row', $parallax_img);
vc_add_param('vc_row', $patren);
vc_add_param('vc_row', $top_margin);
vc_add_param('vc_row', $bottom_margin);