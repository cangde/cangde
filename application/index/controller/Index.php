<?php
namespace app\index\controller;

use think\Controller;
class Index extends Controller
{
    public function index()
    {
		return view(); 
    }
    public function test()
    {
    	return "<h1>恭喜获得狗子一只</h1>";
    }
    public function check(){
    	$user=$_POST['user'];
    	$pwd=$_POST['pwd'];
    	if($user=="123" && $pwd=="321"){
    		$this->success('登录成功',url('/index/test'));
    	}else{;
    		$this->error('登录失败，用户名或密码错误');
    	}
    }
    public function demo(){
        return "index控制器里的demo";
    }
}
