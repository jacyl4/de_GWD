<?php
putenv("nodeNUM=8");
echo shell_exec('/usr/local/bin/ui-pingICMP $nodeNUM');
die();
?>
