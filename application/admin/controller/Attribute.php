<?php
namespace app\admin\controller;

use think\Loader;
use think\Db;

class Attribute extends Commond{

	public function attrList(){
		$typeid = input('typeid');
		$list = Db::name('attribute')->where(['typeid'=>$typeid])->paginate(2);
		$this->assign('list',$list);
		$this->assign('title','属性列表');
		return $this->fetch();
	}

	public function attrAdd(){
		if(request()->isPost()){
			$data = input('post.');
			$options = $data['options'];//黑色,白色,红色
			unset($data['options']);
			// print_r($data);die;
			$result = Db::name('attribute')->insertGetId($data);
			if($result){
				$opArr = explode(',', $options);//[黑色,白色,红色]
				foreach($opArr as $k=>$v){
					$array['aid'] = $result;
					$array['name'] = $v;
					db('options')->insert($array);
				}

				$this->success('添加成功',url('attribute/attrList',['typeid'=>$data['typeid']]));die;
			}else{
				$this->error('添加失败');die;
			}
		}
		$typelist = db('type')->select();
		$this->assign('typelist',$typelist);
		$this->assign('title','属性添加');
		return $this->fetch();
	}

	public function attrUpdate(){
		$id = input('id');
		if(request()->isPost()){
			$data = input('post.');
			$validate = Loader::validate('attr');
			if(!$validate->check($data)){
				$this->error($validate->getError());die;
			}
			$result = Db::name('attribute')->where("id=$id")->update($data);
			if($result>0){
				$this->success('更新成功','attribute/attrList');die;
			}elseif($result===0){
				$this->success('未更新数据');die;
			}else{
				$this->error('更新失败');die;
			}
		}

		$one = Db::name('attribute')->where('id='.$id)->find();
		$this->assign('one',$one);
		$this->assign('title','属性编辑');
		return $this->fetch();
	}

	public function attrDelete(){
		$id = input('id');
		$result = Db::name('attribute')->where("id=$id")->delete();
		if($result>0){
			$this->success('删除成功','attribute/attrList');die;
		}elseif($result===0){
			$this->success('未删除数据');die;
		}else{
			$this->error('删除失败');die;
		}
	}
}



?>