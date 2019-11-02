<?php require_once('auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
$hostsdefault = $_GET['hostsdefault'];
$hostscustomize = $_GET['hostscustomize'];

$hostsdefaulttxt = fopen("hostsdefault.txt", "w");
$txt = "$hostsdefault\n";
fwrite($hostsdefaulttxt, $txt);
fclose($hostsdefaulttxt);

$hostscustomizetxt = fopen("hostscustomize.txt", "w");
$txt = "$hostscustomize\n";
fwrite($hostscustomizetxt, $txt);
fclose($hostscustomizetxt);

exec('sudo /usr/local/bin/ui-hostssave');
?>
<?php }?>