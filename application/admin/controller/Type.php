<?php
namespace app\admin\controller;

use think\Loader;
use think\Db;

class Type extends Commond{

	public function typeList(){
		$list = Db::table('tp_type')->paginate(2);
		$this->assign('list',$list);
		$this->assign('title','类型列表');
		return $this->fetch();
	}

	public function typeAdd(){
		if(request()->isPost()){
			$data = input('post.');
			$result = Db::name('type')->insert($data);
			if($result){
				$this->success('添加成功','type/typeList');die;
			}else{
				$this->error('添加失败');die;
			}
		}
		$this->assign('title','类型添加');
		return $this->fetch();
	}

	public function typeUpdate(){
		$id = input('id');
		if(request()->isPost()){
			$data = input('post.');
			$validate = Loader::validate('type');
			if(!$validate->check($data)){
				$this->error($validate->getError());die;
			}
			$result = Db::name('type')->where("id=$id")->update($data);
			if($result>0){
				$this->success('更新成功','type/typeList');die;
			}elseif($result===0){
				$this->success('未更新数据');die;
			}else{
				$this->error('更新失败');die;
			}
		}

		$one = Db::name('type')->where('id='.$id)->find();
		$this->assign('one',$one);
		$this->assign('title','类型编辑');
		return $this->fetch();
	}

	public function typeDelete(){
		$id = input('id');
		$result = Db::name('type')->where("id=$id")->delete();
		if($result>0){
			$this->success('删除成功','type/typeList');die;
		}elseif($result===0){
			$this->success('未删除数据');die;
		}else{
			$this->error('删除失败');die;
		}
	}
}



?>