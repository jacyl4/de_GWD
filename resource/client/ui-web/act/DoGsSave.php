<?php require_once('../auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
$DoGsPort = $_GET['DoGsPort'];

$data = json_decode(file_get_contents('/opt/de_GWD/0conf'), true);
$data['FORWARD']['DoGs'] = array();
$data['FORWARD']['DoGs']['status'] = "on";
$data['FORWARD']['DoGs']['port'] = $DoGsPort;
$newJsonString = json_encode($data, JSON_PRETTY_PRINT);
file_put_contents('/opt/de_GWD/0conf', $newJsonString);

exec('sudo /opt/de_GWD/ui-DoGsSave &');
?>
<?php }?>
