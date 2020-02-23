<?php require_once('auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
exec('sudo /usr/local/bin/ui-hostsDefault');

$hostsCustomize = $_GET['hostsCustomize'];

$data = json_decode(file_get_contents('/usr/local/bin/0conf'), true);
$hostsCustomize=str_replace("\t", " ", $hostsCustomize);
$hostsCustomize=preg_replace("/\s(?=\s)/", "\\1", $hostsCustomize);
$hostsCustomize=str_replace(" ", ",", $hostsCustomize);
$arr = explode("\n",$hostsCustomize);
$arr = array_filter($arr);
foreach($arr as $k=>$v){
        $arr = explode(',',$v);
        $arr2[$arr[0]] = $arr[1];
}
$data['hosts'] = array();
$data['hosts'] = $arr2;
$newJsonString = json_encode($data, JSON_PRETTY_PRINT);
file_put_contents('/usr/local/bin/0conf', $newJsonString);

exec('sudo /usr/local/bin/ui-hostSave');
exec('sudo systemctl restart vtrui');
?>
<?php }?>
