$(function(){

	$(document).on('click','#addorder',function(){

			var orderNumber = document.getElementById("order_number").value;
			var userId = document.getElementById("user_id").value;
			var providerId = document.getElementById("provider_id").value;
			
			var param = {
				orderNumber: orderNumber,
                userId: userId,
				providerId: providerId
			};
			$.ajax({
				url: '/goodsManage/index.php/Admin/Inorder/orderAdd',
				type: 'POST',
				dataType: 'json',
				data: param,
				success: function(data){
					console.log(data);
					if(data.code == 0){
						layer.msg('入库成功',{icon: 1});						
					}
				},
				error: function(xhr){
					console.log(xhr);
				}
			});
	});

	$(document).on('click','#addgoods',function(){

		    var goodsId = document.getElementById("goods_id").value;
			var money = document.getElementById("money").value;
			var count = document.getElementById("count").value;
			var orderNumber = document.getElementById("order_number").value;
			var price = money*count;
			var param = {
				goodsId: goodsId,
                price: price,
				count: count,
				money: money,
				orderNumber: orderNumber
			};
			$.ajax({
				url: '/goodsManage/index.php/Admin/Inorder/goodsAdd',
				type: 'POST',
				dataType: 'json',
				data: param,
				success: function(data){
					console.log(data);
					if(data.code == 0){
						layer.msg('添加成功',{icon: 1});
						var html = template('item-template',data);
						$('#goodsdetail').append(html);				        
					}					
				},
				error: function(xhr){
					console.log(xhr);
				}
			});
    });

    	$(document).on('click','.inner_btn',function(){
		    var $tr = $(this).parents('tr');
		    var id = $tr.attr('data-id');
		    layer.confirm('确认删除？', {
		  	btn: ['是的','取消'] //按钮
		    }, function(){
			var param = {
				id: id
			};
			$.ajax({
				url: '/goodsManage/index.php/Admin/Inorder/goodsDelete',
				type: 'POST',
				dataType: 'json',
				data: param,
				success: function(data){
					console.log(data);
					if(data.code == 0){
						layer.msg('删除成功', {icon: 1});
						$tr.remove();
					}
				},
				error: function(xhr){
					console.log(xhr);
				}
			});
		  	
		}, function(){
		  	//layer.msg('取消');
		});
    });
});
