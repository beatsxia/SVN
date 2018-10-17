<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Service extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        //引入模块文件 user_model.php
        $this->load->model('user_model');
        $this->load->library('form_validation');
        if(empty($_SESSION['uid'])){
            redirect('WechatOauthLogin');exit();
        }
    }

    public function index()
    {
        
    }

    /**
     * 收藏的处理函数(收藏)
     * @param $type 用户id 
     * @return  echo json_encode(array('code' => '1','hint' => '修改成功','return' => $array)); // return :需要返回的数组
     */
    public function main($type)
    {   

        switch ($type) {
            case 'inh_collection'://收藏和取消收藏
                $inh_id = trim($this->input->post('inh_id',true));
                    //if(!preg_match("/[\'.,:;*?~`!@#$%^&+=)(<>{}]|\]|\[|\/|\\\|\"|\|/",$content)&&!empty($content)){
                    if (isset($inh_id)&&is_numeric($inh_id)&&!strpos($inh_id, '.')&&$inh_id!='0') {
                        $page_id = intval($inh_id);
                        $type = 'inherit';
                        //查询是否已经收藏
                        $collect_id = $this->user_model->select_info('cc_collection', 'id', array('type' => $type, 'page_id' => $page_id, 'user_id' => $_SESSION['uid']));
                        if(empty($collect_id)){//没被收藏
                            $page_url = 'root_new_set?inh_id='.$page_id;
                            $user_id = $_SESSION['uid'];
                            $collection_time = time();
                            $note = '收藏传记';
                            $data = array('type' => $type, 'page_url' => $page_url, 'page_id' => $page_id, 'user_id' => $user_id, 'collection_time' => $collection_time, 'note' => $note);
                            if($this->db->insert('cc_collection', $data)){
                                $return_array = array('code' => '1','hint' => '收藏成功','return' => array('img' => 'collect2.png'));
                            }else{
                                $return_array = array('code' => '0','hint' => '收藏失败','return' => array());
                            }
                        }else{//取消收藏
                            if($this->db->delete('cc_collection', array('id' => $collect_id))){
                                $return_array = array('code' => '1','hint' => '取消收藏成功','return' => array('img' => 'collect.png'));
                            }else{
                                $return_array = array('code' => '0','hint' => '取消收藏失败','return' => array());
                            }
                        }
                    }else{
                        $return_array = array('code' => '0','hint' => '没有传记ID','return' => array());
                    }
                    header('Content-Type:application/json; charset=utf-8');
                    echo json_encode($return_array);
                    //}
                break;
            
            
            default:
                header('Content-Type:application/json; charset=utf-8');
                echo json_encode(array('code' => '0','hint' => '操作失败','return' => array()));
                break;
        }
        exit();
    }


}
?>