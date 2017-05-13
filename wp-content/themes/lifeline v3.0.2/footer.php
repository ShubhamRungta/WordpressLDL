</div>
<?php $settings = get_option(SH_NAME);

if( sh_set( $settings, 'show_footer' ) == 'true' ):

	$FooterStyle = ' style="';
		$FooterStyle .= ( isset( $settings['footer_font_family'] ) && !empty( $settings['footer_font_family'] ) ) ? 'font-family:'.$settings['footer_font_family'].';': '';
		$FooterStyle .= ( sh_set($settings , 'footer_bg') ) ? 'background-image:url('.sh_set($settings , 'footer_bg'). ');' : '';
		$FooterStyle .= '"'; ?>

    <footer<?php echo $FooterStyle;?>>
        <div class="container">
            <div class="row">
                <?php dynamic_sidebar('footer-sidebar'); ?>
            </div>
        </div>
    </footer>

<?php

endif;

?>



<div class="footer-bottom">

    <div class="container">

        <p><?php echo stripslashes(sh_set($settings, 'footer_copyright')); ?><span> All rights reserved.</span> </p>

        <?php wp_nav_menu( array( 'theme_location' => 'footer_menu' ) ); ?>

    </div>

</div>

<?php wp_footer(); ?>

</body>

</html>