<?php require_once('../auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
$cer = '/var/www/ssl/ocsp.resp';

if (file_exists($cer)){
    echo "installed";
}
?>
<?php }?>