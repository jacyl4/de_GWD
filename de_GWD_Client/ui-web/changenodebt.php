<?php require_once('auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
$nodebtnum = $_GET['nodebtnum'];

$v2servn = system("awk 'NR=={$nodebtnum}{print}' /var/www/html/domain.txt");
$uuidnum = system("awk 'NR=={$nodebtnum}{print}' /var/www/html/uuid.txt");
$v2path = system("awk 'NR=={$nodebtnum}{print}' /var/www/html/path.txt");

$nodebtpre = fopen("nodebtpre.txt", "w");
fwrite($nodebtpre, "");
$txt = "$v2servn\n";
fwrite($nodebtpre, $txt);
$txt = "$uuidnum\n";
fwrite($nodebtpre, $txt);
$txt = "$v2path\n";
fwrite($nodebtpre, $txt);
fclose($nodebtpre);

shell_exec('sudo /usr/local/bin/ui-changenodebt');
?>
<?php }?>