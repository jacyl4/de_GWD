<?php require_once('auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
$updateCMD = $_GET['updateCMD'];

$data = json_decode(file_get_contents('/usr/local/bin/0conf'), true);
$data['updateCMD'] = $updateCMD;
$newJsonString = json_encode($data, JSON_PRETTY_PRINT);
file_put_contents('/usr/local/bin/0conf', $newJsonString);

shell_exec('sudo /usr/local/bin/ui-updateGEN');
shell_exec('sudo systemctl start updateGWD');
?>
<?php }?>