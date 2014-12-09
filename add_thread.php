<?php

$content = $_POST["text"];
$imgurl = $_POST["url"];

$last = file_get_contents("db/counter");
$myid = $last + 1;

if (trim($content) == "") {
    die("pls no empty post");
}

$content = htmlspecialchars($content);
$content = str_replace("\r\n", "<br>", $content);
$content = str_replace("\n", "<br>", $content);

file_put_contents("db/counter", $myid);
date_default_timezone_set("UTC");

$final = " <>" . $content . "<>" . $imgurl . "<>" . date('[d/m/y h:i:s A]');

file_put_contents("db/threads/" . $myid, $final);

header("Location: http://bruno02468.com/4text/bread/" . $myid);

?>
