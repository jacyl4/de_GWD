<?php require_once('../auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
$RproxyStunnelPort = $_GET['RproxyStunnelPort'];
$RproxyStunnelUUID = $_GET['RproxyStunnelUUID'];
$RproxySinUUID = $_GET['RproxySinUUID'];
$RproxySinStatus = $_GET['RproxySinStatus'];
$RproxySmappingStatus = $_GET['RproxySmappingStatus'];
$RproxyS1List = $_GET['RproxyS1List'];

$RproxySinUUID = explode("\n",$RproxySinUUID);
$RproxySinUUID = array_filter(array_map('trim', $RproxySinUUID));

$data = json_decode(file_get_contents('/opt/de_GWD/0conf'), true);
$data['FORWARD']['Rproxy']['server'] = array();
$data['FORWARD']['Rproxy']['server']['status'] = "on";
if ($RproxySinStatus === block) $data['FORWARD']['Rproxy']['server']['inStatus'] = "on";
if ($RproxySmappingStatus === block) $data['FORWARD']['Rproxy']['server']['mappingStatus'] = "on";
$data['FORWARD']['Rproxy']['server']['tunnel']['port'] = $RproxyStunnelPort;
$data['FORWARD']['Rproxy']['server']['tunnel']['uuid'] = $RproxyStunnelUUID;
$data['FORWARD']['Rproxy']['server']['in']['uuid'] = $RproxySinUUID;
$data['FORWARD']['Rproxy']['server']['mapping'] = $RproxyS1List;
$newJsonString = json_encode($data, JSON_PRETTY_PRINT);
file_put_contents('/opt/de_GWD/0conf', $newJsonString);

exec('sudo /opt/de_GWD/ui-RproxySsave &');
?>
<?php }?>
