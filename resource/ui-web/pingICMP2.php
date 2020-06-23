<?php
putenv("nodeNUM=2");
system('sudo /usr/local/bin/ui-pingICMP $nodeNUM');
die();
?>
