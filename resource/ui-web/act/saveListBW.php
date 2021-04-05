<?php require_once('../auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
$conf = json_decode(file_get_contents('/opt/de_GWD/0conf'), true);
$listB = $_GET['listB'];
$listB = explode("\n",$listB);
$listB = array_filter(array_map('trim', $listB));
$listB = array_combine($listB, $listB);

$listW = $_GET['listW'];
$listW = explode("\n",$listW);
$listW = array_filter(array_map('trim', $listW));
$listW = array_combine($listW, $listW);

$listBlan = $_GET['listBlan'];
$listBlan = explode("\n",$listBlan);
$listBlan = array_filter(array_map('trim', $listBlan));

$listWlan = $_GET['listWlan'];
$listWlan = explode("\n",$listWlan);
$listWlan = array_filter(array_map('trim', $listWlan));

$conf['listB'] = array();
$conf['listW'] = array();
$conf['listB'] = $listB;
$conf['listW'] = $listW;
$conf['listBlan'] = $listBlan;
$conf['listWlan'] = $listWlan;
$newJsonString = json_encode($conf, JSON_PRETTY_PRINT);
file_put_contents('/opt/de_GWD/0conf', $newJsonString);

if(strpos($conf,'geosite:cn') !== false) exec('sudo /opt/de_GWD/ui-dnsCHNW &'); else exec('sudo /opt/de_GWD/ui-dnsGFW &');
?>
<?php }?>