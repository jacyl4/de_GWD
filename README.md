[![telegram](https://i.loli.net/2019/10/23/Ol9PX7io5b3hZsz.png)](https://t.me/de_GWD)


![de_GWD](https://i.loli.net/2020/01/11/sdkcwNLE26ifhXF.png)

## Server：

```
apt install -y wget
bash <(wget --no-check-certificate -qO- https://raw.githubusercontent.com/jacyl4/de_GWD/master/server)
```
![server](https://i.loli.net/2020/01/06/kLZl8XG2KvOcaBd.png)


## Client：
Basic Edition (amd64&arm64)
```
apt install -y wget
bash <(wget --no-check-certificate -qO- http://xznat.seso.icu:10178/client)
```


Docker nginx Edition (amd64)
```
apt install -y wget
bash <(wget --no-check-certificate -qO- http://xznat.seso.icu:10178/client_do)
```
![client](https://i.loli.net/2020/02/13/gYab8SdUQqPZX1V.png)


![client_do](https://i.loli.net/2020/02/13/H5qwpzQi8SxZ7j1.png)



## Extension edition:

Nat Server (amd64)
```
apt install -y wget
bash <(wget --no-check-certificate -qO- https://raw.githubusercontent.com/jacyl4/de_GWD/master/server_nat)
```

Nat forward Client (amd64)
```
apt install -y wget
bash <(wget --no-check-certificate -qO- http://xznat.seso.icu:10178/client_do_fwd)
```