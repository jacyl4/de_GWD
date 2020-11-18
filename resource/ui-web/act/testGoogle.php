<?php
function onlineStatus(){
	$status = array("OFFLINE", "ONLINE");
    $handle = fsockopen("www.google.com",443,$errno,$errstr,2);
    if($handle)
        return $status[1];
    else
        return $status[0];
}

echo onlineStatus();
?>
