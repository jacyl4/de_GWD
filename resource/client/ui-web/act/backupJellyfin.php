<?php require_once('../auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
exec('sudo rm -rf /var/www/html/restore/Jellyfin_bak.zip; sudo zip -r /var/www/html/restore/Jellyfin_bak.zip /opt/jellyfin/config &');
?>
<?php }?>