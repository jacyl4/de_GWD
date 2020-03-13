<?php
putenv("dohNUM=1");
echo shell_exec('/usr/local/bin/ui-pingDOH $dohNUM');
die();
?>
