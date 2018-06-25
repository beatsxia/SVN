<?php

class Show extends CI_Controller {
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
      	$this->load->view('admin/show');
    }

    public function get_users()
    {
    	$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
        $offset = ($page-1)*$rows;
        $result = array();
        
        $rs = $this->db->query("select count(*) from ci_cc_user");
        $row = $rs->row_array();
       
        $result["total"] = $row['count(*)'];
        $rs = $this->db->query("select * from ci_cc_user limit $offset,$rows");
        
        $items = $rs->result_array();
        $result["rows"] = $items;

        echo json_encode($result);

    }

    public function edit_user()
    {
        $id = intval($_REQUEST['id']);
        $gender = $_REQUEST['gender'];

        $result = $this->db->update('cc_user', array('gender' => $gender), array('id' => $id));
        if ($result){
            echo json_encode(array('success'=>true));
        } else {
            echo json_encode(array('msg'=>'Some errors occured.'));
        }
    }

}
?>