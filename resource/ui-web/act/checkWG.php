<?php require_once('../auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
$ddnsCF = exec('sudo /usr/local/bin/ui-checkWG');

if ( $ddnsCF == success ){
    echo "installed";
}
?>
<?php }?>