<?php

function format($str) {
    $threadlinks = "/(==(\d*)(<br>)*)/";
    $threadrepls = "<a href='http://bruno02468.com/4text/bread/$2'>==$2</a>$3";

    $postlinks = "/(--(\d*)(<br>)*)/";
    $postrepls = "<a href=\"#p$2\">--$2</a>$3";

    $greentext = '/(&gt;.*<br>)/';
    $greenrepl = '<span class="greentext">\1</span>';

    $str = preg_replace($threadlinks, $threadrepls, $str);
    $str = preg_replace($postlinks, $postrepls, $str);
    $str = preg_replace($greentext, $greenrepl, $str . "<br>");


    return $str;
}

?>
