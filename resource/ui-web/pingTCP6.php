<?php
putenv("nodeNUM=6");
system('sudo /usr/local/bin/ui-pingTCP $nodeNUM');
die();
?>
