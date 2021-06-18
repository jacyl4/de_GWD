<?php require_once('../auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
$conf = json_decode(file_get_contents('/opt/de_GWD/0conf'), true);
$customDomain = $_GET['customDomain'];

$customDomain = explode("\n",$customDomain);
$customDomain = array_filter(array_map('trim', $customDomain));

$conf['v2nodeDIV']['nodeCU']['rules'] = array();
$conf['v2nodeDIV']['nodeCU']['rules'] = $customDomain;
$newJsonString = json_encode($conf, JSON_PRETTY_PRINT);
file_put_contents('/opt/de_GWD/0conf', $newJsonString);

exec('sudo /opt/de_GWD/ui-NodeCUrules r &');
?>
<?php }?>
