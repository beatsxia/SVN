<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Concern_num extends CI_Controller {
    
     public function index()
    {	
    	if(empty($_SESSION['uid'])){
    		redirect('WechatOauthLogin');exit();
    	}
    	//引入模块文件 user_model.php
        $this->load->model('user_model');

        $uid = $_SESSION['uid'];

        //获取图片空间url
        $inc_url = $this->user_model->get_picture_space_info('url');

        $user_follow = $this->user_model->get_user_follow($uid);
        $user_follow_arr = array();
        if(!empty($user_follow)){
            foreach ($user_follow as $key => $value) {
                $value['is_mutual'] = $this->user_model->get_is_follow($value['id'],$uid);
                $user_follow_arr[] = $value;
            }
        }
        $data = array('inc_url' => $inc_url, 'user_follow_arr' => $user_follow_arr);
		$this->load->view('concern_num',$data);
    }
    
}
?>