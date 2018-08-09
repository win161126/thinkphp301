<?php
namespace app\index\controller;

use app\index\controller\Common;
use app\index\model\Member as User;

class Member extends Common
{
    public function login()
    {
    	if(request()->isAjax()){
    		$data = input('post.');
    		$info = ['code'=>0,'info'=>false,'msg'=>''];
    		$validate = $this->validate($data,[
    			'uname'=>'require',
    			'upwd' => 'require',
    		],[
    			'uname.require'=>'用户名不能为空',
    			'upwd.require'=>'密码不能为空',
    		]);
    		if(true === $validate){
    			$data['upwd'] = md_crypt($data['upwd']);
    			$model = new User();
    			$result = $model->where($data)->find();
    			// print_r($result);die;
    			if($result){
    				session('uname',$result->uname);
    				session('unameId',$result->id);
    				$info = ['code'=>1,'info'=>true,'msg'=>'登录成功'];
    				return $info;
    			}else{
    				$info = ['code'=>0,'info'=>false,'msg'=>'登录失败'];
    				return $info;
    			}
    		}else{
    			$info['msg'] = $validate;
    			return $info;
    		}
    	}
        $this->assign('title','登录');
        return $this->fetch();
    }

    //注册
    public function register()
    {
    	if(request()->isAjax()){
    		$data = input('post.');
    		// print_r($data);die;
    		$info = ['code'=>0,'info'=>false,'msg'=>''];
    		$validate = $this->validate($data,[
    			'uname'=>'require',
    			'upwd' => 'require|confirm',
    		],[
    			'uname.require'=>'用户名不能为空',
    			'upwd.require'=>'密码不能为空',
    			'upwd.confirm'=>'两次密码不一致',
    		]);
    		if(true === $validate){
    			$data['upwd'] = md_crypt($data['upwd']);
    			$model = new User();
    			$result = $model->allowField(true)->save($data);
    			if($result){
    				$info = ['code'=>1,'info'=>true,'msg'=>'注册成功'];
    				return $info;
    			}else{
    				$info = ['code'=>0,'info'=>false,'msg'=>'注册失败'];
    				return $info;
    			}
    		}else{
    			$info['msg'] = $validate;
    			return $info;
    		}
    	}
        $this->assign('title','注册');
        return $this->fetch();
    }

    //退出
    public function logout(){
    	session(null);
    	$this->error('退出成功','Index/index');
    }

    //用户中心
    public function index(){
         $this->assign('title','用户中心');
    	return $this->fetch();
    }

    public function address(){
        if(request()->isAjax()){
            $info = ["code"=>0,"info"=>false,"msg"=>""];
            $data = input('post.');
            $validate = $this->validate($data,[
                'province' => 'require',
                'city' => 'require',
                'country' => 'require',
                'address' => 'require',
                'linkman' => 'require',
                'mobile' => 'require',
            ]);
            if(true === $validate){
                $data['mid'] = session('unameId');
                
                $result = db('address')->insert($data);
                if($result){
                    $info = ["code"=>500,"info"=>true,"msg"=>"添加成功"];
                    return $info;
                }else{
                    $info = ["code"=>401,"info"=>false,"msg"=>"添加失败"];
                    return $info;
                }
            }else{
                $info['code'] = 400;
                $info['msg'] = $validate;
                return $info;
            }
        }
        $map['mid'] = session('unameId');
        $list = db('address')->where($map)->select();
        $this->assign([
            'list'=>$list,
            'title'=>'地址管理'
        ]);
        return $this->fetch();
    }
}
