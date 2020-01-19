$(window).on('load', function() {

    const burger = new Burger();
    AOS.init();

    // SCROLL AUTOMATICALLY TO SECTION
    let device_scroll;
    if (window.matchMedia("(max-width: 768px)").matches) {
        device_scroll = 250; 
    } 
    else if (window.matchMedia("(min-width: 1024px)").matches) {
        device_scroll = 750; 
    }; 

    if ($('#scroll').length === 1) {
        $('html').animate({scrollTop: device_scroll}, 1000);
        return false;
    }

});