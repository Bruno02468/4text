<?php

/* ===index.php===

   This is the main page, it lists threads,
   contains a thread form, and shows the banners
   speficied through img.php.
   Uses: img.php, format.php.
   
   Author: Bruno02468

 */


include("format.php");

$arrDIR = array(); 
foreach (glob("db/threads/*") as $filename) { 
    if (is_file($filename)) {
        $arrDIR[$filename] = filemtime($filename); 
    } 
 }
arsort($arrDIR); 
$arrDIR = array_keys($arrDIR);
$lasts = "<br>";

for ($i = 0; ($i <= 9 && $i < count($arrDIR)); $i++) {
    $thread = $arrDIR[$i];
    if (!file_exists($thread))
        continue;
    $file = file($thread);
    $id = basename($thread);
    $answers = count($file) - 1;
    $array = explode("<>", $file[0]);
    $img = "";
    if ($array[2] !== "") {
        $img = "<a href='" . $array[2] . "' target='_blank'><img style=\"float: left; width: 300px; padding-right: 20px; height: auto; vertical-align: top;\" src='" . $array[2] . "'></a>";
    }
    $title = "Anon - "; 
    $contents = format($array[1]);
    $date = $array[3];
    
    $post = "<hr><div class='op'>" .  $img . "<div><b>" .  $title . "</b>       <small>" . $date . " No. " .  $id . " <a href='http://bruno02468.com/4text/bread/" . $id . "'>[Reply]</a> - has " . $answers . " replies</small><br><br>" . $contents . "<br><br></div></div>";
    $a = "";
    $c = 3;
    for ($j = $answers; $j > 0; $j--) {
        if ($c == 0)
            break;
        $ans = explode("<>", $file[$j]);
        $ansi = "";
        $cont = format($ans[1]);
        if ($ans[2] !== "")
            $ansi = "File: <a target='_blank' href='" . $ans[2] . "'>" . basename($ans[2]) . "<br><img style='float: left;' src='" . $ans[2] . "' class=\"image\"></a>";
        $a = "<div class='post'>" . $ansi . "<div><b>Anon - </b><small>" . $ans[3] . " No. <a href='javascript: reply(" . $ans[0]  . ");'>" . $ans[0] . "</a></small><span style='position: relative; left: 20px;'><br><br>" . $cont . "</div></div></div>" . $a;
        $c--;
    }

    $lasts .= $post . $a;
}

$w = "";

if (isset($_GET["notfound"])) {
    
}

?>

<html>
<head>
    <title>Son of 4text</title>
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
</div>
<small><a class="mono" href="javascript: toggleForm();" id="togg">Create a thread</a></small><br><br>
<form id="newt" action="add_thread.php" method="POST" style="vertical-align: middle;">
    <p><label for="url">Embedded image URL:</label><input type="text" name="url" id="url"></p>
    <p><label for="text">Thread contents:</label><textarea name="text" id="text" style="vertical-align: middle;"></textarea></p>
    <input type="submit" value="Submit new thread">
</form>
</center>
<?php echo $lasts; ?>
<script>

var form = $("#newt");
var togg = $("#togg");
form.hide();

function toggleForm() {
    if (form.is(":visible")) {
        togg.html("Create a thread");
        form.hide();
    } else {
        togg.html("Hide form");
        form.show();
    }
}

</script>
</body>
</html>
