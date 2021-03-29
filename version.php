1.17.1
-
<?php
$str= file_get_contents('https://raw.githubusercontent.com/jacyl4/de_GWD/main/version.php');
$array=explode('-', $str);
echo $array[0];
?>
