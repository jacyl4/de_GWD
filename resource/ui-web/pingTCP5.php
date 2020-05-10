<?php
putenv("nodeNUM=5");
echo shell_exec('/usr/local/bin/ui-pingTCP $nodeNUM');
die();
?>
