<?php
define('DOMAIN' , 'wp_lifeline');
define('SH_NAME', 'wp_lifeline');
define('SH_VERSION', 'v3.0.1');
define('SH_ROOT', get_template_directory().'/');
define('SH_URL', get_template_directory_uri().'/');
get_template_part('framework/loader');

add_action('after_setup_theme', 'sh_theme_setup');
if(!session_id()) session_start();
function sh_theme_setup()
{
	global $wp_version;
	sh_create_donation_table();
	load_theme_textdomain(SH_NAME, get_template_directory() . '/languages');
	add_editor_style();
	add_theme_support('post-thumbnails');
	add_theme_support('woocommerce');
	add_theme_support('menus'); //Add menu support
	add_theme_support('automatic-feed-links'); //Enables post and comment RSS feed links to head.
	add_theme_support('widgets'); //Add widgets and sidebar support
	/** Register wp_nav_menus */
	add_theme_support( "custom-header");
	add_theme_support( "custom-background");

	
	
	if(function_exists('register_nav_menu'))
	{
		register_nav_menus(
			array(
				/** Register Main Menu location header */
				'main_menu' => __('Main Menu', SH_NAME),
				'footer_menu' => __('Footer Menu', SH_NAME),
			)
		);
	}
	if ( ! isset( $content_width ) ) $content_width = 960;
	$ThumbSize = array( '370x491', '1170x455', '370x252' , '270x155' , '570x570' , '150x150' , '570x184' , '1170x312', '80x80', '470x318', '570x353');
	foreach( $ThumbSize as $v )
	{
		$explode = explode( 'x', $v );
		add_image_size( $v, $explode[0], $explode[1], true );
	}
	if(isset($_POST['recurring_pp_submit'])){
		require_once(get_template_directory().'/framework/modules/pp_recurring/expresscheckout.php');
	}
}
function sh_widget_init()
{
	register_widget( 'SH_people_reviews' );
	register_widget( 'SH_Flickr' );
	register_widget( 'SH_Contact_Us' );
	register_widget( 'SH_News_Letter_Subscription' );
	register_widget( 'SH_Galleries' );
	register_widget( 'SH_Popular_Posts' );
	register_widget( 'SH_Recent_Events' );
	register_widget( 'SH_Video' );
	register_widget( 'SH_Donate_Us' );
	register_widget( 'sh_categories' );
	global $wp_registered_sidebars;
	register_sidebar( array(
					  'name' => __( 'Default Sidebar', SH_NAME ),
					  'id' => 'default-sidebar',
					  'description' => __( 'Widgets in this area will be shown on the right-hand side.', SH_NAME ),
					  'class'=>'',
					  'before_widget'=>'<div id="%1$s" class="sidebar-widget %2$s">',
					  'after_widget'=>'</div>',
					  'before_title' => '<div class="sidebar-title"><h4>',
					  'after_title' => '</h4></div>'
	) );
	register_sidebar(array(
	  'name' => __( 'Blog Listing', SH_NAME ),
	  'id' => 'blog-sidebar',
	  'description' => __( 'Widgets in this area will be shown on the right-hand side.', SH_NAME ),
	  'class'=>'',
	  'before_widget'=>'<div id="%1$s" class="sidebar-widget %2$s">',
	  'after_widget'=>'</div>',
	  'before_title' => '<div class="sidebar-title"><h4>',
	  'after_title' => '</h4></div>'
	));
	register_sidebar( array(
					  'name' => __( 'Footer Sidebar', SH_NAME ),
					  'id' => 'footer-sidebar',
					  'description' => __( 'Widgets in this area will be shown on the right-hand side.', SH_NAME ),
					  'class'=>'quick-menu',
					  'before_widget'=>'<div class="col-md-3">',
					  'after_widget'=>'</div>',
					  'before_title' => '<div class="footer-widget-title"><h4>',
					  'after_title' => '</h4></div>'
	) );
	$sidebars = sh_set( get_option(SH_NAME), 'dynamic_sidebars' );//printr($sidebars);
	foreach( array_filter((array)$sidebars) as $sidebar)
	{
		register_sidebar( array(
			'name' => $sidebar,
			'id' => bistro_slug( $sidebar ),
			'before_widget' => '<div id="%1$s" class="sidebar-widget %2$s">',
			'after_widget' => "</div>",
			'before_title' => '<div class="sidebar-title"><h4>',
			'after_title' => '</h4></div>',
		) );		
	}
	update_option('wp_registered_sidebars', $wp_registered_sidebars);
}
add_action( 'widgets_init', 'sh_widget_init' );
function sh_custom_header()
{
	$settings = get_option(SH_NAME);
	$HeaderName = ( sh_set($settings , 'custom_header') !== 'dafault' ) ? sh_set($settings , 'custom_header'): '';
	//if(is_page(1160)): $HeaderName = NULL; $HeaderName = 'header-counter'; endif;
	get_header( $HeaderName );
}
function get_price_html( $price = '' ) 
{
	global $product;
	// Ensure variation prices are synced with variations
	if ( $product->min_variation_price === '' || $product->min_variation_regular_price === '' || $product->price === '' )
	//$product->variable_product_sync();
	// Get the price
	if ( $product->price > 0 ) 
	{
		if ( $product->is_on_sale() && isset( $product->min_variation_price ) && $product->min_variation_regular_price !== $product->get_price() ) 
		{
			if ( ! $product->min_variation_price || $product->min_variation_price !== $product->max_variation_price )
			$price .= $product->get_price_html_from_text();
			$price .= $product->get_price_html_from_to( $product->min_variation_regular_price, $product->get_price() );
			$price = apply_filters( 'woocommerce_variable_sale_price_html', $price, $product );
		} 
		else 
		{
			if ( $product->min_variation_price !== $product->max_variation_price )
			$price .= $product->get_price_html_from_text();
			$price .= woocommerce_price( $product->get_price() );
			$price = apply_filters('woocommerce_variable_price_html', $price, $product);
		}
	} 
	elseif ( $product->price === '' ) 
	{
		$price = apply_filters('woocommerce_variable_empty_price_html', '', $product);
	} 
	elseif ( $product->price == 0 ) 
	{
		if ( $product->is_on_sale() && isset( $product->min_variation_regular_price ) && $product->min_variation_regular_price !== $product->get_price() ) 
		{
			if ( $product->min_variation_price !== $product->max_variation_price )
			$price .= $product->get_price_html_from_text();
			
			$price .= $product->get_price_html_from_to( $product->min_variation_regular_price, __( 'Free!', 'woocommerce' ) );
			
			$price = apply_filters( 'woocommerce_variable_free_sale_price_html', $price, $product );
		} 
		else 
		{
			if ( $product->min_variation_price !== $product->max_variation_price )
			$price .= $product->get_price_html_from_text();
			$price .= __( 'Free!', 'woocommerce' );
			$price = apply_filters( 'woocommerce_variable_free_price_html', $price, $product );
		}
	}
	return apply_filters( 'woocommerce_get_price_html', $price, $product );
}

