/* Helpers */

	var fullWidth;
	var fullHeight;
	var scrollX;
	var scrollY;
	var mH = 0;		// Invisible element height
	var t = 0;		// Gallery ticker

$(document).ready(function(){
	
	$('.show-nav').click(function(){
		if($(this).hasClass('on')){
			$('.face').slideUp(500);
			$(this).removeClass('on');
		} else{
			$('.face').slideDown(500);
			$(this).addClass('on');
		}
		
		return false;
	});
	
	$('img.aligncenter').each(function(){
		$(this).parent('p').addClass('aligncenter');
	});
	
	$('h6.caption').each(function(){
		var imgWidth = $(this).prev('p').children('img').width();
		var img = $(this).prev('p').children('img');
		if($(this).prev('p').length==0){
			imgWidth = $(this).parent().find('img').width();
			img = $(this).parent().find('img');
		}
		$(this).css('width', imgWidth-22);
		if(img.hasClass('aligncenter')){
			$(this).css('marginLeft', 'auto').css('marginRight', 'auto');
		}
		
	});
	
	fullWidth = $(window).width();
	fullHeight = $(window).height();
	scrollX = $(window).scrollLeft();
	scrollY = $(window).scrollTop();
	
	
	$('#content.home .post-list a.img').each(function(){
		var imgHeight = $(this).children('img').height();
		var spaceHeight = $(this).height();
		if(imgHeight<spaceHeight){
			imgMargin = -(imgHeight-spaceHeight)/2;
			$(this).children('img').css('marginTop',imgMargin);
			$(this).css('background','#000000');
			
		}
	});
	
	
	$('form input[type="text"], form input[type="password"], input[name="searchBox"]').focus(function() {
			if( this.value == this.defaultValue ) {
				this.value = "";
			}
		}).blur(function() {
			if( !this.value.length ) {
				this.value = this.defaultValue;
			}
	});
	
	$('input[type="text"], input[type="password"]').addClass('text');
	
	$('.btn').each(function(){
		$(this).wrapInner('<span class="text" />');
		$(this).append('<span class="left"></span><span class="right"></span>');
	});
	
	$('#content div.work-list ul li a span.img img').each(function(){
		if($(this).hasClass('no-img')){
		}
		else{
			var imgHeight = $(this).height();
			var spanHeight = $(this).parent().height();
			var imgPadding = (spanHeight - imgHeight)/2;
			$(this).css('paddingTop',imgPadding);
		}
	});
	
	$('.mouth li').hover(function(){
		$(this).addClass('on');
	}, function(){
		$(this).removeClass('on');
	})

	//## Slideshow
	$('#slideShow div ol').each(function(){
		var w = ( $('#slideShow div ol li').length ) * 959;
		$('#slideShow div ol').width(w);
	});
	
	$('#slideShow dl').each(function(){
		var w = ( $('#slideShow div ol li').length ) * 40;
		$(this).css({
			left: ( 959 - w ) / 2
		})
	})
	
	$('#slideShow a.forward').click(function(){
		nextSlide();
		return false;
	});
	
	$('#slideShow a.back').click(function(){
		prevSlide();
		return false;
	})
	
	$('#slideShow dl dd ol li').each(function(){
		var q = $('#slideShow dl dd ol li').index(this);
		$(this).click(function(){
			var r = $('#slideShow div ol li').eq(q).position(); 
			$('#slideShow div ol').animate({
				'left' : -(r.left)
			},1500,function(){
				$('#slideShow dl dd ol li').removeClass('on');
				$('#slideShow dl dd ol li').eq(q).addClass('on');
			});
			return false;
		})
	});
	
	$('#slideShow div ol li').each(function(){
		var num = parseInt($("#slideShow div ol li").index(this))+1;
		$(this).attr('id','num'+num);
	});
	
	//## Open Modal
	$('.launch-modal').click(function(){
		which = $(this).attr('href');
		openModal(which);
		return false;
	})

	//## Close modal with buttons
	$('.close-modal, .modal .cancel, #userGuide button').click(function(){
		$('#modals').fadeOut('slow',function(){
			$('html').css({'overflow':'auto'});
			$('div.modal').css({'display' : 'none'});
		});
		return false;
	});
	
	//## Close modal by clicking off
	$('#modals').click(function(e){
		if ( $(e.target).attr('id') == "modals" ) {
			$('#modals').fadeOut('slow',function(){
				$('html').css({'overflow':'auto'});
				$('div.modal').css({'display' : 'none'});
			});
		} else return; 
	});
	
	//## Modal Gallery
	
	$('#gallery').each(function(){
		var num = $('#gallery img').length;
		$('#gallery img').hide();
		$('#gallery img:eq(0)').show();
		$('#gallery span.total').text(num);
	});
	
	$('#gallery a.prev').click(function(){
		if ( t != 0 ) {
			$('#gallery img').eq(t).fadeOut('slow',function(){
				$('#gallery img').eq(t-1).fadeIn('slow',function(){
					t = t-1;
					$('#gallery span.current').text(t+1);
				});
			});
		} else { 
			var lastImg = $('#gallery img').length;
			$('#gallery img').eq(t).fadeOut('slow',function(){
				$('#gallery img').eq(lastImg-1).fadeIn('slow',function(){
					t = lastImg-1;
					$('#gallery span.current').text(lastImg);
				});
			});
		}
		return false;
	});
	
	$('#gallery a.next').click(function(){
		if ( t != ($('#gallery img').length-1) ) {
			$('#gallery img').eq(t).fadeOut('slow',function(){
				$('#gallery img').eq(t+1).fadeIn('slow',function(){
					t = t+1;
					$('#gallery span.current').text(t+1);
				});
			});
		} else { 
			$('#gallery img').eq(t).fadeOut('slow',function(){
				$('#gallery img').eq(0).fadeIn('slow',function(){
					t = 0;
					$('#gallery span.current').text('1');
				});
			});
		}
		return false;
	});
	
	//## Sniff sniff is right!
		
	var chrome = navigator.userAgent.indexOf('Chrome');
	var ff = navigator.userAgent.indexOf('Firefox');
	var os = navigator.userAgent.indexOf('Win');
	if ( (chrome != -1) && (os != -1) ) { $('body').addClass('chrome'); }
	if ( (ff != -1) ) { $('body').addClass('ff'); }
	
	$('ul.post-gallery li a').click(function(){
		var fullWidth = $(window).width();
		var fullHeight = $('#skin').outerHeight();
		var url = $(this).attr('href');
		var modalWidth = $('.modal-content').outerWidth();
		var newLeft = (fullWidth - modalWidth) / 2;
		//$('.modal-bg').css('height', fullHeight).css('width', fullWidth);
		$('.modal-content').html('<img src="'+url+'" />');
		//$('.modal-content').css('left', newLeft);
		$('.modal-content, .modal-bg, .modal').fadeIn();
		$('body').css('overflow', 'hidden');
		
		return false;
	});
	
	$('.modal-bg').click(function(){
		$('.modal-bg, .modal-content, .modal').fadeOut();
		$('body').css('overflow', 'visible');
	});
	
});

