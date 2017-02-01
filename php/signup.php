<?php
ob_end_clean();
header("Connection: close");
ignore_user_abort(true); // just to be safe
ob_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-COMPATIBLE" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Website for Convolution 2017"/>
    <meta name="keywords"
          content="event, fest, convolution, 2017, jadavpur university, electrical engineering, 17, 2k17"/>
    <meta name="author" content="Subhashis Bhowmik"/>
    <title>Convolution 2017</title>

    <link rel="stylesheet" type="text/css" href="css/loader.css"/>
    <link rel="stylesheet" type="text/css" href="css/reset.css"/>
    <link rel="stylesheet" type="text/css" href="css/main.css"/>
    <link rel="stylesheet" type="text/css" href="css/jquery.mCustomScrollbar.css"/>
    <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css"/>
</head>
<body>
<?php
/**
 * Created by PhpStorm.
 * User: Subhashis
 * Date: 01-02-2017
 * Time: 11:49
 */
require_once 'functions.php';
$name = "";
$email = "";
$pass = "";
$inst = "";
$dept = "";
$class = "";
//print_r($_POST);
//var_dump($_POST);
if (isset($_REQUEST['signup_name'])) $name = sanitizeString($_REQUEST['signup_name']);
if ($name === "") die('1');
if (isset($_REQUEST['signup_email'])) $email = sanitizeString($_REQUEST['signup_email']);
if ($email === "") die('2');
if (isset($_REQUEST['signup_password'])) $pass = sanitizeString($_REQUEST['signup_password']);
if ($pass === "") die('3');
if (isset($_REQUEST['class'])) $class = sanitizeString($_REQUEST['class']);
if ($class === "") die('4');
if (isset($_REQUEST['signup_dept'])) $dept = sanitizeString($_REQUEST['signup_dept']);
if ($dept === "") die('5');
if (isset($_REQUEST['signup_institute'])) $inst = sanitizeString($_REQUEST['signup_institute']);
if ($inst === "") die('6');
//echo "<br>x$email";
$mailres=sql("SELECT `email` FROM `users` WHERE `email`='$email'");
if($mailres->num_rows>0)die('0');

$con=randomString(16);
$result = sql("INSERT INTO `users` 
        (`id`, `email`, `name`,`pass`,`class`,`dept`,`inst`,`confirmation`) 
VALUES (NULL,   '$email','$name','$pass','$class','$dept','$inst','$con')");
$encodedmail=urlencode($email);

//TODO:Authenticate
$body="Click <b></b><a href='www.convolutionjuee.com/php/confirm/index.php?id=$encodedmail&con=$con'>here</a></b> to confirm your email address.<br>";
$_COOKIE['convo_mail']=$email;
$_COOKIE['not_confirmed']=1;
echo "<div style='text-align: center;font-size: 2em'>Thanks for registering on Convolution 2017. Please check your mail to confirm your e-mail address. Check the Spam folder if you did'nt find a mail in the inbox, and unmark it as spam.<br><a href='www.convolutionjuee.com'>Click here to get back to the site.</a></div>";
//header("Location: ../");
ob_end_flush();
flush();
sendMail($email,"Confirmation Email",$body);
