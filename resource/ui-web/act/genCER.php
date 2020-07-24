<?php require_once('../auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
$CFdomain = $_GET['CFdomain'];
$CFapikey = $_GET['CFapikey'];
$CFemail = $_GET['CFemail'];

$data = json_decode(file_get_contents('/usr/local/bin/0conf'), true);
$data['FORWARD']['domain'] = $CFdomain;
$data['FORWARD']['APIkey'] = $CFapikey;
$data['FORWARD']['Email'] = $CFemail;
$newJsonString = json_encode($data, JSON_PRETTY_PRINT);
file_put_contents('/usr/local/bin/0conf', $newJsonString);

shell_exec('sudo nohup /usr/local/bin/ttyd -p 3000 -o /usr/local/bin/ui-installCER');
?>
<?php }?>