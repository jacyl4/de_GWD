1.11.12
-
<?php
$str= file_get_contents('https://cdn.jsdelivr.net/gh/jacyl4/de_GWD@main/version.php');
$array=explode('/', $str);
echo $array[0];
?>