<?php
function onlineStatus($addr,$port)
{
    $status = array("OFFLINE", "ONLINE");
    $handle = fsockopen($addr,$port,$errno,$errstr,2);
    if($handle)
        return $status[1];
    else
        return $status[0];
}

echo onlineStatus('www.baidu.com',443);
?>
