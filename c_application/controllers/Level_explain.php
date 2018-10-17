<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Level_explain extends CI_Controller {
    public function __construct() {
        parent::__construct();
        if(empty($_SESSION['uid'])){
            redirect('WechatOauthLogin');exit();
        }
        $this->load->helper(array('form', 'url'));
        //引入模块文件 user_model.php
        $this->load->model('user_model');
        $this->load->library('form_validation');
    }

     public function index()
    {	
    	if(empty($_SESSION['uid'])){
    		redirect('WechatOauthLogin');exit();
    	}

        //获取图片空间url
        $inc_url = $this->user_model->get_picture_space_info('url');
        $data['inc_url']=$inc_url;

		$this->load->view('level_explain',$data);
    }


}
?>