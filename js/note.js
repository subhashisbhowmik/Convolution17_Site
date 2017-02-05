/**
 * Created by Subhashis on 04-02-2017.
 */
var tv;
$(document).ready(function () {
    $('.note').click(function (e) {
        $(this).addClass("expandedNote");



        /*
        var x = $(this);
        e.stopPropagation();
        setTimeout(function () {
            // tv = $(this).parent().removeClass('expandedNote');
            $('.expandedNote').removeClass('expandedNote');
        }, 0);
        if (!$(this).hasClass('nr')) {
            setTimeout(function () {
                x.addClass('expandedNote');
                // $('.nr').removeClass('expandedNote');
            }, 8);
        }*/
    });

    $('.note_remove').click(function (e) {
        // alert();
        // console.log($(this).parent());
        $(this).parent().removeClass('expandedNote');

        e.stopPropagation();
    });
   /* $(document).click(function () {
        setTimeout(function () {
            // tv = $(this).parent().removeClass('expandedNote');
            $('.expandedNote').removeClass('expandedNote');
        }, 0);
    });*/
});