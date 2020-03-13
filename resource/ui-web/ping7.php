<?php
putenv("nodeNUM=7");
echo shell_exec('/usr/local/bin/pingNODE $nodeNUM');
die();
?>
