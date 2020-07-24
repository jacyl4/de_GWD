<?php require_once('../auth.php'); ?>
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

$data = json_decode(file_get_contents('/usr/local/bin/0conf'), true);
$data['wireguard']['WGmark'][0] = $WGmark1;
$data['wireguard']['WGmark'][1] = $WGmark2;
$data['wireguard']['WGmark'][2] = $WGmark3;
$data['wireguard']['WGmark'][3] = $WGmark4;
$data['wireguard']['WGmark'][4] = $WGmark5;
$data['wireguard']['WGmark'][5] = $WGmark6;
$data['wireguard']['WGmark'][6] = $WGmark7;
$data['wireguard']['WGmark'][7] = $WGmark8;
$newJsonString = json_encode($data, JSON_PRETTY_PRINT);
file_put_contents('/usr/local/bin/0conf', $newJsonString);

?>
<?php }?>