<?php require_once('../auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
$NFSpoint = $_GET['NFSpoint'];

shell_exec("sudo umount /mnt/$NFSpoint");

shell_exec("sudo rm -rf /mnt/$NFSpoint");
?>
<?php }?>