#!/bin/bash
clear
blue()   { echo -e "\033[34m\033[01m $1 \033[0m"; }
yellow() { echo -e "\033[33m\033[01m $1 \033[0m"; }
green()  { echo -e "\033[32m\033[01m $1 \033[0m"; }
red()    { echo -e "\033[31m\033[01m $1 \033[0m"; }


FRPbindPort=$1
FRPtoken=$2
FRPbindProtocol=$3

installCMD="bash <(wget --no-check-certificate -qO- https://gwd.seso.icu:10284/client_do)"

mirrorSite=$(echo $installCMD | awk '{print$5}' | sed 's?/client_do)??')



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
cd ~
wget --no-check-certificate -O ~/frp.tar.gz $mirrorSite/amd64_frp.tar.gz
tar zxvf ~/frp.tar.gz

mkdir -p /usr/local/bin/frp
mv -f ~/frp_*/frps /usr/local/bin/frp/frps


cat << EOF >/usr/local/bin/frp/frps.ini
[common]
bind_addr = 0.0.0.0
$bind_port
token = $FRPtoken
EOF

cat << EOF > /lib/systemd/system/frps.service
[Unit]
Description=Frp Server Service
After=network.target

[Service]
User=root
Type=simple
LimitNPROC=64000
LimitNOFILE=1000000
CapabilityBoundingSet=CAP_NET_RAW CAP_NET_ADMIN
ExecStart=/usr/local/bin/frp/frps -c /usr/local/bin/frp/frps.ini
Restart=always
RestartSec=2

[Install]
WantedBy=multi-user.target
EOF
systemctl daemon-reload
systemctl enable frps
systemctl restart frps


chmod -R 755 /usr/local/bin/frp
chown -R root:root /usr/local/bin/frp

rm -rf ~/frp*
blue "--------------------"
blue  "install FRP [done]"
blue "--------------------"
}

uninstallFRPs(){
systemctl stop frps
rm -rf /lib/systemd/system/frps.service
systemctl daemon-reload

rm -rf /usr/local/bin/frp
blue "--------------------"
blue  "uninstall FRP [done]"
blue "--------------------"
}

start_menu(){
statusGOOD=$(green "✓")
statusBAD=$(red "✕")

if [[ $(systemctl is-active frps) = "active" ]]; then
    echo " [$statusGOOD] FRP         [working]"
elif [[ ! -f "/usr/local/bin/frp/frps" ]]; then
    echo " [$statusBAD] FRP         [not Installed]"
else
    echo " [$statusBAD] FRP         [start failed]"
fi

    green "==============================="
    green "         FRPs"
    green "==============================="
    green  "1. Install FRPs"
    yellow  "2. Uninnstall FRPs"
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