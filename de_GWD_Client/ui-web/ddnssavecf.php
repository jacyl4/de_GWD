<?php require_once('auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
$CFdomain = $_GET['CFdomain'];
$CFzoneid = $_GET['CFzoneid'];
$CFapikey = $_GET['CFapikey'];
$CFemail = $_GET['CFemail'];

$ddnstxt = fopen("ddnscf.txt", "w");
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

$ddnstxt = fopen("ddnscf.txt", "a");
$txt = "$CFdomainid";
fwrite($ddnstxt, $txt);
fclose($ddnstxt);

exec('sudo /usr/local/bin/ui-ddnsupdateipcf');
exec('sudo /usr/local/bin/ui-ddnsupdateoncf');
?>
<?php }?>