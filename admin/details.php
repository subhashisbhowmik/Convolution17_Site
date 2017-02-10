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
//print_r($_SESSION);
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


//if($user==""||$pass=="") header("Location: ./");
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
<body style="height:100vh">
<div id="content">This page is under construction!!</div>
<a href="./" id="back"><img src="img/back.png"/></a>
</body>
</html>
