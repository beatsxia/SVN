<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Edit_new_heritage extends CI_Controller {
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

        
        $inh_id = intval($this->input->get('inh_id'));
        $data = array('inc_url' => $inc_url);
        if($inh_id>'0'){
            $inherit_contents = $this->user_model->get_inherit_contents_title($this->db->escape_str($inh_id));
            $inherit = $this->user_model->select_info('cc_inherit', '*', array('id' => $inh_id));
            $data = array('inc_url' => $inc_url,'inherit' => $inherit , 'inherit_contents' => $inherit_contents);
        }
		$this->load->view('edit_new_heritage',$data);
    }

    public function add()
    {   
        if(!empty($this->input->post('stele_id'))){
            $this->form_validation->set_rules('stele_id', '传承碑id', 'required|numeric|trim');
        }
        if($this->input->post('inherit_id')=='0'){
            $this->form_validation->set_rules('heritage_title', '传记标题', 'required|trim');
        }
        if(!empty($this->input->post('heritage_num'))){
            $this->form_validation->set_rules('heritage_num', '章节', 'required|trim');
        }
        if(!empty($this->input->post('heritage_section_title'))){
            $this->form_validation->set_rules('heritage_section_title', '章节标题', 'required|trim');
        }
        $this->form_validation->set_rules('arr_count', '章节数', 'required|numeric|trim');
        if(count($this->input->post())>22){
            echo '输入章节太多';exit();
        }
        if($this->form_validation->run() === FALSE)
        {   
            $this->form_validation->set_message('heritage_title', '{field} 不能为空');
            $this->form_validation->set_message('heritage_num', '{field} 不能为空');
            $this->form_validation->set_message('heritage_section_title', '{field} 不能为空');
            $this->form_validation->set_rules('arr_count', '{field} 必须为数字');
            //如果数据有错则报错
            echo "标题错误";exit();
        }
        else
        {   
            $uid = $_SESSION['uid'];
            //接收提交的信息
            $stele_id = $this->input->post('stele_id',TRUE);
            $heritage_title = $this->input->post('heritage_title', TRUE);
            $heritage_num = !empty($this->input->post('heritage_num'))?$this->input->post('heritage_num', TRUE):'';
            $heritage_section_title = $this->input->post('heritage_section_title', TRUE);
            $arr_count = $this->input->post('arr_count', TRUE);
            $inherit_id = '';
            $nowtime = time();
            //如果有inh_id
            if(intval($this->input->post('inherit_id'))>'0'){
                //查询用户是否有添加传记的权限
                $power_inh = $this->user_model->select_info('cc_inherit_power','id,power_form',array('inh_id' => $this->db->escape_str($this->input->post('inherit_id')), 'user_id' => $uid));
                if(!empty($power_inh)){
                    $inherit_id = $this->input->post('inherit_id');
                    $inh_user_id = $this->user_model->select_info('cc_inherit', 'user_id', array('id' => $inherit_id));
                    //sort排名
                    $sorts = $this->user_model->select_info('cc_inherit_content', 'max(sort)', array('inh_id' => $inherit_id));
                    $sort = intval($sorts)+1;
                    //inherit_content表内容
                    $content_date =array('inh_id' => $inherit_id ,'inh_user_id' => $uid, 'user_id' => $uid, 'con_title' => $this->db->escape_str($heritage_section_title),'con_num' =>  $this->db->escape_str($heritage_num), 'sort' => $sort, 'creation_time' => $nowtime, 'last_time' => $nowtime, 'content' => '');
                    $this->user_model->insert_inherit_content($content_date);
                    if($arr_count > 1){
                        for ($i=2; $i <= $arr_count; $i++) {
                            $con_num = $this->input->post('heritage_num'.$i,true);
                            $con_title = $this->input->post('heritage_section_title'.$i,true);
                            if(!preg_match("/[\'.,:;*?~`!@#$%^&+=)(<>{}]|\]|\[|\/|\\\|\"|\|/",$con_num)&&!empty($con_num)){
                                if(!preg_match("/[\'.,:;*?~`!@#$%^&+=)(<>{}]|\]|\[|\/|\\\|\"|\|/",$con_title)&&!empty($con_title)){
                                    $sorts = $this->user_model->select_info('cc_inherit_content', 'max(sort)', array('inh_id' => $inherit_id));
                                    $sort = intval($sorts)+1;
                                    $content_date = array('inh_id' => $inherit_id ,'inh_user_id' => $uid, 'user_id' => $uid, 'con_title' => $this->db->escape_str($con_title),'con_num' => $this->db->escape_str($con_num), 'sort' => $sort, 'creation_time' => $nowtime, 'last_time' => $nowtime, 'content' => '');
                                    $this->user_model->insert_inherit_content($content_date);
                                }
                            }
                        }
                    }
                    //如果是创建人可以修改标题和图片
                    $date = array('title' => $heritage_title ,'last_time' => time());
                    if($power_inh['power_form']=='创建人'){
                        //图片开始
                        if(!empty($_FILES['userfile']['tmp_name'])){
                            //获取文件的大小
                            $file_size = $_FILES['userfile']['size'];  
                            if($file_size>4*1024*1024) {  
                                echo "文件过大，不能上传大于2M的文件";  
                                exit();  
                            }
                            $file_type = $_FILES['userfile']['type'];
                            $allowed = array("image/jpeg","image/pjpeg","image/gif","image/x-png","image/png");
                            if(!in_array($file_type, $allowed)) {  
                                echo "图片格式不符合";  
                                exit();  
                            }
                            $time = time();
                            //判断是否上传成功（是否使用post方式上传）  
                            if(is_uploaded_file($_FILES['userfile']['tmp_name'])) {  
                                //把文件转存到你希望的目录（不要使用copy函数）  
                                $uploaded_file=$_FILES['userfile']['tmp_name'];  
                          
                                //我们给每个用户动态的创建一个文件夹  
                                $user_path = 'img/heritage/'.$_SESSION['uid'].'/';
                                //判断该用户文件夹是否已经有这个文件夹  
                                if(!file_exists($user_path)) {  
                                    mkdir($user_path);  
                                }  
                          
                                //$move_to_file=$user_path."/".$_FILES['myfile']['name'];  
                                $file_true_name=$_FILES['userfile']['name'];
                                $move_to_file=$user_path.$time.'_'.rand(1,1000).substr($file_true_name,strrpos($file_true_name,"."));  
                                //echo "$uploaded_file   $move_to_file";  
                                if(move_uploaded_file($uploaded_file,iconv("utf-8","gb2312",$move_to_file))) {  
                                    // echo $_FILES['userfile']['name']."上传成功";
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
                                    $date['picture'] = $picture; 
                                } else {  
                                    echo "上传图片失败";exit();
                                }  
                            } else {  
                                echo "上传图片失败";exit();
                            }
                        }//图片结束
                        $this->user_model->update_info('cc_inherit', $date, array('id' => $inherit_id));
                    }

                    redirect('root_new_set?inh_id='.$inherit_id);//创建成功。跳转
                }else{
                    echo "没有编辑权限";exit();
                }

            }else{
                $date = array('user_id' => $uid,'title' => $this->db->escape_str($heritage_title),'add_time' => $nowtime,'is_open' => '0','last_time' => $nowtime);
                //图片开始
                if(!empty($_FILES['userfile']['tmp_name'])){
                    //获取文件的大小
                    $file_size = $_FILES['userfile']['size'];  
                    if($file_size>4*1024*1024) {  
                        echo "文件过大，不能上传大于2M的文件";  
                        exit();  
                    }
                    $file_type = $_FILES['userfile']['type'];
                    $allowed = array("image/jpeg","image/pjpeg","image/gif","image/x-png","image/png");
                    if(!in_array($file_type, $allowed)) {  
                        echo "图片格式不符合";  
                        exit();  
                    }
                    $time = time();
                    //判断是否上传成功（是否使用post方式上传）  
                    if(is_uploaded_file($_FILES['userfile']['tmp_name'])) {  
                        //把文件转存到你希望的目录（不要使用copy函数）  
                        $uploaded_file=$_FILES['userfile']['tmp_name'];  
                  
                        //我们给每个用户动态的创建一个文件夹  
                        $user_path = 'img/heritage/'.$_SESSION['uid'].'/';
                        //判断该用户文件夹是否已经有这个文件夹  
                        if(!file_exists($user_path)) {  
                            mkdir($user_path);  
                        }  
                  
                        //$move_to_file=$user_path."/".$_FILES['myfile']['name'];  
                        $file_true_name=$_FILES['userfile']['name'];
                        $move_to_file=$user_path.$time.'_'.rand(1,1000).substr($file_true_name,strrpos($file_true_name,"."));  
                        //echo "$uploaded_file   $move_to_file";  
                        if(move_uploaded_file($uploaded_file,iconv("utf-8","gb2312",$move_to_file))) {  
                            // echo $_FILES['userfile']['name']."上传成功";
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
                            $date['picture'] = $picture; 
                        } else {  
                            echo "上传图片失败";exit();
                        }  
                    } else {  
                        echo "上传图片失败";exit();
                    }
                }//图片结束

                $inherit_id = $this->user_model->insert_inherit($date);
                if(!empty($inherit_id)){
                    if(!empty($this->input->post('heritage_section_title'))){
                        $content_date = array('inh_id' => $inherit_id ,'inh_user_id' => $uid, 'user_id' => $uid, 'con_title' => $this->db->escape_str($heritage_section_title),'con_num' =>  $this->db->escape_str($heritage_num), 'sort' => '1', 'creation_time' => $nowtime, 'last_time' => $nowtime, 'content' => '');
                        $this->user_model->insert_inherit_content($content_date);
                        if($arr_count > 1){
                            for ($i=2; $i <= $arr_count; $i++) {
                                $con_num = $this->input->post('heritage_num'.$i,true);
                                $con_title = $this->input->post('heritage_section_title'.$i,true);
                                if(!preg_match("/[\'.,:;*?~`!@#$%^&+=)(<>{}]|\]|\[|\/|\\\|\"|\|/",$con_num)&&!empty($con_num)){
                                    if(!preg_match("/[\'.,:;*?~`!@#$%^&+=)(<>{}]|\]|\[|\/|\\\|\"|\|/",$con_title)&&!empty($con_title)){
                                        $content_date = array('inh_id' => $inherit_id ,'inh_user_id' => $uid, 'user_id' => $uid, 'con_title' => $this->db->escape_str($con_title),'con_num' => $this->db->escape_str($con_num), 'sort' => $i, 'creation_time' => $nowtime, 'last_time' => $nowtime, 'content' => '');
                                        $this->user_model->insert_inherit_content($content_date);
                                    }
                                }
                            }
                        }
                    }
                    //查询权限表是否已经存在记录
                    $power_id = $this->user_model->select_info('cc_inherit_power', 'id', array('inh_id' => $inherit_id, 'user_id' => $uid));
                    if(empty($power_id)){
                        $power_date = array('inh_id' => $inherit_id, 'user_id' => $uid, 'power_form' => '创建人', 'add_time' => $nowtime);
                        //插入传记权限信息
                        if($this->user_model->insert_inherit_power($power_date)){
                            //修改关联传承碑开始
                            if(isset($stele_id)&&is_numeric($stele_id)&&!strpos($stele_id, '.')&&$stele_id!='0') {
                                $this->load->library('CI_Decide');
                                $power = $this->ci_decide->decide_stele($_SESSION['uid'],$stele_id);
                                if($power=='1'){
                                    $this->user_model->update_info('cc_inherit', array('stele_id' => '0'), array('stele_id' => $stele_id));//修改传记对应的关联传承碑为0
                                    $this->user_model->update_info('cc_stele', array('inh_id' => $inherit_id), array('id' => $stele_id));
                                    $this->user_model->update_info('cc_inherit', array('stele_id' => $stele_id), array('id' => $inherit_id));
                                }
                            }
                            //修改关联传承碑结束

                            //创建成功。跳转
                            redirect('root_new_set?inh_id='.$inherit_id);
                        }
                    }
                }else{
                    $this->form_validation->error_string = '创建传记失败';
                    echo '创建传记失败';exit();
                }
            }

        }
    }
    
}
?>