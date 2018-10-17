<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Upload extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        if(empty($_SESSION['uid'])){
            redirect('WechatOauthLogin');exit();
        }
        $this->load->helper('form');
        $this->load->library('form_validation');
        //引入模块文件 user_model.php
        $this->load->model('user_model');
    }


     public function index()
    {	
        //获取图片空间url
        $inc_url = $this->user_model->get_picture_space_info('url');
        $data['inc_url'] = $inc_url;
        $data['appDate'] = date('Y-m-d',time());
		$this->load->view('Upload',$data);
    }

    //书写传记
    public function main()
    {   
        //循环处理上传文件
        /*
        $_config['upload_path']      = 'img/uploads/';
        $_config['allowed_types']    = 'gif|jpg|png';
        $_config['max_size']     = 10000;
        $_config['max_width']        = 10240;
        $_config['max_height']       = 7680;
        $this->load->library('upload');
        $this->upload->initialize($_config);
        foreach ($_FILES as $key => $value) {
            if (!empty($value['name'])) {
                // $this->form_validation->set_rules($key, '图片name', 'required|trim');
                // if ($this->form_validation->run()) {
                //     echo $this->form_validation->run();exit();
                // }
                if ($this->upload->do_upload($key)) {
                     //上传成功
                     print_r($this->upload->data());
                }else{
                     //上传失败
                     echo $error = $this->upload->display_errors();
                }
            }
        }exit();
        */

        //$this->form_validation->set_rules('appDate', '事件事件', 'required|min_length[2]|trim');

        $this->form_validation->set_rules('title', '标题', 'required|trim');
        if(!empty($this->input->post('appDate'))){
            $this->form_validation->set_rules('appDate', '事件时间', 'required|trim');
        }
        if(!empty($this->input->post('location'))){
            $this->form_validation->set_rules('location', '事件地点', 'required|trim');
        }
        $this->form_validation->set_rules('content', '内容', 'required|trim');
        $this->form_validation->set_rules('lock_open', '是否公开', 'required|numeric|trim');
        $this->form_validation->set_rules('inherit_id', '传记ID', 'required|numeric|trim');
        $this->form_validation->set_error_delimiters('<li>', '</li>');

        $nowtime = time();
        if($this->form_validation->run() === FALSE)
        {   
            $this->form_validation->set_message('required', '{field} 不能为空');
            $this->form_validation->set_message('numeric', '{field} 必须为数字');
            //如果数据有错则报错
            echo "出现错误";exit();
        }
        else
        {   
            $uid = $_SESSION['uid'];
            if($this->input->post('lock_open')=='1'){
                $is_open = $is_show = '0';
            }else{
                $is_open = $is_show = '1';
            }
            if($this->input->post('inherit_id')=='0'){
            
                if(preg_match("/src=\"(.*?)\"/s", $this->input->post('content'),$matche)){
                    $picture = $matche['1'];
                }else{
                    $picture = '';
                }
                $date  = array('user_id' => $uid,'title' => $this->input->post('title', TRUE),'add_time' => $nowtime,'is_open' => $is_open,'last_time' => $nowtime,'picture' => $picture);
                $inherit_id = $this->user_model->insert_inherit($date);

                if(!empty($inherit_id)){
                    $content_date = array('inh_id' => $inherit_id ,'inh_user_id' => $uid, 'user_id' => $uid, 'con_title' => $this->input->post('title'), 'sort' => '1', 'creation_time' => $nowtime, 'last_time' => $nowtime, 'content' => $this->input->post('content'), 'is_show' => $is_show, 'creation_address' => $this->input->post('location'));
                    //查询权限表是否已经存在记录
                    $power_id = $this->user_model->select_info('cc_inherit_power', 'id', array('inh_id' => $inherit_id, 'user_id' => $uid));
                    if(empty($power_id)){
                        $power_date = array('inh_id' => $inherit_id, 'user_id' => $uid, 'power_form' => '创建人', 'add_time' => $nowtime);
                        //插入传记权限信息
                        $this->user_model->insert_inherit_power($power_date);
                    }
                }else{
                    $this->form_validation->error_string = '创建传记失败';
                    echo '创建传记失败';exit();
                }
            }elseif($this->input->post('inherit_id')>'0'){
                
                //查询用户是否有添加传记的权限
                $power_id = $this->user_model->select_info('cc_inherit_power','id',array('inh_id' => $this->db->escape_str($this->input->post('inherit_id')), 'user_id' => $uid));
                if(!empty($power_id)){
                    $inherit_id = $this->input->post('inherit_id');
                    $inh_user_id = $this->user_model->select_info('cc_inherit', 'user_id', array('id' => $inherit_id));
                    //sort排名
                    $sorts = $this->user_model->select_info('cc_inherit_content', 'max(sort)', array('inh_id' => $inherit_id));
                    $sort = intval($sorts)+1;
                    //inherit_content表内容
                    $content_date = array('inh_id' => $inherit_id ,'inh_user_id' => $inh_user_id, 'user_id' => $uid, 'con_title' => $this->input->post('title'), 'sort' => $sort, 'content_time' => $this->input->post('appDate'), 'creation_time' => $nowtime, 'last_time' => $nowtime, 'content' => $this->input->post('content'), 'is_show' => $is_show, 'creation_address' => $this->input->post('location'));
                }else{
                    echo "没有编辑权限";exit();
                }
            }else{
                echo "访问错误";exit();
            }
            if($this->user_model->insert_inherit_content($content_date)){
                //创建成功。跳转
                redirect('show_article?inh_id='.$inherit_id);
            }
        }
    }

    public function imgupload()
    {
        
        //获取图片空间url
        $img_url = $this->user_model->get_picture_space_info('img_url');
        $accessKey = $this->user_model->get_picture_space_info('accessKey');
        $secretKey = $this->user_model->get_picture_space_info('secretKey');
        $img_name = $this->user_model->get_picture_space_info('img_name');

        // Allowed extentions.
        $allowedExts = array("gif", "jpeg", "jpg", "png", "GIF", "JPEG", "JPG", "PNG");
        // Get filename.
        $temp = explode(".", $_FILES["file"]["name"]);
        // Get extension.
        $extension = end($temp);
        // An image check is being done in the editor but it is best to
        // check that again on the server side.
        // Do not use $_FILES["file"]["type"] as it can be easily forged.
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime = finfo_file($finfo, $_FILES["file"]["tmp_name"]);
        finfo_close($finfo);
        //兼容特应用殊环境下的文件上传mime精准验证
        if(preg_match('/([^;]+);?.*$/',$mime,$match))
        {
            $mime=trim($match[1]);
        }
        if ((($mime == "image/gif")    || ($mime == "image/jpeg")    || ($mime == "image/pjpeg")    || ($mime == "image/x-png")    || ($mime == "image/png"))    && in_array($extension, $allowedExts)) {
            // Generate new random name.
            $name = sha1(microtime()) . "." . $extension;
            // Save file in the uploads folder.
            move_uploaded_file($_FILES["file"]["tmp_name"], "img/uploads/" . $name);

            //引入上传类库
            require_once('include/qiniu/autoload.php');
            $this->load->helper('qiniu_putfile');
            if(qiniu_putfile($accessKey,$secretKey,$img_name,"img/uploads/" . $name,"img/uploads/" . $name)){
                $img_url = $img_url;
            }else{
                $img_url = 'http://beatsxia.s1.natapp.cc/SVN/img/';//此处为网站域名
            }
            // Generate response.
            $response = new StdClass;
            $response->link = $img_url."img/uploads/" . $name;
            echo stripslashes(json_encode($response));
        }
        
    }
}
?>