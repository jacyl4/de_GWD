<?php require_once('../auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
exec('sudo rm -rf /var/www/html/restore/Bitwarden_bak.zip; sudo zip -r /var/www/html/restore/Bitwarden_bak.zip /opt/bitwarden -x "/opt/bitwarden/icon_cache/*" &');
?>
<?php }?>