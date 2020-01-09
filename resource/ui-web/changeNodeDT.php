<?php require_once('auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
$nodedtnum = $_GET['nodedtnum'];

$v2servn = system("awk 'NR=={$nodedtnum}{print}' /var/www/html/domain.txt");
$uuidnum = system("awk 'NR=={$nodedtnum}{print}' /var/www/html/uuid.txt");
$v2path = system("awk 'NR=={$nodedtnum}{print}' /var/www/html/path.txt");

$nodedtpre = fopen("nodedtpre.txt", "w");
fwrite($nodedtpre, "");
$txt = "$v2servn\n";
fwrite($nodedtpre, $txt);
$txt = "$uuidnum\n";
fwrite($nodedtpre, $txt);
$txt = "$v2path\n";
fwrite($nodedtpre, $txt);
fclose($nodedtpre);

shell_exec('sudo /usr/local/bin/ui-changeNodeDT');
?>
<?php }?>