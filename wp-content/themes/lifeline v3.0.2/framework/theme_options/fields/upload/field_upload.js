jQuery(document).ready(function(){

    var button = jQuery('.nhp-opts-upload');
    jQuery(button).click(function() {
        var tgm_media_frame;
        if (tgm_media_frame) {
            tgm_media_frame.open();
            return;
        }
		var field = jQuery(this);
        tgm_media_frame = wp.media.frames.tgm_media_frame = wp.media({
            //className: 'media-frame tgm-media-frame',
            //frame: 'select',
            //title: tgm_nmp_media.title,
            multiple: false,
            library: {
                type: 'image'
            },

        });

        tgm_media_frame.on('select', function() {
            var selection = tgm_media_frame.state().get('selection');
            selection.map(function(attachment) {
                attachment = attachment.toJSON();
                var value = attachment.sizes.full.url;
                jQuery(field).next().fadeIn('slow');
				jQuery(field).fadeOut('slow');
				jQuery(field).next().next().next().fadeIn('slow');
				jQuery(field).prev().fadeIn('slow');
				jQuery(field).prev().attr('src' , value);
				jQuery(field).prev().prev().attr('value' , value);
            });
        });
        tgm_media_frame.open();
    });
	jQuery('.nhp-opts-upload-remove').click(function(){
		$relid = jQuery(this).attr('rel-id');
		jQuery('#'+$relid).val('');
		jQuery(this).prev().fadeIn('slow');
		jQuery(this).prev().prev().fadeOut('slow', function(){jQuery(this).attr("src", nhp_upload.url);});
		jQuery(this).fadeOut('slow');
	});
});	 
	 