<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Comment extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        if(empty($_SESSION['uid'])){
            redirect('WechatOauthLogin');exit();
        }
        $this->load->helper('form');
        $this->load->library('form_validation');
        //引入模块文件 user_model.php
        $this->load->model('user_model');
    }

     public function index()
    {	
        //获取图片空间url
        $inc_url = $this->user_model->get_picture_space_info('url');

        //用户ID
        $uid = $_SESSION['uid'];

        //获取传记id
        if(empty($this->input->get('inh_id'))){
            echo '无法获取评论内容';exit();
            
        }else{
            $inh_id = intval($this->input->get('inh_id'));
            $inherit = $this->user_model->select_info('cc_inherit', '*', array('id' => $inh_id));
            //判断传记评论是否开放
            $is_open = $inherit['is_open'];
            $comments_data = array();
            if($is_open == '0'){//不公开
                $power_id = $this->user_model->select_info('cc_inherit_power', 'id', array('inh_id' => $inh_id, 'user_id' => $uid));
                if(!empty($power_id)){
                    $comment_num = $this->user_model->get_comment_num($inh_id);
                    $comments = $this->user_model->get_inh_comment($inh_id);
                    foreach ($comments as $key => $value) {
                        if($value['comment_id']!='0'){
                            $value['comment_id_name'] = $this->user_model->select_info('cc_user', 'nickname', array('id' => $value['cc_user_id']));
                        }else{
                            $value['comment_id_name'] = '';
                        }
                        $comments_data[] = $value;
                    }
                }else{
                    echo "传记未公开";exit();
                }
            }else{
                $comment_num = $this->user_model->get_comment_num($inh_id);
                $comments = $this->user_model->get_inh_comment($inh_id);
                foreach ($comments as $key => $value) {
                    if($value['comment_id']!='0'){
                        $value['comment_id_name'] = $this->user_model->select_info('cc_user', 'nickname', array('id' => $value['cc_user_id']));
                    }else{
                        $value['comment_id_name'] = '';
                    }
                    $comments_data[] = $value;
                }
            }
            $data = array('inc_url' => $inc_url,'comment_num' => $comment_num, 'comments' => $comments_data, 'inh_id' => $inh_id);
            $this->load->view('comment',$data);
        }
    }
    public function main()
    {   
        $this->form_validation->set_rules('comment', '评论内容', 'required|trim');
        $this->form_validation->set_rules('comment_type', '评论类型', 'required|numeric|trim');
        $this->form_validation->set_rules('comment_cc_id', '传记ID', 'required|numeric|trim');
        $this->form_validation->set_rules('comment_father_id', '上节点', 'required|numeric|trim');
        if($this->form_validation->run() === FALSE)
        {   
            //如果数据有错则报错

            echo "请重新评论";exit();
        }
        else
        {   
            $type = intval($this->input->post('comment_type'));
            $cc_id = intval($this->input->post('comment_cc_id'));
            $user_id = $_SESSION['uid'];
            $user_info =  $this->user_model->select_info('cc_user', 'nickname,mobile', array('id' => $user_id));
            $user_name = $user_info['nickname'];
            $content = $this->input->post('comment');
            $time = time();
            $user_ip = ($_SERVER["HTTP_VIA"]) ? $_SERVER["HTTP_X_FORWARDED_FOR"] : $_SERVER["REMOTE_ADDR"]; 
            $user_ip = ($user_ip) ? $user_ip : $_SERVER["REMOTE_ADDR"];
            $user_phone = $user_info['mobile'];

            if($type=='1'){
                $comment_id = intval($this->input->post('comment_father_id'));
                $cc_user_id = $this->user_model->select_info('cc_comment', 'user_id', array('id' => $comment_id));
            }else{
                $comment_id = '0';
                $cc_user_id = $this->user_model->select_info('cc_inherit', 'user_id', array('id' => $cc_id));
            }

            $comment_data = array('type' => $type, 'cc_id' => $cc_id, 'cc_user_id' => $cc_user_id, 'user_id' => $user_id, 'user_name' => $user_name, 'content' => $content, 'time' => $time, 'user_ip' => $user_ip, 'user_phone' => $user_phone, 'comment_id' => $comment_id);
            $com_id = $this->user_model->insert_cc_comment($comment_data);
            if($com_id){
                echo '评论成功';
                redirect('comment?inh_id='.$cc_id);
            }
        }

    }
}
?>