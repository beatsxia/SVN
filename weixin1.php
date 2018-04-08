<?php 
	$signature = isset($_GET["signature"])?$_GET["signature"]:'';
	$signature = isset($_GET["msg_signature"])?$_GET["msg_signature"]:$signature; //如果存在加密验证则用加密验证段
	$timestamp = isset($_GET["timestamp"])?$_GET["timestamp"]:'';
	$nonce = isset($_GET["nonce"])?$_GET["nonce"]:'';
	$token = isset($_GET["token"])?$_GET["token"]:'mZGCP9tkFYifItksSaw32yJFhi9ywwSG';

	$tmpArr = array($token, $timestamp, $nonce);
	sort($tmpArr, SORT_STRING);
	$tmpStr = implode( $tmpArr );
	$tmpStr = sha1( $tmpStr );
	if( $tmpStr == $signature ){
		echo $_GET["echostr"];
		return true;
	}else{
		return false;
	}

	public function urlRedirect(){
		  $postStr = $GLOBALS["HTTP_RAW_POST_DATA"];
		  $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
		  $fromUsername = (string)$postObj->FromUserName;
		  $EventKey = trim((string)$postObj->EventKey);
		  $keyArray = explode("_", $EventKey);
		  if (count($keyArray) == 1){   //已关注者扫描
		    file_put_contents('1.txt', $fromUsername);
		  }else{　　　　　　　　　　　　　　　　　　　//未关注者关注后推送事件
		   	file_put_contents('1.txt', $fromUsername);
		  }
	}
?>