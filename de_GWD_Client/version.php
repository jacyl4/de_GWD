1.3.15
-
<?php 
$str= file_get_contents('https://github.com/gwdburst/de_GWD/raw/master/de_GWD_Client/version.php');
$array=explode('/', $str);
echo $array[0];
?>