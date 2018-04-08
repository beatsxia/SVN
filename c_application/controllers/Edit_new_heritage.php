<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Edit_new_heritage extends CI_Controller {
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
        //获取图片空间url
        $inc_url = $this->user_model->get_picture_space_info('url');

        
        $inh_id = intval($this->input->get('inh_id'));
        $data = array('inc_url' => $inc_url);
        if($inh_id>'0'){
            $inherit_contents = $this->user_model->get_inherit_contents_title($this->db->escape_str($inh_id));
            $inherit = $this->user_model->select_info('cc_inherit', '*', array('id' => $inh_id));
            $data = array('inc_url' => $inc_url,'inherit' => $inherit , 'inherit_contents' => $inherit_contents);
        }
		$this->load->view('edit_new_heritage',$data);
    }

    public function add()
    {
        if($this->input->post('inherit_id')=='0'){
            $this->form_validation->set_rules('heritage_title', '传记标题', 'required|trim');
        }
        if(!empty($this->input->post('heritage_num'))){
            $this->form_validation->set_rules('heritage_num', '章节', 'required|trim');
        }
        $this->form_validation->set_rules('heritage_section_title', '章节标题', 'required|trim');
        $this->form_validation->set_rules('arr_count', '章节数', 'required|numeric|trim');
        if(count($this->input->post())>22){
            echo '输入章节太多';exit();
        }
        if($this->form_validation->run() === FALSE)
        {   
            $this->form_validation->set_message('heritage_title', '{field} 不能为空');
            $this->form_validation->set_message('heritage_num', '{field} 不能为空');
            $this->form_validation->set_message('heritage_section_title', '{field} 不能为空');
            $this->form_validation->set_rules('arr_count', '{field} 必须为数字');
            //如果数据有错则报错
            echo "标题错误";exit();
        }
        else
        {   
            $uid = $_SESSION['uid'];
            //接收提交的信息
            $heritage_title = $this->input->post('heritage_title', TRUE);
            $heritage_num = !empty($this->input->post('heritage_num'))?$this->input->post('heritage_num', TRUE):'';
            $heritage_section_title = $this->input->post('heritage_section_title', TRUE);
            $arr_count = $this->input->post('arr_count', TRUE);
            $inherit_id = '';
            $nowtime = time();
            //如果有inh_id
            if(intval($this->input->post('inherit_id'))>'0'){
                //查询用户是否有添加传记的权限
                $power_id = $this->user_model->select_info('cc_inherit_power','id',array('inh_id' => $this->db->escape_str($this->input->post('inherit_id')), 'user_id' => $uid));
                if(!empty($power_id)){
                    $inherit_id = $this->input->post('inherit_id');
                    $inh_user_id = $this->user_model->select_info('cc_inherit', 'user_id', array('id' => $inherit_id));
                    //sort排名
                    $sorts = $this->user_model->select_info('cc_inherit_content', 'max(sort)', array('inh_id' => $inherit_id));
                    $sort = intval($sorts)+1;
                    //inherit_content表内容
                    $content_date =array('inh_id' => $inherit_id ,'inh_user_id' => $uid, 'user_id' => $uid, 'con_title' => $this->db->escape_str($heritage_section_title),'con_num' =>  $this->db->escape_str($heritage_num), 'sort' => $sort, 'creation_time' => $nowtime, 'last_time' => $nowtime, 'content' => '');
                    $this->user_model->insert_inherit_content($content_date);
                    if($arr_count > 1){
                        for ($i=2; $i <= $arr_count; $i++) {
                            $con_num = $this->input->post('heritage_num'.$i,true);
                            $con_title = $this->input->post('heritage_section_title'.$i,true);
                            if(!preg_match("/[\'.,:;*?~`!@#$%^&+=)(<>{}]|\]|\[|\/|\\\|\"|\|/",$con_num)&&!empty($con_num)){
                                if(!preg_match("/[\'.,:;*?~`!@#$%^&+=)(<>{}]|\]|\[|\/|\\\|\"|\|/",$con_title)&&!empty($con_title)){
                                    $sorts = $this->user_model->select_info('cc_inherit_content', 'max(sort)', array('inh_id' => $inherit_id));
                                    $sort = intval($sorts)+1;
                                    $content_date = array('inh_id' => $inherit_id ,'inh_user_id' => $uid, 'user_id' => $uid, 'con_title' => $this->db->escape_str($con_title),'con_num' => $this->db->escape_str($con_num), 'sort' => $sort, 'creation_time' => $nowtime, 'last_time' => $nowtime, 'content' => '');
                                    $this->user_model->insert_inherit_content($content_date);
                                }
                            }
                        }
                    }
                    redirect('root_new_set?inh_id='.$inherit_id);
                }else{
                    echo "没有编辑权限";exit();
                }

            }else{
                $date = array('user_id' => $uid,'title' => $this->db->escape_str($heritage_title),'add_time' => $nowtime,'is_open' => '0','last_time' => $nowtime);
                $inherit_id = $this->user_model->insert_inherit($date);
                if(!empty($inherit_id)){
                    $content_date = array('inh_id' => $inherit_id ,'inh_user_id' => $uid, 'user_id' => $uid, 'con_title' => $this->db->escape_str($heritage_section_title),'con_num' =>  $this->db->escape_str($heritage_num), 'sort' => '1', 'creation_time' => $nowtime, 'last_time' => $nowtime, 'content' => '');
                    $this->user_model->insert_inherit_content($content_date);
                    if($arr_count > 1){
                        for ($i=2; $i <= $arr_count; $i++) {
                            $con_num = $this->input->post('heritage_num'.$i,true);
                            $con_title = $this->input->post('heritage_section_title'.$i,true);
                            if(!preg_match("/[\'.,:;*?~`!@#$%^&+=)(<>{}]|\]|\[|\/|\\\|\"|\|/",$con_num)&&!empty($con_num)){
                                if(!preg_match("/[\'.,:;*?~`!@#$%^&+=)(<>{}]|\]|\[|\/|\\\|\"|\|/",$con_title)&&!empty($con_title)){
                                    $content_date = array('inh_id' => $inherit_id ,'inh_user_id' => $uid, 'user_id' => $uid, 'con_title' => $this->db->escape_str($con_title),'con_num' => $this->db->escape_str($con_num), 'sort' => $i, 'creation_time' => $nowtime, 'last_time' => $nowtime, 'content' => '');
                                    $this->user_model->insert_inherit_content($content_date);
                                }
                            }
                        }
                    }
                    //查询权限表是否已经存在记录
                    $power_id = $this->user_model->select_info('cc_inherit_power', 'id', array('inh_id' => $inherit_id, 'user_id' => $uid));
                    if(empty($power_id)){
                        $power_date = array('inh_id' => $inherit_id, 'user_id' => $uid, 'power_form' => '创建人', 'add_time' => $nowtime);
                        //插入传记权限信息
                        if($this->user_model->insert_inherit_power($power_date)){
                            //创建成功。跳转
                            redirect('root_new_set?inh_id='.$inherit_id);
                        }
                    }
                }else{
                    $this->form_validation->error_string = '创建传记失败';
                    echo '创建传记失败';exit();
                }
            }

        }
    }
    
}
?>