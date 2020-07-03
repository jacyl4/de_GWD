<?php require_once('auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
$filename = '/usr/local/bin/frp/frpc';

if (file_exists($filename)) {
    echo "installed";
}
?>
<?php }?>