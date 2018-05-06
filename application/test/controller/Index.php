<?php
/**
 * Created by PhpStorm.
 * User: ly
 * Date: 2018/4/25
 * Time: 21:47
 */
namespace app\test\controller;

use think\Controller;
use think\Cookie;
use think\Db;
use think\Session;

class Index extends Controller{
    public function index(){
        $data=Db::name('user')->where('id','>',1)->select();
        $this->assign('data',$data);

        return $this->fetch();

    }
    public function setSession(){
        Session::set('name','bdqn');
    }
    public function getSession(){
        dump(Session::get('name'));
    }
    public function setCookie(){
        Cookie::set('name','ly');
        Cookie::set('age',17,30);
    }
    public function getCookie(){
        dump(Cookie::get('name'));
        dump(Cookie::get('age'));
    }
    public function isCookie(){
        dump(Cookie::has('name'));
        dump(Cookie::has('age'));
    }
    public function delCookie(){
        Cookie::delete('name');
        cookie('name',null);
    }
    public function clearCookie(){
        Cookie::clear(  );
    }

}

