<?php require_once('../auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
$nodeDTnum = $_GET['nodeDTnum'];
exec("sudo /opt/de_GWD/ui-changeNodeDT $nodeDTnum &");
?>
<?php }?>