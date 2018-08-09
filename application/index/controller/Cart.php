<?php
namespace app\index\controller;

use think\Controller;
use think\Db;

class Cart extends Common
{
    public function addCart()
    {
    	$info = ['code'=>0,'info'=>false,'msg'=>''];
        //判断是否登录
        if(!session('?uname')){
        	$info = ['code'=>400,'info'=>false,'msg'=>'请先登录'];
        	return $info;
        }

        //判断购物车中是否存在该商品
        $data['mid'] = session('unameId'); 
        $data['pid'] = input('pid');
        $num = input('num');
        $isHas = db('cart')->where($data)->find();//查询当前用户当前商品是否已存在购物车表
        if($isHas){
        	//存在，改变购买数量
        	$result = db('cart')->where('id='.$isHas['id'])->setInc('num',$num);
        }else{
        	//不存在，添加一条购物车信息
        	$data['num'] = $num;
        	$data['ctime'] = time();
        	$result = db('cart')->insert($data);
        }
        if($result>0){
        	$info = ['code'=>500,'info'=>true,'msg'=>'已加入购物车'];
        	return $info;
        }else{
        	$info = ['code'=>401,'info'=>false,'msg'=>'加入购物车失败'];
        	return $info;
        }
    }

    public function cartList(){
    	$mid = session('unameId');
    	$list = db('cart')
    	->alias('c')
    	->field('c.*,p.name,p.thumb,p.price')
    	->join('__PRODUCT__ p','c.pid=p.id','LEFT')
    	->where("mid=$mid")
    	->select();

    	foreach($list as $k=>&$v){
			$v['thumb'] = substr($v['thumb'],1);
			$v['total'] = $v['num']*$v['price'];
    	}
    	// print_r($list);die;

    	$this->assign([
    		'list'=>$list,
    		'title'=>'购物车'
    	]);
    	return $this->fetch();
    }

    function onedel(){
    	$id = input('id');
    	$result = db('cart')->delete($id);
    	if($result>0){
    		return ['info'=>true];
    	}
    }

    function alldel(){
    	$allid = input();
    	$result = db('cart')->delete($allid['id']);
    	if($result>0){
    		return ['info'=>true];
    	}
    }

    //验证
    function check(){
        $data = input('post.');
        // print_r($data);
        $map['mid'] = session('unameId');
        $arr = ['state'=>0];
        db('cart')->where($map)->update($arr);//初始化购物车状态
        foreach($data['data'] as $k=>$v){
            db('cart')->where(['id'=>$v[0]])->update(['num'=>$v[1],'state'=>1]);
        }
        return ['info'=>true];
    }

    //核对订单
    public function confirm(){
        $mid = session('unameId');
        $list = db('cart')
        ->alias('c')
        ->field('c.*,p.name,p.thumb,p.price')
        ->join('__PRODUCT__ p','c.pid=p.id','LEFT')
        ->where("mid=$mid and state=1")
        ->select();

        $num = 0;
        $total = 0;
        foreach($list as $k=>&$v){
            $v['thumb'] = substr($v['thumb'],1);
            $v['total'] = $v['num']*$v['price'];

            $num += $v['num'];
            $total += $v['total'];
        }
        $map['mid'] = $mid;
        $addrlist = db('address')->where($map)->select();
        $this->assign([
            'addrlist'=>$addrlist,
            'list'=>$list,
            'num'=>$num,
            'total'=>$total,
            'title'=>'核对订单'
        ]);
        return $this->fetch();
    }

    //订单处理
    function orders(){
        $data = [];
        $data['orderid'] = date('Ymd').session('unameId').mt_rand(10000,99999);
        $data['mid'] = session('unameId');
        $addr = db('address')->where(['id'=>input('post.addressid')])->find();
        $data['linkman'] = $addr['linkman'];
        $data['mobile'] = $addr['mobile'];
        $data['address'] = $addr['province'].$addr['city'].$addr['country'].$addr['address'];
        $data['state'] = input('post.state');
        $data['status'] = 0;
        $data['ctime'] = time();
        // print_r($data);die;
        //把所要购买的商品信息查询  商品id，商品价格，购买数量
        $product = db('cart')
        ->alias('c')
        ->field('c.*,p.price')
        ->join('__PRODUCT__ p','c.pid=p.id','LEFT')
        ->where(['mid'=>session('unameId'),'state'=>1])
        ->select();

        $num1 = count($product);

        //开启事务
        Db::startTrans();

        //添加数据到订单表
        $num2 = 0;
        foreach($product as $k=>$v){
            $data['pid'] = $v['pid'];
            $data['num'] = $v['num'];
            $data['price'] = $v['num']*$v['price'];
            $num2 += db('orders')->insert($data);
        }

        //删除生成订单的购物车商品
        $num3 = db('cart')->where(['mid'=>session('unameId'),'state'=>1])->delete();

        if($num1 == $num2 && $num2 == $num3){
            //提交事务
            Db::commit(); 
            $info = ['info'=>true,'msg'=>'','orderid'=>$data['orderid']];
            return $info; 
        }else{
            //回滚事务
            Db::rollback();
            $info = ['info'=>false,'msg'=>'提交失败','orderid'=>''];
            return $info;
        }

    }

    function pay($orderid){
        $orders = db('orders')->where(['orderid'=>$orderid])->select();
        $state = $orders[0]['state'];//支付方式
        $total = 0;
        foreach($orders as $k=>$v){
            $total += $v['price'];
        }
        switch($state){
            case 1:
                //支付宝支付
                alipay($orderid,$total,'测试','描述');
                break;
            case 2:
                //余额支付
                $this->assign([
                    'title'=>'支付密码',
                    'orderid'=>$orderid,
                    'total'=>$total
                ]);
                return $this->fetch();
                break;
        }
    }

    function payment(){
        //余额支付处理
        $orderid = input('post.orderid');
        $total = input('post.total');
        $pwd = input('post.pwd');
        
        $info = ['info'=>false,'msg'=>''];
        //验证支付密码是否正确
        $mid = session('unameId');
        $member = db('money')->where(['mid'=>$mid])->find();
        if($member['pwd'] == $pwd){
            //判断余额
            if($member['cash'] < $total){
                $info['code'] = 400;
                $info['msg'] = '余额不足';
                return $info;
            }
            //余额充足
            //开启事务
            Db::startTrans();
            //用户账号减去支付金额
            $result1 = db('money')->where(['mid'=>$mid])->setDec('cash',$total);
            //商家账号加上支付金额
            $result2 = db('money')->where(['mid'=>0])->setInc('cash',$total);
            //修改支付状态
            $result3 = db('orders')->where(['orderid'=>$orderid])->update(['status'=>1]);

            if($result1 && $result2 && $result3){
                Db::commit();//提交事务
                $info = ['info'=>true,'msg'=>'支付成功'];
                return $info;
            }else{
                DB::rollback();//回滚事务
                $info = ['msg'=>'支付失败'];
                return $info;
            }

        }else{
            $info['msg'] = '支付密码错误';
            return $info;
        }

    }

    function chenggong(){
        $this->assign('title','成功');
        return $this->fetch();
    }
    function shibai(){
        $this->assign('title','失败');
        return $this->fetch();
    }

    function return_url(){
        return_url();
    }

    function notify_url(){
        notify_url();
    }

    
}
