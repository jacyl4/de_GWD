<?php require_once('auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
$wanIP = $_GET['wanIP'];
$CFdomain = $_GET['CFdomain'];
$CFzoneid = $_GET['CFzoneid'];
$CFapikey = $_GET['CFapikey'];
$CFemail = $_GET['CFemail'];

$ddnstxt = fopen("ddns.txt", "w");
$txt = "$wanIP\n";
fwrite($ddnstxt, $txt);
$txt = "$CFdomain\n";
fwrite($ddnstxt, $txt);
$txt = "$CFzoneid\n";
fwrite($ddnstxt, $txt);
$txt = "$CFapikey\n";
fwrite($ddnstxt, $txt);
$txt = "$CFemail\n";
fwrite($ddnstxt, $txt);
fclose($ddnstxt);

$CFdomainid = exec('sudo /usr/local/bin/ui-ddnsgetdomainid');

$ddnstxt = fopen("ddns.txt", "a");
$txt = "$CFdomainid";
fwrite($ddnstxt, $txt);
fclose($ddnstxt);

exec('sudo /usr/local/bin/ui-ddnsupdateip');
exec('sudo /usr/local/bin/ui-ddnsupdateon');
?>
<?php }?>