$(function(){

    // 添加书籍
    $(document).on('click','.link_btn',function(){

            var name = document.getElementById("provider_name").value;

            var person = document.getElementById("provider_person").value;

            var phone = document.getElementById("provider_phone").value;
    
            var adress = document.getElementById("provider_adress").value;
            
            var param = {
                name: name,
                person: person,
                phone: phone,
                adress: adress  
            };
            $.ajax({
                url: '/goodsManage/index.php/Admin/Addprovider/providerAdd',
                type: 'POST',
                dataType: 'json',
                data: param,
                success: function(data){
                    console.log(data);
                    if(data.code == 0){
                        //var html = template('provider_template',data);
                        //$tbody.prepend(html);
                        layer.msg('添加成功',{icon: 1});
                    }
                },
                error: function(xhr){
                    console.log(xhr);
                }
            });
    });

});
