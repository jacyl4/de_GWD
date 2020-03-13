<?php
putenv("nodeNUM=3");
echo shell_exec('/usr/local/bin/ui-pingNODE $nodeNUM');
die();
?>
