<?php require_once('../auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
$conf = json_decode(file_get_contents('/opt/de_GWD/0conf'), true);
$listB = $_GET['listB'];
$listB = explode("\n",$listB);
$listB = array_filter($listB);
$listB = array_combine($listB, $listB);

$listW = $_GET['listW'];
$listW = explode("\n",$listW);
$listW = array_filter($listW);
$listW = array_combine($listW, $listW);

$listBlan = $_GET['listBlan'];
$listBlan = explode("\n",$listBlan);
$listBlan = array_filter($listBlan);

$listWlan = $_GET['listWlan'];
$listWlan = explode("\n",$listWlan);
$listWlan = array_filter($listWlan);

$conf['listB'] = array();
$conf['listW'] = array();
$conf['listB'] = $listB;
$conf['listW'] = $listW;
$conf['listBlan'] = $listBlan;
$conf['listWlan'] = $listWlan;
$newJsonString = json_encode($conf, JSON_PRETTY_PRINT);
file_put_contents('/opt/de_GWD/0conf', $newJsonString);

shell_exec('sudo /opt/de_GWD/ui-saveListBW');
shell_exec('sudo systemctl restart v2dns');
shell_exec('sudo systemctl restart iptables-proxy');
?>
<?php }?>