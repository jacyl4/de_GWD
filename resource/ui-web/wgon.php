<?php require_once('auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
$WGaddress = $_GET['WGaddress'];

$WGaddresstxt = fopen("WGaddress.txt", "w");
$txt = "$WGaddress\n";
fwrite($WGaddresstxt, $txt);
fclose($WGaddresstxt);

exec('sudo /usr/local/bin/ui-wgup');
?>
<?php }?>