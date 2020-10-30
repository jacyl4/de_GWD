<?php require_once('../auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
$switchNodeDT = $_GET['switchNodeDT'];
$forward0 = '/etc/nginx/conf.d/forward0.conf';
$forward1 = '/etc/nginx/conf.d/forward1.conf';

if ( $switchNodeDT === "NodeDTshow" ){
    shell_exec('sudo /opt/de_GWD/ui-NodeDTshow');
}
elseif ( $switchNodeDT === "NodeDThide"){
    shell_exec('sudo /opt/de_GWD/ui-NodeDThide');
}

if (file_exists($forward0)){
    shell_exec('sudo /opt/de_GWD/ui-FWD0vtrui');
}
elseif (file_exists($forward1)){
    shell_exec('sudo /opt/de_GWD/ui-FWD1vtrui');
}

shell_exec('sudo systemctl restart vtrui');
?>
<?php }?>