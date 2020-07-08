<?php require_once('auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
if ($_FILES["file"]["name"] == "0conf")
{
	move_uploaded_file($_FILES['file']['tmp_name'], 'restore/' . $_FILES['file']['name']);
}
shell_exec('sudo mv -f /var/www/html/restore/0conf /usr/local/bin/0conf');

shell_exec('sudo /usr/local/bin/ui-restore');
?>
<?php }?>
