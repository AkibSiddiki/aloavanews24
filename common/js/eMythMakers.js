$(document).ready(function(){
//ShowHide in Mobile
$('.AMobileHide').click(function(){$(".MobileShowHide").slideToggle();});

//BackToTop
	$(document).ready(function(){
		$(window).scroll(function () {
			if ($(this).scrollTop() > 50) {
				$('#back_to_top').fadeIn();
			} else {
				$('#back_to_top').fadeOut();
			}
		});
		// scroll body to 0px on click
		$('#back_to_top').click(function () {
			$('#back-to-top').tooltip('hide');
			$('body,html').animate({
				scrollTop: 0
			}, 800);
			return false;
		});

		$('#back_to_top').tooltip('show');

	});
});



//Search
$(".menu-search").click(function (event) {
        event.preventDefault();
        $(".search_block").toggle("show hide");
    });
    $('a.close-search').click(function (e) {
        e.preventDefault();
        $(".search_block").toggle("show hide");
    });

$('.menu-left').click(function (e) {
        e.preventDefault();
        $(".MobileMenu, .menu-left i").toggleClass("show hide");
        $('body, .most_last_news_details, .most_read_details').toggleClass('no-scrollbar');
    });
