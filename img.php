<?php

/* ===img.php===
   
   This page returns the HTML necessary to
   show the banners linking to whatever
   Kevin wants them to link.

   Author: Bruno02468

 */

$f_contents = explode("\r\n", file_get_contents("db/images.txt")); 
$index = rand(0, count($f_contents) - 1);
$url = $f_contents[$index];

$f_contents = explode("\r\n", file_get_contents("db/links.txt")); 
$link = $f_contents[$index];

header("Content-type: text/html");
echo "<a href='" . $link . "'><img src='" . $url . "' style='width: 300; height: auto;'></a>";

?>
