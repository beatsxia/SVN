<?php

class Login extends CI_Controller {
    
     public function index()
    {	
    	$this->load->helper(array('form', 'url'));
      	$this->load->view('admin/login');
    }

    public function post()
    {
    	$data = $this->input->post();
    	print_r($data);exit();

    }

}
?>