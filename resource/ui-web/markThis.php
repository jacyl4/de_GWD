<?php require_once('auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
$markThis = $_GET['markName'];

$markThistxt = fopen("markThis.txt", "w");
$txt = "$markThis\n";
fwrite($markThistxt, $txt);
fclose($markThistxt);

exec('sudo /usr/local/bin/ui-markThis');
?>
<?php }?>