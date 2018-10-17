<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Exchange extends CI_Controller {
    
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
        
        $steleList = $this->db->select("id,title")
					->from("cc_stele")
					->where(array("user_id" => $uid, "is_del" => 0, 'vip' => 0))
					->get()
					->result_array();

        $data = array(
		"inc_url"   => $inc_url,
		"stelelist" => $steleList
		);
		$this->load->view('exchange',$data);
    }
    
	public function ajaxCode()
	{
        if(empty($_SESSION['uid'])){
            redirect('WechatOauthLogin');exit();
        }
		$activation_code = $this->input->post('code');//激活码
        $stele_id = $this->input->post('id');//stele_id
        $time = time();
        $this->load->library('CI_User');
        $return = $this->ci_user->user_activate_card($activation_code,$stele_id,$time);
        if($return){
            header('Content-Type:application/json; charset=utf-8');
            echo json_encode($return,JSON_UNESCAPED_UNICODE);exit();
        }else{
            header('Content-Type:application/json; charset=utf-8');
            echo json_encode(array('code' => '-1','hint' => '系统错误','content' => ''),JSON_UNESCAPED_UNICODE);exit();
        }
	}
}
?>