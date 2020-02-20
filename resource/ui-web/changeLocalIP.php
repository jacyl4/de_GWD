<?php require_once('auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
$localip = $_GET['localip'];

$data = json_decode(file_get_contents('/usr/local/bin/0conf'), true);
$arr = explode(" ",$localip);
$arr = array_filter($arr);
$data['divertLan'] = $arr;
$newJsonString = json_encode($data, JSON_PRETTY_PRINT);
file_put_contents('/usr/local/bin/0conf', $newJsonString);

shell_exec('sudo /usr/local/bin/ui-changeLocalIP');
?>
<?php }?>