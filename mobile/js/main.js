/**
 * Created by Subhashis on 19-11-2016.
 */
var prev='home';
if ((!(navigator.userAgent.match(/iPhone/i)) || (navigator.userAgent.match(/iPod/i)))&&(screen.width > 700) ) {
    location.replace("../");
}
var scale = 1;
var moving = false;
(function ($) {
    $(window).on("load", function () {
        $.mCustomScrollbar.defaults.scrollButtons.enable = true;
        $("#wrapper").mCustomScrollbar({
            theme: 'minimal-dark',
            scrollInertia: 'auto',
            // snapAmount: wh/20,
            // snapOffset:50,
            mouseWheel: {
                deltaFactor: 'auto',
                scrollAmount: 250
            },
            keyboard: {
                scrollAmount: 50
            },
            scrollButtons: {
                tabindex: 10
            },

            contentTouchScroll: 1,
            advanced: {
                autoUpdateTimeout: 200
            },
            callbacks: {
                whileScrolling: function () {
                    var v = -$('#mCSB_2_container').offset().top;

                    var item = null;
                    $('.item').each(function () {
                        if (v + $(window).height() / 3 >= $(this).position().top || (item == null)/* || (v-item.offset().top)>(v-$(this).offset().top))*/) item = $(this);
                    });
                    if (!item.hasClass('active') && !moving) {
                        $('li.active').removeClass('active');
                        var $target = $('#tab-' + item.attr('id'));
                        // console.log(item.attr('id'));
                        prev=item.attr('id');
                        if (item.attr('id') != 'home')$('#right_div').removeClass('home');
                        $target.addClass('active');
                        $('#nav').mCustomScrollbar("scrollTo", $target.position().left - 50 < 0 ? 0 : $target.position().left - 30, {
                            scrollInertia: 500
                        });
                    }
                },
                onInit: function () {
                    setTimeout(function () {
                        $('#main').click();
                    }, 100);
                }
            }
        });
        $("#nav").mCustomScrollbar({
            theme: 'minimal-dark',
            autoHideScrollbar: true,
            axis: 'x',
            keyboard: {
                enable: false
            },
            callbacks: {
                onInit: function () {
                    setTimeout(function () {
                        $('.mCSB_scrollTools_horizontal').css('opacity', 0);
                    }, 200);
                }
            }
        });
        $('#settings').click(function () {
            $('#settings_div').fadeIn(500);
        });
        $('#removeAcct').click(function () {
            document.location.href = 'php/removeAcct.php';
        });
    });
})(jQuery);
function viewUpdate() {
    var h = $('#holder').height(),
        wh = $('body').height();
    // console.log('height=' + h);
    var $wrapper = $('#wrapper');
    $('#bg').css('height', h + 'px');//.css('background', 'url("img/Cover.png")');
    $wrapper.css('background-position', 'center ' + h + 'px');
    $wrapper.height(wh - h);
    //console.log($(window).height()-h);
    // alert('update');
    $('.bg').each(function () {
        $(this).height($(this).parent().height());
    });
    // $('#algo').css("height", $("#consoleImg").height() + "px");
    homeUpdate();
}

function homeUpdate() {
    var $element = $('#home').find('.inner');
//     var wh= $('body').height();
//     var $item=$('#first.foreground');
//     $item.css('padding-top',wh/2+25-$item.height()-$item.parent().height()*0.03+'px');
//     // filterUpdate(50);
//     console.log(wh/2+25-$item.height()-$item.parent().height()*0.03+'px');
//     console.log($item.css('padding-bottom').replace("px", ""));
//     setTimeout(homeUpdate,100);
    var $body = $('body');
    var wh = $body.height();
    // var ww = $body.width();
    // console.log($element.height() / scale);
    $element.css('padding-top', 5 * wh / 16 /*+ 25 - $element.height() / scale / 2*/);
    // setTimeout(homeUpdate, 100);
}

$(window).resize(function () {
    viewUpdate();
    viewUpdate();
    // console.log($(window).width());
});
var max = 1;
var min = 1;
var holder;

