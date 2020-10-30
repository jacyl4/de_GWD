<?php require_once('../auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
$filename = '/opt/de_GWD/frp/frpc';

if (file_exists($filename)) {
    echo "installed";
}
?>
<?php }?>