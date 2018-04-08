<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Cloud extends CI_Controller {

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
            $stele_info = $this->user_model->select_info('cc_stele', 'title,synopsis,picture,gift_type,style,is_ste_open', array('id' => $stele_id));
            if($stele_info['is_ste_open'] != '1'){//不公开
                $stele_connect_id = $this->user_model->select_info('cc_stele_connect', 'id', array('stele_id' => $stele_id, 'user_id' => $_SESSION['uid']));
                if(empty($stele_connect_id)){
                    echo "传记未公开".$stele_connect_id['id'];exit();
                }
            }
            switch ($stele_info['style'])
            {
            case 'kongzi':
                //查询用户总余额
                $total_user_point = $this->user_model->total_user_point($_SESSION['uid']);
                //获取该传承碑动态
                $give_list = $this->user_model->get_stele_give_by_ste($stele_id,'1');
                //滚动条 获取最新的3条赠送记录
                $give_list_3 = $this->user_model->get_stele_give_new_3($stele_id);
                //礼物总数量
                $totle_gifts = $this->user_model->sum_stele_give($stele_id);
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
                 $data = array('inc_url' => $inc_url, 'stele_id' => $stele_id, 'top_10' => $top_10, 'stele_info' => $stele_info, 'totle_gifts' => $totle_gifts, 'total_user_point' => $total_user_point, 'give_list' => $give_list, 'give_list_3' => $give_list_3, 'is_free_good' => $is_free_good);
                $this->load->view('kongzi',$data);
                break;

            case 'inh_stele_second':
                //查询用户总余额
                $total_user_point = $this->user_model->total_user_point($_SESSION['uid']);
                //获取该传承碑动态
                $give_list = $this->user_model->get_stele_give_by_ste($stele_id,'1');
                //滚动条 获取最新的3条赠送记录
                $give_list_3 = $this->user_model->get_stele_give_new_3($stele_id);
                //礼物总数量
                $totle_gifts = $this->user_model->sum_stele_give($stele_id);
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

                $data = array('inc_url' => $inc_url, 'stele_id' => $stele_id, 'top_10' => $top_10, 'stele_info' => $stele_info, 'totle_gifts' => $totle_gifts, 'total_user_point' => $total_user_point, 'give_list' => $give_list, 'give_list_3' => $give_list_3, 'is_free_good' => $is_free_good);
                $this->load->view('inh_stele_second',$data);
                break;

            default:
                //查询用户总余额
                $total_user_point = $this->user_model->total_user_point($_SESSION['uid']);
                //获取该传承碑动态
                $give_list = $this->user_model->get_stele_give_by_ste($stele_id,'1');
                //滚动条 获取最新的3条赠送记录
                $give_list_3 = $this->user_model->get_stele_give_new_3($stele_id);
                //礼物总数量
                $totle_gifts = $this->user_model->sum_stele_give($stele_id);
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

                $data = array('inc_url' => $inc_url, 'stele_id' => $stele_id, 'top_10' => $top_10, 'stele_info' => $stele_info, 'totle_gifts' => $totle_gifts, 'total_user_point' => $total_user_point, 'give_list' => $give_list, 'give_list_3' => $give_list_3, 'is_free_good' => $is_free_good);
                $this->load->view('inh_stele_second',$data);
            }
        }else{
            echo '访问错误';exit();
        }
        
    }

    public function memery()
    {   
        
        if(empty($_SESSION['uid'])){
            redirect('WechatOauthLogin/main/memery');exit();
        }
        //引入模块文件 user_model.php
        $this->load->model('user_model');
        //获取图片空间url
        $inc_url = $this->user_model->get_picture_space_info('url');

        $stele_id = '2';
        $data = array('inc_url' => $inc_url,'stele_id' => $stele_id);
        $this->load->view('memery',$data);
    }

    public function give()
    {
        //引入模块文件 user_model.php
        $this->load->model('user_model');
        if(empty($_SESSION['uid'])){
            redirect('WechatOauthLogin/main/memery');exit();
        }
        if($this->input->post()){
            $uid = $_SESSION['uid'];

            if (!empty($this->input->post('stele_id'))) {
                $stele_id = $this->input->post('stele_id',true);
                $gift_id = $this->input->post('gift_id',true);
                $data = array('user_id' => $uid, 'stele_id' => $this->db->escape_str($stele_id), 'gift_id' => $this->db->escape_str($gift_id), 'time' => time());

                //获取自己是第几个献花
                //$my_num = $this->user_model->select_info('cc_stele_give', 'id', array('user_id' => $uid,'stele_id' => $stele_id));
                //if(empty($my_num)){
                    $return = $this->db->insert('cc_stele_give', $data);
                    if($return){
                        $my_num = $this->db->insert_id();//送礼成功
                    }else{
                        $my_num = '0';//送礼失败
                    }
                //}
            }
            echo ($my_num + 713187) * 3;
        }
    }

    public function prop()
    {
        if(empty($_SESSION['uid'])){
            echo '请先登录';exit();
        }
        //引入模块文件 user_model.php
        $this->load->model('user_model');
        $stele_gift_all_id = $this->user_model->get_stele_gift_all_id();
        $stele_gift_all_id = array_column($stele_gift_all_id, 'id');//所有礼物的ID
        $user_id = $_SESSION['uid'];
        $stele_id = trim($this->input->post('stele_id',true));
        $gift_type = trim($this->input->post('gift_type',true));
        if(empty($gift_type)){//方便kongzi.php页面赠送礼物没有传gift_type
            $gift_type = $this->user_model->select_info('cc_stele', 'gift_type', array('id' => $stele_id));
        }
        
        if(isset($stele_id)&&is_numeric($stele_id)&&!strpos($stele_id, '.')&&$stele_id!='0'){
            if (isset($gift_type)&&is_numeric($gift_type)&&!strpos($gift_type, '.')&&in_array($gift_type,$stele_gift_all_id)&&$gift_type!='0') {
                $stele_id = intval($stele_id);
                $time = time();
                //查询用户的免费礼物时间
                $free_gift_time = $this->user_model->select_info('cc_stele_connect', 'id,free_gift_time', array('user_id' => $user_id, 'stele_id' => $stele_id));
                if(empty($free_gift_time)){
                    //插入免费礼物时间 (传承碑与用户关联表)
                    $note = '通过赠送礼物插入';
                    $cc_stele_connect_data = array('user_id' => $user_id, 'stele_id' => $stele_id, 'time' => $time, 'free_gift_time' => $time, 'note' => $note);
                    $cc_stele_connect_id = $this->user_model->insert_stele_connect($cc_stele_connect_data);//插入免费礼物时间结束
                    //开始赠送免费礼物
                    $gift_price = $this->user_model->select_info('cc_stele_gift', 'price', array('id' => $gift_type));//礼物价格
                    if(empty($gift_price)){
                        $gift_price = '0';
                    }
                    $cc_stele_give_data = array('user_id' => $user_id, 'stele_id' => $stele_id, 'gift_id' => $gift_type, 'gift_price' => $gift_price, 'gift_count' => '1', 'total_gift_price' => $gift_price, 'time' => $time);
                    $cc_stele_give_id = $this->user_model->insert_stele_give($cc_stele_give_data);//插入赠送礼物表
                    //赠送结束
                    echo json_encode(array('code' => '1','wait_time' => date('H:i:s',0)));//赠送成功 json_encode(array('code' => '1','wait_time' => date('H:i:s',8*3600))); 设定上海时区之后date函数加8小时
                }elseif(empty($free_gift_time['free_gift_time'])){
                    //修改时间
                    $cc_stele_connect_data = array('free_gift_time' => $time);
                    $where = array('id' => $free_gift_time['id']);
                    $this->user_model->update_info('cc_stele_connect', $cc_stele_connect_data, $where);
                    //开始赠送免费礼物
                    $gift_price = $this->user_model->select_info('cc_stele_gift', 'price', array('id' => $gift_type));//礼物价格
                    if(empty($gift_price)){
                        $gift_price = '0';
                    }
                    $cc_stele_give_data = array('user_id' => $user_id, 'stele_id' => $stele_id, 'gift_id' => $gift_type, 'gift_price' => $gift_price, 'gift_count' => '1', 'total_gift_price' => $gift_price, 'time' => $time);
                    $cc_stele_give_id = $this->user_model->insert_stele_give($cc_stele_give_data);//插入赠送礼物表
                    //赠送结束
                    echo json_encode(array('code' => '1','wait_time' => date('H:i:s',0)));//赠送成功 json_encode(array('code' => '1','wait_time' => date('H:i:s',8*3600)));设定上海时区之后date函数加8小时
                }else{
                    //查询免费礼物时间是否为已经过去X小时
                    $set_hours = 8*3600;//间隔时间为8小时
                    $bj_time =$set_hours + $free_gift_time['free_gift_time'];
                    if($time >= $bj_time){
                        //赠送免费礼物，并且更新时间
                        $cc_stele_connect_data = array('free_gift_time' => $time);
                        $where = array('id' => $free_gift_time['id']);
                        $this->user_model->update_info('cc_stele_connect', $cc_stele_connect_data, $where);
                        //开始赠送免费礼物
                        $gift_price = $this->user_model->select_info('cc_stele_gift', 'price', array('id' => $gift_type));//礼物价格
                        if(empty($gift_price)){
                            $gift_price = '0';
                        }
                        $cc_stele_give_data = array('user_id' => $user_id, 'stele_id' => $stele_id, 'gift_id' => $gift_type, 'gift_price' => $gift_price, 'gift_count' => '1', 'total_gift_price' => $gift_price, 'time' => $time);
                        $cc_stele_give_id = $this->user_model->insert_stele_give($cc_stele_give_data);//插入赠送礼物表
                        //赠送结束
                        echo json_encode(array('code' => '1','wait_time' => date('H:i:s',0)));//赠送成功  json_encode(array('code' => '1','wait_time' => date('H:i:s',8*3600)));设定上海时区之后date函数加8小时
                    }else{
                        //查询是否有余额
                        $total_user_point = $this->user_model->total_user_point($user_id);
                        $gift_price = $this->user_model->select_info('cc_stele_gift', 'price', array('id' => $gift_type));//礼物价格
                        if(empty($gift_price)||$gift_price<1){
                            $gift_price = '1';
                        }
                        if($total_user_point >= $gift_price){
                            //开始赠送收费礼物
                            $cc_stele_give_data = array('user_id' => $user_id, 'stele_id' => $stele_id, 'gift_id' => $gift_type, 'gift_price' => $gift_price, 'gift_count' => '1', 'total_gift_price' => $gift_price, 'time' => $time);
                            $cc_stele_give_id = $this->user_model->insert_stele_give($cc_stele_give_data);//插入赠送礼物表
                            //对用户的余额进行减少
                            $user_name = $this->user_model->select_info('cc_user', 'nickname', array('id' => $user_id));
                            $point = $gift_price * -1;
                            $cc_money_log_data = array('give_id' => $cc_stele_give_id, 'time' => $time, 'user_id' => $user_id, 'user_name' => $user_name, 'point' => $point, 'note' => '赠送礼物');
                            $cc_money_log_id = $this->user_model->insert_money_log($cc_money_log_data);
                            //结束赠送收费礼物
                            echo json_encode(array('code' => '2','wait_time' => $bj_time-$time>0?date('H:i:s',$bj_time-$time):''));//赠送成功
                        }else{
                            //提示用户进行充值
                            echo json_encode(array('code' => '-1','wait_time' => $bj_time-$time>0?date('H:i:s',$bj_time-$time):''));//请前往个人中心充值
                        }
                    }
                }
            }else{
                echo "礼物类型错误";exit();
            }
        }else{
            echo "系统错误";exit();
        }
    }

    public function propp()
    {
        if(empty($_SESSION['uid'])){
            echo '请先登录';exit();
        }
        //引入模块文件 user_model.php
        $this->load->model('user_model');
        $stele_gift_all_id = $this->user_model->get_stele_gift_all_id();
        $stele_gift_all_id = array_column($stele_gift_all_id, 'id');
        //$this->form_validation->set_rules('gift_type', '礼物类型', 'required|is_natural_no_zero|in_list['.$stele_gift_all_id.']|trim');
        //$this->form_validation->set_rules('stele_id', '传承碑ID', 'required|is_natural_no_zero|trim');
        //$this->form_validation->set_rules('choose_num', '礼物数量', 'required|is_natural_no_zero|trim');
        $stele_id = trim($this->input->post('stele_id'));
        $gift_type = trim($this->input->post('gift_type'));
        $choose_num = trim($this->input->post('choose_num'));
        if (isset($stele_id)&&is_numeric($stele_id)&&!strpos($stele_id, '.')&&$stele_id!='0') {
            if (isset($gift_type)&&is_numeric($gift_type)&&!strpos($gift_type, '.')&&in_array($gift_type,$stele_gift_all_id)&&$gift_type!='0') {
                if (isset($choose_num)&&is_numeric($choose_num)&&!strpos($choose_num, '.')&&$choose_num!='0') {
                    $user_id = $_SESSION['uid'];
                    if(!empty($stele_id)){
                        $stele_id = intval($stele_id);
                        $gift_type = intval($gift_type);
                        $choose_num = intval($choose_num);
                        $time = time();
                        //查询用户的免费礼物时间
                        $free_gift_time = $this->user_model->select_info('cc_stele_connect', 'id,free_gift_time', array('user_id' => $user_id, 'stele_id' => $stele_id));
                        if(empty($free_gift_time)){
                            //插入用户与传承碑的关联信息表 (传承碑与用户关联表)
                            $note = '通过赠送礼物插入';
                            $cc_stele_connect_data = array('user_id' => $user_id, 'stele_id' => $stele_id, 'time' => $time, 'free_gift_time' => $time, 'note' => $note);
                            $cc_stele_connect_id = $this->user_model->insert_stele_connect($cc_stele_connect_data);//插入免费礼物时间结束
                        }
                        //查询是否有余额
                        $total_user_point = $this->user_model->total_user_point($user_id);
                        $gift_price = $this->user_model->select_info('cc_stele_gift', 'price', array('id' => $gift_type));//礼物价格
                        if(empty($gift_price)||$gift_price<1){
                            $gift_price = '1';
                        }
                        $total_gift_price = $gift_price * $choose_num;
                        if($total_user_point >= $total_gift_price){
                            //开始赠送收费礼物
                            $cc_stele_give_data = array('user_id' => $user_id, 'stele_id' => $stele_id, 'gift_id' => $gift_type, 'gift_price' => $gift_price, 'gift_count' => $choose_num, 'total_gift_price' => $total_gift_price, 'time' => $time);
                            $cc_stele_give_id = $this->user_model->insert_stele_give($cc_stele_give_data);//插入赠送礼物表
                            //对用户的余额进行减少
                            $user_name = $this->user_model->select_info('cc_user', 'nickname', array('id' => $user_id));
                            $point = $total_gift_price * -1;
                            $cc_money_log_data = array('give_id' => $cc_stele_give_id, 'time' => $time, 'user_id' => $user_id, 'user_name' => $user_name, 'point' => $point, 'note' => '赠送礼物');
                            $cc_money_log_id = $this->user_model->insert_money_log($cc_money_log_data);
                            //结束赠送收费礼物
                            echo json_encode(array('code' => '2'));//赠送成功
                        }else{
                            //提示用户进行充值
                            echo json_encode(array('code' => '-1'));//赠送成功
                        }
                    }
                }else{
                    echo "礼物数量错误";exit();
                }
            }else{
                echo "礼物类型错误";exit();
            }
        }else{
            echo "系统错误";exit();
        }
    }
    
}
?>