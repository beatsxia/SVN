<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Stele_detail extends CI_Controller {

     public function index()
    {	
        $stele_id = $this->input->get('s');
        if (isset($stele_id)&&is_numeric($stele_id)&&!strpos($stele_id, '.')&&$stele_id!='0') {
            $stele_id = intval($stele_id);
            if(empty($_SESSION['uid'])){
                redirect('WechatOauthLogin/main/cloud?s='.$stele_id);exit();
            }
            //引入模块文件 user_model.php
            $this->load->model('user_model');
            //获取图片空间url
            $inc_url = $this->user_model->get_picture_space_info('url');
            //获取传承碑信息
            $stele_info = $this->user_model->get_stele($stele_id);
            if($stele_info['is_ste_open'] != '1'){//不公开
                $stele_connect_id = $this->user_model->select_info('cc_stele_connect', 'id', array('stele_id' => $stele_id, 'user_id' => $_SESSION['uid']));
                if(empty($stele_connect_id)){
                    echo "传记未公开".$stele_connect_id['id'];exit();
                }
            }
            //获取关联传记
            if($stele_info['inh_id']!='0'){
                $stele_link_inh = $this->user_model->get_inherit_identify($stele_info['inh_id']);

                $inh_stage = json_decode($stele_link_inh["inh_stage"], true);//对数据进行转换，如果成功则截取前面60个字符
                if(!empty($inh_stage)){
                    $inh_content = '';
                    foreach ($inh_stage as $key => $value) {
                        if($value['type'] == 'text'){
                            $inh_content = $value['con'].$inh_content;
                        }
                    }
                    $stele_link_inh['inh_stage'] = substr($inh_content , 0 , 60);
                }
            }else{
                $stele_link_inh = '';
            }
            //查询用户总余额
            $total_user_point = $this->user_model->total_user_point($_SESSION['uid']);
            //获取该传承碑动态
            //$give_list = $this->user_model->get_stele_give_by_ste($stele_id,'1');
            //滚动条 获取最新的3条赠送记录
            //$give_list_3 = $this->user_model->get_stele_give_new_3($stele_id);
            //礼物总数量
            //$totle_gifts = $this->user_model->sum_stele_give($stele_id);
            //获取排名
            $top_10 = $this->user_model->stele_give_top_10($stele_id);
            //查询用户是否有免费礼物 开始  1:有免费礼物  0:没有免费礼物
            $time = time();
            $free_gift_time = $this->user_model->select_info('cc_stele_connect', 'id,free_gift_time', array('user_id' => $_SESSION['uid'], 'stele_id' => $stele_id));
            $is_free_good = 0;
            if(empty($free_gift_time)){
                $is_free_good = 1;
            }elseif(empty($free_gift_time['free_gift_time'])){
                $is_free_good = 1;
            }else{
                //查询免费礼物时间是否为已经过去X小时
                $set_hours = 8*3600;//间隔时间为8小时
                $bj_time =$set_hours + $free_gift_time['free_gift_time'];
                if($time >= $bj_time){
                    $is_free_good = 1;
                }
            }
            //查询用户是否有免费礼物 结束

            $data = array('inc_url' => $inc_url, 'stele_id' => $stele_id, 'uid' => $_SESSION['uid'], 'top_10' => $top_10, 'stele_info' => $stele_info, 'is_free_good' => $is_free_good, 'stele_link_inh' => $stele_link_inh);
            print_r($data);
            $this->load->view('stele_detail',$data);
        }else{
            echo '访问错误';exit();
        }
        
    }
    
}
?>