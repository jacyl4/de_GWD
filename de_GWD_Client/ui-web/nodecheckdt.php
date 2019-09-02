<?php require_once('auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php

$nodedtnum = exec("/usr/local/bin/ui-nodecheckdt"); 

echo shell_exec("awk 'NR=={$nodedtnum}{print}' /var/www/html/nodename.txt"); 

?>
<?php }?>
