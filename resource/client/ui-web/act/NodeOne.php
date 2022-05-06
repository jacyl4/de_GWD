<?php require_once('../auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
$conf = json_decode(file_get_contents('/opt/de_GWD/0conf'), true);
$conf['v2nodeDIV']['nodeSM']['status'] = "off";
$conf['v2nodeDIV']['nodeDT']['status'] = "off";
$conf['v2nodeDIV']['nodeCU']['status'] = "off";
$newJsonString = json_encode($conf, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
file_put_contents('/opt/de_GWD/0conf', $newJsonString);

exec('/opt/de_GWD/ui-NodeOne f r &');
?>
<?php }?>