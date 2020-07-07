<?php require_once('auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
$CFdomain = $_GET['CFdomain'];
$CFzoneid = $_GET['CFzoneid'];
$CFapikey = $_GET['CFapikey'];
$CFemail = $_GET['CFemail'];

$data = json_decode(file_get_contents('/usr/local/bin/0conf'), true);
$data['ddns']['ddnsCF']['cfDomain'] = $CFdomain;
$data['ddns']['ddnsCF']['cfZoneID'] = $CFzoneid;
$data['ddns']['ddnsCF']['cfAPIkey'] = $CFapikey;
$data['ddns']['ddnsCF']['cfEmail'] = $CFemail;
$newJsonString = json_encode($data, JSON_PRETTY_PRINT);
file_put_contents('/usr/local/bin/0conf', $newJsonString);

$CFdomainid = shell_exec('sudo /usr/local/bin/ui-ddnsCFgetDomainID');

shell_exec('sudo /usr/local/bin/ui-ddnsUpdateIPCF');
shell_exec('sudo /usr/local/bin/ui-ddnsUpdateOnCF');
?>
<?php }?>