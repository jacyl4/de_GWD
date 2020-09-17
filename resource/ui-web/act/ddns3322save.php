<?php require_once('../auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
$conf = json_decode(file_get_contents('/usr/local/bin/0conf'), true);
$domain3322 = $_GET['domain3322'];
$user3322 = $_GET['user3322'];
$pwd3322 = $_GET['pwd3322'];

$conf['ddns']['ddns3322']['domain'] = $domain3322;
$conf['ddns']['ddns3322']['user'] = $user3322;
$conf['ddns']['ddns3322']['pwd'] = $pwd3322;
$newJsonString = json_encode($conf, JSON_PRETTY_PRINT);
file_put_contents('/usr/local/bin/0conf', $newJsonString);

shell_exec('sudo /usr/local/bin/ui-ddns3322updateIP');
shell_exec('sudo /usr/local/bin/ui-ddns3322updateOn');
?>
<?php }?>