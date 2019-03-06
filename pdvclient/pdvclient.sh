#!/bin/bash
clear
function blue()   { echo -e "\033[34m\033[01m $1 \033[0m"; }
function yellow() { echo -e "\033[33m\033[01m $1 \033[0m"; }
function green()  { echo -e "\033[32m\033[01m $1 \033[0m"; }
function red()    { echo -e "\033[31m\033[01m $1 \033[0m"; }


architecture=""
case $(uname -m) in
    x86_64)  architecture="amd64" ;;
    aarch64)  architecture="aarch64" ;;
esac



performance_mod(){
sed -i '/GRUB_CMDLINE_LINUX_DEFAULT=/c\GRUB_CMDLINE_LINUX_DEFAULT="quiet splash zswap.enabled=1 zswap.compressor=lz4"'  /etc/default/grub
update-grub
echo "net.ipv4.ip_forward = 1" >> /etc/sysctl.conf
echo "net.ipv4.tcp_fastopen = 3" >> /etc/sysctl.conf
echo "net.ipv4.tcp_syn_retries = 2" >> /etc/sysctl.conf
echo "net.ipv4.tcp_max_syn_backlog = 16384" >> /etc/sysctl.conf
echo "net.ipv4.tcp_synack_retries = 2" >> /etc/sysctl.conf
echo "net.ipv4.tcp_timestamps = 0" >> /etc/sysctl.conf
echo "net.ipv4.tcp_fin_timeout = 10" >> /etc/sysctl.conf

echo "net.ipv4.tcp_keepalive_time = 600" >> /etc/sysctl.conf
echo "net.ipv4.tcp_keepalive_intvl = 60" >> /etc/sysctl.conf
echo "net.ipv4.tcp_keepalive_probes = 20" >> /etc/sysctl.conf

echo "fs.file-max = 99000" >> /etc/sysctl.conf
echo "net.core.default_qdisc=fq" >> /etc/sysctl.conf
echo "net.ipv4.tcp_congestion_control = bbr" >> /etc/sysctl.conf
sysctl -p

if [[ $architecture = "aarch64" ]]; then
sed -i '/GOVERNOR=/c\GOVERNOR=performance' /etc/default/cpufrequtils
/etc/init.d/cpufrequtils restart;
fi
blue  "优化性能与网络 [完毕]"
}



