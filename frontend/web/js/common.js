//"use strict";

// ! function() {
//     String.prototype.toSVG = function(t) {
//         var e = function(t, e) {
//                 if ("object" != typeof e) return !1;
//                 for (var r in t) {
//                     if (e.hasOwnProperty(r)) break;
//                     e[r] = t[r]
//                 }
//                 return e
//             }({ svgClass: "replaced-svg", onComplete: function() {} }, t),
//             r = function(t, e) {
//                 var r = new XMLHttpRequest;
//                 r.open("GET", t, !0), r.send(), r.onreadystatechange = function() { 4 == r.readyState && (200 != r.status ? console.log(r.status + ": " + r.statusText) : e.call(this, r.responseText)) }
//             };
//         Array.prototype.forEach.call(document.querySelectorAll(this), function(t) {
//             var i = t,
//                 n = i.getAttribute("id"),
//                 o = i.getAttribute("class"),
//                 s = i.getAttribute("src");
//             /\.(svg)$/i.test(s) ? r(s, function(t) {
//                 var r = document.createElement("html");
//                 r.innerHTML = "<body>" + t + "</body>";
//                 var s = r.getElementsByTagName("svg")[0];
//                 void 0 != n && null != n && s.setAttribute("id", n), void 0 !== o && s.setAttribute("class", o + " " + e.svgClass), s.removeAttribute("xmlns:a"), !s.getAttribute("viewBox") && s.getAttribute("height") && s.getAttribute("width") && s.getAttribute("viewBox", "0 0 " + s.getAttribute("height") + " " + s.getAttribute("width")), i.parentNode.replaceChild(s, i), "function" == typeof e.onComplete && e.onComplete.call(this, s)
//             }) : console.warn("image src='" + s + "' is not a SVG, item remained tag <img/> ")
//         })
//     }
// }();
// ".svg".toSVG({
//     svgClass: "replaced",
//     onComplete: function() {}
// });

$(document).ready(function() {
    var w = screen.width;
    var h = screen.height;
    var bw = window.innerWidth;
    var bh = window.innerHeight;

    //E-mail Ajax Send
    $("form").each(function() {
        var it = $(this);
        it.validate({
            rules: {
                phone: {
                    required: true
                }
            },
            messages: {},
            errorPlacement: function(error, element) {},
            submitHandler: function(form) {
                var thisForm = $(form);
                $.ajax({
                    type: "POST",
                    url: thisForm.attr("action"),
                    data: thisForm.serialize()
                }).done(function() {
                    $.fancybox.close();
                    $.fancybox({
                        href: '#myThanks',
                        wrapCSS: 'owrap',
                        openEffect: "elastic",
                        openMethod: "zoomIn",
                        closeEffect: "elastic",
                        closeMethod: "zoomOut",
                    });
                    setTimeout(function() {
                        $.fancybox.close();
                    }, 3000);
                    it.trigger("reset");
                });
                return false;
            },
            success: function() {},
            highlight: function(element, errorClass) {
                $(element).addClass('error');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('error');
            }
        })
    });

    //  scroll with offset


    // if (w < 768) {
    //     $(".nav_list li a").click(function() {
    //         $(".hidden_trigger").removeClass('open_menu');
    //         $(".nav_list").slideUp();
    //     });
    // }

    $(".scroll_btn").click(function() {
        event.preventDefault();
        var id = $(this).attr('href');
        // screen width
        // if (w < 768) {
        //     $(id).attr('data-top', 90);
        // }
        var topOffset = $(id).attr("data-top");
        var top = $(id).offset().top,
            finalTop = top - topOffset;
        $('body,html').animate({ scrollTop: finalTop }, 700);
    });

    // top menu
    var $header = $(".header");
    var tempScrollTop = 0;
    if (w > 768) {
        $(window).scroll(function() {
            var currentScrollTop = $(document).scrollTop();
            if (currentScrollTop < 1) {
                $header.removeClass("more");
            } else {
                $header.addClass("more");
            }
            //up and down
            // if (tempScrollTop > currentScrollTop) {
            //     $header.removeClass("going_down");
            // } else if (tempScrollTop < currentScrollTop) {
            //     $header.addClass("going_down");
            // }
            // tempScrollTop = currentScrollTop;
        });
    }

    // menu-btn 
    $(".hidden_trigger").click(function() {
        $(".nav_list").slideToggle();
        $(this).toggleClass('open_menu');
    });

    //masked
    // $('input[type=tel]').mask("+99(999) 999-99-99");

    $(".fancybox").fancybox({
        // margin: 0
        // scrolling: 'yes',
        // fixed: false,
        // autoCenter: true,
        // centerOnScroll: true,
        // helpers: {
        //     overlay: {
        //         showEarly: false
        //     }
        // }
        // helpers: {
        //     overlay: {
        //         locked: false
        //     }
        // }
    });


    $(".video_btn").fancybox({
        wrapCSS: "wrap_video",
        autoSize: false,
        helpers: {
            media: true,
            title: {
                type: 'inside'
            }
        },
        fitToView: false,
        aspectRatio: true,
        maxWidth: "100%",
        maxHeight: "100%"
    });
});


// $(window).on('load resize', function() {
//     var w = screen.width;
// var h = screen.height;
// var bw = window.innerWidth;
// var bh = window.innerHeight;
//     var btnLen = $(".search_checkboxes").find('.red_btn').length;
//     if ($(".search_form_selects").length > 0) {
//         if (w < 601) {
//             if (btnLen < 1) {
//                 $(".search_form_selects").find('.red_btn').detach().appendTo(".search_checkboxes");
//             }
//         } else if (w > 600) {
//             $(".search_checkboxes").find('.red_btn').detach().appendTo(".search_form_selects .heat__item:last-child");
//         }
//     }
// });


$(document).on('click', '.soc_lnk', function(e) {
    var div = $(this).closest('.test_slide');
    if(!$('#register_checkbox').is(':checked')) {
        return  false;
    }
});

$(document).on('change', '#register_checkbox', function(e) {
    if(!$(this).is(':checked')) {
        $(this).closest('.reg_screen_block').find('.soc_lnk').addClass('inactive');
    } else {
        $(this).closest('.reg_screen_block').find('.soc_lnk').removeClass('inactive');
    }
});

$(document).on('click', 'a', function(e) {
    if(typeof $(this).data('event') !== 'undefined') {
        ga('send', 'event', $(this).data('event'), $(this).data('param'));
    }
});

$('a.share').click(function(e) {
    url = getShareUrl($(this));

    window.open(url,'','toolbar=0,status=0,width=626,height=436');

    return false;
});

function getShareUrl(obj) {
    if(obj.data('type') == 'vk') {
        url  = 'http://vkontakte.ru/share.php?';
        url += 'url='          + encodeURIComponent(obj.data('url'));
        url += '&title='       + encodeURIComponent(obj.data('title'));
        url += '&text='        + encodeURIComponent(obj.data('desc'));
        url += '&image='       + encodeURIComponent(obj.data('image'));
        url += '&noparse=true';
    } else if(obj.data('type') == 'fb') {
        url  = 'http://www.facebook.com/sharer.php?s=100';
        url += '&p[title]='     + encodeURIComponent(obj.data('title'));
        url += '&p[url]='       + encodeURIComponent(obj.data('url'));
        url += '&p[images][0]=' + encodeURIComponent(obj.data('image'));
        url += '&p[summary]='   + encodeURIComponent(obj.data('desc'));
    }

    return url;
}