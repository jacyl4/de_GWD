<?php
putenv("nodeNUM=5");
system('sudo /usr/local/bin/ui-pingICMP $nodeNUM');
die();
?>
