<?php require_once('../auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
$conf = json_decode(file_get_contents('/opt/de_GWD/0conf'), true);
$CFdomain = $_GET['CFdomain'];
$CFapikey = $_GET['CFapikey'];
$CFemail = $_GET['CFemail'];

$conf['FORWARD']['domain'] = $CFdomain;
$conf['FORWARD']['APIkey'] = $CFapikey;
$conf['FORWARD']['Email'] = $CFemail;
$newJsonString = json_encode($conf, JSON_PRETTY_PRINT);
file_put_contents('/opt/de_GWD/0conf', $newJsonString);

exec('sudo nohup /usr/bin/ttyd -p 3000 -o /opt/de_GWD/ui-installCER &');
?>
<?php }?>