# thinkphp5.1

實作CURD


主要檔案      
.       
├── application     
│&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;└── index       
│&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;├── controller      
│&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;├── model       
│&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;├── service     
│&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;└── view        
├── config      
├── public      
│   └── static      
│&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;├── css     
│&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;└── js      
└── route           

controller:放了`Home.php`(主要功能所在controller)、`Index.php`(用來確認目錄正確的頁面)      
model:model   
service:輔助controller用        
view:CRUD4個html加上一個共用的`menu.html`           
config:有改動的是`app.php`(主要是debug用)、`database.php`(資料庫連線用)        
public:放了css、js      
route:CRUD4個頁面的路由
```php
Route::get("select","index/home/select");//查看頁面
Route::get("insert","index/home/insert");//新增頁面
Route::get("update","index/home/update");//修改頁面
Route::get("delete","index/home/delete");//刪除頁面
```
***
# 重建說明

先clone這個專案
```git
git clone https://github.com/freedom5566/bulletin-tkphp.git tp5
```
然後`cd tp5`(進入tp5目錄)，clone thinkphp 核心(不要改動thinkphp目錄名稱)
```git
git clone https://github.com/top-think/framework thinkphp
```

連接資料庫請看config/database.php

database預設連HelloTest，table連bulletin(要改掉也行)

server目錄請設定tp5/public
port設定8080(要改掉也行)

訪問127.0.0.1:8080應該會出現        
![圖片不見了，請開issuse告知](https://github.com/freedom5566/friendly-PHP/blob/master/images/thphp5/start.png "成功圖")     
如果出現        
![圖片不見了，請開issuse告知](https://github.com/freedom5566/friendly-PHP/blob/master/images/thphp5/error.png "成功圖")     
這表示server設定目錄不對

成功後可以訪問      
127.0.0.1:8080/select       
127.0.0.1:8080/insert       
127.0.0.1:8080/update       
127.0.0.1:8080/delete       

可以看到對應的查訊新增修改刪除
***
# docker-compose方便快速的重建方法
[原始碼](https://github.com/freedom5566/ubiquitous-docker/tree/master/docker-compose/rebuild_php%2Bmariadb "github")

thinkphp5.1 要求

>   PHP >= 5.6.0        
    PDO PHP Extension       
    MBstring PHP Extension      

```sh
~ $ mkdir rebuild && cd rebuild 
~ /rebuild $ mkdir dump tkphp
~ /rebuild $ vim docker-compose.yml
```

```yml
version: "3"
services: 
  db: 
    image: mariadb:latest
    environment:
      MYSQL_ROOT_PASSWORD: 123 #帳號root密碼123
    volumes:
      - ./dump:/docker-entrypoint-initdb.d
       # 啟動時， 執行sql檔案
    networks:
      - my_network 
  php:
    build: ./tkphp # build tkphp資料夾下的Dockerfile
    image: tkphp:latest #build後images名稱和標籤
    depends_on:
      - db #等待mariadb啟動完成
    ports:
      - 8080:80 #映射主機8080port
    networks:
      - my_network
    working_dir: /usr/src/myapp/tp5/public #切換目錄
    command: php -S 0.0.0.0:80 #啟動內建伺服器
    
networks:
    my_network:
```
`:wq`存檔       
yml需要注意空格，可以用config指令檢查
```sh
~ /rebuild $ docker-compose config
```
正確返回docker-compose內容，否則返回格式錯誤


```sh
~ /rebuild $ vim dump/dump.sql
```

```sql

CREATE DATABASE `HelloTest` CHARACTER SET utf8 COLLATE utf8_unicode_ci;

CREATE TABLE `HelloTest`.`bulletin` 
( `id` INT(10) NOT NULL AUTO_INCREMENT ,
  `article` VARCHAR(100) NOT NULL ,
  `author` VARCHAR(10) NOT NULL ,
  `title` VARCHAR(10) NOT NULL , 
  PRIMARY KEY (`id`)) ENGINE = InnoDB;
```
`:wq`存檔

```sh
~ /rebuild $ vim tkphp/Dockerfile
```

```dockerfile
# 基礎映像
FROM php:7.2-alpine3.7

# alpine來源替換成國內元智大學，然後安裝git 並clone重建專案，裝完後刪除git， 接著安裝pdo_mysql， MBstring、PDO在php:7.2-alpine3.7已經有了，所以不需要再裝
RUN sed -i 's/http\:\/\/dl-cdn.alpinelinux.org/https\:\/\/ftp.yzu.edu.tw\/Linux/g' /etc/apk/repositories  && \
    apk add --update --no-cache   --virtual build-dependencies  \
    git \
    && git clone https://github.com/freedom5566/bulletin-tkphp.git /usr/src/myapp/tp5 \
    && git clone https://github.com/top-think/framework /usr/src/myapp/tp5/thinkphp \
    && apk del build-dependencies \
    && docker-php-ext-install pdo_mysql 
```
`:wq`存檔

開始建立compose

```sh
~ /rebuild $ docker-compose up
```

第一次使用要稍微等一下，主要是下載images跟gitclone專案

就能訪問127.0.0.1:8080了

想關閉回到終端機按`Ctrl+c`，接著

```sh
~ /rebuild $ docker-compose down 
~ /rebuild $ docker volume prune
```
關閉docker-compose並且清掉volume(資料庫)
