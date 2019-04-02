$(function(){
    $('.deletebtn').click(function(){
        var product = $(this).parents('tr');
        var id = product.attr('data-id');

            $.ajax({
            url: '/goodsManage/index.php/Admin/Listgoods/deleteGoods',
            type: 'POST',
            dataType: 'json',
            data: {id: id},
            success: function(data){
                if(data.code == 0){
                      console.log("删除成功");
                      product.remove();
                      window.location= '/goodsManage/index.php/Admin/Listgoods/index';

                }
                console.log(data);
            },
            error: function(xhr){
                alert("删除失败");
                console.log(xhr);
            }
        });

    });
    
});