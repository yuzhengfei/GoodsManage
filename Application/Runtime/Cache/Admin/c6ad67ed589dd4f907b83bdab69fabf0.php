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
<script src="/goodsManage/Public/js/Admin/jquery.js"></script>
<script src="/goodsManage/Public/libs/layer/layer.js"></script>
<script src="/goodsManage/Public/js/Admin/jquery.mCustomScrollbar.concat.min.js"></script>
<script src="/goodsManage/Public/libs/art-template/dist/template.js"></script>
<script src="/goodsManage/Public/js/Admin/inorder.js"></script>
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
  <li><a href="/goodsManage/index.php/Admin/Inorder/doLogout" class="quit_icon">安全退出</a></li>
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
     <!--点击加载-->
     <script>
     $(document).ready(function(){
		$("#loading").click(function(){
			$(".loading_area").fadeIn();
             $(".loading_area").fadeOut(1500);
			});
		 });
     </script>
     <section class="loading_area">
      <div class="loading_cont">
       <div class="loading_icon"><i></i><i></i><i></i><i></i><i></i></div>
       <div class="loading_txt"><mark>数据正在加载，请稍后！</mark></div>
      </div>
     </section>
     <!--结束加载-->

     <section>
      <h2><strong style="color:grey;">添加入库单</strong></h2>
      <ul class="ulColumn2">
       <li>
        <span class="item_name" style="width:120px;">单据编号：</span>
        <input type="text" class="textbox textbox_295" id="order_number" placeholder="类型缩写加日期"/>
       </li>       
       <li>
        <span class="item_name" style="width:120px;">经办人：</span>
        <select class="select" id="user_id">
          <?php if(is_array($arr)): foreach($arr as $key=>$user): ?><option value="<?php echo ($user["id"]); ?>"><?php echo ($user["name"]); ?></option><?php endforeach; endif; ?>  
        </select>
       </li>
       <li>
        <span class="item_name" style="width:120px;">供应商：</span>
        <select class="select" id="provider_id">
          <?php if(is_array($arrP)): foreach($arrP as $key=>$provider): ?><option value="<?php echo ($provider["id"]); ?>"><?php echo ($provider["name"]); ?></option><?php endforeach; endif; ?>  
        </select>
       </li>
       <li>
        <span class="item_name" style="width:120px;">商品选择：</span>
        <select class="select" id="goods_id">
          <?php if(is_array($arrG)): foreach($arrG as $key=>$goods): ?><option value="<?php echo ($goods["id"]); ?>"><?php echo ($goods["name"]); ?></option><?php endforeach; endif; ?>  
        </select>
       </li>       
       <li>
        <span class="item_name" style="width:120px;">金额：</span>
        <input type="text" class="textbox textbox_295" id="money" />
       </li>
       <li>
        <span class="item_name" style="width:120px;">数量：</span>
        <input type="text" class="textbox textbox_295" id="count" />
        <button class="link_btn" id="addgoods">添加</button>
       </li>  
       
      <h2><strong style="color:grey;">商品详情列表</strong></h2>
      <table class="table" id="goodsdetail">
       <tr>
        <th>名称</th>
        <th>数量</th>
        <th>进价</th>
        <th>操作</th>
        <th></th>
       </tr>
       <?php if(is_array($goodsList)): $i = 0; $__LIST__ = $goodsList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?><tr data-id=<?php echo ($item["id"]); ?>>
            <td style="width:120px;"><div class="cut_title ellipsis"><?php echo ($item["name"]); ?></div></td>
            <td><?php echo ($item["count"]); ?></td>
            <td><?php echo ($item["price"]); ?></td>
            <td><a href="#" class="inner_btn">删除</a></td>
         </tr><?php endforeach; endif; else: echo "" ;endif; ?>
      </table>

       <li>
        <span class="item_name" style="width:120px;"></span>
        <input type="submit" class="link_btn" id="addorder"/>
       </li>
      </ul>
     </section>
     <!--tabStyle-->
     <script id="item-template" type="text/html">
      <tr data-id="{{item.id}}">
            <td style="width:120px;"><div class="cut_title ellipsis">{{item.goodsname}}</div></td>
            <td>{{item.count}}</td>
            <td>{{item.price}}</td>
            <td><a href="#" class="inner_btn">删除</a></td>
         </tr>
    </script>
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
 </div>
</section>
</body>
</html>