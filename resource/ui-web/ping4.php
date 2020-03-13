<?php
putenv("nodeNUM=4");
echo shell_exec('/usr/local/bin/pingNODE $nodeNUM');
die();
?>
