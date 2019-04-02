$(function(){

	// 添加
	$(document).on('click','.link_btn',function(){

			var goodsname = document.getElementById("goods_name").value;
			var provider = document.getElementById("goods_provider").value;
			var img = document.getElementById("goods_img").value;
			var info = document.getElementById("goods_info").value;
			
			var param = {
				goodsname: goodsname,
                img: img,
				info: info,
				provider: provider	
			};
			$.ajax({
				url: '/goodsManage/index.php/Admin/Addgoods/goodsAdd',
				type: 'POST',
				dataType: 'json',
				data: param,
				success: function(data){
					console.log(data);
					if(data.code == 0){
						layer.msg('添加成功',{icon: 1});
					}
				},
				error: function(xhr){
					console.log(xhr);
				}
			});
	});

});
