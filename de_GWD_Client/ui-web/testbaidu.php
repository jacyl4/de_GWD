<?php ob_start(ob_gzhandler); ?> 
<?php
echo shell_exec('/usr/local/bin/ui-testbaidu');
?>
<?php ob_end_flush(); ?> 