<?php require_once('../auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
$dhcpStart = $_GET['dhcpStart'];
$dhcpEnd = $_GET['dhcpEnd'];

$data = json_decode(file_get_contents('/usr/local/bin/0conf'), true);
$data['address']['dhcpStart'] = $dhcpStart;
$data['address']['dhcpEnd'] = $dhcpEnd;
$newJsonString = json_encode($data, JSON_PRETTY_PRINT);
file_put_contents('/usr/local/bin/0conf', $newJsonString);

shell_exec("sudo /usr/local/bin/ui-onDHCP");
?>
<?php }?>