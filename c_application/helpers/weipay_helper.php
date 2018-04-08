<?php
	/*
	JSAPI微信支付
	*/
	defined('BASEPATH') OR exit('No direct script access allowed');
	// 引入鉴权类
	use Qiniu\Auth;
	// 引入上传类
	use Qiniu\Storage\UploadManager;
	// 需要填写你的 Access Key 和 Secret Key 3.$bucket  4.要上传文件的本地路径  5.上传到七牛后保存的文件名
	function weipay_jsapi($CLogFileHandler){
		
		ini_set('date.timezone','Asia/Shanghai');
		//error_reporting(E_ERROR);
		require_once "../lib/WxPay.Api.php";
		require_once "WxPay.JsApiPay.php";
		require_once 'log.php';

		//初始化日志
		//$logHandler= new CLogFileHandler("../logs/".date('Y-m-d').'.log');
		$logHandler= new CLogFileHandler($CLogFileHandler);
		$log = Log::Init($logHandler, 15);

		

		//①、获取用户openid
		$tools = new JsApiPay();
		$openId = $tools->GetOpenid();

		//②、统一下单
		$input = new WxPayUnifiedOrder();
		$input->SetBody("test");
		$input->SetAttach("test");
		$input->SetOut_trade_no(WxPayConfig::MCHID.date("YmdHis"));
		$input->SetTotal_fee("1");
		$input->SetTime_start(date("YmdHis"));
		$input->SetTime_expire(date("YmdHis", time() + 600));
		$input->SetGoods_tag("test");
		$input->SetNotify_url("http://paysdk.weixin.qq.com/example/notify.php");
		$input->SetTrade_type("JSAPI");
		$input->SetOpenid($openId);
		$order = WxPayApi::unifiedOrder($input);
		echo '<font color="#f00"><b>统一下单支付单信息</b></font><br/>';
		printf_info($order);
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
	//打印输出数组信息
	function printf_info($data)
	{
		foreach($data as $key=>$value){
			echo "<font color='#00ff55;'>$key</font> : $value <br/>";
		}
	}