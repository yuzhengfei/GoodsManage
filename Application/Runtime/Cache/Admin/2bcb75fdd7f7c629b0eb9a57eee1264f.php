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
  <li><a href="/goodsManage/index.php/Admin/Money/doLogout" class="quit_icon">安全退出</a></li>
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
     <section>
      <h2><strong style="color:grey;">资金流动信息</strong></h2>
      <div class="page_title">
       <h2 class="fl"></h2>
      
      </div>
      <table class="table">
       <tr>
        <th>类型</th>
        <th>单据编号</th>
        <th>金额</th>
        <th>经手人</th>
       </tr>
       <?php if(is_array($moneyArr)): $i = 0; $__LIST__ = $moneyArr;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?><tr data-id="<?php echo ($item["id"]); ?>">
            <td style="width:120px;"><div class="cut_title ellipsis">商品<?php echo ($item["typename"]); ?></div></td>
            <td><?php echo ($item["ordernumber"]); ?></td>
            <td><?php echo ($item["price"]); ?> ￥</td>
          <td><?php echo ($item["username"]); ?></td>
         </tr><?php endforeach; endif; else: echo "" ;endif; ?>
      </table>
     </section>
     <!--tabStyle-->
     <script>
     $(document).ready(function(){
     //tab
     $(".admin_tab li a").click(function(){
      var liindex = $(".admin_tab li a").index(this);
      $(this).addClass("active").parent().siblings().find("a").removeClass("active");
      $(".admin_tab_cont").eq(liindex).fadeIn(150).siblings(".admin_tab_cont").hide();
     });
     });
     </script>
    
   

  
    <!--结束：以下内容则可删除，仅为素材引用参考-->
 </div>
</section>
</body>
</html>