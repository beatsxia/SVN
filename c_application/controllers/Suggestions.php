<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Suggestions extends CI_Controller {
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

		$this->load->view('suggestions',$data);
    }

    public function new_sug()
    {   
        if(empty($_SESSION['uid'])){
            redirect('WechatOauthLogin');exit();
        }
        $this->form_validation->set_rules('suggestion', '意见内容', 'required|trim');
        if(!empty($this->input->post('phone_num',true))){
            $this->form_validation->set_rules('phone_num', '联系方式', 'required|trim');
        }
        if($this->form_validation->run() === FALSE)
        {   
            $this->form_validation->set_message('suggestion', '{field} 不能为空');
            $this->form_validation->set_message('phone_num', '{field} 必须为数字');
            //如果数据有错则报错
            echo "请填写内容";exit();
        }
        else
        {   
            $user_id = $_SESSION['uid'];
            $suggestion = $this->input->post('suggestion',true);
            $time = time();
            $phone_num = $this->input->post('phone_num',true);
            $data = array('user_id' => $user_id, 'suggestion' => $this->db->escape_str($suggestion), 'time' => $time, 'phone_num' =>  $this->db->escape_str($phone_num));
            if($this->user_model->insert_suggestion($data)){
                redirect('homepage');exit();//留言成功跳转  待完成
            }
        }
    }

}
?>