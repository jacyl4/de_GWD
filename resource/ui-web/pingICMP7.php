<?php
putenv("nodeNUM=7");
system('sudo /usr/local/bin/ui-pingICMP $nodeNUM');
die();
?>
