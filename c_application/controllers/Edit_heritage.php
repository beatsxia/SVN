<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Edit_heritage extends CI_Controller {
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
        if(isset($stele_id)&&is_numeric($stele_id)&&!strpos($stele_id, '.')&&$stele_id!='0'){
            //获取传承被内容
            $stele = $this->user_model->get_stele($stele_id);

            if(empty($stele)){
                echo '传承碑不存在';exit();
            }
            if(empty($stele)){
                echo '传承碑不存在';exit();
            }
            if($stele['inh_id']!='0'){
                $stele_link_inh = $this->user_model->get_inherit_identify($stele['inh_id']);
            }else{
                $stele_link_inh = '';
            }
            $this->load->library('CI_Decide');
            $power = $this->ci_decide->decide_stele($_SESSION['uid'],$stele_id);
            $data = array('inc_url' => $inc_url, 'stele' => $stele, 'stele_link_inh' => $stele_link_inh, 'power' => $power);
            $this->load->view('edit_heritage',$data);
        }else{
            echo '访问错误';
        }
    }

    
    
}
?>