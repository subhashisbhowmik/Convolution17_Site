<?php
/**
 * Created by PhpStorm.
 * User: Subhashis
 * Date: 05-02-2017
 * Time: 17:25
 */
require_once "functions.php";
$event = '';
if (isset($_REQUEST['event'])) $event = $_REQUEST['event'];
if ($event == '') die('0');
$x = checkConvoAuth('');
if ($x == 1) {
    $email = $_COOKIE['convo_mail'];
    if (sql("SELECT * FROM `registration` WHERE `email`='$email' AND `event`='$event'")->num_rows == 0) {
        sql("INSERT INTO `registration` (`id`,`email`,`event`) VALUES (NULL,'$email','$event')");
//    echo "INSERT INTO `registration` (`id`,`email`,`event`) VALUES (NULL,'$email','$event')";
        echo '1';
    }else echo '2';
    
} else echo -1;