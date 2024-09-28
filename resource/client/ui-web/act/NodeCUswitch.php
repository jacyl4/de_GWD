<?php require_once('../auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
$switchNodeCU = $_GET['switchNodeCU'];
if ($switchNodeCU == "NodeCUshow"){
    exec('sudo /opt/de_GWD/ui-NodeCU r &');
}
elseif ($switchNodeCU == "NodeCUhide"){
    exec('sudo /opt/de_GWD/ui-NodeCUhide r &');
}

passthru('sudo /opt/de_GWD/ui-NodeCUcheck &');
?>
<?php }?>