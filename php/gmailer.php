<?php
/**
 * Created by PhpStorm.
 * User: Subhashis
 * Date: 07-02-2017
 * Time: 11:45
 */
require_once "Mail.php";
require_once "functions.php";

function sendGMail($to,$sub,$msg)
{ 
    $from = 'Convolution 2017<convolution2017@gmail.com>';
//    $to = '<subhashis.b96@gmail.com>';
    $subject = $sub;
    $body = $msg;//"Hi,\n\nHow are you?";

    $headers = array(
        'From' => $from,
        'To' => $to,
        'Subject' => $subject
    );

    $smtp = Mail::factory('smtp', array(
        'host' => 'ssl://smtp.gmail.com',
        'port' => '465',
        'auth' => true,
        'username' => 'convolution2017@gmail.com',
        'password' => 'JUEECONVOlution'
    ));

    $mail = $smtp->send($to, $headers, $body);
//
//    if (PEAR::isError($mail)) {
//        echo('<p>' . $mail->getMessage() . '</p>');
//    } else {
//        echo('<p>Message successfully sent!</p>');
//    }

}

