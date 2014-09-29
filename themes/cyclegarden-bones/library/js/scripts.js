/*
 * Bones Scripts File
 * Author: Eddie Machado
 *
 * This file should contain any js scripts you want to add to the site.
 * Instead of calling it in the header or throwing it inside wp_head()
 * this file will be called automatically in the footer so as not to
 * slow the page load.
 *
 * There are a lot of example functions and tools in here. If you don't
 * need any of it, just remove it. They are meant to be helpers and are
 * not required. It's your world baby, you can do whatever you want.
*/


/*
 * Get Viewport Dimensions
 * returns object with viewport dimensions to match css in width and height properties
 * ( source: http://andylangton.co.uk/blog/development/get-viewport-size-width-and-height-javascript )
*/
function updateViewportDimensions() {
	var w=window,d=document,e=d.documentElement,g=d.getElementsByTagName('body')[0],x=w.innerWidth||e.clientWidth||g.clientWidth,y=w.innerHeight||e.clientHeight||g.clientHeight;
	return { width:x,height:y }
}
// setting the viewport width
var viewport = updateViewportDimensions();


/*
 * Throttle Resize-triggered Events
 * Wrap your actions in this function to throttle the frequency of firing them off, for better performance, esp. on mobile.
 * ( source: http://stackoverflow.com/questions/2854407/javascript-jquery-window-resize-how-to-fire-after-the-resize-is-completed )
*/
var waitForFinalEvent = (function () {
	var timers = {};
	return function (callback, ms, uniqueId) {
		if (!uniqueId) { uniqueId = "Don't call this twice without a uniqueId"; }
		if (timers[uniqueId]) { clearTimeout (timers[uniqueId]); }
		timers[uniqueId] = setTimeout(callback, ms);
	};
})();

// how long to wait before deciding the resize has stopped, in ms. Around 50-100 should work ok.
var timeToWaitForLast = 100;


/*
 * Here's an example so you can see how we're using the above function
 *
 * This is commented out so it won't work, but you can copy it and
 * remove the comments.
 *
 *
 *
 * If we want to only do it on a certain page, we can setup checks so we do it
 * as efficient as possible.
 *
 * if( typeof is_home === "undefined" ) var is_home = $('body').hasClass('home');
 *
 * This once checks to see if you're on the home page based on the body class
 * We can then use that check to perform actions on the home page only
 *
 * When the window is resized, we perform this function
 * $(window).resize(function () {
 *
 *    // if we're on the home page, we wait the set amount (in function above) then fire the function
 *    if( is_home ) { waitForFinalEvent( function() {
 *
 *      // if we're above or equal to 768 fire this off
 *      if( viewport.width >= 768 ) {
 *        console.log('On home page and window sized to 768 width or more.');
 *      } else {
 *        // otherwise, let's do this instead
 *        console.log('Not on home page, or window sized to less than 768.');
 *      }
 *
 *    }, timeToWaitForLast, "your-function-identifier-string"); }
 * });
 *
 * Pretty cool huh? You can create functions like this to conditionally load
 * content and other stuff dependent on the viewport.
 * Remember that mobile devices and javascript aren't the best of friends.
 * Keep it light and always make sure the larger viewports are doing the heavy lifting.
 *
*/

/*
 * We're going to swap out the gravatars.
 * In the functions.php file, you can see we're not loading the gravatar
 * images on mobile to save bandwidth. Once we hit an acceptable viewport
 * then we can swap out those images since they are located in a data attribute.
*/
function loadGravatars() {
  // set the viewport using the function above
  viewport = updateViewportDimensions();
  // if the viewport is tablet or larger, we load in the gravatars
  if (viewport.width >= 768) {
  jQuery('.comment img[data-gravatar]').each(function(){
    jQuery(this).attr('src',jQuery(this).attr('data-gravatar'));
  });
	}
} // end function


