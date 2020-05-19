<?php require_once('auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
$DoH1 = $_GET['DoH1'];
$DoH2 = $_GET['DoH2'];
$DNSChina = $_GET['DNSChina'];
$hostsCustomize = $_GET['hostsCustomize'];

$DNSChinaLine = str_replace(PHP_EOL, ' ', $DNSChina);
$data = json_decode(file_get_contents('/usr/local/bin/0conf'), true);
$data['dns']['china'] = $DNSChinaLine;
$newJsonString = json_encode($data, JSON_PRETTY_PRINT);
file_put_contents('/usr/local/bin/0conf', $newJsonString);

$data = json_decode(file_get_contents('/usr/local/bin/0conf'), true);
$data['doh']['doh1'] = $DoH1;
$data['doh']['doh2'] = $DoH2;
$newJsonString = json_encode($data, JSON_PRETTY_PRINT);
file_put_contents('/usr/local/bin/0conf', $newJsonString);

$data = json_decode(file_get_contents('/usr/local/bin/0conf'), true);
$hostsCustomize=str_replace("\t", " ", $hostsCustomize);
$hostsCustomize=preg_replace("/\s(?=\s)/", "\\1", $hostsCustomize);
$hostsCustomize=str_replace(" ", ",", $hostsCustomize);
$arr = explode("\n",$hostsCustomize);
$arr = array_filter($arr);
foreach($arr as $k=>$v){
        $arr = explode(',',$v);
        $arr2[$arr[0]] = $arr[1];
}
$data['hosts'] = array();
$data['hosts'] = $arr2;
$newJsonString = json_encode($data, JSON_PRETTY_PRINT);
file_put_contents('/usr/local/bin/0conf', $newJsonString);

exec('sudo /usr/local/bin/ui-saveDNSChina');

$data = json_decode(file_get_contents('/usr/local/bin/0conf'), true);
if ( $data['splitDNS'] === "gfw" ){
	exec('sudo /usr/local/bin/ui-changeNLgfw');
}
elseif ( $data['splitDNS'] === "chnw" ){
	exec('sudo /usr/local/bin/ui-changeNLchnw');
}

exec('sudo systemctl restart smartdns');
exec('sudo systemctl restart doh-client');
exec('sudo systemctl restart v2dns');
?>
<?php }?>
