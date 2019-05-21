![de_GWD](https://i.loli.net/2019/05/08/5cd295163b73a.png)

[详情](https://jacyl4.github.io/post/debian-gateway/)

### 服务端：
```
apt-get install -y curl
curl -O https://raw.githubusercontent.com/jacyl4/de_GWD/master/de_GWD_Server/server && chmod +x server && ./server
```
![服务端](https://i.loli.net/2019/04/19/5cb9b9980b216.png)

### 客户端：
```
wget --no-check-certificate https://raw.githubusercontent.com/jacyl4/de_GWD/master/de_GWD_Client/client -O ~/client && chmod +x client && ./client
```
![客户端](https://i.loli.net/2019/05/21/5ce3cf2519a1866460.png)
