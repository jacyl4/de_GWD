<?php
putenv("dohNUM=2");
echo shell_exec('/usr/local/bin/ui-pingDOH $dohNUM');
die();
?>
