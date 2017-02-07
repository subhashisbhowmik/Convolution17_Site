<?php
/**
 * Created by PhpStorm.
 * User: Subhashis
 * Date: 07-02-2017
 * Time: 03:02
 */
require_once 'functions.php';
$email='';
$query='';
if(isset($_COOKIE['convo_mail']))$email=sanitizeString($_COOKIE['convo_mail']);
if($email!='' && checkConvoAuth('')!=1) {
    clearAllCookies();
    die(-1);
}
if($email=='') $email='ANNONYMOUS';
if(isset($_REQUEST['query']))$query=sanitizeString($_REQUEST['query']);
if($query=='')die(0);
sql("INSERT INTO `query` (`id`,`email`,`query`) VALUES (NULL,'$email','$query')");
echo '1';