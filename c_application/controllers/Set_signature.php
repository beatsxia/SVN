<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Set_signature extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        //引入模块文件 user_model.php
        $this->load->model('user_model');
        $this->load->library('form_validation');
        if(empty($_SESSION['uid'])){
            redirect('WechatOauthLogin');exit();
        }
    }

     public function index()
    {	
        $user_id = $this->input->get('uid');
        if(empty($user_id)){
            echo '访问错误';exit();
        }
        //获取图片空间url
        $inc_url = $this->user_model->get_picture_space_info('url');

        $my_words = $this->user_model->select_info('cc_user', 'personality_note',  array('id' => $this->db->escape_str($user_id)));
        $data = array('inc_url' => $inc_url, 'user_id' => $user_id, 'my_words' => $my_words);
		$this->load->view('set_signature',$data);
    }

    public function update()
    {
        $this->form_validation->set_rules('user_id', '用户id', 'required|numeric|trim');
        $this->form_validation->set_rules('setSign', '个人签名', 'required|trim');
        if($this->form_validation->run() === FALSE)
        {   
            $this->form_validation->set_message('setSign', '{field} 不能为空');
            $this->form_validation->set_message('user_id', '{field} 必须为数字');
            //如果数据有错则报错
            echo "出现错误";exit();
        }
        else
        {   
            $personality_note = $this->input->post('setSign');
            $user_id = $this->input->post('user_id');
            if($this->user_model->update_info('cc_user', array('personality_note' => $this->db->escape_str($personality_note)), array('id' => $this->db->escape_str($user_id)))){
                redirect('mine_info');exit();
            }
        }
    }
    
}
?>