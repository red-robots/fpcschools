/**
 *	Custom jQuery Scripts
 *	
 *	Developed by: Austin Crane	
 *	Designed by: Austin Crane
 */

jQuery(document).ready(function ($) {
	
	/*
	*
	*	Current Page Active
	*
	------------------------------------*/
	$("[href]").each(function() {
    if (this.href == window.location.href) {
        $(this).addClass("active");
        }
	});
	/*
        FAQ dropdowns
	__________________________________________
	*/
	$('.question').click(function() {
	 
	    $(this).next('.answer').slideToggle(500);
	    $(this).toggleClass('close');
	    $(this).find('.plus-minus-toggle').toggleClass('collapsed');
	    $(this).parent().toggleClass('active');
	 
	});

	/*
	*
	*	Responsive iFrames
	*
	------------------------------------*/
	var $all_oembed_videos = $("iframe[src*='youtube']");
	
	$all_oembed_videos.each(function() {
	
		$(this).removeAttr('height').removeAttr('width').wrap( "<div class='embed-container'></div>" );
 	
 	});
	
	/*
	*
	*	Flexslider
	*
	------------------------------------*/
	$('.flexslider').flexslider({
		animation: "fade",
        easing: "swing",
        slideshowSpeed: 8000,           //Integer: Set the speed of the slideshow cycling, in milliseconds
        animationSpeed: 700,  
	}); // end register flexslider
	
	/*
	*
	*	Colorbox
	*
	------------------------------------*/
	$('a.gallery').colorbox({
		rel:'gal',
		width: '80%', 
		height: '80%'
	});
	
    
    var times_clicked = 0;
    
    /* Smooth Scroll to Up
	------------------------------------*/
    $(window).scroll(function(){
        if ($(this).scrollTop() > 100) {
            $('.scrollup').fadeIn();
            $('body').addClass('scroll-up');
        } else {
            $('.scrollup').fadeOut();
            $('body').removeClass('scroll-up');
            if(times_clicked>0) {
                times_clicked = 0;
            }
        }
    }); 
    
    $('.scrollup').click(function(){
        $("html, body").animate({ scrollTop: 0 }, 600);
        return false;
    });
    
    
    /* Smooth Scroll to Anchor
	------------------------------------*/
    
    //Executed on page load with URL containing an anchor tag.
    if($(location.href.split("#")[1])) {
          var target = $('#'+location.href.split("#")[1]);
          if (target.length) {
            $('html,body').animate({
              scrollTop: target.offset().top - 125 //offset height of header here too.
            }, 1000);
            return false;
          }
    }
    
    $('a[href*=#]:not([href=#])').click(function() {
        times_clicked += 1;
        
        if ( $('#interiornav').length> 0 ) {
            $('#interiornav').toggleClass('nav-open');
            $('.active-area').text( $(this).text() );
            $('ul.intnav a').removeClass('active');
            $(this).addClass('active');
        }
        
        
        if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') 
            && location.hostname == this.hostname) {

          var target = $(this.hash);
          target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
          if (target.length) {
              
            if(times_clicked==1) {
                $('html,body').animate({
                  scrollTop: target.offset().top - 195 //offsets for fixed header
                }, 1000);
            } else {
                $('html,body').animate({
                  scrollTop: target.offset().top - 125 //offsets for fixed header
                }, 1000);
            }
            
            return false;
            
          }
        }
    });
    
    $("#mobile-menu").on("click",function(){
        $('#site-navigation').toggleClass('toggled');
        $('body').toggleClass('mobile-menu-open');
    });

    $('body').on('click','#subnavMobile',function(e){
        e.preventDefault();
        $('#interiornav').toggleClass('nav-open');
    });
    
    
    var $grid = $('.grid').isotope({
      itemSelector: '.grid-item',
      masonry: {
        columnWidth: '.grid-sizer'
      }
    });
    
    $('.address_state select').select2({
        placeholder: 'Select a State',
        selectOnClose: true
    });
	/*
	*
	*	Wow Animation
	*
	------------------------------------*/
	new WOW().init();

});// END #####################################    END

