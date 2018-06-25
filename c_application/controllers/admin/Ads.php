<?php

class Ads extends CI_Controller {
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
      	$this->load->view('admin/ads');
    }


    public function get_ads()
    {
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
        $offset = ($page-1)*$rows;
        $result = array();
        
        $rs = $this->db->query("select count(*) from ci_cc_rolling_content");
        $row = $rs->row_array();
       
        $result["total"] = $row['count(*)'];
        $rs = $this->db->query("select * from ci_cc_rolling_content where is_delete = 0 ORDER BY add_time DESC limit $offset,$rows");

        
        $items = $rs->result_array();
        $result["rows"] = $items;

        echo json_encode($result);
    }
	
     public function edit_ads()
    {
        $id = intval($_REQUEST['id']);
        $inh_id = $_REQUEST['inh_id'];
        $title = $_REQUEST['title'];
        $describe = $_REQUEST['describe'];
        $picture = $_REQUEST['picture'];
        $sort = $_REQUEST['sort'];
        $link = $_REQUEST['link'];
        $alt = $_REQUEST['alt'];

        $result = $this->db->update('cc_rolling_content', array('inh_id' => $inh_id, 'title' => $title, 'describe' => $describe, 'picture' => $picture, 'sort' => $sort, 'link' => $link, 'alt' => $alt), array('id' => $id));
        if ($result){
            echo json_encode(array('success'=>true));
        } else {
            echo json_encode(array('msg'=>'修改失败'));
        }
    }

     public function del_ads()
    {
        $id = intval($_REQUEST['id']);
        //$_SERVER["REMOTE_ADDR"]
        $result = $this->db->update('cc_rolling_content', array('is_delete' => '1', 'delete_time' => time(), 'delete_ip' => $_SERVER["REMOTE_ADDR"], 'delete_id' => $_SESSION['admin_id']), array('id' => $id));
        if ($result){
            echo json_encode(array('success'=>true));
        } else {
            echo json_encode(array('msg'=>'修改失败'));
        }
    }

     public function ins_ads()
    {
        $inh_id = $_REQUEST['inh_id'];
        $title = $_REQUEST['title'];
        $describe = $_REQUEST['describe'];
        $picture = $_REQUEST['picture'];
        $sort = $_REQUEST['sort'];
        $link = $_REQUEST['link'];
        $alt = $_REQUEST['alt'];
        $data = array('inh_id' => $inh_id, 'title' => $title, 'describe' => $describe, 'picture' => $picture, 'sort' => $sort, 'link' => $link, 'alt' => $alt, 'add_user_id' => $_SESSION['admin_id'], 'add_time' => time(), 'add_ip' => $_SERVER["REMOTE_ADDR"]);
        
        if ($this->db->insert('cc_rolling_content', $data)){
            echo json_encode(array('success'=>true));
        } else {
            echo json_encode(array('msg'=>'Some errors occured.'));
        }
    }
	

}
?>