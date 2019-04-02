<?php
namespace Admin\Controller;
use Think\Controller;
class ListproviderController extends Controller {
    public function index(){
        if(isset($_SESSION['admin'])){

            $provider = D('provider');
            $providerArr = $provider->order('id desc')->select();
            $this->assign("providerArr",$providerArr);
 
            $this->display();
        }else{
            $url = 'http://localhost/goodsManage/index.php/Admin/Index/manage';
            header("location: $url");
        }
    }

    //删除
    public function deleteProvider(){
        $id = $_POST['id'];
        $provider = D('provider');
        $success = $provider->where(" id='$id' ")->delete();
        if($success){
            $result = array(
                'code'=> '0',
                'ext'=> 'success'
            );
            echo json_encode($result);
        }else {
            $result = array(
                'code'=> '1',
                'ext'=> 'fail'
            );
            echo json_encode($result);
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
