<?php require_once('../auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
if ($_FILES["file"]["name"] == "de_GWD_bak")
{
	move_uploaded_file($_FILES['file']['tmp_name'], 'restore/' . $_FILES['file']['name']);
}
shell_exec('sudo mv -f /var/www/html/restore/de_GWD_bak /usr/local/bin/0conf');

shell_exec('sudo /usr/local/bin/ui-restore');
?>
<?php }?>
