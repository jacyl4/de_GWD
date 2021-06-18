<?php require_once('../auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
$NFSserver = $_GET['NFSserver'];

passthru("sudo showmount -e $NFSserver | sed '1d'");
?>
<?php }?>