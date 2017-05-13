jQuery(document).ready(function($){

	jQuery('.nhp-opts-multi-fields-remove').live('click', function(){
		jQuery(this).prev('input[type="text"]').val('');
		jQuery(this).parent().fadeOut('slow', function(){jQuery(this).remove();});
	});
	
	$('.nhp-opts-multi-fields-add').click(function(){
		var count = ( parseInt($('#'+jQuery(this).attr('rel-id')+'  li').length) - 1 );

		var new_input = jQuery('#'+jQuery(this).attr('rel-id')+' li.append_multi_field').clone();
		var newname = new_input.html(function(i, oldHTML) {
						return oldHTML.replace(/\%s/g, count);
					});
		jQuery('.buttonset', newname).buttonset();
		jQuery('#'+jQuery(this).attr('rel-id')).append(newname);
		jQuery('#'+jQuery(this).attr('rel-id')+' li:last-child').removeAttr('style');
		jQuery('#'+jQuery(this).attr('rel-id')+' li:last-child').removeAttr('class');
		
		//jQuery('#'+jQuery(this).attr('rel-id')+' li:last-child input[type="text"]').val('');
		//jQuery('#'+jQuery(this).attr('rel-id')+' li:last-child input[type="text"]').attr('name' , jQuery(this).attr('rel-name'));
	});
	
});