<?php
putenv("nodeNUM=6");
system('sudo /usr/local/bin/ui-pingICMP $nodeNUM');
die();
?>
