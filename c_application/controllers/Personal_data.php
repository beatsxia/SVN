<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Personal_data extends CI_Controller {
    
     public function index()
    {	
    	if(empty($_SESSION['uid'])){
    		redirect('WechatOauthLogin');exit();
    	}
    	//引入模块文件 user_model.php
        $this->load->model('user_model');

        //获取图片空间url
        $inc_url = $this->user_model->get_picture_space_info('url');

        $uid = $_SESSION['uid'];
        //头像 昵称 个性签名
        $this->db->select('avatar,nickname,personality_note');
        $this->db->where('id', $uid);
        $query  = $this->db->get('cc_user');
        $user_data = $query ->row_array();
        $avatar = $user_data['avatar'];//头像
        $nickname = $user_data['nickname'];//昵称
        $personality_note = $user_data['personality_note'];//个性签名

        //传记总数量（包括我发布的和我参与的）
        $this->db->select('id');
        $this->db->where('user_id', $uid);
        $query  = $this->db->get('cc_inherit');
        $inherit_num = $query ->num_rows();//我发布的传记数
        if($inherit_num == 0){
            $inherit_id_arr = '';
        }elseif ($inherit_num == 1) {
            $inherit_id_arr =  $query ->row_array();
        }elseif ($inherit_num > 1) {
            $inherit_id =  $query ->result_array();
            $inherit_id_arr = array();
            foreach ($inherit_id as $key => $value) {
                $inherit_id_arr[] = $value['id']; 
            }
        }
        $this->db->select('inh_id');
        $this->db->where('inh_user_id != ', $uid);
        $this->db->where('user_id', $uid);
        $query  = $this->db->get('cc_inherit_content');
        $inherit_content_num = $query ->result_array();//求我参与的传记数组
        $inherit_content_id_arr = array();
        if(!empty($inherit_content_num)){
            foreach ($inherit_content_num as $key => $value) {
                $inherit_content_id_arr[] = $value['inh_id'];
            }
            $inherit_content_id_arr = array_unique($inherit_content_id_arr);//我参与的传记ID
            
            $inh_content_num = count($inherit_content_id_arr);//我参与的传记数
        }else{
            $inh_content_num = 0;//我参与的传记数
        }
        $total_inh_num = $inherit_num + $inh_content_num;//传记总数量
        
        //用户自己创建的传记的访问人次
        $this->db->where_in('access_page',$inherit_id_arr);
        $this->db->where('type','inherit');
        $query  = $this->db->get('cc_access_log');
        $access_log_num = $query ->num_rows();//访问次数

        //关注人数
        $this->db->where('user_id',$uid);
        $this->db->where('cancel','0');
        $query  = $this->db->get('cc_fans');
        $user_follow_num = $query ->num_rows();//关注人数

        //粉丝人数
        $this->db->where('follower_id',$uid);
        $this->db->where('cancel','0');
        $query  = $this->db->get('cc_fans');
        $user_fans_num = $query ->num_rows();//粉丝人数

        

        $info_data =  array('avatar' => $avatar, 'nickname' => $nickname, 'personality_note' => $personality_note, 'total_inh_num' => $total_inh_num, 'access_log_num' => $access_log_num, 'user_follow_num' => $user_follow_num, 'user_fans_num' => $user_fans_num,'inc_url' =>$inc_url);

        $data = $info_data;
		$this->load->view('personal_data',$data);
    }
    
}
?>