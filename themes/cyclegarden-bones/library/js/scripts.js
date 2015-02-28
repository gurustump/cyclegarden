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


 /**
* jquery.imgpreload 1.6.2 <https://github.com/farinspace/jquery.imgpreload>
* Copyright 2009-2014 Dimas Begunoff <http://farinspace.com>
* License MIT <http://opensource.org/licenses/MIT>
*/
"undefined"!=typeof jQuery&&!function(a){"use strict";a.imgpreload=function(b,c){c=a.extend({},a.fn.imgpreload.defaults,c instanceof Function?{all:c}:c),"string"==typeof b&&(b=[b]);var d=[];a.each(b,function(e,f){var g=new Image,h=f,i=g;"string"!=typeof f&&(h=a(f).attr("src")||a(f).css("background-image").replace(/^url\((?:"|')?(.*)(?:'|")?\)$/gm,"$1"),i=f),a(g).bind("load error",function(e){d.push(i),a.data(i,"loaded","error"==e.type?!1:!0),c.each instanceof Function&&c.each.call(i,d.slice(0)),d.length>=b.length&&c.all instanceof Function&&c.all.call(d),a(this).unbind("load error")}),g.src=h})},a.fn.imgpreload=function(b){return a.imgpreload(this,b),this},a.fn.imgpreload.defaults={each:null,all:null}}(jQuery);


