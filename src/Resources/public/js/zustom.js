jQuery(document).ready(function(){

	var numSlides = 4;
	var numDots = 9;

	// Find number of slides to show in slick slider based on screen width
	if(jQuery(window).width() <= 400){
		numSlides = 1;
		numDots = 2;
	}
	else if(jQuery(window).width() <= 900){
		numSlides = 2;
		numDots = 4;
	}
	else if(jQuery(window).width() <= 1100){
		numSlides = 3;
		numDots = 6;
	}

	// Load events as a slick slider	
	jQuery(".selected-year-events").slick({
		dots: false,
		infinite: true,
		slidesToShow: 1,
		slidesToScroll: 1
	});
	
	// Load event years as a slick slider
	jQuery('.event-bar').slick({
		dots: false,
		infinite: false,
		slidesToShow: numDots,
		slidesToScroll: 1
	});
    
    jQuery('.loader').css('height', jQuery('.selected-year-events').parents('.col-lg-12').height());
	
	// On year change
    jQuery(document).on('click', '.load-year', function(){
        jQuery('.active').removeClass('active').addClass('inactive');
		jQuery(this).parents('.event').removeClass('inactive').addClass('active');
		jQuery('.loader').show();
		jQuery.ajax({		
			url: location.href,
			method:'post',
			data: {
				'mode':'ajax',
				'REQUEST_TOKEN':jQuery(this).data('rt'),
				'selYear':jQuery(this).data('uid')
			},
			success: function(data) {
				if(data){
					jQuery(".selected-year-events").slick('unslick');
					jQuery('.selected-year-events').html(data);					
					jQuery(".selected-year-events").slick({
						dots: false,
						infinite: true,
						slidesToShow: 1,
						slidesToScroll: 1
					});				
				}
			},
			error: function() {
			},
			complete: function() {
				jQuery('.loader').hide();
			}
		});
	});
    
});
