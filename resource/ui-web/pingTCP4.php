<?php
putenv("nodeNUM=4");
echo shell_exec('/usr/local/bin/ui-pingTCP $nodeNUM');
die();
?>
