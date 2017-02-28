<?php
/**
 * Created by PhpStorm.
 * User: Subhashis
 * Date: 05-02-2017
 * Time: 17:25
 */

ob_end_clean();
header("Connection: close");
ignore_user_abort(true); // just to be safe
ob_start();
require_once "functions.php";
$event = '';
if (isset($_REQUEST['event'])) $event = sanitizeString($_REQUEST['event']);
if ($event == '') die('0');
$x = checkConvoAuth('');
if ($x == 1) {
    $email = $_COOKIE['convo_mail'];
    if (sql("SELECT * FROM `registration` WHERE `email`='$email' AND `event`='$event'")->num_rows == 0) {
        sql("INSERT INTO `registration` (`id`,`email`,`event`) VALUES (NULL,'$email','$event')");
//    echo "INSERT INTO `registration` (`id`,`email`,`event`) VALUES (NULL,'$email','$event')";
        $body="";
        $sub="";
        if($event=='algomaniac') {
            $sub= "Algomaniac Registration";
            $body = "Thanks for registering on Algomaniac, Convolution 2017. The online prelims of Algomaniac is over. The second offline prelim is on 4th March, Saturday.
<br>
The Rules and procedure for the prelims are as the following:
<br>

<br>
1. All the team members must be registered in Algomaniac on the site www.convolutionjuee.com
<br>
2. Scoring will be judged based on junior(1st and 2nd yr UG)/senior(3rd and 4th yr UG) group.
<br>
3. Selected few will directly qualify for Algomaniac final rounds. 
<br>
<br>
For more info, use the details button on the <a href='http://www.convolutionjuee.com'>website, www.convolutionjuee.com .</a>
";
        }else{
            $e=ucfirst($event);
            $sub= "$e Registration";
            $body = "You have successfully registered for $e, Convolution 2017. For event schedule, use the details button on the website";
        }


        ob_end_flush();
        flush();
        sendGMail($email, $sub, $body);
        echo '1';
    }else echo '2';
    
}else if($x==0)echo "10";
else echo -1;