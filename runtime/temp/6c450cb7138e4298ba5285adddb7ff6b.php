<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:53:"D:\WWW\tp0301/application/index\view\index\index.html";i:1531359558;s:55:"D:\WWW\tp0301/application/index\view\public\header.html";i:1531970684;s:55:"D:\WWW\tp0301/application/index\view\public\footer.html";i:1531359406;}*/ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $title; ?></title>
<link rel="stylesheet" type="text/css" href="__PUBLIC__css/css.css"/>
<script type="text/javascript" src="__PUBLIC__js/jQuery.js"></script>
</head>

<body>
<!--header start-->
<div class="header">
    <div class="header_top">
        <div class="main">
            <?php if(session('?uname')): ?>
            <div class="left">欢迎光临法国官网！ &nbsp; <a href="<?php echo url('Member/index'); ?>"><?php echo \think\Session::get('uname'); ?></a>|<a href="<?php echo url('Member/logout'); ?>">退出</a></div>
            <div class="right">
                <a href="<?php echo url('Cart/cartList'); ?>" class="agwc">购物车</a>|<a href="<?php echo url('Member/index'); ?>" class="azh">我的账户</a>
            </div>
            <?php else: ?>
            <div class="left">欢迎光临法国官网！ &nbsp; <a href="<?php echo url('Member/register'); ?>">注册</a>|<a href="<?php echo url('Member/login'); ?>">登录</a></div>   
                
            <?php endif; ?>
        </div>
    </div>
    <div class="main">
        <div class="logo"><a href="<?php echo url('index/index'); ?>"><img src="__PUBLIC__images/logo.jpg" /></a></div>
        <div class="search">
            <form action="<?php echo url('Product/search'); ?>" method="get">
            <div class="left">
                <a href="<?php echo url('Product/search',['keyword'=>'面膜']); ?>">面膜</a>|<a href="<?php echo url('Product/search',['keyword'=>'日日']); ?>">日日</a>|<a href="<?php echo url('Product/search',['keyword'=>'芦荟']); ?>">芦荟</a>
            </div>
            <input type="text" name="keyword" class="txt" placeholder="搜索你需要的商品" />
            <input type="submit" class="btn" value="" />
            </form>
        </div>
    </div>
    <div class="nav">
        <a href="<?php echo url('index/index'); ?>" class="all">全部分类</a>
        <?php if(is_array($clist) || $clist instanceof \think\Collection || $clist instanceof \think\Paginator): $i = 0; $__LIST__ = $clist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$cv): $mod = ($i % 2 );++$i;?>
        <a href="<?php echo url('Product/proList',['id'=>$cv['id']]); ?>"><?php echo $cv['name']; ?></a>
        <?php endforeach; endif; else: echo "" ;endif; ?>
    </div>
</div>
<!--header end-->
<!--main start-->
<div class="focus" id="focus">
    <div id="focus_m" class="focus_m">
        <ul>
            <li><a href="#" style="background:url(__PUBLIC__images/001.jpg) no-repeat top center"></a></li>
            <li><a href="#" style="background:url(__PUBLIC__images/001.jpg) no-repeat top center"></a></li>
            <li><a href="#" style="background:url(__PUBLIC__images/001.jpg) no-repeat top center"></a></li>
        </ul>
    </div>
</div>
<script type="text/javascript" src="__PUBLIC__js/img_qie.js"></script>
<div class="sy_one">
      <ul>
          <li>
              <img src="__PUBLIC__images/img_05.png" class="img" />
              <span><i>满¥299包邮</i><br />全球采购 海淘so easy</span>
          </li>
          <li>
              <img src="__PUBLIC__images/img_06.png" class="img" />
              <span><i>正品保证</i><br />专注美妆护肤38年</span>
          </li>
          <li>
              <img src="__PUBLIC__images/img_07.png" class="img" />
              <span><i>法国直邮</i><br />香港直邮 魅力到家</span>
          </li>
          <li class="li">
              <img src="__PUBLIC__images/img_08.png" class="img" />
              <span><i>30天退货保证</i><br />为您提供售后无忧保障</span>
          </li>
      </ul>
