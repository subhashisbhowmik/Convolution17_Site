<?php
require_once "php/functions.php";
$await_confirm = 0;
$name = "";
$email = "";
$num_noti = 0;
$m = '';
$info='';
if (isset($_COOKIE['convo_mail'])) {
    $email = $_COOKIE['convo_mail'];
    if (isset($_COOKIE['convo_token'])) {
        $token = $_COOKIE['convo_token'];
//        echo "SELECT * FROM `cookie` WHERE `mail`='$email' AND `token`='$token'";
        $result = sql("SELECT * FROM `cookie` WHERE `mail`='$email' AND `token`='$token'");
        if ($result->num_rows > 0) {
//            $row = $result->fetch_assoc();
//            $mail = $row['mail'];
            $row = sql("SELECT * FROM `users` WHERE `email`='$email'")->fetch_assoc();
//            print_r($row);
            $name = $row['name'];
            if (!isset($_SESSION['on'])) {
                $token = randomString(64);
                sql("UPDATE `cookie` SET `token`='$token' WHERE `mail`='$email'");
//                $_COOKIE['convo_token'] = $token;
                setcookie('convo_token', $token, time() + (86400 * 30), "/");
            }
        } else {
//            $_COOKIE['convo_mail'] = '';
//            $_COOKIE['convo_token'] = '';
            setcookie('convo_mail', '', time() + (86400 * 30), "/");
            setcookie('convo_token', '', time() + (86400 * 30), "/");

        }
    } else {
        if (isset($_COOKIE['not_confirmed']) && $_COOKIE['not_confirmed'] === '1')
            $await_confirm = 1;
        else setcookie('convo_mail', '', time() + (86400 * 30), "/");//$_COOKIE['convo_mail'] = '';
    }
    if ($name != '') {
        $result = sql("SELECT * FROM `noti` WHERE `email`='$email' AND `seen`=0 ORDER BY `ts` DESC");
        $num_noti = $result->num_rows;
        $result_seen = sql("SELECT * FROM `noti` WHERE `email`='$email' AND `seen`=1 ORDER BY `ts` DESC");
        $events=sql("SELECT `event` FROM `registration` WHERE `email`='$email'");
        $eventNames=array();
        foreach ($events as $eventName){
            $eventNames[$eventName['event']]=1;
        }
        $info=sql("SELECT * FROM `users` WHERE `email`='$email'")->fetch_assoc();
    }
}
if (isset($_GET['m'])) $m = $_GET['m'];
?>
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml"
      xmlns:og="http://ogp.me/ns#"
      xmlns:fb="https://www.facebook.com/2008/fbml">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-COMPATIBLE" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Website for Convolution 2017"/>
    <meta name="keywords"
          content="event, fest, convolution, 2017, jadavpur university, electrical engineering, 17, 2k17"/>
    <meta name="author" content="Subhashis Bhowmik"/>
    <title>Convolution 2017</title>
    <meta property="og:title" content="Convolution 2017" />
    <meta property="og:description" content="The Annual Techno-Management Fest of Jadavpur University Electrical Engineering Department" />
    <meta property="og:image" content="http://www.convolutionjuee.com/img/og.jpg"/>
    <meta property="og:url" content="http://www.convolutionjuee.com"/>
    <meta property="og:type" content="website"/>
    <meta property="fb:admins" content="subhashis.b96"/>
    <link rel="shortcut icon" type="image/svg+xml" href="favicon.svg"/>
    <link rel="stylesheet" type="text/css" href="css/loader.css"/>
    <link rel="stylesheet" type="text/css" href="css/reset.css"/>
    <link rel="stylesheet" type="text/css" href="css/main.css"/>
    <link rel="stylesheet" type="text/css" href="css/jquery.mCustomScrollbar.css"/>
    <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css"/>
    <link rel="stylesheet" type="text/css" href="css/spinner.css"/>
    <script type="text/javascript" src="js/jq.js"></script>

