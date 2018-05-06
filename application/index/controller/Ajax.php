<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/2/3
 * Time: 21:39
 */
namespace app\index\controller;
use think\Controller;
use think\Db;

class Ajax extends Controller
{
    public function index(){
        for($i=0;$i<100000;$i++){
            echo $i;
        }
       return "index1111111111";
    }
    public function ajax(){
        return $this->fetch();
}
    public function ajax2(){

        $list = db('user')->select();
        $this->assign('list',$list);

        return $this->fetch();
    }
    public function ajax3(){
        if(request()->isPost()){

        }
    }

}

