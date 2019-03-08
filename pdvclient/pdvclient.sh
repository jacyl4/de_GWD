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

if [ $architecture = "aarch64" ]; then
sed -i '/GOVERNOR=/c\GOVERNOR=performance' /etc/default/cpufrequtils
/etc/init.d/cpufrequtils restart;
fi
blue  "优化性能与网络 [完毕]"
}



install_gatewayrouter(){
    green "==============="
    green "本机地址"
    green "==============="
    read localaddr

    green "==============="
    green "上级路由地址"
    green "==============="
    read gatewayaddr

    green "==============="
    green "v2ray节点域名"
    green "==============="
    read v2servn
    
    green "==============="
    green "输入v2ray uuid"
    green "==============="
    read uuidnum

    green "==============="
    green "输入path"
    green "==============="
    read v2path

bash <(curl -L -s https://install.direct/go.sh)
wget https://raw.githubusercontent.com/jacyl4/linux-router/master/pdvclient/v2wt-client.json
mv -f v2wt-client.json /etc/v2ray/config.json
sed -i '/"address":/c\"address": "'$v2servn'",'  /etc/v2ray/config.json
sed -i '/"serverName":/c\"serverName": "'$v2servn'",'  /etc/v2ray/config.json
sed -i '/"Host":/c\"Host": "'$v2servn'"'  /etc/v2ray/config.json
sed -i '/"id":/c\"id": "'$uuidnum'",'  /etc/v2ray/config.json
sed -i '/"path":/c\"path": "'$v2path'",'  /etc/v2ray/config.json
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
systemctl enable iptables-proxy.service



apt-get install -y git make
if [ $architecture = "aarch64" ]; then
wget https://dl.google.com/go/go1.11.5.linux-arm64.tar.gz
tar -xvf go1.11.5.linux-arm64.tar.gz
elif [ $architecture = "amd64" ]; then
wget https://dl.google.com/go/go1.11.5.linux-amd64.tar.gz
tar -xvf go1.11.5.linux-amd64.tar.gz
fi
mv go /usr/local
mkdir ~/gopath
cat >> ~/.profile << "EOF"
export GOROOT=/usr/local/go
export GOPATH=~/gopath
export PATH=$GOPATH/bin:$GOROOT/bin:$PATH
EOF
source ~/.profile
git clone https://github.com/m13253/dns-over-https.git
cd dns-over-https
make && make install
wget https://raw.githubusercontent.com/jacyl4/linux-router/master/pdvclient/doh-client.conf
mv -f doh-client.conf /etc/dns-over-https/
systemctl restart doh-client
systemctl enable doh-client



curl -sSL https://install.pi-hole.net | bash
sed -i '/PIHOLE_DNS_1=/c\PIHOLE_DNS_1=114.114.114.114#53'  /etc/pihole/setupVars.conf
sed -i '/PIHOLE_DNS_2=/c\PIHOLE_DNS_2=127.0.0.1#5380'  /etc/pihole/setupVars.conf
sed -i '/server=/d'  /etc/dnsmasq.d/01-pihole.conf
echo "server=114.114.114.114#53" >> /etc/dnsmasq.d/01-pihole.conf
echo "server=127.0.0.1#5380" >> /etc/dnsmasq.d/01-pihole.conf
sed -i '/static ip_address=/d' /etc/dhcpcd.conf
sed -i '/static routers=/d' /etc/dhcpcd.conf
sed -i '/static domain_name_servers=/d' /etc/dhcpcd.conf
sed -i "/IPV4_ADDRESS=/c\IPV4_ADDRESS=$localaddr/24"  /etc/pihole/setupVars.conf
ethernetnum="$(awk 'NR==39{print $2}' /etc/dhcpcd.conf)"
cat > /etc/network/interfaces << EOF
source /etc/network/interfaces.d/*

auto lo
iface lo inet loopback

auto $ethernetnum
iface $ethernetnum inet static
  address $localaddr
  netmask 255.255.255.0
  gateway $gatewayaddr
EOF
sed -i '/nameserver/c\nameserver 127.0.0.1'  /etc/resolv.conf
pihole restartdns
systemctl restart pihole-FTL
systemctl mask dhcpcd
systemctl mask systemd-resolved
blue  "安装v2ray+doh+pihole+route [完毕]"
}



change_piholeadmin(){
pihole -a -p
blue  "更改Pi-hole密码 [完毕]"
}



update_pihole(){
pihole -up
systemctl mask dhcpcd
systemctl mask systemd-resolved
blue  "更新Pi-hole [完毕]"
}

update_doh(){
read -p "输入DoH地址1:" doh1
read -p "输入DoH地址2:" doh2

sed -i '/upstream_ietf/{n;s/.*/"https:\/\/'$doh1',"/;n;s/.*/"https:\/\/'$doh2',"/}' /etc/dns-over-https/doh-client.conf
blue  "更改DoH地址 [完毕]"
}


