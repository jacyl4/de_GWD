<?php
putenv("nodeNUM=7");
echo shell_exec('/usr/local/bin/ui-pingICMP $nodeNUM');
die();
?>
