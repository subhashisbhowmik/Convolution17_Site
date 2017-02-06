<?php
/**
 * Created by PhpStorm.
 * User: Subhashis
 * Date: 07-02-2017
 * Time: 01:10
 */
require_once 'functions.php';
checkConvoAuth('../');
$email='';
if(isset($_COOKIE['convo_mail']))$email=$_COOKIE['convo_mail'];
if($email=='')header('Location: ../');
sql("DELETE FROM `users` WHERE `email`='$email'");
//echo "DELETE FROM `users` WHERE `email`='$email'";
sql("DELETE FROM `noti` WHERE `email`='$email'");
sql("DELETE FROM `registration` WHERE `email`='$email'");
sql("DELETE FROM `cookie` WHERE `mail`='$email'");
clearAllCookies();
header('Location: ../?m=ar#0');
