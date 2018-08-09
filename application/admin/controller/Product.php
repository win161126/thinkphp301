<?php
namespace app\admin\controller;

use think\Loader;
use think\Db;
use app\admin\model\Goods;

class Product extends Commond{

	public function proList(){
		$list = Db::name('product')
		->alias('p')
		->field('p.*,c.name as cname,b.name as bname')
		->join('tp_category c','p.cid=c.id')
		->join('tp_brand b','p.bid=b.id')
		->order('id desc')
		->paginate(2);
		// print_r($list);die;
		$this->assign('list',$list);
		$this->assign('title','商品列表');
		return $this->fetch();
	}

	public function proAdd(){
		if(request()->isAjax()){
			$info = ["code"=>0,"info"=>false,"msg"=>""];
			$data = input('post.');
			// print_r($data);die;
			//上传图片
			$dataImg = $this->upload('ufile');
			if($dataImg){	
				//缩略图
				$thumb = $this->thumb($dataImg[0]);
				//水印
				$this->water($dataImg[0]);

				$data['thumb'] = $thumb;
				$data['picture'] = implode(',', $dataImg);
			}
			$validate = $this->validate($data,[
				'name' => 'require',
				'cid' => 'require',
				'bid' => 'require',
				'price' => 'require',
			]);
			if(true === $validate){
				$product = new Goods($data);
				$result = $product->allowField(true)->save();
				if($result){
					//属性
					$pid = $product->id;//新增数据的id
					$attr = rtrim($data['attr'],'|');
					$attr = explode('|',$attr);
					foreach($attr as $ak=>$av){
						$av = explode(',',$av);
						$array = array(
							'pid'=>$pid,
							'attrid'=>$av[3],
							'attrname'=>$av[4],
							'price'=>$av[0],
							'stock'=>$av[1],
							'number'=>$av[2]
						);
						db('stock')->insert($array);
						// print_r($array);die;
					}
					
					
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
		//分类
		$cateList = $this->cate();
		//品牌
		$brandList = db('brand')->select();
		$this->assign('cateList',$cateList);
		$this->assign('brandList',$brandList);

		//类型
		$typelist = db('type')->select();
		$this->assign('typelist',$typelist);
		//属性
		
		$this->assign('title','商品添加');
		return $this->fetch();
	}

	public function proUpdate(){
		$id = input('id');
		if(request()->isAjax()){
			$data = input('post.');
			// print_r($data);die;
			//上传图片
			$dataImg = $this->upload('ufile');
			if($dataImg){	
				//缩略图
				$thumb = $this->thumb($dataImg[0]);
				//水印
				$this->water($dataImg[0]);

				$data['thumb'] = $thumb;
				$data['picture'] = implode(',', $dataImg);
			}
			$validate = $this->validate($data,[
				'name' => 'require',
				'cid' => 'require',
				'bid' => 'require',
				'price' => 'require',
			]);
			if(true === $validate){
				$product = new Goods();
				$result = $product->allowField(true)->save($data,['id'=>$data['id']]);
				// echo $product->getLastSql();die;
				if($result){
					$info = ["code"=>500,"info"=>true,"msg"=>"编辑成功"];
					return $info;
				}else{
					$info = ["code"=>401,"info"=>false,"msg"=>"编辑失败"];
					return $info;
				}
			}else{
				$info['code'] = 400;
				$info['msg'] = $validate;
				return $info;
			}
		}

		//分类
		$cateList = $this->cate();
		//品牌
		$brandList = db('brand')->select();
		$this->assign('cateList',$cateList);
		$this->assign('brandList',$brandList);
		$one = Db::name('product')->where('id='.$id)->find();
		// $one['picture'] = explode(',', $one['picture']);
		// print_r($one);die;
		$this->assign('one',$one);
		$this->assign('title','商品编辑');
		return $this->fetch();
	}

	public function proDelete(){
		if(request()->isPost()){
			
			$data = input('post.');
			 // print_r($data);die;
			if($data['dropdown'] === 0){
				$this->error('请先选择操作');
			}
			switch($data['dropdown']){
				case 'del':
					$idArr = $data['id'];
					$result = Db::name('product')->delete($idArr);
					if($result){
						$this->success('操作成功','proList');
					}else{
						$this->error('操作失败');
					}
					break;
				case 'check':
					break;
			}
			
		}

		$id = input('id');
		$result = Db::name('product')->where("id=$id")->delete();
		if($result>0){
			$this->success('删除成功','product/proList');die;
		}elseif($result===0){
			$this->success('未删除数据');die;
		}else{
			$this->error('删除失败');die;
		}
	}

	function findattr(){
		$typeid = input('typeid');
		$attr = db('attribute')
		->where(['typeid'=>$typeid])
		->select();
		foreach($attr as $k=>$v){
			$aid = $v['id'];
			$attr[$k]['child']=db('options')->where(['aid'=>$aid])->select();
		}
		// print_r($attr);die;
		return $attr;
	}

	
}



?>