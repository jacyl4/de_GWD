<?php
putenv("nodeNUM=8");
system('sudo /usr/local/bin/ui-pingTCP $nodeNUM');
die();
?>
