<?php require_once('auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
$updateAddr = $_GET['updateAddr'];

$data = json_decode(file_get_contents('/usr/local/bin/0conf'), true);
$data['updateAddr'] = $updateAddr;
$newJsonString = json_encode($data, JSON_PRETTY_PRINT);
file_put_contents('/usr/local/bin/0conf', $newJsonString);

exec('sudo /usr/local/bin/ui-updatePre');
exec('sudo /usr/local/bin/ui-update');
?>
<?php }?>