$(function() {

	$('#carousel span').append(
			'<img src="styles/img/gui/carousel_glare.png" class="glare" />');
	// $('#thumbs a').append('<img src="styles/img/gui/carousel_glare_small.png"
	// class="glare" />');

	$('#carousel').carouFredSel({
		responsive : true,
		circular : false,
		auto : false,
		items : {
			visible : 1,
			width : 250,
			height : '70%'
		},
		scroll : {
			fx : 'directscroll'
		}
	});

	$('#thumbs').carouFredSel({
		responsive : true,
		circular : true,
		infinite : false,
		auto : false,
		prev : '#prev',
		next : '#next',
		items : {
			visible : {
				min : 0,
				max : 6
			},
			height : '66%'
		}
	});

	$('#thumbs a').click(function() {
		$('#carousel').trigger('slideTo', '#' + this.href.split('#').pop());
		$('#thumbs a').removeClass('selected');
		$(this).addClass('selected');
		return false;
	});

});

// jQuery
var $container = jQuery('.container-fluid');
// initialize
$container.masonry({
	columnWidth : 200,
	gutterWidth : 20,
	itemSelector : '.thumbnail'
});
