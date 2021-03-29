#!/bin/bash
clear
red()    { echo -e "\033[31m\033[01m $1 \033[0m"; }
green()  { echo -e "\033[32m\033[01m $1 \033[0m"; }
yellow() { echo -e "\033[33m\033[01m $1 \033[0m"; }
blue()   { echo -e "\033[34m\033[01m $1 \033[0m"; }
purple() { echo -e "\033[35m\033[01m $1 \033[0m"; }
cyan()   { echo -e "\033[36m\033[01m $1 \033[0m"; }
white()  { echo -e "\033[37m\033[01m $1 \033[0m"; }


FRPtoken=$1
FRPbindPort=$2
FRPbindProtocol=$3



if [[ $FRPbindProtocol = "TCP" ]]; then
bind_port="bind_port = $FRPbindPort"
elif [[ $FRPbindProtocol = "KCP" ]]; then
bind_port=`cat << EOF
bind_port = $FRPbindPort
kcp_bind_port = $FRPbindPort
EOF
`
fi

installFRPs(){
wget --no-check-certificate --show-progress -cqO /tmp/frp.tar.gz https://gwd.seso.icu:10284/amd64_frp.tar.gz
tar zxvf /tmp/frp.tar.gz -C /tmp/

mkdir -p /opt/de_GWD/frp
mv -f /tmp/frp_*/frps /opt/de_GWD/frp/frps


cat << EOF >/opt/de_GWD/frp/frps.ini
[common]
bind_addr = 0.0.0.0
$bind_port
token = $FRPtoken
EOF

rm -rf /etc/systemd/system/frps.service
cat << EOF >/lib/systemd/system/frps.service
[Unit]
Description=Frp Server Service
After=network.target

[Service]
User=root
Type=simple
ExecStart=/opt/de_GWD/frp/frps -c /opt/de_GWD/frp/frps.ini
AmbientCapabilities=CAP_NET_RAW CAP_NET_ADMIN CAP_NET_BIND_SERVICE
CapabilityBoundingSet=CAP_NET_RAW CAP_NET_ADMIN CAP_NET_BIND_SERVICE
LimitNOFILE=1000000
LimitNPROC=infinity
LimitCORE=infinity
NoNewPrivileges=true
Restart=always
RestartSec=1

[Install]
WantedBy=multi-user.target
EOF
systemctl daemon-reload >/dev/null
systemctl enable frps >/dev/null
systemctl restart frps >/dev/null


chmod -R 755 /opt/de_GWD/frp
chown -R root:root /opt/de_GWD/frp

rm -rf /tmp/frp*
blue "--------------------"
blue  "install FRP [done]"
blue "--------------------"
}

uninstallFRPs(){
systemctl stop frps
rm -rf /etc/systemd/system/frps.service
rm -rf /lib/systemd/system/frps.service
systemctl daemon-reload >/dev/null

rm -rf /opt/de_GWD/frp
blue "--------------------"
blue  "uninstall FRP [done]"
blue "--------------------"
}

start_menu(){
statusGOOD=$(green "✓")
statusBAD=$(red "✕")

if [[ $(systemctl is-active frps) = "active" ]]; then
    echo " [$statusGOOD] FRP         [working]"
elif [[ ! -f "/opt/de_GWD/frp/frps" ]]; then
    echo " [$statusBAD] FRP         [not Installed]"
else
    echo " [$statusBAD] FRP         [start failed]"
fi

    green "==============================="
    green "         FRPs"
    green "==============================="
    green  "1. Install FRPs"
    yellow "2. Uninnstall FRPs"
    echo ""
    read -p "Select:" num
    case "$num" in
    1)
    installFRPs
    start_menu
    ;;
    2)
    uninstallFRPs
    start_menu
    ;;
    *)
    clear
    red "Wrong number"
    sleep 1s
    start_menu
    ;;
    esac
}

start_menu