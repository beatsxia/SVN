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
        echo $_POST['userhead'];exit;
        $this->form_validation->set_rules('nickname', '昵称', 'required|trim');
        $this->form_validation->set_rules('intro_yourself', '个人介绍', 'required|trim');
        //$this->form_validation->set_rules('mychoice', '礼物类型', 'required|numeric|trim');
        $this->form_validation->set_rules('myTemplate', '皮肤风格', 'required|trim');
        $this->form_validation->set_rules('sex', '性别', 'required|trim|in_list[0,1,2]');
        $inh_id = $this->input->post('link_inh_id');
        if(!empty($inh_id)){
            $this->form_validation->set_rules('link_inh_id', '关联传记ID', 'required|numeric|trim');
        }
        $this->form_validation->set_rules('birthday', '出生时间', 'trim');
        $this->form_validation->set_rules('day_of_death', '死亡时间', 'trim');
        $activation_code =  $this->input->post('link_inh_id',true);
        if(!empty($activation_code)){
            $this->form_validation->set_rules('activation_code', '激活码', 'required|exact_length[8]|trim');
        }
        if($this->form_validation->run() === FALSE)
        {   
            $this->form_validation->set_message('nickname', '{field} 不能为空');
            $this->form_validation->set_message('intro_yourself', '{field} 不能为空');
            //$this->form_validation->set_message('mychoice', '{field} 不能为空');
            $this->form_validation->set_message('myTemplate', '{field} 不能为空');
            $this->form_validation->set_message('link_inh_id', '{field} 必须选择');
            //如果数据有错则报错
            echo "填写信息错误";exit();
        }
        else
        {   
            $username = $_SESSION['uid'];
            //接收提交的信息
            //$fileintro = $_POST['fileintro'];  
            $title = $this->input->post('nickname',true);
            $synopsis = $this->input->post('intro_yourself',true);
            $birthday_time = $this->input->post('birthday',true);
            $death_time = $this->input->post('day_of_death',true);
            $sex = $this->input->post('sex',true);
            $time = time();
            //图片开始
            if(!empty($_FILES['userhead']['tmp_name'])){
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
                    } else { 
                        echo "图片上传失败";exit();
                    }
                } else {  
                    echo "图片上传失败";exit();
                }
            }else{
                $picture = 'http://owobcs29b.bkt.clouddn.com/img/heritage/1805/152759149593825058.png';
            }
            //图片结束
            
            //将图片存入数据库
            $stele_data = array('user_id' => $username, 'title' => $this->db->escape_str($title) ,'sex' => $this->db->escape_str($sex), 'synopsis' => $this->db->escape_str($synopsis), 'birthday_time' => $this->db->escape_str($birthday_time), 'death_time' => $this->db->escape_str($death_time), 'picture' => $picture, 'gift_type' =>'1', 'style' => $this->db->escape_str($this->input->post('myTemplate')), 'add_time' => $time, 'welcome' => '', 'is_hot' => '0', 'is_del' => '0');
            if(!empty($inh_id)){
                $stele_data['inh_id'] = $this->db->escape_str($inh_id); 
            }
            $stele_id = $this->user_model->insert_cc_stele($stele_data);
            //插入传承碑权限表
            $note = '创建人';
            $cc_stele_connect_data = array('user_id' => $username, 'stele_id' => $stele_id, 'time' => $time, 'free_gift_time' => $time-3600*8, 'note' => $note);
            $cc_stele_connect_id = $this->user_model->insert_stele_connect($cc_stele_connect_data);//插入免费礼物时间结束

            //VIP激活码
            if(!empty($activation_code)){
                $this->load->library('CI_User');
                $this->ci_user->user_activate_card($activation_code,$stele_id,$time);
            }
            //VIP激活码结束

            if(!empty($inh_id)){
                //修改传记表里面的关联传承碑id
                $this->user_model->update_info('cc_inherit', array('stele_id' => $stele_id), array('id' => $inh_id));
            }
            if($stele_id){
                redirect('cloud?s='.$stele_id);exit();
            }

        }
    }

    //新建传承碑并且同步生成传记和相关的权限
    public function add_heritage()
    {
        //echo $_FILES['userhead']['tmp_name'];exit();
        $this->form_validation->set_rules('nickname', '昵称', 'required|trim');
        $this->form_validation->set_rules('sex', '性别', 'required|trim|in_list[0,1,2]');
        $this->form_validation->set_rules('birthday', '出生时间', 'trim');
        $this->form_validation->set_rules('day_of_death', '死亡时间', 'trim');
        if($this->form_validation->run() === FALSE)
        {   
            $this->form_validation->set_message('nickname', '{field} 不能为空');
            //如果数据有错则报错
            echo "填写信息错误";exit();
        }
        else
        {   
            $uid = $_SESSION['uid'];
            //接收提交的信息
            //$fileintro = $_POST['fileintro'];  
            $title = $this->input->post('nickname',true);
            $birthday_time = $this->input->post('birthday',true);
            $death_time = $this->input->post('day_of_death',true);
            $sex = $this->input->post('sex',true);
            $time = time();

            //上传图片到图片空间
            $this->load->library('CI_User');
            $uploaded_file = $_FILES['userhead']['tmp_name'];
            $file_size = $_FILES['userhead']['size'];
            $file_type = $_FILES['userhead']['type'];
            $user_path = 'img/stele/picture/'.$uid.'/';
            $file_true_name = $_FILES['userhead']['name'];
            $result = $this->ci_user->uploading_file($uploaded_file,$file_size,$file_type,$user_path,$file_true_name,$time);
            //上传图片到图片空间结束

            //将图片存入数据库
            $stele_data = array('user_id' => $uid, 'title' => $this->db->escape_str($title) ,'sex' => $this->db->escape_str($sex), 'birthday_time' => $this->db->escape_str($birthday_time), 'death_time' => $this->db->escape_str($death_time), 'picture' => $result['content']['picture'], 'gift_type' =>'1', 'add_time' => $time, 'welcome' => '', 'is_hot' => '0', 'is_del' => '0');
            if(!empty($inh_id)){
                $stele_data['inh_id'] = $this->db->escape_str($inh_id); 
            }
            $stele_id = $this->user_model->insert_cc_stele($stele_data);
            //插入传承碑权限表
            $note = '创建人';
            $cc_stele_connect_data = array('user_id' => $uid, 'stele_id' => $stele_id, 'time' => $time, 'free_gift_time' => $time-3600*8, 'note' => $note);
            $cc_stele_connect_id = $this->user_model->insert_stele_connect($cc_stele_connect_data);//插入免费礼物时间结束

            //开始创建与传承碑对应的传记
            if( $stele_id )
            {
                $data = array();
                $data["user_id"]  = $uid;
                $data["title"]    = $title;
                $data["picture"]  = $result['content']['picture'];
                $data["stele_id"] = $stele_id;
                $data["add_time"] = time();
                $data["last_time"]= time();
                
                $this->db->insert('cc_inherit', $data);
                $inhId = $this->db->insert_id();
                //print_r($this->db->insert_id());exit;
                if($inhId > 0)
                {
                    $this->db->insert('cc_inherit_power', array("inh_id" => $inhId, "user_id" => $uid, "power_form" => "创建人","add_time" => time()));
                    
                    $conData = array();
                    $conData["con_title"]        = $title;
                    $conData["content"]          = '[{"type":"text","con":"写下您的个人传记...."}]';
                    $conData["content_time"]     = time();
                    $conData["creation_address"] = '';
                    $conData["creation_time"]    = time();
                    $conData["last_time"]        = time();
                    $conData["inh_id"]           = $inhId;
                    $conData["inh_user_id"]      = $uid;
                    $conData["user_id"]          = $uid;
                    $conData["sort"]             = 1;
                    $conData["is_show"]          = (intval($this->input->post('lock_open')) == 0) ? 1 : 0;
                    
                    $this->db->insert('cc_inherit_content', $conData);
                    $conId = $this->db->insert_id();
                    //关联传承碑
                    $this->user_model->update_info('cc_stele', array('inh_id' => $inhId), array('id' => $stele_id));
                    //redirect('show_content?cid='.$conId);
                }
                else
                {
                    $this->load->view('error_view',array("msg" => "系统繁忙"));
                }
                exit;
            }
            //结束创建对应传记
            if($stele_id){
                redirect('stele_detail?s='.$stele_id);exit();
            }

        }
    }
    
}
?>