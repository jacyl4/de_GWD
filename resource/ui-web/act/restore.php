<?php require_once('../auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
if ($_FILES["file"]["name"] == "de_GWD_bak")
{
	move_uploaded_file($_FILES['file']['tmp_name'], '../restore/' . $_FILES['file']['name']);
}
exec('sudo mv -f /var/www/html/restore/de_GWD_bak /opt/de_GWD/0conf');

exec('sudo /opt/de_GWD/ui-restore');
?>
<?php }?>
