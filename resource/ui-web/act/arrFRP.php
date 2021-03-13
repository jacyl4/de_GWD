<?php require_once('../auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
echo json_encode(json_decode(file_get_contents('/opt/de_GWD/0conf'))->FRP->clients);
?>
<?php }?>
