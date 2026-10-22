
$(document).ready(function() {

    "use strict";
/*----------------------------------------
            Video Plugin
        ----------------------------------------*/

    var $iframe = $('iframe'),
        $videoLink = $('.video-link'),
        playerTemplate =
        '<div class="player"><div class="player__video"><div class="video-filler"></div><button class="video-close">&times;</button><iframe class="video-iframe" src="{{iframevideo}}" frameborder="0" allowfullscreen></iframe></div><div/>';

    $videoLink.on('click', function (e) {
        var localTemplate = '',
            videoWidth = parseInt($(this).data('width')),
            videoHeight = parseInt($(this).data('height')),
            videoAspect = (videoHeight / videoWidth) * 100,
            // elements
            $player = null,
            $video = null,
            $close = null,
            $iframe = null;

        e.preventDefault();

        localTemplate = playerTemplate.replace(
            '{{iframevideo}}',
            $(this).prop('href')
        );

        $player = $(localTemplate);

        $player.find('.video-filler').css('padding-top', videoAspect + '%');

        $close = $player.find('.video-close').on('click', function () {
            $(this)
                .off()
                .closest('.player')
                .hide()
                .remove();
        });

        $player.appendTo('body').addClass('js--show-video');
    });

    

 $('.input-group.date').datepicker({format: "dd.mm.yyyy"});




$('.slider-main-ab').owlCarousel({
 		loop: true,
 		margin: 20,
 		navText: ["<i class='fas fa-arrow-left'></i>", "<i class=' fas fa-arrow-right' ></i>"],
		responsive: {
 			0: {
 				items: 1
 			},
			360:{
				items: 1
			},
 			600: {
 				items:2
 			},
 			1000: {
 				items: 1
 			}	
 		}
 	});

$('.slider-des').owlCarousel({
 		loop: false,
 		dots: false,
 		nav: true,
 		margin: 0,
 		navText: ["<i class='fas fa-arrow-left'></i>", "<i class=' fas fa-arrow-right' ></i>"],
		responsive: {
 			0: {
 				items: 1
 			},
			360:{
				items: 1
			},
 			600: {
 				items: 1
 			},
 			1000: {
 				items: 3
 			}	
 		}
 	});
$('.slider-des2').owlCarousel({
 		loop: false,
 		dots: false,
 		nav: true,
 		margin: 0,
 		navText: ["<i class='fas fa-arrow-left'></i>", "<i class=' fas fa-arrow-right' ></i>"],
		responsive: {
 			0: {
 				items: 1
 			},
			360:{
				items: 1
			},
 			600: {
 				items: 1
 			},
 			1000: {
 				items: 4
 			}	
 		}
 	});
	$('#banner-home-slider').owlCarousel({
 		loop: true,
		 autoplay: true,
		     autoplayTimeout: 4000,
		     smartSpeed: 1000,
	 autoplayHoverPause:true,
		nav:true,
 		navText: ["<i class='fas fa-arrow-left'></i>", "<i class=' fas fa-arrow-right' ></i>"],
		responsive: {
 			0: {
 				items: 1
 			},
			360:{
				items: 1
			},
 			600: {
 				items:1
 			},
 			1000: {
 				items: 1
 			}	
 		}
 	});
$('.test-slider-home-1').owlCarousel({
 		loop: true,
 		margin: 30,
 		navText: ["<i class='fas fa-arrow-left'></i>", "<i class=' fas fa-arrow-right' ></i>"],
		responsive: {
 			0: {
 				items: 1
 			},
			360:{
				items: 1
			},
 			600: {
 				items: 1
 			},
 			1000: {
 				items:1
 			}	
 		}
 	});

$('.all-logo').owlCarousel({
 		loop: true,
 		margin: 0,
 		nav: true,
 		navText: ["<i class='fas fa-arrow-left'></i>", "<i class=' fas fa-arrow-right' ></i>"],
		responsive: {
 			0: {
 				items: 1
 			},
			360:{
				items: 3
			},
 			600: {
 				items: 4
 			},
 			1000: {
 				items: 6
 			}	
 		}
 	});


$('.img-nature-slider').owlCarousel({
 		loop: true,
 		margin:0,
	 autoplay: true,
		     autoplayTimeout: 4000,
		     smartSpeed: 1000,
	 autoplayHoverPause:true,
 		navText: ["<i class='fas fa-arrow-left'></i>", "<i class=' fas fa-arrow-right' ></i>"],
		responsive: {
 			0: {
 				items: 1
 			},
			360:{
				items:2
			},
 			600: {
 				items:4
 			},
 			1000: {
 				items: 5
 			}	
 		}
 	});

 	$(window).on('load', function () {
 		$('#status').fadeOut();
 		$('#preloader').delay(350).fadeOut('slow');
 	});




	/*====== Scroll to top ========*/
 	jQuery('.to-top').on('click', function(event) {
	  jQuery('html,body').animate({
		  scrollTop: 0
	  }, 1000);
	}); 
	jQuery(window).scroll(function() {
	  if (jQuery(window).scrollTop() > 100) {
		  jQuery('.to-top').fadeIn(1000);
	  } else {
		  jQuery('.to-top').fadeOut(1000);
	  };
	});
	/*====== wow js ========*/
	new WOW().init();
	
	
	
	/*====== magnificPopup Gallery ========*/
		$(".icon-tsdg").magnificPopup({
		delegate: 'a',
		type: 'image',
		gallery: {
	enabled: true
		}
	});
	
	
	  
}); 

;