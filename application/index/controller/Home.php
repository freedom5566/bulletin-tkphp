<?php
namespace app\index\controller;

use think\Controller;
use think\Request;
use app\index\model\Bulletin;

class Home extends Controller
{
    public function insert()
    {

        return $this->fetch("/insert");;

    }

    public function insertreq(Request $request)
    {
        if($request->param()??0)
        {
            $data=[
                "title"=>$request->post('title'),
                "author"=>$request->post("author"),
                "article"=>$request->post("message")
            ];
            $res=(new \service\Dbsql())->sql_insert("bulletin",$data);
            if($res??0)
            {
                $this->success("新增成功","http://127.0.0.1:8080/insert");
            }
            else
            {
                $this->error("新增失敗！！");
            }

        }
        else
        {
            $this->redirect("http://127.0.0.1:8080/insert",404);
        }
    }
    public function update()
    {
        return $this->fetch("/update");
    }
    public function updatereq(Request $request)
    {
        if($request->param()??0)
        {
            $data=[
                "title"=>$request->post("title"),
                "article"=>$request->post("message")
            ];
            $res=(new \service\Dbsql())->sql_update("bulletin","author",$request->post("author"),$data);
         
            if($res??0)
            {
                $this->success("修改成功","http://127.0.0.1:8080/update");
            }
            else
            {
                $this->error("修改失敗！！");
            }
        }
        else
        {
            $this->redirect("http://127.0.0.1:8080/update",404);            
        }
    }
    public function delete()
    {
        return $this->fetch("/delete");
    }
    public function deletereq(Request $request)
    {
        if($request->param()??0)
        {
            $data=[
                "title"=>$request->post("title"),
                "author"=>$request->post("author")
            ];
            $res=(new \service\Dbsql())->sql_deletearray("bulletin",[
                ["title","=",$data["title"]],
                ["author","=",$data["author"]]
                ]);
         
            if($res??0)
            {
                $this->success("刪除成功","http://127.0.0.1:8080/delete");
            }
            else
            {
                $this->error("刪除失敗！！");
            }
        }
        else
        {
            $this->redirect("http://127.0.0.1:8080/delete",404);            
        }
    }
    
}
