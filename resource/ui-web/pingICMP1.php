<?php
putenv("nodeNUM=1");
system('sudo /usr/local/bin/ui-pingICMP $nodeNUM');
die();
?>
