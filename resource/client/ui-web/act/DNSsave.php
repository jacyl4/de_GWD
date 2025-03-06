<?php require_once('../auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
$conf = json_decode(file_get_contents('/opt/de_GWD/0conf'), true);
$DoGc = $_GET['DoGc'];
$DoH1 = $_GET['DoH1'];
$DoH2 = $_GET['DoH2'];

$dnsChina = $_GET['dnsChina'];
$dnsChina = str_replace(PHP_EOL, ' ', $dnsChina);

$DOHarray = array();
array_push($DOHarray, "$DoH1", "$DoH2");
$conf['dns']['dog'] = $DoGc;
$conf['dns']['doh'] = $DOHarray;
$conf['dns']['china'] = $dnsChina;
$newJsonString = json_encode($conf, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
file_put_contents('/opt/de_GWD/0conf', $newJsonString);

exec('sudo /opt/de_GWD/ui_4h r n &');
?>
<?php }?>