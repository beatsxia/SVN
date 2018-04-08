<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Homepage extends CI_Controller {
    
     public function index()
    {	
    	if(empty($_SESSION['uid'])){
    		// redirect('WechatOauthLogin');exit();
    	}
    	//引入模块文件 user_model.php
        $this->load->model('user_model');

        //获取图片空间url
        $inc_url = $this->user_model->get_picture_space_info('url');
		//获取首页轮播图信息
		$query=$this->db->query('SELECT * FROM  `ci_cc_rolling_ads` WHERE  `is_delete` =0 ORDER BY  `sort` ASC LIMIT 0 , 3');
		$list=$query->result_array();

        $rolling_content = $this->user_model->get_rolling_content('5');
        $rolling_content_arr = array();
        foreach ($rolling_content as $key => $value) {

            $inherit_user = $this->user_model->select_info('cc_user','nickname,avatar',array('id' => $this->user_model->select_info('cc_inherit','user_id',array('id' => $value['inh_id']))));
            $value['nickname'] = $inherit_user['nickname'];
            $value['avatar'] = $inherit_user['avatar'];
            $rolling_content_arr[] = $value;
        }
        $data = array('inc_url' => $inc_url, 'advertisement' => $list ,'rolling_content_arr' => $rolling_content_arr);
		$this->load->view('index',$data);
    }
}
?>