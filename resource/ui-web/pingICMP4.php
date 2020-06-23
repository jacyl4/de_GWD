<?php
putenv("nodeNUM=4");
system('sudo /usr/local/bin/ui-pingICMP $nodeNUM');
die();
?>
