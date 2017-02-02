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
        sql("DELETE FROM `cookie` WHERE `mail`='$email'");
//        echo "DELETE FROM `cookie` WHERE `mail`='$email'";
        $result = sql("INSERT INTO `cookie` (`mail`,`token`) VALUES ('$email','$token')");
//        $_COOKIE['convo_mail'] = $email;
//        $_COOKIE['convo_token'] = $token;
        setcookie('convo_mail',$email,time() + (86400 * 30), "/");
        setcookie('convo_token',$token,time() + (86400 * 30), "/");
        $_SESSION['on'] = '1';
//        echo $_COOKIE['convo_mail'];
//        echo $email.'!'.$token;
        header("Location: ../?m=li#0");
    }else header("Location: ../?m=nc#0");
}else header("Location: ../?m=wp#0");
//nc=>Not Confirmed;wp=>Wrong Password;li=>Logged in