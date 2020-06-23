<?php
putenv("nodeNUM=2");
system('sudo /usr/local/bin/ui-pingTCP $nodeNUM');
die();
?>
