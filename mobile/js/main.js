/**
 * Created by Subhashis on 19-11-2016.
 */
if (screen.width >= 700) {
    document.location = "../";
}
function filterUpdate(v) {
    // var thres3=700;
    // var maxBlur = 25, maxSaturation = 350,minBlur=5;
    // var blur = (thres3 - v)*maxBlur / thres3;
    // blur = blur > maxBlur ? maxBlur : blur;
    // blur = blur < minBlur ? minBlur : blur;
    // var saturation = 100 + (v / thres3) * (maxSaturation - 100);
    // saturation = saturation > maxSaturation ? maxSaturation : saturation;
    // saturation = saturation < 100 ? 100 : saturation;
    // $('.bg').each(function () {
    //     console.log( 'saturate(' + saturation + '%) blur(' + blur + 'px) sepia(113%) brightness(130%)');
    //     //$(this).css('filter', 'saturate(' + saturation + '%) blur(' + blur + 'px) sepia(113%) brightness(130%)').css('filter', 'saturate(' + saturation + '%) blur(' + blur + 'px) sepia(113%) brightness(130%)');
    // });
}
var moving = false;
(function ($) {
    $(window).on("load", function () {
        var wh = $('body').height();
        // console.log(wh);
        $.mCustomScrollbar.defaults.scrollButtons.enable = true;
        $("#wrapper").mCustomScrollbar({
            theme: 'minimal-dark',
            scrollInertia: 100,
            // snapAmount: wh/20,
            // snapOffset:50,
            mouseWheel: {
                deltaFactor: 100,
                scrollAmount: 30
            },
            scrollButtons: {
                tabindex: 10
            },
            advanced: {
                autoUpdateTimeout: 200
            },
            callbacks: {
                whileScrolling: function () {
                    var v = -$('#mCSB_2_container').offset().top;
                    var wh = $('body').height();
                    var marks = [0, 0, 0, 0, 0];
                    var thres = 645;
                    var thres2 = 600;
                    var thres3 = 650;
                    var thres4 = 700;
                    marks[0] = v / 15 - 80;
                    // marks[1]=-v/5+125.4;
                    marks[2] = -v / 5 + 125.4;
                    marks[3] = -v / 3 + 209.3;
                    marks[4] = -(v * 11 / 20) + 325;
                    // var scale = (thres - v) * 0.6 / thres + 0.6;
                    // scale = scale > 1 ? 1 : (scale < 0.6 ? 0.6 : scale);
                    var scale=1;
                    var markMain = v * 17 / 20;
                    markMain = markMain > thres2 ? [(thres2) + (((markMain - thres2) * 12) / 20)] : markMain;
                    markMain = markMain > thres3 ? [(thres3) + (((markMain - thres3) * 9) / 20)] : markMain;
                    markMain = markMain > thres4 ? [(thres4) + (((markMain - thres4) * 5) / 20)] : markMain;
                    markMain = markMain < 0 ? 0 : markMain;
                    // var $parent=$('#about');
                    var $parallax = $('.parallax');

                    //Blocking
                    marks[3] = marks[3] > -$parallax.height() * 0.0013462 ? -$parallax.height() * 0.0013462 : marks[3];
                    marks[2] = marks[2] > -$parallax.height() * 0.0013462 ? -$parallax.height() * 0.0013462 : marks[2];
                    marks[2] = marks[2] > $parallax.height() * 0.01846154 ? $parallax.height() * 0.01846154 : marks[2];

                    // console.log(wh);
                    $('#about').find('.inner').each(function (i) {
                        $(this).css('transform', 'translate(0px,' + (-marks[4 - i]) + 'px)');
                        // console.log($(this));
                    });
                    // filterUpdate(v);
                    // console.log('translate(0px,' + (markMain) + ') scale(' + scale + ',' + scale + ')');

                    $('#home').find('.inner').css('transform', 'translate(0px,' + (markMain) + 'px) scale(' + scale + ',' + scale + ')');
                    var item = null;
                    $('.item').each(function () {
                        if (v + $(window).height() / 3 >= $(this).position().top || (item == null)/* || (v-item.offset().top)>(v-$(this).offset().top))*/) item = $(this);
                    });
                    // console.log(item);
                    if (!item.hasClass('active') && !moving) {
                        $('li.active').removeClass('active');
                        var $target = $('#tab-' + item.attr('id'));
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
    var wh = $('body').height();
    console.log('change');
    $element.css('padding-top', wh / 2 + 25 - $element.height() / 2);

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

$(window).on('load',function () {
    // console.log('ok');
    var $loader=$('#loader');
    $loader.css('opacity','0');
    setTimeout(function(){
        $loader.remove();
    },300);
    setTimeout(function () {
        $('.hidden').removeClass('hidden');
    }, 100);
});
$(document).ready(function () {
    // setTimeout(homeUpdate, 0);
    $(document).keydown(function (event) {
        // var e = $.Event("keydown", { keyCode: 40});
        if (event.keyCode > 36 && event.keyCode < 41)
            $('#main').trigger(event);
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
    // alert();
    // console.log($('.foreground.hidden'));
    
    var time = 500;
    $('#nav').find('li').click(function () {
        // alert('#'+$(this).find('span').html().toLowerCase());
        // alert();
        moving = true;
        // $('#wrapper').animate({
        //     scrollTop: ($('#'+$(this).find('span').html().toLowerCase()).offset().top)
        // }, 2000);
        var isAbout = $('#tab-about').hasClass('active');
        $('li.active').removeClass('active');
        $(this).addClass('active');

        if ($(this).find('span').html().toLowerCase() == "home") time = 1000;
        if ($(this).find('span').html().toLowerCase() == "about") {
            console.log(-$('body').height() + $('#events').offset().top);
            // if (!isAbout)
            $('#wrapper').mCustomScrollbar("scrollTo", -$('body').height() + $('#events').offset().top - $('#mCSB_2_container').offset().top + 60, {
                scrollInertia: 1000
            });
            time = 1000;
        } else
            $('#wrapper').mCustomScrollbar("scrollTo", '#' + $(this).find('span').html().toLowerCase(), {
                scrollInertia: time
            });
        setTimeout(function () {
            moving = false;
        }, time);
    });
});
$(window).scroll(function () {
    var v = $(document).scrollTop();
    item = null;
    // console.log(v);
    var wh = $(window).height();
    var marks = [0, 0, 0, 0, 0];
    marks[1] = v / 2;
    var $parent = $('#about');
    // console.log(wh - $parent.find('.inner'));
    $parent.find('.inner').css('padding-top', wh - $parent.find('.inner'));
    for (var i = 0; i < 5; i++) {
        var $element = $parent.find('.inner');
        $element.css('margin-top', marks[4 - i]);
        $parent = $element;

    }

    $('#nav').find('ul li').each(function () {
        if (v > $(this).offset().top && (item == null || (v - item.offset().top) > (v - $(this).offset().top))) item = $(this);
    });
});