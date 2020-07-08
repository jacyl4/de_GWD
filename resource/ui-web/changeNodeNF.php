<?php require_once('auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
$nodenfnum = $_GET['nodenfnum'];

$nodenfpre = fopen("nodenfpre.txt", "w");
fwrite($nodenfpre, $nodenfnum);
fclose($nodenfpre);

shell_exec('sudo /usr/local/bin/ui-changeNodeNF');
shell_exec('sudo systemctl restart vtrui');
?>
<?php }?>