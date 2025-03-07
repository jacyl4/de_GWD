<?php require_once('../auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
$switchNodeDT = $_GET['switchNodeDT'];
if ($switchNodeDT == "NodeDTshow"){
    exec('sudo /opt/de_GWD/ui-NodeDT r &');
}
elseif ($switchNodeDT == "NodeDThide"){
    exec('sudo /opt/de_GWD/ui-NodeDThide r &');
}

passthru('/opt/de_GWD/ui-NodeDTcheck &');
?>
<?php }?>