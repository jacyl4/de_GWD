<?php require_once('../auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
$nodenfnum = $_GET['nodenfnum'];
putenv("nodenfnum=$nodenfnum");
exec('sudo /opt/de_GWD/ui-changeNodeNF $nodenfnum &');
?>
<?php }?>