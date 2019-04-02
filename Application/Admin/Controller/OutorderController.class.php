<?php
namespace Admin\Controller;
use Think\Controller;
class OutorderController extends Controller {
    public function index(){
        if(isset($_SESSION['admin'])){
            $admin = D('admin');
            $userList = $admin->select();
            $this->assign('arr',$userList);
            $goods = D('goods');
            $goodsList = $goods->select();
            $this->assign('arrG',$goodsList);
 
            $this->display();
        }else{
            $url = 'http://localhost/goodsManage/index.php/Admin/Index/manage';
            header("location: $url");
        }
    }

        //添加出库单物品
    public function goodsAdd($count,$goodsId,$price,$money,$orderNumber){
         if(!$goodsId || !$price || !$count|| !$money ||!$orderNumber){
            $result = array(
                'code'=> '1',
                'ext'=> '缺少参数'
            );
            echo json_encode($result,JSON_UNESCAPED_UNICODE);
            return;
           }

        $goods = D("goods");
        $preCount = $goods->where("id='$goodsId'")->field('count')->select();
        if($preCount<$count){
            $result = array(
                'code'=> '1',
                'ext'=> '库存不足'
            );
            echo json_encode($result,JSON_UNESCAPED_UNICODE);
            return;
        }

        $orderItem = D("order_item");
        $data['goods_id'] = $goodsId;
        $data['count'] = $count;
        $data['price'] = $price;
        $data['ordernumber'] = $orderNumber;    
         if($orderItem->create($data)){
            $id = $orderItem->add();
            if($id){               
               $newCount = $preCount[0]['count']-$count;

               $data = array('count'=>$newCount,'purchasePrice'=>$money);
               $goods-> where("id='$goodsId'")->setField($data); 


               $item = $orderItem->where("id='$id'")->find();
               $goodsname = $goods->where("id='$goodsId'")->select();
               $item['goodsname'] = $goodsname[0]['name'];       

                $result = array(
                    'code' => '0',
                    'ext' => 'success',
                    'item' => $item
                );
                echo json_encode($result);
            }
        }
    }


    //删除出库单物品
    public function goodsDelete($id){
        $orderItem = D('order_item');
        $data['state'] = 1;        
        //$success = $project->where("id='$id'")->delete();
        $goods = D("goods");
        $item = $orderItem->where("id='$id'")->find();
        $goodsId = $item['goods_id'];
        $count = $item['count'];        
        $preCount = $goods->where("id='$goodsId'")->field('count')->select();
        $newCount = $preCount[0]['count']+$count;
        $data = array('count'=>$newCount);
        $goods-> where("id='$goodsId'")->setField($data);

        $success = $orderItem->where("id='$id'")->delete($data);
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

   
    //添加出库单
    public function orderAdd($orderNumber,$userId){
        if(!$orderNumber || !$userId){
            $result = array(
                'code'=> '1',
                'ext'=> 'error'
            );
            echo json_encode($result);
            return;
        }
        $order = D("order");
        $orderItem = D("order_item");

        $itemList = $orderItem->where("ordernumber='$orderNumber'")->order('id desc')->select();
        $price = 0;
        $type = 1;
        for($i=0; $i < count($itemList); $i++){
            $price+=$itemList[$i]['price'];
        }

        $data['ordernumber'] = $orderNumber;
        $data['user_id'] = $userId;
        $data['price'] = $price;
        $data['type'] = $type;
         if($order->create($data)){
            $id = $order->add();
            if($id){
                $result = array(
                    'code' => '0',
                    'ext' => 'success'
                );
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
