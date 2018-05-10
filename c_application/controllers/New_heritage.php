<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class New_heritage extends CI_Controller {
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

        $data = array('inc_url' => $inc_url);

		$this->load->view('new_heritage',$data);
    }

    public function new_heritage()
    {   
        $this->form_validation->set_rules('nickname', '昵称', 'required|trim');
        $this->form_validation->set_rules('intro_yourself', '个人介绍', 'required|trim');
        //$this->form_validation->set_rules('mychoice', '礼物类型', 'required|numeric|trim');
        $this->form_validation->set_rules('myTemplate', '皮肤风格', 'required|trim');
        $inh_id = $this->input->post('link_inh_id');
        if(!empty($inh_id)){
            $this->form_validation->set_rules('link_inh_id', '关联传记ID', 'required|numeric|trim');
        }
        $this->form_validation->set_rules('birthday', '出生时间', 'required|trim');
        $this->form_validation->set_rules('day_of_death', '死亡时间', 'trim');
        if($this->form_validation->run() === FALSE)
        {   
            $this->form_validation->set_message('nickname', '{field} 不能为空');
            $this->form_validation->set_message('intro_yourself', '{field} 不能为空');
            //$this->form_validation->set_message('mychoice', '{field} 不能为空');
            $this->form_validation->set_message('myTemplate', '{field} 不能为空');
            $this->form_validation->set_message('link_inh_id', '{field} 必须选择');
            //如果数据有错则报错
            echo "出现错误";exit();
        }
        else
        {   
            $username = $_SESSION['uid'];
            //接收提交的信息
            //$fileintro = $_POST['fileintro'];  
            $title = $this->input->post('nickname');
            $synopsis = $this->input->post('intro_yourself');
            $birthday_time = $this->input->post('birthday');
            $death_time = $this->input->post('day_of_death');
            //获取文件的大小  
            $file_size=$_FILES['userhead']['size'];  
            if($file_size>4*1024*1024) {  
                echo "文件过大，不能上传大于2M的文件";  
                exit();  
            }  
          
            $file_type=$_FILES['userhead']['type'];
            $allowed = array("image/jpeg","image/pjpeg","image/gif","image/x-png","image/png");
            if(!in_array($file_type, $allowed)) {  
                echo "图片格式不符合";  
                exit();  
            }
            $time = time();
            //判断是否上传成功（是否使用post方式上传）  
            if(is_uploaded_file($_FILES['userhead']['tmp_name'])) {  
                //把文件转存到你希望的目录（不要使用copy函数）  
                $uploaded_file=$_FILES['userhead']['tmp_name'];  
          
                //我们给每个用户动态的创建一个文件夹  
                //$user_path = $_SERVER['DOCUMENT_ROOT']."/studyphp/file/up/".$username;  
                $user_path = 'img/stele/picture/'.$username.'/';
                //判断该用户文件夹是否已经有这个文件夹  
                if(!file_exists($user_path)) {  
                    mkdir($user_path);  
                }  
          
                //$move_to_file=$user_path."/".$_FILES['myfile']['name'];  
                $file_true_name=$_FILES['userhead']['name'];
                $move_to_file=$user_path.$time.'_'.rand(1,1000).substr($file_true_name,strrpos($file_true_name,"."));  
                //echo "$uploaded_file   $move_to_file";  
                if(move_uploaded_file($uploaded_file,iconv("utf-8","gb2312",$move_to_file))) {  
                    // echo $_FILES['userhead']['name']."上传成功";
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
                    //将图片存入数据库
                    $stele_data = array('user_id' => $username, 'title' => $this->db->escape_str($title) , 'synopsis' => $this->db->escape_str($synopsis), 'birthday_time' => $this->db->escape_str($birthday_time), 'death_time' => $this->db->escape_str($death_time), 'picture' => $picture, 'gift_type' =>'1', 'style' => $this->db->escape_str($this->input->post('myTemplate')), 'add_time' => $time, 'welcome' => '', 'is_hot' => '0', 'is_del' => '0');
                    if(!empty($inh_id)){
                        $stele_data['inh_id'] = $this->db->escape_str($inh_id); 
                    }
                    $stele_id = $this->user_model->insert_cc_stele($stele_data);
                    //插入传承碑权限表
                    $note = '创建人';
                    $cc_stele_connect_data = array('user_id' => $username, 'stele_id' => $stele_id, 'time' => $time, 'free_gift_time' => $time-3600*8, 'note' => $note);
                    $cc_stele_connect_id = $this->user_model->insert_stele_connect($cc_stele_connect_data);//插入免费礼物时间结束
                    if(!empty($inh_id)){
                        //修改传记表里面的关联传承碑id
                        $this->user_model->update_info('cc_inherit', array('stele_id' => $stele_id), array('id' => $inh_id));
                    }
                    if($stele_id){
                        redirect('cloud?s='.$stele_id);exit();
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