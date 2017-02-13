/**
 * Created by Subhashis on 03-02-2017.
 */
var eventName = '';
$(window).on('load', function () {
    $('.register').click(function () {
        if($('#nameDummy').text()==''){
            $('#login_signup_div').fadeIn(500);
            $('#lif').show('fast');
            return;
        }
        if($(this).find('.tx').text().toLowerCase()=='register' && ($(this).attr('status')==null||$(this).attr('status')=='')) {
            $(this).attr('status','doing');
            $(this).css('cursor','default');
            var $this=$(this);
            eventName = $(this).attr('event');
            var $spinner = $(this).find('.spinner');
            $spinner.show();
            var $tx=$(this).find('.tx');
            $tx.hide();
            $.post('../php/register.php', {event: eventName}, function (data) {
                if (data == '2') alert('Already Register in ' + eventName.toString()+'.');
                else if (data=='10'){
                    $('#login_signup_div').fadeIn(500);
                    $('#lif').show('fast');
                }
                else if (data != '1') alert('Registration Failed');
                else if (data == '1') {
                    alert('Registration for ' + eventName.toString() + ' succeeded!');
                    $('.register').each(function () {
                        if ($(this).attr('event') == eventName) {
                            $(this).find('.tx').text('Registered');
                            $(this).css('cursor', 'default');
                            $(this).attr('status','done');
                            $(this).find('.spinner').hide();
                            $(this).find('.tx').show();

                        }
                    });
                }
            }).fail(function () {
                alert('Something went wrong! Please Try Again.');
                $this.attr('status','');
                $this.css('cursor','pointer');
                $spinner.hide();
                $tx.show();
            }).always(function () {
                $spinner.hide();
                $tx.show();
            });
        }
    });
});