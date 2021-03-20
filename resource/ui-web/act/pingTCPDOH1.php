<?php
putenv("dohNUM=1");
passthru('/opt/de_GWD/ui-pingTCPDOH $dohNUM');
die();
?>
