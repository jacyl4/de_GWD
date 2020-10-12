<?php require_once('../auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
$conf = json_decode(file_get_contents('/usr/local/bin/0conf'), true);
$CFdomain = $_GET['CFdomain'];
$CFapikey = $_GET['CFapikey'];
$CFemail = $_GET['CFemail'];

$conf['FORWARD']['domain'] = $CFdomain;
$conf['FORWARD']['APIkey'] = $CFapikey;
$conf['FORWARD']['Email'] = $CFemail;
$newJsonString = json_encode($conf, JSON_PRETTY_PRINT);
file_put_contents('/usr/local/bin/0conf', $newJsonString);

shell_exec('sudo nohup /usr/bin/ttyd -p 3000 -o /usr/local/bin/ui-installCER');
?>
<?php }?>