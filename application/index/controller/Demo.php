<?php
namespace app\index\controller;

use think\Controller;
use think\Db;
class Demo extends Controller
{
	public function index(){

		return view();
	}
	//查
	public function select(){
		//$data=Db::query("select*from t_user");
       /* $data=Db::name("user")
            ->select();*/
      $data=Db::query("select * from t_user where id >=? and id<=?",[1,3]);
		dump($data);
		//获取执行的sql语句
            echo Db::getlastsql();
		}
    //插
    public function insert(){
        $data=Db::execute("insert into t_user value(null,'d',5,5)");
        dump($data);
    }
    //改
    public function update(){
	    $data=Db::execute("update t_user set phone=112 where id=11");
	    dump($data);
    }
    //删
    public function delete(){
	   $data=Db::execute("delete from t_user where id=13");
	   dump($data);
    }
}
