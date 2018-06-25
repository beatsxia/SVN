<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Activation_converbility extends CI_Controller {
    
     public function index()
    {	
    	if(empty($_SESSION['uid'])){
    		redirect('WechatOauthLogin');exit();
    	}
    	//引入模块文件 user_model.php
        $this->load->model('user_model');

        //获取图片空间url
        $inc_url = $this->user_model->get_picture_space_info('url');
		
        $data = array('inc_url' => $inc_url);
        if($stele_id = $this->input->get('s')){
            $data['stele_id'] = $stele_id;
        }
		$this->load->view('activation_converbility',$data);
    }

    public function use_card()
    {
        if(empty($_SESSION['uid'])){
            redirect('WechatOauthLogin');exit();
        }
        
        $activation_code = trim($this->input->post('activation_code',true));
        $stele_id = trim($this->input->post('stele_id',true));
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

    public function prove_card()
    {
        if(empty($_SESSION['uid'])){
            redirect('WechatOauthLogin');exit();
        }
        //引入模块文件 user_model.php
        $this->load->model('user_model');
        $time = time();
        $activation_code = trim($this->input->post('activation_code',true));
        if(!preg_match("/[\'.,:;*?~`!@#$%^&+=)(<>{}]|\]|\[|\/|\\\|\"|\|/",$activation_code)&&!empty($activation_code)){
            $code_info = $this->user_model->select_stele_card($activation_code,'0','1',$time);
            if(empty($code_info)){
                header('Content-Type:application/json; charset=utf-8');
                echo json_encode(array('code' => '0','hint' => '激活码错误(区分大小写，没有可不填)','content' => ''),JSON_UNESCAPED_UNICODE);exit();
            }else{
                header('Content-Type:application/json; charset=utf-8');
                echo json_encode(array('code' => '1','hint' => '激活码正确','content' => ''),JSON_UNESCAPED_UNICODE);exit();
            }
        }else{
            header('Content-Type:application/json; charset=utf-8');
            echo json_encode(array('code' => '0','hint' => '激活码不能包含特殊字符','content' => ''),JSON_UNESCAPED_UNICODE);exit();
        }
    }


    
    
}
?>