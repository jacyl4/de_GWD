<?php
echo shell_exec("ping -n -c1 -w1 $(awk 'NR==3{print}' /var/www/html/domain.txt | cut -d : -f1) 2>&1 | grep 'time=' | cut -d = -f 4 | cut -d' ' -f 1");
die();
?>