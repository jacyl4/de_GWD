<?php require_once('auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
$localip = $_GET['localip'];

$localiptxt = fopen("localip.txt", "w");
$txt = "$localip\n";
fwrite($localiptxt, $txt);
fclose($localiptxt);

shell_exec('sudo /usr/local/bin/ui-changelocalip');
?>
<?php }?>