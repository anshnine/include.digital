$(document).ready(function () {
    const slider = $("#slider").owlCarousel({
        dots:false,
        loop: true,
        margin: 10,
        autoplay: false,
        autoplayTimeout: 500,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 2
            },
            1000: {
                items: 2
            }
        }
    });
});
