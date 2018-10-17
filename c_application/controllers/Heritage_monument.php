<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Heritage_monument extends CI_Controller {
    
     public function index()
    {	
    	if(empty($_SESSION['uid'])){
    		redirect('WechatOauthLogin');exit();
    	}
    	//引入模块文件 user_model.php
        $this->load->model('user_model');

        //获取图片空间url
        $inc_url = $this->user_model->get_picture_space_info('url');

        //获取传承碑信息
        $stele = $this->user_model->get_stele_list(1,$_SESSION['uid']);
        //获取收藏的传承碑
        $user_id = $_SESSION['uid'];
        $page = 1;
        $limit = 10;//数量
        $stele_collection = $this->user_model->select_stele_collection($user_id,$page,$limit);
        $data = array('inc_url' => $inc_url, 'stele' => $stele, 'stele_collection' => $stele_collection);
        //print_r($data);exit;
		$this->load->view('heritage_monument',$data);
    }

    
    
}
?>