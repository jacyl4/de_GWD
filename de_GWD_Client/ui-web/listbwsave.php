<?php require_once('auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
$listb = $_GET['listb'];
$listw = $_GET['listw'];

$listwtxt = fopen("listw.txt", "w");
$txt = "$listw\n";
fwrite($listwtxt, "");
fwrite($listwtxt, $txt);
fclose($listwtxt);

$listbtxt = fopen("listb.txt", "w");
$txt = "$listb\n";
fwrite($listbtxt, "");
fwrite($listbtxt, $txt);
fclose($listbtxt);

shell_exec('sudo systemctl restart iptables-proxy');
?>
<?php }?>