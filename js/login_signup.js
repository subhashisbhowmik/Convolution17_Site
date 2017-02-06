/**
 * Created by Subhashis on 02-02-2017.
 */
$(window).on('load', function () {
    $('#signup_form').submit(function (e) {
        if ($('#signup_password').val() != $('#signup_password_2').val()) {
            document.getElementById("signup_password_2").setCustomValidity("Does not match with password.");
            e.preventDefault();
        } else {
            document.getElementById("signup_password_2").setCustomValidity("");
        }
    });
    $('#update_form').submit(function (e) {
        if ($('#new_password').val() != $('#new_password_2').val()) {
            document.getElementById("new_password_2").setCustomValidity("Does not match with password.");
            e.preventDefault();
        } else {
            document.getElementById("new_password_2").setCustomValidity("");
        }
    });
    $('#signup_password_2').change(function () {
        document.getElementById("signup_password_2").setCustomValidity("");
    });

    $('#new_password_2').change(function () {
        document.getElementById("new_password_2").setCustomValidity("");
    });

    $('#signup_password').change(function () {
        document.getElementById("signup_password_2").setCustomValidity("");
    });

    $('#new_password').change(function () {
        document.getElementById("new_password_2").setCustomValidity("");
    });

    $('#signup_password').focusout(function () {
        if ($(this).val().length < 8) {
            $(this).addClass('wrong');
        } else $(this).removeClass('wrong');
        if ($(this).val() != $('#signup_password_2').val() && $('#signup_password_2').val() != '')$('#signup_password_2').addClass('wrong'); else $('#signup_password_2').removeClass('wrong');
    });
    $('#signup_password_2').focusout(function () {
        if ($(this).val() != $('#signup_password').val()) {
            $(this).addClass('wrong');
        } else $(this).removeClass('wrong');
    });
    $('#new_password').focusout(function () {
        if ($(this).val() == '' && $('#new_password_2').val() == '') {
            $(this).removeClass('wrong');
            $('#new_password_2').removeClass('wrong');
        }
        if ($(this).val().length < 8) {
            $(this).addClass('wrong');
        } else $(this).removeClass('wrong');
        if ($(this).val() != $('#new_password_2').val() && $('#new_password_2').val() != '')$('#new_password_2').addClass('wrong'); else $('#new_password_2').removeClass('wrong');
    });
    $('#new_password_2').focusout(function () {
        if ($(this).val() != $('#new_password').val()) {
            $(this).addClass('wrong');
        } else $(this).removeClass('wrong');
    });
});


//TODO: Implement
function showMessage() {

}
