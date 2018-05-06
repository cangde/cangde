<?php
namespace app\index\controller;

use think\Request;
use think\Controller;
class Test extends Controller
{
	public function index(Request $request)
	{
		/*$request=request();
		dump($request);*/
		/*$request=Request::instance();*/
		dump($request);
	}
	public function user()
	{
		return view();
	}
	public function _emp()
	{
		
	}
	//获取URL请求
	public function getUrl(Request $request)
	{	//获取域名
		dump($request->domain());
		//获取URL地址 除域名以外
		dump($request->url());
		//获取入口文件
		dump($request->baseFile());
		//获取pathInfo路径
		dump($request->pathinfo());
		//获取pathinfo路径 无后缀
		dump($request->path());
		//URL地址伪静态后缀
		dump($request->ext());
		
	}
	//获取请求类型
	public function getType(Request $request)
	{
		//请求类型
		dump($request->method());
		//资源类型
		dump($request->type());
		//访问地址
		dump($request->ip());
		//是否是ajax请求
		dump($request->isajax());
	}
	//页面
	public function a(){
		return view();
	}
	public function wj(){
	    //要打开的文件
	    $file='./static/test.txt';
	    //打开文件
        $fp=fopen($file,'ab');
        if($fp == false){
            echo '打开文件失败';
        }else{
            echo '打开文件成功';
            $str=md5(time());
            echo $str,'<br/>';
            //写入内容
            $res=fwrite($fp,$str);
            dump($res);
            //关闭文件
            fclose($fp);
        }

    }
    public function sc(){
        return $this->fetch();
    }
    public function js(){
	    print_r($_FILES);
    }
}

