<?php 
	include('wechat.class.php');
	$options = array(
		 'token'=>'mZGCP9tkFYifItksSaw32yJFhi9ywwSG', //填写你设定的key
		 'appid'=>'wx247b46662d01b4ab', //填写高级调用功能的app id
		 'appsecret'=>'c064a7c5bd16613747af9a81a2ecd38c', //
		 'encodingaeskey'=>'hHx1j8H83XlP6Xf2xzJE442mt188fekzJvPvvx424X2',
	);
	$weObj = new Wechat($options);
    $weObj->valid();
	
	$sceneid = $weObj->getRev()->getRevSceneId();
	//$sceneid = $weObj->getRev();
	$data = array('touser' => 'oLCmewGaydDe-lO48nQq4DV0Omv8', 'msgtype' => 'text', 'text' => array('content' => $sceneid));
	$weObj->sendCustomMessage($data);

?>