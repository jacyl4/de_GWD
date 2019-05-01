<?php require_once('auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php

$nodebtnum = exec("/usr/local/bin/ui-nodecheckbt"); 

echo shell_exec("awk 'NR=={$nodebtnum}{print}' /var/www/html/nodename.txt"); 

?>
<?php }?>
