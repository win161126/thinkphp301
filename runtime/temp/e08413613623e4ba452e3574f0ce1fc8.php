<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:56:"D:\WWW\tp0301/application/index\view\product\detail.html";i:1531810754;s:55:"D:\WWW\tp0301/application/index\view\public\header.html";i:1531970684;s:55:"D:\WWW\tp0301/application/index\view\public\footer.html";i:1531359406;}*/ ?>
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
<div class="main">
	<div class="wei"><a href="#">首页</a>/<a href="#">产品分类</a>/<a href="#">彩妆</a>/<span>雅思兰黛</span></div>
    <div class="cp_five">
    	<table class="top"><tr><td><img src="<?php echo substr($product['picture'][0],1); ?>" /></td></tr></table>
        <ul>
        <?php if(is_array($product['picture']) || $product['picture'] instanceof \think\Collection || $product['picture'] instanceof \think\Paginator): $i = 0; $__LIST__ = $product['picture'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$pic): $mod = ($i % 2 );++$i;?>
        	<li class="sel"><img src="<?php echo substr($pic,1); ?>" /></li>
        <?php endforeach; endif; else: echo "" ;endif; ?>
            
        </ul>
        <script type="text/javascript">
        	$(function(){
				$(".cp_five ul li").click(function(){
					$(".cp_five ul li").removeClass("sel");
					$(this).addClass("sel");
					$(".cp_five .top img").attr("src",$(this).find("img").attr("src"));
					return false;
				})
			})
        </script>
    </div>
    <div class="cp_six">
    <input type="hidden" id="pid" value="<?php echo $product['id']; ?>">
    	<h1><?php echo $product['name']; ?></h1>
        <h5><?php echo $product['number']; ?></h5>
        <h3><?php echo $product['introduction']; ?></h3>
        <div class="price">
        	<span>¥ <?php echo $product['price']; ?></span>专柜价 ：¥ <?php echo $product['market']; ?>
        </div>
        <div class="xiala">
        	<select>
            	<option>10 Pearly Cold Pink</option>
            </select>
            <select>
            	<option>3.5g</option>
            </select>
        </div>
        <ul>
        	<li><span>购买数量</span>
            	<input type="button" class="btn num_jian" value="-" />
                <input type="text" class="txt" id="num" value="1" />
                <input type="button" class="btn num_jia" value="+" />
            </li>
            <li><span>所有色号</span>
            	<p class="yanse">
                	<i style="background:#D47F92" class="sel"></i>
                    <i style="background:#F1A78A"></i>
                    <i style="background:#B16569"></i>
                    <i style="background:#EB553C"></i>
                    <i style="background:#F574AA"></i>
                    <i style="background:#A81D34"></i>
                    <i style="background:#865C9C"></i>
                </p>
                <script type="text/javascript">
                	$(".yanse i").click(function(){
						$(".yanse i").removeClass("sel");
						$(this).addClass("sel");
					})
                </script>
            </li>
        </ul>
        <div class="desc">
        	发送门店 &nbsp; &nbsp; &nbsp; 此货品将由法国商城为您发货，预计1-3个工作日送达<br />
            温馨提示 &nbsp; &nbsp; &nbsp; 本商品支持7天无理由退换货品 支持货到付款
        </div>
        <input type="button" class="btn_gwc" value="添加购物车" />
        <input type="button" class="btn_gm" value="立即购买" />
    </div>
    <div class="cp_br"></div>
    <div class="cp_seven">
    	<div class="top">同品牌推荐</div>
        <ul>
        	<li>
            	<a class="img" href="#"><img src="__PUBLIC__images/006.jpg" /></a>
                <div class="right">
                	<a href="#">法国商城纯色恒彩唇膏</a><br />
                    ¥ 520.00
                </div>
            </li>
            <li>
            	<a class="img" href="#"><img src="__PUBLIC__images/006.jpg" /></a>
                <div class="right">
                	<a href="#">法国商城纯色恒彩唇膏</a><br />
                    ¥ 520.00
                </div>
            </li>
            <li>
            	<a class="img" href="#"><img src="__PUBLIC__images/006.jpg" /></a>
                <div class="right">
                	<a href="#">法国商城纯色恒彩唇膏</a><br />
                    ¥ 520.00
                </div>
            </li>
            <li>
            	<a class="img" href="#"><img src="__PUBLIC__images/006.jpg" /></a>
                <div class="right">
                	<a href="#">法国商城纯色恒彩唇膏</a><br />
                    ¥ 520.00
                </div>
            </li>
            <li>
            	<a class="img" href="#"><img src="__PUBLIC__images/006.jpg" /></a>
                <div class="right">
                	<a href="#">法国商城纯色恒彩唇膏</a><br />
                    ¥ 520.00
                </div>
            </li>
        </ul>
    </div>
    <div class="cp_eight">
    	<?php echo $product['content']; ?>
    </div>
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

<script>
$(function(){
    //数量加
    $(".num_jia").click(function(){
        var i=parseInt($(this).prev().val());
        i=i+1;
        $(this).prev().val(i);
    })
    //数量减
    $(".num_jian").click(function(){
        var i=parseInt($(this).next().val());
        if(i>1)
        {
            i=i-1;
            $(this).next().val(i);
        }
    })

    $(".num").blur(function(){
        var i=parseInt($(this).val());
        $(this).val(i);
    })


    $('.btn_gwc').click(function(){
        var pid = $('#pid').val()
        var num = $('#num').val()
        $.post("<?php echo url('Cart/addCart'); ?>",{pid:pid,num:num},function(data){
            if(data.code == 400){
                alert(data.msg)
                location = "<?php echo url('Member/login'); ?>"
            }
            alert(data.msg)
        })
    })
})
</script>