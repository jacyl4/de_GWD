<?php require_once('../auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
$nodedtnum = $_GET['nodedtnum'];

$nodedtpre = fopen("nodedtpre.txt", "w");
fwrite($nodedtpre, $nodedtnum);
fclose($nodedtpre);

exec('sudo /opt/de_GWD/ui-changeNodeDT r');
?>
<?php }?>