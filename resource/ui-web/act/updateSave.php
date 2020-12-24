<?php require_once('../auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
$updateCMD = $_GET['updateCMD'];
$updateAddr = $_GET['updateAddr'];
$updatePort = $_GET['updatePort'];

$conf = json_decode(file_get_contents('/opt/de_GWD/0conf'), true);
$conf['update']['updateCMD'] = $updateCMD;
$conf['update']['updateAddr'] = $updateAddr;
$conf['update']['updatePort'] = $updatePort;
$newJsonString = json_encode($conf, JSON_PRETTY_PRINT);
file_put_contents('/opt/de_GWD/0conf', $newJsonString);
?>
<?php }?>