<?php require_once('../auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
exec('sudo rm -rf /var/www/html/restore/de_GWD_bak &');
if ($_FILES["file"]["name"] == "de_GWD_bak")
{
	move_uploaded_file($_FILES['file']['tmp_name'], '../restore/' . $_FILES['file']['name']);
}
exec('sudo /opt/de_GWD/ui-restore &');
?>
<?php }?>
