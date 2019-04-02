<?php
namespace Admin\Controller;
use Think\Controller;
class MoneyController extends Controller {
     public function index(){
        if(isset($_SESSION['admin'])){

            $money = D('order');
            $admin = D('admin');
            $moneyArr = $money ->order('id desc')->select();
            for($i = 0;$i<count($moneyArr);$i++){
                $type = $moneyArr[$i]['type'];
                $userid = $moneyArr[$i]['user_id'];
                $username = $admin ->where(" id = '$userid' ")->select();
                $moneyArr[$i]['username'] = $username[0]['name'];
                if($type == 0){
                    $moneyArr[$i]['typename'] = '入库';
                }else{
                    $moneyArr[$i]['typename'] = '出库';
                }
            }
            $this->assign('moneyArr',$moneyArr);

            $this->display();
        }else{
            $url = 'http://localhost/goodsManage/index.php/Admin/Index/manage';
            header("location: $url");
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
