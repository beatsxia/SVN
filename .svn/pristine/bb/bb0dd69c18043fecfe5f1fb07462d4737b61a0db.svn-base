<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Show_article extends CI_Controller {
    
     public function index()
    {	
    	if(empty($_SESSION['uid'])){
    		redirect('WechatOauthLogin');exit();
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
                    $inherit_contents = $this->user_model->get_inherit_contents($this->input->get('inh_id'));
                    $inherit_user = $this->user_model->select_info('cc_user','nickname,avatar',array('id' => $inherit['user_id']));
                    $nickname = $inherit_user['nickname'];
                    $avatar = $inherit_user['avatar'];
                }else{
                    echo "传记未公开";exit();
                }
            }else{
                $inherit_contents = $this->user_model->get_inherit_contents($this->input->get('inh_id'));

                $inherit_user = $this->user_model->select_info('cc_user','nickname,avatar',array('id' => $inherit['user_id']));
                $nickname = $inherit_user['nickname'];
                $avatar = $inherit_user['avatar'];
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
            $data = array('inc_url' => $inc_url, 'inherit' => $inherit, 'inherit_contents_arr' => $inherit_contents_arr ,'nickname' => $nickname, 'avatar' => $avatar,'inh_uid' => $inherit['user_id']);
            $this->load->view('show_article',$data);
            
        }
    }

    public function log()
    {   
        if(!empty($_SESSION['uid'])){
            if ($this->input->post()){
                $post_data = $this->input->post();
                $user_id = $_SESSION['uid'];
                $url = $post_data['inh_url'];
                $type = 'inherit';
                $access_page = $post_data['access_page'];
                $referrer_url = $post_data['refer_url'];
                $access_time = $post_data['timeIn'];
                $load_time = $post_data['time'];
                $visitor_id = $post_data['inh_uid'];
                // $sql= "insert into ci_cc_access_log ('user_id', 'url', 'type', 'access_page', 'referrer_url', 'access_time', 'load_time', 'ip', 'visitor_id') values ";
                // $sql.="('$user_id','$url','$type','$access_page','$referrer_url','$access_time','$load_time','','$visitor_id'),";
                // $sql = substr($sql,0,strlen($sql)-1);
                $data = array('user_id' => $user_id, 'url' => $url, 'type' => $type, 'access_page' => $access_page, 'referrer_url' => $referrer_url, 'access_time' => $access_time, 'load_time' => $load_time, 'ip' => '', 'visitor_id' => $visitor_id);
                $this->db->insert('cc_access_log',$data);
            }
        }
    }
}
?>