function donation_box()
{
	$paypal = $GLOBALS['_sh_base']->donation;
	$donation_data = get_option(SH_NAME);
	$symbol = (sh_set($donation_data , 'paypal_currency')) ? sh_set($donation_data , 'paypal_currency') : '$';
	$percent = (sh_set($donation_data , 'paypal_target')) ? (int)str_replace(',', '', sh_set($donation_data , 'paypal_raised')) / (int)str_replace(',', '', sh_set(				$donation_data , 'paypal_target')) : 0;
	$donation_percentage = $percent*100;
	$settings = get_option(SH_NAME);
	$sh_currency_code = sh_set( $settings, 'currency_code', 'USD' );	
	$paypal_res =require_once(get_template_directory().'/framework/modules/pp_recurring/review.php');
	$return_url = (is_home()) ? home_url() : get_permalink();
	
	$output = '';
	$output.='<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">';
		if(isset($_GET['recurring_pp_return']) && $_GET['recurring_pp_return'] == 'return'){
			
				$output .='<div class="donate-popup">'.$paypal_res.'</div>';
				
				$output .='<script>
								jQuery(document).ready(function($){
									$(".donate-us-box a.donate-btn").trigger("click");
									var popup = $("div.confirm_popup");
									$(popup).parent().css({"border-top": "none"});
								
								});
						</script>';
			
				
		}
		elseif($notif = $paypal->_paypal->handleNotification() && isset($notif->ok)){
			
			$output .='<div class="donate-popup">'.$paypal_res.'</div>';
				
				$output .='<script>
								jQuery(document).ready(function($){
									$(".donate-us-box a.donate-btn").trigger("click");
								
								});
						</script>';
		}
	else{
	$Settings = get_option(SH_NAME); 
	//printr($Settings);
	$value = sh_set($Settings , 'transactions_detail');	
	$output .='<div class="donate-popup">
		<div class="cause-bar">
			<div class="cause-box"><h3><span>'.$symbol.'</span>'.sh_set($donation_data , 'paypal_target').'</h3><i>'.__('NEEDED DONATION', SH_NAME).'</i></div>
			<div class="cause-progress">
					<div class="progress-report">
					<h6>'.__('PHASES', SH_NAME).'</h6>
					<span>'.$donation_percentage.'%</span>
					<div class="progress pattern">
						<div class="progress-bar" style="width: '.$donation_percentage.'%"></div>
					</div>
				</div>
			</div>
			<div class="cause-box"><h3><span>'.$symbol.'</span>'.sh_set( $donation_data , 'paypal_raised').'</h3><i>'.__('COLLECTED DONATION', SH_NAME).'</i></div>
			<div class="cause-box donate-drop-btn"><h4>'.__('DONATE NOW', SH_NAME).'</h4></div>
		</div>
		<div class="donate-drop-down">
			<div class="recursive-periods" align="center">';
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
			
				$output .='</div><div class="other-amount">
					'.$paypal->button(array('currency_code'=>$sh_currency_code,'item_name'=>get_bloginfo('name'), 'amount'=>30, 'return'=>$return_url)).'
				</div>';
			//printr($paypal);
			
			if(!is_user_logged_in())
			{
				$output.='<form id="login" action="" method="post">
						<h1>Please Login OR Register first to make recursive donation</h1>
						<p class="status"></p>
						<label for="username">Username</label>
						<input id="username" type="text" name="username">
						<label for="password">Password</label>
						<input id="password" type="password" name="password">
						<a class="lost" href="'.wp_registration_url().'">Register Now</a>
						<input class="submit_button" type="submit" value="Login" name="submit">
						<a class="close" href="">(close)</a>
						'.wp_nonce_field( 'ajax-login-nonce', 'security' ).'
					</form>';
			}
			$output.='</div>
			</div>
		</div>';
	}
		$output.='</div>';
		return $output;
}
		
