<?php
namespace Admin\Controller;
use Think\Controller;
class ListorderController extends Controller {
    // 后台登录页
    public function index(){
        if(isset($_SESSION['admin'])){

            $order = D("order");
            $admin = D("admin");
            $provider = D("provider");
            $orderList = $order->order('create_at desc')->select(); 
            for ($i=0; $i < count($orderList); $i++) { 
                $userid = $orderList[$i]['user_id'];
                $userName = $admin->where("id='$userid'")->select();
                $orderList[$i]['username'] = $userName[0]['name'];
                $providerid = $orderList[$i]['provider_id'];
                $providerName = $provider->where("id='$providerid'")->select();
                $orderList[$i]['providername'] = $providerName[0]['name'];
                $type = $orderList[$i]['type'];
                if($type == 0){
                    $typename = '入库单';
                }else{
                    $typename = '出库单';
                }
                $orderList[$i]['typename'] = $typename;


                $ordernumber = $orderList[$i]['ordernumber'];
                $orderItem = D("order_item");
                $itemList = $orderItem->where("ordernumber='$ordernumber'")->order('id desc')->select();
                $goods = D("goods");
                for($j = 0; $j < count($itemList); $j++){                     
                     $goodsid = $itemList[$j]['goods_id'];
                     $goodsId = $goods->where("id='$goodsid'")->select();
                     $itemList[$j]['goodsname'] = $goodsId[0]['name'];                    
                }
                $orderList[$i]['item'] = $itemList;
            }
            $this->assign('orderList',$orderList);



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
