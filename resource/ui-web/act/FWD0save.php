<?php require_once('../auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
$portCheck1 = $_GET['portCheck1'];
$FWD0port = $_GET['FWD0port'];
$FWD0uuid = $_GET['FWD0uuid'];

$FWD0uuid = explode("\n",$FWD0uuid);
$FWD0uuid = array_filter(array_map('trim', $FWD0uuid));

$data = json_decode(file_get_contents('/opt/de_GWD/0conf'), true);
$data['FORWARD']['PortCheck1'] = $portCheck1;
$data['FORWARD']['FWD0'] = array();
$data['FORWARD']['FWD0']['status'] = "on";
$data['FORWARD']['FWD0']['port'] = $FWD0port;
$data['FORWARD']['FWD0']['uuid'] = $FWD0uuid;
$newJsonString = json_encode($data, JSON_PRETTY_PRINT);
file_put_contents('/opt/de_GWD/0conf', $newJsonString);

exec('sudo /opt/de_GWD/ui-FWD0save r &');
?>
<?php }?>
