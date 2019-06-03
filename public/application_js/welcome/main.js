jQuery(function($){

	"use strict"; 

	var win = $(window);
	var doc = $(document);

	/*----------------------/
	/* MAIN NAVIGATION
	/*---------------------*/
		
	win.on('scroll', function() {
		if(win.width() > 1024) {
			if(doc.scrollTop() > (win.height() / 2)) {
				setNavbarLight();
			}else {
				setNavbarTransparent();
			}
		}
	});	
	
	function toggleNavbar() {
		if(win.width() > 1024 && (doc.scrollTop() <= win.height())) {
			setNavbarTransparent();
		} else {
			setNavbarLight();
		}
	}

	toggleNavbar();

	win.on('resize', function() {
		toggleNavbar();	
	});

	/* Navbar Setting */
	function setNavbarLight() {
		$('.navbar').addClass('navbar-light');
	}

	function setNavbarTransparent() {
		$('.navbar').removeClass('navbar-light');
	}

	// Hide Collapsible Menu
	$('.navbar-nav li a').on('click', function() {
		if($(this).parents('.navbar-collapse.collapse').hasClass('in')) {
			$('#main-nav').collapse('hide');
		}		
	});

	$('body').localScroll({
		duration: 2000,
		easing: 'easeInOutExpo',
		offset: -70
	});

	var magicCanvas = $.magicCanvas;

	if(win.width() > 1024) {
		magicCanvas.draw({
	        type: "random-move",
		    zIndex: -1,

	        rgb : function (circlePos) {
	            var px = circlePos.x;
	            var py = circlePos.y;

	            return { r: parseInt(173), g: parseInt(0), b: 255 };
	        }
	    })
	}

	var wow = new WOW();

	wow.init();
			
	$("#owl-testimonials").owlCarousel({

		slideSpeed : 1000,
		paginationSpeed : 2000,
		singleItem: true,
		items: 1,
		
		//Autoplay
		autoPlay : 5000,
		stopOnHover : false

	});
		 
	/*----------------------/
	/* MAIN TOP SUPERSIZED
	/*---------------------*/

	if($('.main-top').length > 0) {
		$.supersized({
				
			// Functionality		
			autoplay: 1,				// Slideshow starts playing automatically
			slide_interval: 7000,		// Length between transitions
			transition: 1, 				// 0-None, 1-Fade, 2-Slide Top, 3-Slide Right, 4-Slide Bottom, 5-Slide Left, 6-Carousel Right, 7-Carousel Left
			transition_speed: 1000,		// Speed of transition				
													   										   
			// Components							
			slide_links: 'blank',		// Individual links for each slide (Options: false, 'num', 'name', 'blank')
			thumb_links: 0,				// Individual thumb links for each slide
			slides:  	[				// Slideshow Images
							{image : 'application_images/welcome/asarsoftbg01.jpg', title : '', thumb : '', url : ''}
						],
		});

	}
	
	/*----------------------/
	/* PORTFOLIO
	/*---------------------*/

	/* Init Isotope */

	var $container = $('.isotope');

	win.load(function() {
        $container.isotope({
	      itemSelector: '.work-item'
 		});
    });

    // Filter functions
    var filterFns = {
      // Show if number is greater than 50
      numberGreaterThan50: function() {
        var number = $(this).find('.number').text();
        return parseInt(number, 10) > 50;
      },
      // Show if name ends with -ium
      ium: function() {
        var name = $(this).find('.name').text();
        return name.match(/ium$/);
      }
    };

    // Bind filter button click
    $('#filters').on('click', 'a', function() {
      var filterValue = $(this).attr('data-filter');
      // use filterFn if matches value
      filterValue = filterFns[ filterValue ] || filterValue;
      $container.isotope({ filter: filterValue });
    });

    // Change is-checked class on buttons
    $('.filter_group').each(function(i, buttonGroup) {
      var $buttonGroup = $(buttonGroup);
      $buttonGroup.on('click', 'a', function() {
        $buttonGroup.find('.active').removeClass('active');
        $(this).addClass('active');
      });
    });

    var $container = $('#container');
    $container.isotope({
      itemSelector : '.element',
      masonry : {
        columnWidth : 0
      },
      masonryHorizontal : {
        rowHeight: 0
      },
      cellsByRow : {
        columnWidth : 0,
        rowHeight : 0
      },
      cellsByColumn : {
        columnWidth : 0,
        rowHeight : 0
      },
      getSortData : {
        symbol : function($elem) {
          return $elem.attr('data-symbol');
        },
        category : function($elem) {
          return $elem.attr('data-category');
        },
      }
    });
    
	var $sortBy = $('#sort-by');
    $('#shuffle a').on('click', function() {
      $container.isotope('shuffle');
      $sortBy.find('.selected').removeClass('selected');
      $sortBy.find('[data-option-value="random"]').addClass('selected');
      return false;
    });
	
	/* Init Isotope */

	var $container = $('.isotope');

	win.load(function() {

	    $container.isotope({
	      itemSelector: '.work-item'
	 	});

	});

    // Filter functions
    var filterFns = {
      // Show if number is greater than 50
      numberGreaterThan50: function() {
        var number = $(this).find('.number').text();
        return parseInt(number, 10) > 50;
      },
      // Show if name ends with -ium
      ium: function() {
        var name = $(this).find('.name').text();
        return name.match(/ium$/);
      }
    };

    // Bind filter button click
    $('#filters').on('click', 'a', function() {
      var filterValue = $(this).attr('data-filter');
      // use filterFn if matches value
      filterValue = filterFns[ filterValue ] || filterValue;
      $container.isotope({ filter: filterValue });
    });

    // Change is-checked class on buttons
    $('.filter_group').each(function(i, buttonGroup) {
      var $buttonGroup = $(buttonGroup);
      $buttonGroup.on('click', 'a', function() {
        $buttonGroup.find('.active').removeClass('active');
        $(this).addClass('active');
      });
    });

	var originalTitle, currentItem;

	$('.media-popup').magnificPopup({
		type: 'image',
		callbacks: {
			beforeOpen: function() {
				// modify item title to include description
				currentItem = $(this.items)[this.index];
				originalTitle = currentItem.title;
				currentItem.title = '<h3>' + originalTitle + '</h3><hr />' + '<p>' + $(currentItem).parents('.work-item').find('img').attr('alt') + '</p>';

				// adding animation				
				this.st.mainClass = 'mfp-fade'; 
			},
			close: function() {
				currentItem.title = originalTitle; 
			}
		}
		
	});

	/*----------------------/
	/* SCROLL TO TOP
	/*---------------------*/

	if(win.width() > 992) {
		win.on('scroll', function() {
			if($(this).scrollTop() > 500) {
				$('.back-to-top').fadeIn();
			} else {
				$('.back-to-top').fadeOut();
			}
		});

		$('.back-to-top').on('click', function(e) {
			e.preventDefault();

			$('body, html').animate({
				scrollTop: 0
			}, 2000, 'easeInOutExpo');
		});	
	}

	if (!navigator.userAgent.match("Opera/")) {
		$('body').scrollspy({
			target: '#main-nav'
		});
	}else {
		$('#main-nav .nav li').removeClass('active');
	}

	
	

	
		var topImage01=$("<img>",{
	"src":"application_images/welcome/asarsoftbg9.png",
"class":"moveTarget0 moveTarget"

});
	$($("#supersized li a")[0]).append(topImage01);
	
	var topImage01=$("<img>",{
	"src":"application_images/welcome/asarsoftbg10.png",
"class":"moveTarget1 moveTarget"

});

$($("#supersized li a")[0]).append(topImage01);

		topImage01=$("<img>",{
	"src":"application_images/welcome/asarsoftbg11.png",
"class":"moveTarget2 moveTarget"

});
$($("#supersized li a")[0]).append(topImage01);

	topImage01=$("<img>",{
	"src":"application_images/welcome/asarsoftbg12.png",
"class":"moveTarget3 moveTarget"

});
$($("#supersized li a")[0]).append(topImage01);
	
	
	



	var trackingArea=$("#top");
	
	var moveArea0=$(".moveTarget0");
	
	var moveArea1=$(".moveTarget1");
	var moveArea2=$(".moveTarget2");
	var moveArea3=$(".moveTarget3");
	
    var maxRotationDegreesX = 60;
    var maxRotationDegreesY = 60;
    var perspectivePx = 600;
	
	        var trackingAreaShiftX = trackingArea.offset().left;
        var trackingAreaShiftY = trackingArea.offset().top;

        var halfTrackingAreaWidth = trackingArea.width() / 2;
        var halfTrackingAreaHeight = trackingArea.height() / 2;

        var mouseCoordinateCorrectionX = trackingAreaShiftX + halfTrackingAreaWidth;
        var mouseCoordinateCorrectionY = trackingAreaShiftY + halfTrackingAreaHeight;

        trackingArea.on("mousemove", function () {
            var x = event.clientX - mouseCoordinateCorrectionX;
            var y = event.clientY - mouseCoordinateCorrectionY;
            var rotationY = x * maxRotationDegreesX / halfTrackingAreaWidth/9;
            var rotationX = -y * maxRotationDegreesY / halfTrackingAreaHeight/9;
            var transform = `perspective(${perspectivePx}px) rotate3d(1, 0, 0, ${rotationX}deg) rotate3d(0, 1, 0, ${rotationY}deg)`;
            moveArea1.css("-webkit-transform", transform);
            moveArea1.css("-moz-transform", transform);
            moveArea1.css("-ms-transform", transform);
            moveArea1.css("-o-transform", transform);
            moveArea1.css("transform", transform);
			
			
			var rotation2Y = -x * maxRotationDegreesX / halfTrackingAreaWidth/15;
            var rotation2X = y * maxRotationDegreesY / halfTrackingAreaHeight/15;
            transform = `perspective(${perspectivePx}px) rotate3d(1, 0, 0, ${rotation2X}deg) rotate3d(0, 1, 0, ${rotation2Y}deg)`;
            moveArea2.css("-webkit-transform", transform);
            moveArea2.css("-moz-transform", transform);
            moveArea2.css("-ms-transform", transform);
            moveArea2.css("-o-transform", transform);
            moveArea2.css("transform", transform);
			
			
			var rotation3Y = x * maxRotationDegreesX / halfTrackingAreaWidth/24;
            var rotation3X = -y * maxRotationDegreesY / halfTrackingAreaHeight/24;
            transform = `perspective(${perspectivePx}px) rotate3d(1, 0, 0, ${rotation3X}deg) rotate3d(0, 1, 0, ${rotation3Y}deg)`;
            moveArea3.css("-webkit-transform", transform);
            moveArea3.css("-moz-transform", transform);
            moveArea3.css("-ms-transform", transform);
            moveArea3.css("-o-transform", transform);
            moveArea3.css("transform", transform);
			
			var rotation0Y = x * maxRotationDegreesX / halfTrackingAreaWidth/100;
            var rotation0X = -y * maxRotationDegreesY / halfTrackingAreaHeight/100;
            transform = `perspective(${perspectivePx}px) rotate3d(1, 0, 0, ${rotation0X}deg) rotate3d(0, 1, 0, ${rotation0Y}deg)`;
            moveArea0.css("-webkit-transform", transform);
            moveArea0.css("-moz-transform", transform);
            moveArea0.css("-ms-transform", transform);
            moveArea0.css("-o-transform", transform);
            moveArea0.css("transform", transform);
			
			
        });
	
});

