<?php require_once('../auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
$conf = json_decode(file_get_contents('/opt/de_GWD/0conf'), true);
$xDNSc = $_GET['xDNSc'];
$DoH1 = $_GET['DoH1'];
$DoH2 = $_GET['DoH2'];

$dnsChina = $_GET['dnsChina'];
$dnsChina = str_replace(PHP_EOL, ' ', $dnsChina);

$hostsCustomize = $_GET['hostsCustomize'];
$hostsCustomize = str_replace("\t", ' ', $hostsCustomize);
$hostsCustomize = preg_replace("/\s(?=\s)/", "\\1", $hostsCustomize);
$hostsCustomize = str_replace(" ", ",", $hostsCustomize);
$arr = explode("\n",$hostsCustomize);
$arr = array_filter(array_map('trim', $arr));
foreach($arr as $k=>$v){
        $arr = explode(',',$v);
        $hosts[$arr[1]] = $arr[0];
}

$xDNSarray = array();
array_push($xDNSarray, "$xDNSc", "$DoH1", "$DoH2");
$xDNSarray = array_filter(array_map('trim', $xDNSarray));
$conf['dns']['xDNS'] = array();
$conf['dns']['xDNS'] = $xDNSarray;
$conf['dns']['china'] = $dnsChina;
$conf['dns']['hosts'] = array();
$conf['dns']['hosts'] = $hosts;
$newJsonString = json_encode($conf, JSON_PRETTY_PRINT);
file_put_contents('/opt/de_GWD/0conf', $newJsonString);

if($conf['dns']['DNSsplit'] == chnw) exec('sudo /opt/de_GWD/ui-dnsCHNW r &'); else exec('sudo /opt/de_GWD/ui-dnsGFW r &');
?>
<?php }?>