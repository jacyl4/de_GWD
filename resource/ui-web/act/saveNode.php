<?php require_once('../auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
$nodeList = $_GET['nodeList'];

$data = json_decode(file_get_contents('/usr/local/bin/0conf'), true);
$data['v2node'] = $nodeList;
$newJsonString = json_encode($data, JSON_PRETTY_PRINT);
file_put_contents('/usr/local/bin/0conf', $newJsonString);

$DNSsplit = json_decode(file_get_contents('/usr/local/bin/0conf'), true);
if ( $DNSsplit['DNSsplit'] === "gfw" ){
	shell_exec('sudo /usr/local/bin/ui-dnsGFW');
} else {
	shell_exec('sudo /usr/local/bin/ui-dnsCHNW');
}

shell_exec('sudo systemctl restart iptables-proxy');
shell_exec('sudo systemctl restart v2dns');
?>
<?php }?>