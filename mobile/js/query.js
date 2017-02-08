/**
 * Created by Subhashis on 07-02-2017.
 */
$('document').ready(function () {
    $('#queryForm').submit(function (e) {
        e.preventDefault();
    });
    $('#query_submit').click(function () {
        if ($('#query_input').val() == '')alert('PLease Fill up the query first!');
        else{
            var query=$('#query_input').val();
            $.post('../php/query.php',{query:query},function (data) {
                if(data=='1'){
                    alert('Query Submitted.');
                    $('#query_input').val('');
                }else{
                    alert('An error occurred! Please Try Again.');
                }
            }).error(function () {
                alert('Something went Wrong! Please Try Again.');
            });
        }
    });
});