<?php
putenv("dohNUM=1");
echo shell_exec('/usr/local/bin/pingDOH $dohNUM');
die();
?>
