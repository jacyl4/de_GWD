<?php require_once('../auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
$nodeNFnum = $_GET['nodeNFnum'];
exec("sudo /opt/de_GWD/ui-changeNodeNF $nodeNFnum &");
?>
<?php }?>