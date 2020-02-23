<?php require_once('auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
$nodenum = $_GET['nodenum'];

$nodepre = fopen("nodepre.txt", "w");
fwrite($nodepre, $nodenum);
fclose($nodepre);

exec('sudo /usr/local/bin/ui-changeNode');
exec('sudo systemctl restart vtrui');
?>
<?php }?>