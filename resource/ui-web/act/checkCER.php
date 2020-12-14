<?php require_once('../auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
$filePath = exec('sudo [ -f /var/www/ssl/ocsp.resp ] && echo installed');

if ($filePath == installed) echo 'installed';
?>
<?php }?>