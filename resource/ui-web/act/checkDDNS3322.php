<?php require_once('../auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
$ddnsCF = exec('sudo /usr/local/bin/ui-checkDDNS3322');

if ( $ddnsCF == success ){
    echo "installed";
}
?>
<?php }?>