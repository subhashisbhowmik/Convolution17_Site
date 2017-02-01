<?php
$conn = NULL;
connect();
session_start();
function connect()
{
    $server = "localhost";
    $user = "med";
    $pass = "Local_123";
    $dbname = "convo";

    global $conn;
    $conn = new mysqli($server, $user, $pass, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
}

function sql($query = "")
{
    global $conn;
    return $conn->query($query);
}

function createTable($name, $query)
{
    sql("CREATE TABLE IF NOT EXISTS $name($query)");
}

function isMobile()
{
    $is_mobile = '0';

    if (preg_match('/(android|up.browser|up.link|mmp|symbian|smartphone|midp|wap|phone)/i', strtolower($_SERVER['HTTP_USER_AGENT']))) {
        $is_mobile = 1;
    }

    if ((strpos(strtolower($_SERVER['HTTP_ACCEPT']), 'application/vnd.wap.xhtml+xml') > 0) or ((isset($_SERVER['HTTP_X_WAP_PROFILE']) or isset($_SERVER['HTTP_PROFILE'])))) {
        $is_mobile = 1;
    }

    $mobile_ua = strtolower(substr($_SERVER['HTTP_USER_AGENT'], 0, 4));
    $mobile_agents = array('w3c ', 'acs-', 'alav', 'alca', 'amoi', 'andr', 'audi', 'avan', 'benq', 'bird', 'blac', 'blaz', 'brew', 'cell', 'cldc', 'cmd-', 'dang', 'doco', 'eric', 'hipt', 'inno', 'ipaq', 'java', 'jigs', 'kddi', 'keji', 'leno', 'lg-c', 'lg-d', 'lg-g', 'lge-', 'maui', 'maxo', 'midp', 'mits', 'mmef', 'mobi', 'mot-', 'moto', 'mwbp', 'nec-', 'newt', 'noki', 'oper', 'palm', 'pana', 'pant', 'phil', 'play', 'port', 'prox', 'qwap', 'sage', 'sams', 'sany', 'sch-', 'sec-', 'send', 'seri', 'sgh-', 'shar', 'sie-', 'siem', 'smal', 'smar', 'sony', 'sph-', 'symb', 't-mo', 'teli', 'tim-', 'tosh', 'tsm-', 'upg1', 'upsi', 'vk-v', 'voda', 'wap-', 'wapa', 'wapi', 'wapp', 'wapr', 'webc', 'winw', 'winw', 'xda', 'xda-');

    if (in_array($mobile_ua, $mobile_agents)) {
        $is_mobile = 1;
    }

    if (isset($_SERVER['ALL_HTTP'])) {
        if (strpos(strtolower($_SERVER['ALL_HTTP']), 'OperaMini') > 0) {
            $is_mobile = 1;
        }
    }

    if (strpos(strtolower($_SERVER['HTTP_USER_AGENT']), 'windows') > 0) {
        $is_mobile = 0;
    }

    return $is_mobile;
}

function sanitizeString($var)
{
    global $connection;
    $var = strip_tags($var);
    $var = htmlentities($var);
    $var = stripslashes($var);
//    return $connection->real_escape_string($var);
    return $var;
}

function checkAuth($path)
{//Path to redirect when fails to validate
    $username = "";
    $token = "";
    $key = "";

    if (isset($_COOKIE['username'])) $username = $_COOKIE['username'];
    if (isset($_COOKIE['token'])) $token = $_COOKIE['token'];
    if (isset($_COOKIE['key'])) $key = $_COOKIE['key'];
    //print_r($_COOKIE);
    //echo "<br/>";
    if ($username != "" && $token != "" && $key != "") {
        $result = sql("SELECT * FROM `cookiestore` WHERE username='$username' AND token='$token' AND keyval='$key' AND  closed=0");
        if ($result && $result->num_rows > 0) {
            $id = $result->fetch_assoc();
            if ($result->num_rows > 1) {
                //TODO:Take proper action
                return 0;
            } else {
                if (isset($_SESSION['started']) && $_SESSION['started'] == 1) {
                    //TODO: If there is anything to modify in a live session
                    return 1;
                } else if ($id['active'] == 1) {

                    $newKey = randomString(256);
                    $inittime = $id['inittime'];
                    $ip = $_SERVER['HTTP_HOST'];
                    setcookie('key', $newKey, time() + 30 * 24 * 3600);

                    sql("UPDATE `cookiestore` SET closed=1 WHERE username='$username' AND token='$token' AND closed=0");
                    sql("INSERT INTO  `cookiestore` (username,token,keyval,inittime,lasttime,ip,active,closed) VALUES ('$username','$token','$newKey','$inittime',CURRENT_TIMESTAMP,'$ip',1,0)");
                    $_SESSION['started'] = 1;
                    return 1;
                    //echo "INSERT INTO  `cookiestore` (username,token,keyval,inittime,lasttime,ip,active,closed) VALUES ('$username','$token','$newKey','$inittime',CURRENT_TIMESTAMP,'$ip',1,0)";
                } else {

                    clearAllCookies();
                    session_destroy();
                    if($path=="")return 0;
                    header("Location: " . $path);
                }
            }
        } else {
            $result = sql("SELECT * FROM `cookiestore` WHERE username='$username' AND token='$token' AND  closed=0");
            if ($result && $result->num_rows > 0) {
                //TODO: Possibly hacked. Deploy warning.

                sql("UPDATE `cookiestore` SET closed=1 WHERE username='$username' AND token='$token' AND closed=0");
            }
            clearAllCookies();
            session_destroy();
            if($path=="")return 0;
            header("Location: " . $path);
        }
    } else {
        clearAllCookies();
        session_destroy();
        if($path=="")return 0;
        header("Location: " . $path);
    }
}

function hashPass($pass)
{
    return $pass; //TODO: Decide a hashing algorithm
}


function randomString($len = 10)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randstring = '';
    for ($i = 0; $i < $len; $i++) {
        $randstring .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $randstring;
}

//echo (RandomString());
function encode($str)
{
    $result = '';
    for ($i = 0; $i < strlen($str); $i++) {
        if (($str[$i] < '0' | $str[$i] > '9') & ($str[$i] < 'a' | $str[$i] > 'z') & ($str[$i] < 'A' | $str[$i] > 'Z')) {
            $result .= "[" . strval(ord($str[$i])) . ']';
        } else {
            $result .= $str[$i];
        }
    }
    return $result;
}

function decode($str)
{
    $result = '';
    $on = 0;
    $temp = '';
    for ($i = 0; $i < strlen($str); $i++) {
        if ($str[$i] == '[') {
            $on = 1;
        } else if ($str[$i] == ']') {
            $on = 0;
            $result .= chr(intval($temp));
            $temp = '';
        }
        if ($on === 0 & $str[$i] != ']') {
            $result .= $str[$i];
        } else if ($str[$i] != ']' & $str[$i] != '[') {
            $temp .= $str[$i];
        }
    }
    return $result;
}

function dpLink($docuserid, $docid){
    $icon = "./doc_icon.svg";
    if (file_exists("../dp/user/$docuserid" . ".jpg")) $icon = "../dp/user/$docuserid" . ".jpg";
    if (file_exists("../dp/user/$docuserid" . ".jpeg")) $icon = "../dp/user/$docuserid" . ".jpeg";
    if (file_exists("../dp/user/$docuserid" . ".png")) $icon = "../dp/user/$docuserid" . ".png";
    if (file_exists("../dp/doc/$docid" . ".jpg")) $icon = "../dp/doc/$docid" . ".jpg";
    if (file_exists("../dp/doc/$docid" . ".jpeg")) $icon = "../dp/doc/$docid" . ".jpeg";
    if (file_exists("../dp/doc/$docid" . ".png")) $icon = "../dp/doc/$docid" . ".png";
    return $icon;
}
//echo decode(encode("Hi! It's me.\n<br>"));
//echo encode("Hi! It's me.\n<br>");

function getAadharInfo($cardNumber)
{ //TODO:Update when ACCESS GRANTED
    $a = array('a', 'a');
    array_push($a, '0');
    array_push($a, '1');
    array_push($a, '2');
    array_push($a, '2');
    array_push($a, '4');
    array_push($a, '5');
    return $a;
}

//print_r( getAadharInfo(''));

function clearAllCookies()
{
    if (isset($_SERVER['HTTP_COOKIE'])) {
        $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
        foreach ($cookies as $cookie) {
            $parts = explode('=', $cookie);
            $name = trim($parts[0]);
            setcookie($name, '', time() - 1000);
            setcookie($name, '', time() - 1000, '/');
        }
    }
}

?>