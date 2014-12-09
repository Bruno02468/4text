<?php



$f_contents = explode("\r\n", file_get_contents("http://dl.dropboxusercontent.com/u/141478576/SpookyBoard/SpookyBoard.txt")); 
$index = rand(0, count($f_contents) - 1);
$url = $f_contents[$index];

$f_contents = explode("\r\n", file_get_contents("http://dl.dropboxusercontent.com/u/141478576/SpookyBoard/SpookyLinks.txt")); 
$link = $f_contents[$index];

header("Content-type: text/html");
echo "<a href='" . $link . "'><img src='" . $url . "' style='width: 300; height: auto;'></a>";

?>
