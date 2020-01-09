<?php require_once('auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
$WGaddress = $_GET['WGaddress'];
$WGaddressport = $_GET['WGaddressport'];

$WGaddresstxt = fopen("WGaddress.txt", "w");
$txt = "$WGaddress\n";
fwrite($WGaddresstxt, $txt);
$txt = "$WGaddressport\n";
fwrite($WGaddresstxt, $txt);
fclose($WGaddresstxt);

shell_exec('sudo /usr/local/bin/ui-wgup');
?>
<?php }?>