install_gatewayrouter(){
curl -sSL https://install.pi-hole.net | bash

wget https://raw.githubusercontent.com/jacyl4/linux-router/master/pdvclient/doh-$architecture/doh-client
wget https://raw.githubusercontent.com/jacyl4/linux-router/master/pdvclient/doh-client.conf
wget https://raw.githubusercontent.com/jacyl4/linux-router/master/pdvclient/doh-$architecture/doh-client.service
mkdir /etc/dns-over-https
mv doh-client /usr/local/bin/
mv doh-client.conf /etc/dns-over-https/doh-client.conf
mv doh-client.service /etc/systemd/system/
chmod 777 /usr/local/bin/doh-client
chmod 777 /etc/dns-over-https/doh-client.conf
chmod 777 /etc/systemd/system/doh-client.service
systemctl daemon-reload
systemctl restart doh-client
systemctl enable doh-client

sed -i '/PIHOLE_DNS_1=/c\PIHOLE_DNS_1=114.114.114.114#53'  /etc/pihole/setupVars.conf
sed -i '/PIHOLE_DNS_2=/c\PIHOLE_DNS_2=127.0.0.1#5380'  /etc/pihole/setupVars.conf

sed -i '/server='/d  /etc/dnsmasq.d/01-pihole.conf
echo "server=114.114.114.114#53" >> /etc/dnsmasq.d/01-pihole.conf
echo "server=127.0.0.1#5380" >> /etc/dnsmasq.d/01-pihole.conf

systemctl stop systemd-resolved
systemctl disable systemd-resolved
pihole restartdns
systemctl restart pihole-FTL

bash <(curl -L -s https://install.direct/go.sh)
echo "" > /etc/v2ray/config.json
wget https://raw.githubusercontent.com/jacyl4/linux-router/master/pdvclient/v2wt-client.json
mv -f v2wt-client.json /etc/v2ray/config.json
systemctl restart v2ray
systemctl enable v2ray



apt-get install -y net-tools ipset
cat > /etc/chnroute.sh << "EOF"
#!/bin/bash
curl 'http://ftp.apnic.net/apnic/stats/apnic/delegated-apnic-latest' | grep ipv4 | grep CN | awk -F\| '{ printf("%s/%d\n", $4, 32-log($5)/log(2)) }' > /etc/chnroute.txt

bash <(curl -L -s https://install.direct/go.sh)

EOF
chmod +x /etc/chnroute.sh
/etc/chnroute.sh
crontab -l > now.cron
echo '0 0 * * * /etc/chnroute.sh' >> now.cron
crontab now.cron

cat > /etc/init.d/iptables-proxy-rr << "EOF"
#! /bin/sh

### BEGIN INIT INFO
# Provides: iptables-proxy-rr
# Required-Start: $network $remote_fs $local_fs
# Required-Stop: $network $remote_fs $local_fs
# Default-Start: 2 3 4 5
# Default-Stop: 0 1 6
# Short-Description: iptables-proxy-rr
# Description: iptables-proxy-rr
### END INIT INFO
ip rule add fwmark 1 table 100
ip route add local 0.0.0.0/0 dev lo table 100
EOF
chmod 755 /etc/init.d/iptables-proxy-rr
update-rc.d iptables-proxy-rr defaults

mkdir /etc/iptables-proxy
cat > /etc/iptables-proxy/iptables-proxy-up.sh << "EOF"
#!/bin/bash

ipset -N chnroute hash:net maxelem 65536

for ip in $(cat '/etc/chnroute.txt'); do
  ipset add chnroute $ip
done

iptables -t mangle -N V2RAYOUT
iptables -t mangle -N V2RAYPRE
iptables -t nat    -N V2RAYOUT
iptables -t nat    -N V2RAYPRE

iptables -t mangle -A OUTPUT     -j V2RAYOUT
iptables -t mangle -A PREROUTING -j V2RAYPRE
iptables -t nat    -A OUTPUT     -j V2RAYOUT
iptables -t nat    -A PREROUTING -j V2RAYPRE

iptables -t mangle -N V2RAY
iptables -t mangle -A V2RAY -p tcp -j RETURN -m mark --mark 0xff
iptables -t mangle -A V2RAY -p udp -j RETURN -m mark --mark 0xff

iptables -t mangle -A V2RAY -d 0.0.0.0/8 -j RETURN
iptables -t mangle -A V2RAY -d 10.0.0.0/8 -j RETURN
iptables -t mangle -A V2RAY -d 127.0.0.0/8 -j RETURN
iptables -t mangle -A V2RAY -d 169.254.0.0/16 -j RETURN
iptables -t mangle -A V2RAY -d 172.16.0.0/12 -j RETURN
iptables -t mangle -A V2RAY -d 192.168.0.0/16 -j RETURN
iptables -t mangle -A V2RAY -d 224.0.0.0/4 -j RETURN
iptables -t mangle -A V2RAY -d 240.0.0.0/4 -j RETURN
iptables -t mangle -A V2RAY -p tcp -m set --match-set chnroute dst -j RETURN
iptables -t mangle -A V2RAY -p udp -m set --match-set chnroute dst -j RETURN

iptables -t mangle -A V2RAY -p tcp -j MARK --set-mark 1
iptables -t mangle -A V2RAY -p udp -j MARK --set-mark 1

iptables -t mangle -A V2RAYOUT -p tcp -j V2RAY
iptables -t mangle -A V2RAYOUT -p udp -j V2RAY

iptables -t mangle -A V2RAYPRE -p tcp -m mark ! --mark 1 -j V2RAY
iptables -t mangle -A V2RAYPRE -p udp -m mark ! --mark 1 -j V2RAY

iptables -t mangle -A V2RAYPRE -p tcp -m mark --mark 1 -j TPROXY --on-ip 127.0.0.1 --on-port 1080
iptables -t mangle -A V2RAYPRE -p udp -m mark --mark 1 -j TPROXY --on-ip 127.0.0.1 --on-port 1080
systemctl restart v2ray
EOF
chmod +x /etc/iptables-proxy/iptables-proxy-up.sh

cat > /etc/iptables-proxy/iptables-proxy-down.sh << EOF
#!/bin/bash
systemctl stop v2ray

iptables -F
iptables -X
iptables -t nat -F
iptables -t nat -X
iptables -t mangle -F
iptables -t mangle -X

ipset destroy chnroute
EOF
chmod +x /etc/iptables-proxy/iptables-proxy-down.sh

cat > /etc/systemd/system/iptables-proxy.service << EOF
[Unit]
Description=iptables-proxy
Requires=network.target network-online.target
After=network-online.target pihole-FTL.service
Wants=network-online.target

[Service]
Type=oneshot
RemainAfterExit=yes
ExecStart=/etc/iptables-proxy/iptables-proxy-up.sh
ExecStop=/etc/iptables-proxy/iptables-proxy-down.sh

[Install]
WantedBy=multi-user.target
EOF
systemctl daemon-reload
systemctl enable iptables-proxy.service

sed -i '/static ip_address='/d  /etc/dhcpcd.conf
sed -i '/static routers='/d  /etc/dhcpcd.conf
sed -i '/static domain_name_servers='/d  /etc/dhcpcd.conf

    green "================="
    green " 本机地址"
    green "================="
    read localaddr

    green "================="
    green " 上级路由地址"
    green "================="
    read gatewayaddr

ethernetnum="$(awk 'END {print $NF}' /etc/dhcpcd.conf)"

cat > /etc/network/interfaces << EOF
auto lo
iface lo inet loopback

auto $ethernetnum
iface $ethernetnum inet static
address $localaddr
netmask 255.255.255.0
gateway $gatewayaddr
EOF

sed -i "/IPV4_ADDRESS=/c\IPV4_ADDRESS=$localaddr/24"  /etc/pihole/setupVars.conf
sed -i '/nameserver/c\nameserver 127.0.0.1'  /etc/resolv.conf
systemctl stop dhcpcd
/lib/systemd/systemd-sysv-install disable dhcpcd
blue  "安装pihole+doh+v2ray+route [完毕]"
}



change_piholeadmin(){
pihole -a -p
blue  "更改Pi-hole密码 [完毕]"
}



update_pihole(){
pihole -up
systemctl stop dhcpcd
/lib/systemd/systemd-sysv-install disable dhcpcd
blue  "更新Pi-hole [完毕]"
}

update_doh(){
read -p "输入DoH地址1:" doh1
read -p "输入DoH地址2:" doh2

sed -i '/upstream_ietf/{n;s/.*/"https:\/\/'$doh1',"/;n;s/.*/"https:\/\/'$doh2',"/}' /etc/dns-over-https/doh-client.conf
blue  "更改DoH地址 [完毕]"
}


change_staticip(){
    green "================="
    green " 本机地址"
    green "================="
    read localaddr

    green "================="
    green " 上级地址"
    green "================="
    read gatewayaddr

sed -i "/address/c\address $localaddr"  /etc/network/interfaces
sed -i "/gateway/c\gateway $gatewayaddr"  /etc/network/interfaces

sed -i '/static ip_address=/d'  /etc/dhcpcd.conf
sed -i '/static routers=/d'  /etc/dhcpcd.conf
sed -i '/static domain_name_servers=/d'  /etc/dhcpcd.conf
sed -i "/IPV4_ADDRESS=/c\IPV4_ADDRESS=$localaddr/24"  /etc/pihole/setupVars.conf
sed -i '/nameserver/c\nameserver 127.0.0.1'  /etc/resolv.conf
systemctl stop dhcpcd
/lib/systemd/systemd-sysv-install disable dhcpcd
blue  "更改静态IP [完毕]"
}



change_v2ray(){
    green "====================="
    green " 是否更改 v2ray uuid?"
    green "====================="
    read -p "需要修改请按“y” ， 跳过按 回车:" uuidyn
if [ "$uuidyn" == "y" ]; then 
    green "=================="
    green " 请输入 v2ray uuid"
    green "=================="
    read uuidnum
sed -i '/"id":/c\"id": "'$uuidnum'",'  /etc/v2ray/config.json
fi

    green "==============="
    green " 是否更改 path?"
    green "==============="
    read -p "需要修改请按“y” ， 跳过按 回车:" pathyn
if [ "$pathyn" == "y" ]; then 
    green "==============="
    green " 请输入 path"
    green "==============="
    read v2path
sed -i '/"path":/c\"path": "'$v2path'",'  /etc/v2ray/config.json
fi

    green "==============="
    green " v2ray节点域名"
    green "==============="
    read v2servn

sed -i '/"address":/c\"address": "'$v2servn'",'  /etc/v2ray/config.json
sed -i '/"serverName":/c\"serverName": "'$v2servn'",'  /etc/v2ray/config.json
sed -i '/"Host":/c\"Host": "'$v2servn'"'  /etc/v2ray/config.json
systemctl restart v2ray
blue  "更改v2ray节点 [完毕]"
}






start_menu(){
    green "============================================"
    green "              客户端                       "
    green "介绍：一条龙安装v2ray+doh+pihole+透明网关路由 "
    green "系统：Debian9 (amd64 & aarch64)            "
    green "作者：jacyl4                               "
    green "网站：jacyl4.github.io                     "
    green "============================================"
    echo
    green  "1. 优化性能与网络"
    green  "2. 安装pihole+doh+v2ray+route"
    green  " 3. 更改Pi-hole密码"
    green  "  4. 更新Pi-hole"
    green  "   5. 更改DoH地址"
    green  "    6. 更改静态IP"
    red    "7. 重启"
    yellow "0. 更改v2ray节点"
    yellow "CTRL+C退出"
    echo
    read -p "请输入数字:" num
    case "$num" in
    1)
    performance_mod
    start_menu
    ;;
    2)
    install_gatewayrouter
    start_menu
    ;;
    3)
    change_piholeadmin
    start_menu 
    ;;
    4)
    update_pihole
    start_menu 
    ;;
    5)
    update_doh
    start_menu 
    ;;
    6)
    change_staticip
    start_menu 
    ;;
    7)
    reboot
    ;;
    0)
    change_v2ray
    start_menu
    ;;
    *)
    clear
    red "请输入正确数字"
    sleep 1s
    start_menu
    ;;
    esac
}

start_menu