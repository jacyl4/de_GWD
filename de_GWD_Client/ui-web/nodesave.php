<?php require_once('auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
$nodename1 = $_GET['nodename1'];
$nodename2 = $_GET['nodename2'];
$nodename3 = $_GET['nodename3'];
$nodename4 = $_GET['nodename4'];
$nodename5 = $_GET['nodename5'];
$nodename6 = $_GET['nodename6'];
$nodename7 = $_GET['nodename7'];
$nodename8 = $_GET['nodename8'];
$nodename9 = $_GET['nodename9'];

$domain1 = $_GET['domain1'];
$domain2 = $_GET['domain2'];
$domain3 = $_GET['domain3'];
$domain4 = $_GET['domain4'];
$domain5 = $_GET['domain5'];
$domain6 = $_GET['domain6'];
$domain7 = $_GET['domain7'];
$domain8 = $_GET['domain8'];
$domain9 = $_GET['domain9'];

$uuid1 = $_GET['uuid1'];
$uuid2 = $_GET['uuid2'];
$uuid3 = $_GET['uuid3'];
$uuid4 = $_GET['uuid4'];
$uuid5 = $_GET['uuid5'];
$uuid6 = $_GET['uuid6'];
$uuid7 = $_GET['uuid7'];
$uuid8 = $_GET['uuid8'];
$uuid9 = $_GET['uuid9'];

$path1 = $_GET['path1'];
$path2 = $_GET['path2'];
$path3 = $_GET['path3'];
$path4 = $_GET['path4'];
$path5 = $_GET['path5'];
$path6 = $_GET['path6'];
$path7 = $_GET['path7'];
$path8 = $_GET['path8'];
$path9 = $_GET['path9'];

$nodenametxt = fopen("nodename.txt", "w");
$txt1 = "$nodename1\n";
$txt2 = "$nodename2\n";
$txt3 = "$nodename3\n";
$txt4 = "$nodename4\n";
$txt5 = "$nodename5\n";
$txt6 = "$nodename6\n";
$txt7 = "$nodename7\n";
$txt8 = "$nodename8\n";
$txt9 = "$nodename9\n";
fwrite($nodenametxt, "");
fwrite($nodenametxt, $txt1);
fwrite($nodenametxt, $txt2);
fwrite($nodenametxt, $txt3);
fwrite($nodenametxt, $txt4);
fwrite($nodenametxt, $txt5);
fwrite($nodenametxt, $txt6);
fwrite($nodenametxt, $txt7);
fwrite($nodenametxt, $txt8);
fwrite($nodenametxt, $txt9);
fclose($nodenametxt);

$domaintxt = fopen("domain.txt", "w");
$txt1 = "$domain1\n";
$txt2 = "$domain2\n";
$txt3 = "$domain3\n";
$txt4 = "$domain4\n";
$txt5 = "$domain5\n";
$txt6 = "$domain6\n";
$txt7 = "$domain7\n";
$txt8 = "$domain8\n";
$txt9 = "$domain9\n";
fwrite($domaintxt, "");
fwrite($domaintxt, $txt1);
fwrite($domaintxt, $txt2);
fwrite($domaintxt, $txt3);
fwrite($domaintxt, $txt4);
fwrite($domaintxt, $txt5);
fwrite($domaintxt, $txt6);
fwrite($domaintxt, $txt7);
fwrite($domaintxt, $txt8);
fwrite($domaintxt, $txt9);
fclose($domaintxt);

$uuidtxt = fopen("uuid.txt", "w");
$txt1 = "$uuid1\n";
$txt2 = "$uuid2\n";
$txt3 = "$uuid3\n";
$txt4 = "$uuid4\n";
$txt5 = "$uuid5\n";
$txt6 = "$uuid6\n";
$txt7 = "$uuid7\n";
$txt8 = "$uuid8\n";
$txt9 = "$uuid9\n";
fwrite($uuidtxt, "");
fwrite($uuidtxt, $txt1);
fwrite($uuidtxt, $txt2);
fwrite($uuidtxt, $txt3);
fwrite($uuidtxt, $txt4);
fwrite($uuidtxt, $txt5);
fwrite($uuidtxt, $txt6);
fwrite($uuidtxt, $txt7);
fwrite($uuidtxt, $txt8);
fwrite($uuidtxt, $txt9);
fclose($uuidtxt);

$pathtxt = fopen("path.txt", "w");
$txt1 = "$path1\n";
$txt2 = "$path2\n";
$txt3 = "$path3\n";
$txt4 = "$path4\n";
$txt5 = "$path5\n";
$txt6 = "$path6\n";
$txt7 = "$path7\n";
$txt8 = "$path8\n";
$txt9 = "$path9\n";
fwrite($pathtxt, "");
fwrite($pathtxt, $txt1);
fwrite($pathtxt, $txt2);
fwrite($pathtxt, $txt3);
fwrite($pathtxt, $txt4);
fwrite($pathtxt, $txt5);
fwrite($pathtxt, $txt6);
fwrite($pathtxt, $txt7);
fwrite($pathtxt, $txt8);
fwrite($pathtxt, $txt9);
fclose($pathtxt);

shell_exec('sudo systemctl restart iptables-proxy');
?>
<?php }?>