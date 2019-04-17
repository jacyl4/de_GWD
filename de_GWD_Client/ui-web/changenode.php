<?php require_once('auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
$nodenum = $_GET['nodenum'];

$v2servn = system("awk 'NR=={$nodenum}{print}' /var/www/html/domain.txt");
$uuidnum = system("awk 'NR=={$nodenum}{print}' /var/www/html/uuid.txt");
$v2path = system("awk 'NR=={$nodenum}{print}' /var/www/html/path.txt");

$nodepre = fopen("nodepre.txt", "w");
fwrite($nodepre, "");
$txt = "$v2servn\n";
fwrite($nodepre, $txt);
$txt = "$uuidnum\n";
fwrite($nodepre, $txt);
$txt = "$v2path\n";
fwrite($nodepre, $txt);
fclose($nodepre);

system('sudo /usr/local/bin/ui-changenode');
?>
<?php }?>