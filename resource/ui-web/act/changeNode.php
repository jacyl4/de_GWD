<?php require_once('../auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
$nodenum = $_GET['nodenum'];
putenv("nodeNUM=$nodenum");
exec('sudo /opt/de_GWD/ui-changeNode $nodeNUM &');
?>
<?php }?>