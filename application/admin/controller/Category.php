<?php
namespace app\admin\controller;

use think\Loader;
use think\Db;
use think\Request;

class Category extends Commond{

	public function cateList(){
		$list = $this->cate();
		//总页数/?
		$page=(Request::instance()->has('page'))?Request::instance()->param('page'):1;
		
		$pnum=ceil(count($list)/8);

		$list=array_slice($list,($page-1),8);
		//当前页码
		//每页条数=8
		
		$this->assign('pnum',$pnum);
		$this->assign('page',$page);
		$this->assign('list',$list);
		$this->assign('title','分类列表');
		return $this->fetch();
	}

	public function cateAdd(){
		if(request()->isPost()){
			$data = input('post.');
			$result = Db::name('category')->insert($data);
			if($result){
				$this->success('添加成功','Category/cateList');die;
			}else{
				$this->error('添加失败');die;
			}
		}

		$list = $this->cate();
		$this->assign('list',$list);
		$this->assign('title','分类添加');
		return $this->fetch();
	}

	public function cateUpdate(){
		$id = input('id');
		if(request()->isPost()){
			$data = input('post.');
			$result = Db::name('category')->where("id=$id")->update($data);
			if($result>0){
				$this->success('更新成功','category/cateList');die;
			}elseif($result===0){
				$this->success('未更新数据');die;
			}else{
				$this->error('更新失败');die;
			}
		}

		$one = Db::name('category')->where('id='.$id)->find();
		$this->assign('one',$one);
		$list = $this->cate();
		$this->assign('list',$list);
		$this->assign('title','品牌编辑');
		return $this->fetch();
	}

	public function cateDelete(){
		$id = input('id');
		$result = Db::name('category')->where("id=$id")->delete();
		if($result>0){
			$this->success('删除成功','Category/cateList');die;
		}elseif($result===0){
			$this->success('未删除数据');die;
		}else{
			$this->error('删除失败');die;
		}
	}
}



?>