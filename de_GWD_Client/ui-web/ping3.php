<?php ob_start(ob_gzhandler); ?> 
<?php
system("ping -c 1 $(awk 'NR==3{print}' /var/www/html/domain.txt) 2>&1 | grep 'time=' | cut -d = -f 4 | cut -d' ' -f 1");
?>
<?php ob_end_flush(); ?> 