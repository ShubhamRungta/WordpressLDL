jQuery(document).ready(function($){

    // Show the login dialog box on click
    /*$('a#show_login').on('click', function(e){
        $('body').prepend('<div class="login_overlay"></div>');
        $('form#login').fadeIn(500);
       
        e.preventDefault();
    });*/
	
	 $('form#login a.close').on('click', function(){
		$('form#login').hide();
		return false;
	});

    // Perform AJAX login on form submit
    $('form#login').on('submit', function(e){
		$('.loading').show();
        $('form#login p.status').show().text(ajax_login_object.loadingmessage);
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: ajax_login_object.ajaxurl,
            data: { 
                'action': 'ajaxlogin', //calls wp_ajax_nopriv_ajaxlogin
                'username': $('form#login #username').val(), 
                'password': $('form#login #password').val(), 
                'security': $('form#login #security').val() },
            success: function(data){
                $('form#login p.status').text(data.message);
                if (data.loggedin == true){
					$('form#login').fadeOut(5000);
					
					$('.other-amount').fadeIn(5000);
                }
				$('.loading').hide();
            }
        });
        e.preventDefault();
		return false;
    });

});