<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Weixin extends CI_Controller {
    
     public function index()
    {	
        //引入lib
        $this->load->library('CI_Wechat');
        //引入模块文件 user_model.php
        $this->load->model('user_model');
        
        $this->ci_wechat->valid();
        $sceneid = $this->ci_wechat->getRev()->getRevSceneId();
        $this->ci_wechat->sendCustomMessage($data);
        if(!empty($sceneid)){//如果检测到sceneid
            $ms_type = substr($sceneid,0,2);
            $sceneid_num = substr($sceneid,2);
            $add_time = time();
            switch ($ms_type)
            {
            
            case "11"://个人邀请函
                //待完成
                break;
            
            case "12"://传记邀请函
                //$sceneid_num;//传记ID
                $open_id = $this->ci_wechat->getRev()->getRevFrom();
                $user_id = $this->user_model->select_info('cc_user', 'id', array('open_id' => $open_id));
                $get_user_open_id = $this->user_model->get_user_open_id($sceneid_num);//传记创建人的open_id
                if(!empty($user_id)){//如果用户存在
                    $inherit_power_id = $this->user_model->select_info('cc_inherit_power', 'id', array('inh_id' => $sceneid_num, 'user_id' => $user_id));
                    if(empty($inherit_power_id)){//如果权限表不存在记录
                        //将user_id 和 传记ID 插入 传记权限表
                        $inherit_power_date = array('inh_id' => $sceneid_num, 'user_id' => $user_id, 'power_form' => '扫描二维码加入', 'add_time' => $add_time);
                        if($this->user_model->insert_inherit_power($inherit_power_date)){//如果插入成功
                            $content = "用户：".$this->user_model->select_info('cc_user', 'nickname', array('open_id' => $open_id))." 通过扫描二维码加入您的《".$this->user_model->select_info('cc_inherit', 'title', array('id' => $sceneid_num))."》传记编辑。";
                            $data = array('touser' => $get_user_open_id['open_id'], 'msgtype' => 'text', 'text' => array('content' => $content));
                            $this->ci_wechat->sendCustomMessage($data);//发信息给用户
                        }
                    }
                    $data = array('touser' => $get_user_open_id['open_id'], 'msgtype' => 'text', 'text' => array('content' => "传记链接：http://www.chuancheng1.com/index.php/root_new_set?inh_id=".$sceneid_num));
                    $this->ci_wechat->sendCustomMessage($data);//发信息给用户
                    
                }else{//用户不存在 
                    //插入一个表，然后使用事件运行。
                    $inherit_power_tbd_date = array('cc_id' => $sceneid_num, 'open_id' => $open_id, 'time' => $add_time, 'type' => 'inh');
                    $this->user_model->insert_inherit_power_tbd($inherit_power_tbd_date);

                }
                break;
            case "13"://传承碑邀请函
                //$sceneid_num;//传承碑ID
                $open_id = $this->ci_wechat->getRev()->getRevFrom();
                $user_id = $this->user_model->select_info('cc_user', 'id', array('open_id' => $open_id));
                $get_user_open_id = $this->user_model->get_user_open_id_by_ste($sceneid_num);//传记创建人的open_id
                if(!empty($user_id)){//如果用户存在
                    $inherit_power_id = $this->user_model->select_info('cc_stele_connect', 'id', array('stele_id' => $sceneid_num, 'user_id' => $user_id));
                    if(empty($inherit_power_id)){//如果权限表不存在记录
                        //将user_id 和 传记ID 插入 传记权限表
                        $note = '扫描二维码加入';
                        $stele_connect_date = array('user_id' => $user_id, 'stele_id' => $sceneid_num, 'time' => $add_time, 'free_gift_time' => $add_time, 'note' => $note);
                        if($this->user_model->insert_stele_connect($stele_connect_date)){//如果插入成功
                            $content = "用户：".$this->user_model->select_info('cc_user', 'nickname', array('open_id' => $open_id))." 通过扫描二维码加入您的《".$this->user_model->select_info('cc_stele', 'title', array('id' => $sceneid_num))."》传承碑。";
                            $data = array('touser' => $get_user_open_id['open_id'], 'msgtype' => 'text', 'text' => array('content' => $content));
                            $this->ci_wechat->sendCustomMessage($data);//发信息给用户
                        }
                        
                    }
                    $data = array('touser' => $open_id, 'msgtype' => 'text', 'text' => array('content' => "传承碑链接：http://www.chuancheng1.com/index.php/cloud?s=".$sceneid_num));
                    $this->ci_wechat->sendCustomMessage($data);//发信息给用户
                    
                    
                }else{//用户不存在 
                    //插入一个表，然后使用事件运行。
                    $inherit_power_tbd_date = array('cc_id' => $sceneid_num, 'open_id' => $open_id, 'time' => $add_time, 'type' => 'ste');
                    $this->user_model->insert_inherit_power_tbd($inherit_power_tbd_date);

                }
                break;
            //default:
            }
            
        }
        
        
        
    }
}
?>