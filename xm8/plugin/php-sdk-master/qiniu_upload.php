<?php
	/*
	七牛上传图片
	*/
	// 引入鉴权类
	use Qiniu\Auth;
	// 引入上传类
	use Qiniu\Storage\UploadManager;
	// 需要填写你的 Access Key 和 Secret Key 3.$bucket  4.要上传文件的本地路径  5.上传到七牛后保存的文件名
	function qiniu_putfile($accessKey,$secretKey,$bucket,$filePath,$key){
		
		// 构建鉴权对象
		$auth = new Auth($accessKey, $secretKey);

		// 生成上传 Token
		$token = $auth->uploadToken($bucket);

		// 初始化 UploadManager 对象并进行文件的上传。
		$uploadMgr = new UploadManager();

		// 调用 UploadManager 的 putFile 方法进行文件的上传。
		list($ret, $err) = $uploadMgr->putFile($token, $key, $filePath);
		if ($err !== null) {
			//var_dump($err);
			return FALSE;
		} else {
			//var_dump($ret);
			return TRUE;
		}

	}
?>