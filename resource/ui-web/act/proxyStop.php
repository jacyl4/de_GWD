<?php require_once('../auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
shell_exec('sudo systemctl stop v2dns');
shell_exec('sudo systemctl stop vtrui');
shell_exec('sudo systemctl stop iptables-proxy');
shell_exec('sudo yq w -i /opt/AdGuardHome/AdGuardHome.yaml dns.upstream_dns[0] "127.0.0.1:5310"');
shell_exec('sudo yq w -i /opt/AdGuardHome/AdGuardHome.yaml dns.bootstrap_dns[0] "127.0.0.1:5310"');
shell_exec('sudo systemctl restart AdGuardHome');

shell_exec('sudo rm -rf /etc/resolv.conf');
shell_exec('sudo rm -rf /run/resolvconf/interface');
shell_exec('sudo cat /dev/null > /etc/resolvconf/resolv.conf.d/head');
shell_exec('sudo cat /dev/null > /etc/resolvconf/resolv.conf.d/original');
shell_exec('sudo cat /dev/null > /etc/resolvconf/resolv.conf.d/tail');
shell_exec('sudo echo "nameserver 127.0.0.1" > /etc/resolvconf/resolv.conf.d/base');
shell_exec('sudo ln -fs /etc/resolvconf/run/resolv.conf /etc/resolv.conf');
shell_exec('sudo resolvconf -u');
?>
<?php }?>