1.6.45
-
<?php
$str= file_get_contents('https://raw.githubusercontent.com/jacyl4/de_GWD/master/resource/version.php');
$array=explode('/', $str);
echo $array[0];
?>
