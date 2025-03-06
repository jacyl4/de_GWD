<?php require_once('../auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
$data = json_decode(file_get_contents('/opt/de_GWD/0conf'), true);
$data['FORWARD']['block53'] = "on";
$newJsonString = json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
file_put_contents('/opt/de_GWD/0conf', $newJsonString);

exec('sudo /opt/de_GWD/ui-block53on &');
?>
<?php }?>
