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
	<div id="top-bar" class="modern">
		<div class="container">
        	<ul>
                <?php echo ( sh_set( $settings, 'header_address' ) ) ? '<li><i class="icon-home"></i>'.sh_set( $settings, 'header_address' ).'</li>': '';?>
                <?php echo ( sh_set( $settings, 'header_phone_number' ) ) ? '<li><i class="icon-phone"></i>'.sh_set( $settings, 'header_phone_number' ).'</li>': '';?>
                <?php echo ( sh_set( $settings, 'header_email_address' ) ) ? '<li><i class="icon-envelope"></i>'.sh_set( $settings, 'header_email_address' ).'</li>': '';?>
            </ul>
            <?php if( sh_set( $settings, 'sh_show_soical_icons' ) == 'true' ): ?>
                <div class="header-social">
                <ul>
                    <?php echo ( sh_set( $settings, 'contact_rss' ) ) ? '<li><a href="'.sh_set( $settings, 'contact_rss' ).'" title=""><i class="icon-rss"></i></li>': '';?>
                    <?php echo ( sh_set( $settings, 'contact_gplus' ) ) ? '<li><a href="'.sh_set( $settings, 'contact_gplus' ).'" title=""><i class="icon-google-plus"></i></li></a>': '';?>
                    <?php echo ( sh_set( $settings, 'contact_facebook' ) ) ? '<li><a href="'.sh_set( $settings, 'contact_facebook' ).'" title=""><i class="icon-facebook"></i></a></li>': '';?>
                    <?php echo ( sh_set( $settings, 'contact_twitter' ) ) ? '<li><a href="'.sh_set( $settings, 'contact_twitter' ).'" title=""><i class="icon-twitter"></i></a></li>': '';?>
                    
                    <?php echo ( sh_set( $settings, 'contact_linkedin' ) ) ? '<li><a href="'.sh_set( $settings, 'contact_linkedin' ).'" title=""><i class="icon-linkedin"></i></a></li>': '';?>
                    <?php echo ( sh_set( $settings, 'contact_pintrest' ) ) ? '<li><a href="'.sh_set( $settings, 'contact_pintrest' ).'" title=""><i class="icon-pinterest"></i></a></li>': '';?>
                </ul>
            </div>
        <?php endif; ?>
		</div>
	</div>
	<!--top bar-->
	
	<header class="header2 <?php echo $custom_sticky_header_class; ?>">
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
            <?php if( sh_set( $settings, 'sh_show_donate_btn' ) == 'true' ): ?>
	            <a  data-toggle="modal" data-target="#myModal"  class="header-btn" href="#" title=""><?php echo sh_set( $settings, 'sh_show_donate_btn_txt' ) ?></a>
            <?php endif; ?>
			<!-- Logo -->
			<nav class="menu">
					<?php wp_nav_menu( array( 'theme_location' => 'main_menu', 'menu_class' => '', 'container'=>null, 'menu_id' => 'menu-navigation', 'fallback_cb' => false, 'walker' => new SH_Megamenu_walker ) ); ?>
			</nav>
		</div>
	</header>
    <?php sh_responsive_menu() ?> 