add_action('wp_ajax_theme-install-demo-data', 'theme_ajax_install_dummy_data');
function theme_ajax_install_dummy_data(){
	require_once('framework/helpers/importer.php');
	sh_xml_importer();
  	die();
}

remove_filter( 'nav_menu_description', 'strip_tags' );
function sh_setup_nav_menu_item( $menu_item ) {
    if ( isset( $menu_item->post_type ) ) {
        if ( 'nav_menu_item' == $menu_item->post_type ) {
            $menu_item->description = apply_filters( 'nav_menu_description', $menu_item->post_content );
        }
    }
	
    return $menu_item;
}
add_filter( 'wp_setup_nav_menu_item', 'sh_setup_nav_menu_item' );

//responsive menu
function sh_responsive_menu()
{
	$settings = get_option(SH_NAME);
	?>
    	<div class="responsive-header">
        	<div class="responsive-logo"> 
				<?php
				if( isset( $settings['logo_text_status'] ) && $settings['logo_text_status'] === 'true' )
				{
					$LogoStyle = sh_get_font_settings( array( 'logo_text_font_size' => 'font-size', 'logo_text_font_family' => 'font-family', 'logo_text_font_style' => 'font-style', 'logo_text_color' => 'color' ), ' style="', '"' );
					$Logo = $settings['logo_text'];
				}
				else
				{
					$LogoStyle = '';
					$LogoImageStyle = ( sh_set( $settings, 'logo_width' ) || sh_set( $settings, 'logo_height' ) ) ? ' style="': '';
					$LogoImageStyle .= ( sh_set( $settings, 'logo_width' ) ) ? ' width:'.sh_set( $settings, 'logo_width' ).'px;': '';
					$LogoImageStyle .= ( sh_set( $settings, 'logo_height' ) ) ? ' height:'.sh_set( $settings, 'logo_height' ).'px;': '';
					$LogoImageStyle .= ( sh_set( $settings, 'logo_width' ) || sh_set( $settings, 'logo_height' ) ) ? '"': '';
					$Logo = '<img src="'.$settings['logo_image'].'" alt=""'.$LogoImageStyle.' />';
				}
				?>
				 <a href="<?php echo home_url(); ?>" title="<?php bloginfo('name'); ?>"<?php echo $LogoStyle;?>>
					<?php echo $Logo;?>
				</a>
				<?php
				if( sh_set( $settings, 'logo_text_status' ) === 'true' && sh_set( $settings, 'site_salogan' ) )
				{
					$SaloganStyle = sh_get_font_settings( array( 'salogan_font_size' => 'font-size', 'salogan_font_family' => 'font-family', 'salogan_font_style' => 'font-style' ), ' style="', '"' );
					echo '<p'.$SaloganStyle.'>'.$settings['site_salogan'].'</p>';
				}
				?>
			</div>
            <span><i class="icon-align-justify"></i></span>
            <?php wp_nav_menu( array( 'theme_location' => 'main_menu', 'menu_class' => '', 'container'=>null, 'menu_id' => '', 'fallback_cb' => false, 'walker' => new SH_Megamenu_walker ) ); ?>
        </div>
    <?php
}

