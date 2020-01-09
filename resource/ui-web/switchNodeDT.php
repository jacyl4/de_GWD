<?php require_once('auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
$switchNodeDT = $_GET['switchNodeDT'];

if ( $switchNodeDT === "NodeDTshow"){
shell_exec('sudo /usr/local/bin/ui-NodeDTshow');
}
elseif ( $switchNodeDT === "NodeDThide"){
shell_exec('sudo /usr/local/bin/ui-NodeDThide');
}
?>
<?php }?>