$(window).on('load', function () {
    // console.log('ok');
    $('#bg').show();
    var $loader = $('#loader');
    $loader.css('opacity', '0');
    setTimeout(function () {
        $loader.remove();
    }, 300);
    setTimeout(function () {
        $('.hidden').removeClass('hidden');
    }, 100);
    setTimeout(function () {
        var $scrollDragContainer=$('.mCSB_draggerContainer');
        $scrollDragContainer.eq(0).css('z-index','-100');
        $scrollDragContainer.eq(2).css('z-index','10000');
        // $('#mCSB_3_scrollbar_horizontal').hide();
        var $scrollContainer=$('.mCSB_draggerContainer');
        $scrollContainer.eq(0).css('z-index','-100');
        $scrollContainer.eq(2).css('z-index','10000');
    },500);
});
$(document).ready(function () {
    // setTimeout(homeUpdate, 0);
    $('#sign_up_open').click(function () {
        $('.log').fadeOut(500);
        $('.sin').fadeIn(500);
    });
    $('#login_open').click(function () {
        $('.log').fadeIn(500);
        $('.sin').fadeOut(500);
    });

    if(window.location.hash) {
        var hash = window.location.hash.substring(1); //Puts hash in variable, and removes the # character
        if(hash=='0' && $('#message_div').text()!=''){
            // $('#message_div').show();
            if($('#message_div').text().toString().includes("Wrong Username or Password")){

                setTimeout(function () {
                    $("#login_signup_div").fadeIn(200);
                    // $('#message_div').css('z-index',1000);
                    setTimeout(function () {
                        $('#wup').show('fast');
                    },100);
                },100);;
            }
        }
        window.location.hash='';
    }
    $('#message_div .message_remove').click(function () {
        $(this).parent().fadeOut('fast');
    });
    var expanded = false;
    var changing = false;
    $('#right_div').on('click', function () {
        $('#noti_num').fadeOut('fast');
        if (!changing) {
            changing = true;
            $('#right_div').addClass('expanded');
            setTimeout(function () {
                if (!expanded) {
                    $('#right_div>.content').fadeIn(200);
                }
                $("#arrow_a").addClass('arrow_rotate');
                expanded = true;

            }, 200);
            setTimeout(function () {
                changing = false;
            }, 1000);
        }
    });

    $('#close').on('click', function () {
        if (!changing) {
            changing = true;
            setTimeout(function () {
                $('#right_div>.content').fadeOut(300);
            }, 50);
            setTimeout(function () {
                $('#right_div').removeClass('expanded');
                $("#arrow_a").attr('class', '');
                expanded = false;
            }, 250);
            setTimeout(function () {
                changing = false;
            }, 1000);
        }
    });
    $('#arrow').on('click', function () {
        $('#noti_num').fadeOut('fast');

        if (!changing) {
            if (expanded) {
                setTimeout(function () {
                    $('#right_div>.content').fadeOut(300);
                }, 50);
                setTimeout(function () {
                    $('#right_div').removeClass('expanded');
                    $("#arrow_a").attr('class', '');
                    expanded = false;
                }, 250);
            }
            setTimeout(function () {
                changing = false;
            }, 1000);
        }
    });

    $("#login_signup_btn").on('click', function () {
        $("#login_signup_div").fadeIn(200);
    });
    $("#login_signup_div_close").click(function () {

        $("#login_signup_div").fadeOut(100);
    });


    $("#know_the_team_btn").on('click', function () {
        $("#teamWrapper").fadeIn(200);
    });
    $("#teamClose").click(function () {
        $("#teamWrapper").fadeOut(100);
    });

    $("#settings_close").click(function () {
        $("#settings_div").fadeOut(100);
    })



    var buttonswitch = false;
    $(document).keydown(function (event) {
        // var e = $.Event("keydown", { keyCode: 40});
        if (event.keyCode > 36 && event.keyCode < 41) {
            if (event.keyCode == 37) {
                //Left
                if (!buttonswitch) {
                    buttonswitch = true;
                    $('#nav').find('.active').prev().click();
                    setTimeout(function () {
                        buttonswitch=false;
                    },1200);
                }
            } else if (event.keyCode == 39) {
                //Right
                if (!buttonswitch) {
                    buttonswitch = true;
                    $('#nav').find('.active').next().click();
                    setTimeout(function () {
                        buttonswitch=false;
                    },1200);
                }
            } else
                $('#main').trigger(event);

        }
    });

    $('#button_login').on('click', function () {
        // console.log(1);
        $("#right_div").attr('class', 'right_div_expanded');
    });
    
    $(document).keyup(function (event) {
        // var e = $.Event("keydown", { keyCode: 40});
        if (event.keyCode > 36 && event.keyCode < 41)
            $('#main').trigger(event);
    });
    holder = $('#holder');
    holder.css('background-color', 'rgba(0,0,0,' + min + ')');
    // holder.css('background-color', 'rgba(27,27,27,' + min + ')');
    viewUpdate();
    viewUpdate();
    // $('#wrapper').focus();
    // setTimeout(function () {
    //     $('.hidden').removeClass('hidden');
    // }, 100);
    // alert();
    // console.log($('.foreground.hidden'));

    var time = 500;
    $('#nav').find('li').click(function () {
        // alert('#'+$(this).find('span').html().toLowerCase());
        // alert();
        moving = true;
        // $('#wrapper').animate({
        //     scrollTop: ($('#'+$(this).find('span').html().toLowerCase()).offset().top)
        // }, 2000)
        var isAbout = $('#tab-about').hasClass('active');
        $('li.active').removeClass('active');
        $(this).addClass('active');

        if ($(this).attr('id').replace("tab-", "") == "home") time = 1000;
        if ($(this).attr('id').replace("tab-", "") == "about") {
            // console.log(-$('body').height() + $('#events').offset().top);
            // if (!isAbout)
            $('#wrapper').mCustomScrollbar("scrollTo", -$('body').height() + $('#events').offset().top - $('#mCSB_2_container').offset().top + 60, {
                scrollInertia: 1000
            });
            time = 1000;
        } else
            $('#wrapper').mCustomScrollbar("scrollTo", '#' + $(this).attr('id').replace("tab-", ""), {
                scrollInertia: time
            });
        setTimeout(function () {
            moving = false;
        }, time);
    });
});
// $(window).scroll(function () {
//     var v = $(document).scrollTop();
//     item = null;
//     // console.log(v);
//     var wh = $(window).height();
//     var marks = [0, 0, 0, 0, 0];
//     marks[1] = v / 2;
//     var $parent = $('#about');
//     // console.log(wh - $parent.find('.inner'));
//     $parent.find('.inner').css('padding-top', wh - $parent.find('.inner'));
//     for (var i = 0; i < 5; i++) {
//         var $element = $parent.find('.inner');
//         $element.css('margin-top', marks[4 - i]);
//         $parent = $element;
//
//     }
//
//     $('#nav').find('ul li').each(function () {
//         if (v > $(this).offset().top && (item == null || (v - item.offset().top) > (v - $(this).offset().top))) item = $(this);
//     });
// });

