$(document).ready(function(){
	$.extend({
		cur_url:function(){
			return document.URL;
		}, root:function(){
			return location.protocol + '//' + location.host+'/terre/';
		}
	});
	
// Function Click Toggle Menu
if($(window).width() < 991) { 
	$('.dropdown').click(function(){
		if($(this).hasClass('active')){
			$(this).find('.dropdown-content').stop().slideUp();
			$(this).removeClass('active');
			$(this).find('.nav-open-icon').removeClass('active');
		}else{
			$(this).find('.dropdown-content').stop().slideDown();
			$(this).addClass('active');
			$(this).find('.nav-open-icon').addClass('active');
		}
	});

	$('.footer-collapse').click(function(){
		if($(this).hasClass('active')){
			$(this).find('.footer-list-menu').stop().slideUp();
			$(this).removeClass('active');
			$(this).find('.footer-open-icon').removeClass('active');
		}else{
			$(this).find('.footer-list-menu').stop().slideDown();
			$(this).addClass('active');
			$(this).find('.footer-open-icon').addClass('active');
		}
	});

	$('.filter-collapse-parent').click(function(){
		if($(this).hasClass('active')){
			$(this).find('.filter-parent-list-menu').stop().slideUp();
			$(this).removeClass('active');
			$(this).find('.filter-open-icon').removeClass('active');
		}else{
			$(this).find('.filter-parent-list-menu').stop().slideDown();
			$(this).addClass('active');
			$(this).find('.filter-open-icon').addClass('active');
		}
	});

	// FILTER-CHILD-OPEN-ICON DROPDOWN
	$('.filter-collapse-child').click(function(){
		if($(this).hasClass('active')){
			$(this).find('.filter-child-list-menu').stop().slideUp();
			$(this).removeClass('active');
			$(this).find('.filter-child-open-icon').removeClass('active');
			return false;
		}else{
			$(this).find('.filter-child-list-menu').stop().slideDown();
			$(this).addClass('active');
			$(this).find('.filter-child-open-icon').addClass('active');
			return false;
		}
	});



	var show  = 0;
	$('#toggle-menu').click(function(){
		var parent	= $(this);
		$('#nav-toggle-open').animate({left:show},500, function () {
			if(show == 0){
				show = '-100%';
                	// parent.css('position','fixed');
                }else{
                    //alert('b');
                    show = 0;
                	// parent.css('top',138);
					// parent.css('position','absolute');
                	// parent.css('position','absolute');
                }
            });
		$('.nav-toggle', $(this)).toggleClass('active');
	});
};
});

// Slideshow banner / slider function
$(document).ready(function(){
	$('#slideshow').slick({
		infinite: true,
		autoplay: true,
		autoplaySpeed: 3000,
		slidesToShow: 1,
		accessibility:false,
		arrows:false,
		dots:true,
		fade: true
	});
	$('#slideshowv2').slick({
		infinite: true,
		autoplay: true,
		autoplaySpeed: 3000,
		slidesToShow: 1,
		accessibility:false,
		arrows:false,
		dots:false,
		fade: true
	});

	$('#testimonial-carousel').slick({
		slidesToShow: 1,
		slidesToScroll: 1,
		infinite: true,
		accessibility:false,
		speed: 500,
		dots:true,
		arrows:false
	});

	$('#brand-carousel').slick({
		
		infinite: true,
		accessibility:false,
		speed: 500,
		arrows:false,
		responsive: [
		{
			breakpoint: 2500,
			settings: {
				slidesToShow: 8,
				dots:true,
				slidesToScroll: 4,
				slidesToScroll: 2
			}
		},{
			breakpoint: 991,
			settings: {
				dots:false,
				slidesToShow: 4,
				slidesToScroll: 2
			}
		},{
			breakpoint: 600,
			settings: {

				slidesToShow: 3,
				slidesToScroll: 1
			}
		},{
			breakpoint: 480,
			settings: {

				slidesToShow: 3,
				slidesToScroll: 1
			}
		}
		]
	});

	$('.image-wrapper').slick({
		slidesToShow: 5,
		slidesToScroll: 1,
		infinite: true,
		accessibility:false,
		speed: 500,
		dots:false,
		arrows:false,
		responsive: [
		{
			breakpoint: 991,
			settings: {
				slidesToShow: 3,
				slidesToScroll: 2
			}
		},{
			breakpoint: 600,
			settings: {

				slidesToShow: 3,
				slidesToScroll: 1
			}
		},{
			breakpoint: 480,
			settings: {

				slidesToShow: 3,
				slidesToScroll: 1
			}
		}
		]
	});

// Product Thumbnail Carousel
$('#img-thumb-carousel').slick({
	infinite: true,
	speed: 500,
	accessibility:false,
	arrows:false,
	slidesToShow: 3,
	slidesToScroll: 1,
	responsive: [
	{
		breakpoint: 1000,
		settings: {
			slidesToShow: 3,
			slidesToScroll: 2
		}
	},{
		breakpoint: 600,
		settings: {
			slidesToShow: 3,
			slidesToScroll: 1
		}
	},{
		breakpoint: 500,
		settings: {
			slidesToShow: 3,
			slidesToScroll: 1
		}
	}
	]
});
$(document).on('click','.prev-button',function(){
	$("#img-thumb-carousel").slick('slickPrev');
});
$(document).on('click','.next-button',function(){
	$("#img-thumb-carousel").slick('slickNext');
});


if($(window).width() < 991 ) {
// Project list carousel
$('#projectlist-carousel').slick({
	infinite: true,
	speed: 500,
	accessibility:false,
	arrows:false,
	slidesToShow: 3,
	slidesToScroll: 1,
	responsive: [
	{
		breakpoint: 1000,
		settings: {
			slidesToShow: 3,
			slidesToScroll: 2
		}
	},{
		breakpoint: 600,
		settings: {
			slidesToShow: 3,
			slidesToScroll: 1
		}
	},{
		breakpoint: 360,
		settings: {
			slidesToShow: 3,
			slidesToScroll: 1
		}
	}
	]
});
$(document).on('click','.listproject-prev-button',function(){
	$("#projectlist-carousel").slick('slickPrev');
});
$(document).on('click','.listproject-next-button',function(){
	$("#projectlist-carousel").slick('slickNext');
});

}

// Project image carousel
$('#project-carousel').slick({
	infinite: true,
	speed: 500,
	accessibility:false,
	arrows:false,
	slidesToShow: 1,
	slidesToScroll: 1,
	dots: true,
});

});

// Scrollbar function
if($(window).width() > 991){
	$(document).ready(function(){
		$("body").addClass("thin");

		$("body").mouseover(function(){
			$(this).removeClass("thin");
		});
		$("body").mouseout(function(){
			$(this).addClass("thin");
		});
		$("body").scroll(function () {
			$("body").addClass("thin");
		});
	});
}

$(document).on('click','.img-thumb',function(){
	a = $(this).attr('href');
	b = $(this).data('zoom');
	$('.img-product-large > img').fadeOut(function(){
		var stage = "<img src='"+a+"' class='img-responsive image-zoom' data-zoom-image='"+b+"'/>";
		$('.img-product-large').html(stage);
		$('.zoomContainer').remove();
		$(".image-zoom").elevateZoom({
			zoomType: "inner",
			cursor: "crosshair"
		});
		$(this).fadeIn();
	});
	return false;
});

$(document).ready(function(){
	$(".image-zoom").elevateZoom({
		zoomType: "inner",
		cursor: "crosshair"
	});
});