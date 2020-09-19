<?php require_once('../auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
$portCheck1 = $_GET['portCheck1'];
$FWD0port = $_GET['FWD0port'];
$FWD0path = $_GET['FWD0path'];
$FWD0uuid = $_GET['FWD0uuid'];

$FWD0uuid = explode("\n",$FWD0uuid);
$FWD0uuid = array_filter($FWD0uuid);

$data = json_decode(file_get_contents('/usr/local/bin/0conf'), true);
$data['FORWARD']['PortCheck1'] = $portCheck1;
$data['FORWARD']['FWD0']['port'] = $FWD0port;
$data['FORWARD']['FWD0']['path'] = $FWD0path;
$data['FORWARD']['FWD0']['uuid'] = $FWD0uuid;
$newJsonString = json_encode($data, JSON_PRETTY_PRINT);
file_put_contents('/usr/local/bin/0conf', $newJsonString);

shell_exec('sudo /usr/local/bin/ui-FWD0save');
shell_exec('sudo /usr/local/bin/ui-FWD0vtrui');

shell_exec('sudo systemctl restart vtrui');
shell_exec('sudo systemctl restart iptables-proxy');
?>
<?php }?>
