<?php require_once('auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
$nodedtswitch = $_GET['nodedtswitch'];

if ( $nodedtswitch === "nodedtshow"){
shell_exec('sudo /usr/local/bin/ui-nodedtshow');
}
elseif ( $nodedtswitch === "nodedthide"){
shell_exec('sudo /usr/local/bin/ui-nodedthide');
}
?>
<?php }?>