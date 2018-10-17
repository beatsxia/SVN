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
	                    //将传承碑变成vip
	                    $this->_CI->user_model->update_info('cc_stele', array('vip' => $code_info['vip_id']), array('id' => $stele_id));

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
		
		1;
	}

	/**
	 * 用户收藏列表
	 * @param $user_id 用户id 
	 * @param $page 页数
	 * @param $limit 1页多少条数据
	 * @return array()  收藏记录
	 */
	public function user_collection($user_id,$page,$limit)
	{
		$user_id = intval($user_id);
		$page = intval($page);
		$limit = intval($limit);
		if(is_int($user_id) && $user_id > '0'){
			if(is_int($page) && $page > '0'){
				if(is_int($limit) && $limit > '0'){
					return $this->_CI->user_model->select_collection($user_id,$page,$limit);
				}
			}
		}
	}
	
	/**
	 * 查看某个传记是否被收藏
	 * @param $user_id 用户id 
	 * @param $inh_id 传记ID
	 * @return int 是否收藏  0 未收藏,   1:收藏 
	 */
	public function user_inh_is_collect($inh_id,$user_id)
	{
		$inh_id = intval($inh_id);
		$user_id = intval($user_id);
		if(is_int($inh_id) && $inh_id > '0'){
			$is_collect = $this->_CI->user_model->select_inh_is_collect($inh_id,$user_id);
			if($is_collect == '1'){
				$collect_img = 'collect2.png';
			}else{
				$collect_img = 'collect.png';
			}
			return array('is_collect' => $is_collect, 'collect_img' => $collect_img);
		}
	}


	/**
	 * 本地上传图片到存储空间
	 * @param $uploaded_file   图片名称
	 * @param $file_size       图片占存储空间的大小 单位B
	 * @param $file_type       图片类型
	 * @param $user_path       图片存放的本地的文件夹的相对目录 'img/stele/picture/ 
	 * @param $file_true_name  图片原本文件名
	 * @param $time            时间戳
	 * @return array('code' => '1','hint' => '上传成功','content' => array('picture' => $picture));
	 *
	 *
	*/
    public function uploading_file($uploaded_file,$file_size,$file_type,$user_path,$file_true_name,$time)
    {
    	if(!empty($uploaded_file)){
            //获取文件的大小  
            if($file_size>4*1024*1024) {  
                echo "文件过大，不能上传大于2M的文件";  
                exit();  
            }  
            $allowed = array("image/jpeg","image/pjpeg","image/gif","image/x-png","image/png");
            if(!in_array($file_type, $allowed)) {
                $return = array('code' => '-1','hint' => '图片格式不符合','content' => '');
            }else{
            	//判断是否上传成功（是否使用post方式上传）  
	            if(is_uploaded_file($uploaded_file)) {  
	                //判断该系统是否已经有这个文件夹  
	                if(!file_exists($user_path)) {  
	                    mkdir($user_path);  
	                }  
	                $file_true_name = $_FILES['userhead']['name'];
	                $move_to_file = $user_path.$time.'_'.rand(1,1000).substr($file_true_name,strrpos($file_true_name,"."));  //后面为图片后缀名
	                //把文件转存到你希望的目录（不要使用copy函数）  
	                if(move_uploaded_file($uploaded_file,iconv("utf-8","gb2312",$move_to_file))) {  
	                    //引入七牛上传类库
	                    require_once('include/qiniu/autoload.php');
	                    $this->_CI->load->helper('qiniu_putfile');
	                    //获取图片空间url
	                    $img_url = $this->_CI->user_model->get_picture_space_info('img_url');
	                    $accessKey = $this->_CI->user_model->get_picture_space_info('accessKey');
	                    $secretKey =$this->_CI->user_model->get_picture_space_info('secretKey');
	                    $img_name = $this->_CI->user_model->get_picture_space_info('img_name');
	                    if(qiniu_putfile($accessKey,$secretKey,$img_name, $move_to_file, $move_to_file)){
	                        $img_url = $img_url;
	                    }else{
	                        $img_url = 'http://www.chuancheng1.com/img/';//此处为网站域名
	                    }
	                    $picture = $img_url.$move_to_file;
	                    $return = array('code' => '1','hint' => '上传成功','content' => array('picture' => $picture));
	                } else { 
	                    $return = array('code' => '-1','hint' => '图片上传失败','content' => '');
	                }
	            } else {  
	                $return = array('code' => '-1','hint' => '图片上传失败','content' => '');
	            }
            }
        }else{
            $picture = 'http://owobcs29b.bkt.clouddn.com/img/heritage/1805/152759149593825058.png';
            $return = array('code' => '1','hint' => '上传成功','content' => array('picture' => $picture));
        }
        return $return;
    }
}
