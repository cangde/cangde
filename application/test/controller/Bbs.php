<?php
/**
 * Created by PhpStorm.
 * User: ly
 * Date: 2018/4/25
 * Time: 22:30
 */
namespace app\test\controller;

use think\Controller;
use think\Db;

class Bbs extends Controller{
    public function show(){
        $data=Db::name('user')->where('id','>',0)->paginate(10,40);
        $this->assign('data',$data);
        return $this->fetch();
    }
}