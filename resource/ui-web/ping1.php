<?php
echo shell_exec("ping -n -c1 -w1 $(jq -r '.v2node[0].domain' /usr/local/bin/0conf | cut -d : -f1) 2>&1 | grep 'time=' | cut -d = -f 4 | cut -d' ' -f 1");
die();
?>