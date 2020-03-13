<?php
putenv("nodeNUM=2");
echo shell_exec('/usr/local/bin/pingNODE $nodeNUM');
die();
?>
