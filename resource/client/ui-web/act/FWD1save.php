<?php require_once('../auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
$v2nodeID = $_GET['v2nodeID'];
$FWD1port = $_GET['FWD1port'];
$FWD1uuid = $_GET['FWD1uuid'];

$FWD1uuid = explode("\n",$FWD1uuid);
$FWD1uuid = array_filter(array_map('trim', $FWD1uuid));

$data = json_decode(file_get_contents('/opt/de_GWD/0conf'), true);
$data['FORWARD']['FWD1'] = array();
$data['FORWARD']['FWD1']['upstream'] = $v2nodeID;
$data['FORWARD']['FWD1']['status'] = "on";
$data['FORWARD']['FWD1']['port'] = $FWD1port;
$data['FORWARD']['FWD1']['uuid'] = $FWD1uuid;
$newJsonString = json_encode($data, JSON_PRETTY_PRINT);
file_put_contents('/opt/de_GWD/0conf', $newJsonString);

exec('sudo /opt/de_GWD/ui-FWD1save &');
?>
<?php }?>
