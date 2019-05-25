![de_GWD](https://i.loli.net/2019/05/08/5cd295163b73a.png)

[详情](https://jacyl4.github.io/post/debian-gateway/)

### 服务端：
两种服务端，任选其一。
```
快速安装版
apt-get install -y curl
curl -O https://raw.githubusercontent.com/jacyl4/de_GWD/master/de_GWD_Server/server && chmod +x server && ./server
```

```
进阶编译版
apt-get install -y curl
curl -O https://raw.githubusercontent.com/jacyl4/de_GWD/master/de_GWD_Server/server2 && chmod +x server2 && ./server2
```

![服务端](https://i.loli.net/2019/05/23/5ce5a57babc6669781.png)

### 客户端：
```
wget --no-check-certificate https://raw.githubusercontent.com/jacyl4/de_GWD/master/de_GWD_Client/client -O ~/client && chmod +x ~/client && ~/client
```
![客户端](https://i.loli.net/2019/05/23/5ce5a57b8a79538090.png)
