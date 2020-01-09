<?php
function onlineStatus($addr,$port=80)
{
    $status = array("OFFLINE", "ONLINE");
    $handle = fsockopen($addr,$port,$errno,$errstr,2);
    if($handle)
        return $status[1];
    else
        return $status[0];
}

echo onlineStatus('ssl://www.baidu.com',443);
?>
