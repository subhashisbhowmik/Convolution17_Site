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
if (isset($_REQUEST['signup_email'])) $email = $_REQUEST['signup_email'];
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
$con=randomString(100);
$result = sql("INSERT INTO `users` 
        (`id`, `email`, `name`,`pass`,`class`,`dept`,`inst`,`confirmation`) 
VALUES (NULL,   '$email','$name','$pass','$class','$dept','$inst','$con')");
$encodedmail=base64_encode($email);
//TODO:Authenticate
$body="Click <b></b><a href='http://www.convolutionjuee.com/php/confirm/?id=$encodedmail&con=$con'>here</a></b> to confirm your email address.<br>";
//sendMail($email,"Confirmation Email",$body);
$_COOKIE['convo_mail']=$email;

//header("Location: ../");
