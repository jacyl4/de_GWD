<?php
putenv("nodeNUM=6");
echo shell_exec('/usr/local/bin/ui-pingNODE $nodeNUM');
die();
?>
