<?php require_once('../auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
$RproxyCtunnelAddress = $_GET['RproxyCtunnelAddress'];
$RproxyCtunnelUUID = $_GET['RproxyCtunnelUUID'];
$RproxyCoutStatus = $_GET['RproxyCoutStatus'];
$RproxyCmappingStatus = $_GET['RproxyCmappingStatus'];
$RproxyC1List = $_GET['RproxyC1List'];

$data = json_decode(file_get_contents('/opt/de_GWD/0conf'), true);
$data['FORWARD']['Rproxy']['client'] = array();
$data['FORWARD']['Rproxy']['client']['status'] = "on";
if ($RproxyCoutStatus === block) $data['FORWARD']['Rproxy']['client']['outStatus'] = "on";
if ($RproxyCmappingStatus === block) $data['FORWARD']['Rproxy']['client']['mappingStatus'] = "on";
$data['FORWARD']['Rproxy']['client']['tunnel']['address'] = $RproxyCtunnelAddress;
$data['FORWARD']['Rproxy']['client']['tunnel']['uuid'] = $RproxyCtunnelUUID;
$data['FORWARD']['Rproxy']['client']['mapping'] = $RproxyC1List;
$newJsonString = json_encode($data, JSON_PRETTY_PRINT);
file_put_contents('/opt/de_GWD/0conf', $newJsonString);

exec('sudo /opt/de_GWD/ui-RproxyCsave &');
?>
<?php }?>
