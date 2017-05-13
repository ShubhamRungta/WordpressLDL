<?php /* Template Name: Contact Page */
sh_custom_header(); 
$settings  = get_post_meta(get_the_ID(), '_page_settings', true);//printr($settings);
$sidebar = sh_set( $settings, 'sidebar' );
$paged = get_query_var('paged');
$theme_options = get_option( SH_NAME );
?> 
<div class="top-image"> <img src="<?php echo sh_set($settings , 'top_image'); ?>" alt="" /> </div>                  
<section class="inner-page">

	<div class="container">
		<div class="page-title">
            <h1><?php echo get_the_title(); ?></h1>
        </div>
        <div class="row">
			<div class="col-md-6">
            	<div class="contact-info">
            <h3 class="sub-head"><?php _e('CONTACT INFORMATION', SH_NAME); ?></h3>
            
				<?php echo stripslashes(sh_set( $theme_options, 'google_map_code' )); ?>
					<p><?php echo sh_set( $theme_options , 'contact_page_text'); ?></p>
					<ul class="contact-details">
						<li>
							<span><i class="icon-home"></i><?php _e('ADDRESS', SH_NAME); ?></span>
							<p><?php echo sh_set( $theme_options , 'contact_page_address'); ?></p>
						</li>
						<li>
							<span><i class="icon-phone-sign"></i><?php _e('PHONE NO', SH_NAME); ?></span>
							<p><?php echo sh_set( $theme_options , 'contact_page_phone'); ?></p>
						</li>
						<li>
							<span><i class="icon-envelope-alt"></i><?php _e('EMAIL ID', SH_NAME); ?></span>
							<p><?php echo sh_set( $theme_options , 'contact_page_email'); ?></p>
						</li>
						<li>
							<span><i class="icon-link"></i><?php _e('WEB ADDRESS', SH_NAME); ?></span>
							<p><?php echo sh_set( $theme_options , 'contact_page_website'); ?></p>
						</li>
					</ul>
				</div>
			</div>	<!-- Contact Info -->
			<div class="col-md-6 pull-right">
            
            	<div id="msgs2"></div>
				<div class="form">
					<h3 class="sub-head"><?php _e('CONTACT US BY MESSAGE', SH_NAME); ?></h3>
					<p><?php _e('Your email address will not be published. Required fields are marked', SH_NAME); ?> <span>*</span></p>
					<form method="post"  action="<?php echo admin_url('admin-ajax.php?action=dictate_ajax_callback&subaction=sh_contact_form_submit'); ?>" name="contactform" id="lifeline_contact_form1">
						
                        <div class="msgs"></div>
                        <label for="name" accesskey="U"><?php _e('Full name', SH_NAME); ?> <span>*</span></label>
						<input name="contact_name" class="form-control input-field" type="text" id="name" size="30" value="" />
						<label for="email" accesskey="E"><?php _e('Email Address', SH_NAME); ?> <span>*</span></label>
						
						<input name="contact_email" class="form-control input-field" type="text" id="email" size="30" value="" />
						<label for="comments" accesskey="C"> <?php _e('Message', SH_NAME); ?><span>*</span></label>
						<textarea name="contact_message" rows="9" id="comments" rows="7" class="form-control input-field"></textarea>
                        
                        <?php if( sh_set( $theme_options, 'captcha_status' ) == 'true' ): ?>
                        	<script type="text/javascript">
								 var RecaptchaOptions = {
									theme : 'clean'
								 };
							 </script>
                        	<?php include_once( get_template_directory().'/framework/modules/recaptchalib.php'); ?>
                            <?php echo recaptcha_get_html(sh_set($theme_options, 'captcha_api')); ?>
                        <?php endif; ?>
                        
						<input type="submit" class="form-button submit" id="submit2" value="<?php _e('SEND MESSAGE', SH_NAME); ?>" />
                        
					</form>
				<div id="admn_url" style="display:none"><?php echo get_template_directory_uri();?></div>
				</div>
                <script>
				jQuery(document).ready(function($) {
					
					$('#lifeline_contact_form1').live('submit', function(e){
						e.preventDefault();
						var thisform = this;
						var fields = $(this).serialize();
						var url= $(this).attr('action');
						var url2 = document.getElementById('admn_url').innerHTML;
						$("#msgs2").slideUp(750);
						$('#msgs2').hide();
						$('#submit2')
							.after('<img class="loader" src='+url+'/images/ajax-loader.gif  />').attr("disabled","disabled");
				
						$.ajax({
							url: url,
							type: 'POST',
							data: fields,
							success: function(data){
								document.getElementById('msgs2').innerHTML = data;
								$('#msgs2').slideDown('slow');
								$('#lifeline_contact_form1 img.loader').fadeOut('slow',function(){$(this).remove()});
								$('#submit2').removeAttr('disabled');
								if(data.match('success') != null) $('#lifeline_contact_form1').slideUp('slow');
								if(data.match('success') != null) $('.form h3').slideUp('slow');
								if(data.match('success') != null) $('.form p').slideUp('slow');
				
							}
						});
						return false;
					});
				});
			</script>
			</div>	<!-- Message Form -->
		</div>	
	</div>
    
    <div class="social-connect">	
		<div class="container">
			<h3><?php echo sh_set($theme_options  , 'social_section_title'); ?></h3>
			<ul class="social-bar">
				<li><a title="" href="<?php echo  sh_set($theme_options  , 'contact_rss'); ?>"><img alt="" src="<?php echo get_template_directory_uri(); ?>/images/rss.jpg"></a></li>
				<li><a title="" href="<?php echo  sh_set($theme_options  , 'contact_facebook'); ?>"><img alt="" src="<?php echo get_template_directory_uri(); ?>/images/facebook.jpg"></a></li>
                
                <li><a title="" href="<?php echo  sh_set($theme_options  , 'contact_twitter'); ?>"><img alt="" src="<?php echo get_template_directory_uri(); ?>/images/twitter-icon.png"></a></li>
                
				<li><a title="" href="<?php echo sh_set($theme_options  , 'contact_gplus'); ?>"><img alt="" src="<?php echo get_template_directory_uri(); ?>/images/gplus.jpg"></a></li>
				<li><a title="" href="<?php echo sh_set($theme_options  , 'contact_linkedin'); ?>"><img alt="" src="<?php echo get_template_directory_uri(); ?>/images/linked-in.jpg"></a></li>
				<li><a title="" href="<?php echo sh_set($theme_options  , 'contact_pintrest'); ?>"><img alt="" src="<?php echo get_template_directory_uri(); ?>/images/pinterest.jpg"></a></li>
			</ul>			
		</div>
	</div>
    <!-- Social Media Bar -->
	<section>
		<div class="work-section block">
			<div class="container">
				<div class="row">
					<div class="col-md-6">
						<div class="working">
							<h3 class="sub-head"><?php echo sh_set($theme_options  , 'country_section_title'); ?></h3>
							<p><?php echo sh_set($theme_options  , 'country_section_text'); ?></p>
						</div>
					</div>
