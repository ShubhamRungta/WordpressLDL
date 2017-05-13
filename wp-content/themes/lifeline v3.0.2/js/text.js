jQuery(document).ready(function($){
jQuery(function($) {

	$('#carousel').carouFredSel({

		responsive: true,

		circular: false,

		auto: false,

		items: {

			visible: 1,

			width: 20,

			height: '40%'

		},

		scroll: {

			fx: 'directscroll'

		}

	});

	$('#thumbs').carouFredSel({

		responsive: true,

		circular: false,

		infinite: false,

		auto: false,

		prev: '#prev',

		next: '#next',

		items: {

			visible: {

				min: 1,

				max: 6

			},

			width: 200,

			height: '80%'

		}

	});

	$('#thumbs a').click(function() {

		$('#carousel').trigger('slideTo', '#' + this.href.split('#').pop() );

		$('#thumbs a').removeClass('selected');

		$(this).addClass('selected');

		return false;

	});

});

});