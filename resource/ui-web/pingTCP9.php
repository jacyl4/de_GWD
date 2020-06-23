<?php
putenv("nodeNUM=9");
system('sudo /usr/local/bin/ui-pingTCP $nodeNUM');
die();
?>
