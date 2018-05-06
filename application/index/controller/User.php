<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/5
 * Time: 15:29
 */
namespace app\index\controller;

use think\Controller;
use think\Loader;

class User extends Controller
{
    public function index(){
        //实例化数据模型
//        $user=new \app\index\model\User;
//        dump($user::get(1)->toArray());
    }
    //模型的实例化
    public function get(){
        //实例化数据模型 ×
//       $user=new User();
//       $user::get(3);
//       dump($user);
       //使用loader类
//        $user=Loader::model('user');
//        $res=$user::get(2);
//        dump($res->toArray());
        //使用助手函数
        $user=model('user');
        $res=$user::get(1);
        dump($res->toArray());
    }
        //获取单条数据
    public function getOne(){
        //get
        $user=model('user');
        //数字
        $res=$user::get(1);//默认主键
        //数组
        $res=$user::get(['username'=>'b']);//默认查找用户名
        //find
        $res=$user::where('id',2)->find();
        dump($res->toArray());
    }
    //查询多条数据
    public function getAll(){
        //all
        //所有数据
        $user=model('user');
        $res=$user::all();
        //字符串
        $res=$user::all('1,2,3');
        //数组
        $res=$user::all([4,5]);
        $res=$user::all(['age'=>13]);
        //闭包
        $res=$user::all(function ($q){
            $q->where('age',13)
                ->whereOr('phone',1000)
                ->order('id','desc');
        });
        //select
        $res=$user::select();
        $res=$user::select('1,2,3');
        foreach ($res as $v) {
            dump($v->toArray());
       }
    }
    //获取值
    public function getValue(){
        //获取某个值
        $user=model('user');
        $res=$user::where('id',5)->value('username');
        //获取某列值
        $res=$user::column('username');
        $res=$user::column('username,phone,age');
        dump($res);
    }
    //动态查询
    public function dong()
    {
        //getBy
        $user = model('user');
        $res = $user::getByusername('a');
        dump($res->toArray());
    }
    //新增数据
    public function add(){
        $user=model('user');
         //设置属性新增
//        $user->username='ly';
//        $user->userpassword='199696';
//        $user->phone=123;
//        $user->age=21;
        //通过data方法
//        $user->data([
//            'username'=>'lyly',
//            'userpassword'=>'1996',
//            'phone'=>10000,
//            'age'=>17,
//            'sex'=>1
//        ]);
//        dump($user->allowField(true)->save());
//        echo $user->id;
        //新增多条数据
        $list=[
            ['username'=>'gz','userpassword'=>'2002','phone'=>'2002','age'=>16],
            ['username'=>'gz2','userpassword'=>'2002','phone'=>'2002','age'=>16],
            ['username'=>'gz3','userpassword'=>'2002','phone'=>'2002','age'=>16]
        ];
        dump($user->saveAll($list));
    }
    //删除操作
    public function delete(){
        $user=model('user');
        //删除数据
//        $res=$user::get(69);
//        dump($res->delete());
        //删除主键
        $res=$user::destroy(67);
        //删除主键多条数据
        $res=$user::destroy('65,64');
        $res=$user::destroy([65,64]);
        //删除username
        $res=$user::destroy(['username'=>'lyly']);
        //删除多个条件
        $res=$user::destroy(['username'=>'gz','age'=>11]);
        //使用闭包
        $res=$user::destroy(function ($query){
            $query->where('id','>',36);
        });
        //删除数据
        $res=$user::where('id','>',30)->delete();
        dump($res);
    }
    //修改操作

}