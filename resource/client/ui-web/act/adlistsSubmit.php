<?php require_once('../auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
$conf = json_decode(file_get_contents('/opt/de_GWD/0conf'), true);
$adlistsURL = $_GET['adlistsURL'];

$adlistsURL = explode("\n",$adlistsURL);
$adlistsURL = array_filter(array_map('trim', $adlistsURL));

$conf['dns']['adlistsURL'] = array();
$conf['dns']['adlistsURL'] = $adlistsURL;
$newJsonString = json_encode($conf, JSON_PRETTY_PRINT);
file_put_contents('/opt/de_GWD/0conf', $newJsonString);

exec('sudo /opt/de_GWD/ui-adlistsSubmit; pihole -f &');
?>
<?php }?>