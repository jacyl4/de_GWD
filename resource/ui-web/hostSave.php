<?php require_once('auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
exec('sudo /usr/local/bin/ui-hostsDefault');

$hostsCustomize = $_GET['hostsCustomize'];

$hostsCustomizetxt = fopen("hostsCustomize.txt", "w");
$txt = "$hostsCustomize\n";
fwrite($hostsCustomizetxt, $txt);
fclose($hostsCustomizetxt);

exec('sudo /usr/local/bin/ui-hostSave');
?>
<?php }?>