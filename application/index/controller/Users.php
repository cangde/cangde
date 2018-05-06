<?php

namespace app\index\controller;

use think\Controller;
use think\Request;
use think\Db;

class Users extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {

        //查询表数据
         $data=Db::query("select * from t_user");
         $this->assign("data",$data);

         return $this->fetch();
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create()
    {

        //添加用户
        return $this->fetch();
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        //接收数据
        $data=input("post.");
        //数据库插入
          $code=Db::execute("insert into t_user value(null,:name,:password,:phone,null)",$data);
        //判断
        if($code){
            $this->success("添加成功",'/user');
        }else{
            $this->error("添加失败");
        }

    }

    /**
     * 显示指定的资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function read($id)
    {
        //
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($id)
    {
        //从数据库中查询被修改的数据
        $data=Db::query("select * from t_user where id=$id");
        $this->assign("data",$data[0]);
        return $this->fetch();
    }

    /**
     * 保存更新的资源
     *
     * @param  \think\Request  $request
     * @param  int  $id
     * @return \think\Response
     */
    public function update(Request $request, $id)
    {
        //接收数据
        $data=Request::instance()->except('_method');

        $code=Db::execute("update t_user set name=:name ,password=:password ,phone=:phone where id=:id",$data);
        if($code){
            $this->success("数据更新成功",'/user');
        }else{
            $this->error("数据更新失败");
        }
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        //sql删除语句
        $code=Db::execute("delete from t_user where id=$id");
        //判断
        if($code){
            $this->success("删除成功");
        }else{
            $this->error("删除失败");
        }
    }
    //ajax删除
    public function ajax_del(){
        //接收想删除的数据
        $id=input("post.id/d");
        //执行删除操作
        $code=Db::execute("delete from t_user where id=$id");
        if($code){
            $data=[
                'statu'=>200,
                'info'=>'删除成功'
            ];
        }else{
            $data=[
                'statu'=>400,
                'info'=>'删除失败'
            ];
        }
        return $data;
    }
}
