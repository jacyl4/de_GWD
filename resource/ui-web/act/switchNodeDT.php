<?php require_once('../auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
$switchNodeDT = $_GET['switchNodeDT'];
$forward0 = '/etc/nginx/conf.d/forward0.conf';
$forward1 = '/etc/nginx/conf.d/forward1.conf';

if ( $switchNodeDT === "NodeDTshow"){
    shell_exec('sudo /usr/local/bin/ui-NodeDTshow');
}
elseif ( $switchNodeDT === "NodeDThide"){
    shell_exec('sudo /usr/local/bin/ui-NodeDThide');
}

if (file_exists($forward0)){
    shell_exec('sudo /usr/local/bin/ui-FWD0vtrui');
}
elseif (file_exists($forward1)){
    shell_exec('sudo /usr/local/bin/ui-FWD1vtrui');
}

shell_exec('sudo systemctl restart vtrui');
?>
<?php }?>