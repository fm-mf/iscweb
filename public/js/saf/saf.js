$(document).ready(function() {
    $landingPage = $('#landing-page');
    $landingPage.children(".more").click(
        function(event) {
            event.preventDefault();
            $('html, body').stop().animate({ scrollTop: $landingPage.offset().top + $landingPage.outerHeight() });
        }
    );

    $('#student-presentations-carousel').slick({
        autoplay: true,
        aputoplaySpeed: 2000,
        fade: true,
        arrows: false,
        pauseOnHover: false,
    });
});