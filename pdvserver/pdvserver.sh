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



install_nginx+tls+pihole+doh+v2ray(){
cd /tmp
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

apt-get install -y nginx socat

cat > /etc/nginx/nginx.conf << EOF
user  www www;
worker_processes $workprocess;

events {
    use epoll;
    worker_connections  51200;
    multi_accept on;
}

http {
  include mime.types;
  default_type application/octet-stream;

  sendfile on;
  tcp_nopush on;
  tcp_nodelay on;

  fastcgi_connect_timeout 300;
  fastcgi_send_timeout 300;
  fastcgi_read_timeout 300;
  fastcgi_buffer_size 64k;
  fastcgi_buffers 4 64k;
  fastcgi_busy_buffers_size 128k;
  fastcgi_temp_file_write_size 128k;

  types_hash_max_size 2048;
  server_names_hash_bucket_size 128;
  large_client_header_buffers 4 32k;
  client_header_buffer_size 32k;
  client_header_timeout 12;
  client_max_body_size 50m;
  client_body_timeout 12;
  keepalive_timeout 60;
  send_timeout 10;

  gzip              on;
  gzip_comp_level   2;
  gzip_min_length   1k;
  gzip_buffers      4 16k;
  gzip_http_version 1.1;
  gzip_proxied      expired no-cache no-store private auth;
  gzip_types        text/plain application/javascript application/x-javascript text/javascript text/css application/xml application/xml+rss;
  gzip_vary         on;
  gzip_proxied      expired no-cache no-store private auth;
  gzip_disable      "MSIE [1-6]\.";

  access_log off;
  error_log off;

  include /etc/nginx/conf.d/*.conf;
}
EOF

cat > /etc/nginx/conf.d/default.conf<< EOF
server {
    listen       80;
    server_name  $vpsdomain;
    root /var/www/html;
    index index.php index.html index.htm;
}
EOF

systemctl restart nginx

mkdir /var/www/ssl
curl https://get.acme.sh | sh
~/.acme.sh/acme.sh --issue -d $vpsdomain -w /var/www/html
~/.acme.sh/acme.sh --installcert -d $vpsdomain \
               --keypath       /var/www/ssl/$vpsdomain.key  \
               --fullchainpath /var/www/ssl/$vpsdomain.key.pem \
               --reloadcmd     "systemctl restart nginx"

openssl dhparam -out /var/www/ssl/dhparam.pem 2048

openssl x509 -outform der -in /var/www/ssl/$vpsdomain.key.pem -out /var/www/ssl/$vpsdomain.crt


cat > /var/www/ssl/update_ocsp_cache.sh << EOF
#!/bin/bash
wget -O intermediate.pem https://letsencrypt.org/certs/lets-encrypt-x3-cross-signed.pem
wget -O root.pem https://ssl-tools.net/certificates/dac9024f54d8f6df94935fb1732638ca6ad77c13.pem
mv intermediate.pem /var/www/ssl
mv root.pem /var/www/ssl
cat /var/www/ssl/intermediate.pem > /var/www/ssl/bundle.pem
cat /var/www/ssl/root.pem >> /var/www/ssl/bundle.pem

openssl ocsp -no_nonce \
    -issuer  /var/www/ssl/intermediate.pem \
    -cert    /var/www/ssl/$vpsdomain.key.pem \
    -CAfile  /var/www/ssl/bundle.pem \
    -VAfile  /var/www/ssl/bundle.pem \
    -url     http://ocsp.int-x3.letsencrypt.org \
    -respout /var/www/ssl/ocsp.resp
EOF
chmod +x /var/www/ssl/update_ocsp_cache.sh
/var/www/ssl/update_ocsp_cache.sh

cat > /usr/local/updatepdv.sh << EOF
#!/bin/bash
bash <(curl -L -s https://install.direct/go.sh)
EOF

crontab -l > now.cron
echo '0 0 * * 7 /var/www/ssl/update_ocsp_cache.sh' >> now.cron
echo '0 0 * * * /usr/local/updatepdv.sh' >> now.cron
crontab now.cron

cat > /etc/nginx/conf.d/default.conf<< EOF
upstream $vpsdomain {server 127.0.0.1:8053;}

server {
  listen 80;
  server_name $vpsdomain www.$vpsdomain;
  return 301 https://$vpsdomain\$request_uri;
  add_header X-Frame-Options SAMEORIGIN;

  access_log off;
}

server {
  listen 443 ssl http2;
  server_name $vpsdomain www.$vpsdomain;
  root /var/www/html;
  index index.html index.htm index.nginx-debian.html;

  ssl on;
  ssl_certificate /var/www/ssl/$vpsdomain.key.pem;
  ssl_certificate_key /var/www/ssl/$vpsdomain.key;
  ssl_session_timeout 5m;
  ssl_protocols TLSv1 TLSv1.1 TLSv1.2;
  ssl_prefer_server_ciphers on;
  ssl_ciphers "EECDH+CHACHA20:EECDH+CHACHA20-draft:EECDH+AES128:RSA+AES128:EECDH+AES256:RSA+AES256:EECDH+3DES:RSA+3DES:!MD5";
  ssl_session_cache builtin:1000 shared:SSL:10m;
  ssl_dhparam /var/www/ssl/dhparam.pem;
  
  # OCSP Stapling ---
  ssl_stapling on;
  ssl_stapling_verify on;
  ssl_trusted_certificate /var/www/ssl/bundle.pem;
  ssl_stapling_file /var/www/ssl/ocsp.resp;
  resolver 8.8.8.8 valid=600s;
  resolver_timeout 5s;

location /dq {
  proxy_set_header X-Real-IP \$remote_addr;
  proxy_set_header X-Forwarded-For \$proxy_add_x_forwarded_for;
  proxy_set_header Host \$http_host;
  proxy_set_header X-NginX-Proxy true;
  proxy_http_version 1.1;
  proxy_set_header Upgrade \$http_upgrade;
  proxy_redirect off;
  proxy_set_header        X-Forwarded-Proto \$scheme;
  proxy_read_timeout 86400;
  proxy_pass http://$vpsdomain/dq;
}

location $v2path {
  proxy_redirect off;
  proxy_pass http://127.0.0.1:11811;
  proxy_http_version 1.1;
  proxy_set_header Upgrade "WebSocket";
  proxy_set_header Connection "Upgrade";
  proxy_set_header Host "$vpsdomain";
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

wget https://raw.githubusercontent.com/jacyl4/linux-router/master/pdvserver/doh-amd64/doh-server
wget https://raw.githubusercontent.com/jacyl4/linux-router/master/pdvserver/doh-amd64/doh-server.conf
wget https://raw.githubusercontent.com/jacyl4/linux-router/master/pdvserver/doh-amd64/doh-server.service

mkdir /etc/dns-over-https
mv doh-server /usr/local/bin/
mv doh-server.conf /etc/dns-over-https/
mv doh-server.service /etc/systemd/system/

sed -i '/cert =/c\cert = "/var/www/ssl/'$vpsdomain'.key.pem"'  /etc/dns-over-https/doh-server.conf
sed -i '/key =/c\key = "/var/www/ssl/'$vpsdomain'.key"'  /etc/dns-over-https/doh-server.conf

chmod 777 /usr/local/bin/doh-server
chmod 777 /etc/dns-over-https/doh-server.conf
chmod 777 /etc/systemd/system/doh-server.service

chown -R root:staff /var/www/ssl

systemctl daemon-reload
systemctl restart doh-server
systemctl enable doh-server

systemctl stop systemd-resolved
systemctl disable systemd-resolved


bash <(curl -L -s https://install.direct/go.sh)
echo "" > /etc/v2ray/config.json
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
    green  "2. 安装nginx+tls+pihole+doh+v2ray"
    yellow "CTRL+C退出"
    echo
    read -p "请输入数字:" num
    case "$num" in
    1)
    performance_mod
    start_menu
    ;;
    2)
    install_nginx+tls+pihole+doh+v2ray
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