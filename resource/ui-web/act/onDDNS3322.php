<?php require_once('../auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
$conf = json_decode(file_get_contents('/opt/de_GWD/0conf'), true);
$f3322domain = $_GET['f3322domain'];
$f3322usr = $_GET['f3322usr'];
$f3322pwd = $_GET['f3322pwd'];

$conf['ddns']['ddns3322']['domain'] = $f3322domain;
$conf['ddns']['ddns3322']['user'] = $f3322usr;
$conf['ddns']['ddns3322']['pwd'] = $f3322pwd;
$newJsonString = json_encode($conf, JSON_PRETTY_PRINT);
file_put_contents('/opt/de_GWD/0conf', $newJsonString);

exec('sudo /opt/de_GWD/ui-ddns3322on &');
?>
<?php }?>