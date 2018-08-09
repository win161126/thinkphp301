<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:57:"D:\WWW\tp0301/application/index\view\member\register.html";i:1531839806;s:55:"D:\WWW\tp0301/application/index\view\public\header.html";i:1531793643;s:55:"D:\WWW\tp0301/application/index\view\public\footer.html";i:1531359406;}*/ ?>
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
        <div class="logo"><a href="#"><img src="__PUBLIC__images/logo.jpg" /></a></div>
        <div class="search">
            <div class="left">
                <a href="#">防晒</a>|<a href="#">兰蔻</a>|<a href="#">雅思兰黛</a>|<a href="#">兰芝</a>|<a href="#">眼霜</a>
            </div>
            <input type="text" class="txt" placeholder="搜索你需要的商品" />
            <input type="button" class="btn" />
        </div>
    </div>
    <div class="nav">
        <a href="#" class="all">全部分类</a>
        <?php if(is_array($clist) || $clist instanceof \think\Collection || $clist instanceof \think\Paginator): $i = 0; $__LIST__ = $clist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$cv): $mod = ($i % 2 );++$i;?>
        <a href="<?php echo url('Product/proList',['id'=>$cv['id']]); ?>"><?php echo $cv['name']; ?></a>
        <?php endforeach; endif; else: echo "" ;endif; ?>
    </div>
</div>
<!--header end-->

<!--main start-->
<div class="dl_main">
	<div class="main">
    	<div class="zc_bai">
        	<div class="zc_one">注册COURANT-JET</div>
            <div class="zc_two">
            	<span>邮箱注册</span>
                <span class="sel">短信注册</span>
            </div>
            <ul class="zc_three">
            	<li><input type="text" name="phone" class="txt txt_tell" placeholder="请输入手机号" /></li>
                <!-- <li><input type="text" class="txt txt_yzm" placeholder="请输入验证码" />
                	<input type="button" class="btn_yzm" value="获取验证码" />
                </li> -->
                <li><input type="password" class="txt txt_pwd pwd" placeholder="请输入密码" name="upwd"/></li>
                <li><input type="password" class="txt txt_pwd pwd2" placeholder="请再次输入密码" name="upwd_confirm"/></li>
                <li><input type="button" class="btn btn_zc" value="注 册" /></li>
                <li><a href="#" class="a">已有账号？立即登录</a></li>
            </ul>
        </div>    
    </div>
</div>
<script type="text/javascript" src="js/layer/layer.js"></script>
<script type="text/javascript">
	$(function(){
		//手机号码
		$(".txt_tell").blur(function(){
			if ($(".txt_tell").val() == "") { 
				alert('手机号码不能为空');
			}
			else if (!$(".txt_tell").val().match(/^1([23578])\d{9}$/)) { 
				alert('手机号码格式不正确');
			} 
		})
		//密码
		$(".pwd").blur(function(){
			if ($(".pwd").val() == "") { 
				alert('密码不能为空');
			}
		})
		$(".pwd2").blur(function(){
			if ($(".pwd2").val() == "") 
				alert('再次输入密码不能为空');
			else if($(".pwd2").val()!=$(".pwd").val())
				alert('两次输入的密码不一致');
			
		})
		$(".btn_zc").click(function(){
			if ($(".txt_tell").val() == "") {
				alert('手机号码不能为空');
				return false;
			}
			else if (!$(".txt_tell").val().match(/^1([23578])\d{9}$/)) {
				alert('手机号码格式不正确');
				return false;
			}
			else if($(".txt_yzm").val() == "") {
				alert('验证码不能为空');
				return false;
			}
			else if ($(".pwd").val() == "") { 
				alert('密码不能为空');
				return false;
			}
			else if ($(".pwd2").val() == "") {
				alert('再次输入密码不能为空');
				return false;
			}
			else if($(".pwd2").val()!=$(".pwd").val()){
				alert('两次输入的密码不一致');
				return false;
			}

            var uname = $(".txt_tell").val()
            var upwd = $(".pwd").val()
            var upwd_confirm = $(".pwd2").val()
            $.post("<?php echo url('register'); ?>",{uname:uname,upwd:upwd,upwd_confirm:upwd_confirm},function(data){
                if(data.info){
                    alert(data.msg)
                    location="<?php echo url('login'); ?>"
                }else{
                    alert(data.msg)
                }
            })
		})
		
		//获取验证码 倒计时
		var timer;
		var i;
		function jishi(){
			i=i-1;
			if(i>=1)
				$(".btn_yzm").val(i+"秒后重新获取");
			else{
				$(".btn_yzm").val("免费获取手机验证码");
				$(".btn_yzm").css("background","#F96F41");
				$(".btn_yzm").attr("disabled",false);
				clearInterval(timer);
			}
		}
		$(".btn_yzm").click(function(){
			if($(".txt_tell").val()=="")
				layer.msg('手机号码不能为空，请重新输入',{time: 2000},function(){$(".txt_tell").focus();});
			else if(!$(".txt_tell").val().match(/^1([23578])\d{9}$/))
				layer.msg('手机号码格式不正确，请重新输入',{time: 2000},function(){$(".txt_tell").focus();});
			else{
				$(".btn_yzm").val("60秒后重新获取");
				$(".btn_yzm").css("background","#CCC");
				$(".btn_yzm").attr("disabled","disabled");
				timer=setInterval(jishi, 1000);
				i=60;
			}
		})
	})
</script>
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
