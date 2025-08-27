<?php
$wanIP = exec('sudo /opt/de_GWD/ui-wanIP_cn');

if(filter_var($wanIP, FILTER_VALIDATE_IP)) echo $wanIP;
?>
