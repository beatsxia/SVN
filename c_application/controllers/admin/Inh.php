<?php

class Inh extends CI_Controller {
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
      	$this->load->view('admin/inh');
    }


    public function get_inhs()
    {
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
        $offset = ($page-1)*$rows;
        $result = array();
        
        $rs = $this->db->query("select count(*) from ci_cc_inherit");
        $row = $rs->row_array();
       
        $result["total"] = $row['count(*)'];
        $rs = $this->db->query("select ci_cc_inherit.id,ci_cc_user.nickname,ci_cc_inherit.title,ci_cc_inherit.synopsis,ci_cc_inherit.picture,ci_cc_inherit.add_time,ci_cc_inherit.is_open,ci_cc_inherit.stele_id from ci_cc_inherit left join ci_cc_user on ci_cc_inherit.user_id = ci_cc_user.id limit $offset,$rows");
        
        $items = $rs->result_array();
        $result["rows"] = $items;

        echo json_encode($result);
    }
	
     public function edit_inh()
    {
        $id = intval($_REQUEST['id']);
        $title = $_REQUEST['title'];
        $synopsis = $_REQUEST['synopsis'];
        $picture = $_REQUEST['picture'];
        $is_open = $_REQUEST['is_open'];

        $result = $this->db->update('cc_inherit', array('title' => $title, 'synopsis' => $synopsis, 'picture' => $picture, 'is_open' => $is_open), array('id' => $id));
        if ($result){
            echo json_encode(array('success'=>true));
        } else {
            echo json_encode(array('msg'=>'修改失败'));
        }
    }
	

}
?>