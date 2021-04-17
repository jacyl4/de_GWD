<?php require_once('../auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
exec('sudo rm -rf /var/www/html/restore/Bitwardenrs_bak.zip &');
if ($_FILES["file"]["name"] == "Bitwardenrs_bak.zip")
{
	move_uploaded_file($_FILES['file']['tmp_name'], '../restore/' . $_FILES['file']['name']);
}
exec('sudo /opt/de_GWD/ui-restoreBWrs &');
?>
<?php }?>
