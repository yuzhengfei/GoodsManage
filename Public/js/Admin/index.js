$(function(){
	$('.submit_btn').click(function(e){
		e.preventDefault();
		var name = $('#name').val();
		var password = $('#password').val();
		if(name == '' || password == ''){
			layer.msg('用户名密码不能为空');
			return;
		}
		if(!validate ()){
			return;
		}
		$.ajax({
			url: '/goodsManage/index.php/Admin/Index/login',
			type: 'POST',
			dataType: 'json',
			data: {
				name: name,
				password: password
			},
			success: function(data){
				console.log(data);
				if(data.code == 0){
					window.location = '/goodsManage/index.php/Admin/Index/manage';
				}else{
					layer.msg('用户名或密码错误');
				}
			},
			error: function(xhr){				
				console.log(xhr);
			}
		});
	});
});

