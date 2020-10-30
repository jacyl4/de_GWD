<?php require_once('../auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
$conf = json_decode(file_get_contents('/opt/de_GWD/0conf'), true);
$localip = $_GET['localip'];

$localip = explode(" ",$localip);
$localip = array_filter($localip);
$conf['divertLan']['ip'] = $localip;
$newJsonString = json_encode($conf, JSON_PRETTY_PRINT);
file_put_contents('/opt/de_GWD/0conf', $newJsonString);

shell_exec('sudo /opt/de_GWD/ui-changeDivertIP');
shell_exec('sudo systemctl restart vtrui');
?>
<?php }?>