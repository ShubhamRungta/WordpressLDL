<div id="headbar">
    <div class="container">
        <div id="panel-logo">
            <img alt="" src="<?php echo SH_FRW_URL ; ?>resource/images/logo.png">
        </div>	
        <div class="import_area"> 
        	<div class="left_side">        
            <a title="" id="install_button" href="javascript:void(0)" class="help"><?php _e('Import Demo Data', SH_NAME); ?></a>
            </div>
        </div>
        
        <div class="sitelink">
            <a title="" href="#"><?php _e( 'VERSION 3.0.2', SH_NAME )?></a>
            <a title="" href="http://themeforest.net/user/webinane/portfolio"><?php _e('Visit Our Themes', SH_NAME); ?></a>
        </div>
	</div>
</div>
<div class="overlay"></div>
<div class="importer_result">
	<span>X</span>
    <h1><?php _e('Import Results', SH_NAME)?></h1>
    <div class="result">
    </div>
</div>

<script type="text/javascript">
jQuery(document).ready(function($){
	$('#install_button').on('click',function() {
		var check = confirm("Are you sure installing demo data?  Please be aware that the demo data comprises a significant amount of content, and we suggest this demo data be installed in a local host ( ie home or work computer using wamp or mamp ) not in the online site.");
		if (check == false )
		{
			return false;
		}		
		if ( jQuery(this).hasClass( 'is_disabled' ) ) {
			return false;
		}
		jQuery('#install_button').addClass( 'is_disabled' );
		var loading = $('<span class="wobblebar">Loading&#8230;</span>').insertAfter('.left_side');
		$.post(ajaxurl, {
			action: 'theme-install-demo-data',
		}, 
		function(response) {
			jQuery('.importer_result .result').html('').hide();
			var height = jQuery('html').height();
			jQuery( '.overlay' ).css({
					'background': 'rgba(0,0,0,0.65)',
					'position': 'fixed',
					'top': '0',
					'left': '0',
					'width': '100%',
					'height': '100%',
					'z-index': '9999999',
			});
			jQuery( '.overlay').show();
			jQuery( '.importer_result').show();
			jQuery('.importer_result .result').append(response);
			jQuery( '.importer_result .result').show();			
			loading.remove();
			var done = jQuery('<span class="theme-install-done">Done!</span>').insertAfter('.left_side');
			setTimeout(function() {
     			jQuery(done).hide();
			}, 5000);		
		});

		return false; 	
	});
	
	jQuery('.importer_result span').click(function(){
		jQuery( '.result').hide();
		jQuery('.importer_result').hide();
		jQuery( '.overlay' ).hide();
		jQuery('#install_button').removeClass( 'is_disabled' );
	});
});
</script>