<?php
/**
 * Created by PhpStorm.
 * User: Subhashis
 * Date: 10-02-2017
 * Time: 21:49
 */
require_once "../php/functions.php";
$user = "";
$pass = "";
$sum=0;
//print_r($_SESSION);
if (isset($_SESSION['convo_admin_user'])) $user = sanitizeString($_SESSION['convo_admin_user']);
if (isset($_SESSION['convo_admin_pass'])) $pass = sanitizeString($_SESSION['convo_admin_pass']);
$result = sql("SELECT * FROM `admin` WHERE `user`='$user' AND `pass`='$pass'");
if ($result->num_rows == 0) {
    $user = "";
    $pass = "";
    $_SESSION['convo_admin_user'] = '';
    $_SESSION['convo_admin_pass'] = '';
} else {
    sql("UPDATE `admin` SET ts=CURRENT_TIMESTAMP WHERE `user`='$user' AND `pass`='$pass'");
}
$event = "";
if (isset($_REQUEST['event'])) $event = urldecode(sanitizeString($_REQUEST['event']));
//die( $event." ".$user. ' '.$pass);
if ($event == "" || $user == "" || $pass == "") header("Location: ./");

$tag = '';
$error = '';
$selector = "`users`.`id` AS SignupID, `registration`.`id` AS RegID, event AS Event,`users`.`email`, `name` as `Name`, contact as Phone,class AS Class, dept AS Department, inst AS Institution, confirmation";
$filename = 'Convo17 ' . str_replace(" ", "_", $event) . ' ' . date(' g:iA d_M_Y', strtotime('+5 hour +30 minutes', strtotime(date("Y-m-d H:i:s"))));
if ($event == "All Users") {
    $tag = 'users';
    $select = "SELECT `id` AS SignupID, email, `name` AS `Name`, contact AS Phone,class AS Class, dept AS Department, inst AS Institution, confirmation  FROM `$tag`";
} else if ($event == "All Registrations") {
    $tag = 'registration';
    $select = "SELECT $selector FROM `registration` JOIN `users` ON `users`.`email`=`registration`.`email`;";

} else if ($event == "Convolution Team") {
    $tag = 'team';
    $select = "SELECT * FROM `$tag`";

} else if ($event == "All Users and Registrations") {
    $select = "SELECT $selector FROM `registration` RIGHT JOIN `users` ON `users`.`email`=`registration`.`email`;";
//    die($select);
} else if ($event == "Queries") {
    $select = "SELECT id AS QueryID,email, query as Query FROM `query`";
} else if($event=="Analytics"){
    $sum=sql("SELECT * FROM `hit`")->num_rows;
    $select="SELECT DAY(ts) AS `Day`,COUNT(*) AS Hits FROM `hit` GROUP BY Day";
    $select2="SELECT WEEK(ts) AS `Week`, COUNT(*) AS `Hits` FROM `hit` GROUP BY Week";

} else if($event=="admin"){
    $select="SELECT * FROM `admin` ORDER BY `ts` DESC";
}else {
    $tag = str_replace(" ", "", strtolower($event));
    $select = "SELECT $selector FROM `registration`  JOIN `users` ON `users`.`email`=`registration`.`email` WHERE `registration`.`event`='$tag'";
}
$export = sql($select);
if ($conn->errno) $texts = "Database Doesn't exist yet!";
else $texts = "This Database is EMPTY!!";
if($sum==0)
    $num = $export->num_rows;
else
    $num=$sum;

echo "<!DOCTYPE html>
<html lang=\"en\">
<head>
    <meta charset=\"UTF-8\">
    <meta http-equiv=\"X-UA-COMPATIBLE\" content=\"IE=edge\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
    <meta name=\"description\" content=\"Admin Page for Convolution 2017\"/>
    <meta name=\"author\" content=\"Subhashis Bhowmik\"/>
    <title>Convolution Admin</title>

    <link rel=\"stylesheet\" type=\"text/css\" href=\"../css/reset.css\"/>
    <link rel=\"stylesheet\" type=\"text/css\" href=\"css/main.css\"/>
    <link rel=\"stylesheet\" type=\"text/css\" href=\"css/table.css\"/>

</head>
<body style=\"height:100vh\">";
if ($export->num_rows == 0) die("
<div id=\"content\">$texts</div>
<a href=\"./\" id=\"back\"><img src=\"img/back.png\"/></a>
</body>
</html>");
$fields = $export->fetch_fields();



?>

<!--<div id="content">This page is under construction!!</div>-->
<div id="superWrapper">
    <h1 style="text-shadow: 2px 2px rgba(0,0,0,0.3);"><div style="border-right: solid 2px #6fffe7;display: inline-block;white-space: pre-wrap"><?php echo urldecode($_GET['event'])."  ";?></div> Total Entries: <?php echo $num; ?></h1>
    <div id="tableWrapper">

            <div class="tbl-content">
                <table cellpadding="0" cellspacing="0" border="0" style="<?php if($event=="Analytics") echo "table-layout:fixed";?>">
                <thead>
                <?php
                foreach ($fields as $field) {
                    echo "<th>" . $field->name . "</th>";
                }
                ?>
                </thead>

                <tbody>
                <?php
                foreach ($export as $row) {
                    echo "<tr>";
                    foreach ($row as $data) echo "<td>" . $data . "</td>";
                    echo "</tr>";
                }
                ?>
                </tbody>
            </table>
                <?php
                if($event=="Analytics") {
                    $export = sql($select2);
                    $fields = $export->fetch_fields();
                    echo "
                    <div id='plot1' style=\"width=100%\"></div>
                    <table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" style='table-layout: fixed'>
                    <thead>
                ";
                    foreach ($fields as $field) {
                        echo "<th>" . $field->name . "</th>";
                    }
                    echo "</thead>
                        <tbody>";

                    foreach ($export as $row) {
                        echo "<tr>";
                        foreach ($row as $data) echo "<td>" . $data . "</td>";
                        echo "</tr>";
                    }

                    echo "</tbody>
                    <div id='plot2' style=\"width=100%\"></div>";
                }
                ?>
        </div>
        </table>
    </div>
</div>
<a href="./" id="back"><img src="img/back.png"/></a>
<a href="download.php?event=<?php echo $_GET['event']?>" style="left:auto;right:2px;opacity:0.9" id="back"><img src="img/download.png"/></a>
<!--<script type="text/javascript" src="js/table.js"></script>-->
<script type="text/javascript" src="../js/jq.js"></script>

</body>
</html>
