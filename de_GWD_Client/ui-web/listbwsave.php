<?php require_once('auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
$listb = $_GET['listb'];
$listw = $_GET['listw'];
$listwlan = $_GET['listwlan'];

$listbtxt = fopen("listb.txt", "w");
$txt = "$listb\n";
fwrite($listbtxt, $txt);
fclose($listbtxt);

$listwtxt = fopen("listw.txt", "w");
$txt = "$listw\n";
fwrite($listwtxt, $txt);
fclose($listwtxt);

$listwlantxt = fopen("listwlan.txt", "w");
$txt = "$listwlan\n";
fwrite($listwlantxt, $txt);
fclose($listwlantxt);

exec('sudo /usr/local/bin/ui-listbw');
exec('sudo systemctl restart iptables-proxy');
?>
<?php }?>