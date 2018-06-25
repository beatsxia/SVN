<?php
/*
七牛上传图片
*/
defined('BASEPATH') OR exit('No direct script access allowed');
// 引入鉴权类
use Qiniu\Auth;
// 引入上传类
use Qiniu\Storage\UploadManager;
// 需要填写你的 Access Key 和 Secret Key 3.$bucket 
function qiniu_token($accessKey,$secretKey,$bucket,$policy){
	$expires = '3600';
	// 构建鉴权对象
	$auth = new Auth($accessKey, $secretKey);

	// 生成上传 Token
	return $token = $auth->uploadToken($bucket,null,$expires,$policy,true);

	

}