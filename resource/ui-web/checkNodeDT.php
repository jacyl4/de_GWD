<?php require_once('auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
$nodedtnum = exec("/usr/local/bin/ui-checkNodeDT"); 

echo json_decode(file_get_contents('/usr/local/bin/0conf'))->v2node[$nodedtnum]->name;

?>
<?php }?>
