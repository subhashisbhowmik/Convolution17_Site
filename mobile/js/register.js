/**
 * Created by Subhashis on 03-02-2017.
 */
var event = '';
$(window).on('load', function () {
    $('.register').click(function () {
        event = $(this).attr('event');
        var $spinner = $(this).find('.spinner');
        $(this).find('.spinner').show();
        //TODO: Post
        $.post('php/register.php', {event: event}, function (data) {
            if (data != '1') alert('Registration Failed');
            else if (data == '1') {
                alert('Registration for ' + event + ' succeeded!');
                $('.register').each(function () {
                    $(this).text('Registered');
                });
;            }
        }).success(function () {
            $spinner.hide();
        });
    });
});