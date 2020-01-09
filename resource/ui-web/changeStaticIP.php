<?php require_once('auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
$localip = $_GET['localip'];
$upstreamip = $_GET['upstreamip'];

$staticIP = fopen("staticIP.txt", "w");
$txt = "$localip\n";
fwrite($staticIP, $txt);
$txt = "$upstreamip\n";
fwrite($staticIP, $txt);
fclose($staticIP);

shell_exec('sudo /usr/local/bin/ui-changeStaticIP');
?>
<?php }?>