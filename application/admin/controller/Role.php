<?php
namespace app\admin\controller;

use think\Loader;
use think\Db;

class Role extends Commond{

	public function roleList(){
		$list = Db::name('role')->select();
		$levelList = Db::name('level')->field('id,name')->select();
		// print_r($levelList);die;
		foreach($list as $k=>$v){
			$levelName = array();
			$idArr = explode('|', $v['level']);// 2|3|4|5|6|7   array(2,3,4,5,6,7)
			foreach($levelList as $kk=>$vv){
				if(in_array($vv['id'],$idArr)){
					$levelName[] = $vv['name'];
				}
			}
			$list[$k]['level'] = implode('|',$levelName);
		}

		$this->assign('list',$list);
		$this->assign('title','角色列表');
		return $this->fetch();
	}

	public function roleAdd(){
		if(request()->isPost()){
			$data = input('post.');
			$validate = $this->validate($data,[
				'name' => 'require',
				'level' => 'require',
			]);
			if(true === $validate){
				$data['level'] = implode("|", $data['level']);
				$result = Db::name('role')->insert($data);
				if($result){
					$this->success('添加成功','Role/roleList');die;
				}else{
					$this->error('添加失败');die;
				}
			}else{
				$this->error($validate);
			}
		}

		$list = $this->level();
		$this->assign('list',$list);
		$this->assign('title','角色添加');
		return $this->fetch();
	}

	public function roleUpdate(){
		$id = input('id');
		if(request()->isPost()){
			$data = input('post.');
			$validate = $this->validate($data,[
				'name' => 'require',
				'level' => 'require',
			]);
			if(true === $validate){
				$data['level'] = implode("|", $data['level']);
				$result = Db::name('role')->where("id=$id")->update($data);
				if($result){
					$this->success('编辑成功','Role/roleList');die;
				}else{
					$this->error('编辑失败');die;
				}
			}else{
				$this->error($validate);
			}
		}

		$one = Db::name('role')->where('id='.$id)->find();
		$one['level'] = explode('|',$one['level']);
		// print_r($one);die;
		$this->assign('one',$one);
		$list = $this->level();
		$this->assign('list',$list);
		$this->assign('title','角色编辑');
		return $this->fetch();
	}

	public function roleDelete(){
		$id = input('id');
		$result = Db::name('role')->where("id=$id")->delete();
		if($result>0){
			$this->success('删除成功','role/roleList');die;
		}elseif($result===0){
			$this->success('未删除数据');die;
		}else{
			$this->error('删除失败');die;
		}
	}
}



?>