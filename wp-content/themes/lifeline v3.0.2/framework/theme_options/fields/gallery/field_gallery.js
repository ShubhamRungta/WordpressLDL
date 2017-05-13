jQuery(document).ready(function($){
	

	// Uploading files
	var file_frame;
	var selected_att = new Array();
	var thisinput = $('.sh_media_button:first').prev('input');
  	//jQuery('.upload_image_button').live('click', function( event ){
	jQuery('.sh_media_button').live('click', function( event ){
	   
	   	event.preventDefault();
	
		thisinput = $(this).prev('input');
		var wp_media_post_id = wp.media.model.settings.post.id ;

		//var set_to_post_id = 1197; // Set this
	
		// If the media frame already exists, reopen it.
		if ( file_frame ) {
			// Set the post ID to what we want
			//file_frame.uploader.uploader.param( 'post_id', set_to_post_id );
			// Open frame
			file_frame.open();
		  return;
		}else {
		// Set the wp.media post id so the uploader grabs the ID we want when initialised
		//wp.media.model.settings.post.id = set_to_post_id;
	}
	
	//alert (wp.media.model.settings.post.id);
	
		// Create the media frame.
		file_frame = wp.media.frames.file_frame = wp.media({
		  title: jQuery( this ).data( 'uploader_title' ),
		  button: {
		  text: jQuery( this ).data( 'uploader_button_text' ),
		  },
		  multiple: true  // Set to true to allow multiple files to be selected
		});
	
		// When an image is selected, run a callback.
		file_frame.on( 'select', function() {
		  // We set multiple to false so only get one image from the uploader
		  attachment = file_frame.state().get('selection').toJSON();
		  var newatt = '';
			if( typeof( attachment ) === 'object' ){
				$(attachment).each(function(index, element) {console.log(element);
                    //newatt += element.id+',';
					selected_att.push(element.id);
					if( element.sizes.thumbnail !== undefined ){
						$('#media_images').append('<p><img src="'+element.sizes.thumbnail.url+'" /><a href="#" data-id="'+element.id+'">x</a></p>');
					}else{
						$('#media_images').append('<p><img src="'+element.sizes.full.url+'" /><a href="#" data-id="'+element.id+'">x</a></p>');
					}
                });
				$(thisinput).val( selected_att.join(',') );
			}
			
		  // Do something with attachment.id and/or attachment.url here
		});
	
		// Finally, open the modal
		file_frame.open();
	  });
	  
	  $('#media_images > p > a').live( 'click', function( e ){
		  
		  e.preventDefault();
		  thisinput = $('.sh_media_button:first').prev('input');
		  var dataid = $(this).attr('data-id');

          selected_att = $.grep(selected_att, function(value) {
                  return value != dataid;
                });  
		  //console.log(y);
		  $(thisinput).val( selected_att.join(',') );
		  
		  $(this).parent().remove();
		  
	  });
	  
	  selected_att = $(thisinput).val().split(',');
});


