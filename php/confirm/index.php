<?php
/**
 * Created by PhpStorm.
 * User: Subhashis
 * Date: 01-02-2017
 * Time: 21:13
 */
require_once "../functions.php";
$email = "";
$con = "";
if (isset($_REQUEST['id'])) $email = sanitizeString(sanitizeString($_REQUEST['id']));
if ($email === "") die('Invalid Request');
if (isset($_REQUEST['con'])) $con = urldecode(sanitizeString($_REQUEST['con']));
if ($con === "") die('Invalid Request');
$sql = "SELECT `id` FROM `users` WHERE `email`='$email' AND (`confirmation` = '$con' OR `confirmation` = '0')";
$result = sql($sql);
if ($result->num_rows > 0) {
    $sql = "UPDATE `users` SET `confirmation`='0' WHERE `email`='$email'";
    sql($sql);
    $token = randomString(64);
//    sql("DELETE FROM `cookie` WHERE 'email'='$email'");
    $result = sql("INSERT INTO `cookie` (`mail`,`token`) VALUES ('$email','$token')");
//    $_COOKIE['convo_mail']=$email;
//    $_COOKIE['convo_token']=$token;
    setcookie('convo_mail', $email, time() + (86400 * 30), "/");
    setcookie('convo_token', $token, time() + (86400 * 30), "/");

    $_SESSION['on'] = '1';
//    header("Location: ../../?m=li#0");
    echo "

<!DOCTYPE html>
<html lang=\"en\">
<head>
    <meta charset=\"UTF-8\">
    <meta http-equiv=\"X-UA-COMPATIBLE\" content=\"IE=edge\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
    <meta name=\"description\" content=\"Website for Convolution 2017\"/>
    <meta name=\"keywords\"
          content=\"event, fest, convolution, 2017, jadavpur university, electrical engineering, 17, 2k17\"/>
    <meta name=\"author\" content=\"Subhashis Bhowmik\"/>
    <title>Convolution 2017</title>

    <link rel=\"stylesheet\" type=\"text/css\" href=\"../../css/reset.css\"/>
    <link rel=\"stylesheet\" type=\"text/css\" href=\"../../css/mailsent.css\"/>

</head>
<body>
<div id='sentContainer'>Your E-Mail ID has been Confirmed. Now you can get back to <a href='http://www.convolutionjuee.com'>www.convolutionjuee.com</a> and Log in with your E-mail ID and Password.<br>You and all of your team members (if applicable) have to register on the events you are willing to participate.</div>
</body>
</html>";
} else {
    die('Invalid confirmation link');
}
//header('Location: ../../');

