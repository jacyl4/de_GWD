<?php
echo shell_exec("ping -c 1 $(awk 'NR==2{print}' /var/www/html/domain.txt | cut -d : -f1) 2>&1 | grep 'time=' | cut -d = -f 4 | cut -d' ' -f 1");
?>