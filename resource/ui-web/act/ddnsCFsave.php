<?php require_once('../auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
$conf = json_decode(file_get_contents('/usr/local/bin/0conf'), true);
$CFdomain = $_GET['CFdomain'];
$CFzoneid = $_GET['CFzoneid'];
$CFapikey = $_GET['CFapikey'];
$CFemail = $_GET['CFemail'];

$conf['ddns']['ddnsCF']['cfDomain'] = $CFdomain;
$conf['ddns']['ddnsCF']['cfZoneID'] = $CFzoneid;
$conf['ddns']['ddnsCF']['cfAPIkey'] = $CFapikey;
$conf['ddns']['ddnsCF']['cfEmail'] = $CFemail;
$newJsonString = json_encode($conf, JSON_PRETTY_PRINT);
file_put_contents('/usr/local/bin/0conf', $newJsonString);

shell_exec('sudo /usr/local/bin/ui-ddnsCFgetDomainID');
shell_exec('sudo /usr/local/bin/ui-ddnsCFupdateIP');
shell_exec('sudo /usr/local/bin/ui-ddnsCFupdateOn');
?>
<?php }?>