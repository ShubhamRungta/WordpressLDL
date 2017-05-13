/*** Document Ready Function ***/
jQuery(document).ready(function($){
	
	"use strict";

    //  When user clicks on tab, this code will be executed
    $("#tabs li").click(function() {
        //  First remove class "active" from currently active tab
        $("#tabs li").removeClass('active');
 
        //  Now add class "active" to the selected/clicked tab
        $(this).addClass("active");
 
        //  Here we get the href value of the selected tab
        var selected_tab = $(this).find("a").attr("href");
 
        if( $(this).hasClass('toggle') === false ){
			
			//  Hide all tab content
        	$(".tab_content").hide();
		
			//  Show the selected tab content
			$(selected_tab).fadeIn();
		}
 
        //  At the end, we add return false so that the click on the link is not executed
        return false;
    });	

	$('div.alert .close').click(function(e) {
        e.preventDefault();
		$(this).parent('div.alert').fadeOut('slow');
    });

    $("#tabs2 li").click(function() {
        //  First remove class "active" from currently active tab
        $("#tabs2 li").removeClass('active');
 
        //  Now add class "active" to the selected/clicked tab
        $(this).addClass("active");
 
        //  Hide all tab content
        $(".tab_content2").hide();
 
        //  Here we get the href value of the selected tab
        var selected_tab = $(this).find("a").attr("href");
 
        //  Show the selected tab content
        $(selected_tab).fadeIn();
 
        //  At the end, we add return false so that the click on the link is not executed
        return false;
    });	
	


	$(".sidebar-menu > ul > li").click( function(){
		$(".sidebar-menu > ul > li ul").slideUp();
		$("ul",this).slideDown();
		$("a").removeClass("dropdown");
	});	

	$(".sidebar-menu > ul > li.toggle").click( function(){
		$("a",this).toggleClass("dropdown");
	});	

	$(".sidebar-menu > ul > li.toggle:first").trigger('click');
	//$('#tabs li:first').trigger('click');
	$(".sidebar-menu > ul > li:first ul li a:first").trigger('click');
	
	jQuery('.switch_options').each(function() {
 
	//This object
	var obj = jQuery(this);

	var enb = obj.children('.switch_enable'); //cache first element, this is equal to ON
	var dsb = obj.children('.switch_disable'); //cache first element, this is equal to OFF
	var input = obj.children('input'); //cache the element where we must set the value
	var input_val = obj.children('input').val(); //cache the element where we must set the value

	/* Check selected */
	if( 0 == input_val ){
		dsb.addClass('selected');
	}
	else if( 1 == input_val ){
		enb.addClass('selected');
	}

	//Action on user's click(ON)
	enb.on('click', function(){
		$(dsb).removeClass('selected'); //remove "selected" from other elements in this object class(OFF)
		$(this).addClass('selected'); //add "selected" to the element which was just clicked in this object class(ON)
		$(input).val(1).change(); //Finally change the value to 1
	});

	//Action on user's click(OFF)
	dsb.on('click', function(){
		$(enb).removeClass('selected'); //remove "selected" from other elements in this object class(ON)
		$(this).addClass('selected'); //add "selected" to the element which was just clicked in this object class(OFF)
		$(input).val(0).change(); // //Finally change the value to 0
	});

});
 		
		
		
		
		
		
 
var toggles = function(button, checkbox, on, off){
  $(button).toggle(function(){
    
    $(this).addClass('on').html(on);
      $(checkbox).prop('checked', true);
    
      },function(){
        
    $(this).removeClass('on').html(off);
      $(checkbox).prop('checked', false);
  });
}

toggles('#on-off-slide', "#on-off-checkbox", 'on', 'off');
toggles('#on-off-slide2', "#on-off-checkbox", 'on', 'off');
toggles('#on-off-slide3', "#on-off-checkbox", 'on', 'off');
toggles('#on-off-slide4', "#on-off-checkbox", 'on', 'off');
toggles('#on-off-slide5', "#on-off-checkbox", 'on', 'off');
toggles('#on-off-slide6', "#on-off-checkbox", 'on', 'off');
toggles('#on-off-slide7', "#on-off-checkbox", 'on', 'off');
toggles('#on-off-slide8', "#on-off-checkbox", 'on', 'off');
toggles('#on-off-slide9', "#on-off-checkbox", 'on', 'off');
toggles('#on-off-slide10', "#on-off-checkbox", 'on', 'off');
toggles('#on-off-slide11', "#on-off-checkbox", 'on', 'off');
toggles('#on-off-slide12', "#on-off-checkbox", 'on', 'off');
toggles('#on-off-slide13', "#on-off-checkbox", 'on', 'off');
toggles('#on-off-slide14', "#on-off-checkbox", 'on', 'off');
toggles('#on-off-slide15', "#on-off-checkbox", 'on', 'off');
		
		
		
		
		


		$(".add").click( function(){
			$(this).parent()
			.next('.add-bar-panel').slideToggle();
		});


		$(".del").click(function(){
		$(this).parent().parent().slideUp();
	});	


	$(".slider-slides .box h1").click( function(){
		$(this).next('.box-content').slideToggle();
	});


	
		
		
		
		
		
$(".more").click(function() {
    $(".add-social").append("<div class='social-bar'><div class='bar'><h3>Social Icons</h3><span class='add'></span><span class='del'></span></div><div class='add-bar-panel'><div class='opt-bar'><div class='left'><h2>Icon Title</h2><a href='#' class='T1' title='This is a tooltip'>?</a></div><div class='right'>	<input type='text' class='input-field' /></div></div><div class='opt-bar'><div class='left'><h2>Icon Link</h2><a href='#' class='T1' title='This is a tooltip'>?</a></div><div class='right'><input type='text' class='input-field' /></div></div><div class='opt-bar'>	<div class='left'><h2>Social Icon</h2><a href='#' class='T1' title='This is a tooltip'>?</a> </div><div class='right'><form id='upload' enctype='multipart/form-data' action='upload.php' method='post'><input class='input-field' type='file' value='Browse' /><input type='submit' class='btn' value='Upload' /></form></div></div></div></div>");	
});
$(".more-client").click(function() {
    $(".clients").append("<div class='opt-bar'><div class='left'><h2>Client?</h2><a href='#' class='T1' title='This is a tooltip'>?</a></div><div class='right'><form id='upload' enctype='multipart/form-data' action='upload.php' method='post'><input class='input-field' type='file' value='Browse' /><input type='submit' class='btn' value='Upload' /></form></div></div>");	
});


    
    $(".dependent_radio").change(function() {
        var test = $(this).val();
        $(".desc_dependent").hide();
        $("#" + test).show();
    });
    $(".dependent_radio:checked").change();


		
	});
	
jQuery(document).ready(function($){
$('#import_default_settings').click(function(e) {
	e.preventDefault();
	var links = $(this).attr('href');
	if(!confirm('Importing Default settings will remove your existing settings, Continue anyway?')){
		return false;
	}else window.location = links;
});

});
