1.11.12
-
<?php
$str= file_get_contents('https://github.com/jacyl4/de_GWD/raw/main/version.php');
$array=explode('/', $str);
echo $array[0];
?>