</div>
<div class="main">
	<div class="sy_two">每日特价专区 </div>
    <div class="sy_three">
    	<a href="#" class="sel">彩妆香水</a>
        <a href="#">面部护理</a>
        <a href="#">健康美肌</a>
        <a href="#">个人护理</a>
        <a href="#">男士护理</a>
    </div>
	<script type="text/javascript" src="__PUBLIC__js/bxCarousel.js"></script>
	<div class="sy_four">
        <a href="#" class="prev"></a>
        <a href="#" class="next"></a>
        <ul  id="example">
            <li>
                <div class="img">
                    <a href="#" class="fangda"></a>
                    <a href="#"><img src="__PUBLIC__images/002.jpg"/></a>
                </div>
                <h3><a href="#">LUXE LIP 纯色奢金唇膏</a></h3>
                <p>¥250.00</p>
            </li>
            <li>
                <div class="img">
                    <a href="#" class="fangda"></a>
                    <a href="#"><img src="__PUBLIC__images/002.jpg"/></a>
                </div>
                <h3><a href="#">LUXE LIP 纯色奢金唇膏</a></h3>
                <p>¥250.00</p>
            </li>
            <li>
                <div class="img">
                    <a href="#" class="fangda"></a>
                    <a href="#"><img src="__PUBLIC__images/002.jpg"/></a>
                </div>
                <h3><a href="#">LUXE LIP 纯色奢金唇膏</a></h3>
                <p>¥250.00</p>
            </li>
            <li>
                <div class="img">
                    <a href="#" class="fangda"></a>
                    <a href="#"><img src="__PUBLIC__images/002.jpg"/></a>
                </div>
                <h3><a href="#">LUXE LIP 纯色奢金唇膏</a></h3>
                <p>¥250.00</p>
            </li>
        </ul>
    </div>
    <div class="sy_five">
    	<div class="top"><span>联系我们</span></div>
        <p class="p1">中国 广州市体育中心设计大厦D栋110室</p>
        <p class="p2">客户服务 400-992-0012</p>
        <p class="p3">France@163.com</p>
        <p class="p4">在线咨询彩妆师</p>
    </div>
    <div class="sy_six">
    	<div class="top"><span>购买条约</span></div>
        <div class="bottom">
        	一，快递运费是快递公司收取的 不是我们规定的 既然顾客决定网购运费那  是必须付的 相册有信誉交易截图　 商品都是从厂家直接发出的，不同的厂家邮费也是要分开付<br /><br />
            二，本店一律款到才发货 你不付款哪来的钱付给快递和厂家 微利时代 经不起折腾 介意的勿购<br /><br />
            三，请不要把我家的价格和其他卖家作比较，因为不是同一厂家同一质量的东西，拿来做比较是没意义的
        </div>
    </div>
    <div class="sy_seven">
    	<div class="top"><span>视频连接</span></div>
        <div class="bottom">
        	<a href="#"><img src="__PUBLIC__images/003.jpg" /></a><br />
            <a href="#">[法国商城视频链接]</a>
        </div>
    </div>
    <div class="sy_eight">护肤在线咨询 24hour on line</div>
    <ul class="sy_nine">
    	<li>
        	<img src="__PUBLIC__images/img_09.jpg" class="img" />
            <h3>Rose （资深化妆师）</h3>
            <p>24HOUR ON LINE 免费咨询</p>
        </li>
        <li>
        	<img src="__PUBLIC__images/img_10.jpg" class="img" />
            <h3>Rose （资深化妆师）</h3>
            <p>24HOUR ON LINE 免费咨询</p>
        </li>
        <li class="li">
        	<img src="__PUBLIC__images/img_11.jpg" class="img" />
            <h3>Rose （资深化妆师）</h3>
            <p>24HOUR ON LINE 免费咨询</p>
        </li>
    </ul>
</div>
<!--main end-->
<!--footer start-->
<div class="footer">
	<div class="main">
    	<div class="footer_one">
        	<div class="top"><a href="#"><img src="__PUBLIC__images/img_01.jpg" /></a></div>
            <div class="bottom">
            	快递运费是快递公司收取的 不是我们规定的 既然顾客决定网购运费那  是必须付的 相册有信誉交易截图　 商品都是从厂家直接发出的，不同的厂家邮费也是要分开付
            </div>
            <div class="bottom">
            	<a href="#"><img src="__PUBLIC__images/img_02.png" alt="微信" /></a>
                <a href="#"><img src="__PUBLIC__images/img_03.png" alt="微博" /></a>
                <a href="#"><img src="__PUBLIC__images/img_04.png" alt="QQ" /></a>
            </div>
        </div>
        <ul class="footer_two">
        	<li>
            	<h1>我的账户</h1>
                <p><a href="#">我的账户</a></p>
                <p><a href="#">我的订单</a></p>
                <p><a href="#">退换货问题</a></p>
                <p><a href="#">配送时间</a></p>
            </li>
            <li>
            	<h1>我们的服务</h1>
                <p><a href="#">联系我们</a></p>
                <p><a href="#">装柜导航</a></p>
                <p><a href="#">隐私条款</a></p>
            </li>
            <li>
            	<h1>产品目录</h1>
                <p><a href="#">面部护肤</a></p>
                <p><a href="#">彩妆香水</a></p>
                <p><a href="#">限时特卖</a></p>
                <p><a href="#">贵宾专享</a></p>
            </li>
        </ul>
        <div class="footer_three">
        	<h1>产品搜索</h1>
            <p>
            	<a href="#">防晒</a>
                <a href="#">保湿</a>
                <a href="#">身体乳</a>
                <a href="#">沐浴露</a>
                <a href="#">香水</a>
                <a href="#">化妆水</a>...
            </p>
            <input type="text" class="txt" placeholder="寻找您需要的商品" />
            <input type="button" class="btn" value="SEARCH" />
        </div>
    </div>
    <div class="footer_four">版权所有 ©2015法国化妆品 &nbsp; &nbsp; &nbsp; 策划设计：星珀互动-SANGPER</div>
</div>
<!--footer end-->

</body>
</html>

