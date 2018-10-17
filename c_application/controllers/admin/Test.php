<?php

class Test extends CI_Controller {
    
     public function index()
    {	
    	$newmenu =  array (
      	    'button' => array (
				0 => array (
					'name' => '进入首页',
					'type' => 'view',
					'url' => 'http://www.chuancheng1.com/index.php/homepage',
					'sub_button' => array (
					),
      	        ),
      	        1 => array (
					'name' => '寻找传承',
					'sub_button' => array (
						0 => array(
							'name' => '人生意义',
							'type' => 'view',
							'url' => 'http://www.chuancheng1.com/index.php/show_article?inh_id=3'
						),
						1 => array(
							'name' => '祠堂故事',
							'type' => 'view', 
							'url' => 'http://www.chuancheng1.com/index.php/show_article?inh_id=4'
						),
					),
				),
			    2 => array (
					'name' => '关于我们',
					'type' => 'view',
					'url' => 'http://www.chuancheng1.com/index.php/about_us',
					'sub_button' => array (
					),
      	        ),
			),
      	);
		$this->load->library('CI_Wechat');
		$ercode = $this->ci_wechat->createMenu($newmenu);
		echo $ercode;//1为成功。0为失败
    }
	
}
?>