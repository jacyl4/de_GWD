<?php require_once('auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
$domain1 = $_GET['domain1'];
$domain2 = $_GET['domain2'];
$domain3 = $_GET['domain3'];
$domain4 = $_GET['domain4'];
$domain5 = $_GET['domain5'];
$domain6 = $_GET['domain6'];
$domain7 = $_GET['domain7'];
$domain8 = $_GET['domain8'];
$domain9 = $_GET['domain9'];

$nodename1 = $_GET['nodename1'];
$nodename2 = $_GET['nodename2'];
$nodename3 = $_GET['nodename3'];
$nodename4 = $_GET['nodename4'];
$nodename5 = $_GET['nodename5'];
$nodename6 = $_GET['nodename6'];
$nodename7 = $_GET['nodename7'];
$nodename8 = $_GET['nodename8'];
$nodename9 = $_GET['nodename9'];

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

$data = json_decode(file_get_contents('/usr/local/bin/0conf'), true);
$data['v2node'][0]['domain'] = $domain1;
$data['v2node'][1]['domain'] = $domain2;
$data['v2node'][2]['domain'] = $domain3;
$data['v2node'][3]['domain'] = $domain4;
$data['v2node'][4]['domain'] = $domain5;
$data['v2node'][5]['domain'] = $domain6;
$data['v2node'][6]['domain'] = $domain7;
$data['v2node'][7]['domain'] = $domain8;
$data['v2node'][8]['domain'] = $domain9;
$data['v2node'][0]['name'] = $nodename1;
$data['v2node'][1]['name'] = $nodename2;
$data['v2node'][2]['name'] = $nodename3;
$data['v2node'][3]['name'] = $nodename4;
$data['v2node'][4]['name'] = $nodename5;
$data['v2node'][5]['name'] = $nodename6;
$data['v2node'][6]['name'] = $nodename7;
$data['v2node'][7]['name'] = $nodename8;
$data['v2node'][8]['name'] = $nodename9;
$data['v2node'][0]['uuid'] = $uuid1;
$data['v2node'][1]['uuid'] = $uuid2;
$data['v2node'][2]['uuid'] = $uuid3;
$data['v2node'][3]['uuid'] = $uuid4;
$data['v2node'][4]['uuid'] = $uuid5;
$data['v2node'][5]['uuid'] = $uuid6;
$data['v2node'][6]['uuid'] = $uuid7;
$data['v2node'][7]['uuid'] = $uuid8;
$data['v2node'][8]['uuid'] = $uuid9;
$data['v2node'][0]['path'] = $path1;
$data['v2node'][1]['path'] = $path2;
$data['v2node'][2]['path'] = $path3;
$data['v2node'][3]['path'] = $path4;
$data['v2node'][4]['path'] = $path5;
$data['v2node'][5]['path'] = $path6;
$data['v2node'][6]['path'] = $path7;
$data['v2node'][7]['path'] = $path8;
$data['v2node'][8]['path'] = $path9;
$newJsonString = json_encode($data, JSON_PRETTY_PRINT);
file_put_contents('/usr/local/bin/0conf', $newJsonString);

exec('sudo /usr/local/bin/ui-saveNode');

exec('sudo systemctl restart iptables-proxy');
?>
<?php }?>