function displaylogo() {

    if ($(window).width() < 993) {
        $('.footer_logo').detach();

    }
    if ($(window).width() <= 544) {
        $('#law').detach();
        $('#services').detach();
        $('#contacts').addClass('text-center')
    }


    if ($(window).width() >= 993) {
        if ($('.footer_logo').length === 0) {
            $('#footer_block').prepend(' <div class="footer_logo col-xl-3 col-lg-2 col-md-4 col-sm-3 col-xs-1" id="gooter"><img src="" id="footer_logo" alt=""></div>');
        }
        if ($('#law').length === 0) {
            $('#gooter').after(' <div class="footer_block col-xl-3  col-md-3 col-sm-2 col-xs-2" id="law">\n' +
                '                    <div class="footer_block_title font-weight-bold">\n' +
                '                        <span>Правовая часть</span>\n' +
                '                    </div>\n' +
                '                </div>');
        }
        if ($('#services').length === 0) {
            $('#law').after('  <div class="footer_block col-xl-3  col-md-3 col-sm-2 col-xs-2" id="services">\n' +
                '                    <div class="footer_block_title  font-weight-bold">\n' +
                '                        <span>Правовая часть</span>\n' +
                '                    </div>\n' +
                '                </div>');
        }
        if ($(window).width() < 1200) {
            $("#footer_logo").attr("src", "/img/footer_logo_sm.svg"); // small logo
        } else {
            $("#footer_logo").attr("src", "/img/footer__logo.svg"); //big logo
        }
    }
}




$(window).resize(function () {

    displaylogo();
});
$(document).ready(function () {

    displaylogo();
});