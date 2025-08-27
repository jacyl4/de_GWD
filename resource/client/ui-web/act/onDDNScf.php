<?php require_once('../auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
$conf = json_decode(file_get_contents('/opt/de_GWD/0conf'), true);
$CFdomain = $_GET['CFdomain'];
$CFapikey = $_GET['CFapikey'];
$CFemail = $_GET['CFemail'];

$conf['ddns']['ddnsCF']['cfDomain'] = $CFdomain;
$conf['ddns']['ddnsCF']['cfAPIkey'] = $CFapikey;
$conf['ddns']['ddnsCF']['cfEmail'] = $CFemail;
$newJsonString = json_encode($conf, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
file_put_contents('/opt/de_GWD/0conf', $newJsonString);

exec('sudo /opt/de_GWD/ui-ddnsCFon &');
?>
<?php }?>