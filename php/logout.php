<?php
/**
 * Created by PhpStorm.
 * User: Subhashis
 * Date: 02-02-2017
 * Time: 19:47
 */
require_once "functions.php";
checkConvoAuth('Location ../');
$mail=$_COOKIE['convo_mail'];
sql("DELETE FROM `cookie` WHERE `mail`=$mail");
clearAllCookies();
header('Location: ../?m=lo#0');