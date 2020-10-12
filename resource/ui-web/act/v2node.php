<?php require_once('../auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
echo json_encode(json_decode(file_get_contents('/usr/local/bin/0conf'))->v2node);
?>
<?php }?>
