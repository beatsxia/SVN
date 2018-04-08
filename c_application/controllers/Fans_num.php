<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Fans_num extends CI_Controller {
    
     public function index()
    {	
    	if(empty($_SESSION['uid'])){
    		redirect('WechatOauthLogin');exit();
    	}
    	//引入模块文件 user_model.php
        $this->load->model('user_model');

        //获取图片空间url
        $inc_url = $this->user_model->get_picture_space_info('url');

        $uid = $_SESSION['uid'];

        $user_fans = $this->user_model->get_user_fans($uid);
        $user_fans_arr = array();
        if(!empty($user_fans)){
            foreach ($user_fans as $key => $value) {
                $value['is_mutual'] = $this->user_model->get_is_follow($uid,$value['id']);
                $user_fans_arr[] = $value;
            }
        }

        $data = array('inc_url' => $inc_url, 'user_fans_arr' => $user_fans_arr);

		$this->load->view('fans_num',$data);
    }
    
}
?>