<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Upload_photos extends CI_Controller {
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
        //获取图片空间url
        $inc_url = $this->user_model->get_picture_space_info('url');
        $stele_id = $this->input->post('stele_id');
        $album_id = $this->input->post('album_id');
        $data = array('inc_url' => $inc_url, 'stele_id' => $stele_id, 'album_id' => $album_id);

		$this->load->view('upload_photos',$data);
    }
    
    public function album_upload()
    {
        $this->form_validation->set_rules('stele_id', 'stele_id', 'required|numeric|trim');
        if(!empty($this->input->post('album_id'))){
            $this->form_validation->set_rules('album_id', 'album_id', 'required|numeric|trim');
        }
        if($this->form_validation->run() === FALSE)
        {   
            $this->form_validation->set_message('stele_id', '{field} 必须为数字');
            $this->form_validation->set_message('album_id', '{field} 必须为数字');
            //如果数据有错则报错
            echo "出现错误";exit();
        }else{
            //11.22日修改
            $user_id = $_SESSION['uid'];
            //接收提交的信息
            //$fileintro = $_POST['fileintro'];
            $stele_id = $this->input->post('stele_id');
            $album_id = $this->input->post('album_id');
            if(!empty($album_id)){
                $album_id = $this->db->escape_str($album_id);
            }else{
                //$album_id = '';
                $stele_album = array('stele_id' => $this->db->escape_str($stele_id), 'time' => time(), 'user_id' => $user_id, 'is_del' => '0');
                $album_id = $this->user_model->insert_stele_album($stele_album);
                
            }
            
            //获取文件的大小  
            $file_size=$_FILES['pic']['size'];  
            if($file_size>4*1024*1024) {  
                echo "文件过大，不能上传大于2M的文件";  
                exit();  
            }  
          
            $file_type=$_FILES['pic']['type'];
            $allowed = array("image/jpeg","image/pjpeg","image/gif","image/x-png","image/png");
            if(!in_array($file_type, $allowed)) {  
                echo "图片格式不符合";  
                exit();  
            }
            $time = time();
            //判断是否上传成功（是否使用post方式上传）  
            if(is_uploaded_file($_FILES['pic']['tmp_name'])) {


                //把文件转存到你希望的目录（不要使用copy函数）  
                $uploaded_file=$_FILES['pic']['tmp_name'];  
          
                //我们给每个用户动态的创建一个文件夹  
                //$user_path = $_SERVER['DOCUMENT_ROOT']."/studyphp/file/up/".$username;  
                $user_path = 'img/album/'.$album_id.'/';
                //判断该用户文件夹是否已经有这个文件夹  
                if(!file_exists($user_path)) {  
                    mkdir($user_path);  
                }  
          
                //$move_to_file=$user_path."/".$_FILES['myfile']['name'];  
                $file_true_name=$_FILES['pic']['name'];
                $move_to_file=$user_path.$time.'_'.rand(1,1000).substr($file_true_name,strrpos($file_true_name,"."));  
                //echo "$uploaded_file   $move_to_file";  
                if(move_uploaded_file($uploaded_file,iconv("utf-8","gb2312",$move_to_file))) {  
                    // echo $_FILES['pic']['name']."上传成功";
                    //引入上传类库
                    require_once('include/qiniu/autoload.php');
                    $this->load->helper('qiniu_putfile');
                    //获取图片空间url
                    $img_url = $this->user_model->get_picture_space_info('img_url');
                    $accessKey = $this->user_model->get_picture_space_info('accessKey');
                    $secretKey = $this->user_model->get_picture_space_info('secretKey');
                    $img_name = $this->user_model->get_picture_space_info('img_name');
                    if(qiniu_putfile($accessKey,$secretKey,$img_name, $move_to_file, $move_to_file)){
                        $img_url = $img_url;
                    }else{
                        $img_url = 'http://www.chuancheng1.com/img/';//此处为网站域名
                    }
                    $picture = $img_url.$move_to_file;
                    //将图片存入相册表
                    $album_space_data = array('stele_id' => $stele_id, 'album_id' => $album_id , 'user_id' => $user_id, 'pic_url' => $picture, 'time' => $time);
                    $album_space_id = $this->user_model->insert_album_space($album_space_data);
                    if($album_space_id){
                        redirect('photos_second_page/album_pic?s='.$stele_id.'&a='.$album_id);exit();
                    }
                } else {  
                    echo "创建失败";exit();
                }  
            } else {  
                echo "创建失败";exit();
            }

        }
    }
}
?>