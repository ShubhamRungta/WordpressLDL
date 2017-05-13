jQuery(document).ready(function($){
	$('.slider-button').toggle(function(){
	
		var dataid = $(this).attr('data-id');

		if( $(this).hasClass('on') === true ){
			$(this).removeClass('on').html('off');
			
			$('#'+dataid).val('false');
		}else {
			$(this).addClass('on').html('on');
			$('#'+dataid).val('true');
		}
		//$(checkbox).prop('checked', true);
		
	},function(){
		
		var dataid = $(this).attr('data-id');

		if( $(this).hasClass('on') === true ){
			$(this).removeClass('on').html('off');
			
			$('#'+dataid).val('false');
		}else {
			$(this).addClass('on').html('on');
			$('#'+dataid).val('true');
		}
	});
});