<?php require_once('../auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
$conf = json_decode(file_get_contents('/opt/de_GWD/0conf'), true);
$nodeList = $_GET['nodeList'];

if ( $conf['dns']['DNSsplit'] === "gfw" ){
	shell_exec('sudo /opt/de_GWD/ui-dnsGFW');
} else {
	shell_exec('sudo /opt/de_GWD/ui-dnsCHNW');
}

if ( $conf['dns']['APPLEdir'] === "on" ){
	shell_exec('sudo /opt/de_GWD/ui-onAPPLE');
} else {
	shell_exec('sudo /opt/de_GWD/ui-offAPPLE');
}

$conf['v2node'] = $nodeList;
$newJsonString = json_encode($conf, JSON_PRETTY_PRINT);
file_put_contents('/opt/de_GWD/0conf', $newJsonString);

shell_exec('sudo systemctl restart v2dns');
shell_exec('sudo systemctl restart iptables-proxy');
?>
<?php }?>