/*** Document Ready Function ***/
jQuery(document).ready(function($){
	
	"use strict";
	
	
	
	$('.panel-option-area .options-area:first').fadeIn('slow');
	
	$('.panel ul li:first a').addClass(function(index, aclass) {
        //console.log(aclass);
		if( index == 0 ){
			$(this).addClass('active');
			if($(this).next('ul')){
				$(this).next('ul').css('display', 'block');
				$('li:first', $(this).next()).addClass('active');
				$('li:first a', $(this).next()).addClass('active');
			}
		}
    });
	
	var toggles = $('.panel li ul');
	$(".panel li a.dropdown").click(function(){
		$("ul", $(this).parent()).slideToggle();
	});	

	
	
	$(".panel li.dropdown").click(function(){
		$(this).addClass("active");
	});	

	
	$(".panel li a").click(function(){
		$('.panel li a').removeClass("active");
		var thisclass = $(this).attr('class');
		$(this).addClass("active");
		
		if( $(this).hasClass('dropdown') ){
			return;
		}
		$('.panel-option-area .options-area').css( 'display', 'none' );
		$('.'+thisclass+'-area').fadeIn('slow');
	});	


	$(".panel ul li ul li").click(function(){
		$(this).addClass("active");
	});	
	
	
	$('.bool-slider .inset .control').click(function() {
		
		var parent_class = $(this).parent().parent();
		var field = $(parent_class).attr('data-id');
		
		if ( !$(parent_class).hasClass('disabled') ) 
		{	
			if ($(parent_class).hasClass('true')) {
				$(parent_class).addClass('false').removeClass('true');
				$('#'+field).val('false');
			} else {
				$(parent_class).addClass('true').removeClass('false');
				$('#'+field).val('true');
			}
		}
		
	});
	

	
	$(".add-bar .add").click(function(){
		$(".add-bar .add-bar-panel").slideToggle();
	});	
	
	

	$(".panel1").click(function(){
		$(".panel1-area").fadeIn();
		$(".panel2-area").hide();
		$(".panel3-area").hide();
		$(".panel4-area").hide();
		$(".panel5-area").hide();
		$(".panel6-area").hide();
		$(".panel7-area").hide();
		$(".panel8-area").hide();
		$(".panel9-area").hide();
		$(".panel10-area").hide();
		$(".panel11-area").hide();
		$(".panel12-area").hide();
		$(".panel13-area").hide();
	});	

	$(".panel2").click(function(){
		$(".panel1-area").hide();
		$(".panel2-area").fadeIn();
		$(".panel3-area").hide();
		$(".panel4-area").hide();
		$(".panel5-area").hide();
		$(".panel6-area").hide();
		$(".panel7-area").hide();
		$(".panel8-area").hide();
		$(".panel9-area").hide();
		$(".panel10-area").hide();
		$(".panel11-area").hide();
		$(".panel12-area").hide();
		$(".panel13-area").hide();
	});	
	
	$(".panel3").click(function(){
		$(".panel1-area").hide();
		$(".panel2-area").hide();
		$(".panel3-area").fadeIn();
		$(".panel4-area").hide();
		$(".panel5-area").hide();
		$(".panel6-area").hide();
		$(".panel7-area").hide();
		$(".panel8-area").hide();
		$(".panel9-area").hide();
		$(".panel10-area").hide();
		$(".panel11-area").hide();
		$(".panel12-area").hide();
		$(".panel13-area").hide();
	});	

	$(".panel4").click(function(){
		$(".panel1-area").hide();
		$(".panel2-area").hide();
		$(".panel3-area").hide();
		$(".panel4-area").fadeIn();
		$(".panel5-area").hide();
		$(".panel6-area").hide();
		$(".panel7-area").hide();
		$(".panel8-area").hide();
		$(".panel9-area").hide();
		$(".panel10-area").hide();
		$(".panel11-area").hide();
		$(".panel12-area").hide();
		$(".panel13-area").hide();
	});	

	$(".panel5").click(function(){
		$(".panel1-area").hide();
		$(".panel2-area").hide();
		$(".panel3-area").hide();
		$(".panel4-area").hide();
		$(".panel5-area").fadeIn();
		$(".panel6-area").hide();
		$(".panel7-area").hide();
		$(".panel8-area").hide();
		$(".panel9-area").hide();
		$(".panel10-area").hide();
		$(".panel11-area").hide();
		$(".panel12-area").hide();
		$(".panel13-area").hide();
	});	
	
	$(".panel6").click(function(){
		$(".panel1-area").hide();
		$(".panel2-area").hide();
		$(".panel3-area").hide();
		$(".panel4-area").hide();
		$(".panel5-area").hide();
		$(".panel6-area").fadeIn();
		$(".panel7-area").hide();
		$(".panel8-area").hide();
		$(".panel9-area").hide();
		$(".panel10-area").hide();
		$(".panel11-area").hide();
		$(".panel12-area").hide();
		$(".panel13-area").hide();
	});	

	$(".panel7").click(function(){
		$(".panel1-area").hide();
		$(".panel2-area").hide();
		$(".panel3-area").hide();
		$(".panel4-area").hide();
		$(".panel5-area").hide();
		$(".panel6-area").hide();
		$(".panel7-area").fadeIn();
		$(".panel8-area").hide();
		$(".panel9-area").hide();
		$(".panel10-area").hide();
		$(".panel11-area").hide();
		$(".panel12-area").hide();
		$(".panel13-area").hide();
	});	

	$(".panel8").click(function(){
		$(".panel1-area").hide();
		$(".panel2-area").hide();
		$(".panel3-area").hide();
		$(".panel4-area").hide();
		$(".panel5-area").hide();
		$(".panel6-area").hide();
		$(".panel7-area").hide();
		$(".panel8-area").fadeIn();
		$(".panel9-area").hide();
		$(".panel10-area").hide();
		$(".panel11-area").hide();
		$(".panel12-area").hide();
		$(".panel13-area").hide();
	});	

	$(".panel9").click(function(){
		$(".panel1-area").hide();
		$(".panel2-area").hide();
		$(".panel3-area").hide();
		$(".panel4-area").hide();
		$(".panel5-area").hide();
		$(".panel6-area").hide();
		$(".panel7-area").hide();
		$(".panel8-area").hide();
		$(".panel9-area").fadeIn();
		$(".panel10-area").hide();
		$(".panel11-area").hide();
		$(".panel12-area").hide();
		$(".panel13-area").hide();
	});	

	$(".panel10").click(function(){
		$(".panel1-area").hide();
		$(".panel2-area").hide();
		$(".panel3-area").hide();
		$(".panel4-area").hide();
		$(".panel5-area").hide();
		$(".panel6-area").hide();
		$(".panel7-area").hide();
		$(".panel8-area").hide();
		$(".panel9-area").hide();
		$(".panel10-area").fadeIn();
		$(".panel11-area").hide();
		$(".panel12-area").hide();
		$(".panel13-area").hide();
	});	

	$(".panel11").click(function(){
		$(".panel1-area").hide();
		$(".panel2-area").hide();
		$(".panel3-area").hide();
		$(".panel4-area").hide();
		$(".panel5-area").hide();
		$(".panel6-area").hide();
		$(".panel7-area").hide();
		$(".panel8-area").hide();
		$(".panel9-area").hide();
		$(".panel10-area").hide();
		$(".panel11-area").fadeIn();
		$(".panel12-area").hide();
		$(".panel13-area").hide();
	});	

	$(".panel12").click(function(){
		$(".panel1-area").hide();
		$(".panel2-area").hide();
		$(".panel3-area").hide();
		$(".panel4-area").hide();
		$(".panel5-area").hide();
		$(".panel6-area").hide();
		$(".panel7-area").hide();
		$(".panel8-area").hide();
		$(".panel9-area").hide();
		$(".panel10-area").hide();
		$(".panel11-area").hide();
		$(".panel12-area").fadeIn();
		$(".panel13-area").hide();
	});	

	$(".panel13").click(function(){
		$(".panel1-area").hide();
		$(".panel2-area").hide();
		$(".panel3-area").hide();
		$(".panel4-area").hide();
		$(".panel5-area").hide();
		$(".panel6-area").hide();
		$(".panel7-area").hide();
		$(".panel8-area").hide();
		$(".panel9-area").hide();
		$(".panel10-area").hide();
		$(".panel11-area").hide();
		$(".panel12-area").hide();
		$(".panel13-area").fadeIn();
	});	
	
});/*** Document Ready Function Ends ***/