change_staticip(){
    green "====================="
    green "本机地址（回车跳过）"
    green "====================="
    read localaddr
if [ "$localaddr" != "" ]; then 
sed -i "/address/c\address $localaddr"  /etc/network/interfaces
sed -i "/IPV4_ADDRESS=/c\IPV4_ADDRESS=$localaddr/24"  /etc/pihole/setupVars.conf
fi

    green "====================="
    green "上级地址（回车跳过）"
    green "====================="
    read gatewayaddr
if [ "$gatewayaddr" != "" ]; then 
sed -i "/gateway/c\gateway $gatewayaddr"  /etc/network/interfaces
fi

sed -i '/nameserver/c\nameserver 127.0.0.1'  /etc/resolv.conf
sed -i '/static ip_address=/d'  /etc/dhcpcd.conf
sed -i '/static routers=/d'  /etc/dhcpcd.conf
sed -i '/static domain_name_servers=/d'  /etc/dhcpcd.conf
systemctl mask dhcpcd
systemctl mask systemd-resolved
blue  "更改静态IP [完毕]"
}



change_v2ray(){
    green "==============="
    green "v2ray节点域名"
    green "==============="
    read v2servn
    
    green "=========================="
    green "输入v2ray uuid （回车跳过）"
    green "=========================="
    read uuidnum
if [ "$uuidnum" != "" ]; then 
sed -i '/"id":/c\"id": "'$uuidnum'",'  /etc/v2ray/config.json
fi

    green "===================="
    green "输入path （回车跳过）"
    green "===================="
    read v2path
if [ "$v2path" != "" ]; then 
sed -i '/"path":/c\"path": "'$v2path'",'  /etc/v2ray/config.json
fi

sed -i '/"address":/c\"address": "'$v2servn'",'  /etc/v2ray/config.json
sed -i '/"serverName":/c\"serverName": "'$v2servn'",'  /etc/v2ray/config.json
sed -i '/"Host":/c\"Host": "'$v2servn'"'  /etc/v2ray/config.json
systemctl restart v2ray
blue  "更改v2ray节点 [完毕]"
}


switch_ipotables_proxy(){
    green "======================"
    green "Y.启动代理 / N.停止代理"
    green "======================"
    read iptablesproxyyn
if [ "$iptablesproxyyn" = "Y" ] & [ "$iptablesproxyyn" = "y" ]; then
systemctl restart iptables-proxy
blue  "[代理已启动]";
elif [ "$iptablesproxyyn" = "N" ] & [ "$iptablesproxyyn" = "n" ]; then
systemctl stop iptables-proxy
blue  "[代理已关闭]";
fi
}




start_menu(){
    green "============================================"
    green "              客户端                       "
    green "介绍：一条龙安装v2ray+pihole+doh+透明网关路由 "
    green "系统：Debian9 (amd64 & aarch64)            "
    green "作者：jacyl4                               "
    green "网站：jacyl4.github.io                     "
    green "============================================"
    echo
    green  "1. 优化性能与网络"
    green  "2. 安装v2ray+doh+pihole+route"
    green  " 3. 更改Pi-hole密码"
    green  "  4. 更新Pi-hole"
    green  "   5. 更改DoH地址"
    green  "    6. 更改静态IP"
    red    "9. 代理开关"
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
    9)
    switch_ipotables_proxy
    start_menu 
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