<?php
putenv("dohNUM=2");
passthru('sudo /opt/de_GWD/ui-pingTCPDOH $dohNUM');
die();
?>
