/**
 * Created by Subhashis on 02-02-2017.
 */
$(window).on('load',function () {
    
    $('#signup_password').focusout(function () {
        if($(this).val().length<8){
            $(this).addClass('wrong');
        }else $(this).removeClass('wrong');
        if($(this).val()!=$('#signup_password_2').val()&&$('#signup_password_2').val()!='')$('#signup_password_2').addClass('wrong'); else $('#signup_password_2').removeClass('wrong');
    });
    $('#signup_password_2').focusout(function () {
        if($(this).val()!=$('#signup_password').val()){
            $(this).addClass('wrong');
        }else $(this).removeClass('wrong');
    });
});

//TODO: Implement
function showMessage(){

}
