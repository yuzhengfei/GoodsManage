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
<script src="/goodsManage/Public/js/Admin/deletegoods.js"></script>

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
  <li><a href="/goodsManage/index.php/Admin/Listgoods/doLogout" class="quit_icon">安全退出</a></li>
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
		$("#loading").click(function(){
			$(".loading_area").fadeIn();
             $(".loading_area").fadeOut(1500);
			});
		 });
    </script>
   
  
         <script>
          $(document).ready(function(){
          //弹出文本性提示框
          $("#updatabtn").click(function(){
               $(".pop_bg").fadeIn();
                   var product = $(this).parents('tr');
                   var id = product.attr('data-id');

                     $.ajax({
                          url: '/goodsManage/index.php/Admin/Listgoods/updatGoods',
                          type: 'POST',
                          dataType: 'json',
                          data: {id: id},
                          success: function(data){
                              if(data.code == 0){
                                    console.log("获取成功");
                                    //window.location= '/goodsManage/index.php/Admin/Listgoods/index';
                              }
                              console.log(data);
                          },
                          error: function(xhr){
                              alert("获取失败");
                              console.log(xhr);
                          }
                    });

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

       <section class="pop_bg">
      <div class="pop_cont">
       <!--title-->
       <h3>修改商品信息</h3>
       <!--content-->
       <div class="pop_cont_input">
        <ul>
         <li>
          <span>名　称：</span>
          <input type="text" placeholder="11" class="textbox"/>
         </li>
          <li>
          <span>简　介：</span>
          <input type="text" placeholder="212" class="textbox"/>
         </li>
         <li>
          <span>数　量：</span>
          <input type="text" placeholder="<?php echo ($vo["count"]); ?>" class="textbox"/>
         </li>
          <li>
          <span>进　价：</span>
          <input type="text" placeholder="<?php echo ($vo["sellingPrice"]); ?>" class="textbox"/>
         </li>
          <li>
          <span>售　价：</span>
          <input type="text" placeholder="<?php echo ($vo["purchasePrice"]); ?>" class="textbox"/>
         </li>
          <li>
          <span>供应商：</span>
          <input type="text" placeholder="<?php echo ($vo["provider"]); ?>" class="textbox"/>
         </li>
        </ul>
  
       </div>
       <!--以pop_cont_text分界-->
       <div class="pop_cont_text">
        <!-- 这里是文字性提示信息！ -->
       </div>
       <!--bottom:operate->button-->
       <div class="btm_btn">
        <input type="button" value="确认" class="input_btn trueBtn"/>
        <input type="button" value="关闭" class="input_btn falseBtn"/>
       </div>
      </div>
     </section>
     <!--结束：弹出框效果-->

     <section>
      <h2><strong style="color:grey;">商品详情列表</strong></h2>
      <div class="page_title">
       <h2 class="fl"></h2>
       <a href="/goodsManage/index.php/Admin/Addgoods" class="fr top_rt_btn">添加商品</a>
      </div>
      <table class="table">
       <tr>
        <th>名称</th>
        <th>图片</th>
        <th>简介</th>
        <th>数量</th>
        <th>进价</th>
        <th>售价</th>
        <th>供应商</th>
        <th>操作</th>
       </tr>
       <?php if(is_array($goodsArr)): $i = 0; $__LIST__ = $goodsArr;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?><tr data-id="<?php echo ($item["id"]); ?>">
		        <td style="width:120px;">
                          <div class="cut_title ellipsis"  ><?php echo ($item["name"]); ?></div>
                    </td>
		        <td><?php echo ($item["img"]); ?></td>
		        <td><?php echo ($item["info"]); ?></td>
		        <td><?php echo ($item["count"]); ?></td>
		        <td><?php echo ($item["sellingprice"]); ?></td>
		        <td><?php echo ($item["purchaseprice"]); ?></td>
		        <td><?php echo ($item["provider"]); ?></td>
		        <td>
		        	<!--<a href="#" class="inner_btn updatabtn">编辑</a>-->
				<a href="#" class="inner_btn deletebtn">删除</a>
				</td>
	       </tr><?php endforeach; endif; else: echo "" ;endif; ?>
      </table>
     </section>
 </div>
</section>
</body>
</html>