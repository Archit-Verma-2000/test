(function ($) {
    "use strict";

    $(document).ready(function () {

        //codes for wow animation
        if ($('.wow').length) {
            var wow = new WOW({
                boxClass: 'wow',
                // animated element css class (default is wow)
                animateClass: 'animated',
                // animation css class (default is animated)
                offset: 0,
                // distance to the element when triggering the animation (default is 0)
                mobile: false,
                // trigger animations on mobile devices (default is true)
                live: true // act on asynchronously loaded content (default is true)
            });
            wow.init();
        }


        
        

        //hambarger menu icon toggle
        $("#toggleIcon").click(function () {
            $(this).toggleClass("active");
        });

        
        //codes for second home nav background change on scroll
        $(window).scroll(function () {
            var scroll = $(window).scrollTop();
            if (scroll > 30) {
                if ($('body').hasClass('dark')) {
                    $(".navbar_two").css("background", "#fff");
                } else {
                    $(".navbar_two").css("background", "#25294a");
                }
                $(".navbar").css("box-shadow", "0px 2px 2px -2px #25294a");
            }
            else {
                $(".navbar_two").css("background", "transparent");
                $(".navbar").css("box-shadow", "0px 0px 0px 0px transparent");
            }
        });


        

        //home carousel codes
        $('.slider_row').owlCarousel({
            rtl: false,
            loop: true,
            margin: 10,
            nav: true,
            navText: ["<i class='flaticon-left-chevron'></i>", "<i class='flaticon-right-chevron'></i>"],
            dots: false,
            autoplay: true,
            autoplayTimeout: 4000,
            autoplayHoverPause: true,
            responsive: {
                0: {
                    items: 1
                },
                768: {
                    items: 2
                },
                992: {
                    items: 3
                }
            }
        });

        //game carousel codes
        $('.game_slider_row').owlCarousel({
            rtl: false,
            loop: true,
            margin: 10,
            nav: true,
            navText: ["<i class='flaticon-left-chevron'></i>", "<i class='flaticon-right-chevron'></i>"],
            dots: false,
            autoplay: true,
            autoplayTimeout: 3000,
            autoplayHoverPause: true,
            responsive: {
                0: {
                    items: 1
                },
                768: {
                    items: 2
                },
                992: {
                    items: 3
                }
            }
        });

      


        //password show hide on form field
        $(".toggle-password").click(function () {
            var x = document.getElementById("password-field");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        });

        //bottom to top scroll
        var ScrollTop = $(".scrollToTop");
        $(window).on('scroll', function () {
            if ($(this).scrollTop() < 500) {
                ScrollTop.removeClass("active");
            } else {
                ScrollTop.addClass("active");
            }
        });
        $('.scrollToTop').on('click', function () {
            $('html, body').animate({
                scrollTop: 0
            }, 500);
            return false;
        });

        $(".profile").click(function(){
            $(this).find(".dropdown").slideToggle();
        });

    });

})(jQuery);