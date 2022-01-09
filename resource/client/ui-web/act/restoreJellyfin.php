<?php require_once('../auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
exec('sudo rm -rf /var/www/html/restore/Jellyfin_bak.zip &');
if ($_FILES["file"]["name"] == "Jellyfin_bak.zip")
{
	move_uploaded_file($_FILES['file']['tmp_name'], '../restore/' . $_FILES['file']['name']);
}
exec('sudo /opt/de_GWD/ui-restoreJellyfin &');
?>
<?php }?>