</head>
<body><script>
    window.fbAsyncInit = function() {
        FB.init({
            appId      : '190504778098387',
            xfbml      : true,
            version    : 'v2.8'
        });
        FB.AppEvents.logPageView();
    };

    (function(d, s, id){
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) {return;}
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/en_US/sdk.js";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
    FB.AppEvents.logEvent("pageHit");
    <?php
    if($email!="") echo "FB.AppEvents.logEvent(\"pageHitUser: $email\");";
    ?>
</script>
<noscript>
    Javascript is disabled. Redirecting...
    <meta HTTP-EQUIV="REFRESH" content="0; url=lite/">
</noscript>
<div id="loader">
    <div id="animatedlogo">
        <img src="img/animatedlogo.svg">
    </div>
    <div id="mousescroll">
        <img src="img/scroll.svg">
    </div>
    <div id="keyboard">
        <img src="img/keys.svg">
    </div>
</div>
<div id="holder" tabindex="-1" class="mCustomScrollbar" data-mcs-theme="dark">
    <div id='nav'>
        <ul>
            <li id="tab-home" class='active' data-id="header"><span><b>Home</b></span></li>
            <li id="tab-about" data-id="about"><span><b>About</b></span></li>
            <li id="tab-circuistic" data-id="circuistic"><span><b>Circuistic</b></span></li>
            <li id="tab-algomaniac" data-id="algomaniac"><span><b>Algomaniac</b></span></li>
            <li id="tab-sparkhack" data-id="sparkhack"><span><b>SparkHACK</b></span></li>
            <li id="tab-papier" data-id="papier"><span><b>Papier</b></span></li>
            <li id="tab-controversial" data-id="CONtroversial"><span><b>CONtroversial</b></span></li>
            <li id="tab-decisia" data-id="decisia"><span><b>Decisia</b></span></li>
            <li id="tab-inquizzitive" data-id="inquizzitive"><span><b>Inquizzitive</b></span></li>
            <li id="tab-seminar" data-id="seminar"><span><b>Seminar</b></span></li>
            <!--            <li id="tab-sponsors" data-id="sponsors"><span><b>Sponsors</b></span></li>-->
            <li id="tab-contact" data-id="contact"><span><b>Contact</b></span></li>
        </ul>
    </div>
</div>
<!--<div id="button_login"></div>-->
<div id="message_div" style="display:none;">
    <div id="message"><?php
        if ($m != '') {
            if ($m == 'li') {
                echo "Logged In";
            } else if ($m == 'lo') {
                echo "Logged Out";
            } else if ($m == 'wp') {
                echo "Wrong Username or Password";
            } else if ($m == 'nc') {
                //TODO: Resend.php
                echo "Please confirm your e-mail ID first.";// <a id='resend' href='php/resend.php'></a>
            } else if ($m == 'ar'){
                echo "Account deleted.";
            }
        }
        ?></div>
    <div class="message_remove">&#x2715;</div>
</div>
<div id="login_signup_div">
    <div id="login_signup_div_content">
        <div id="login_signup_div_close">&#x2715;</div>
        <div id="login_signup_div_content_in">
            <div class="log_sin">
                <form action="php/login.php" method="post" name="login_form">
                    <label>Login</label>
                    <div id="wup" style="color: red;display:none;margin:5px">Wrong Username Or Password.</div>
                    <div id="lif" style="color: red;display:none;margin:5px">Login or Signup First.</div>
                    <input required="required" type="email" id="login_email" name="login_email"
                           placeholder="E-mail ID"/>
                    <input required="required" type="password" id="login_pass" name="login_pass"
                           placeholder="Password"/>
                    <button id="login_btn">Login</button>
                </form>
            </div>

            <div class="log_sin">
                <form action="php/signup.php" method="post" name="signup_form" id="signup_form">
                    <label>sign up</label>
                    <input required="required" type="text" id="signup_name" name="signup_name" placeholder="Name"/>
                    <input required="required" type="email" id="signup_email" name="signup_email"
                           placeholder="E-mail ID"/>
                    <input required="required" type="tel" maxlength="15" id="signup_contact" name="signup_contact"
                           placeholder="Contact Number"/>
                    <input required="required" pattern=".{8,100}" type="password" id="signup_password"
                           name="signup_password" placeholder="Password (At least 8 characters long)"/>
                    <input required="required" type="password" id="signup_password_2" name="signup_password_2"
                           placeholder="Confirm Password"/>
                    <input required="required" autocomplete="new-password" "type="text" id="signup_institute" name="signup_institute"
                    placeholder="College or University"/>
                    <input required="required" autocomplete="new-password" type="text" id="signup_dept" name="signup_dept"
                           placeholder="Department"/>
                    <select required="required" id="class" name="class">
                        <optgroup label="class">
                            <option>Still in School</option>
                            <option selected="selected">UG 1st yr</option>
                            <option>UG 2nd yr</option>
                            <option>UG 3rd yr</option>
                            <option>UG 4th yr</option>
                        </optgroup>
                    </select>
                    <button id="signup_btn" type="submit">Sign up</button>
                </form>
            </div>
        </div>
    </div>
</div>
<div id="nameDummy" style="display:none;"><?php echo $name;?></div>
<div id="settings_div">
    <div id="settings_div_content">
        <div id="settings_close">&#x2715;</div>
        <div id="login_signup_div_content_in">
            <div class="log_sin" style="display: table-cell; vertical-align: middle;padding-top: 9vh; ">
                <div class="block_">Hi,</div>
                <?php
                    echo '<div class="block_">'.$name.'</div>' ;
                    echo '<div class="block_" style="text-transform: lowercase">E-Mail: '.$email.'</div>';
                ?>
                <div style="clear:both"></div>
                <div id="removeAcct">Remove Account</div>
            </div>
            <div class="log_sin" style="float:right;">
                <form action="php/change.php" method="post" name="update_form" id="update_form">
                    <label>Change Details</label>
                    <input required="required" type="password" id="old_password" name="old_password"
                           placeholder="Old Password"/>
                    <input pattern=".{8,100}" type="password" id="new_password"
                           name="new_password" autocomplete="new-password" placeholder="Password (At least 8 characters long)"/>
                    <input type="password" autocomplete="new-password" id="new_password_2" name="new_password_2"
                           placeholder="Confirm Password"/>
                    <input required="required" type="tel" maxlength="15" id="signup_contact" name="signup_contact"
                           placeholder="Contact Number" value="<?php if($info!='') echo $info['contact'];?>"/>
                    <input required="required" "type="text" id="signup_institute" name="signup_institute"
                    placeholder="College or University" value="<?php if($info!='') echo $info['inst'];?>"/>
                    <input required="required" type="text" id="signup_dept" name="signup_dept"
                           placeholder="Department" value="<?php if($info!='') echo $info['dept'];?>"/>
                    <select required="required" id="class" name="class">
                        <optgroup label="class">
                            <option <?php if($info!='' &&$info['class']=='Still in School') echo 'selected="selected"';?>>Still in School</option>
                            <option <?php if($info!='' &&$info['class']=='UG 1st yr') echo 'selected="selected"';?>>UG 1st yr</option>
                            <option <?php if($info!='' &&$info['class']=='UG 2nd yr') echo 'selected="selected"';?>>UG 2nd yr</option>
                            <option <?php if($info['class']=='UG 3rd yr') echo 'selected="selected"';?>>UG 3rd yr</option>
                            <option <?php if($info!='' &&$info['class']=='UG 4th yr') echo 'selected="selected"';?>>UG 4th yr</option>
                        </optgroup>
                    </select>
                    <button id="signup_btn" type="submit">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="detailsDivWrapper">
    <div id="detailsDiv">
        <div id="detailsDivClose">&#x2715;</div>
        <iframe id="detailsDivFrame" src=" "></iframe>
    </div>
</div>

<div id="right_div" class="home">
    <div id="noti_num" style="<?php if ($num_noti == 0) echo "display:none;" ?>">
        <div style="display: table-cell; vertical-align: middle;">
            <?php echo $num_noti; ?>
        </div>
    </div>
    <div class="content" style="display:none; ">
        <div id="close" style="color:white;cursor:pointer;float:right;">&#x2715;</div>

        <div id="content_inside">

            <div <?php if ($name != '') echo 'style="display:none;"'; ?>id="login_signup_btn" class="noSelect">
                Login / Sign Up
            </div>
            <div id="name_show" <?php if ($name == '') echo 'style="display:none;"'; ?> >
                <?php echo $name; ?>

            </div>
            <div id="noti_dummy" style="display:none;cursor: pointer">
                <div class="notification">
                    random notification
                    <div class="notification_remove">&#x2715;</div>
                </div>
            </div>
            <div id="fbWrapper" >
                <div id="noti" >
                    <div class="notification" style="background-color: rgb(255, 190, 74);margin:2px; height:100px;border-radius: 2px">
                        <iframe src="https://www.facebook.com/plugins/like.php?href=https%3A%2F%2Fwww.facebook.com%2Fconvolution.juee&width=450&layout=standard&action=like&size=small&show_faces=true&share=true&height=80&appId" width="236" height="95" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true"></iframe>
                    </div>
                </div>
            </div>
            <div id="notifications_wrapper" <?php if ($name == '') echo 'style="display:none;"'; ?> class="noSelect">

            </div>
            <div id="notifications_buttons" <?php if ($name == '') echo 'style="display:none;"'; ?> >
                <div id="settings">Settings</div>
                <a id="logout" href="php/logout.php">
                    <div>Logout</div>
                </a>
            </div>
        </div>
    </div>
    <div id="arrow">
        <div id="arrow_a" style="color:white;cursor:pointer;">&#x203A;</div>
    </div>
</div>


<div id="teamWrapper" style="display:none">
    <div id="teamDiv">
        <div id="teamClose">&#x2715;</div>
        <div id="teamContents">

            <div class="teamDesignation">Website</div>

            <div class="member">
                <div class="member_img"><img src="img/contacts/subhashis.jpg" onerror='$(this).parent().hide();'></div>
                <div class="member_name">Subhashis Bhowmik </div>
            </div>

            <div class="member">
                <div class="member_img"><img src="img/contacts/sudipto.jpeg" onerror='$(this).parent().hide();'></div>
                <div class="member_name">Sudipto Banik </div>
            </div>
            <div class="member">
                <div class="member_img"><img src="img/contacts/pratik.jpeg" onerror='$(this).parent().hide();'></div>
                <div class="member_name">Pratik Karmakar </div>
            </div>
<!---->
<!--            <div class="teamDesignation">Organization</div>-->
<!---->
<!--            <div class="member">-->
<!--                <div class="member_img"><img src="img/contacts/subhashis.jpg" onerror='$(this).parent().hide();'></div>-->
<!--                <div class="member_name">Subhashis Bhowmik </div>-->
<!--            </div>-->
<!---->
<!--            <div class="member">-->
<!--                <div class="member_img"><img src="img/contacts/pratik.jpeg" onerror='$(this).parent().hide();'></div>-->
<!--                <div class="member_name">Pratik Karmakar </div>-->
<!--            </div>-->
<!--            <div class="member">-->
<!--                <div class="member_img"><img src="img/contacts/biswajit.jpeg" onerror='$(this).parent().hide();'></div>-->
<!--                <div class="member_name">Biswajit Tikadar </div>-->
<!--            </div>-->
<!--            <div class="member">-->
<!--                <div class="member_img"><img src="img/contacts/debapriya.jpeg" onerror='$(this).parent().hide();'></div>-->
<!--                <div class="member_name">Debapriya Basu </div>-->
<!--            </div>-->
<!--            <div class="member">-->
<!--                <div class="member_img"><img src="img/contacts/debarshi.jpg" onerror='$(this).parent().hide();'></div>-->
<!--                <div class="member_name">Debarshi Chanda </div>-->
<!--            </div>-->
<!--            <div class="member">-->
<!--                <div class="member_img"><img src="img/contacts/anirjit.jpg" onerror='$(this).parent().hide();'></div>-->
<!--                <div class="member_name">Anirjit Mitra </div>-->
<!--            </div>-->
            <div class="teamDesignation">Algomaniac</div>

            <div class="member">
                <div class="member_img"><img src="img/contacts/anisha.jpeg" onerror='$(this).parent().hide();'></div>
                <div class="member_name">Anisha Bannerjee </div>
            </div>

            <div class="member">
                <div class="member_img"><img src="img/contacts/nag.jpg" onerror='$(this).parent().hide();'></div>
                <div class="member_name">Sayan Nag </div>
            </div>
            <div class="member">
                <div class="member_img"><img src="img/contacts/niladri.jpeg" onerror='$(this).parent().hide();'></div>
                <div class="member_name">Niladri Dutta </div>
            </div>
            <div class="member">
                <div class="member_img"><img src="img/contacts/shounak.jpeg" onerror='$(this).parent().hide();'></div>
                <div class="member_name">Shounak Biswas </div>
            </div>

            <div class="teamDesignation">Circuistic</div>

            <div class="member">
                <div class="member_img"><img src="img/contacts/druhin.jpg" onerror='$(this).parent().hide();'></div>
                <div class="member_name">Druhin Chowdhury </div>
            </div>

            <div class="member">
                <div class="member_img"><img src="img/contacts/soumee.jpeg" onerror='$(this).parent().hide();'></div>
                <div class="member_name">Soumee Guha </div>
            </div>
            <div class="member">
                <div class="member_img"><img src="img/contacts/anurag.jpeg" onerror='$(this).parent().hide();'></div>
                <div class="member_name">Anurag Chhetri </div>
            </div>
            <div class="member">
                <div class="member_img"><img src="img/contacts/sadaf.jpeg" onerror='$(this).parent().hide();'></div>
                <div class="member_name">Sadaf Syed </div>
            </div>
            <div class="teamDesignation">Decisia</div>

            <div class="member">
                <div class="member_img"><img src="img/contacts/debapriya.jpeg" onerror='$(this).parent().hide();'></div>
                <div class="member_name">Debapriya Basu </div>
            </div>

            <div class="member">
                <div class="member_img"><img src="img/contacts/shounak.jpeg" onerror='$(this).parent().hide();'></div>
                <div class="member_name">Shounak Biswas </div>
            </div>
            <div class="member">
                <div class="member_img"><img src="img/contacts/anirjit.jpeg" onerror='$(this).parent().hide();'></div>
                <div class="member_name">Anirjit Mitra </div>
            </div>
            <div class="member">
                <div class="member_img"><img src="img/contacts/debayan.jpg" onerror='$(this).parent().hide();'></div>
                <div class="member_name">Debayan Seal </div>
            </div>
            <div class="member">
                <div class="member_img"><img src="img/contacts/aritra.jpg" onerror='$(this).parent().hide();'></div>
                <div class="member_name">Aritra Roy </div>
            </div>
            <div class="teamDesignation">SparkHACK</div>

            <div class="member">
                <div class="member_img"><img src="img/contacts/paulomi.jpeg" onerror='$(this).parent().hide();'></div>
                <div class="member_name">Paulomi Bhowmick </div>
            </div>

            <div class="member">
                <div class="member_img"><img src="img/contacts/sanmoy.jpeg" onerror='$(this).parent().hide();'></div>
                <div class="member_name">Sanmoy Chakrabarty </div>
            </div>
            <div class="member">
                <div class="member_img"><img src="img/contacts/sanjoy.jpeg" onerror='$(this).parent().hide();'></div>
                <div class="member_name">Sanjoy Poddar </div>
            </div>
            <div class="member">
                <div class="member_img"><img src="img/contacts/debarshi.jpg" onerror='$(this).parent().hide();'></div>
                <div class="member_name">Debarshi Chanda </div>
            </div>
        </div>
    </div>
</div>
</div>

<div id="bg"></div>
<div id="wrapper">
    <div id="main">
        <div id="convo">
            <div class="bg"></div>
            <div id="home" class="item">
                <!--<div class="bg"></div>-->
                <div class="inner">
                    <!--<img id="ju" src="img/ju.png"/>-->
                    <img class="foreground hidden" id="first" src="img/convo_black.svg"/>
                    <div class="line hidden"></div>
                    <img class="foreground hidden" id="second" src="img/TechUrShare.png"/>
                </div>
            </div>
            <div id="about" class="item">
                <!--<div class="bg"></div>-->
                <div class="parallax">
                    <img src="img/parallax/5.svg" class="inner" id="item5">
                    <img src="img/parallax/4.svg" class="inner" id="item4">
                    <img src="img/parallax/3.svg" class="inner" id="item3">
                    <img src="img/parallax/2.svg" class="inner" id="item2" style="z-index: 2">
                    <!--<img src="img/parallax/1.svg" class="inner" id="item1">-->
                    <div class="inner img" id="item1" style="background-image:url('img/parallax/1wofan.svg');">
                        <img class="rotator" src="img/parallax/1wfan.svg">
                    </div>
                </div>
                <div id="content" style="margin-top:-2px">
                    <img src="img/logo2.png" id="logo"/>
                    <p class="text">The annual technical meet organized by the students of the Department of Electrical
                        Engineering, Jadavpur University. It is aimed at providing a platform for engineering students
                        to learn and apply their acquired skills. The 3-day event will promote extensive interaction
                        among creative solution designers and prominent personalities from academics and industries.
                    </p>

                    <div class="end">
                        <i class="fa fa-calendar-check-o"></i><span>3-5th March</span><span>Jadavpur University</span><i
                            class="fa fa-university"></i>
                    </div>
                </div>
            </div>


            <!--debitis eaque facilis illum ipsa ipsum possimus, quod.</p>-->
        </div>
        <div id="events" style="padding-top: 100px;">
            <div id="circuistic" class="item" style="background: #ffb630">
                <div id="lcd">
                    <img src="img/circuistic/LCD.png"/>
                    <img src="img/circuistic/LCD_ON.png"/>
                    <img src="img/circuistic/LCD_Convolution.png"/>
                    <img src="img/circuistic/LCD_Circuistic.png"/>
                </div>
                <!--<h1 class="item" style="text-align: center; color: #00cc66">CIRCUISTIC</h1>-->
                <!--<hr>-->
                <br>
                <div id="circuistic_text" style="cursor: default;">Tired of reading only text books? Have an inherent
                    love for circuits?
                    Then this is the event you were looking for. CONVOLUTION 2017 presents CIRCUISTIC 4.0, the circuit
                    building event of the year. To all the enthusiasts and hobbyists out there here is your chance to
                    create magic with circuits and walk away with awesome prizes.<br>
                    The contestants will be given a problem statement, which has to be analysed and practically realised
                    by building a prototype circuit. The prototype must be both efficient and economical.
                    Come. Build. Win.
                </div>
                <div id="circuistic_contacts" style="cursor: default;">
                    <div id="circuistic_contacts_inner"><i style="color: dodgerblue">Contact: </i>
                        <div style="border-right: solid 2px dodgerblue">Soumee Guha- +919477784233 </div>
                        <div> Anurag Chhetri- +919732812683</div>
                    </div>
                </div>
                <!--<div id="circuistic_buttons_wrapper">-->
                <!--<div id="circuistic_buttons_wrapper_inner">-->
                <!--<a href="" style="text-decoration:none;float: left;"><div class="circuistic_button">DETAILS</div></a>-->
                <!--<a href="" style="text-decoration:none;float: right;"><div class="circuistic_button">REGISTER</div></a>-->
                <!--<div style="clear: both"></div>-->
                <!--</div>-->
                <!--</div>-->
                <div style="margin-top: 1.2vw">
                    <div id="circuistic_buttons_wrapper">
                        <div id="circuistic_buttons_wrapper_inner">

                                <div class="circuistic_details_btn circuistic_button pdf"  style="text-decoration:none;float: left;" event="circuistic">DETAILS</div>
                                <div style="text-decoration:none;float: right;<?php if(isset($eventNames['circuistic'])) echo "cursor:default;"; ?>" class="circuistic_button register" event="circuistic"><div class="spinner" style="display:none">
                                        <div class="bounce1"></div>
                                        <div class="bounce2"></div>
                                        <div class="bounce3"></div>
                                    </div><div class="tx" <?php if(isset($eventNames['circuistic'])) echo "status='done'"; ?>>Register<?php if(isset($eventNames['circuistic'])) echo "ed"; ?></div></div>

                            <div style="clear: both"></div>
                        </div>
                    </div>
                    <img class="ckt_image" src="img/circuistic/Circuits_2.png"/>
                </div>
                <div>
                    <div id="multitext" style="float:left">23.7</div>
                    <div id="oscillograph" style="float:right"></div>
                    <div style="clear: both"></div>
                </div>
            </div>
            <div id="algomaniac" class="item">
                <!--                <hr>-->
                <div id="algo_head">ALGOMANIAC</div>
                <div id="algo">
                    <div class="shrink">
                        <!--img id="consoleImg" src="img/flat_terminal_bare.svg"/-->
                        <div class="algo_buttons_class pdf" event="algomaniac"
                             style="position:absolute;float: left;top:80%;left:2%">
                            Details
                        </div>
                        <div class="algo_buttons_class register" event="algomaniac"
                             style="position:absolute;float: right;top:80%;right:2%;<?php if(isset($eventNames['circuistic'])) echo "cursor:default;"; ?>"><div class="spinner" style="display:none">
                                <div class="bounce1"></div>
                                <div class="bounce2"></div>
                                <div class="bounce3"></div>
                            </div>
                            <div class="tx" <?php if(isset($eventNames['circuistic'])) echo "ed"; ?>>Register<?php if(isset($eventNames['algomaniac'])) echo "ed"; ?></div>
                        </div>
                        <div id="laptop_screen">
                            <div id="termial_titlebar">
                                <div class="terminal_buttons" style="background-color:red;"></div>
                                <div class="terminal_buttons" style="background-color:#FFC107;"></div>
                                <div class="terminal_buttons" style="background-color:green;"></div>
                            </div>
                            <div id="console"></div>

                        </div>
                        <div id="laptop_bottom"></div>

                    </div>
                    <br/>
                    <!--                    <div id="algo_buttons_wrapper">-->
                    <!--                        <a class="algo_buttons_class" href="" style="float: left;">-->
                    <!--                            details-->
                    <!--                        </a>-->
                    <!--                        <a class="algo_buttons_class" href="" style="float: right;">-->
                    <!--                            register-->
                    <!--                        </a>-->
                    <!---->
                    <!--                    </div>-->
                    <!--                    <div id="algo_sponsors">-->
                    <!--                        place for sponsors-->
                    <!---->
                    <!--                    </div>-->
                </div>
            </div>
            <br/>
            <h1 id="sparkhack" class="item"></h1>
            <div id="sparkhack_wrapper"
                 style="background-image: url('./img/SH/Sparkhack_background.jpg');background-repeat: no-repeat;background-size: cover;background-position: top">
                <div id="sh_todo">
                    <div id="todoNoteWrapper1">
                        <div class="note todo_note" id="todo1" style="z-index: 950;">
                            <div class="note_remove">&#x2715;</div>
                            <div class="noteContent">Details</div>
                            <div class="noteDetails"
                                 style="display:none; white-space: pre-wrap;font-size: 0.9em;  width: 30vw">Code, create, build and revolutionize in this third edition of eastern India's biggest Hackathon, SparkHACK. In this 3-Day hackathon, college students as well professionals will strive to build a model which caters to the this year's theme of 'Internet of Things'.Internet of Things (IOT) is one of the most trending technical jargons in today's world.Engineers, designers and researchers will push their creative brains to the farthest limit and develop solutions pertinent to the problem statement in the field of Internet of Things (IOT). So step your game up this spring as there's a lot to be won.Compete with some of the best people of India and your idea just might be the next big thing for this society.</div>
                        </div>
                    </div>
                    <div id="todoNoteWrapper2">
                        <div class="note todo_note nr  pdf" id="todo2" event="sparkhack" style="z-index: 950;">
                            <div class="note_remove">&#x2715;</div>
                            <div class="noteContent">Rules And Regulations</div>
                            <div class="noteDetails"></div>
                        </div>
                    </div>

                    <!--                    <div class="note todo_note" id="todo2">-->
                    <!--                        2nd to do note-->
                    <!--                    </div>-->
                </div>
                <div id="sh_in_progress">
                    <div id="inprogressNoteWrapper1" class="noteWrapper">
                        <div class="note in_progress_note nr" id="in_progress1">
                            <div class="note_remove">&#x2715;</div>
                            <div class="noteContent">Mentors</div>
                            <div class="noteDetails" style="display:none"></div>
                        </div>
                    </div>
                    <div id="inprogressNoteWrapper2" class="noteWrapper">

                        <div class="note in_progress_note nr" id="in_progress2">
                            <div class="note_remove">&#x2715;</div>
                            <div class="noteContent nr">Judges</div>
                            <div class="noteDetails" style="display:none"></div>
                        </div>
                    </div>
                    <div id="inprogressNoteWrapper3" class="noteWrapper">
                        <div class="note in_progress_note nr register" id="in_progress3" event="sparkhack" style="<?php if(isset($eventNames['sparkhack'])) echo "cursor:default;"; ?>">

                            <div class="note_remove">&#x2715;</div>
                            <div class="spinner" style="display:none">
                                <div class="bounce1"></div>
                                <div class="bounce2"></div>
                                <div class="bounce3"></div>
                            </div>
                            <div class="noteContent nr tx" <?php if(isset($eventNames['circuistic'])) echo "ed"; ?>>Register<?php if(isset($eventNames['sparkhack'])) echo "ed"; ?></div>
                            <div class="noteDetails" style="display:none"></div>
                        </div>
                    </div>
                </div>

                <div id="sh_done">
                    <div id="doneNoteWrapper1" class="noteWrapper">

                        <div class="note done_note nr" id="done1">
                            <div class="note_remove">&#x2715;</div>
                            <div class="noteContent">Prizes</div>
                            <div class="noteDetails" style="display:none">1st Prize: Rs. 15,000<br>2nd Prize: Rs. 10,000<br>3rd Prize: Rs. 5,000</div>
                        </div>
                    </div>
                    <div id="doneNoteWrapper2" class="noteWrapper">
                        <div class="note done_note" id="done2">
                            <div class="note_remove">&#x2715;</div>
                            <div class="noteContent">Contacts</div>
                            <div class="noteDetails" style="display:none; text-align: end">Paulomi Bhowmick<br>+918961565172<br><br>Debarshi Chanda<br>+919051677526
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="papier" class="item cs" style="border-color: #931a46">
                <!--            <h1 id="presentation" class="item">PRESENTATION</h1>-->
                <div class="container">
                    <div id="header">
                        <div class="hide">Papier - Paper/Power Point Presentation</div>
                        <p class="hide" id="convo_papier">Convolution 2017</p>
                        <p class="hide" id="contacts_papier">Sourya Sengupta: +919874899365, Sayan Biswas: +918981608554</p>
                    </div>
                    <div id="body">
                        <div class="hide" id="left"><b style="font-weight: bold;text-decoration: underline">Abstract:</b></div>
                        <div class="hide" id="right">
                            
                            <div id="button_wrapper">
                            <div class="papier_buttons_class pdf" event="papier"
                                 >
                                Details
                            </div></div>
                        </div>
                        <div style="clear:both"></div>
                    </div>
                </div>
            </div>
            <div id="controversial" class="item cs" style="border-color: #624293">
                <!--            <h1 id="controversial" class="item">CONtroversial</h1>-->
                <div class="blankDiv" style="background-color: #c4402d">
                    CONtroversial
                    <div style="display:block; font-size: 4vw">The Convolution Parliamentary Debate</div>
                    <div class="progress">
                        <div class="indeterminate"></div>
                    </div>
                    <div class="comingSoon">Coming Soon</div>
                </div>
            </div>
            <div id="decisia" class="item cs" style="border-color: #6e2593">
                <!--            <h1 id="decisia" class="item">DECISIA</h1>-->
                <div class="blankDiv" style="background-color: #02964b">
                    Decisia
                    <div class="progress">
                        <div class="indeterminate"></div>
                    </div>
                    <div class="comingSoon">Coming Soon</div>

                </div>
            </div>
            <div id="inquizzitive" class="item cs" style="border-color: #137163">
                <!--            <h1 id="inquizzitive" class="item">INQUIZZITIVE</h1>-->
                <div class="blankDiv" style="background-color: #cfa518">
                    <div>Inquizzitive</div>
                    <div class="progress">
                        <div class="indeterminate"></div>
                    </div>
                    <div class="comingSoon">Coming Soon</div>
                </div>
            </div>
            <div id="seminar" class="item cs" style="border-color: #624293;background-color: none">

                <div id="matrixWrapper">
                    <canvas id="seminar_canvas"></canvas>
                </div>
                <div class="blankDiv" style="background: none">
                    <!--Seminar - Guest Lecture-->
                    <img style="width:80%" src="img/seminar.svg"/>
                    <div class="progress">
                        <div class="indeterminate"></div>
                    </div>
<!--                    <div class="comingSoon">Coming Soon</div>-->
                    <img style="width:45%" class="comingSoon" src="img/cs.svg"/>

                </div>
            </div>
            <!--            <div id="sponsors" class="item cs">-->
            <!--                <!--            <h1 id="sponsors" class="item">SPONSORS</h1>-->
            <!--                <div class="blankDiv">-->
            <!--                    <div class="progress">-->
            <!--                        <div class="indeterminate"></div>-->
            <!--                    </div>-->
            <!--                </div>-->
            <!--            </div>-->
            <div id="contact" class="item" style="margin-top:2%/*min-height: calc(100vh - 45px);*/">
                <div style="text-align: center;font-size: 1.5em;color: white;padding:20px 0 0;display: block;">
                    CONTACTS
                </div>
                <!--                <div class="blankDiv">-->
                <!--                    <div class="progress">-->
                <!--                        <div class="indeterminate"></div>-->
                <!--                    </div>-->
                <!--                </div>-->
                <div id="contacts_container">
                    <div id="contact_list" style="float: left">
                        <h2 style="text-align: center;padding: 15px;color: #bce8f1;">We Are ...</h2>

                        <div class="contact">
                            <div class="contact_img"><img src="img/contacts/subhashis.jpg"></div>
                            <div class="contact_name">Subhashis Bhowmik <span class="info_divider"></span> Secretary <span class="info_divider"></span> +919836802623
                            </div>
                        </div>

                        <div class="contact">
                            <div class="contact_img"><img src="img/contacts/pratik.jpeg"></div>
                            <div class="contact_name">Pratik Karmakar <span class="info_divider"></span> Joint Secretary
                                <span class="info_divider"></span> +919038391915
                            </div>
                        </div>

                        <div class="contact">
                            <div class="contact_img"><img src="img/contacts/biswajit.jpeg"></div>
                            <div class="contact_name">Biswajit Tikadar <span class="info_divider"></span> Treasurer <span class="info_divider"></span> +918697530045
                            </div>
                        </div>

                        <div class="contact">
                            <div class="contact_img"><img src="img/contacts/debarshi.jpg"></div>
                            <div class="contact_name">Debarshi Chanda <span class="info_divider"></span> Event Coordinator <span class="info_divider"></span> +919051677526
                            </div>
                        </div>

                        <div class="contact">
                            <div class="contact_img"><img src="img/contacts/debapriya.jpeg"></div>
                            <div class="contact_name">Debapriya Basu <span class="info_divider"></span> Sponsor Lead
                                <span class="info_divider"></span> +918444941108
                            </div>
                        </div>

                        <div class="contact">
                            <div class="contact_img"><img src="img/contacts/paulomi.jpeg"></div>
                            <div class="contact_name">Paulomi Bhowmick <span class="info_divider"></span> Marketing Lead
                                <span class="info_divider"></span> +918961565172
                            </div>
                        </div>

                        <div class="contact">
                            <div class="contact_img"><img src="img/contacts/shounak.jpeg"></div>
                            <div class="contact_name">Shounak Biswas <span class="info_divider"></span> Logistics Lead
                                <span class="info_divider"></span> +918001858305
                            </div>
                        </div>

                        <div id="know_the_team_btn">Know The Team</div>
                    </div>
                    <div id="div_for_query" style="float: right">
                        <div style="display: block;padding: 15px;text-align: center;">Have any Query? Ask us..</div>
                        <form id="queryForm" action="" method="post">
<!--                            <textarea placeholder="type here" id="query_input"></textarea>-->
                            <?php
                                if($name=="") echo "<textarea placeholder=\"type here [If you expect a reply from us, please Log In, or put your contact details in the query]\" id=\"query_input\"></textarea>";
                                else echo "<textarea placeholder=\"type here\" id=\"query_input\"></textarea>";
                            
                            ?>
                            <button id="query_submit">Send</button>
                        </form>
                    </div>
                </div>
                <div id="footer">
                    <div><a href="https://www.facebook.com/convolution.juee">facebook.com/convolution.juee</a></div>
                    <div><a href="mailto:convolution2017@gmail.com">convolution2017@gmail.com</a></div>
                    <div><a href="">www.convolutionjuee.com</a></div>
                </div>

            </div>
        </div>
    </div>
</div>


<script type="text/javascript" src="js/jquery.flot.js"></script>
<script type="text/javascript" src="js/jquery.mCustomScrollbar.concat.min.js"></script>
<script type="text/javascript" src="js/main.js"></script>

<script type="text/javascript" src="js/circuistic.js"></script>
<script type="text/javascript" src="js/console.js"></script>
<script type="text/javascript" src="js/note.js"></script>
<script type="text/javascript" src="js/paper.js"></script>
<script type="text/javascript" src="js/login_signup.js"></script>
<script type="text/javascript" src="js/register.js"></script>
<script type="text/javascript" src="js/pdf.js"></script>
<script type="text/javascript" src="js/query.js"></script>
<script type="text/javascript" src="js/matrix.js"></script>
</body>
</html>