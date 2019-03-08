#!/bin/bash
clear
function blue()   { echo -e "\033[34m\033[01m $1 \033[0m"; }
function yellow() { echo -e "\033[33m\033[01m $1 \033[0m"; }
function green()  { echo -e "\033[32m\033[01m $1 \033[0m"; }
function red()    { echo -e "\033[31m\033[01m $1 \033[0m"; }


performance_mod(){
sed -i '/GRUB_CMDLINE_LINUX_DEFAULT=/c\GRUB_CMDLINE_LINUX_DEFAULT="quiet splash zswap.enabled=1 zswap.compressor=lz4"'  /etc/default/grub
update-grub
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
echo "net.ipv4.tcp_congestion_control = bbrplus" >> /etc/sysctl.conf
sysctl -p
}



install_pihole+doh+v2ray(){
    green "==========================="
    green " 输入此VPS的域名(不加www开头)"
    green "==========================="
    read vpsdomain

    green "================="
    green " 此VPS有几个线程"
    green "================="
    read workprocess

    green "============"
    green " v2ray uuid"
    green "============"
    read uuidnum

    green "========================"
    green " v2ray path (格式：/xxxx)"
    green "========================"
    read v2path

sed -i "/worker_processes auto;/c\worker_processes $workprocess;"  /usr/local/nginx/conf/nginx.conf

cat > /usr/local/nginx/conf/ssl/$vpsdomain/update_ocsp_cache.sh << EOF
#!/bin/bash
wget -O intermediate.pem https://letsencrypt.org/certs/lets-encrypt-x3-cross-signed.pem
wget -O root.pem https://ssl-tools.net/certificates/dac9024f54d8f6df94935fb1732638ca6ad77c13.pem
mv -f intermediate.pem /usr/local/nginx/conf/ssl/$vpsdomain/
mv -f root.pem /usr/local/nginx/conf/ssl/$vpsdomain/
cat /usr/local/nginx/conf/ssl/$vpsdomain/intermediate.pem > /usr/local/nginx/conf/ssl/$vpsdomain/bundle.pem
cat /usr/local/nginx/conf/ssl/$vpsdomain/root.pem >> /usr/local/nginx/conf/ssl/$vpsdomain/bundle.pem

openssl ocsp -no_nonce \
    -issuer  /usr/local/nginx/conf/ssl/$vpsdomain/intermediate.pem \
    -cert    /usr/local/nginx/conf/ssl/$vpsdomain/fullchain.cer \
    -CAfile  /usr/local/nginx/conf/ssl/$vpsdomain/bundle.pem \
    -VAfile  /usr/local/nginx/conf/ssl/$vpsdomain/bundle.pem \
    -url     http://ocsp.int-x3.letsencrypt.org \
    -respout /usr/local/nginx/conf/ssl/$vpsdomain/ocsp.resp
EOF
chmod +x /usr/local/nginx/conf/ssl/$vpsdomain/update_ocsp_cache.sh
/usr/local/nginx/conf/ssl/$vpsdomain/update_ocsp_cache.sh

cat > /usr/local/updatepdv.sh << EOF
#!/bin/bash
bash <(curl -L -s https://install.direct/go.sh)
EOF

crontab -l > now.cron
echo '0 0 * * 7 /usr/local/nginx/conf/ssl/$vpsdomain/update_ocsp_cache.sh' >> now.cron
echo '0 0 * * * /usr/local/updatepdv.sh' >> now.cron
crontab now.cron

cat > /usr/local/nginx/conf/vhost/$vpsdomain.conf<< EOF
upstream dns-backend { server 127.0.0.1:8053; }

server {
  listen 80;
  server_name $vpsdomain www.$vpsdomain;
  root  /home/wwwroot/$vpsdomain;
  index index.html index.htm index.php default.html default.htm default.php;

  include rewrite/none.conf;
  #error_page   404   /404.html;

  # Deny access to PHP files in specific directory
  #location ~ /(wp-content|uploads|wp-includes|images)/.*\.php$ { deny all; }

  include enable-php-pathinfo.conf;

  location ~ .*\.(gif|jpg|jpeg|png|bmp|swf)$
  {
      expires      30d;
  }

  location ~ .*\.(js|css)?$
  {
      expires      12h;
  }

  location ~ /.well-known {
      allow all;
  }

  location ~ /\.
  {
      deny all;
  }

  access_log off;
}

server {
  listen 443 ssl http2;
  server_name $vpsdomain www.$vpsdomain;
  root  /home/wwwroot/$vpsdomain;
  index index.html index.htm index.php default.html default.htm default.php;

  ssl on;
  ssl_certificate /usr/local/nginx/conf/ssl/$vpsdomain/fullchain.cer;
  ssl_certificate_key /usr/local/nginx/conf/ssl/$vpsdomain/$vpsdomain.key;
  ssl_session_timeout 5m;
  ssl_protocols TLSv1 TLSv1.1 TLSv1.2;
  ssl_prefer_server_ciphers on;
  ssl_ciphers "EECDH+CHACHA20:EECDH+CHACHA20-draft:EECDH+AES128:RSA+AES128:EECDH+AES256:RSA+AES256:EECDH+3DES:RSA+3DES:!MD5";
  ssl_session_cache builtin:1000 shared:SSL:10m;
  ssl_dhparam /usr/local/nginx/conf/ssl/dhparam.pem;
  
  # OCSP Stapling ---
  ssl_stapling on;
  ssl_stapling_verify on;
  ssl_trusted_certificate /usr/local/nginx/conf/ssl/$vpsdomain/bundle.pem;
  ssl_stapling_file /usr/local/nginx/conf/ssl/$vpsdomain/ocsp.resp;
  resolver 8.8.8.8 valid=600s;
  resolver_timeout 5s;


  include rewrite/none.conf;
  #error_page   404   /404.html;

  # Deny access to PHP files in specific directory
  #location ~ /(wp-content|uploads|wp-includes|images)/.*\.php$ { deny all; }

  include enable-php-pathinfo.conf;

  location ~ .*\.(gif|jpg|jpeg|png|bmp|swf)$
  {
      expires      30d;
  }

  location ~ .*\.(js|css)?$
  {
      expires      12h;
  }

  location ~ /.well-known {
      allow all;
  }

  location ~ /\.
  {
      deny all;
  }

location /dq {
  proxy_redirect off;
  proxy_pass http://dns-backend/dq;
  proxy_http_version 1.1;
  proxy_set_header Upgrade \$http_upgrade;
  proxy_set_header Host "$vpsdomain";
  proxy_set_header X-NginX-Proxy true;
  proxy_set_header X-Forwarded-Proto \$scheme;
  proxy_set_header X-Real-IP \$remote_addr;
  proxy_set_header X-Forwarded-For \$proxy_add_x_forwarded_for;
  proxy_read_timeout 86400;
}

location $v2path {
  proxy_redirect off;
  proxy_pass http://127.0.0.1:11811;
  proxy_http_version 1.1;
  proxy_set_header Upgrade "WebSocket";
  proxy_set_header Connection "Upgrade";
  proxy_set_header Host "$vpsdomain";
  proxy_set_header X-Forwarded-Proto \$scheme;
  proxy_set_header X-Real-IP \$remote_addr;
  proxy_set_header X-Forwarded-For \$proxy_add_x_forwarded_for;
  proxy_intercept_errors on;
  proxy_connect_timeout 300;
  proxy_send_timeout 300;
  proxy_read_timeout 600;
  proxy_buffer_size 512k;
  proxy_buffers 8 512k;
  proxy_busy_buffers_size 512k;
  proxy_temp_file_write_size 512k;
  proxy_max_temp_file_size 128m;
}
  access_log off;
}
EOF
mkdir /etc/systemd/system/nginx.service.d
printf "[Service]\nExecStartPost=/bin/sleep 0.1\n" > /etc/systemd/system/nginx.service.d/override.conf
systemctl daemon-reload
systemctl restart nginx


curl -sSL https://install.pi-hole.net | bash
ethernetnum="$(awk 'NR==39{print $2}' /etc/dhcpcd.conf)"
localaddr="$(awk -F '[=]' 'NR==40{print $2}' /etc/dhcpcd.conf | cut -d '/' -f1)"
gatewayaddr="$(awk -F '[=]' 'NR==41{print $2}' /etc/dhcpcd.conf | cut -d '/' -f1)"
sed -i '/static ip_address=/d' /etc/dhcpcd.conf
sed -i '/static routers=/d' /etc/dhcpcd.conf
sed -i '/static domain_name_servers=/d' /etc/dhcpcd.conf
cat > /etc/network/interfaces << EOF
source /etc/network/interfaces.d/*

auto lo
iface lo inet loopback

auto $ethernetnum
iface $ethernetnum inet static
  address $localaddr
  netmask 255.255.255.0
  gateway $gatewayaddr
  mtu 1488
EOF
sed -i '/nameserver/c\nameserver 127.0.0.1'  /etc/resolv.conf
systemctl mask dhcpcd
systemctl mask systemd-resolved


apt-get install -y git make
wget https://dl.google.com/go/go1.11.5.linux-amd64.tar.gz
tar -xvf go1.11.5.linux-amd64.tar.gz
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
wget https://raw.githubusercontent.com/jacyl4/linux-router/master/pdvserver/doh-server.conf
mv -f doh-server.conf /etc/dns-over-https
systemctl restart doh-server
systemctl enable doh-server


bash <(curl -L -s https://install.direct/go.sh)
wget https://raw.githubusercontent.com/jacyl4/linux-router/master/pdvserver/v2wt-server.json
mv -f v2wt-server.json /etc/v2ray/config.json
sed -i '/"address":/c\"address": "'$vpsdomain'",'  /etc/v2ray/config.json
sed -i '/"serverName":/c\"serverName": "'$vpsdomain'",'  /etc/v2ray/config.json
sed -i '/"Host":/c\"Host": "'$vpsdomain'"'  /etc/v2ray/config.json
sed -i '/"id":/c\"id": "'$uuidnum'",'  /etc/v2ray/config.json
sed -i '/"path":/c\"path": "'$v2path'"'  /etc/v2ray/config.json
systemctl daemon-reload
systemctl restart v2ray
systemctl enable v2ray
}



update_pihole(){
curl -sSL https://install.pi-hole.net | bash
systemctl mask dhcpcd
systemctl mask systemd-resolved
}



start_menu(){
    green "========================================"
    green "              服务端                  "
    green "介绍：一条龙安装v2ray+ws+tls+doh+pihole "
    green "系统：Debian9                         "
    green "作者：jacyl4                          "
    green "网站：jacyl4.github.io                "
    green "========================================"
    echo
    green  "1. 优化性能与网络"
    green  "2. 安装pihole+doh+v2ray"
    green  "3. 更新Pi-hole"
    yellow "CTRL+C退出"
    echo
    read -p "请输入数字:" num
    case "$num" in
    1)
    performance_mod
    start_menu
    ;;
    2)
    install_pihole+doh+v2ray
    start_menu
    ;;
    3)
    update_pihole
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