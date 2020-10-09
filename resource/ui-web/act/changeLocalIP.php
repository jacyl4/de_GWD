<?php require_once('../auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
$conf = json_decode(file_get_contents('/usr/local/bin/0conf'), true);
$localip = $_GET['localip'];

$localip = explode(" ",$localip);
$localip = array_filter($localip);
$conf['divertLan']['ip'] = $localip;
$newJsonString = json_encode($conf, JSON_PRETTY_PRINT);
file_put_contents('/usr/local/bin/0conf', $newJsonString);

shell_exec('sudo /usr/local/bin/ui-changeDivertIP');
shell_exec('sudo systemctl restart vtrui');
?>
<?php }?>