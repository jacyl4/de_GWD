<?php ob_start(ob_gzhandler); ?> 
<?php
echo shell_exec("ping -c 1 $(awk 'NR==7{print}' /var/www/html/domain.txt) 2>&1 | grep 'time=' | cut -d = -f 4 | cut -d' ' -f 1");
?>
<?php ob_end_flush(); ?> 