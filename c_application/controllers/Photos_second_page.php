<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Photos_second_page extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        //引入模块文件 user_model.php
        $this->load->model('user_model');
        $this->load->helper(array('form', 'url'));
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
        //获取图片列表
        $album_pic = '';
        $album_id = '';
        $data = array('inc_url' => $inc_url, 'album_pic' => $album_pic, 'stele_id' => $stele_id, 'album_id' => $album_id);


		$this->load->view('photos_second_page',$data);
    }

     public function album_pic()
    {   
        $stele_id = $this->input->get('s');
        $album_id = $this->input->get('a');
        if(empty($stele_id)||empty($album_id)){
            echo '访问错误';exit();
        }
        //获取相册图片
        $album_pic = $this->user_model->get_stele_album_pic_all($album_id,'1');
        //获取图片空间url
        $inc_url = $this->user_model->get_picture_space_info('url');
        $data = array('inc_url' => $inc_url, 'album_pic' => $album_pic, 'stele_id' => $stele_id, 'album_id' => $album_id);
        $this->load->view('photos_second_page',$data);
    }

    public function upload_photos()
    {
        //获取图片空间url
        $inc_url = $this->user_model->get_picture_space_info('url');
        $data = array('inc_url' => $inc_url);

        $this->load->view('upload_photos',$data);
    }


}
?>