$(document).ready(function() {
    var w = screen.width;
    var h = screen.height;
    var bw = window.innerWidth;
    var bh = window.innerHeight;

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
        });
    }

    // menu-btn 
    $(".hidden_trigger").click(function() {
        $(".nav_list").slideToggle();
        $(this).toggleClass('open_menu');
    });

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

$(document).on('click', '.soc_lnk', function(e) {
    if($(this).hasClass('inactive')) {
        e.preventDefault();
        return false;
    }
    // var div = $(this).closest('.test_slide');
    // if(div.length > 0 && !$('#register_checkbox').is(':checked')) {
    //     return  false;
    // }
});

$(document).on('change', '#register_checkbox', function(e) {
    if(!$(this).is(':checked')) {
        $(this).closest('.reg_screen_block').find('.soc_lnk').addClass('inactive');
    } else {
        $(this).closest('.reg_screen_block').find('.soc_lnk').removeClass('inactive');
    }
});

$(document).on('change', '#rules-check', function(e) {
    if(!$(this).is(':checked')) {
        $(this).closest('.reg_screen_block').find('.scr2_text_btn').addClass('inactive');
    } else {
        $(this).closest('.reg_screen_block').find('.scr2_text_btn').removeClass('inactive');
    }
});

$(document).on('click', 'a', function(e) {
    if(typeof $(this).data('event') !== 'undefined') {
        ga('send', 'event', $(this).data('event'), $(this).data('param'));
    }
});

$(document).on('click', 'a.inactive, button.inactive', function(e) {
    e.preventDefault();
    return false;
});

$('a.share').click(function(e) {
    url = getShareUrl($(this));

    window.open(url,'','toolbar=0,status=0,width=626,height=436');
    
    return false;
});

$(document).on('click', '.reg_screen_input_div .remove', function(e) {
    if($(this).closest('.form-group').data('number') != 0) {
        $(this).closest('.reg_screen_input_div').remove();
    }
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
        url = 'https://www.facebook.com/sharer/sharer.php?';
        url += 'u=' + encodeURIComponent(obj.data('url'));
    }

    return url;
}