<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class My_msg extends CI_Controller {
    
     public function index()
    {	
    	if(empty($_SESSION['uid'])){
    		redirect('WechatOauthLogin');exit();
    	}
    	//引入模块文件 user_model.php
        $this->load->model('user_model');

        $stele_id = $this->input->get('s');
        if(empty($stele_id)){
            echo '访问错误';exit();
        }

        //获取图片空间url
        $inc_url = $this->user_model->get_picture_space_info('url');
        $stele_note = $this->user_model->get_stele_note($stele_id,$_SESSION['uid']);
        $data = array('inc_url' => $inc_url, 'stele_id' => $stele_id, 'stele_note' => $stele_note);
		$this->load->view('my_msg',$data);
    }

    public function note()
    {   
        if(empty($_SESSION['uid'])){
            redirect('WechatOauthLogin');exit();
        }
        $this->load->model('user_model');
        if($this->input->post('stele_id')){
            $stele_id = $this->db->escape_str($this->input->post('stele_id'));
            $offset = intval($this->db->escape_str($this->input->post('offset')));
            $result = $this->user_model->get_note($stele_id,$offset);
            echo json_encode($result);
        }
    }
}
?>