<?php require_once('../auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
$updateCMD = $_GET['updateCMD'];

$conf = json_decode(file_get_contents('/opt/de_GWD/0conf'), true);
$conf['updateCMD'] = $updateCMD;
$newJsonString = json_encode($conf, JSON_PRETTY_PRINT);
file_put_contents('/opt/de_GWD/0conf', $newJsonString);

$updateURL = strpos($updateCMD,"https");
$updateURL = substr($updateCMD, $updateURL);
$updateURL = substr($updateURL, 0, strlen($updateURL)-1);

shell_exec("sudo wget --no-check-certificate -O /opt/de_GWD/update $updateURL");
shell_exec('sudo chmod +x /opt/de_GWD/update');
shell_exec('sudo systemctl start updateGWD');
?>
<?php }?>