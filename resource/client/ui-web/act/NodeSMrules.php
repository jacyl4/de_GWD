<?php require_once('../auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
$nodeSMshowYoutube = $_GET['nodeSMshowYoutube'];
$nodeSMshowNetflix = $_GET['nodeSMshowNetflix'];
$nodeSMshowHDH = $_GET['nodeSMshowHDH'];
$nodeSMshowTVB = $_GET['nodeSMshowTVB'];
$nodeSMshowBahamut = $_GET['nodeSMshowBahamut'];
$nodeSMshowApple = $_GET['nodeSMshowApple'];
$nodeSMshowSteam = $_GET['nodeSMshowSteam'];
exec("sudo /opt/de_GWD/ui-NodeSM r $nodeSMshowYoutube $nodeSMshowNetflix $nodeSMshowHDH $nodeSMshowTVB $nodeSMshowBahamut $nodeSMshowApple $nodeSMshowSteam");
?>
<?php }?>
