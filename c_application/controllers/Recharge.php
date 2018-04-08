<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Recharge extends CI_Controller {
    
     public function index()
    {	
    	if(empty($_SESSION['uid'])){
    		redirect('WechatOauthLogin');exit();
    	}
    	//引入模块文件 user_model.php
        $this->load->model('user_model');

        //获取图片空间url
        $inc_url = $this->user_model->get_picture_space_info('url');

        //获取充值产品
        $recharge_goods = $this->user_model->get_goods_by_catid('1');
        $data = array('inc_url' => $inc_url, 'recharge_goods' => $recharge_goods);
		$this->load->view('recharge',$data);
    }
    public function main()
    {
        if(empty($_SESSION['uid'])){
            redirect('WechatOauthLogin');exit();
        }

        //引入模块文件 user_model.php
        $this->load->model('user_model');
        
        $good_id = intval($this->input->post('good_id'));
        if(empty($good_id)){
            echo '充值错误';exit();
        }
        $recharge_goods = $this->user_model->get_goods_by_id($good_id);
        if(empty($recharge_goods)){
            echo '充值错误';exit();
        }
        unset($_SESSION['rec_order_id']);
        //订单编号
        $order_sn = 'SN'.date('Ymd').substr(implode(NULL, array_map('ord', str_split(substr(uniqid(), 7, 13), 1))), 0, 8);
        //用户id
        $uid = $_SESSION['uid'];
        //订单状态
        $order_status = '0';
        $pay_status = '0';//未支付
        $order_body = '充值订单'.$recharge_goods['goods_name'];
        $order_attach = '';
        $time_start = time();
        $time_end = $time_start+600;
        $goods_tag = $recharge_goods['goods_sn'];
        $total_fee = $recharge_goods['shop_price'];
        $trade_type = 'JSAPI';
        $data = array('order_sn' => $order_sn, 'user_id' => $uid, 'order_status' => $order_status, 'pay_status' => $pay_status, 'order_body' => $order_body, 'order_attach' => $order_attach, 'time_start' => $time_start, 'time_end' => $time_end, 'goods_tag' => $goods_tag, 'total_fee' => $total_fee, 'trade_type' => $trade_type);
        //插入订单表
        $order_id = $this->user_model->insert_order_info($data);

        //2018年后来完成  建order_goods表  和插入数据进order_goods表

        $this->session->set_userdata('rec_order_id', $order_id);
        //跳转至微信支付weipay.php
        redirect('weipay');exit();
        
    }
    public function rec_return()
    {   
        /*为完成的支付成功返回，修改数据库功能
        $xml = $GLOBALS['HTTP_RAW_POST_DATA'];
        if(empty($xml)){
            $xml ='dadd';
        }
        $this->user_model->update_info('cc_order_info', array('pay_status' => '1', 'order_attach' => $xml), array('id' => 20));
        */
        if(empty($_SESSION['uid'])){
            redirect('WechatOauthLogin');exit();
        }
        $user_id = $_SESSION['uid'];
        $time = time();
        //引入模块文件 user_model.php
        $this->load->model('user_model');
        if(isset($_SESSION['pay_sus_status'])){
            if($_SESSION['pay_sus_status']=='1'){
                $this->user_model->update_info('cc_order_info', array('pay_status' => '1', 'pay_time' =>$time), array('id' => $_SESSION['rec_order_id']));
                $user_name = $this->user_model->select_info('cc_user', 'nickname', array('id' => $user_id));
                $money = $this->user_model->select_info('cc_order_info', 'total_fee', array('id' => $_SESSION['rec_order_id']));
                $money_log_data = array('order_id' => $_SESSION['rec_order_id'], 'time' => $time, 'user_id' => $user_id, 'user_name' => $user_name, 'money' => $money, 'point' => $money, 'note' => '充值'.$money.'元订单');
                $this->user_model->insert_money_log($money_log_data);
            }
            unset($_SESSION['rec_order_id']);
            redirect('mine_info');exit();
        }else{
            echo '充值出现错误';exit();
        }
    }
    
}
?>