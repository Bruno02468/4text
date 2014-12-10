<?php

/* ===view.php===
   
   This is the file used in /bread/[id]
   pages, to view threads and add answers.
   Uses: format.php, img.php.
   
   Author: Bruno02468

 */

include("format.php");

$id = $_GET["id"];
$threadfile = "db/threads/" . $id;

if (!file_exists($threadfile)) {
    header("Location: http://bruno02468.com/4text/?notfound");
}

$file = file($threadfile);

$array = explode("<>", $file[0]);
$title = " Anon - ";
$contents = format($array[1]);
$img = "File: <a href='" . $array[2] . "' target='_blank'>" . basename($array[2]) . "<br><img class='image' style=\"float: left; width: 300px; height: auto; vertical-align: top; margin-right: 10px;\" src='" . $array[2] . "'></a>";
$date = $array[3];

if (!filter_var($array[2], FILTER_VALIDATE_URL)) {
    $img = "";
}

$answers = "";

for ($i = 0; $i < count($file); $i++) {
    if ($i === 0) {
        continue;
    }
    $ans = explode("<>", $file[$i]);
    $ansi = "";
    $cont = format($ans[1]);
    if ($ans[2] !== "")
        $ansi = "File: <a target='_blank' href='" . $ans[2] . "'>" . basename($ans[2]) . "<br><img style='float: left;' src='" . $ans[2] . "' class=\"image\"></a>";
    $answers .= "<div class='post' id='p" . $ans[0] . "'>" . $ansi . "<div><b>Anon - </b><small>" . $ans[3] . " No. <a href='javascript: reply(" . $ans[0]  . ");'>" . $ans[0] . "</a></small><span style='position: relative; left: 20px;'><br><br>" . $cont . "</div></div></div>";
}

?>

<html>
<head>
    <title>View thread #<?php echo $id; ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link rel="stylesheet" type="text/css" href="http://bruno02468.com/stylesheets/dark.css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="http://bruno02468.com/4text/4.css">
<head>

<body>
<center>
<div id="bannerBox">
    <p style="font-family: Arial;">
    <b style="color: #D1FFD6; font-size: 200%; ">SpookyBoard</b><br><br>
    <?php echo file_get_contents("http://bruno02468.com/4text/img.php"); ?></object><br><br>
    <b style="color: red; font-size: 110%; ">Please leave your sanity in a safe place.</b>
    </p> 
    <br>
</div>
<small><a class="mono" href="javascript: toggleForm();" id="togg">Reply to thread</a></small><br><br>
<form id="newt" action="http://bruno02468.com/4text/add_answer.php" method="POST" style="vertical-align: middle;">
    <p><label for="url">Embedded image URL:</label><input type="text" name="url" id="url"></p>
    <p><label for="text">Answer contents:</label><textarea name="text" id="text" style="vertical-align: middle;"></textarea></p>
    <input type="hidden" name="id" value="<?php echo $id; ?>">
    <p><label for="sub"></label><input type="submit" value="Submit answer"></p>
</form><br><hr><br><br>
</center>
<div class="op" id="p<?php echo $id; ?>"><?php echo $img; ?><div><b><?php echo $title; ?></b>
<small><?php echo $date; ?> No. <a href="javascript: reply(<?php echo $id; ?>);"><?php echo $id; ?></a></small></div>
<br><?php echo $contents; ?>
</div>
<?php echo $answers; ?>
<script>

var form = $("#newt");
var togg = $("#togg");
form.hide();

function toggleForm() {
    if (form.is(":visible")) {
        togg.html("Reply to thread");
        form.hide();
    } else {
        togg.html("Hide form");
        form.show();
    }
}

function reply(post) {
    form.show();
    $('html,body').scrollTop(0);
    if (post !== "")
        document.getElementById("text").innerHTML += ">>" + post + "\n";
}

</script>
</body>
</html>
