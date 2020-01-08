<?php require_once('auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
exec('sudo /usr/local/bin/ui-hostsdefault');

$hostscustomize = $_GET['hostscustomize'];

$hostscustomizetxt = fopen("hostscustomize.txt", "w");
$txt = "$hostscustomize\n";
fwrite($hostscustomizetxt, $txt);
fclose($hostscustomizetxt);

exec('sudo /usr/local/bin/ui-hostSave');
?>
<?php }?>