var changeImageSizes=function(){
		var globalWidth=$($(".slide-0 a img")[0]).css("width");
	var globalHeight=$($(".slide-0 a img")[0]).css("height");
	var globalTop=$($(".slide-0 a img")[0]).css("top");
	var globalLeft=$($(".slide-0 a img")[0]).css("left");

	$(".moveTarget").css({
		"width":globalWidth,
		"height":globalHeight,
		"position": "absolute",
		"z-index": 999,
		"left":globalLeft,
		"top":globalTop
	});
	console.log("changed");
	
};

$(window).on('load', function() {

changeImageSizes();

});
$( window ).resize(function(e) {

});


var rtime;
var timeout = false;
var delta = 200;
$(window).resize(function() {
    rtime = new Date();
    if (timeout === false) {
        timeout = true;
        setTimeout(resizeend, delta);
    }
});

function resizeend() {
    if (new Date() - rtime < delta) {
        setTimeout(resizeend, delta);
    } else {
        timeout = false;
					var globalWidth=$($(".slide-0 a img")[0]).css("width");
	var globalHeight=$($(".slide-0 a img")[0]).css("height");
	var globalTop=$($(".slide-0 a img")[0]).css("top");
	var globalLeft=$($(".slide-0 a img")[0]).css("left");

	$(".moveTarget").css({
		"width":globalWidth,
		"height":globalHeight,
		"position": "absolute",
		"z-index": 999,
		"left":globalLeft,
		"top":globalTop
	});
    }               
}

