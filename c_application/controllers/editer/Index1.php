<?php

class Index1 extends CI_Controller {
    
     public function index()
    {	
    	//引入模块文件 user_model.php
        $this->load->model('user_model');
    	$inc_url = $this->user_model->get_picture_space_info('url');
		$data = array('inc_url' => $inc_url);
		$this->load->view('editer/index',$data);
    }
	
}
?>