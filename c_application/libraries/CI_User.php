<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
部分方法
 */

class CI_User{
    protected $_CI;
    public function __construct() {
        $this->_CI =& get_instance();
        $this->_CI->load->database();
        $this->_CI->load->model('user_model');
    }
	
	/**
	 * 用户激活VIP卡
	 * @param $activation_code 激活码
	 * @param $stele_id 传承碑id 
	 * @param $time 时间戳
	 * @return 返回是否成功 0  1  ，提示语言
	 */
	public function user_activate_card($activation_code,$stele_id,$time)
	{
		$this->_CI->load->driver('cache',array('adapter' => 'apc', 'backup' => 'file'));
		if(!preg_match("/[\'.,:;*?~`!@#$%^&+=)(<>{}]|\]|\[|\/|\\\|\"|\|/",$activation_code)&&!empty($activation_code)){
            if(!preg_match("/[\'.,:;*?~`!@#$%^&+=)(<>{}]|\]|\[|\/|\\\|\"|\|/",$stele_id)&&!empty($stele_id)){
                $Input_password = $this->_CI->cache->get('Input_password');
                if($Input_password == '3'){
                    return array('code' => '-1','hint' => '请您3分钟后在进行激活吧','content' => '');
                }else{
                	$code_info = $this->_CI->user_model->select_stele_card($activation_code,'0','1',$time);
	                if(empty($code_info)){
	                    if(!$Input_password){//查询是否有输错密码的记录
	                        $Input_password = 0;
	                    }else{
	                        $Input_password ++;
	                    }
	                    $this->_CI->cache->save('Input_password', $Input_password, 200);//设置激活码输错次数
	                    return array('code' => '0','hint' => '激活码错误','content' => '');
	                }else{
	                    $this->_CI->db->trans_start();//事务开启
	                    //激活VIP卡
	                    $this->_CI->user_model->update_info('cc_stele_card', array('is_used' => '1', 'used_time' => $time, 'user_id' => $_SESSION['uid'], 'stele_id' => $stele_id), array('id' => $code_info['id']));
	                    if($code_info['point'] != '0'){
	                        //给用户加余额
	                        $cc_money_log_data = array('card_id' => $code_info['id'], 'time' => $time, 'user_id' => $_SESSION['uid'], 'user_name' => $this->_CI->user_model->select_info('cc_user', 'nickname', array('id' => $_SESSION['uid'])), 'point' => $code_info['point'], 'note' => '激活VIP卡赠送余额');
	                        $cc_money_log_id = $this->_CI->user_model->insert_money_log($cc_money_log_data);
	                    }
	                    if($code_info['diamond'] != '0'){
	                        //给用户加灵石
	                    }
	                    //未完成部分有：1将传承碑转换为家祠 2如果该激活码为高级VIP则送风水山挂件给用户 等

	                    //待完成
	                    $this->_CI->db->trans_complete();
	                    if ($this->_CI->db->trans_status() === FALSE)
	                    {
	                        return array('code' => '0','hint' => '激活失败','content' => '');
	                    }else{
	                        return array('code' => '1','hint' => '激活成功','content' => '');
	                    }
	                }
                }
            }else{
                return array('code' => '0','hint' => '请先新建传承碑','content' => '');
            }
        }else{
            return array('code' => '0','hint' => '激活码不能包含特殊字符','content' => '');
        }
	}


	/**
	 * vip家祠邀请进来的给用户赠送18元余额，一个月有效
	 * @param $user_id 用户id 
	 * @param $inh_id 传记id 
	 * @return 0否 1是 2只能删除自己建立的部分章节 是否有权限删除  
	 */
	public function user_activate_card_money($activation_code,$stele_id,$time)
	{
		

	}
	
    
}
