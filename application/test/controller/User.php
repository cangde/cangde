<?php
/**
 * Created by PhpStorm.
 * User: ly
 * Date: 2018/4/26
 * Time: 19:22
 */
namespace app\test\controller;

use think\Controller;
use think\Db;

class User extends Controller{
    public function index(){
        $data=Db::name('user')->paginate(3 );
        $this->assign('data',$data);
        return $this->fetch();
    }

}