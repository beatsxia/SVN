<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Msg_alb extends CI_Controller {
    
     public function index()
    {	
    	if(empty($_SESSION['uid'])){
    		redirect('WechatOauthLogin');exit();
    	}
        $stele_id = $this->input->get('s');
        if(empty($stele_id)){
            echo '访问错误';exit();
        }
        $this->load->helper(array('form', 'url'));
        if (isset($stele_id)&&is_numeric($stele_id)&&!strpos($stele_id, '.')&&$stele_id!='0') {
            //引入模块文件 user_model.php
            $this->load->model('user_model');
            $this->load->library('CI_Decide');
            $stele_id = intval($stele_id);
            $uid = $_SESSION['uid'];

            //获取图片空间url
            $inc_url = $this->user_model->get_picture_space_info('url');
            
            //获取留言数据
            $get_note_page = $this->user_model->get_note_page($stele_id,1);;
            $get_note_info = array();
            if(empty($get_note_page)){
                $get_note_info = '';
            }else{
                $get_note_info = array();
                foreach ($get_note_page as $key => $value) {
                    $value['is_zan'] = $this->user_model->get_is_my_zan($_SESSION['uid'],$value['id']);
                    $value['power'] = $this->ci_decide->decide_note($_SESSION['uid'],$value['id']);
                    $get_note_info[] = $value;
                }
            }
            $user_info = $this->user_model->select_info('cc_user', 'nickname,avatar', array('id' => $_SESSION['uid']));

            $data = array('inc_url' => $inc_url,'get_note_info' => $get_note_info, 'user_info' => $user_info, 'stele_id' => $stele_id);
            $this->load->view('msg_alb',$data);
        }
    	
    }

    public function new_msg()
    {   
        if(empty($_SESSION['uid'])){
            redirect('WechatOauthLogin');exit();
        }
        $this->load->helper(array('form', 'url'));
        //引入模块文件 user_model.php
        $this->load->model('user_model');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('stele_id', '传承碑ID', 'required|numeric|trim');
        if(!empty($this->input->post('msg_word',true))){
            $this->form_validation->set_rules('msg_word', '留言内容', 'required|trim');
        }
        if($this->form_validation->run() === FALSE)
        {   
            $this->form_validation->set_message('msg_word', '{field} 不能为空');
            $this->form_validation->set_message('stele_id', '{field} 必须为数字');
            //如果数据有错则报错
            echo "出现错误";exit();
        }
        else
        {   
            $user_id = $_SESSION['uid'];
            $content = $this->input->post('msg_word',true);
            $time = time();
            $stele_id = intval($this->input->post('stele_id',true));
            if(!empty($_FILES['file']['type'])){
                //获取文件的大小  
                $file_size=$_FILES['file']['size'];  
                if($file_size>4*1024*1024) {  
                    echo "文件过大，不能上传大于2M的文件";  
                    exit();  
                }  
              
                $file_type=$_FILES['file']['type'];
                $allowed = array("image/jpeg","image/pjpeg","image/gif","image/x-png","image/png");
                if(!in_array($file_type, $allowed)) {  
                    echo "图片格式不符合";  
                    exit();  
                }
                //判断是否上传成功（是否使用post方式上传）  
                if(is_uploaded_file($_FILES['file']['tmp_name'])) {  
                    //把文件转存到你希望的目录（不要使用copy函数）  
                    $uploaded_file=$_FILES['file']['tmp_name'];  
              
                    //我们给每个用户动态的创建一个文件夹  
                    //$user_path = $_SERVER['DOCUMENT_ROOT']."/studyphp/file/up/".$username;  
                    $user_path = 'img/stele/note/'.$user_id.'/';
                    //判断该用户文件夹是否已经有这个文件夹  
                    if(!file_exists($user_path)) {  
                        mkdir($user_path);  
                    }  
              
                    //$move_to_file=$user_path."/".$_FILES['file']['name'];  
                    $file_true_name=$_FILES['file']['name'];
                    $move_to_file=$user_path.$stele_id.'_'.$time.'_'.rand(1,1000).substr($file_true_name,strrpos($file_true_name,"."));  
                    //echo "$uploaded_file   $move_to_file";  
                    if(move_uploaded_file($uploaded_file,iconv("utf-8","gb2312",$move_to_file))) {  
                        // echo $_FILES['file']['name']."上传成功";
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
                         $data = array('is_first' => '1', 'picture' => $picture, 'user_id' => $user_id, 'content' => $this->db->escape_str($content), 'time' => $time, 'stele_id' => $stele_id);
                        if($this->user_model->insert_cc_note($data)){
                            redirect('msg_alb?s='.$stele_id);exit();//留言成功跳转  待完成
                        }
                    } else {  
                        echo "创建失败";exit();
                    }  
                } else {  
                    echo "创建失败";exit();
                }
            }else{//只有文字
                $data = array('is_first' => '1', 'user_id' => $user_id, 'content' => $this->db->escape_str($content), 'time' => $time, 'stele_id' => $stele_id);
                if($this->user_model->insert_cc_note($data)){
                    redirect('msg_alb?s='.$stele_id);exit();//留言成功跳转  待完成
                }
            }
        }
    }
    
}
?>