<?php require_once('../auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
$conf = json_decode(file_get_contents('/opt/de_GWD/0conf'), true);
$customDomain = $_GET['customDomain'];
$customIP = $_GET['customIP'];

$customDomain = explode("\n",$customDomain);
$customDomain = array_filter(array_map('trim', $customDomain));

$customIP = explode("\n",$customIP);
$customIP = array_filter(array_map('trim', $customIP));

$conf['v2nodeDIV']['nodeCU']['rulesDomain'] = array();
$conf['v2nodeDIV']['nodeCU']['rulesIP'] = array();
$conf['v2nodeDIV']['nodeCU']['rulesDomain'] = $customDomain;
$conf['v2nodeDIV']['nodeCU']['rulesIP'] = $customIP;
$newJsonString = json_encode($conf, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
file_put_contents('/opt/de_GWD/0conf', $newJsonString);

exec('sudo /opt/de_GWD/ui-NodeCU r &');
?>
<?php }?>
