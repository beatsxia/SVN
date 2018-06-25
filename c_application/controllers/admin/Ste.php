<?php

class Ste extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        if(empty($_SESSION['admin_id'])){
            redirect('admin/login');exit();
        }
        $this->load->helper(array('form', 'url'));
        //引入模块文件
        $this->load->model('admin_model');
        $this->load->library('form_validation');
    }
     public function index()
    {	
      	$this->load->view('admin/ste');
    }


    public function get_stes()
    {
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
        $offset = ($page-1)*$rows;
        $result = array();
        
        $rs = $this->db->query("select count(*) from ci_cc_stele");
        $row = $rs->row_array();
       
        $result["total"] = $row['count(*)'];
        $rs = $this->db->query("select ci_cc_stele.id,ci_cc_user.nickname,ci_cc_stele.title,ci_cc_stele.sex,ci_cc_stele.my_words,ci_cc_stele.synopsis,ci_cc_stele.birthday_time,ci_cc_stele.death_time,ci_cc_stele.inh_id,ci_cc_stele.picture,ci_cc_stele.style,ci_cc_stele.add_time,ci_cc_stele.is_ste_open from ci_cc_stele left join ci_cc_user on ci_cc_stele.user_id = ci_cc_user.id limit $offset,$rows");
        
        $items = $rs->result_array();
        $result["rows"] = $items;

        echo json_encode($result);
    }
	
     public function edit_ste()
    {
        $id = intval($_REQUEST['id']);
        $title = $_REQUEST['title'];
        $synopsis = $_REQUEST['synopsis'];
        $picture = $_REQUEST['picture'];
        $sex = $_REQUEST['sex'];
        $is_ste_open = $_REQUEST['is_ste_open'];

        $result = $this->db->update('cc_stele', array('title' => $title, 'synopsis' => $synopsis, 'picture' => $picture, 'sex' => $sex, 'is_ste_open' => $is_ste_open), array('id' => $id));
        if ($result){
            echo json_encode(array('success'=>true));
        } else {
            echo json_encode(array('msg'=>'修改失败'));
        }
    }
	

}
?>