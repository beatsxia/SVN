<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
微信支付jsapi
 */
ini_set('date.timezone','Asia/Shanghai');
require_once APPPATH.'libraries/weipay/lib/WxPay.Api.php';
require_once APPPATH.'libraries/weipay/core/WxPay.JsApiPay.php';
require_once APPPATH.'libraries/weipay/core/log.php';

class CI_Jsapi{
    protected $_CI;
    public function __construct() {
        $this->_CI =& get_instance();
    }
	
	/**
	 * 微信支付jsapi
	 * @param array $msg 消息数组
	 * @param bool $append 是否在原消息数组追加
	 */
    public function WeipayJsapi($order_sn,$order_body,$order_attach,$time_start,$time_end,$goods_tag,$total_fee,$notify_url){
    	//初始化日志
		$logHandler= new CLogFileHandler(APPPATH."libraries/weipay/logs/".date('Y-m-d').'.log');
		$log = Log::Init($logHandler, 15);

		//①、获取用户openid
		$tools = new JsApiPay();
		$openId = $tools->GetOpenid();

		//②、统一下单
		$input = new WxPayUnifiedOrder();
		$input->SetBody($order_body);//商品描述
		$input->SetAttach($order_attach);//附加数据
		$input->SetOut_trade_no($order_sn);//商户订单号
		$input->SetTotal_fee($total_fee);//总金额
		$input->SetTime_start(date("YmdHis",$time_start));//交易起始时间
		$input->SetTime_expire(date("YmdHis",$time_end));//交易结束时间
		$input->SetGoods_tag($goods_tag);//商品标记
		$input->SetNotify_url($notify_url);//通知地址
		$input->SetTrade_type("JSAPI");//交易类型
		$input->SetOpenid($openId);//用户标识
		$order = WxPayApi::unifiedOrder($input);
		$jsApiParameters = $tools->GetJsApiParameters($order);

		//获取共享收货地址js函数参数
		$editAddress = $tools->GetEditAddressParameters();

		//③、在支持成功回调通知中处理成功之后的事宜，见 notify.php
		/**
		 * 注意：
		 * 1、当你的回调地址不可访问的时候，回调通知会失败，可以通过查询订单来确认支付是否成功
		 * 2、jsapi支付时需要填入用户openid，WxPay.JsApiPay.php中有获取openid流程 （文档可以参考微信公众平台“网页授权接口”，
		 * 参考http://mp.weixin.qq.com/wiki/17/c0f37d5704f0b64713d5d2c37b468d75.html）
		 */
		 return array('jsApiParameters' => $jsApiParameters, 'editAddress' => $editAddress);
    }
}
