<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Intro_content extends CI_Controller {
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
        //获取传承碑ID
        $stele_id = $this->input->get('s');
        if(empty($stele_id)){
            echo '访问错误';exit();
        }
        //获取图片空间url
        $inc_url = $this->user_model->get_picture_space_info('url');

        //获取个性签名
        $synopsis = $this->user_model->select_info('cc_stele', 'synopsis', array('id' => $stele_id));

        $data = array('inc_url' => $inc_url, 'synopsis' => $synopsis, 'stele_id' => $stele_id);

		$this->load->view('intro_content',$data);
    }
    
    public function update()
    {   

        $this->form_validation->set_rules('stele_id', '传承碑ID', 'required|numeric|trim');
        $this->form_validation->set_rules('intro_txta', '简介', 'required|trim');
        if($this->form_validation->run() === FALSE)
        {   
            $this->form_validation->set_message('intro_txta', '{field} 不能为空');
            $this->form_validation->set_message('stele_id', '{field} 必须为数字');
            //如果数据有错则报错
            echo "出现错误";exit();
        }
        else
        {   
            $synopsis = $this->input->post('intro_txta');
            $stele_id = $this->input->post('stele_id');
            if($this->user_model->update_info('cc_stele', array('synopsis' => $this->db->escape_str($synopsis)), array('id' => $this->db->escape_str($stele_id)))){
                redirect('identify?s='.$stele_id);exit();
            }
        }
    }

}
?>