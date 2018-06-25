<?php

class Login extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        //引入模块文件 user_model.php
        $this->load->model('admin_model');
        $this->load->library('form_validation');
        //$this->load->library('encryption');//引入加密
    }
     public function index()
    {	
      	$this->load->view('admin/login');
    }

    public function post()
    {
    	$user_name = $this->input->post('u',true);
    	$password = $this->input->post('p',true);
    	$this->form_validation->set_rules('u', '昵称', 'required|alpha_dash|trim');
        $this->form_validation->set_rules('p', '个人介绍', 'required|trim');
        if($this->form_validation->run() === FALSE)
        {   
            echo "账号不能含有特殊字符";exit();
        }
        else
        {   
        	//$password = $this->encryption->encrypt($password);

        	//$password_ep = substr($password, 0, 56);
            //echo $user_name;echo $password_ep;exit();
        	$admin_id = $this->admin_model->db_admin_login_by_name($user_name, $password);
            if($admin_id){
                $_SESSION['admin_id'] = $admin_id['id'];
                redirect('admin/show');
            }else{
                echo '密码错误';
            }
        	//$this->encryption->decrypt($password);//解密
        }

    }

}
?>