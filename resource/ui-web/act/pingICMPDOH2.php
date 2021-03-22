<?php
putenv("dohNUM=2");
passthru('/opt/de_GWD/ui-pingICMPDOH $dohNUM &');
?>
