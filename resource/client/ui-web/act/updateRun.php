<?php require_once('../auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
exec('sudo systemctl start updateGWD &');
?>
<?php }?>