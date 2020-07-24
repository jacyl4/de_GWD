<?php require_once('../auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
$arr = json_decode(file_get_contents('/usr/local/bin/0conf'), true)['v2node'];

foreach($arr as $k => $v) { 
	foreach($v as $key => $value) {
    if($key == 'domain'){
 		echo "$value\n";
 	}
 }
}
?>
<?php }?>
