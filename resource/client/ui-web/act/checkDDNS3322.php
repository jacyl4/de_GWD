<?php require_once('../auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
$ddns3322 = exec('sudo /opt/de_GWD/ui-checkDDNS3322 &');

if ($ddns3322 == success) echo "installed";
?>
<?php }?>