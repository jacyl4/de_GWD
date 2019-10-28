<?php require_once('auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
$WGdomain = $_GET['WGdomain'];

$wgdomaintxt = fopen("wgdomain.txt", "w");
$txt = "$WGdomain\n";
fwrite($wgdomaintxt, $txt);
fclose($wgdomaintxt);

exec('sudo /usr/local/bin/ui-wgup');
?>
<?php }?>