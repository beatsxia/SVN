<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Edit extends CI_Controller {
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

        $uid = $_SESSION['uid'];

        if(empty($this->input->get('id'))){
            echo '链接错误';exit();
            
        }
		elseif( intval($this->input->get('id')) == -1 )
		{
			//print_r($inherit_content);exit;
			$data = array('inherit_content' => null, 'inc_url' => $inc_url);
            $this->load->view('edit',$data);
		}
		else
		{
            $inherit_content_id = intval($this->input->get('id'));
            //是否有权限
            $power_id = $this->user_model->get_inherit_power_id($uid,$inherit_content_id);
            if(!empty($power_id)){
                $inherit_content = $this->user_model->select_info('cc_inherit_content', '', array('id' => $inherit_content_id));
				$inherit_content["content"] = json_decode($inherit_content["content"], true);
				
                $data = array('inherit_content' => $inherit_content, 'inc_url' => $inc_url);
                $this->load->view('edit',$data);
            }else{
                echo "没有权限编辑";
            }
        }
    }
    public function main()
    {   
		$uid = $_SESSION['uid'];
		
		if( empty($this->input->post('inherit_content_id')) && empty($this->input->post('inherit_id')) )
		{
			$data = array();
			$data["user_id"]  = $uid;
			$data["title"]    = $this->input->post('title');
			$data["add_time"] = time();
			$data["last_time"]= time();
			
			$this->db->insert('cc_inherit', $data);
			$inhId = $this->db->insert_id();
			//print_r($this->db->insert_id());exit;
			if($inhId > 0)
			{
				$this->db->insert('cc_inherit_power', array("inh_id" => $inhId, "user_id" => $uid, "power_form" => "创建人","add_time" => time()));
				
				$conData = array();
				$conData["con_title"]        = $this->input->post('title');
				$conData["content"]          = $this->input->post('content');
				$conData["content_time"]     = $this->input->post('appDate');
				$conData["creation_address"] = $this->input->post('location');
				$conData["creation_time"]    = time();
				$conData["last_time"]        = time();
				$conData["inh_id"]           = $inhId;
				$conData["inh_user_id"]      = $uid;
				$conData["user_id"]          = $uid;
				$conData["sort"]             = 1;
				$conData["is_show"]          = (intval($this->input->post('lock_open')) == 0) ? 1 : 0;
				
				$this->db->insert('cc_inherit_content', $conData);
				$conId = $this->db->insert_id();
				redirect('show_content?cid='.$conId);
			}
			else
			{
				$this->load->view('error_view',array("msg" => "系统繁忙"));
			}
			exit;
		}
		
        $this->form_validation->set_rules('title', '标题', 'required|trim');
        if(!empty($this->input->post('appDate'))){
            $this->form_validation->set_rules('appDate', '事件时间', 'required|trim');
        }
        if(!empty($this->input->post('location'))){
            $this->form_validation->set_rules('location', '事件地点', 'required|trim');
        }
        $this->form_validation->set_rules('content', '内容', 'required|trim');
        $this->form_validation->set_rules('lock_open', '是否公开', 'required|numeric|trim');
        $this->form_validation->set_rules('inherit_content_id', '传记内容ID', 'required|numeric|trim');
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
            if($this->input->post('lock_open')=='1'){
                $is_open = $is_show = '0';
            }else{
                $is_open = $is_show = '1';
            }
            $inherit_content_id = $this->input->post('inherit_content_id');
            $inherit_id = $this->input->post('inherit_id');
            if($inherit_content_id!='0'){
                //查询用户是否有添加传记的权限
                $power_id = $this->user_model->get_inherit_power_id($uid,$inherit_content_id);
                if(!empty($power_id)){
                    //inherit_content表内容
                    $content_date = array('con_title' => $this->input->post('title'), 'content_time' => $this->input->post('appDate'), 'last_time' => time(), 'content' => $this->input->post('content'), 'is_show' => $is_show, 'creation_address' => $this->input->post('location'));
                    if($this->user_model->update_info('cc_inherit_content',$content_date,"id = $inherit_content_id")){
	                    //修改成功。跳转
	                    redirect('show_content?cid='.$inherit_content_id);
	                }
                }else{
                    echo "没有编辑权限";exit();
                }
            }
        }
    }
	public function ajaxImg()
	{
		$result = array();
		if(empty($_SESSION['uid'])){
			$result["status"] = "error";
			$result["msg"]    = "请先登录";
    		$result = json_encode($result);
			echo $result;
			exit;
    	}
		$typeArr  = array("jpg", "jpeg", "gif", "png", "bmp");
		$ext      = $this->input->post('ext');
		$imgBase  = $this->input->post('img');
		if(!in_array($ext, $typeArr))
		{
			$result["status"] = "error";
			$result["msg"]    = "请选择正确格式的图片";
		}
		else
		{
			$imgName = "./img/uploads/inh/" . time() . rand(1000,9999) . "." . $ext;
			$re = file_put_contents($imgName, base64_decode($imgBase));
			if($re > 0)
			{
				$result["status"] = "ok";
				$result["msg"]    = "../" . $imgName;
			}
			else
			{
				$result["status"] = "error";
				$result["msg"]    = "上传失败";
			}
		}
		$result = json_encode($result);
		echo $result;
		exit;
	}
	public function ajaxContent()
	{
		$result = array();
		if(empty($_SESSION['uid'])){
			$result["status"] = "error";
			$result["msg"]    = "请先登录";
    		$result = json_encode($result);
			echo $result;
			exit;
    	}
	}
}
?>