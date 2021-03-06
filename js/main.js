function displaylogo() {
//<544 xs || >=544 sM|| >=768 md || >=992 lg|| >=1200 xl

    if ($(window).width() < 1200) {
        $("#footer_logo").attr("src", "/img/footer_logo_sm.svg"); // small logo
        $("#header_logo").attr("src", "/img/header_sm.svg"); // small logo
    } else {
        $("#header_logo").attr("src", "/img/header__logo.svg"); // big logo
        $("#footer_logo").attr("src", "/img/footer__logo.svg"); //big logo
    }


    if ($(window).width() < 992) {
        $("#header_logo").attr("src", "/img/header__logo.svg"); // big logo
        $("#footer_logo").addClass('d-none');
        $("#logohref").addClass('text-center');
    } else {
        $("#footer_logo").removeClass('d-none');
        $("#logohref").removeClass('text-center');
    }

    if ($(window).width() < 768) {
        $("#law").addClass('d-none');
    } else $("#law").removeClass('d-none ');

    if ($(window).width() < 576) {
        $("#services").addClass('d-none');
        if ($("#li_logo").length === 0) {
            $("#contacts").addClass('text-center').append('<img id="li_logo" src="/img/footer_logo_sm.svg" alt="">');
        } // small logo
    } else {
        $("#services").removeClass('d-none');
        $("#li_logo").detach();
    }

}


$(window).resize(function () {
    displaylogo();
});
$(document).ready(function () {
    displaylogo();
});

/*=====================================================*/
/*=============CARUSEL=================================*/
/*=====================================================*/


