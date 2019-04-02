<?php
namespace Admin\Controller;
use Think\Controller;
class AddproviderController extends Controller {
    // 后台登录页
    public function index(){
        if(isset($_SESSION['admin'])){
 
            $this->display();
        }else{
            $url = 'http://localhost/goodsManage/index.php/Admin/Index/manage';
            header("location: $url");
        }
    }

    public function providerAdd($name,$person,$phone,$adress){
        //$name = $_POST['name'];
       // $person = $_POST['person'];
        //$phone = $_POST['phone'];
        //$adress = $_POST['adress'];
        

        if(!$name || !$person || !$phone ||!$adress){
            $result = array(
                'code'=> '1',
                'ext'=> '缺少参数'
            );
            echo json_encode($result,JSON_UNESCAPED_UNICODE);
            return;
        }
        $provider = D('provider');
        $data['name'] = $name;
        $data['person'] = $person;
        $data['phone'] = $phone;
        $data['adress'] = $adress;

        if($provider->create($data)){
            $id = $provider->add();
            if($id){
                $provider_template = $provider->where("id='$id'")->find();
                $result = array(
                    'code' => '0',
                    'ext' => 'success',
                    'obj' => $provider_template
                );
                //echo json_encode($result,JSON_UNESCAPED_UNICODE);
                echo json_encode($result);
            }
        }
    }


  //退出
    public function doLogout(){
        $_SESSION = array();
        if(isset($_COOKIE[session_name()])){
            setcookie(session_name(),'',time()-1,'/');
        }
        session_destroy();
        $this->redirect('Index/index');
    }
     
}
