<?php
/**
 * Created by PhpStorm.
 * User: Subhashis
 * Date: 10-02-2017
 * Time: 20:18
 */

require_once "../php/functions.php";
$user="";
$pass="";

if(isset($_SESSION['convo_admin_user']))$user=sanitizeString($_SESSION['convo_admin_user']);
if(isset($_SESSION['convo_admin_pass']))$pass=sanitizeString($_SESSION['convo_admin_pass']);
if(isset($_REQUEST['convo_admin_user']))$user=sanitizeString($_REQUEST['convo_admin_user']);
if(isset($_REQUEST['convo_admin_pass']))$pass=sanitizeString($_REQUEST['convo_admin_pass']);
$result=sql("SELECT * FROM `admin` WHERE `user`='$user' AND `pass`='$pass'");
if($result->num_rows==0) {
    $user="";
    $pass="";
    $_SESSION['convo_admin_user']='';
    $_SESSION['convo_admin_pass']='';
}else{
    sql("UPDATE `admin` SET ts=TIMESTAMPADD(MINUTE,30,TIMESTAMPADD(HOUR,5,CURRENT_TIMESTAMP)) WHERE `user`='$user' AND `pass`='$pass'");
    $_SESSION['convo_admin_user']=$user;
    $_SESSION['convo_admin_pass']=$pass;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-COMPATIBLE" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Admin Page for Convolution 2017"/>
    <meta name="author" content="Subhashis Bhowmik"/>
    <title>Convolution Admin</title>
    <link rel="stylesheet" type="text/css" href="../css/reset.css"/>
    <link rel="stylesheet" type="text/css" href="css/main.css"/>
</head>
<body>
<a id="logout" href="logout.php">LOGOUT</a>
<?php
if($user==''||$pass==""){
    echo  "<div id='formWrapper'><form id='login_form' action='' method='post'>
        <input type='text' placeholder='Admin Username' name='convo_admin_user' id='convo_admin_user'>
        <input type='password' placeholder='Admin Password' name='convo_admin_pass' id='convo_admin_pass'>
        <button id='login'>Login</button>
    </form></div>";
}else{
    echo "<div id='links'>";
    $links=array("All Users","All Registrations","All Users and Registrations","Algomaniac","Circuistic","Sparkhack","Decisia","Inquizzitive","Seminar","Controversial","Workshop","Sponsors","Analytics","Queries","Convolution Team");
    if($user=="sb")array_push($links,"Admin");
    foreach ($links as $link) {
        echo "<span class='link'><div class='text'>$link</div><a class='download' title=\"Download .csv file.\" target='_blank' href='download.php?event=$link'><img src='img/download.png'></a><a class='details' title=\"Edit Event Details\" href='details.php?event=$link'><img src='img/details.png'></a></span>";
    }
    echo "</div>";
}
?>


</body>
</html>