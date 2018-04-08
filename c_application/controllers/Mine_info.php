<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Mine_info extends CI_Controller {
    
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
        
        $get_mine_info = $this->user_model->get_mine_info($uid);

        $data = array('gender' => $get_mine_info['gender'], 'avatar' => $get_mine_info['avatar'], 'nickname' => $get_mine_info['nickname'], 'personality_note' => $get_mine_info['personality_note'], 'total_inh_num' => $get_mine_info['total_inh_num'], 'access_log_num' => $get_mine_info['access_log_num'], 'user_follow_num' => $get_mine_info['user_follow_num'], 'user_fans_num' => $get_mine_info['user_fans_num'], 'comment_num' => $get_mine_info['comment_num'], 'my_inherit' => $get_mine_info['my_inherit'], 'inc_url' => $inc_url, 'uid' => $uid, 'user_point' => $get_mine_info['user_point']);
		$this->load->view('mine_info',$data);
    }
    
}
?>