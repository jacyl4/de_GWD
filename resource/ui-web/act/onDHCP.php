<?php require_once('../auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
$conf = json_decode(file_get_contents('/usr/local/bin/0conf'), true);
$dhcpStart = $_GET['dhcpStart'];
$dhcpEnd = $_GET['dhcpEnd'];

$conf['address']['dhcpStart'] = $dhcpStart;
$conf['address']['dhcpEnd'] = $dhcpEnd;
$newJsonString = json_encode($conf, JSON_PRETTY_PRINT);
file_put_contents('/usr/local/bin/0conf', $newJsonString);

shell_exec("sudo /usr/local/bin/ui-onDHCP");
?>
<?php }?>