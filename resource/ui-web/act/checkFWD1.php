<?php require_once('../auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
$forward1 = '/etc/nginx/conf.d/forward1.conf';

if (file_exists($forward1)){
    echo "installed";
}
?>
<?php }?>