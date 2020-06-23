<?php
putenv("nodeNUM=3");
system('sudo /usr/local/bin/ui-pingICMP $nodeNUM');
die();
?>
