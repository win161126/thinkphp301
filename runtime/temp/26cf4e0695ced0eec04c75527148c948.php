<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:55:"D:\WWW\tp0301/application/index\view\cart\cartList.html";i:1531816426;s:55:"D:\WWW\tp0301/application/index\view\public\header.html";i:1531793643;s:55:"D:\WWW\tp0301/application/index\view\public\footer.html";i:1531359406;}*/ ?>
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
<div class="gw_one">
	<ul>
    	<li class="sel">
        	<em>1</em>
            <span><i>购物车</i><br />Shopping Cart</span>
        </li>
        <li>
        	<em>2</em>
            <span><i>填写核对订单</i><br />Delivery & Payment</span>
        </li>
        <li class="li">
        	<em>3</em>
            <span><i>订单支付成功</i><br />Complete Order</span>
        </li>
    </ul>
</div>
<div class="main">
	<div class="gw_two">购物车列表</div>
  <table class="gw_three" cellpadding="0" cellspacing="0">
    	<tr>
        	<th width="92" height="53"><label><input type="checkbox" class="ck_all" /> 全选</label></th>
            <th width="574">商品名称</th>
            <th width="108">数量</th>
            <th width="254">小计</th>
            <th width="150">操作</th>
        </tr>
        <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$cv): $mod = ($i % 2 );++$i;?>
        <tr>
        	<td><input type="checkbox" class="ck" name="id[]" value="<?php echo $cv['id']; ?>"/></td>
            <td>
            	<a href="<?php echo url('Product/detail',['id'=>$cv['pid']]); ?>" class="img"><img src="<?php echo $cv['thumb']; ?>" /></a>
                <div class="left">
                	<a href="<?php echo url('Product/detail',['id'=>$cv['pid']]); ?>"><?php echo $cv['name']; ?></a><br />
                    <!-- 颜色 : 浅棕色 -->
                </div>
            </td>
            <td>
            	<input type="button" class="btn_jian num_jian" value="-" />
                <input type="text" class="txt_num" value="<?php echo $cv['num']; ?>" />
                <input type="button" class="btn_jia num_jia" value="+" />
            </td>
            <td class="price" val="<?php echo $cv['price']; ?>">¥ <?php echo $cv['total']; ?></td>
            <td class="cz"><input type="button" class="btn_del" /></td>
        </tr>
       <?php endforeach; endif; else: echo "" ;endif; ?>
    </table>
</div>
<div class="gw_four">
	<div class="main">
    	<div class="left">
        	<label><input type="checkbox" class="ck_all" /> 全选</label>|<a href="javascript:void(0)" class="del">删除</a>
            <br /><br /><br />
            <input type="button" class="btn" value="上一步" />
        </div>
        <div class="right">
        	<p>商品数量总计 : <b class="b_num">0</b>件</p>
            <p>商品金额总计（不含运费）:<span class="span_total">¥ 0</span></p>
            <input type="button" class="btn btn_next" value="下一步" />
        </div>
    </div>
</div>
<!--main end-->
<script type="text/javascript">
	$(function(){
		//数量加
		$(".num_jia").each(function(a){
		
			$(this).click(function(){
				var i=parseInt($(".txt_num").eq(a).val());
				i=i+1;
				$(".txt_num").eq(a).val(i);
                //计算小计
                
                var price = $(this).parent().next().attr('val')
                $(this).parent().next().text('￥ '+price*i)
                total_price()
			})
		})
		//数量减
		$(".num_jian").each(function(a){
			$(this).click(function(){
				var i=parseInt($(".txt_num").eq(a).val());
				if(i>1)
				{
					i=i-1;
					$(".txt_num").eq(a).val(i);
				}
                //计算小计
				var price = $(this).parent().next().attr('val')
                $(this).parent().next().text('￥ '+price*i)
                total_price()
			})
		})

        $('.ck').click(function(){
            var ck_ll_bool = $('.ck_all').is(":checked")
            if(ck_ll_bool) $('.ck_all').prop('checked',false)
            total_price()
        })

        $('.ck_all').click(function(){
            var bool = $(this).is(":checked")
            if(bool){
                $('.ck_all').prop('checked',true)
                $('.ck').prop('checked',true)
                total_price()
            }else{
                $('.ck_all').prop('checked',false)
                $('.ck').prop('checked',false)
                $('.b_num').text(0)
                $('.span_total').text(0)
            }
            
        })

        //单个删除
        $('.btn_del').each(function(a){
            $(this).click(function(){
                var id = $(this).parent().parent().find('.ck').val()
                var obj = $(this)
                $.post("<?php echo url('onedel'); ?>",{id:id},function(data){
                    if(data.info){
                        obj.parent().parent().remove()
                    }
                    total_price()
                })
            })
        })

        //批量删除
        $('.del').click(function(){
            var allid = []
            $('.ck:checked').each(function(){
                allid.push($(this).val())
            })
            if(allid==''){
                alert('至少选择一个商品')
            }else{
                $.post("<?php echo url('alldel'); ?>",{id:allid},function(data){
                    if(data.info){
                        $('.ck:checked').each(function(){
                            $(this).parent().parent().remove()
                        })
                    }
                    $('.ck_all').prop('checked',false)
                    total_price()
                })
            }
        })

        //下一步，检测数据，更改购物车选中数据
        $('.btn_next').click(function(){
            var data = []
            $('.ck:checked').each(function(){
                var select = []
                select.push($(this).val())
                select.push($(this).parent().parent().find('.txt_num').val())
                data.push(select)
            })
            //[6,6]   [[6,6],[7,9]]
            if(data==''){
                alert('至少选择一个商品')
            }else{
                $.post("<?php echo url('check'); ?>",{data:data},function(data){
                    if(data.info){
                        location="<?php echo url('confirm'); ?>"
                    }
                })
            }
        })
	})
    function total_price(){
        var num = 0
        var total = 0
        $('.ck').each(function(){
            
            var bool = $(this).is(":checked")
            if(bool){
                //数量
                var cnum = parseInt($(this).parent().parent().find('.txt_num').val())
                num = num+cnum

                //价格
                var cprice = $(this).parent().parent().find('.price').text()
                cprice = parseFloat(cprice.substr(2))
                total = total+cprice
            }
        })
        $('.b_num').text(num)
        $('.span_total').text(total)
    }
</script>
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
