<?php require_once('../auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
$switchNodeDT = $_GET['switchNodeDT'];
$forward0 = exec('sudo [ -f /etc/nginx/conf.d/forward0.conf ] && echo installed');

if ($switchNodeDT === NodeDTshow){
    shell_exec('sudo /opt/de_GWD/ui-NodeDTshow');
};
elseif ( $switchNodeDT === "NodeDThide"){
    shell_exec('sudo /opt/de_GWD/ui-NodeDThide');
};

if ($forward0 == installed) shell_exec('sudo /opt/de_GWD/ui-FWD0vtrui');

shell_exec('sudo systemctl restart vtrui');
?>
<?php }?>