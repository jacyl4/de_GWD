<?php require_once('../auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
$FWD0port = $_GET['FWD0port'];
$FWD0path = $_GET['FWD0path'];
$FWD0uuid = $_GET['FWD0uuid'];

$FWD0uuid = explode("\n",$FWD0uuid);
$FWD0uuid = array_filter($FWD0uuid);

$data = json_decode(file_get_contents('/usr/local/bin/0conf'), true);
$data['FORWARD']['FWD0']['port'] = $FWD0port;
$data['FORWARD']['FWD0']['path'] = $FWD0path;
$data['FORWARD']['FWD0']['uuid'] = $FWD0uuid;
$newJsonString = json_encode($data, JSON_PRETTY_PRINT);
file_put_contents('/usr/local/bin/0conf', $newJsonString);

shell_exec('sudo /usr/local/bin/ui-FWD0save');
shell_exec('sudo /usr/local/bin/ui-FWD0vtrui');

shell_exec('sudo systemctl restart vtrui');

$nginx = "/lib/systemd/system/nginx.service";
$docker = "/lib/systemd/system/docker.service";

if (file_exists($nginx)) {
    shell_exec('sudo systemctl reload nginx');
}
elseif (file_exists($docker)) {
    shell_exec('sudo docker exec -it nginx nginx -s reload');
}
?>
<?php }?>
