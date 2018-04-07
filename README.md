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
│       ├── css     
│       └── js      
└── route           

controller:放了`Home.php`(主要功能所在controller)、`Index.php`(用來確認目錄正確的頁面)      
model:model   
service:輔助controller用
view:CRUD4個html加上一個共用的`menu.html`    config:有改動的是`app.php`(主要是debug用)、`database.php`(資料庫連線用)        
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

database預設連HelloTest，table連bulletin

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

