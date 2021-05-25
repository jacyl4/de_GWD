<?php
$wanIP = exec('sudo /opt/de_GWD/ui-wanIP');

if(filter_var($wanIP, FILTER_VALIDATE_IP)) echo $wanIP;
die();
?>
