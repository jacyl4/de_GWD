<?php
$wanIP = exec('curl http://www.f3322.org/dyndns/getip');

if(filter_var($wanIP, FILTER_VALIDATE_IP)) echo $wanIP;
die();
?>
