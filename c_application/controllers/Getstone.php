<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Getstone extends CI_Controller {
    
     public function index()
    {	
    	if(empty($_SESSION['uid'])){
    		redirect('WechatOauthLogin');exit();
    	}
    	//引入模块文件 user_model.php
        $this->load->model('user_model');

        //获取图片空间url
        $inc_url = $this->user_model->get_picture_space_info('url');

        $uid  = $_SESSION['uid'];
        $info = $this->user_model->get_mine_info($uid);
        $data = array(
		"inc_url"  => $inc_url,
		"userinfo" => $info
		);
		
		$this->load->view('getstone',$data);
    }
    
	public function ajaxAddStone()
	{
        if(empty($_SESSION['uid'])){
            redirect('WechatOauthLogin');exit();
        }
        //引入模块文件 user_model.php
        $this->load->model('user_model');
        $this->load->library('CI_Decide');
        //判断用户是否已经签到
        $time = time();
        $user_check_in = $this->user_model->select_user_check_in($_SESSION['uid']);
        if(empty($user_check_in)){//如果为空，说明为第一次签到（第一次签到默认为普通签到）
            //插入签到表
            $data = array('user_id' => $_SESSION['uid'], 'stele_id' => '0', 'add_time' => $time, 'check_in_time' => $time, 'note' => '签到插入', 'level' => '0');
            $return = $this->user_model->insert_check_in($data);
            if($return){
                return array('code' => '1','hint' => '普通签到成功','content' => '');
            }else{
                $this->load->view('error_view',array("msg" => "请勿重复签到"));
            }
        }else{
            $today = strtotime(date('Y-m-d'));//今天凌晨的时间
            //判断签到时间是否大于今天凌晨
            if($user_check_in['check_in_time']<$today){//如果签到时间小于今天凌晨
                if($user_check_in['level'] == '0'){//等级0为普通签到
                    $this->user_model->update_info('cc_check_in', array('check_in_time' => $time) ,array('id' => $user_check_in['id']));
                }else{
                    if($user_check_in['vip_end_time']<=$today){//如果VIP是在有效期内
                       //获得用户签到所属级别和签到所获得的积分、灵石
                        $decide_getstone = $this->ci_decide->decide_getstone($_SESSION['uid']);
                        if(!empty($decide_getstone)){//VIP签到
                            //执行签到
                            $this->user_model->update_info('cc_check_in', array('check_in_time' => $time) ,array('id' => $user_check_in['id']));
                            //给用户加积分和灵石，并添加相应记录数据
                            $this->_CI->db->trans_start();//事务开启
                            if($decide_getstone['diamond'] != '0'){
                                //给用户加灵石
                                
                            }
                            //在记录表添加签到和添加余额的记录(未完成)
                            $this->_CI->db->trans_complete();//事务结束
                            if ($this->_CI->db->trans_status() === FALSE)
                            {
                                return array('code' => '1','hint' => '普通签到成功','content' => '');
                            }else{
                                return array('code' => '0','hint' => '签到失败','content' => '');
                            }
                        }
                    }else{//用户VIP已经过期
                        //对用户进行VIP降级，并执行普通签到
                        if($this->user_model->update_info('cc_check_in', array('check_in_time' => $time, 'level' => '0') ,array('id' => $user_check_in['id']))){
                            return array('code' => '1','hint' => '普通签到成功','content' => '');
                        }else{
                            return array('code' => '0','hint' => '签到失败','content' => '');
                        }
                        
                    }
                }
            }else{
                //提示用户已经签过到
                $this->load->view('error_view',array("msg" => "请勿重复签到"));
            }
        }
	}
}
?>