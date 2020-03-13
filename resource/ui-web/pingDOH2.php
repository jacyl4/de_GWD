<?php
putenv("dohNUM=2");
echo shell_exec('/usr/local/bin/pingDOH $dohNUM');
die();
?>