function sh_woo_pages( $page_id )
{
	$pages = array(
		get_option( 'woocommerce_shop_page_id' ), 
		get_option( 'woocommerce_cart_page_id' ), 
		get_option( 'woocommerce_checkout_page_id' ),
		get_option( 'woocommerce_pay_page_id' ),
		get_option( 'woocommerce_thanks_page_id' ),
		get_option( 'woocommerce_myaccount_page_id' ), 
		get_option( 'woocommerce_edit_address_page_id' ), 
		get_option( 'woocommerce_view_order_page_id' ), 
		get_option( 'woocommerce_terms_page_id' ) 
	);	
	return ( in_array( $page_id, $pages ) ) ? 'true' : 'false';
}

function sh_search_filter( $query )
{
	if ( !$query->is_admin && $query->is_search)
	{
		$query->set('post_type', array( 'post', 'dict_testimonials', 'dict_causes', 'dict_project', 'dict_event', 'dict_portfolio', 'dict_gallery', 'dict_team', 'dict_services' ) );
	}
	return $query;
}
add_filter( 'pre_get_posts', 'sh_search_filter' );

function admin_donwload_pdf(){ 
	if( $_POST['action'] == 'admin_donwload_pdf' )
	{ 
		$data_id = sh_set( $_POST, 'data_id');
		$transaction_array = get_option('general_donation');
		$settings = get_option(SH_NAME);
		$user_ID = get_current_user_id();
		$img = sh_set( $settings, 'logo_image' );
		$user = get_userdata($user_ID);
		require('pdf/fpdf.php');
		$pdf = new FPDF();
		$pdf->AddPage();
		if( !empty($img) ): $pdf->Image( $img, 70, 7, 61, 15 );endif;
		$pdf->SetDrawColor(177, 218, 227); // Hot Pink
		$pdf->Line(208, 25, 2, 25);
		$pdf->SetAutoPageBreak(true, 0);
		$pdf->AliasNbPages();
		$pdf->SetFont('helvetica', 'B', '10');		
		
		$pdf->Ln(25);
		$pdf->Cell(100,0,__('Name:', SH_NAME));
		$pdf->Cell(100,0,$user->user_nicename);
		$pdf->Ln(2);
		$pdf->SetDrawColor(177, 218, 227);
		$pdf->SetLineWidth(1);
		$pdf->Rect(2, 40, 206, 80, 'D');
		if( !empty( $transaction_array ) )
		{
			foreach($transaction_array as $trasaction):
				if( in_array( $data_id, $trasaction) )
				{
					$pdf->MultiCell(150,20,__('Transacction ID:', SH_NAME), 0, 'L');
					$pdf->MultiCell(150,-20,sh_set($trasaction, 'transaction_id'), 0, 'R');
					
					$pdf->MultiCell(150,30,__('Transacction Type:', SH_NAME), 0, 'L');
					$pdf->MultiCell(150,-30,sh_set($trasaction, 'transaction_type'), 0, 'R');
					
					$pdf->MultiCell(150,40,__('Payment Type:', SH_NAME), 0, 'L');
					$pdf->MultiCell(150,-40,sh_set($trasaction, 'payment_type'), 0, 'R');
					
					$pdf->MultiCell(150,50,__('Order Time:', SH_NAME), 0, 'L');
					$pdf->MultiCell(150,-50,sh_set($trasaction, 'order_time'), 0, 'R');
					
					$pdf->MultiCell(150,60,__('Amount:', SH_NAME), 0, 'L');
					$pdf->MultiCell(150,-60,sh_set($trasaction, 'amount'), 0, 'R');	
					
					$pdf->MultiCell(150,70,__('Currency Code:', SH_NAME), 0, 'L');
					$pdf->MultiCell(150,-70,sh_set($trasaction, 'currency_code'), 0, 'R');
					
					$pdf->MultiCell(150,80,__('Fee Amount:', SH_NAME), 0, 'L');
					$pdf->MultiCell(150,-80,sh_set($trasaction, 'fee_amount'), 0, 'R');
					
					$pdf->MultiCell(150,90,__('Settle Amount:', SH_NAME), 0, 'L');
					$pdf->MultiCell(150,-90,sh_set($trasaction, 'settle_amount'), 0, 'R');
					
					$pdf->MultiCell(150,100,__('Tax Amount:', SH_NAME), 0, 'L');
					$pdf->MultiCell(150,-100,sh_set($trasaction, 'tax_amount'), 0, 'R');
					
					$pdf->MultiCell(150,110,__('Exchange Rate:', SH_NAME), 0, 'L');
					$pdf->MultiCell(150,-110,sh_set($trasaction, 'exchange_rate'), 0, 'R');
					
					$pdf->MultiCell(150,120,__('Payment Status:', SH_NAME), 0, 'L');
					$pdf->MultiCell(150,-120,sh_set($trasaction, 'payment_status'), 0, 'R');	
					
					$pdf->MultiCell(150,130,__('Pendign Reason:', SH_NAME), 0, 'L');
					$pdf->MultiCell(150,-130,sh_set($trasaction, 'pending_reason'), 0, 'R');
					
					$pdf->MultiCell(150,140,__('Reason Code:', SH_NAME), 0, 'L');
					$pdf->MultiCell(150,-140,sh_set($trasaction, 'reason_code'), 0, 'R');
					
					$pdf->MultiCell(150,150,__('Donation Type:', SH_NAME), 0, 'L');
					$pdf->MultiCell(150,-150,sh_set($trasaction, 'donation_type'), 0, 'R');			
				}
			endforeach;
		}
		$pdf->Output( SH_ROOT.$user_ID.'_filename.pdf', 'F');
 		die();
	}
}

add_action( 'wp_ajax_admin_donwload_pdf', 'admin_donwload_pdf' );
add_action( 'wp_ajax_nopriv_admin_donwload_pdf', 'admin_donwload_pdf' );


function vp_get_posts_custom( $post_tyep )
{
	$args=array(
	  'post_type' => $post_tyep,
	  'post_status' => 'publish',
	  'posts_per_page' => -1,
	);
	
	$result = array();
	$my_query = null;
	$my_query = new WP_Query($args);
	if( $my_query->have_posts() ) 
	{
		  foreach( $my_query->posts as $key => $value ):
			$result[$value->ID] =  $value->post_title;
		  endforeach;
	}
	return $result;
	wp_reset_query();
	
}