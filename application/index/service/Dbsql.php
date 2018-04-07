<?php

namespace app\index\service;

use think\Db;


//輔助controller用service
class Dbsql
{   
    
    //全部查詢
    //回傳陣列
    //$table=資料表
    //$where=欄位
    //$search=搜尋欄位值
    public function sql_selectall($table)
    {
        $res=Db::table($table)->select();
        return $res;
    }
    //單一查詢
    //回傳單一陣列
    //$table=資料表
    //$where=欄位
    //$search=搜尋欄位值
    public function sql_find($table,$where,$search)
    {
        $res=Db::table($table)->where($where,$search)->find();
        return $res;
    }
    //多筆查詢
    //回傳多個陣列
    //$table=資料表
    //$where=欄位
    //$search=搜尋欄位值
    public function sql_select($table,$where,$search)
    {
        $res=Db::table($table)->where($where,$search)->select();
        return $res;
    }

    //新增資料，成功返回影響條數
    //$table=資料表
    //$data=要新增的資料
    public function sql_insert($table,$data)
    {
        $res=Db::name($table)->insert($data);
        return $res;
    }
     
     //修改資料，成功返回影響條數，否則返回0
     //$table=資料表
     //$where=欄位
     //$search=搜尋欄位值
     //$data=要修改的數值     
     public function sql_update($table,$where,$search,$data)
     {
         $res=Db::name($table)->where($where,$search)->update($data);
         return $res;
     }

     //刪除資料，成功返回影響條數，否則返回0
     //$table=資料表
     //$where=欄位
     //$search=搜尋欄位值
     public function sql_delete($table,$where,$search)
     {
         $res=Db::name($table)->where($where,$search)->delete();
         return $res;
     }

     //條件刪除資料，成功返回影響條數，否則返回0
     //$table=資料表
     //$where=欄位
     //$req=條件
     //$search=搜尋欄位值
     public function sql_deletereq($table,$where,$req,$search)
     {
         $res=Db::name($table)->where($where,$req,$search)->delete();;
         return $res;
     }

     //條件刪除資料，成功返回影響條數，否則返回0
     //$table=資料表
     //$where=陣列表達式
     public function sql_deletearray($table,$where)
     {
         $res=Db::name($table)->where($where)->delete();;
         return $res;
     }
}