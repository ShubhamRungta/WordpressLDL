<?php
class SH_Enqueue
{
	function __construct()
	{
		add_action( 'wp_enqueue_scripts', array( $this, 'sh_enqueue_scripts' ), 99 );
		add_action( 'wp_head', array( $this, 'wp_head' ) );
		add_action( 'wp_footer', array( $this, 'wp_footer' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'sh_load_wp_media_files' ) );
	}
	function sh_load_wp_media_files() 
	{
	  wp_enqueue_media();
	}
	function sh_enqueue_scripts()
	{
		$options = get_option(SH_NAME);
		$protocol = is_ssl() ? 'https' : 'http';
		$styles = array( 'google_fonts' => $protocol.'://fonts.googleapis.com/css?family=Roboto:400,900italic,700italic,900,700,500italic,500,400italic,300italic,300,100italic,100|Open+Sans:400,300,400italic,300italic,600,600italic,700italic,700,800|Source+Sans+Pro:400,200,200italic,300,300italic,400italic,600,600italic,700',
						 'bootstrap' => 'css/bootstrap.css', 
						 'font-awesome2' => 'font-awesome/css/font-awesome.css',
						 'main_style' => 'style.css',
						 //'sea-green' => 'css/sea-green.css',
						 
						 //'color' => 'css/color.css'
		);
		$styles = $this->custom_fonts($styles);
		foreach( $styles as $name => $style )
		{
			if(strstr($style, 'http') || strstr($style, 'https') ) wp_enqueue_style( $name, $style);
			else wp_enqueue_style( $name, SH_URL.$style);
		}
		
		$rtl_settings =  get_option(SH_NAME);
		
		if(sh_set($rtl_settings , 'layout_responsive_width') == '') wp_enqueue_style('layput_default_width' , SH_URL.'css/style1.css', array() );
		if(sh_set($rtl_settings , 'layout_responsive_width') == '1040') wp_enqueue_style('layput_default_width' , SH_URL.'css/style2.css' );
		elseif(sh_set($rtl_settings , 'layout_responsive_width') == '960') wp_enqueue_style('layput_default_width' , SH_URL.'css/style3.css' );
		if(sh_set($rtl_settings , 'sh_rtl') == 'true') wp_enqueue_style( 'rtl_syle', SH_URL.'css/rtl.css');	
		if( sh_set( $options, 'layout_responsive_options')== 'true') wp_enqueue_style( 'rtl_syle', SH_URL.'css/responsive.css');
		
		wp_enqueue_style( 'sea-green', SH_URL.'css/sea-green.css');
		wp_enqueue_style( 'color', SH_URL.'css/color.css');
		
		$scripts = array( 'testimonials' => 'testimonials.js', 
						  'bootstrap' => 'bootstrap.js', 
						  'html5lightbox' => 'html5lightbox.js',
						  'html5shiv'	=> 'html5shiv.js',
						  'jquery-countdown-min' => 'jquery.countdown.min.js',						  
						  'jquery-plugins' => 'jquery.plugin.min.js',
						  'jquery-easing-1_3' => 'layerslider/JQuery/jquery-easing-1.3.js',
						  'jquery-customSelect' => 'jquery.customSelect.min.js',
						  'flexSlider' 		=> 'jquery.flexslider.js',
						  'carofredcsel' => 'jquery.carouFredSel-6.2.1-packed.js',						  
						  'flickrjs'=>'jflickrfeed.min.js' ,						  
						  'jquery_mousewheel'=> 'jquery.mousewheel.js',
						  'jquery-jigowatt' => 'jquery.jigowatt.js',						  						  
						  'jquery_isotope' => 'jquery.isotope.min.js',
						  'waypoints' => 'waypoints.js',
						  'counterup' => 'jquery.counterup.min.js',	
						  'countdown' => 'jquery.countdown.min.js',
						  'Jq-plugin' => 'jquery.plugin.min.js',
						  'downCount' => 'jquery.downCount.js',						  
						  'custom_script' => 'script.js',
						 );
		foreach( $scripts as $name => $js )
		{
			wp_register_script( $name, SH_URL.'js/'.$js, '', '', true);
			
		}
		wp_enqueue_script('jquery');
		wp_enqueue_script(array('testimonials' , 'bootstrap' ,'html5lightbox', 'html5shiv', 'jquery-easing-1_3' , 'flexSlider'  ,  'jquery-jigowatt' ,  'jquery_mousewheel' ,  'jquery-customSelect' , 'flickrjs' , 'waypoints' , 'counterup' , 'Jq-plugin', 'countdown', 'downCount', 'custom_script' ) );
		
		if( is_singular() ) wp_enqueue_script('comment-reply');
	}
	
