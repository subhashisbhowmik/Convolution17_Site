/**
 * Created by Subhashis on 03-02-2017.
 */
var eventName = '';
$(window).on('load', function () {
    $('.register').click(function () {
        // alert();
        if($(this).find('.tx').text().toLowerCase()=='register') {
            eventName = $(this).attr('event');
            var $spinner = $(this).find('.spinner');
            $spinner.show();
            //TODO: Post
            $.post('php/register.php', {event: eventName}, function (data) {
                if (data == '2') alert('Already Register in ' + eventName.toString()+'.');
                else if (data=='10'){
                    $('#login_signup_div').fadeIn(500);
                    $('.log').show();
                    $('#lif').show('fast');
                }
                else if (data != '1') alert('Registration Failed');
                else if (data == '1') {
                    alert('Registration for ' + eventName.toString() + ' succeeded!');
                    $('.register').each(function () {
                        if ($(this).attr('event') == eventName)
                            $(this).find('.tx').text('Registered');
                            $(this).css('cursor','default');
                    });
                }
            }).error(function () {
                alert('Something went wrong! Please Try Again.');
            }).finish(function () {
                $spinner.hide();
            });
        }
    });
});