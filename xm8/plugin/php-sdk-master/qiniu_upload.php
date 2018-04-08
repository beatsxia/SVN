<?php
	/*
	��ţ�ϴ�ͼƬ
	*/
	// �����Ȩ��
	use Qiniu\Auth;
	// �����ϴ���
	use Qiniu\Storage\UploadManager;
	// ��Ҫ��д��� Access Key �� Secret Key 3.$bucket  4.Ҫ�ϴ��ļ��ı���·��  5.�ϴ�����ţ�󱣴���ļ���
	function qiniu_putfile($accessKey,$secretKey,$bucket,$filePath,$key){
		
		// ������Ȩ����
		$auth = new Auth($accessKey, $secretKey);

		// �����ϴ� Token
		$token = $auth->uploadToken($bucket);

		// ��ʼ�� UploadManager ���󲢽����ļ����ϴ���
		$uploadMgr = new UploadManager();

		// ���� UploadManager �� putFile ���������ļ����ϴ���
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