<?php require_once('auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
$listb = $_GET['listb'];
$listw = $_GET['listw'];
$listwlan = $_GET['listwlan'];

$listbtxt = fopen("listb.txt", "w");
$txt = "$listb";
fwrite($listbtxt, $txt);
fclose($listbtxt);

$listwtxt = fopen("listw.txt", "w");
$txt = "$listw";
fwrite($listwtxt, $txt);
fclose($listwtxt);

$listwlantxt = fopen("listwlan.txt", "w");
$txt = "$listwlan";
fwrite($listwlantxt, $txt);
fclose($listwlantxt);

exec('sudo /usr/local/bin/ui-listbw');
exec('sudo systemctl restart iptables-proxy');
?>
<?php }?>