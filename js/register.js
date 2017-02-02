/**
 * Created by Subhashis on 03-02-2017.
 */
$(window).on('load',function () {
    $('.register').click(function () {
        var event=$(this).attr('event_name');
        $(this).find('.spinner').show();
        //TODO: Post
    });
});