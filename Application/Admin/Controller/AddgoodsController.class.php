<?php
namespace Admin\Controller;
use Think\Controller;
class AddgoodsController extends Controller {
    // 后台登录页
    public function index(){
        if(isset($_SESSION['admin'])){

            $provider = D('provider');
            $providerArr = $provider ->field("name")->select();
            $this->assign('providerArr',$providerArr);
        

            $this->display();
        }else{
            $url = 'http://localhost/goodsManage/index.php/Admin/Index/manage';
            header("location: $url");
        }
    }

    public function goodsAdd($goodsname,$img,$info,$provider){

        if(!$goodsname || !$info ||!$provider){
            $result = array(
                'code'=> '1',
                'ext'=> '缺少参数'
            );
            echo json_encode($result,JSON_UNESCAPED_UNICODE);
            return;
        }
        $goods = D('goods');
        $data['name'] = $goodsname;
        //$data['img'] = $img;
        $data['info'] = $info;
        $data['provider'] = $provider;
        $data['create_at'] = date('Y-m-d H:i:s');
        $data['update_at'] = $data['create_at'];
        if($goods->create($data)){
            $id = $goods->add();
            if($id){
                $goods_template = $goods->where("id='$id'")->find();
                $result = array(
                    'code' => '0',
                    'ext' => 'success',
                    'obj' => $goods_template
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
