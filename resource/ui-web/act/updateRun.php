<?php require_once('../auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
$updateCMD = json_decode(file_get_contents('/opt/de_GWD/0conf'))->update->updateCMD;

$updateURL = strpos($updateCMD,"https");
$updateURL = substr($updateCMD, $updateURL);
$updateURL = substr($updateURL, 0, strlen($updateURL)-1);

shell_exec("sudo wget --no-check-certificate -O /opt/de_GWD/update $updateURL");
shell_exec('sudo chmod +x /opt/de_GWD/update');
shell_exec('sudo systemctl start updateGWD');
?>
<?php }?>