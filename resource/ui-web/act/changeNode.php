<?php require_once('../auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
$nodenum = $_GET['nodenum'];

$nodepre = fopen("nodepre.txt", "w");
fwrite($nodepre, $nodenum);
fclose($nodepre);

shell_exec('sudo /usr/local/bin/ui-changeNode');
shell_exec('sudo systemctl restart vtrui');
?>
<?php }?>