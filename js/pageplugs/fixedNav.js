$(window).scroll(function() {
    if ($(document).scrollTop() > 70) {
        $('nav.pagescrollfix,nav.RWDpagescrollfix').addClass('shrink');
    } else {
        $('nav.pagescrollfix,nav.RWDpagescrollfix').removeClass('shrink');
    }
});