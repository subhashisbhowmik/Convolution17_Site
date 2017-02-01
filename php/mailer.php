<?php
/**
 * Created by PhpStorm.
 * User: Subhashis
 * Date: 01-02-2017
 * Time: 01:57
 */

function sendMail($to,$sub,$msg){
    $msg = wordwrap($msg,70);
    $headers =  'MIME-Version: 1.0' . "\r\n";
    $headers .= 'From: Convolution 2017<noreply@convolutionjuee.com>' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    mail($to,$sub,$msg,$headers);
}