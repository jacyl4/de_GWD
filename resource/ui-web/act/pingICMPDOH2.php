<?php
putenv("dohNUM=2");
system('sudo /usr/local/bin/ui-pingICMPDOH $dohNUM');
die();
?>
