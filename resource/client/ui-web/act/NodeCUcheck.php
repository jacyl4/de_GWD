<?php require_once('../auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
passthru('sudo /opt/de_GWD/ui-NodeCUcheck &');
?>
<?php }?>