$(window).resize(function(){

	var fullWidth = $(window).width();
	var fullHeight = $('#skin').outerHeight();
	var modalWidth = $('.modal-content').outerWidth();
	var newLeft = (fullWidth - modalWidth) / 2;
	//$('.modal-bg').css('height', fullHeight).css('width', fullWidth);
	//$('.modal-content').css('left', newLeft);
	
	$('h6.caption').each(function(){
		var imgWidth = $(this).prev('p').children('img').width();
		var img = $(this).prev('p').children('img');
		if($(this).prev('p').length==0){
			imgWidth = $(this).parent().find('img').width();
			img = $(this).parent().find('img');
		}
		$(this).css('width', imgWidth-22);
		if(img.hasClass('aligncenter')){
			$(this).css('marginLeft', 'auto').css('marginRight', 'auto');
		}
		
	});
	
});


function openModal(which){
	var w = $(which);
	$('div.modal-wrap',which).findHeight();
	$('html').css({'overflow':'hidden'});
	fullWidth = $(window).width();
	fullHeight = $(window).height();
	scrollX = $(window).scrollLeft();
	scrollY = $(window).scrollTop();
	w.css({
		'margin-top' : (fullHeight-(mH+100))/2,
		'display' : 'inline-block'
	});
	$('#modals').css({
		'top' : scrollY,
		'left' : scrollX,
		'height' : fullHeight,
		'width' : fullWidth
	}).fadeIn('slow');		
}

function nextSlide(){
	var y = $('#slideShow div ol').position();
	if (y.left >= (0 - ($('#slideShow div ol li').length-2) * 959)) {
		var a = y.left - 959
	} else { var a = 0 }
	$('#slideShow div ol').animate({
		'left': a
	},800,function(){
		$('#slideShow dl dd ol li').removeClass('on');
		if ( (0-(y.left/959)) < ($('#slideShow div ol li').length-1)) {
			$('#slideShow dl dd ol li').eq((0-(y.left/959))+1).addClass('on');
		} else {
			$('#slideShow dl dd ol li').eq(0).addClass('on');
		}
	});
}

function prevSlide(){
	var y = $('#slideShow div ol').position();
	if (y.left < 0) {
		var a = y.left + 959
	} else { var a = 0-( ($('#slideShow div ol li').length-1) * 959) }
	$('#slideShow div ol').animate({
		'left': a
	},800,function(){
		$('#slideShow dl dd ol li').removeClass('on');
		if ( (0-(y.left/959)) < ($('#slideShow div ol li').length-1)) {
			$('#slideShow dl dd ol li').eq((0-(y.left/959))-1).addClass('on');
		} else {
			$('#slideShow dl dd ol li').eq(0).addClass('on');
		}
	});
}

jQuery.fn.findHeight = function(){
	
	return $(this).each(function() {
		$('#newGuy').remove();
		$(this).clone(true)
			.attr('id','newGuy')
			.appendTo('body');
		mH = $('#newGuy').height();
	});
	
};

jQuery.fn.equalize = function(){
	
    tallest = 0;
    group.each(function() {
        thisHeight = $(this).height();
        if(thisHeight > tallest) {
            tallest = thisHeight;
        }
    });
    group.height(tallest);
	
};

jQuery.fn.truncate = function(){
	
	var defaults = {
		charNum: 60
	};
	
	var options = $.extend(defaults, options);
		
	return this.each(function() {
		var q = $(this).text();
		var r = q.substr(0,options.charNum);
		$(this).wrapInner('<span class="full"></span>')
		$(this).prepend('<span class="short">'+r+'</span><span class="ells">&#8230;</span>');
	});
}
