<?php require_once('../auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
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

$data = json_decode(file_get_contents('/usr/local/bin/0conf'), true);
$data['listB'] = array();
$data['listW'] = array();
$data['listB'] = $listB;
$data['listW'] = $listW;
$data['listBlan'] = $listBlan;
$data['listWlan'] = $listWlan;
$newJsonString = json_encode($data, JSON_PRETTY_PRINT);
file_put_contents('/usr/local/bin/0conf', $newJsonString);

shell_exec('sudo /usr/local/bin/ui-saveListBW');
shell_exec('sudo systemctl restart iptables-proxy');
shell_exec('sudo systemctl restart v2dns');
?>
<?php }?>