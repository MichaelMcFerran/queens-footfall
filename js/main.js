
'use strict';

(function ($) {

    /*Preload, display loading circle*/
    $(window).on('load', function () {
        $(".loader").fadeOut();
        $("#preloader").delay(200).fadeOut("slow");


    });

    /*Navigation*/
    $(".mobile-menu").slicknav({
        prependTo: '#mobile-menu-wrap',
        allowParentLinks: true
    });

        /*Sets background of carousel depending on which is at the front*/
    $('.set-bg').each(function () {
        var bg = $(this).data('setbg');
        $(this).css('background-image', 'url(' + bg + ')');
    });

    /*Mouse hover over menu*/
    $(".header-section.header-normal .nav-menu .mainmenu ul li").on('mousehover', function() {
        $(this).addClass('active');
    });
    $(".header-section.header-normal .nav-menu .mainmenu ul li").on('mouseleave', function() {
        $('.header-section.header-normal .nav-menu .mainmenu ul li').removeClass('active');
    });

    /*Sliding Owl carousel/jumbotron*/
    var hero_s = $(".hero-items");
    hero_s.owlCarousel({
        loop: true,
        margin: 0,
        nav: true,
        items: 1,
        dots: false,
        animateOut: 'fadeOut',
        animateIn: 'fadeIn',
        navText: ['<i class="ti-angle-left"></i>', '<i class="ti-angle-right"></i>'],
        smartSpeed: 1200,
        autoHeight: false,
        autoplay: false,
        onInitialized: function () {
            var a = this.items().length;
            $("#snh-1").html("<span>1</span><span>" + a + "</span>");
        }
    });

    /*for about page preview*/
    $('[data-fancybox="preview"]').fancybox({
        thumbs : {
          autoStart : true
        }
      });

})(jQuery);