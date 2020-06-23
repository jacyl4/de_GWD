<?php
putenv("nodeNUM=8");
system('sudo /usr/local/bin/ui-pingICMP $nodeNUM');
die();
?>
