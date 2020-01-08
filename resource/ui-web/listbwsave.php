<?php require_once('auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
$listB = $_GET['listB'];
$listW = $_GET['listW'];
$listWlan = $_GET['listWlan'];

$listBtxt = fopen("listB.txt", "w");
$txt = "$listB\n";
fwrite($listBtxt, $txt);
fclose($listBtxt);

$listWtxt = fopen("listW.txt", "w");
$txt = "$listW\n";
fwrite($listWtxt, $txt);
fclose($listWtxt);

$listWlantxt = fopen("listWlan.txt", "w");
$txt = "$listWlan\n";
fwrite($listWlantxt, $txt);
fclose($listWlantxt);

exec('sudo /usr/local/bin/ui-listBW');
exec('sudo /usr/local/bin/ui-listBWresolve');
exec('sudo systemctl restart iptables-proxy');
?>
<?php }?>