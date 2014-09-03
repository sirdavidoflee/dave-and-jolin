(function($) {

	var SITE = {
	
	/* Globals Variables
	=============================================*/	
	scrollPos: null,
	homeNavPos: null,


	/* Methods
	=============================================*/	
		init: function(){
			
			$('h6.caption').each(function(){
				var imgWidth = $(this).prev('p').children('img').width();
				var img = $(this).prev('p').children('img');
				if($(this).prev('p').length==0){
					imgWidth = $(this).parent().find('img').width();
					img = $(this).parent().find('img');
				}
				$(this).css('width', imgWidth+30);
				if(img.hasClass('aligncenter')){
					$(this).css('marginLeft', 'auto').css('marginRight', 'auto');
				}
			});
			
			$('header h1 span').hover(function(){
				
				if($(this).hasClass('show-dave')) {
					$('header nav').removeClass('nav-open open-dave open-jo open-both');
					$('header nav').addClass('nav-open open-dave');
				} else if($(this).hasClass('show-jo')) {
					$('header nav').removeClass('nav-open open-dave open-jo open-both');
					$('header nav').addClass('nav-open open-jo');
				} else {
					$('header nav').removeClass('nav-open open-dave open-jo open-both');
					$('header nav').addClass('nav-open open-both');
				}
			});
			$('header h1 span').click(function(){
				
				if($(this).hasClass('show-dave')) {
					$('header nav').removeClass('nav-open open-dave open-jo open-both');
					$('header nav').addClass('nav-open open-dave');
				} else if($(this).hasClass('show-jo')) {
					$('header nav').removeClass('nav-open open-dave open-jo open-both');
					$('header nav').addClass('nav-open open-jo');
				} else {
					$('header nav').removeClass('nav-open open-dave open-jo open-both');
					$('header nav').addClass('nav-open open-both');
				}
			});
			
			$('.nav-bg').hover(function(){
				$('header nav').removeClass('nav-open open-dave open-jo open-both');
			});
			$('header h1 a').click(function(){
				// if($('header nav').hasClass('nav-open')){
				// 	$('header nav').removeClass('nav-open open-dave open-jo open-both');
				// }
				
				return false;
			});
			
		},
		home_nav: function(){
			$(window).resize(function(){
				//console.log(SITE.scrollPos, SITE.homeNavPos);
				if($(window).width() > 650 && SITE.scrollPos <= SITE.homeNavPos){
					$('body.home header').addClass('hidden');
				} else {
					$('body.home header').removeClass('hidden');
				}
			});
			
			$(window).scroll(function(){
				SITE.on_scroll();
			});
		},
		mobile_nav: function(){
			$('.mobile-menu').click(function(){
				if($(this).hasClass('open')){
					$('html').removeClass('disabled').css('height', 'auto');
					$(this).removeClass('open');
					$('.mobile-nav').css('right', '-75%');
					$('.mobile-no-nav').css('right', '-75%');
				} else {
					$('html').addClass('disabled');
					$('.coastline').css('height', $(document).outerHeight(true));
					$(this).addClass('open');
					$('.mobile-nav').css('right', '0%');
					$('.mobile-no-nav').css('right', '70%');
				}
				return false;
			});
			$('.mobile-no-nav').click(function(){
				$('html').removeClass('disabled').css('height', 'auto');
				$('.mobile-menu').removeClass('open');
				$('.mobile-nav').css('right', '-75%');
				$('.mobile-no-nav').css('right', '-75%');
			});
		},
		on_scroll: function() {
			SITE.scrollPos = $(window).scrollTop();
			SITE.homeNavPos = $('.page-hero li.plan h2').offset().top - 65;
			
			if(SITE.scrollPos >= SITE.homeNavPos) {
				$('header').removeClass('hidden');
				$('header').css('height', '70px');
			} else {
				$('header').addClass('hidden');
				$('header').css('height', '100px');
			}
		},
		on_submit: function() {
			
			//callback handler for form submit
			$('.submit-btn').click(function(){
				var firstName = $('#firstName');
				var lastName = $('#lastName');
				var email = $('#email');
				linkoff = $('.post-submit a').prop('href');
				
				if(firstName.val() && lastName.val() && email.val()){
					$('.post-submit a').attr('href', linkoff + '?firstName=' + firstName.val() + '&lastName=' + lastName.val() + '&email=' + email.val());
					ga('send', 'event', 'Sign Up Here', 'Button Click', 'Signup');
				}
			});
			
			$('#external-newsletter input.submit-btn').click(function(){
				ga('send', 'event', 'Business Solutions Sign Up Here', 'Button Click', 'Signup2');
			});
			
			$('#moreInfoSubmit').submit(function(e){
				ga('send', 'event', 'Business Solutions Sign Up Here', 'Button Click', 'Signup2');
				
				// put more code here when we have it from vendor
			});
			
		}
	};


	$(function(){
		SITE.init();
	});

})(jQuery);