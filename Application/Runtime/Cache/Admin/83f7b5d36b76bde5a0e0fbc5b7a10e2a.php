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
<link href="/goodsManage/Public/libs/layer/skin/layer.css" rel="stylesheet">
<script src="/goodsManage/Public/libs/layer/layer.js"></script>
<script src="/goodsManage/Public/js/Admin/jquery.js"></script>
<script src="/goodsManage/Public/js/Admin/jquery.mCustomScrollbar.concat.min.js"></script>
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
  <li><a href="/goodsManage/index.php/Admin/Index/doLogout" class="quit_icon">安全退出</a></li>
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
     <!--开始：以下内容则可删除，仅为素材引用参考-->
     <!--  -->
 </div>
</section>
</body>
</html>