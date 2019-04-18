<?php ob_start(ob_gzhandler); ?> 
<?php
echo shell_exec('/usr/local/bin/ui-testgoogle');
?>
<?php ob_end_flush(); ?> 