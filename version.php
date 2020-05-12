1.9.37
-
<?php
$str= file_get_contents('https://raw.githubusercontent.com/jacyl4/de_GWD/master/version.php');
$array=explode('/', $str);
echo $array[0];
?>
