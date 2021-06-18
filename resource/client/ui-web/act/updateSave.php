<?php require_once('../auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
$updateAddr = $_GET['updateAddr'];
$updatePort = $_GET['updatePort'];
$updateCMD = $_GET['updateCMD'];

$conf = json_decode(file_get_contents('/opt/de_GWD/0conf'), true);
$conf['update']['updateAddr'] = $updateAddr;
$conf['update']['updatePort'] = $updatePort;
$conf['update']['updateCMD'] = $updateCMD;
$newJsonString = json_encode($conf, JSON_PRETTY_PRINT);
file_put_contents('/opt/de_GWD/0conf', $newJsonString);


$updateURL = strpos($updateCMD,"https");
$updateURL = substr($updateCMD, $updateURL);
$updateURL = substr($updateURL, 0, strlen($updateURL)-1);

exec("sudo curl -fsSL -o /opt/de_GWD/update $updateURL &");


if(filter_var($updateAddr, FILTER_VALIDATE_IP)) {
} else {
$updateAddr = gethostbyname($updateAddr);
}

echo "$updateAddr:$updatePort";
?>
<?php }?>