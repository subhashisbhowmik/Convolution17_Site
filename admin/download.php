<?php
/**
 * Created by PhpStorm.
 * User: Subhashis
 * Date: 10-02-2017
 * Time: 21:49
 */
require_once "../php/functions.php";
$user="";
$pass="";

if(isset($_SESSION['convo_admin_user']))$user=sanitizeString($_SESSION['convo_admin_user']);
if(isset($_SESSION['convo_admin_pass']))$pass=sanitizeString($_SESSION['convo_admin_pass']);
$result=sql("SELECT * FROM `admin` WHERE `user`='$user' AND `pass`='$pass'");

if($result->num_rows==0) {
    $user="";
    $pass="";
    $_SESSION['convo_admin_user']='';
    $_SESSION['convo_admin_pass']='';
}else{
    sql("UPDATE `admin` SET ts=CURRENT_TIMESTAMP WHERE `user`='$user' AND `pass`='$pass'");
}
$event="";
if(isset($_REQUEST['event']))$event=urldecode(sanitizeString($_REQUEST['event']));
//die( $event." ".$user. ' '.$pass);
if($event==""||$user==""||$pass=="") die( "<script>window.close()</script>");
$tag='';
$error='';
$selector="`users`.`id` AS SignupID, `registration`.`id` AS RegID, event,`users`.`email`, `name` as `Name`, contact as Phone,class AS Class, dept AS Department, inst AS Institution, confirmation";
$filename='Convo17 '.str_replace(" ","_",$event).' '.date(' g:iA d_M_Y',strtotime('+5 hour +30 minutes',strtotime(date("Y-m-d H:i:s"))));
if($event=="All Users"){
    $tag='users';
    $select = "SELECT * FROM `$tag`";
}else if($event=="All Registrations"){
    $tag='registration';
    $select = "SELECT $selector FROM `registration` JOIN `users` ON `users`.`email`=`registration`.`email`;";

}else if($event=="Convolution Team"){
    $tag='team';
    $select = "SELECT * FROM `$tag`";

}else if($event=="All Users & Registrations"){
    $select = "SELECT $selector FROM `registration` LEFT JOIN `users` ON `users`.`email`=`registration`.`email`;";
}else{
    $tag=str_replace(" ","",strtolower($event));
    $select = "SELECT $selector FROM `registration`  JOIN `users` ON `users`.`email`=`registration`.`email` WHERE `registration`.`event`='$tag'";
}
$export =sql($select);
if($conn->errno) $texts="Database Doesn't exist yet!";
else $texts="This Database is EMPTY!!";

if($export->num_rows==0) die( "

<!DOCTYPE html>
<html lang=\"en\">
<head>
    <meta charset=\"UTF-8\">
    <meta http-equiv=\"X-UA-COMPATIBLE\" content=\"IE=edge\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
    <meta name=\"description\" content=\"Admin Page for Convolution 2017\"/>
    <meta name=\"author\" content=\"Subhashis Bhowmik\"/>
    <title>Convolution Admin</title>

    <link rel=\"stylesheet\" type=\"text/css\" href=\"../css/reset.css\"/>
    <link rel=\"stylesheet\" type=\"text/css\" href=\"css/main.css\"/>

</head>
<body style=\"height:100vh\">
<div id=\"content\">$texts</div>
<a href=\"./\" id=\"back\"><img src=\"img/back.png\"/></a>
</body>
</html>");

$fields = $export->fetch_fields();
//print_r($export);
$header='';
foreach($fields as $field)
{
    $header .= $field->name . ",";
}

$data="";
foreach($export as $row)
{
    $line = '';
    foreach( $row as $value )
    {
        if ( ( !isset( $value ) ) || ( $value == "" ) )
        {
            $value = ",";
        }
        else
        {
            $value = str_replace( '"' , '""' , $value );
//            $value = str_replace( ',' , '","' , $value );
            $value = '"' . $value . '"' . ",";
            if(!strpos(",",$value))$value="=".$value;
        }
        $line .= $value;
    }
    $data .= trim( $line ) . "\r\n";
}
//$data = str_replace( "\r" , "" , $data );

if ( $data == "" )
{
    $data = "\n(0) Records Found!\n";
}

header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=$filename.csv");
header("Pragma: no-cache");
header("Expires: 0");
print "$header\r\n$data";
?>
