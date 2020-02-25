<?php require_once('auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
$switchNodeDT = $_GET['switchNodeDT'];

if ( $switchNodeDT === "NodeDTshow"){
exec('sudo /usr/local/bin/ui-NodeDTshow');
}
elseif ( $switchNodeDT === "NodeDThide"){
exec('sudo /usr/local/bin/ui-NodeDThide');
}

exec('sudo systemctl restart iptables-proxy');
?>
<?php }?>