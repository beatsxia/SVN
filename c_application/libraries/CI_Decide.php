<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
权限判断
 */

class CI_Decide{
    protected $_CI;
    public function __construct() {
        $this->_CI =& get_instance();
        $this->_CI->load->database();
        $this->_CI->load->model('decide_model');
    }
	
	/**
	 * 判断是否有权限删除传记
	 * @param $user_id 用户id 
	 * @param $inh_id 传记id 
	 * @return 0否 1是 2只能删除自己建立的部分章节 是否有权限删除  
	 */
	public function decide_inherit($user_id,$inh_id)
	{
		$power_form = $this->_CI->decide_model->db_decide_inherit($user_id,$inh_id);
		if(!empty($power_form)){
			if ($power_form['power_form'] == '创建人') {
				return 1;
			}else{
				return 2;
			}
		}else{
			return 0;
		}
	}

	/**
	 * 判断是否有权限删除留言
	 * @param $user_id 用户id 
	 * @param $note_id 留言id 
	 * @return 0否 1是  是否有权限删除  
	 */
	public function decide_note($user_id,$note_id)
	{
		$note_user_id = $this->_CI->decide_model->db_decide_note($note_id);
		if(!empty($note_user_id)){
			if ($note_user_id['user_id'] == $user_id) {
				return 1;
			}else{
				return 0;
			}
		}else{
			return 0;
		}
	}

	/**
	 * 判断是否有权限删除传承碑
	 * @param $user_id 用户id 
	 * @param $stele_id 传承碑id 
	 * @return 0否 1是 2只能修改传承碑内容无法删除 是否有权限删除  
	 */
	public function decide_stele($user_id,$stele_id)
	{
		$db_decide_stele_connect = $this->_CI->decide_model->db_decide_stele_connect($user_id,$stele_id);
		if(!empty($db_decide_stele_connect)){
			if ($db_decide_stele_connect['note'] == '创建人') {
				return 1;
			}else{
				return 2;
			}
		}else{
			return 0;
		}
	}

	/**
	 * 判断是否有权限删除传记内容
	 * @param $user_id 用户id 
	 * @param $inh_con_id 传记内容id
	 * @return 0否 1是 2是 是否有权限删除  
	 */
	public function decide_inherit_content($user_id,$inh_con_id)
	{
		$db_decide_inherit_content = $this->_CI->decide_model->db_decide_inherit_content($user_id,$inh_con_id);
		if(!empty($db_decide_inherit_content)){
			if ($db_decide_inherit_content['power_form'] == '创建人') {
				return 1;
			}else{
				return 2;
			}
		}else{
			return 0;
		}
	}
    
}
