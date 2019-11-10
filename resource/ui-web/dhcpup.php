<?php require_once('auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
$ipstart = $_GET['ipstart'];
$ipend = $_GET['ipend'];

$dhcptxt = fopen("dhcp.txt", "w");
$txt = "$ipstart\n";
fwrite($dhcptxt, $txt);
$txt = "$ipend\n";
fwrite($dhcptxt, $txt);
fclose($dhcptxt);

shell_exec("sudo /usr/local/bin/ui-dhcpup");
?>
<?php }?>