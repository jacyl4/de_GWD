<?php require_once('../auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
$nodenfnum = $_GET['nodenfnum'];

$nodenfpre = fopen("nodenfpre.txt", "w");
fwrite($nodenfpre, $nodenfnum);
fclose($nodenfpre);

exec('sudo /opt/de_GWD/ui-changeNodeNF r');
?>
<?php }?>