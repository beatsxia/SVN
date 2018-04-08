<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Photos extends CI_Controller {
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

        //获取传承碑相册信息
        $stele_album_arr = array();
        $stele_album = $this->user_model->get_stele_album($stele_id);
        foreach ($stele_album as $key => $value) {
            $album_pic1 =$this->user_model->get_stele_album_pic1($value['id']);
            $value['pic_title'] = $album_pic1['title'];
            $value['pic_url'] = $album_pic1['pic_url'];
            $stele_album_arr[] = $value;
        }
        $data = array('inc_url' => $inc_url, 'stele_album_arr' => $stele_album_arr, 'stele_id' => $stele_id);


		$this->load->view('photos',$data);
    }
}
?>