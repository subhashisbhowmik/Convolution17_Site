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
require_once "gmailer.php";
$event = '';
if (isset($_REQUEST['event'])) $event = sanitizeString($_REQUEST['event']);
if ($event == '') die('0');
$x = checkConvoAuth('');
if ($x == 1) {
    $email = $_COOKIE['convo_mail'];
    if (sql("SELECT * FROM `registration` WHERE `email`='$email' AND `event`='$event'")->num_rows == 0) {
        sql("INSERT INTO `registration` (`id`,`email`,`event`) VALUES (NULL,'$email','$event')");
//    echo "INSERT INTO `registration` (`id`,`email`,`event`) VALUES (NULL,'$email','$event')";
        if($event=='algomaniac') {
            $body = "Thanks for registering on Algomaniac, Convolution 2017. The online prelims of Algomaniac will be held on 28th Feb, 2017 on Hackerrank, from 8 pm to 9 pm.

The Rules and procedure for the prelims are as the following:

<b style='text-decoration: underline'>Create Your Team</b>
Since Algomaniac is a team contest, you need to register as a team. To register as a team please follow these steps : 

1. Log in to Hackerrank
2. Click on the RIGHT drop down beside your username
3. Click on SETTINGS from the drop-down
4. Your Account settings will appear on the screen. Click on TEAMS on the left side
5. Register your team with a decent team name and contest Algomaniac 4.0 Prelims I
6. Add your teammate. Maximum 2 persons allowed in a team.

<b style='text-decoration: underline'>Regulations:</b>

1. All the team members must be registered in Algomaniac on the site www.convolutionjuee.com
2. Scoring will be judged based on junior(1st and 2nd yr UG)/senior(3rd and 4th yr UG) group.
3. Selected few will directly qualify for Algomaniac final rounds. 

Prelims link: <a href='https://www.hackerrank.com/algomaniac-4-0-prelims'>https://www.hackerrank.com/algomaniac-4-0-prelims</a>";
            ob_end_flush();
            flush();
            sendGMail($email, "Algomaniac Registration", $body);
        }
        echo '1';
    }else echo '2';
    
}else if($x==0)echo "10";
else echo -1;