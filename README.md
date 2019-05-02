![Snipaste_2019-05-02_02-23-48](https://i.loli.net/2019/05/02/5cc9e44e10b85.png)
版本更新方式，就是重复运行下面客户端脚本安装一遍，重复部分会自动略过，关键部份会覆盖。

### 服务端：
```
apt-get install -y curl
curl -O https://raw.githubusercontent.com/jacyl4/de_GWD/master/de_GWD_Server/server && chmod +x server && ./server
```
![Snipaste_2019-04-19_20-05-25](https://i.loli.net/2019/04/19/5cb9b9980b216.png)

### 客户端：
```
wget --no-check-certificate https://raw.githubusercontent.com/jacyl4/de_GWD/master/de_GWD_Client/client -O ~/client && chmod +x client && ./client
```
![Snipaste_2019-04-26_03-45-20](https://i.loli.net/2019/04/26/5cc20e5e9d6f7.png)

### Changelog:
5-2   添加BT分流功能

4-30 修复Firefox下不能登录的问题

4-26 更新netflix节点固定功能

4-14 更新web ui

2-26 始