/**
 * Created by Subhashis on 05-02-2017.
 */
$('document').ready(function () {

    $(".pdf").click(function (e) {
        e.preventDefault();
        var event=$(this).attr('event');
        // console.log($(this).find('#detailsDivFrame'));
        $('#detailsDivFrame').attr('src','php/pdf.php?pdf='+event);
        $("#detailsDivWrapper").fadeIn(100);
    });
    $("#detailsDivClose").click(function () {
        $("#detailsDivWrapper").fadeOut(50);
    });

});