/*
 * Put all your regular jQuery in here.
*/
jQuery(document).ready(function($) {
	
	var win = $(window)

	/*
	* Let's fire off the gravatar function
	* You can remove this if you don't need it
	*/
	loadGravatars();
	
	$('.TRIGGER_NAV_OV').click(function(e) {
		e.preventDefault();
		$(this).toggleClass('active');
		$('body').toggleClass('lock');
		var ov = $('.NAV_OV');
		ov.toggleClass('open');
		if (ov.hasClass('open')) {
			if (win.width() >= 1024) {
				equalHeight($,ov.find('.nav > li'));
			} else {
				ov.find('.nav > li').removeAttr('style')
			}
		} else {
			ov.find('.nav > li').removeAttr('style')
		}
	});
	
	homeHeaderResize($,win);
	headerSlide($,win);
	win.scroll(function() {
		headerSlide($,win);
	});

	$('#video_ov').dialog({
		autoOpen:false,
		dialogClass:'video-ov-wrap ov-wrap',
		modal:true,
		hide:130,
		show:250,
		open: function(e,ui) {
			setVideoOvSize();
			thisDialog = $(this);
			$('.ui-widget-overlay').click(function() {
				thisDialog.dialog('close');
			});
		},
		close :function(e,ui) {
			$(this).empty();
			$('body').removeClass('lock');
		},
		height:win.height(),
		width:win.width()
	}).data({
		'vimeo': {
			'pre':'<iframe src="//player.vimeo.com/video/',
			'post':'?title=0&amp;byline=0&amp;portrait=0" width="1140" height="641" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>'
		},
		'youtube': {
			'pre':'<iframe width="1920" height="1080" src="http://www.youtube.com/embed/',
			'post':'?autoplay=1&amp;vq=hd1080&amp;rel=0&amp;modestbranding=1&amp;wmode=transparent" frameborder="0" allowfullscreen></iframe>'
		}
	});
	$('.VID_LAUNCH').click(function(e) {
		e.preventDefault();
		var vidOv = $('#video_ov');
		$('body').addClass('lock');
		vidOv.dialog('option', {width:win.width(),height:win.height()}).append(vidOv.data($(this).attr('data-type')).pre + $(this).attr('href') + vidOv.data($(this).attr('data-type')).post);
		vidOv.dialog('open');
	});

	$('#gallery_item_ov').dialog({
		autoOpen:false,
		dialogClass:'gallery-item-ov-wrap ov-wrap',
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
		if ($(this).hasClass('disabled')) { return false; }
		if ($(this).hasClass('PREV')) {
			$('#gallery_item_ov').data('current').prev().find('a').click();
		} else if ($(this).hasClass('NEXT')) {
			$('#gallery_item_ov').data('current').next().find('a').click();
		}
		setGalleryOvSize();
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

	win.resize(function() {
		if (this.resizeTO) {clearTimeout(this.resizeTO)}
		this.resizeTO = setTimeout(function() {
			$(this).trigger('resizeEnd');
		}, 150)
	})
	win.bind('resizeEnd',function() {
		homeHeaderResize($,win);
		setGalleryOvSize();
		adminBarMove = $('#wpadminbar').outerHeight()-1;
	})
	
	function setGalleryOvSize() {
		var ov = $('#gallery_item_ov');
		var ratio = ov.data('width') / ov.data('height');
		//var border = win.width() > 480 ? 15 : 0;
		border = 0;
		var margin = win.width() > 480 ? 40 : 0;
		var width, height
		if (win.width() - margin < ov.data('width') || win.height() - margin < ov.data('height')) {
			if (ratio >= win.width() / win.height()) {
				width = win.width()-margin;
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
	
	function setVideoOvSize() {
		
	}
	
	$('.owl-carousel').owlCarousel({
		loop:true,
		autoplay:true,
		stopOnHover: true,
		responsive: {
			0:{
				items:1
			},
			768:{
				items:2
			},
			1024:{
				items:3
			},
			1240:{
				items:4
			},
			1564:{
				items:5
			}
		}
	});
	
	if ( typeof is_parallax === "undefined" ) var is_parallax = $('body').hasClass('page-template-page-parallax-php') || $('body').hasClass('page-template-page-standard-php');
	
	if (is_parallax) {
		parallaxBackground($,win,$('#content > section.PARALLAX'))
	}
	
	if ( typeof is_standard === 'undefined' ) var is_standard = $('body').hasClass('page-template-page-standard-php');
	
	if (is_standard) {
		var columnizerLoop = 0;
		var columns = $('.COLUMNS');
		
		function runColumnsOwl() {
			var columnsOwl = $('.COLUMNS').owlCarousel({
				responsive: {
					0: {
						items:1,
						dotsEach:1,
						margin:30
					},
					768: {
						items:2,
						dotsEach:2,
						margin:30
					},
					1030: {
						items:1,
						dotsEach:1,
						margin:40
					},
					1564: {
						items:2,
						dotsEach:2,
						margin:60
					}
				},
				nav:true,
				navText:['previous','read more'],
				onInitialized:function() {
					$('.owl-next').addClass('active');
				}
			});
			columnsOwl.on('changed.owl.carousel', function(event) {
				navVisibility(event);
			});
		}
		
		function columnizerWidth() {
			var winWidth = win.width();
			if (winWidth >= 1564) {
				return 371;
			} else if (winWidth >= 1024) {
				return 350;
			} else if (winWidth >= 481) {
				return 300;
			} else {
				return winWidth;
			}
		}
		
		function columnizerHeight() {
			var winWidth = win.width();
			if (winWidth >= 768) {
				return 400;
			} else {
				return 300;
			}
		}
		columns.columnize({
			accuracy:8,
			width:columnizerWidth(),
			height:columnizerHeight(),
			ignoreImageLoading:false,
			buildOnce:true,
			doneFunc: function() {
				columns.children('div').removeAttr('style');
				columns.children('br').remove();
				columns.removeClass('raw').removeAttr('style')
				var targetColumn = columns.children('div').eq((win.width() < 768 || (win.width() >=1030 && win.width() < 1564)) ? 0 : 1);
				
				targetColumn.prepend($('.section-icon'));
				columns.find('.split').each(function() {
					if ($(this).contents().length < 1) {
						$(this).remove();
					}
				})
				runColumnsOwl();
				/* if (targetColumn.find('.section-icon').length < 1 && columnizerLoop < 10) {
					//sectionIconClone = sectionIcon.clone();
					targetColumn.prepend($('.section-icon'));
					//sectionIcon.addClass('fuck');
					columns.find('.column').each(function() {
						columns.append($(this).contents())
						$(this).remove()
					})
				} else {
					targetColumn.prepend($('.section-icon'));
					//sectionIcon.addClass('fuckorama')
					runColumnsOwl();
				} */
			}
		});
		function itemsCount() {
			return win.width() < 768 || (win.width() >=1030 && win.width() < 1564)  ? 1 : 2;
		}
		function navVisibility(event) {			
			if (event.item.index == 0) {
				$(event.target).find('.owl-prev').removeClass('active');
			} else {
				$(event.target).find('.owl-prev').addClass('active');
			}
			if (event.item.count <= event.item.index + itemsCount()) {
				$(event.target).find('.owl-next').removeClass('active');
			} else {
				$(event.target).find('.owl-next').addClass('active');
			}
		}
		
		var title = $('h1.page-title');
		resizeTitle($,title,title.css('font-size').replace('px',''));
		
		/*function setFeaturedWidth() {
			console.log(win.width())
			if (win.width() >= 1030 && win.width() < 1564) {
				$('.featured').width(Math.min(650,win.width() - 464));
			} else {
				$('.featured').removeAttr('style');
			}
		}
		setFeaturedWidth();*/
		win.resize(function () {
			//setFeaturedWidth();
			waitForFinalEvent( function() {
				title.add(title.parent('.page-header')).removeAttr('style')
				resizeTitle($,title,title.css('font-size').replace('px',''));
			}, timeToWaitForLast, 'resizeTitle');
		});
	}
	
	var speedo = $('.SPEEDO');
	var speedoHead = speedo.find('h2');
	speedoHead.data('orig',speedoHead.text());
	speedo.find('.hover, area').hover(function() {
		speedoHead.text($(this).attr('alt'));
	}, function() {
		speedoHead.text(speedoHead.data('orig'));
	});
	
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

function parallaxBackground($,win,el) {
	win.scroll(function() {
		el.each(function(k) {
			var bottomEdge = $(this).offset().top + $(this).outerHeight();
			var bgPosition = Math.round(win.scrollTop() / bottomEdge * 100);
			bgPosition = bgPosition < 0 ? 0 : bgPosition > 100 ? 100 : bgPosition;
			$(this).css('background-position','50% '+bgPosition+'%');
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

function resizeTitle($,title,maxHeight){
	if (title.height() > maxHeight) {
		title.css('font-size',(title.css('font-size').replace('px','')-1) + 'px')
		title.parent('.page-header').height(title.height())
		resizeTitle($,title,maxHeight)
	}
}

function headerSlide($,win) {
	if (win.scrollTop() > win.height() *2 / 5) {
		$('body').addClass('scrolled');
	} else {
		$('body').removeClass('scrolled');
	}
}

function homeHeaderResize($,win) {
	var homeLogo = $('#homeLogo');
	if (homeLogo.height() > win.height()) {
		homeLogo.height(win.height());
	} else {
		homeLogo.removeAttr('style');
	}
}

function vidOv ($,target) {
	var vidId = target.attr('href');
	var vidType = target.attr('data-type');
	var vidEmbed;
	if (vidType = 'vimeo') {
		vidEmbed = $('<iframe src="//player.vimeo.com/video/'+ vidId +'?title=0&amp;byline=0&amp;portrait=0" width="1140" height="641" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>');
	} else if (vidType = 'youtube') {
		vidEmbed = $('<iframe width="1920" height="1080" src="http://www.youtube.com/embed/'+ vidId +'?vq=hd1080&rel=0&modestbranding=1&wmode=transparent" frameborder="0" allowfullscreen></iframe>');
	} else {
		return false;
	}
}