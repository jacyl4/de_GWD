<?php require_once('auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
$DoH1 = $_GET['DoH1'];
$DoH2 = $_GET['DoH2'];

$dohtxt = fopen("doh.txt", "w");
$txt = "$DoH1\n";
fwrite($dohtxt, $txt);
$txt = "$DoH2\n";
fwrite($dohtxt, $txt);
fclose($dohtxt);

shell_exec('sudo /usr/local/bin/ui-changedoh');
?>
<?php }?>