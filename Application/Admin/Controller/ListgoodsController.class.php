<?php
namespace Admin\Controller;
use Think\Controller;
class ListgoodsController extends Controller {
    public function index(){
        if(isset($_SESSION['admin'])){

 	$goods = D('goods');
 	$goodsArr = $goods->order('id desc')->select();
 	$this->assign('goodsArr',$goodsArr);
             //dump($goodsArr );


            $this->display();
        }else{
            $url = 'http://localhost/goodsManage/index.php/Admin/Index/manage';
            header("location: $url");
        }
    }

    //修改
    public function updateGoods(){
        $id = $_POST['id'];
         $goods = D('goods');
        $success = $goods->where(" id='$id' ")->select();
        $this->assign('success',$success);
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

    //删除
    public function deleteGoods(){
        $id = $_POST['id'];
        $goods = D('goods');
        $success = $goods->where(" id='$id' ")->delete();
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