/*About functions hover*/

$(".box3").hover(function(){
$(".box3 p").css("padding-bottom","20%");

$(".box3").css("background-color","#29265f");
$(".box2").css("background-color","#0077b3");
$(".box1").css("background-color","#0077b3");

$(".box2 p").css("padding-bottom","7%");
$(".box1 p").css("padding-bottom","7%");
},
function(){
$(".box3 p").css("padding-bottom","7%");
$(".box2 p").css("padding-bottom","20%");
$(".box1 p").css("padding-bottom","7%");

$(".box1").css("background-color","#0077b3");
$(".box2").css("background-color","#29265f");
$(".box3").css("background-color","#0077b3");
}
);



$(".box1").hover(function(){
$(".box3 p").css("padding-bottom","7%");

$(".box2 p").css("padding-bottom","7%");
$(".box1 p").css("padding-bottom","20%");

$(".box1").css("background-color","#29265f");
$(".box2").css("background-color","#0077b3");
$(".box3").css("background-color","#0077b3");
},
function(){
$(".box3 p").css("padding-bottom","7%");
$(".box2 p").css("padding-bottom","20%");
$(".box1 p").css("padding-bottom","7%");

$(".box1").css("background-color","#0077b3");
$(".box2").css("background-color","#29265f");
$(".box3").css("background-color","#0077b3");
}
);



$(".box2").hover(function(){
$(".box3 p").css("padding-bottom","7%");

$(".box2 p").css("padding-bottom","20%");
$(".box1 p").css("padding-bottom","7%");

$(".box1").css("background-color","#0077b3");
$(".box2").css("background-color","#29265f");
$(".box3").css("background-color","#0077b3");
},
function(){
$(".box3 p").css("padding-bottom","7%");
$(".box2 p").css("padding-bottom","20%");
$(".box1 p").css("padding-bottom","7%");

$(".box1").css("background-color","#0077b3");
$(".box2").css("background-color","#29265f");
$(".box3").css("background-color","#0077b3");
}
);