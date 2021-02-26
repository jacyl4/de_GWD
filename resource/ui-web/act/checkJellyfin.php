<?php require_once('../auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
passthru('sudo [ -f /usr/bin/jellyfin ] && echo installed');
?>
<?php }?>