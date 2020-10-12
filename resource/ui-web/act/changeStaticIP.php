<?php require_once('../auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
$localip = $_GET['localip'];
$upstreamip = $_GET['upstreamip'];

$data = json_decode(file_get_contents('/usr/local/bin/0conf'), true);
$data['address']['localIP'] = $localip;
$data['address']['upstreamIP'] = $upstreamip;
$newJsonString = json_encode($data, JSON_PRETTY_PRINT);
file_put_contents('/usr/local/bin/0conf', $newJsonString);

shell_exec('sudo /usr/local/bin/ui-changeStaticIP');
?>
<?php }?>