<?php require_once('../auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
shell_exec('sudo rm -rf /etc/nginx/conf.d/forward0.conf');
shell_exec('sudo jq "del(.inbounds[1])" /opt/de_GWD/vtrui/config.json | sponge /opt/de_GWD/vtrui/config.json');
shell_exec('sudo systemctl restart vtrui');

$data = json_decode(file_get_contents('/opt/de_GWD/0conf'), true);
$data['FORWARD']['FWD0']['status'] = "off";
$newJsonString = json_encode($data, JSON_PRETTY_PRINT);
file_put_contents('/opt/de_GWD/0conf', $newJsonString);

shell_exec('sudo /etc/nginx/conf.d/merge.sh');
?>
<?php }?>
