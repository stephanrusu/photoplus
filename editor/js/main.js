 //first page navigation

$(document).ready(function() {

    $('.carousel').carousel();   
    $( 'a[data-toggle="tooltip"]' ).tooltip();
    $( '#deleteBtn' ).tooltip();
    $('.dropdown-toggle').dropdown();

    //$('body').scrollspy();
    //$('.openbtn').tooltip();
    
    var duration      = 500;
    var showOffset    = 400;
    var btnFixed      = '.btn-to-top-bottom';
    var btnToTopClass = '.back-to-top';

    $(window).scroll(function () {
        if ($(this).scrollTop() > showOffset) {
            $(btnFixed).fadeIn(duration);
        } else {
            $(btnFixed).fadeOut(duration);
        }
    });

    $(btnToTopClass).click(function (event) {
        event.preventDefault();
        $('html, body').animate({
            scrollTop: 0
        }, duration);
        return false;
    });     
       
    
    $('.scrollTo').on('click', function(){
        if($('.navbar-toggle').css('display') != 'none')
            $('.navbar-toggle').click();
    });


    /* ======= Scrollspy ======= */
    $('body').scrollspy({ 
        target: '.navbar-scroll', 
        offset: 400
        });
    /* ======= ScrollTo ======= */       
    $('.navbar-scroll').localScroll({
        //target:'body',
        duration: 500,
        hash: true
    }); 
});
