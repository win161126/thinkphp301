<?php
namespace app\index\controller;

use think\Controller;

class Product extends Common
{
    public function proList()
    {
    	//导航
        $clist = db('category')->where("fid=2")->select();

        //子分类
        $id = input('id');
        $cone = db('category')->where('id='.$id)->find();
        $childlist = db('category')->where('fid='.$id)->select();


        //品牌
        $blist = db('brand')->select();

         //商品
         //查询条件
        if(input('bid')) $map['bid'] = ['eq',input('bid')];

        if(!input('cid')){
	        $childid = $this->childId($id);//[21,22,23,24]
	        $map['cid'] = ['in',$childid];
        }else{
        	$map['cid'] = ['eq',input('cid')];
        }

        //排序
        if(input('order') == 'price'){
        	$order = 'price desc';
        }elseif(input('order') == 'hot'){

        }elseif(input('order') == 'xiaoliang'){

        }else{
        	$order = 'id desc';
        }
        
        $plist = db('product')->where($map)->order($order)->paginate(9);
        // echo db('product')->getLastSql();
// print_r($plist);die;
        $this->assign([
        	'cone'=>$cone,
        	'clist'=>$clist,
        	'childlist'=>$childlist,
        	'plist'=>$plist,
        	'blist'=>$blist,
        	'cid'=>input('cid'),
        	'title'=>'商品列表'
        ]);
        return $this->fetch();
    }

    function childId($id=0,$list=[],$spec=0){
    	if($spec==0) $list[]=$id;
		$fid = $id;
		$parentlist = db('category')->where("fid=$fid")->select();
		foreach($parentlist as $k=>$v){
			$list[] = $v['id'];
			$list = $this->childId($v['id'],$list,$spec+1);
		}
		return $list;
	}

	public function detail(){
		$id = input('id');
		$product = db('product')->where('id='.$id)->find();
		$product['picture'] = explode(',', $product['picture']);
// print_r($product);die;
		//导航
        $clist = db('category')->where("fid=2")->select();
		$this->assign([
			'product'=>$product,
			'clist'=>$clist,
			'title'=>'商品详情'
		]);
		return $this->fetch();
	}

    public function search(){
        $keyword = input('keyword');
        $map['name'] = ['like','%'.$keyword.'%'];
        $plist = db('product')->where($map)->paginate(2);
        $this->assign([
            'title'=>'搜索商品',
            'plist'=>$plist
            ]);
        return $this->fetch();
    }
}
