<?php require_once('../auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
$nodedtnum = $_GET['nodedtnum'];
putenv("nodedtnum=$nodedtnum");
exec('sudo /opt/de_GWD/ui-changeNodeDT $nodedtnum &');
?>
<?php }?>