<?php $countries = sh_set($theme_options , 'contact_countries'); 
		unset($countries['%s']) ;
		if($countries)
		{
		$chunks = array_chunk($countries , 4);
?>
					<div class="col-md-6">
						<div class="row">
							<div class="countries">
								<ul class="slides">
                                <?php foreach($chunks as $chunk) : ?>
									<li>
                                 <?php foreach($chunk as $c): 
								 ?>
										<div class="col-md-3">
											<img width="97" height="50" src="<?php echo sh_set($c  , 'contact_country_img'); ?>" alt="" />
										</div>
                                   <?php endforeach ; ?>
									</li>
                                 <?php endforeach ; ?>
									
								</ul>
							</div>
						</div>
					</div>
			<?php } ?>
				</div>
			</div>
		</div>
	</section><!-- Working -->
<script>
jQuery(document).ready(function($){
 $('.countries').flexslider({
	animation: "slide",
	animationLoop: false,
	slideShow:false,
	controlNav: false,	
	pausePlay: false,
	mousewheel:false,
	start: function(slider){
	  $('body').removeClass('loading');
	}
});
});
</script>   
    <?php //echo do_shortcode('[sh_social_media]'); ?><!-- Social Media Bar -->
	
	<?php //echo do_shortcode('[sh_countries_slider]'); ?>
    	
</section>
  
<?php get_footer(); ?>