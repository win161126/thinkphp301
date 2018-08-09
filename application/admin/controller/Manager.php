<?php
namespace app\admin\controller;

use think\Loader;
use think\Db;
use app\admin\model\User;

class Manager extends Commond{

	public function managerList(){
		$list = Db::name('manager')->paginate(2);
		$this->assign('list',$list);
		$this->assign('title','品牌列表');
		return $this->fetch();
	}

	public function managerAdd(){
		if(request()->isPost()){
			$data = input('post.');
			$validate = $this->validate($data,[
				'rid'=>'gt:0',
				'uname'=>'require',
				'pwd'=>'require|confirm',
			],[
				'rid.gt'=>'请选择角色',
				'uname.require'=>'账号不能为空',
				'pwd.require'=>'密码不能为空',
				'pwd.confirm'=>'两次输入密码不一致',
			]);
			$uname = $data['uname'];
			$hasName = db('manager')->where("uname='$uname'")->find();
			if($hasName) $this->error('用户名已存在');
			if(true === $validate){
				$data['pwd'] = md5(crypt($data['pwd'],config('pwdstring')));
				$model = new User($data);
				$result = $model->allowField(true)->save();
				if($result){
					$this->success('添加成功','manager/managerList');die;
				}else{
					$this->error('添加失败');die;
				}
			}else{
				$this->error($validate);
			}
		}
		$list = DB::name('role')->field('id,name')->select();
		$this->assign('list',$list);
		$this->assign('title','管理员添加');
		return $this->fetch();
	}

	public function managerUpdate(){
		$id = input('id');
		if(request()->isPost()){
			$data = input('post.');
			$validate = Loader::validate('manager');
			if(!$validate->check($data)){
				$this->error($validate->getError());die;
			}
			$result = Db::name('manager')->where("id=$id")->update($data);
			if($result>0){
				$this->success('更新成功','manager/managerList');die;
			}elseif($result===0){
				$this->success('未更新数据');die;
			}else{
				$this->error('更新失败');die;
			}
		}

		$one = Db::name('manager')->where('id='.$id)->find();
		$this->assign('one',$one);
		$this->assign('title','品牌编辑');
		return $this->fetch();
	}

	public function managerDelete(){
		$id = input('id');
		$result = Db::name('manager')->where("id=$id")->delete();
		if($result>0){
			$this->success('删除成功','manager/managerList');die;
		}elseif($result===0){
			$this->success('未删除数据');die;
		}else{
			$this->error('删除失败');die;
		}
	}
}



?>