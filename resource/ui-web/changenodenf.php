<?php require_once('auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
$nodenfnum = $_GET['nodenfnum'];

$v2servn = system("awk 'NR=={$nodenfnum}{print}' /var/www/html/domain.txt");
$uuidnum = system("awk 'NR=={$nodenfnum}{print}' /var/www/html/uuid.txt");
$v2path = system("awk 'NR=={$nodenfnum}{print}' /var/www/html/path.txt");

$nodenfpre = fopen("nodenfpre.txt", "w");
fwrite($nodenfpre, "");
$txt = "$v2servn\n";
fwrite($nodenfpre, $txt);
$txt = "$uuidnum\n";
fwrite($nodenfpre, $txt);
$txt = "$v2path\n";
fwrite($nodenfpre, $txt);
fclose($nodenfpre);

shell_exec('sudo /usr/local/bin/ui-changeNodeNF');
?>
<?php }?>