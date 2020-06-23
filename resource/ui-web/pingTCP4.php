<?php
putenv("nodeNUM=4");
system('sudo /usr/local/bin/ui-pingTCP $nodeNUM');
die();
?>
