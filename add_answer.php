<?php

/* ===add_answer.php===
   
   This file is called to add answers to threads
   via the form in view.php. Modifications here
   will only apply to posts sent after the modification.
   For formatting, use format.php.
   
   Author: Bruno02468

 */

$id = $_POST["id"];
$content = $_POST["text"];
$imgurl = $_POST["url"];

$last = file_get_contents("db/counter");
$myid = $last + 1;

if (trim($content) == "") {
    die("pls no empty post");
}

function lelparse($text) {
    while ($text != stripslashes($text)) { $text = stripslashes($text);  }    
    $text = strip_tags($text,"<b><i><u>");
    $text = preg_replace("/(?<!http:\/\/)www\./","http://www.",$text);
    $text = preg_replace( "/((http|ftp)+(s)?:\/\/[^<>\s]+)/i", "<a href=\"\\0\" target=\"_blank\">\\0</a>", $text );
    
    return $text;
}


$content = lelparse($content);
$content = htmlspecialchars($content); 
$content = str_replace("\r\n", "<br>", $content);
$content = str_replace("\n", "<br>", $content);


if (!file_exists("db/threads/" . $id)) {
    header("Location: http://bruno02468.com/4text/");
}

file_put_contents("db/counter", $myid);
date_default_timezone_set("UTC");
$final = "\n" . $myid . "<>" . $content . "<>" . $imgurl . "<>" . date('[d/m/y h:i:s A]');


file_put_contents("db/threads/" . $id, $final, FILE_APPEND | LOCK_EX);

header("Location: http://bruno02468.com/4text/bread/" . $id);

?>
