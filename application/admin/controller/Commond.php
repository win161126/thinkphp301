<?php
namespace app\admin\controller;

use think\Controller;

class Commond extends Controller{
	public function __construct(){
		parent::__construct();
		$this->isLogin();
		$menu = $this->menu();
		$this->assign('menu',$menu);
		$controller = strtolower(request()->controller());//获取当前的控制器
		$action = strtolower(request()->action());//获取当前的方法
		$this->assign('controller',$controller);
		$this->assign('action',$action);

		$adminlevel = session('level');
		$this->assign('adminlevel',$adminlevel);
		if(session('userId')!=config('superadminid') && $controller!='index') $this->islevel();
	}

	private function isLogin(){
		if(!session('?user')){
			$this->error('请先登录','Admin/login');
		}
	}

	function cate($id=0,$list=[],$spac=0){
		if($id>0) $spac ++;
		$fid = $id;
		$parentlist = db('category')->where("fid=$fid")->select();
		foreach($parentlist as $k=>$v){
			$v['name'] = '<font color="red">'.str_repeat('|--',$spac).'</font>'.$v['name'];
			$list[] = $v;
			$list = $this->cate($v['id'],$list,$spac);
		}
		return $list;
	}

	function level($id=0,$list=[],$spac=0){
		if($id>0) $spac ++;
		$fid = $id;
		$parentlist = db('level')->where("fid=$fid")->select();
		foreach($parentlist as $k=>$v){
			$v['name'] = '<font color="red">'.str_repeat('|--',$spac).'</font>'.$v['name'];
			$list[] = $v;
			$list = $this->level($v['id'],$list,$spac);
		}
		return $list;
	}

	function attr($id=0,$list=[],$spac=0){
		if($id>0) $spac ++;
		$fid = $id;
		$parentlist = db('attribute')->where("fid=$fid")->select();
		foreach($parentlist as $k=>$v){
			$v['name'] = '<font color="red">'.str_repeat('|--',$spac).'</font>'.$v['name'];
			$list[] = $v;
			$list = $this->attr($v['id'],$list,$spac);
		}
		return $list;
	}

	function upload($files){
		$file = request()->file($files);
		$dataImg = [];
		if($file){
			foreach($file as $k=>$v){
				$filePath = './public/static/admin/upload/'.date('Y-m-d');
				if(!file_exists($filePath)){
					mkdir($filePath,0777,true);
				}
				//验证格式，并上传
				$info = $v->validate(['size'=>2*1024*1024,'ext'=>"jpg,png,gif,jpeg"])->rule('uniqid')->move($filePath);
				if($info){
					$dataImg[] = rtrim($filePath,'/').'/'.$info->getSaveName();
				}
			}
		}
		return $dataImg;
	}

	function thumb($path,$width=150,$height=150){
		$image = \think\Image::open($path);
		// 按照原图的比例生成一个最大为150*150的缩略图并保存为thumb.png
		$tPath = dirname($path).'/thumb';
		if(!file_exists($tPath)){
			mkdir($tPath,0777,true);
		}
		//./public/static/admin/upload/2018-07-06/thumb
		$thumbPath = $tPath.'/'.basename($path);
		//./public/static/admin/upload/2018-07-06/thumb_5b3eca95c6862.jpg
		$image->thumb($width, $height)->save($thumbPath);
		return $thumbPath;
	}

	function water($path,$type=2,$state=9){
		$image = \think\Image::open($path);
		// 给原图左上角添加水印并保存water_image.png
		if($type == 1){
			switch($state){
				case 1:
					$image->water('./logo.png',\think\Image::WATER_NORTHWEST)->save($path); 
					break;
				case 2:
					$image->water('./logo.png',\think\Image::WATER_NORTH)->save($path); 
					break;
				case 3:
					$image->water('./logo.png',\think\Image::WATER_NORTHEAST)->save($path); 
					break;
				case 4:
					$image->water('./logo.png',\think\Image::WATER_WEST)->save($path); 
					break;
				case 5:
					$image->water('./logo.png',\think\Image::WATER_CENTER)->save($path); 
					break;
				case 6:
					$image->water('./logo.png',\think\Image::WATER_EAST)->save($path); 
					break;
				case 7:
					$image->water('./logo.png',\think\Image::WATER_SOUTHWEST)->save($path); 
					break;
				case 8:
					$image->water('./logo.png',\think\Image::WATER_SOUTH)->save($path); 
					break;
				case 9:
					$image->water('./logo.png',\think\Image::WATER_SOUTHEAST)->save($path); 
					break;
			}
		}else{
			$image->text('黑店','./public/static/admin/font/msyh.ttf',20,'#ffffff')->save($path);
		}
	}

	//权限菜单
	function menu($id=0,$list=[],$spac=0){
		if($id>0) $spac ++;
		$fid = $id;
		$parentlist = db('level')->where("fid=$fid")->select();
		foreach($parentlist as $k=>$v){
			$list[] = $v;
			$list = $this->menu($v['id'],$list,$spac);
		}
		return $list;
	}

	//权限判断
	function islevel(){
		$controller = strtolower(request()->controller());//获取当前的控制器
		$action = strtolower(request()->action());//获取当前的方法
		$one = db('level')->where("controller='$controller' and action='$action'")->find();
		if(!in_array($one['id'],session('level'))){
			$this->error('无权访问','admin/logout');
		}
	}
}



?>