/*
 * Put all your regular jQuery in here.
*/
jQuery(document).ready(function($) {

	/*
	* Let's fire off the gravatar function
	* You can remove this if you don't need it
	*/
	loadGravatars();
	
	$('.TRIGGER_NAV_OV').click(function(e) {
		e.preventDefault();
		$(this).toggleClass('active');
		var ov = $('.NAV_OV');
		ov.toggleClass('open');
		if (ov.hasClass('open')) {
			equalHeight($,ov.find('.nav > li > .sub-menu'));
		}
	});

	$('#gallery_item_ov').dialog({
		autoOpen:false,
		dialogClass:'gallery-item-ov-wrap',
		modal:true,
		hide:130,
		show:250,
		open: function(e,ui) {
			setGalleryOvSize();
			thisDialog = $(this);
			$('.ui-widget-overlay').click(function() {
				thisDialog.dialog('close')
				
			});
			/*$(this).closest('.gallery-item-ov-wrap').css({
				margin:'-'+($(this).closest('.gallery-item-ov-wrap').height()/2)+'px 0 0 -'+($(this).closest('.gallery-item-ov-wrap').width()/2)+'px'
			})*/
		},
		width:'auto'
	}).on('click', '.PREV, .NEXT', function(e) {
		e.preventDefault();
		if ($(this).hasClass('disabled')) { return false }
		if ($(this).hasClass('PREV')) {
			$('#gallery_item_ov').data('current').prev().find('a').click();
		} else if ($(this).hasClass('NEXT')) {
			$('#gallery_item_ov').data('current').next().find('a').click();
		}
	})
	$('.gallery').on('click', 'figure .gallery-icon > a', function(e) {
		e.preventDefault();
		var thisItem = $(this).closest('.gallery-item');
		$('#gallery_item_ov img').attr({
			'src':thisItem.find('.IMG_SRC').val(),
			'alt':$(this).find('img').attr('alt')
		})
		$('#gallery_item_ov').data({
			'width':thisItem.find('.IMG_WIDTH').val(),
			'height':thisItem.find('.IMG_HEIGHT').val(),
			'current':thisItem
		}).dialog('open')
		if (thisItem.is(':first-child')) {
			$('#gallery_item_ov .PREV').addClass('disabled');
		} else {
			$('#gallery_item_ov .PREV').removeClass('disabled');
		}
		if (thisItem.is(':last-child')) {
			$('#gallery_item_ov .NEXT').addClass('disabled');
		} else {
			$('#gallery_item_ov .NEXT').removeClass('disabled');
		}
	})

	$(window).resize(function() {
		if(this.resizeTO) {clearTimeout(this.resizeTO)}
		this.resizeTO = setTimeout(function() {
			$(this).trigger('resizeEnd');
		}, 150)
	})
	$(window).bind('resizeEnd',function() {
		setGalleryOvSize()
		adminBarMove = $('#wpadminbar').outerHeight()-1
	})
	
	function setGalleryOvSize() {
		var ov = $('#gallery_item_ov')
		var win = $(window)
		var ratio = ov.data('width') / ov.data('height')
		var border = win.width() > 480 ? 15 : 0
		var margin = win.width() > 480 ? 100 : 0
		var width, height
		if (win.width() - margin < ov.data('width') || win.height() - margin < ov.data('height')) {
			if (ratio >= win.width() / win.height()) {
				width = win.width()-margin
				height = (win.width()-margin) / ratio
			} else {
				width = (win.height()-margin) * ratio
				height = win.height()-margin
			}
		} else {
			width = ov.data('width')
			height = ov.data('height')
		}
		ov.width(width).height(height).closest('.gallery-item-ov-wrap').css('margin','-'+((height/2)+border)+'px 0 0 -'+((width/2)+border)+'px')
		ov.find('img').width(width).height(height)
	}
	
	if ( typeof is_parallax === "undefined" ) var is_parallax = $('body').hasClass('page-template-page-parallax-php');
	
	if (is_parallax) {
		parallaxBackground($,$('#content > section'))
	}
	
	// Hide wp admin bar
	var adminBarMove = $('#wpadminbar').outerHeight()-1
	$('#wpadminbar').animate({
		'top':'-='+adminBarMove
	}, 2000,function() {
	}).hover(
		function(){
			$('#wpadminbar').stop().css('top','0').toggleClass('wpadminbar-shown');
		},
		function(){
			$('#wpadminbar').animate({
				'top':'-='+adminBarMove
			}, 2000).toggleClass('wpadminbar-shown');
		}
	).append('<div class="wpadminbar-activator"></div>');
}); /* end of as page load scripts */

function parallaxBackground($,el) {
	var win = $(window);
	win.scroll(function() {
		el.each(function(k) {
			var topEdge = $(this).offset().top - win.scrollTop() - win.height();
			var bottomEdge = $(this).offset().top - win.scrollTop() + $(this).outerHeight();
			var range = bottomEdge-topEdge;
			var bgPosition = Math.round(topEdge / range * -100);
			bgPosition = bgPosition < 0 ? 0 : bgPosition > 100 ? 100 : bgPosition;
			$(this).css('background-position','50% '+bgPosition+'%');
			/*if (k == 0) {
				console.log('element relative to document: '+$(this).offset().top);
				console.log('window scroll: '+$(window).scrollTop());
				console.log('element relative to window: '+($(this).offset().top - win.scrollTop()));
				console.log('bottom of element relative to window: '+($(this).offset().top - win.scrollTop() + $(this).outerHeight()));
				console.log('element relative to window - window height: '+( $(this).offset().top - win.scrollTop() - win.height() ));
				console.log('range: '+range)
				console.log(topEdge / range * -1)
				console.log(bgPosition)
			}*/
		});
	});
}

// Equal Heights: group must be a jQuery object
function equalHeight($, group) {
	var tallest = 0;
	group.each(function() {
		var thisHeight = $(this).height();
		if(thisHeight > tallest) {
			tallest = thisHeight;
		}
	});
	group.height(tallest);
}
