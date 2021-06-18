<?php require_once('../auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
$NFSpoint = $_GET['NFSpoint'];
exec("sudo /opt/de_GWD/ui-offNFS $NFSpoint &");
?>
<?php }?>