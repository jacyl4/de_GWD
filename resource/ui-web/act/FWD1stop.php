<?php require_once('../auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
shell_exec('sudo rm -rf /etc/nginx/conf.d/forward1.conf');
shell_exec('sudo systemctl disable --now vtrui1');
shell_exec('sudo rm -rf /usr/local/bin/vtrui1');
shell_exec('sudo systemctl daemon-reload');

$data = json_decode(file_get_contents('/usr/local/bin/0conf'), true);
$data['FORWARD']['FWD1']['status'] = "off";
$newJsonString = json_encode($data, JSON_PRETTY_PRINT);
file_put_contents('/usr/local/bin/0conf', $newJsonString);

shell_exec('sudo /etc/nginx/conf.d/merge.sh');
?>
<?php }?>
