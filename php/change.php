<?php
/**
 * Created by PhpStorm.
 * User: Subhashis
 * Date: 07-02-2017
 * Time: 01:17
 */
require_once 'functions.php';
checkConvoAuth('../');
$email='';
if(isset($_COOKIE['convo_mail']))$email = $_COOKIE['convo_mail'];
$contact = "";
$oldPass="";
$pass = "";
$inst = "";
$dept = "";
$class = "";
$updated=0;
//print_r($_POST);
//var_dump($_POST);
if (isset($_REQUEST['signup_contact'])) $contact = sanitizeString($_REQUEST['signup_contact']);
if (isset($_REQUEST['signup_password'])) $pass = sanitizeString($_REQUEST['signup_password']);
if (isset($_REQUEST['class'])) $class = sanitizeString($_REQUEST['class']);
if (isset($_REQUEST['signup_dept'])) $dept = sanitizeString($_REQUEST['signup_dept']);
if (isset($_REQUEST['signup_institute'])) $inst = sanitizeString($_REQUEST['signup_institute']);
if($oldPass!=''&&$pass!=''&&sql("SELECT * FROM `users` WHERE `email`='$email' AND `pass`='$oldPass'")->num_rows>0){
    sql("UPDATE `users` SET `pass`='$pass' WHERE `email`='$email' AND `pass`='$oldPass'");
    $updated=1;
}
if($inst!=''){
    sql("UPDATE `users` SET `inst`='$inst' WHERE `email`=$email");
    $updated=1;
}

if($dept!=''){
    sql("UPDATE `users` SET `dept`='$dept' WHERE `email`=$email");
    $updated=1;
}

if($class!=''){
    sql("UPDATE `users` SET `class`='$class' WHERE `email`=$email");
    $updated=1;
}
$loc="../";
if($updated==1)$loc.='?m=ud#0';
header("Location: ".$loc);