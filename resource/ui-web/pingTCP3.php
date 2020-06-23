<?php
putenv("nodeNUM=3");
system('sudo /usr/local/bin/ui-pingTCP $nodeNUM');
die();
?>
