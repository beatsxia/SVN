<?php
//关注后回复
class Test1 extends CI_Controller {
    
     public function index()
    {	

		$this->load->library('CI_Wechat');
		//4wVmBlgZnnbH9CQSOav6Sad0ZVAlwAGujpAe_f6lh1M
		
		//微信给用户发送图片开始
        //微信上传图片素材
        //$img = 'img/wximg/1.png';//图片
        //$result = $this->ci_wechat->uploadForeverMedia(array('media'=>'@'.realpath($img)),'image');
        /*
        $array =  array (
      	    'articles' => array (
				'thumb_media_id' => '4wVmBlgZnnbH9CQSOav6SeVkEkacDtJHpzJ6eG1yYMA',
				'author' => '传承家',
				'title' => '前言',
				'content_source_url' => 'http://www.chuancheng1.com/index.php/homepage',
				'content' => '<p><span style="font-family: 宋体;">&nbsp; &nbsp;您好，欢迎来到传承碑！现代物理学中，平行世界或许真的存在，人的灵魂亦存在于此。我们对过往人和事的深切思念与追忆的状态就像量子纠缠，随之亦存在路径，传递与表达着我们的信仰。通过无处不在的网络，实现与平行世界的灵魂共振，这便是永恒，这便是传承碑。</span><br/></p><p><span style=";font-family:宋体;font-size:16pxfont-family:宋体">&nbsp; &nbsp;请打开传承碑，写下传记，开启您和您家族历史的传承之旅吧！</span></p><p><br/></p>',
				'digest' => '您好，欢迎来到传承碑！',
				'show_cover_pic' => '1'
			),
      	);
      	*/
        //上传图文素材
       	//$Articles = $this->ci_wechat->updateForeverArticles('4wVmBlgZnnbH9CQSOav6Sad0ZVAlwAGujpAe_f6lh1M',$array);
       	//print_r($Articles);exit();
       	//$ForeverList = $this->ci_wechat->getForeverList('news',0,10);//获取永久素材列表
		//print_r($ForeverList);exit();
        $msg = array('touser' => 'osTQBwgIW60wyjRe5afi1p1WntvI', 'msgtype' => 'text', 'text' => array('content' => '您好'));

        //$data = array('touser' => 'oLCmewGaydDe-lO48nQq4DV0Omv8', 'msgtype' => 'image', 'image' => array('media_id' => '_ZiO_NyogNDq5BnR3QU1HC2A4JnVaP68ywgD6-ghLdApV75aI4z-oTLzmyOXu2zk'));
        $this->ci_wechat->sendCustomMessage($msg);//发信息给用户
        //微信给用户发送图片结束
        
    }
	
}
?>