<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class New_board extends CI_Controller {
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

        $stele_id = $this->input->get('s');
        if(empty($stele_id)){
            echo '访问错误';exit();
        }

        //获取图片空间url
        $inc_url = $this->user_model->get_picture_space_info('url');

        $data = array('inc_url' => $inc_url,'stele_id' => $stele_id);

        $this->load->view('new_board',$data);
    }

    public function insert()
    {
        $this->form_validation->set_rules('stele_id', '传承碑ID', 'required|numeric|trim');
        $this->form_validation->set_rules('board_txta', '留言内容', 'required|trim');
        if($this->form_validation->run() === FALSE)
        {   
            $this->form_validation->set_message('board_txta', '{field} 不能为空');
            $this->form_validation->set_message('stele_id', '{field} 必须为数字');
            //如果数据有错则报错
            echo "出现错误";exit();
        }
        else
        {   
            $user_id = $_SESSION['uid'];
            $content = $this->input->post('board_txta');
            $time = time();
            $stele_id = $this->input->post('stele_id');
            $data = array('user_id' => $user_id, 'is_first' => '1', 'content' => $this->db->escape_str($content), 'time' => $time, 'stele_id' => $stele_id);
            if($this->user_model->insert_cc_note($data)){
                redirect('cloud?s='.$stele_id);exit();//留言成功跳转  待完成
            }
        }
    }

}
?>