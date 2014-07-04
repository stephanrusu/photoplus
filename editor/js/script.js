$(document).ready(function () {
	'use strict';
	
	//$('.zone-container').animate({left: '-'+ $('.zone-container').css('width') }, 0);
    $('.zone-container').css('left','-'+ $('.zone-container').css('width'));
    $('.openbtn').on('click', function(event) {
        event.preventDefault();
        if($('.zone-container').css('left') == '0px'){
            $('.zone-container').animate({left: '-'+ $('.zone-container').css('width') }, 500, 'easeInOutQuad');            
            $('.openbtn').removeClass('openbtn-active');
            $('.editor-logo').addClass('shadow');            
        }
        else{
            $('.zone-container').animate({left: 0}, 500, 'easeInOutQuad');
            $('.openbtn').addClass('openbtn-active');
            $('.editor-logo').removeClass('shadow')
        }
    });
	$('.show-notification').click(function (e) {							
		$('.top-right').notify({
		  message: { text: 'Project failed' },
		  type: 'danger',
		  fadeOut: {
			delay: Math.floor(Math.random() * 500) + 2500
		  }
		}).show();
	});    
});
$(window).resize(function () {
    $('.zone-container').animate({left: '-'+ $('.zone-container').css('width') }, 0, 'easeInOutQuad');
});