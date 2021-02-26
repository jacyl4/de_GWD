<?php
putenv("dohNUM=1");
passthru('sudo /opt/de_GWD/ui-pingTCPDOH $dohNUM');
die();
?>
