<?php require_once('../auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
$autoUpdateHourINDEX = $_GET['autoUpdateHourINDEX'];

$data = json_decode(file_get_contents('/opt/de_GWD/0conf'), true);
$data['address']['autoUpdateHour'] = $autoUpdateHourINDEX;
$newJsonString = json_encode($data, JSON_PRETTY_PRINT);
file_put_contents('/opt/de_GWD/0conf', $newJsonString);

exec("sudo /opt/de_GWD/ui-autoUpdateHour $autoUpdateHourINDEX &");
?>
<?php }?>
