<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Weipay extends CI_Controller {
    
     public function index()
    {	
    	if(empty($_SESSION['uid'])){
    		redirect('WechatOauthLogin');exit();
    	}
        if(isset($_SESSION['rec_order_id'])){
            //引入模块文件 user_model.php
            $this->load->model('user_model');
            //引入lib
            $this->load->library('CI_Jsapi');
            $order_id = $_SESSION['rec_order_id'];
            //获取图片空间url
            $inc_url = $this->user_model->get_picture_space_info('url');

            //查询订单详情
            $order_info = $this->user_model->select_info('cc_order_info', 'order_sn,user_id,order_status,pay_status,order_body,order_attach,time_start,time_end,goods_tag,total_fee,trade_type', array('id' => $order_id));
            $uid = $_SESSION['uid'];
            $order_sn = $order_info['order_sn'];
            $order_status = $order_info['order_status'];
            $pay_status = $order_info['pay_status'];
            $order_body = $order_info['order_body'];//订单描述
            $order_attach = $order_info['order_attach'];//附加数据
            $time_start = $order_info['time_start'];
            $time_end = $order_info['time_end'];
            $goods_tag = $order_info['goods_tag'];
            $total_fee = $order_info['total_fee'] * 100;
            $trade_type = $order_info['trade_type'];
            if($order_status=='0'&&$pay_status=='0'&&$trade_type=='JSAPI'){
                $notify_url = 'https://www.chuancheng1.com/index.php/recharge/rec_return';
                $WeipayJsapi = $this->ci_jsapi->WeipayJsapi($order_sn,$order_body,$order_attach,$time_start,$time_end,$goods_tag,$total_fee,$notify_url);
                $data = array('inc_url' => $inc_url, 'jsApiParameters' => $WeipayJsapi['jsApiParameters'], 'editAddress' => $WeipayJsapi['editAddress'], 'total_fee' => $total_fee);
                $this->load->view('weipay',$data);
            }
        }
    }
    
}
?>