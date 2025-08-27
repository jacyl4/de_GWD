<?php require_once('../auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
exec('sudo rm -rf /var/www/html/restore/Bitwarden_bak.zip &');
if ($_FILES["file"]["name"] == "Bitwarden_bak.zip")
{
	move_uploaded_file($_FILES['file']['tmp_name'], '../restore/' . "Bitwarden_bak.zip");
	exec('sudo /opt/de_GWD/ui-restoreBitwarden &');
}
?>
<?php }?>
