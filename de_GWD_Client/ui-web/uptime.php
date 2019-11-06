<?php ob_start(ob_gzhandler); ?> 
<?php 
function sys_linux() 
 { 
    $uptimestr = @file("/proc/uptime"); 
    $uptimestr = explode(" ", implode("", $uptimestr)); 
    $uptimestr = trim($uptimestr[0]); 
    $min = $uptimestr / 60; 
    $hours = $min / 60; 
    $days = floor($hours / 24); 
    $hours = floor($hours - ($days * 24)); 
    $min = floor($min - ($days * 60 * 24) - ($hours * 60)); 
    if ($days !== 0) $res['uptime'] = $days."天"; 
    if ($hours !== 0) $res['uptime'] .= $hours."小时"; 
    $res['uptime'] .= $min."分钟"; 
    return $res; 
 } 
 
 $sysInfo = sys_linux(); 
 $uptime = $sysInfo['uptime']; 
 echo $uptime;
die();
?>
<?php ob_end_flush(); ?> 