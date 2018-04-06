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
                "title"=>$request->post('title'),
                "article"=>$request->post("message")
            ];
            $res=(new \service\Dbsql())->sql_update("bulletin","author",$request->post("author"),$data);
         
            if($res??0)
            {
                $this->success("新增成功","http://127.0.0.1:8080/update");
            }
            else
            {
                $this->error("新增失敗！！");
            }
        }
        else
        {
            $this->redirect("http://127.0.0.1:8080/update",404);            
        }
    }
    public function test()
    {
        // $data = ['id'=>1,'user' => '清潔', 'message' => 'xd','date'=>'2018-03-08'];
        // Db::name('messages')->insert($data);
        $data=Db::table('messages')->where('id',1)->find();
        return $data["id"];
    }
    public function hh()
    {
        $data=Db::table("bulletin")->where("author","123")->find();
        $this->assign([
            'name'  => $data["author"],
            'email' => 'thinkphp@qq.com'
        ]);
        return $this->fetch("/home");

    }
    public function Tea()
    {
        $Test= (new \service\Dbsql())->sql_find("bulletin","id",5);
        // $data=[
        //     "title"=>123,
        //     "author"=>123,
        //     "article"=>5566
        // ];
        //$data=$Test->sql_find("bulletin","id",2);
        //$data=$Test->sql_insert("bulletin",$data);
        if($Test) return $Test["author"];
        else return "哎呀甚麼也沒有咧~~";
        
    }
    public function mm()
    {
        $test=new Bulletin();
        $tss=$test::where('id', 2)->find();
        //$test->author="124";
        print_r($tss->author);
    }
}
