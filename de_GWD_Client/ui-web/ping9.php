<?php
echo shell_exec("ping -c 1 $(awk 'NR==9{print}' /var/www/html/domain.txt) 2>&1 | grep rtt | awk -F'=' '{print $2}' | cut -d . -f 1");
?>