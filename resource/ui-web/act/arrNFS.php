<?php require_once('../auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
system("sudo nfsstat -m | sed '/Flags/d' | sed '/^\s*$/d'");
?>
<?php }?>
