<?php require_once('auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
$nodenfnum = shell_exec("/usr/local/bin/ui-checkNodeNF"); 

echo json_decode(file_get_contents('/usr/local/bin/0conf'))->v2node[$nodenfnum]->name;

?>
<?php }?>