	function wp_head()
	{
		echo '<script type="text/javascript"> if( ajaxurl === undefined ) var ajaxurl = "'.admin_url('admin-ajax.php').'";</script>';?>
		<style type="text/css">
			<?php
			echo sh_get_font_settings( array( 'body_font_family' => 'font-family', ), 'body, p {', '}' );
			echo sh_get_font_settings( array( 'h1_font_family' => 'font-family',  ), 'h1 {', '}' );
			echo sh_get_font_settings( array( 'h2_font_family' => 'font-family',  ), 'h2 {', '}' );
			echo sh_get_font_settings( array( 'h3_font_family' => 'font-family',  ), 'h3 {', '}' );
			echo sh_get_font_settings( array( 'h4_font_family' => 'font-family',  ), 'h4 {', '}' );
			echo sh_get_font_settings( array( 'h5_font_family' => 'font-family',  ), 'h5 {', '}' );
			echo sh_get_font_settings( array( 'h6_font_family' => 'font-family',  ), 'h6 {', '}' );
			?>
		</style>
		<?php 
		$settings = get_option(SH_NAME);
		$custom_css = sh_set($settings , 'custom_css');
		echo '<style>'.$custom_css.'</style>'; 
		echo sh_theme_color_scheme();
	}
	function wp_footer()
	{
		$footer = get_option(SH_NAME);
		$analytic = sh_set( $footer, 'footer_analytics' );
		if( $analytic )
		{
			echo '<script>'.$analytic.'</script>';
		}
	}
	
	function custom_fonts( $styles )
	{
		$opt = get_option(SH_NAME);
		$protocol = ( is_ssl() ) ? 'https' : 'http';
		$font = array();
		//$font_options = array('h1_font_family', 'h2_font_family', 'h3_font_family');
		
		//if( sh_set( $opt, 'use_custom_font' ) ){
			
			if( $h1 = sh_set( $opt, 'h1_font_family' ) ) $font[$h1] = urlencode( $h1 ).':400,300,600,700,800';
			if( $h2 = sh_set( $opt, 'h2_font_family' ) ) $font[$h2] = urlencode( $h2 ).':400,300,600,700,800';
			if( $h3 = sh_set( $opt, 'h3_font_family' ) ) $font[$h3] = urlencode( $h3 ).':400,300,600,700,800';
			if( $h4 = sh_set( $opt, 'h4_font_family' ) ) $font[$h4] = urlencode( $h4 ).':400,300,600,700,800';
			if( $h5 = sh_set( $opt, 'h5_font_family' ) ) $font[$h5] = urlencode( $h5 ).':400,300,600,700,800';
			if( $h6 = sh_set( $opt, 'h6_font_family' ) ) $font[$h6] = urlencode( $h6 ).':400,300,600,700,800';
			if( $grey = sh_set( $opt, 'grey_area_font_family' ) ) $font[$grey] = urlencode( $grey ).':400,300,600,700,800';
			if( $footer = sh_set( $opt, 'footer_font_family' ) ) $font[$footer] = urlencode( $footer ).':400,300,600,700,800';
		//}
		
		//if( sh_set( $opt, 'body_custom_font' ) ){
			if( $body = sh_set( $opt, 'body_font_family' ) ) $font[$body] = urlencode( $body ).':400,300,600,700,800';
		//}
		
		if( $font ) $styles['sh_google_custom_font'] = $protocol.'://fonts.googleapis.com/css?family='.implode('|', $font);
		//printr($styles);
		return $styles;
	}
}