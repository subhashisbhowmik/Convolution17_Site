/**
 * Created by Subhashis on 03-02-2017.
 */
$(window).on('load',function () {
    $('.register').click(function () {
        var event=$(this).attr('event');
        $(this).find('.spinner').show();
        //TODO: Post
        $.post('php/register.php',{event:event},function (data) {
            alert(data);
        });
    });
});