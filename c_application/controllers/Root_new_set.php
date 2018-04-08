<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Root_new_set extends CI_Controller {
    
     public function index()
    {	
        $inh_id = $this->input->get('inh_id');
        if(empty($inh_id)){
            echo '访问错误';exit();
        }
    	if(empty($_SESSION['uid'])){
    		redirect('WechatOauthLogin/main/root_new_set?inh_id='.$inh_id);exit();
    	}
    	//引入模块文件 user_model.php
        $this->load->model('user_model');

        //获取图片空间url
        $inc_url = $this->user_model->get_picture_space_info('url');
        //用户ID
        $uid = $_SESSION['uid'];
        //获取传记id
        if(empty($this->input->get('inh_id'))){
            echo '没有传记ID';exit();
        }else{
            $inh_id = intval($this->input->get('inh_id'));
            $inherit = $this->user_model->select_info('cc_inherit', '*', array('id' => $inh_id));
            //判断传记是否公开
            $is_open = $inherit['is_open'];
            $inherit_contents_arr = array();
            if($is_open == '0'){//不公开
                $power_id = $this->user_model->select_info('cc_inherit_power', 'id', array('inh_id' => $inh_id, 'user_id' => $uid));
                if(!empty($power_id)){
                    $inherit_contents = $this->user_model->get_inherit_contents_user($this->input->get('inh_id'));
                }else{
                    echo "传记未公开";exit();
                }
            }else{
                $inherit_contents = $this->user_model->get_inherit_contents_user($this->input->get('inh_id'));
            }
            foreach ($inherit_contents as $key => $value) {
                $inh_power_id = $this->user_model->select_info('cc_inherit_content', 'inh_user_id,user_id', array('id' => $value['id']));
                if(in_array($uid, $inh_power_id)){
                    $value['is_power'] = '1';
                }else{
                    $value['is_power'] = '0';
                }
                $inherit_contents_arr[] =$value;
            }
            //查询用户是否有添加传记的权限
            $inh_power = $this->user_model->select_info('cc_inherit_power', 'id', array('inh_id' => $inh_id, 'user_id' => $uid));
            if(!empty($inh_power)){
                $inh_power = '1';
            }else{
                $inh_power = '0';
            }
            $data = array('inc_url' => $inc_url, 'inherit' => $inherit, 'inherit_contents_arr' => $inherit_contents_arr, 'inh_power' => $inh_power);
            $this->load->view('root_new_set',$data);
            
        }
    }
    
}
?>