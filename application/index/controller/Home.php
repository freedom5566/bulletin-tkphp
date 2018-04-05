<?php
namespace app\index\controller;

use think\Controller;
use think\Request;
use Think\Model;

class Home extends Controller
{
    public function index()
    {

        return $this->fetch("/index");;

    }
    public function insert(Request $request)
    {
        return $request->param('title');;
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
        $Test= new \service\Dbsql();
        // $data=[
        //     "title"=>123,
        //     "author"=>123,
        //     "article"=>5566
        // ];
        $data=$Test->sql_find("bulletin","id",2);
        //$data=$Test->sql_insert("bulletin",$data);
        if($data) return $data["author"];
        else return "哎呀甚麼也沒有咧~~";
        
    }
    public function mm()
    {
        $test=new \app\index\model\Bulletin();
        $tss=$test::where('id', 2)->find();
        //$test->author="124";
        print_r($tss);
    }
}
