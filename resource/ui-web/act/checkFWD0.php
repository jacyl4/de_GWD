<?php require_once('../auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
$forward0 = '/etc/nginx/conf.d/forward0.conf';

if (file_exists($forward0)){
    echo "installed";
}
?>
<?php }?>