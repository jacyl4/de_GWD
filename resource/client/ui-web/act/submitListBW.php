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

$conf['dns']['listB'] = array();
$conf['dns']['listW'] = array();
$conf['dns']['listB'] = $listB;
$conf['dns']['listW'] = $listW;
$newJsonString = json_encode($conf, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
file_put_contents('/opt/de_GWD/0conf', $newJsonString);

exec('sudo /opt/de_GWD/ui-DNSsplit r &');
?>
<?php }?>