<?php require_once('../auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
$data = json_decode(file_get_contents('/opt/de_GWD/0conf'), true);
$data['v2nodeDIV']['ss'] = array();
$newJsonString = json_encode($data, JSON_PRETTY_PRINT);
file_put_contents('/opt/de_GWD/0conf', $newJsonString);

exec('sudo /opt/de_GWD/ui-changeNodeSS0 &');

$forward0 = exec('sudo [ -f /etc/nginx/conf.d/forward0.conf ] && echo installed');
if ($forward0 === installed) exec('sudo /opt/de_GWD/ui-FWD0save r &');
?>
<?php }?>