<?php require_once('../auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
$v2nodeID = $_GET['v2nodeID'];
$FWD1port = $_GET['FWD1port'];
$FWD1path = $_GET['FWD1path'];
$FWD1uuid = $_GET['FWD1uuid'];

$FWD1uuid = explode("\n",$FWD1uuid);
$FWD1uuid = array_filter($FWD1uuid);

$data = json_decode(file_get_contents('/usr/local/bin/0conf'), true);
$data['FORWARD']['FWD1']['upstream'] = $v2nodeID;
$data['FORWARD']['FWD1']['port'] = $FWD1port;
$data['FORWARD']['FWD1']['path'] = $FWD1path;
$data['FORWARD']['FWD1']['uuid'] = $FWD1uuid;
$newJsonString = json_encode($data, JSON_PRETTY_PRINT);
file_put_contents('/usr/local/bin/0conf', $newJsonString);

shell_exec('sudo /usr/local/bin/ui-FWD1save');
shell_exec('sudo /usr/local/bin/ui-FWD1vtrui');

shell_exec('sudo systemctl restart vtrui1');
?>
<?php }?>
