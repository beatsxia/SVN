<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Identify extends CI_Controller {
    
     public function index()
    {	
    	if(empty($_SESSION['uid'])){
    		redirect('WechatOauthLogin');exit();
    	}
    	//引入模块文件 user_model.php
        $this->load->model('user_model');

        //获取图片空间url
        $inc_url = $this->user_model->get_picture_space_info('url');

        $stele_id = $this->input->get('s');
        if(empty($stele_id)){
            echo '访问错误';exit();
        }

        //获取传承被内容
        $stele = $this->user_model->get_stele($stele_id);

        if(empty($stele)){
            echo '传承碑不存在';exit();
        }
        if($stele['inh_id']!='0'){
            $stele_link_inh = $this->user_model->get_inherit_identify($stele['inh_id']);
        }else{
            $stele_link_inh = '';
        }
        
        $data = array('inc_url' => $inc_url, 'stele' => $stele, 'stele_link_inh' => $stele_link_inh);
		$this->load->view('identify',$data);
    }
    
}
?>