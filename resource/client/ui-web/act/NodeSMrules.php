<?php require_once('../auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
$conf = json_decode(file_get_contents('/opt/de_GWD/0conf'), true);
$nodeSMshowYoutube = $_GET['nodeSMshowYoutube'];
$nodeSMshowNetflix = $_GET['nodeSMshowNetflix'];
$nodeSMshowHDH = $_GET['nodeSMshowHDH'];
$nodeSMshowTVB = $_GET['nodeSMshowTVB'];
$nodeSMshowBahamut = $_GET['nodeSMshowBahamut'];
$nodeSMshowApple = $_GET['nodeSMshowApple'];

$conf['v2nodeDIV']['nodeSM'] = array();
$conf['v2nodeDIV']['nodeSM']['youtube'] = $nodeSMshowYoutube;
$conf['v2nodeDIV']['nodeSM']['youtube'] = $nodeSMshowYoutube;
$conf['v2nodeDIV']['nodeSM']['netflix'] = $nodeSMshowNetflix;
$conf['v2nodeDIV']['nodeSM']['hdh'] = $nodeSMshowHDH;
$conf['v2nodeDIV']['nodeSM']['tvb'] = $nodeSMshowTVB;
$conf['v2nodeDIV']['nodeSM']['bahamut'] = $nodeSMshowBahamut;
$conf['v2nodeDIV']['nodeSM']['apple'] = $nodeSMshowApple;
$newJsonString = json_encode($conf, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
file_put_contents('/opt/de_GWD/0conf', $newJsonString);

exec('sudo /opt/de_GWD/ui-NodeSM r &');
?>
<?php }?>
