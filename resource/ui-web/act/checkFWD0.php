<?php require_once('../auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
$filePath = exec('sudo [ -f /etc/nginx/conf.d/forward0.conf ] && echo installed');

if ($filePath == installed) echo 'installed';
?>
<?php }?>