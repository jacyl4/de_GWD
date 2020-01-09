<?php
echo shell_exec("ping -n -c1 -w1 $(awk '/https:/' /etc/dns-over-https/doh-client.conf | awk -F'//' 'NR==1{print $2}' | cut -d'/' -f1) 2>&1 | grep 'time=' | cut -d = -f 4 | cut -d' ' -f 1");
die();
?>