<?php require_once('auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
$WGmark1 = $_GET['WGmark1'];
$WGmark2 = $_GET['WGmark2'];
$WGmark3 = $_GET['WGmark3'];
$WGmark4 = $_GET['WGmark4'];
$WGmark5 = $_GET['WGmark5'];
$WGmark6 = $_GET['WGmark6'];
$WGmark7 = $_GET['WGmark7'];
$WGmark8 = $_GET['WGmark8'];

$WGmarktxt = fopen("WGmark.txt", "w");
$txt = "$WGmark1\n";
fwrite($WGmarktxt, $txt);
$txt = "$WGmark2\n";
fwrite($WGmarktxt, $txt);
$txt = "$WGmark3\n";
fwrite($WGmarktxt, $txt);
$txt = "$WGmark4\n";
fwrite($WGmarktxt, $txt);
$txt = "$WGmark5\n";
fwrite($WGmarktxt, $txt);
$txt = "$WGmark6\n";
fwrite($WGmarktxt, $txt);
$txt = "$WGmark7\n";
fwrite($WGmarktxt, $txt);
$txt = "$WGmark8\n";
fwrite($WGmarktxt, $txt);
fclose($WGmarktxt);

?>
<?php }?>