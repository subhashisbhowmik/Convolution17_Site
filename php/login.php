<?php
/**
 * Created by PhpStorm.
 * User: Subhashis
 * Date: 01-02-2017
 * Time: 22:25
 */
require_once "functions.php";
$email = "";
$pass = "";
if (isset($_REQUEST['login_email'])) $email = sanitizeString($_REQUEST['login_email']);
if ($email === "") die('1');
if (isset($_REQUEST['login_pass'])) $pass = sanitizeString($_REQUEST['login_pass']);
if ($pass === "") die('2');
$sql="SELECT * FROM `users` WHERE `email`='$email' AND `pass`='$pass'";
$result=sql($sql);
if($result->num_rows>0){
    $row=$result->fetch_assoc();
    if($row['confirmation']=='0') {
        $token = randomString(64);
        sql("DELETE FROM `cookie` WHERE 'email'='$email'");
        $result = sql("INSERT INTO `cookie` (`mail`,`token`) VALUES ('$email','$token')");
        $_COOKIE['convo_mail'] = $email;
        $_COOKIE['convo_token'] = $token;
        $_SESSION['on'] = '1';
    }else die('-1');
}else die('0');