/*** Document Ready Functions ***/
jQuery(document).ready(function($) {


    // responsive header
    $(".responsive-header > span").click(function() {
        $(this).next('ul').slideToggle();
        $(".responsive-header > ul > li > ul").slideUp();
        $(".responsive-header > ul > li > ul > li > ul").slideUp();
        $(".responsive-header > ul > li").removeClass('opened');
        $(".responsive-header > ul > li > ul > li").removeClass('opened');
    });
	
    $('.responsive-header ul li a').next('ul').parent().addClass('no-link')
    $('.no-link > a').click(function() {
        return false;
    });


    $(".responsive-header > ul > li > a").click(function() {
        $(".responsive-header > ul > li > ul").slideUp();
        $(".responsive-header > ul > li").removeClass('opened');
        $(this).next('ul').slideDown();
        $(this).next('ul').parent().toggleClass('opened');
    });
    $(".responsive-header > ul > li > ul > li a").click(function() {
        $(".responsive-header > ul > li > ul > li > ul").slideUp();
        $(".responsive-header > ul > li > ul > li").removeClass('opened');
        $(this).next('ul').slideDown();
        $(this).next('ul').parent().toggleClass('opened');
    });

    // layer slider
    var layer = jQuery('.wpb_layerslider_element').parent().attr('class');
    if (layer == 'col-md-12 column') {
        jQuery('.wpb_layerslider_element').parent().parent().parent().addClass('expand');
    }
    "use strict";
    $('.parallax-video').parent().parent().parent().addClass('expand');
    $('.full-section').parent().parent().parent().addClass('expand');
    var video = jQuery('#para_vid').parent().attr('class');
    if (video == 'col-md-12') {
        jQuery('#para_vid').parent().attr('class', '');
        jQuery('#para_vid').parent().parent().attr('class', '');
        jQuery('#para_vid').parent().parent().parent().attr('class', '');
    }

    $('.count').counterUp({
        delay: 10,
        time: 1000
    });

    /*full screen video*/
    var $allVideos = jQuery("iframe[src^='http://player.vimeo.com'], iframe[src^='http://www.youtube.com'], object, embed"),
        jQueryfluidEl = jQuery("#para_vid");

    $allVideos.each(function() {

        jQuery(this)
            // jQuery .data does not work on object/embed elements
            .attr('data-aspectRatio', this.height / this.width)
            .removeAttr('height')
            .removeAttr('width');

    });

    jQuery(window).resize(function() {

        var newWidth = jQueryfluidEl.width();
        $allVideos.each(function() {

            var jQueryel = jQuery(this);
            jQueryel
                .width(newWidth)
                .height(newWidth * jQueryel.attr('data-aspectRatio'));

        });

    }).resize();

    $('#lifeline_contactform_2 #submit').on('click', function(e) {
        e.preventDefault();
        var thisform = 'form#lifeline_contactform_2';
        var fields = $('form#lifeline_contactform_2').serialize();
        var url = $('form#lifeline_contactform_2').attr('action');
        $.ajax({
            url: url,
            type: 'POST',
            data: fields,
            success: function(res) {
                $('.msgs', thisform).html(res);
            }
        });

    });

    $('#lifeline_contact_form1', '#lifeline_contactform_2').live('submit', function(e) {



        e.preventDefault();

        var thisform = this;

        var fields = $(this).serialize();

        var url = $(this).attr('action');

        $.ajax({

            url: url,

            type: 'POST',

            data: fields,

            success: function(res) {

                $('.msgs', thisform).html(res);

            }

        });

    });



    var allservice = $('.cause-tabber li');

    $('.cause-tabber li').click(function() {

        $(allservice).removeClass("active");

    });



    /*** MESSAGE BOX TOGGLE FUNCTION ***/

    $(".message-box-title").click(function() {

        $(".message-box-title").toggleClass("opened");

        $(".message-box-title > i").toggleClass("icon-angle-down");

        $(".message-form").slideToggle();

    });




    $(".product > a").click(function() {

        $(this).parent().parent().slideUp();

    });



    /*** Responsive Menu Function ***/

    $('.ipadMenu').change(function() {

        var loc = $('option:selected', this).val();

        document.location.href = loc;

    });



    /*** ACCORDIONS ***/

    $('.accordion_content').not('.open').hide();



    $('.accordion_toggle a').click(function(e) {

        if ($(this).parent().hasClass('current')) {

            $(this).parent()

            .removeClass('current')

            .next('.accordion_content').slideUp();

        } else {

            $(document).find('.current')

            .removeClass('current')

            .next('.accordion_content').slideUp();

            $(this).parent()

            .addClass('current')

            .next('.accordion_content').slideDown();

        }

        e.preventDefault();

    });




    /*** ACCORDIONS ***/

    $('.accordion_content').not('.open').hide();



    $('.accordion_toggle input').click(function(e) {

        if ($(this).parent().hasClass('current')) {

            $(this).parent()

            .removeClass('current')

            .next('.accordion_content').slideUp();

        } else {

            $(document).find('.current')

            .removeClass('current')

            .next('.accordion_content').slideUp();

            $(this).parent()

            .addClass('current')

            .next('.accordion_content').slideDown();

        }

        e.preventDefault();

    });




    /*** STICKY MENU ***/

    var nav = $('.sticky');

    $(window).scroll(function() {

        if ($(this).scrollTop() > 50) {

            nav.addClass("stick");

        } else {

            nav.removeClass("stick");

        }

    });

    /*** TOGGLE HEADER ***/

    $(".show-header").click(function() {

        $(".toggle-header").slideToggle();

        $(".top-bar-toggle").slideToggle();

        $(this).toggleClass("move-down");

    });



    /*** CHECKOUT PAGE FORM TOGGLE ICON ***/

    $(".form-toggle.accordion_toggle a").click(function() {

        $(this).toggleClass("pointed");

    });




    /*** Side Panel Functions ***/

    $(".panel-icon").click(function() {

        $(".side-panel").toggleClass("show");

    });



    $(".boxed-style").click(function() {

        $(".theme-layout").addClass("boxed");

        $("body").addClass('bg-body1');

    });

    $(".full-style").click(function() {

        $(".theme-layout").removeClass("boxed");

        $("body").removeClass('bg-body1');

        $("body").removeClass('bg-body2');

        $("body").removeClass('bg-body3');

        $("body").removeClass('bg-body4');

    });

    $(".pat1").click(function() {

        $("body").addClass('bg-body1');

        $("body").removeClass('bg-body2');

        $("body").removeClass('bg-body3');

        $("body").removeClass('bg-body4');

    });

    $(".pat2").click(function() {

        $("body").removeClass('bg-body1');

        $("body").addClass('bg-body2');

        $("body").removeClass('bg-body3');

        $("body").removeClass('bg-body4');

    });

    $(".pat3").click(function() {

        $("body").removeClass('bg-body1');

        $("body").removeClass('bg-body2');

        $("body").addClass('bg-body3');

        $("body").removeClass('bg-body4');

    });

    $(".pat4").click(function() {

        $("body").removeClass('bg-body1');

        $("body").removeClass('bg-body2');

        $("body").removeClass('bg-body3');

        $("body").addClass('bg-body4');

    });

    $('.countries').flexslider({

        animation: "slide",

        animationLoop: false,

        slideShow: false,

        controlNav: false,

        pausePlay: false,

        mousewheel: false,

        start: function(slider) {

            $('body').removeClass('loading');

        }

    });



    if ($('.stories-carousel').length > 0)

    {

        $('.stories-carousel').flexslider({

            animation: "slide",

            animationLoop: false,

            controlNav: false,

            maxItems: 1,

            pausePlay: false,

            mousewheel: false,

            start: function(slider) {

                $('body').removeClass('loading');

            }

        });

    }



    var revapi;



    if (jQuery('.tp-banner2').length) {



        revapi = jQuery('.tp-banner2').revolution(

            {

                delay: 15000,

                startwidth: 270,

                startheight: 184,

                autoHeight: "off",

                navigationType: "none",

                hideThumbs: 10,

                fullWidth: "on",

                fullScreen: "off",

                fullScreenOffsetContainer: ""

            });

    }



    var revapi;



    if (jQuery('.tp-banner3').length) {



        revapi = jQuery('.tp-banner3').revolution(

            {

                delay: 15000,

                startwidth: 870,

                startheight: 325,

                autoHeight: "off",

                navigationType: "none",

                hideThumbs: 10,

                fullWidth: "on",

                fullScreen: "off",

                fullScreenOffsetContainer: ""

            });

    }



    if (jQuery('.tp-banner4').length) {



        revapi = jQuery('.tp-banner4').revolution(

            {

                delay: 15000,

                startwidth: 1170,

                startheight: 455,

                autoHeight: "off",

                navigationType: "none",

                hideThumbs: 10,

                fullWidth: "on",

                fullScreen: "off",

                fullScreenOffsetContainer: ""

            });

    }

    $(".amount-btns a").on('click', function() {
        $(".amount-btns a").removeClass('selected');
        var amount = $(this).children('span').html();
        $(this).addClass('selected');
        $('.other-amount #textfield').val(amount);
    });
    $(".recursive-periods a").on('click', function() {
        $(".recursive-periods a").removeClass('selected');
        var time_period = $(this).html();

        $(this).addClass('selected');
        if (time_period != 'One Time') {
            $('.loading').show();

            var data = {
                'action': 'getbutton', //calls wp_ajax_nopriv_getbutton
                'period': time_period,
            };
            $.post(ajaxurl, data, function(responce) {
                $('.other-amount').html(responce);
                if (time_period == "Weekly") {
                    $('#billing-period').val('Week');
                    $('#billing-frequency').val('1');
                } else if (time_period == "Daily") {
                    $('#billing-period').val('Day');
                    $('#billing-frequency').val('1');
                } else if (time_period == "Fortnightly") {
                    $('#billing-period').val('SemiMonth');
                    $('#billing-frequency').val('1');
                } else if (time_period == "Monthly") {
                    $('#billing-period').val('Month');
                    $('#billing-frequency').val('1');
                } else if (time_period == "Quaterly") {
                    $('#billing-period').val('Month');
                    $('#billing-frequency').val('3');
                } else if (time_period == "Half Year") {
                    $('#billing-period').val('Month');
                    $('#billing-frequency').val('6');
                } else if (time_period == "Yearly") {
                    $('#billing-period').val('Year');
                    $('#billing-frequency').val('1');
                }
                $('.loading').hide();
            });


            if ($('form#login').length > 0) {
                $('.other-amount').css('display', 'none');
                $('form#login').css('display', 'block');

            }

        } else {
            $('.loading').show();
            var data = {
                'action': 'getbutton', //calls wp_ajax_nopriv_getbutton
                'period': time_period,
            };
            $.post(ajaxurl, data, function(responce) {
                $('.other-amount').html(responce);
                $('.other-amount').fadeIn();
                $('.loading').hide();
            });

        }


    });

    $("#paypal_confirmation").on('click', function() {
        $('.loading').show();
        var data = {
            'action': 'confirm_order', //calls wp_ajax_nopriv_confirm_order
        };
        $.post(ajaxurl, data, function(responce) {
            $('.donate-popup').html(responce);
            $('.loading').hide();
        });
        return false;
    });

    if ($('.loading').length === 0) {
        $('body').append('<div class="loading" style="display:none;"></div>');
    }
    $(".donate-drop-btn").click(function() {
        $(".donate-drop-down").slideToggle();
        $(this).toggleClass('down');

    });
});

function header_counter(name, date) {
    var austDay = new Date();
    austDay = new Date(date);
    jQuery(name).countdown({
        until: austDay
    });
}

function counter_inner(name, dated) {
    jQuery("." + name).downCount({
        date: '+dated+',
    });
}

jQuery(window).load(function($){
	//jQuery('section.no-container').parent().parent().parent().parent().addClass('gray no-container');
});