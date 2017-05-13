	<?php $settings = get_option(SH_NAME);?>
	<!DOCTYPE html>
	<html <?php language_attributes(); ?>>
	<head>
		<?php echo ( sh_set( $settings, 'site_favicon' ) ) ? '<link rel="icon" type="image/png" href="'.sh_set( $settings, 'site_favicon' ).'">': '';?>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title> 
			<?php if(is_home() || is_front_page()) {
				 echo get_bloginfo('name');
			}
			else{
				 wp_title('');
			}?>
		</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		
		<!--[if lt IE 9]>
		<link rel="stylesheet" type="text/css" href="css/ie.css" />
		<script type="text/javascript" language="javascript" src="js/html5shiv.js"></script>
		<![endif]-->
		<?php wp_head(); ?>
		
	</head>
	<?php $res_settings = sh_header_settings($settings);
		  $custom_sticky_header_class = (sh_set($settings , 'sh_custom_stickey_menu') == 'true') ? 'sticky' : '' ;
	?>
	<body <?php body_class(sh_set( $res_settings, 'pattern') ); ?>  style=" <?php echo sh_set($res_settings, 'pattern_image'); ?>">
    <?php echo donation_box(); ?>
	<div class="theme-layout <?php if(sh_set($settings, 'boxed_layout_status') == 'true'): echo 'boxed'; endif;?>" >
	<div id="top-bar" class="gray">
    <div class="container">
		<?php if( sh_set( $settings, 'sh_show_event_counter' ) == 'true' ){ 
			
			$args = array(
				'p' => sh_set( $settings, 'sh_counter_post' ),
				'post_type' => 'dict_event',
				'posts_per_page' => 1,
			);
			
			$count = new WP_Query( $args );
			while( $count->have_posts() ): $count->the_post();
				$EventSettings = get_post_meta( sh_set( $settings, 'sh_counter_post' ), '_dict_event_settings', true );
				$date = date('m/d/Y', strtotime( sh_set( $EventSettings, 'end_date') ) ); 				
		?>
        	<div class="header-counter">
                <div class="event-count">
                    <h3><?php the_title();?></h3>
                    <span><?php echo sh_set( $EventSettings, 'location' );?></span>
                </div>
                <div class="header-event">
                    <div class="count-down"></div>
                    <script> jQuery(document).ready(function() { header_counter('.count-down', '<?php echo $date;?>') });</script>					
                </div>
                <a title="<?php the_title();?>" href="<?php the_permalink()?>" class="header-btn"><?php _e( 'READ MORE', SH_NAME )?></a>
            </div>
        <?php endwhile; wp_reset_query(); } ?>
        <div class="search-box white">
        	<?php $dir = ABSPATH . 'wp-content/plugins/sitepress-multilingual-cms/sitepress.php'; ?>
					<form action="<?php echo home_url(); ?>" method="GET">
                    <?php if( is_plugin_active( $dir ) ): echo '<input type="hidden" name="lang" value="'.( ICL_LANGUAGE_CODE ).'"/>'; endif; ?>
				<input type="submit" value="" class="submit-button">
				<input type="text" name="s" value="Search" onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;" class="search-input">
           </form>
		</div>
	</div>
    </div>
	<!--top bar-->
	
	<header class="header3 <?php echo $custom_sticky_header_class; ?>">
		<div class="container">
			<div class="logo"> 
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
				<?php if( sh_set($settings, 'logo_text_status') === 'true' ) ?> <h1 <?php echo $LogoStyle;?>>
				<?php echo $Logo;?>
				 <?php if( sh_set($settings, 'logo_text_status') === 'true' ) ?> </h1>
				</a>
				<?php
				if( sh_set( $settings, 'logo_text_status' ) === 'true' && sh_set( $settings, 'site_salogan' ) )
				{
					$SaloganStyle = sh_get_font_settings( array( 'salogan_font_size' => 'font-size', 'salogan_font_family' => 'font-family', 'salogan_font_style' => 'font-style' ), ' style="', '"' );
					echo '<p'.$SaloganStyle.'>'.$settings['site_salogan'].'</p>';
				}
				?>
			</div>
			<!-- Logo -->
			<nav class="menu">
					<?php wp_nav_menu( array( 'theme_location' => 'main_menu', 'menu_class' => '', 'container'=>null, 'menu_id' => 'menu-navigation', 'fallback_cb' => false, 'walker' => new SH_Megamenu_walker ) ); ?>
			</nav>
		</div>
	</header>
    <?php sh_responsive_menu() ?> 