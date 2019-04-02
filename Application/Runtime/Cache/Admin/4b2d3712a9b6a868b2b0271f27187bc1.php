<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta charset="utf-8"/>
<title>后台管理系统</title>
<meta name="author" content="DeathGhost" />
<link rel="stylesheet" type="text/css" href="/goodsManage/Public/css/admin/style.css" />
<!--[if lt IE 9]>
<script src="js/html5.js"></script>
<![endif]-->
<script src="/goodsManage/Public/js/Admin/jquery.js"></script>
<link href="/goodsManage/Public/libs/layer/skin/layer.css" rel="stylesheet">
<script src="/goodsManage/Public/libs/layer/layer.js"></script>
<script src="/goodsManage/Public/js/Admin/jquery.mCustomScrollbar.concat.min.js"></script>
<script src="/goodsManage/Public/js/Admin/provider.js"></script>
<script>
	(function($){
		$(window).load(function(){
			
			$("a[rel='load-content']").click(function(e){
				e.preventDefault();
				var url=$(this).attr("href");
				$.get(url,function(data){
					$(".content .mCSB_container").append(data); //load new content inside .mCSB_container
					//scroll-to appended content 
					$(".content").mCustomScrollbar("scrollTo","h2:last");
				});
			});
			
			$(".content").delegate("a[href='top']","click",function(e){
				e.preventDefault();
				$(".content").mCustomScrollbar("scrollTo",$(this).attr("href"));
			});
			
		});
	})(jQuery);
</script>
</head>
<body>
<!--header-->
<header>
 <h1><img src="/goodsManage/Public/img/admin_logo.png"/></h1>
 <ul class="rt_nav">
  <li><a href="#" class="admin_icon"><?php echo (session('admin')); ?></a></li>
  <li><a href="/goodsManage/index.php/Admin/Addprovider/doLogout" class="quit_icon">安全退出</a></li>
 </ul>
</header>

<!--aside nav-->
<aside class="lt_aside_nav content mCustomScrollbar">
 <h2><a href="/goodsManage/index.php/Admin/Listgoods">管理</a></h2>
 <ul>
 <li>
   <dl>
    <dt>财务管理</dt>
    <dd><a href="/goodsManage/index.php/Admin/Money">资金信息</a></dd>
   </dl>
  </li>
  <li>
   <dl>
    <dt>商品信息</dt>
    <!--当前链接则添加class:active-->
    <dd><a href="/goodsManage/index.php/Admin/Listgoods" class="active">商品列表</a></dd>
    <dd><a href="/goodsManage/index.php/Admin/Addgoods">商品添加</a></dd>
   </dl>
  </li>
  <li>
   <dl>
    <dt>销售管理</dt>
    <dd><a href="/goodsManage/index.php/Admin/Listorder">订单列表</a></dd>
    <dd><a href="/goodsManage/index.php/Admin/Inorder">添加入库单</a></dd>
    <dd><a href="/goodsManage/index.php/Admin/Outorder">添加出库单</a></dd>
   </dl>
  </li>
  <li>
   <dl>
    <dt>供货商管理</dt>
    <dd><a href="/goodsManage/index.php/Admin/Listprovider">供货商列表</a></dd>
    <dd><a href="/goodsManage/index.php/Admin/Addprovider">添加供货商</a></dd>
   </dl>
  </li>

 </ul>
</aside>

<section class="rt_wrap content mCustomScrollbar">
 <div class="rt_content">
   
     <script>
     $(document).ready(function(){
		 //弹出文本性提示框
		 $("#showPopTxt").click(function(){
			 $(".pop_bg").fadeIn();
			 });
		 //弹出：确认按钮
		 $(".trueBtn").click(function(){
			 alert("你点击了确认！");//测试
			 $(".pop_bg").fadeOut();
			 });
		 //弹出：取消或关闭按钮
		 $(".falseBtn").click(function(){
			 alert("你点击了取消/关闭！");//测试
			 $(".pop_bg").fadeOut();
			 });
		 });
     </script>
     
      <section>
      <h2><strong style="color:grey;" >添加供应商(所有信息都必须填写*)</strong></h2>
      <ul class="ulColumn2 goods-add">
       <li>
        <span class="item_name" style="width:120px;">供应商名称：</span>
        <input type="text" class="textbox textbox_295" id="provider_name" placeholder="名称"/>
       </li>
       <li>
        <span class="item_name" style="width:120px;">联系人：</span>
        <input type="text" class="textbox textbox_295" id="provider_person" placeholder="姓名"/>
       </li>
       <li>
        <span class="item_name" style="width:120px;">联系方式：</span>
        <input type="text" class="textbox textbox_295" id="provider_phone" placeholder="电话"/>
       </li>
       <li>
        <span class="item_name" style="width:120px;">所属区域：</span>
        <input type="text" class="textbox textbox_295" id="provider_adress" placeholder="区域"/>
       </li>
       <li>
        <span class="item_name" style="width:120px;"></span>
        <input type="submit" class="link_btn"/>
       </li>
      </ul>
     </section>
    <!--结束：以下内容则可删除，仅为素材引用参考-->
 </div>
</section>
</body>
</html>