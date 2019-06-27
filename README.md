基于v2+ws+tls方案，极大提高了dns性能，优化nginx，支持https2，tls1.3等特性。极大提升浏览器体验。

![de_GWD](https://i.loli.net/2019/06/05/5cf78011df0b260138.png)

## Server：

```
bash <(wget --no-check-certificate -qO- https://raw.githubusercontent.com/gwdburst/de_GWD/master/de_GWD_Server/server)
```
![server](https://i.loli.net/2019/06/19/5d0a486564e8018716.png)

## Client：

```
bash <(wget --no-check-certificate -qO- https://raw.githubusercontent.com/gwdburst/de_GWD/master/de_GWD_Client/client)
```
![client](https://i.loli.net/2019/06/14/5d03acb0d7c8a12948.png)


# 部署

>准备好顶级域名，做好A记录 和 cname for www，不开cdn。
>
>最好重新安装vps debian9，有vnc优先网络重装方式，无vnc可以尝试dd重装方式。


### 服务端

* ssh登入vps。

- 选项1开始安装，期间自动生成uuid和path，遇pihole安装界面一路回车，最后安装完成会打印 域名，uuid，path 到屏幕。

* 选项2切换至bbrplus，会自动重启，等两三分钟后自动生效。至此服务端基本完成。如需进一步操作，重新登入vps。

- 利用选项3安装nextcloud，可修改的就nextcloud 用户名 密码，数据库名 数据库用户 数据库密码，其他均为默认。安装过程中，为提供PostgresSQL安全性，会提示设置PostgresSQL主密码。

* 完成nextcloud的安装，见到主界面后，方可通过选项4 完善nextcloud缓存设置。

- 选项5 是用于vps换机房，更换ip准备。

* 选项6 如题。

- 选项7 如题。

* 选项8 v2链式中转用法。

- 选项9 如题。

* 选项0 如题。


### 客户端

* 安装于虚拟机或实体机的debian9设备，arm平台请用armbian系统。

- 初次安装 保证上级路由 dhcp 分发的 网关为上级本身 dns 可用 dnspod 保证 github 正常访问。

* 顺利安装，日后的更新，可以不用理会上级路由的网关跟dns。

- 填 path 一定要记得 / 符号。

* 选项2 可以用来强制重置 web ui 跟 pihole 的密码。 两个密码为同一个。

- 只支持大陆白名单模式。

* 不需要走代理的内网设备，通过黑白名单页下，将设备内网ip填入内网设备白名单。

- 保存节点的操作稍微有点耗时，稍微多等一小会。
