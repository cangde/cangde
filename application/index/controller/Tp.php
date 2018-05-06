<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/2/28
 * Time: 22:27
 */

namespace app\index\controller;
use think\Db;
use think\Exception;

class Tp
{
    public function index(){
        //查询数据
        //$data=Db::name("user")->select();
        //一条
        //$data=Db::name("user")->find();
        //模糊查询两个条件
        //$data=Db::name("user")->where("username","like","%李%")->whereOr("phone","like","%1%")->select();
        //limit 截取数据
//        $data=Db::name("user")->limit(3)->select();
//        $data=Db::name("user")->limit(3,3)->select();
        //排序
//        $data=Db::name("user")->order("id")->select();
//        $data=Db::name("user")->order("id","desc")->select();
        //设置查询字段
        //$data=Db::name("user")->field("id,username name,phone")->select();
        //sql 系统函数
//        $data=Db::name("user")->field("count(*) as '总数'")->select();
//        $data=Db::name("user")->field(['id','username name'])->select();
        //排除字段
//        $data=Db::name("user")->field("username",true)->select();
        //page分页
        //$data=Db::name("user")->page("2,2")->select();
        //分组聚合
//        $data=Db::name("user")->field("phone,count(*) '总数'")->group("phone")->select();
        //having过滤
//        $data=Db::name("user")->field("phone,count(*) sum")->having("sum >1")->group("phone")->select();
        //echo Db::getLastsql();
        //多表查询
        //$data=Db::query("select t_goods.*,t_type.name tname from t_type,t_goods where t_goods.cid=t_type.id ");
        //内联查询
//        $data=Db::name("goods")->field("t_goods.*,t_type.name tname")->join("t_type","t_goods.cid=t_type.id")->select();
        //右链接
        //$data=Db::name("goods")->field("t_goods.*,t_type.name tname")->join("t_type","t_goods.cid=t_type.id",'right')->select();
        //左链接
       //$data=Db::name("goods")->field("t_goods.*,t_type.name tname")->join("t_type","t_goods.cid=t_type.id",'left')->select();
        //别名
        //$data=Db::name("goods")->alias("g")->field("t_goods.*,t.name tname")->join("t_type t","g.cid=t.id",'left')->select();
        //统计数据
        $data=Db::name("user")->max("age");//最大值
        $data=Db::name("user")->min("age");//最小值
        $data=Db::name("user")->avg("age");//平均值
        $data=Db::name("user")->count("age");//记录总数
        $data=Db::name("user")->sum("age");//总数

        echo Db::getlastsql();
        dump($data);
        //return $this->fetch();
    }
//插入数据
    public function insert(){
        //要插入的数据数组
//        $data=[
//            "username"=>"张三",
//            "userpassword"=>"123",
//            "phone"=>10086,
//            "age"=>13
//        ];
//
//        $code=Db::name("user")->insert($data);
//        //插入多条数据
        $data=[
            [
                "username"=>"xiao",
                "userpassword"=>"111",
                "phone"=>1111,
                "age"=>11
            ],
            [
                "username"=>"李四",
                "userpassword"=>"321",
                "phone"=>1008611,
                "age"=>19
            ],

        ];
        $code=Db::name("user")->insertAll($data);
        //获取最后一次插入的ID
        $data=[
            "username"=>"张三",
            "userpassword"=>"123",
            "phone"=>10086,
            "age"=>13
        ];
        $code=Db::name("user")->insertGetId($data);



        echo Db::getlastsql();
        dump($code);
    }
    //修改数据
    public function update(){
//     $code=Db::name("user")->where("id",'>',54)->update(["username"=>"三",'age'=>22]);

        //设置自增
        $code=Db::name('user')->where('id',58)->setInc('age');
        //设置自减
        $code=Db::name('user')->where('id',56)->setDec('age');
        //自减3
        $code=Db::name('user')->where('id',56)->setDec('age',3);
        echo Db::getlastsql();
        dump($code);
    }
    //删除数据
    public function delete(){
        //删除一条
        $code=Db::name('user')->where('id')->delete();
        //删除多条
        $code=Db::name('user')->where('id in(51,52)')->delete();
        //删除区间数据
        $code=Db::name('user')->where('id','>',36)->where('id','<',50)->delete();
        echo Db::getlastsql();
        dump($code);
    }
    //事务机制
    public function shiwu(){
        //自动控制事务
//        Db::transaction(function (){
//            //删除一条数据
//            Db::name('user')->delete(36);
//            //删除
//            Db::name('user')->deletes();
//        });
        //手动控制事务
        //开启事务
        Db::startTrans();
        //事务
        try{
            //删除数据
            $a=Db::name('user')->delete(35);
            //判断是否删除成功
            if (!$a){
                throw new \Exception('删除id失败');
            }
            //删除不存在的数据
            $b=Db::name('user')->delete(34);
            if (!$b){
                throw new \Exception('删除数据失败');
            }
            //执行提交操作
            Db::commit();
            echo "事务完成";
        }catch (\Exception $e){
            //回滚事务
            //echo "事务失败";
            Db::rollback();
            //获取错误报告
            dump($e->getMessage());
        }
    }

    //视图查询
    public function views(){
        //视图查询
        $data=Db::view('t_goods','id,name,price')
            ->view('t_type','name tname','t_type.id=t_goods.cid')
            ->select();
        //左连接
        $data=Db::view('t_goods','id,name,price')
            ->view('t_type','name tname','t_type.id=t_goods.cid','left')
            ->select();
        echo Db::getlastsql();
        dump($data);
    }
}