<?php
putenv("dohNUM=2");
system('sudo /opt/de_GWD/ui-pingICMPDOH $dohNUM');
die();
?>
