<?php

class Menu extends CI_Controller {
    
     public function index()
    {	
    	$this->load->helper('wechat.class');
    	$newmenu =  array (
      	    'button' => array (
      	      0 => array (
      	        'name' => '扫码',
      	        'sub_button' => array (
      	            0 => array (
      	              'type' => 'scancode_waitmsg',
      	              'name' => '扫码带提示',
      	              'key' => 'rselfmenu_0_0',
      	            ),
      	            1 => array (
      	              'type' => 'scancode_push',
      	              'name' => '扫码推事件',
      	              'key' => 'rselfmenu_0_1',
      	            ),
      	        ),
      	      ),
      	      1 => array (
      	        'name' => '发图',
      	        'sub_button' => array (
      	            0 => array (
      	              'type' => 'pic_sysphoto',
      	              'name' => '系统拍照发图',
      	              'key' => 'rselfmenu_1_0',
      	            ),
      	            1 => array (
      	              'type' => 'pic_photo_or_album',
      	              'name' => '拍照或者相册发图',
      	              'key' => 'rselfmenu_1_1',
      	            )
      	        ),
      	      ),
      	      2 => array (
      	        'type' => 'location_select',
      	        'name' => '发送位置',
      	        'key' => 'rselfmenu_2_0'
      	      ),
      	    ),
      	);
      	$query=$this->db->query('SELECT * FROM  `ci_wechat_config` where id=1');

		$list=$query->row_array();
      	$options = array(
						'token'=>$list['token'], //填写你设定的key
 						'encodingaeskey'=>$list['encodingaeskey'], //填写加密用的EncodingAESKey
 						'appid'=>$list['appid'], //填写高级调用功能的app id
 						'appsecret'=>$list['appsecret'] //填写高级调用功能的密钥
		);
      	$weObj = new Wechat($options);
      	$result = $weObj->createMenu($newmenu);
      	echo $result;//1为成功。0为失败
      	
    }
	
}
?>