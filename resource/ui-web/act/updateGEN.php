<?php require_once('../auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
$conf = json_decode(file_get_contents('/usr/local/bin/0conf'), true);
$updateCMD = $_GET['updateCMD'];

$conf['updateCMD'] = $updateCMD;
$newJsonString = json_encode($conf, JSON_PRETTY_PRINT);
file_put_contents('/usr/local/bin/0conf', $newJsonString);

file_put_contents('ui-update', "#!/bin/bash\n/usr/bin/ttyd -p 3000 -o $updateCMD");

shell_exec('sudo mv -f /var/www/html/act/ui-update /usr/local/bin/ui-update');
shell_exec('sudo chmod +x /usr/local/bin/ui-update');
shell_exec('sudo systemctl start updateGWD');
?>
<?php }?>