<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Init extends CI_Controller {
    
     public function index()
    {	
    	if(empty($_SESSION['uid'])){
    		redirect('WechatOauthLogin');exit();
    	}
        $this->load->library('form_validation');
        //引入模块文件 user_model.php
        $this->load->model('user_model');
    	
    }
     public function getUserInfo($value='')
     {
     	if(empty($_SESSION['uid'])){
    		redirect('WechatOauthLogin');exit();
    	}
    	$uid = $_SESSION['uid'];
    	
        //$query = $this->db->query('SELECT * FROM  'ci_cc_picture_space' ');
        //$list = $query->num_rows();

        //头像 昵称 个性签名
        $this->db->select('avatar,nickname,personality_note');
        $this->db->where('id', $uid);
        $query  = $this->db->get('cc_user');
        $data = $query ->row_array();
        $avatar = $data['avatar'];//头像
        $nickname = $data['nickname'];//昵称
        $personality_note = $data['personality_note'];//个性签名

        //传记总数量（包括我发布的和我参与的）
        $this->db->select('id');
        $this->db->where('user_id', $uid);
        $query  = $this->db->get('cc_inherit');
        $inherit_num = $query ->num_rows();//我发布的传记数
        if($inherit_num == 0){
            $inherit_id_arr = '';
        }elseif ($inherit_num == 1) {
            $inherit_id_arr =  $query ->row_array();
        }elseif ($inherit_num > 1) {
            $inherit_id =  $query ->result_array();
            $inherit_id_arr = array();
            foreach ($inherit_id as $key => $value) {
                $inherit_id_arr[] = $value['id']; 
            }
        }
        $this->db->select('inh_id');
        $this->db->where('inh_user_id != ', $uid);
        $this->db->where('user_id', $uid);
        $query  = $this->db->get('cc_inherit_content');
        $inherit_content_num = $query ->result_array();//求我参与的传记数组
        $inherit_content_id_arr = array();
        if(!empty($inherit_content_num)){
            foreach ($inherit_content_num as $key => $value) {
                $inherit_content_id_arr[] = $value['inh_id'];
            }
            $inherit_content_id_arr = array_unique($inherit_content_id_arr);//我参与的传记ID
            
            $inh_content_num = count($inherit_content_id_arr);//我参与的传记数
        }else{
            $inh_content_num = 0;//我参与的传记数
        }
        $total_inh_num = $inherit_num + $inh_content_num;//传记总数量
        
        //用户自己创建的传记的访问人次
        $this->db->where_in('access_page',$inherit_id_arr);
        $this->db->where('type','inherit');
        $query  = $this->db->get('cc_access_log');
        $access_log_num = $query ->num_rows();//访问次数

        //关注人数
        $this->db->where('user_id',$uid);
        $this->db->where('cancel','0');
        $query  = $this->db->get('cc_fans');
        $user_follow_num = $query ->num_rows();//关注人数

        //粉丝人数
        $this->db->where('follower_id',$uid);
        $this->db->where('cancel','0');
        $query  = $this->db->get('cc_fans');
        $user_fans_num = $query ->num_rows();//粉丝人数

        //用户回复数量
        $this->db->where('cc_user_id',$uid);
        $this->db->where('is_deleted','0');
        $this->db->where('is_read','0');
        $query  = $this->db->get('cc_comment');
        $comment_num = $query ->num_rows();//回复人数

        $info_data =  array('avatar' => $avatar, 'nickname' => $nickname, 'personality_note' => $personality_note, 'total_inh_num' => $total_inh_num, 'access_log_num' => $access_log_num, 'user_follow_num' => $user_follow_num, 'user_fans_num' => $user_fans_num, 'comment_num' => $comment_num);
        echo json_encode($info_data);
     }


     public function getUserComment()
     {
        if(empty($_SESSION['uid'])){
            redirect('WechatOauthLogin');exit();
        }
        $uid = $_SESSION['uid'];

        //获取前十条回复
        $this->db->select('cc_comment.user_id,cc_comment.cc_id,cc_comment.user_name,cc_comment.content,cc_user.avatar,cc_inherit.title,cc_inherit.thumbnail');
        $this->db->from('cc_comment');
        $this->db->join('cc_user', 'cc_user.id = cc_comment.user_id','left');
        $this->db->join('cc_inherit', 'cc_inherit.id = cc_comment.cc_id','left');
        $this->db->where('is_deleted','0');
        $this->db->where('cc_user_id',$uid);
        $this->db->order_by('time', 'DESC');
        $this->db->limit(10);
        $query = $this->db->get();
        $comment_data = $query -> result_array();
        echo json_encode($comment_data);
     }
     public function getUserCommentPage()
     {  
        if(empty($_SESSION['uid'])){
            redirect('WechatOauthLogin');exit();
        }
        if($this->input->post('page')){
            sleep(1);
            if ( is_int($this->input->post('page')) && $this->input->post('page') > 0) {
                $page = $this->input->post('page');
            }else{
                $page = 1;
            }
            $uid = $_SESSION['uid'];
            $limit = 10;
            $offset = ($page - 1) * 10;
            //获取更多信息
            $this->db->select('cc_comment.user_id,cc_comment.cc_id,cc_comment.user_name,cc_comment.content,cc_user.avatar,cc_inherit.title,cc_inherit.thumbnail');
            $this->db->from('cc_comment');
            $this->db->join('cc_user', 'cc_user.id = cc_comment.user_id','left');
            $this->db->join('cc_inherit', 'cc_inherit.id = cc_comment.cc_id','left');
            $this->db->where('is_deleted','0');
            $this->db->where('cc_user_id',$uid);
            $this->db->order_by('time', 'DESC');
            $this->db->limit($limit, $offset);
            $query = $this->db->get();
            $comment_data = $query -> result_array();
            echo json_encode($comment_data);
        }
    }
    public function getUserCommentPage2()
    {  
        if(empty($_SESSION['uid'])){
            redirect('WechatOauthLogin');exit();
        }
        $comment_data = array();
        if($this->input->post()){
            $page = intval($this->input->post('page'));
            $uid = $_SESSION['uid'];
            if(is_int($page) && $page > 0){
                $limit = 10;
                $offset = ($page - 1) * 10;
                //获取更多信息
                $this->db->select('cc_comment.user_id,cc_comment.cc_id,cc_comment.user_name,cc_comment.content,cc_user.avatar,cc_comment.time,cc_inherit.title,cc_inherit.thumbnail');
                $this->db->from('cc_comment');
                $this->db->join('cc_user', 'cc_user.id = cc_comment.user_id','left');
                $this->db->join('cc_inherit', 'cc_inherit.id = cc_comment.cc_id','left');
                $this->db->where('is_deleted','0');
                $this->db->where('cc_user_id',$uid);
                $this->db->order_by('cc_comment.is_read', 'ASC');
                $this->db->order_by('cc_comment.time', 'DESC');
                $this->db->limit($limit, $offset);
                $query = $this->db->get();
                $comment_data = $query -> result_array();
            }
        }
        echo json_encode($comment_data);
    }
    //关注
    public function follow()
    {
        if(empty($_SESSION['uid'])){
            redirect('WechatOauthLogin');exit();
        }
        if($this->input->post()){
            $uid = $_SESSION['uid'];

            if (!empty($this->input->post('user_id'))&&is_numeric($this->input->post('user_id'))) {
                $user_id = $this->input->post('user_id',true);
                $data = array('user_id' => $uid, 'follower_id' => $this->db->escape_str($user_id), 'follow_time' => time());

                $this->db->select('id,cancel');
                $this->db->from('cc_fans');
                $this->db->where('user_id',$uid);
                $this->db->where('follower_id',$this->db->escape_str($user_id));
                $query = $this->db->get();
                $row_array = $query -> row_array();
                if(empty($row_array)){
                    if($this->db->insert('cc_fans', $data)){
                        echo '1';//关注成功
                    }else{
                        echo '0';//关注失败
                    }
                }else{
                    if($row_array['cancel']=='0'){//已经关注
                        $data = array('cancel' => '1');
                        $where = array('id' => $row_array['id']);
                        if($this->db->update('cc_fans',$data,$where)){
                            echo '2';//取消关注成功
                        }
                    }elseif($row_array['cancel']=='1'){//之前关注，但是又取消关注
                        $data = array('cancel' => '0');
                        $where = array('id' => $row_array['id']);
                        if($this->db->update('cc_fans',$data,$where)){
                            echo '1';//关注成功
                        }
                    }else{//操作失败
                        echo '0';//操作失败
                    }
                }
            }
        }
    }
    //more页面上拉获取更多信息
    public function getMorePage()
    {   
        $this->load->model('user_model');
        if(empty($_SESSION['uid'])){
            redirect('WechatOauthLogin');exit();
        }
        if($this->input->post('page')){
            sleep(1);
            $uid = $_SESSION['uid'];
            $page = intval($this->input->post('page'));
            if ( is_int($page) && $page > 0) {
                $page = $page;
            }else{
                $page = 1;
            }
            $limit = 10;
            $offset = ($page - 1) * 10;
            $this->db->select('cc_inherit.id,cc_inherit.thumbnail,cc_inherit.picture,cc_inherit.title,cc_inherit.synopsis,cc_inherit.add_time,cc_inherit.user_id,cc_user.nickname,cc_user.avatar');
            $this->db->from('cc_inherit');
            $this->db->join('cc_user', 'cc_user.id = cc_inherit.user_id','left');
            $this->db->where('cc_inherit.is_open','1');
            $this->db->order_by('cc_inherit.add_time', 'DESC');
            $this->db->limit($limit, $offset);
            $query = $this->db->get();
            $inherit = $query -> result_array();
            $inherit_arr = array();
            foreach ($inherit as $key => $value) {
                $is_follow = $comment_num = $pic1 = $pic2 = '';
                $is_follow = $this->user_model->get_is_follow($uid,$value['user_id']);
                $comment_num = $this->user_model->get_comment_num($value['id']);
                if(empty($value['thumbnail'])&&empty($value['picture'])){
                    $inh_content = $this->user_model->get_inherit_contents_str($value['id']);
                    if(preg_match_all("/src=\"(.*?)\"/s",$inh_content,$matche)){
                        //$picture = $matche['1'];
                        if(count($matche['1'])>0){
                            if(count($matche['1'])>1){
                                $pic1 = $matche['1']['0'];
                                $pic2 = $matche['1']['1'];
                            }else{
                                $pic1 = $matche['1']['0'];
                                $pic2 = '';
                            }
                        }else{
                            $pic1 = $pic2 ='';
                        }
                    }else{
                        $pic1 = $pic2 ='';
                    }
                }else{
                    $pic1 = !empty($value['thumbnail']) ? $value['thumbnail'] : $value['picture'];
                    $pic2 = '';
                }
                $value['is_follow'] = $is_follow;
                $value['comment_num'] = $comment_num;
                $value['pic1'] = $pic1;
                $value['pic2'] = $pic2;

                $inherit_arr[] = $value;
            }
            echo json_encode($inherit_arr);
        }
    }

    //mine_info页面用户传记
    public function getUserInheritPage()
    {   
        $this->load->model('user_model');
        if(empty($_SESSION['uid'])){
            redirect('WechatOauthLogin');exit();
        }
        if($this->input->post('page')){
            $uid = $_SESSION['uid'];
            $page = intval($this->input->post('page'));
            if ( is_int($page) && $page > 0) {
                $page = $page;
            }else{
                $page = 1;
            }
            $limit = 10;
            $offset = ($page - 1) * 10;
            $this->db->select('id,thumbnail,picture,title,synopsis,add_time');
            $this->db->from('cc_inherit');
            $this->db->where('user_id',$uid);
            $this->db->order_by('add_time', 'DESC');
            $this->db->limit($limit, $offset);
            $query = $this->db->get();
            $inherit = $query -> result_array();

            $inherit_arr = array();
            foreach ($inherit as $key => $value) {
                $pic1 = $inh_content = $inh_stage = '';
                if(empty($value['thumbnail'])&&empty($value['picture'])){
                    $inh_content = $this->user_model->get_inherit_contents_str($value['id']);
                    if(preg_match("/src=\"(.*?)\"/s",$inh_content,$matche)){
                        $pic1 = $matche['1'];
                    }else{
                        $pic1 = '';
                    }
                    $inh_content = htmlspecialchars_decode($inh_content);//把一些预定义的 HTML 实体转换为字符
                    $inh_content = str_replace("&nbsp;","",$inh_content);//将空格替换成空
                    $inh_content = strip_tags($inh_content);//函数剥去字符串中的 HTML、XML 以及 PHP 的标签,获取纯文本内容
                    $inh_stage = mb_substr($inh_content, 0, 60,"utf-8");//返回字符串中的前100字符串长度的字符

                }else{
                    if(empty($value['synopsis'])){
                        $inh_content = $this->user_model->get_inherit_contents_str($value['id']);
                        $inh_content = htmlspecialchars_decode($inh_content);//把一些预定义的 HTML 实体转换为字符
                        $inh_content = str_replace("&nbsp;","",$inh_content);//将空格替换成空
                        $inh_content = strip_tags($inh_content);//函数剥去字符串中的 HTML、XML 以及 PHP 的标签,获取纯文本内容
                        $inh_stage = mb_substr($inh_content, 0, 60,"utf-8");//返回字符串中的前100字符串长度的字符
                    }
                    $pic1 = !empty($value['thumbnail']) ? $value['thumbnail'] : $value['picture'];
                }

                $value['pic1'] = $pic1;
                $value['inh_stage'] = $inh_stage;
                $inherit_arr[] = $value;
            }
            header('Content-Type:application/json; charset=utf-8');
            echo json_encode($inherit_arr,JSON_UNESCAPED_UNICODE);

        }

    }

    //下拉获取用户传承碑  my_inher_monument页面
    public function getMyMonument()
    {
        $this->load->model('user_model');
        if(empty($_SESSION['uid'])){
            redirect('WechatOauthLogin');exit();
        }
        if($this->input->post('page')){
            $uid = $_SESSION['uid'];
            $page = intval($this->input->post('page'));
            if(is_int($page)){
                $result_data = $this->user_model->get_my_stele_list($page,$uid,10);
            }else{
                $result_data = array();
            }
            
            header('Content-Type:application/json; charset=utf-8');
            echo json_encode($result_data,JSON_UNESCAPED_UNICODE);

        }   
    }

    public function quit()
    {
        $this->session->sess_destroy();
        redirect('homepage');
    }


    //new_heritage页面下拉获取用户传记
    public function inh_select()
    {   
        $this->load->model('user_model');
        if($_SESSION['uid']){
            $result = $this->user_model->get_user_inh($_SESSION['uid']);
            echo json_encode($result);
        }
    }

    //cloud页面 获取榜单
    public function cloud_top_10($stele_id='')
    {
        if($_SESSION['uid']){
            $this->load->model('user_model');
            $stele_id = trim($this->input->post('stele_id'));
            if (isset($stele_id)&&is_numeric($stele_id)&&!strpos($stele_id, '.')&&$stele_id!='0') {
                $top_10 = $this->user_model->stele_give_top_10($stele_id);
                echo json_encode($top_10);
            }
        }
    }

    //cloud页面 滚动条获取最新的3条赠送记录
    public function cloud_give_list_3($stele_id='')
    {
        if($_SESSION['uid']){
            $this->load->model('user_model');
            $stele_id = trim($this->input->post('stele_id'));
            if (isset($stele_id)&&is_numeric($stele_id)&&!strpos($stele_id, '.')&&$stele_id!='0') {
                //滚动条 获取最新的3条赠送记录
                $give_list_3 = $this->user_model->get_stele_give_new_3($stele_id);
                $give_list_3_arr = array();
                foreach ($give_list_3 as $key => $value) {
                    $give_list_3_arr[] = $value['nickname'].$value['gift_action'].$value['gift_count'].$value['gift_unit'].$value['name'].'&nbsp;&nbsp;';
                }
                echo json_encode($give_list_3_arr);
            }
            
        }
    }

    //cloud页面 获取动态
    public function cloud_give_list($stele_id='')
    {
        if($_SESSION['uid']){
            $this->load->model('user_model');
            $stele_id = trim($this->input->post('stele_id'));
            if (isset($stele_id)&&is_numeric($stele_id)&&!strpos($stele_id, '.')&&$stele_id!='0') {
                //获取该传承碑动态
                $give_list = $this->user_model->get_stele_give_by_ste($stele_id,'1');
                echo json_encode($give_list);
            }
        }
    }

    //cloud页面 获取动态
    public function cloud_free_time($stele_id='')
    {
        if($_SESSION['uid']){
            $this->load->model('user_model');
            $stele_id = trim($this->input->post('stele_id'));
            if (isset($stele_id)&&is_numeric($stele_id)&&!strpos($stele_id, '.')&&$stele_id!='0') {
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
                echo $is_free_good;
            }
        }
    }

    //msg_alb页面 用户点赞  
    public function note_star($note_id='')
    {
        if($_SESSION['uid']){
            $this->load->model('user_model');
            $note_id = trim($this->input->post('note_id'));
            if (isset($note_id)&&is_numeric($note_id)&&!strpos($note_id, '.')&&$note_id!='0') {
                $note_id = intval($note_id);
                $zan_num = $this->user_model->get_is_my_zan($_SESSION['uid'],$note_id);
                if($zan_num == '1'){//已经点赞
                    if($this->user_model->update_info('cc_note_zan', array('is_true' => '0'), array('note_id' => $note_id, 'user_id' => $_SESSION['uid']))){//取消点赞
                        echo '2';//取消点赞
                    }else{
                        echo '0';
                    }
                }elseif($zan_num == '-1'){//已经踩或者点赞
                    if($this->user_model->update_info('cc_note_zan', array('zan' => '1', 'is_true' => '1'), array('note_id' => $note_id, 'user_id' => $_SESSION['uid']))){//点赞
                        echo '1';//点赞成功
                    }else{
                        echo '0';
                    }
                }else{//没有点赞
                    $data = array('note_id' => $note_id, 'user_id' => $_SESSION['uid'], 'zan' => '1', 'time' => time(), 'is_true' => '1');
                    $note_zan_id = $this->user_model->insert_note_zan($data);//点赞成功
                    if($note_zan_id){
                        echo '1';//点赞成功
                    }else{
                        echo '0';
                    }
                }
            }
        }
    }


    //删除
    public function delete_info()
    {   
        if($_SESSION['uid']){
            $type = trim($this->input->post('type'));
            $value = trim($this->input->post('value'));
            if (isset($value)&&is_numeric($value)&&!strpos($value, '.')&&$value!='0') {
                $value = intval($value);
                switch ($type) {
                    //msg_alb页面  删除留言
                    case 'note':
                        $this->load->library('CI_Decide');
                        $power = $this->ci_decide->decide_note($_SESSION['uid'],$value);
                        if($power == '1'){
                            if($this->db->delete('cc_note', array('id' => $value))){
                                $this->db->delete('cc_note_zan', array('note_id' => $value));
                                echo json_encode(array('code' => '1','hint' => '删除成功'));//删除成功
                            }else{
                                echo json_encode(array('code' => '0','hint' => '删除失败'));//删除失败
                            }
                        }else{
                            echo json_encode(array('code' => '0','hint' => '删除失败'));//删除失败
                        }
                        break;
                    //mine_info页面  删除传记
                    case 'inherit':
                        $this->load->library('CI_Decide');
                        $power = $this->ci_decide->decide_inherit($_SESSION['uid'],$value);
                        if($power=='1'){
                            if($this->db->delete('cc_inherit', array('id' => $value))){
                                $this->db->delete('cc_inherit_content', array('inh_id' => $value));
                                echo json_encode(array('code' => '1','hint' => '删除成功'));//删除成功
                            }else{
                                echo json_encode(array('code' => '0','hint' => '删除失败'));//删除失败
                            }
                            
                        }elseif($power=='2'){
                            if($this->db->delete('cc_inherit_content', array('inh_id' => $value, 'user_id' => $_SESSION['uid']))){
                                echo json_encode(array('code' => '1','hint' => '删除成功'));//删除成功
                            }else{
                                echo json_encode(array('code' => '0','hint' => '删除失败'));//删除失败
                            }
                            
                        }else{
                            echo json_encode(array('code' => '0','hint' => '删除失败'));//删除失败
                        }
                        break;
                    //heritage_monument页面 删除传承碑
                    case 'stele':
                        $this->load->library('CI_Decide');
                        $power = $this->ci_decide->decide_stele($_SESSION['uid'],$value);
                        if($power=='1'){
                            if($this->db->delete('cc_stele', array('id' => $value))){
                                echo json_encode(array('code' => '1','hint' => '删除成功'));//删除成功
                            }else{
                                echo json_encode(array('code' => '0','hint' => '删除失败'));//删除失败
                            }
                            
                        }elseif($power=='2'){
                            if($this->db->delete('cc_stele_connect', array('user_id' => $_SESSION['uid'], 'stele_id' => $value))){
                                echo json_encode(array('code' => '2','hint' => '退出传承碑成功'));//删除失败（非创建人不能删除）
                            }else{
                                echo json_encode(array('code' => '0','hint' => '退出传承碑失败'));//删除失败
                            }
                            
                        }else{
                            echo json_encode(array('code' => '0','hint' => '删除失败'));//删除失败
                        }
                        break;

                    //edit_new_heritage 页面删除部分传记内容
                    case 'inherit_content':
                        $this->load->library('CI_Decide');
                        $power = $this->ci_decide->decide_inherit_content($_SESSION['uid'],$value);
                        if($power=='1'){
                            if($this->db->delete('cc_inherit_content', array('id' => $value))){
                                echo json_encode(array('code' => '1','hint' => '删除成功'));//删除成功
                            }else{
                                echo json_encode(array('code' => '0','hint' => '已删除请刷新页面'));//删除失败
                            }
                            
                        }elseif($power=='2'){
                            if($this->db->delete('cc_inherit_content', array('id' => $value))){
                                echo json_encode(array('code' => '1','hint' => '删除成功'));//删除成功
                            }else{
                                echo json_encode(array('code' => '0','hint' => '已删除请刷新页面'));//删除失败
                            }
                            
                        }else{
                            echo json_encode(array('code' => '0','hint' => '权限不足'));//删除失败
                        }
                        break;
                            

                    default:
                        echo json_encode(array('code' => '0','hint' => '删除失败'));//删除失败
                        break;
                }
            }else{
                echo json_encode(array('code' => '0','hint' => '删除失败'));//删除失败
            }
        }
        
    }

    //七牛token
    public function qiniu_token()
    {
        //if($_SESSION['uid']){
            //引入模块文件 user_model.php
            $this->load->model('user_model');
            //获取图片空间url
            $img_url = $this->user_model->get_picture_space_info('img_url');
            $accessKey = $this->user_model->get_picture_space_info('accessKey');
            $secretKey = $this->user_model->get_picture_space_info('secretKey');
            $img_name = $this->user_model->get_picture_space_info('img_name');

            //引入上传类库
            require_once('include/qiniu/autoload.php');
            $this->load->helper('qiniu_token');
            $policy = array(
                'callbackUrl' => 'http://owobcs29b.bkt.clouddn.com/',
                'callbackBody' => json_encode(array("state"=>"SUCCESS","url"=>"$(key)")),
                'callbackBodyType' => 'application/json'
            );
            $token = qiniu_token($accessKey,$secretKey,$img_name,$policy);
            echo json_encode(array('token' => $token));
        //}
    }

    //identify页面 修改已有关联传记
    public function identify_update_inh_id($stele='0',$inh_id='0')
    {
        if($_SESSION['uid']){
            //引入模块文件 user_model.php
            $this->load->model('user_model');
            $stele_id = $this->input->post('stele_id',true);
            $inh_id = $this->input->post('inh_id',true);
            if(isset($stele_id)&&is_numeric($stele_id)&&!strpos($stele_id, '.')&&$stele_id!='0') {
                if(isset($inh_id)&&is_numeric($inh_id)&&!strpos($inh_id, '.')&&$inh_id!='0') {
                    $this->load->library('CI_Decide');
                    $power = $this->ci_decide->decide_stele($_SESSION['uid'],$stele_id);
                    if($power=='1'){
                        $this->db->trans_start();
                        $this->user_model->update_info('cc_inherit', array('stele_id' => '0'), array('stele_id' => $stele_id));//修改传记对应的关联传承碑为0
                        $this->user_model->update_info('cc_stele', array('inh_id' => $inh_id), array('id' => $stele_id));
                        $this->user_model->update_info('cc_inherit', array('stele_id' => $stele_id), array('id' => $inh_id));
                        $this->db->trans_complete();
                        if ($this->db->trans_status() === FALSE){
                            echo json_encode(array('code' => '0','hint' => '修改失败'));exit();
                        }else{
                            echo json_encode(array('code' => '1','hint' => '修改成功'));
                        }
                    }else{
                        echo json_encode(array('code' => '0','hint' => '修改失败'));
                    }
                }
            }else{
                echo json_encode(array('code' => '0','hint' => '修改失败'));
            }
        }
    }

    public function update()
    {
        if(!empty($_SESSION['uid'])){
            $type = trim($this->input->post('type',true));
            $value = trim($this->input->post('value',true));
            $content = trim($this->input->post('content',true));
            if(!preg_match("/[\'.,:;*?~`!@#$%^&+=)(<>{}]|\]|\[|\/|\\\|\"|\|/",$content)&&!empty($content)){
                if (isset($value)&&is_numeric($value)&&!strpos($value, '.')&&$value!='0') {
                    $value = intval($value);
                    switch ($type) {
                        //identify页面修改姓名
                        case 'identify_name':
                            $this->load->library('CI_Decide');
                            $power = $this->ci_decide->decide_stele($_SESSION['uid'],$value);    
                            if($power=='1'){
                                if($this->db->update('cc_stele', array('title' => $content) ,array('id' => $value))){
                                    echo json_encode(array('code' => '1','hint' => '修改成功','content' => $content));
                                }else{
                                    echo json_encode(array('code' => '0','hint' => '修改失败','content' => ''));
                                }
                            }else{
                                echo json_encode(array('code' => '0','hint' => '只有创建人能修改','content' => ''));
                            }
                            break;
                        //identify页面修改性别
                        case 'identify_sex':
                            $this->load->library('CI_Decide');
                            $power = $this->ci_decide->decide_stele($_SESSION['uid'],$value);    
                            if($power=='1'){
                                if($this->db->update('cc_stele', array('sex' => $content) ,array('id' => $value))){
                                    echo json_encode(array('code' => '1','hint' => '修改成功','content' => $content));
                                }else{
                                    echo json_encode(array('code' => '0','hint' => '修改失败','content' => ''));
                                }
                            }else{
                                echo json_encode(array('code' => '0','hint' => '只有创建人能修改','content' => ''));
                            }
                            break;
                        
                        //identify页面修改头像
                        case 'identify_head':
                            $this->load->library('CI_Decide');
                            $power = $this->ci_decide->decide_stele($_SESSION['uid'],$value);    
                            if($power=='1'){
                                
                                if($this->db->update('cc_stele', array('picture' => $content) ,array('id' => $value))){
                                    echo json_encode(array('code' => '1','hint' => '修改成功','content' => $content));
                                }else{
                                    echo json_encode(array('code' => '0','hint' => '修改失败','content' => ''));
                                }
                            }else{
                                echo json_encode(array('code' => '0','hint' => '只有创建人能修改','content' => ''));
                            }
                            break;

                        //identify页面修改出生时间
                        case 'identify_birthday':
                            $this->load->library('CI_Decide');
                            $power = $this->ci_decide->decide_stele($_SESSION['uid'],$value);    
                            if($power=='1'){
                                if($this->db->update('cc_stele', array('birthday_time' => $content) ,array('id' => $value))){
                                    echo json_encode(array('code' => '1','hint' => '修改成功','content' => $content));
                                }else{
                                    echo json_encode(array('code' => '0','hint' => '修改失败','content' => ''));
                                }
                            }else{
                                echo json_encode(array('code' => '0','hint' => '只有创建人能修改','content' => ''));
                            }
                            break;

                        //identify页面修改死亡时间
                        case 'identify_death':
                            $this->load->library('CI_Decide');
                            $power = $this->ci_decide->decide_stele($_SESSION['uid'],$value);    
                            if($power=='1'){
                                if($this->db->update('cc_stele', array('death_time' => $content) ,array('id' => $value))){
                                    echo json_encode(array('code' => '1','hint' => '修改成功','content' => $content));
                                }else{
                                    echo json_encode(array('code' => '0','hint' => '修改失败','content' => ''));
                                }
                            }else{
                                echo json_encode(array('code' => '0','hint' => '只有创建人能修改','content' => ''));
                            }
                            break;

                        default:
                            echo json_encode(array('code' => '0','hint' => '修改失败','content' => ''));
                            break;
                    }
                }
            }else{
                echo json_encode(array('code' => '0','hint' => '不能包含点号等特殊字符','content' => ''));
            }
            
        }
    }

    //获取更多传承碑
    public function getMoreStele()
    {  
        if(empty($_SESSION['uid'])){
            redirect('WechatOauthLogin');exit();
        }
        $data = array();
        $result_data =array();
        if($this->input->post()){
            $page = intval($this->input->post('page'));
            $user_id = $_SESSION['uid'];
            if(is_int($page) && $page > 0){
                $limit = 10;//数据的条数
                $offset = ($page - 1) * 10;
                $this->db->select("id,title,synopsis,picture,case when user_id = '$user_id' then '1' else '2' end as code");//判断是否为创建人，是则code为1，否则code为2
                $this->db->from('cc_stele');
                $this->db->where('is_del','0');
                $where = "(is_ste_open = 1 OR id in (select stele_id from ci_cc_stele_connect where user_id = '$user_id'))";
                $this->db->where($where);
                $this->db->order_by('is_hot', 'DESC');
                $this->db->order_by('add_time', 'DESC');
                $this->db->limit($limit, $offset);
                $query = $this->db->get();
                $data = $query -> result_array();
                $result_data = array('page' => $page, 'content' => $data);
            }
        }
        header('Content-Type:application/json; charset=utf-8');
        echo json_encode($result_data,JSON_UNESCAPED_UNICODE);
    }
    

    // //生成传承碑激活码
    // public function card()
    // {
    //     $this->load->helper('password');
    //     $a = array();
    //     $code = new Code();
    //     for ($i=10001; $i < 11001; $i++) { 
    //         $card_no = $code->encodeID($i,3);
    //         $m = md5($i.$card_no);
    //         $card_vc = substr($m,0,3); 
    //         $card_vc = strtoupper($card_vc);
    //         $card_vd = substr($m,-2);
    //         $card_vd = strtoupper($card_vd);
    //         $time = time();
    //         $a[] = array('no' => $i, 'card_type' => 'stele', 'title' => 'VIP激活卡', 'sub_title' => '', 'description' => '所有字母必须大写', 'card' => $card_vc.$card_no.$card_vd, 'time' => $time, 'used_time' => '', 'start_time' => '1527609652', 'end_time' => '1543507252', 'is_used' => '0', 'is_real' => '1', 'user_id' => '');
    //     }
    //     $this->db->insert_batch('cc_stele_card',$a);
    // }

}
?>