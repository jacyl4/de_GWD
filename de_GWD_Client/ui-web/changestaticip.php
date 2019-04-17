<?php require_once('auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
$localip = $_GET['localip'];
$upstreamip = $_GET['upstreamip'];

$staticip = fopen("staticip.txt", "w");
$txt = "$localip\n";
fwrite($staticip, $txt);
$txt = "$upstreamip\n";
fwrite($staticip, $txt);
fclose($staticip);

system('sudo /usr/local/bin/ui-changestaticip');
?>
<?php }?>