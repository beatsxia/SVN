<?php 
class User_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        // Your own constructor code
    }



	//获取用户带参数二维码ticket
	 public function get_user_er_ticket($uid)
    {   
        $this->db->select('wechat_ticket.ticket');
        $this->db->from('wechat_ticket');
        $this->db->join('cc_user', 'cc_user.mid = wechat_ticket.member_id','left');
        $this->db->where('cc_user.id',$uid);
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->row_array();
    }

    //获取传记带参数二维码ticket
     public function get_inh_ticket($inh_id)
    {   
        $this->db->select('inh_id,stele_id,ticket,end_time');
        $this->db->from('wechat_inh_ticket');
        $this->db->where('inh_id',$inh_id);
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->row_array();
    }





	//获取用户的member_id
    public function get_user_member_id($uid)
    {   
        $this->db->select('mid');
        $this->db->where('id',$uid);
        $this->db->limit(1);
        $query = $this->db->get('cc_user');
        $member_id = $query->row();
        return $member_id->mid;
    }



    //存储用户二维码ticket    
    /*
        $date为array()
    */
    public function save_user_er_ticket($data)
    {
        $query = $this->db->insert('wechat_ticket', $data);
        return $query;
    }

    //存储传记二维码ticket    
    /*
        $date为array()
    */
    public function save_inh_ticket($data)
    {
        $query = $this->db->insert('wechat_inh_ticket', $data);
        return $query;
    }

    //获取member表所有信息
    public function get_user_member_info($uid)
    {   
        $this->db->select('wechat_member.*');
        $this->db->from('wechat_member');
        $this->db->join('cc_user', 'cc_user.mid = wechat_member.id','left');
        $this->db->where('cc_user.id',$uid);
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->row_array();
    }

    //图片空间地址
    public function get_picture_space_info($select_name='')
    {   
        if(!empty($select_name)){
            $this->db->select($select_name);
        }
        $this->db->from('cc_picture_space');
        $this->db->limit(1);
        $query = $this->db->get();
        if(!empty($select_name)){
           $item = $query->row();
           return $item->$select_name;
        }else{
            return $query->row_array();
        }
    }

    //存储
    public function update_info($table, $data, $where)
    {

        $query = $this->db->update($table, $data, $where);
        return $query;
    }

    //查询单行数据，或者单行数据的某个字段值
    public function select_info($table, $select_name, $where)
    {
        if(!empty($select_name)){
            $this->db->select($select_name);
        }
        $this->db->from($table);
        if(!empty($where)){  
            foreach ($where as $key => $value) {
                $this->db->where($key,$value);
            }
        }
        $query = $this->db->get();
        if(!preg_match('/,/s', $select_name)&&!empty($select_name)&&$select_name!='*'){
            $item = $query->row();
            if(!empty($item)){
                return $item->$select_name;
            }else{
                return $item;
            }
        }else{
            return $query->row_array();
        }
    }

    //获取前十条回复
    public function get_user_comment_ten($uid)
    {
        $this->db->select('cc_comment.user_id,cc_comment.cc_id,cc_comment.user_name,cc_comment.content,cc_comment.time,cc_user.avatar,cc_inherit.title,cc_inherit.thumbnail');
        $this->db->from('cc_comment');
        $this->db->join('cc_user', 'cc_user.id = cc_comment.user_id','left');
        $this->db->join('cc_inherit', 'cc_inherit.id = cc_comment.cc_id','left');
        $this->db->where('cc_comment.is_deleted','0');
        $this->db->where('cc_comment.cc_user_id',$uid);
        $this->db->order_by('cc_comment.is_read', 'ASC');
        $this->db->order_by('cc_comment.time', 'DESC');
        $this->db->limit(10);
        $query = $this->db->get();
        return $query -> result_array();
    }

    //获取传承动态推荐内容
    public function get_inherit($is_open,$is_boutique,$is_recommend,$page)
    {
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
        $this->db->where('cc_inherit.is_open',$is_open);
        if($is_boutique!='0'){
            $this->db->where('cc_inherit.is_boutique',$is_boutique);
        }
        if($is_recommend!='0'){
            $this->db->where('cc_inherit.is_recommend',$is_recommend);
        }
        $this->db->order_by('cc_inherit.add_time', 'DESC');
        $this->db->limit($limit, $offset);
        $query = $this->db->get();
        return $query -> result_array();
    }

    //插入传承
    public function insert_inherit($data)
    {
        if($this->db->insert('cc_inherit', $data)){
            return $this->db->insert_id();
        }
        return FALSE;
    }

    //插入传承内容
    public function insert_inherit_content($data)
    {
        if($this->db->insert('cc_inherit_content', $data)){
            return $this->db->insert_id();
        }
        return FALSE;
    }

    //获取传承内容表所有信息，按照顺序排列  返回内容数组
    public function get_inherit_contents($inh_id)
    {
        $this->db->select('*');
        $this->db->from('cc_inherit_content');
        $this->db->where('inh_id',$inh_id);
        $this->db->order_by('sort', 'ASC');
        $this->db->order_by('content_time', 'ASC');
        $query = $this->db->get();
        return $query -> result_array();
    }

    //获取传承ID为$inh_id 的所有标题，按照顺序排列  返回内容数组
    public function get_inherit_contents_title($inh_id)
    {
        $this->db->select('id,inh_id,con_title,con_num');
        $this->db->from('cc_inherit_content');
        $this->db->where('inh_id',$inh_id);
        $this->db->order_by('sort', 'ASC');
        $this->db->order_by('content_time', 'ASC');
        $query = $this->db->get();
        return $query -> result_array();
    }

    //获取传承内容表所有信息并查询出该content创建人的头像和昵称，按照顺序排列  返回内容数组
    public function get_inherit_contents_user($inh_id)
    {
        $this->db->select('cc_inherit_content.*,cc_user.nickname,cc_user.avatar');
        $this->db->from('cc_inherit_content');
        $this->db->join('cc_user', 'cc_user.id = cc_inherit_content.user_id','left');
        $this->db->where('cc_inherit_content.inh_id',$inh_id);
        $this->db->order_by('cc_inherit_content.sort', 'ASC');
        $this->db->order_by('cc_inherit_content.content_time', 'ASC');
        $query = $this->db->get();
        return $query -> result_array();
    }


    //获取传承内容表信息并查询出该content创建人的头像和昵称
    public function get_inherit_contents_byid($id)
    {
        $this->db->select('cc_inherit_content.*,cc_user.nickname,cc_user.avatar,cc_inherit.is_open');
        $this->db->from('cc_inherit_content');
        $this->db->join('cc_user', 'cc_user.id = cc_inherit_content.user_id','left');
        $this->db->join('cc_inherit', 'cc_inherit.id = cc_inherit_content.inh_id','left');
        $this->db->where('cc_inherit_content.id',$id);
        $query = $this->db->get();
        return $query -> row_array();
    }

    //获取传承内容，返回一个字符串
    public function get_inherit_contents_str($inh_id)
    {
        $this->db->select('content');
        $this->db->from('cc_inherit_content');
        $this->db->where('inh_id',$inh_id);
        $this->db->where('is_show','1');
        $this->db->order_by('sort', 'ASC');
        $this->db->order_by('content_time', 'ASC');
        $query = $this->db->get();
        $inherit_contents_str = '';
        $inherit_contents = $query -> result_array();
        foreach ($inherit_contents as $key => $value) {
            $inherit_contents_str = $inherit_contents_str.$value['content'];
        }
        return $inherit_contents_str;
    }

    //查询是否关注  1用户ID  2被关注的人ID
    public function get_is_follow($user_id,$follower_id)
    {
        $this->db->select('id');
        $this->db->from('cc_fans');
        $this->db->where('user_id',$user_id);
        $this->db->where('follower_id',$follower_id);
        $this->db->where('cancel','0');
        $query = $this->db->get();
        if(empty($query -> result_array())){
            return 0;
        }else{
            return 1;
        }
    }

    //查询某传记评论的总数
    public function get_comment_num($inh_id)
    {
        $this->db->from('cc_comment');
        $this->db->where('cc_id',$inh_id);
        $this->db->where('is_deleted','0');
        return $this->db->count_all_results();
    }


    //查询首页推荐内容
    public function get_rolling_content($limit)
    {
        $this->db->select('inh_id,title,picture,sort,link,alt,describe');
        $this->db->from('cc_rolling_content');
        $this->db->where('is_delete','0');
        $this->db->order_by('add_time', 'DESC');
        $this->db->order_by('sort', 'DESC');
        $this->db->limit($limit, 0);
        $query = $this->db->get();
        return $query -> result_array();

    }

    //查询用户的回复数量
    public function select_comment_num($uid)
    {
        $this->db->where('cc_user_id',$uid);
        $this->db->where('is_deleted','0');
        $this->db->where('is_read','0');
        $query  = $this->db->get('cc_comment');
        return $query ->num_rows();//回复人数
    }

    //查询某个用户的传记  select_user_inherit(1,array(0,1),1)
    public function select_user_inherit($user_id,$is_open,$page)
    {
        if ( is_int($page) && $page > 0) {
            $page = $page;
        }else{
            $page = 1;
        }
        $limit = 10;
        $offset = ($page - 1) * 10;
        $this->db->select('id,thumbnail,picture,title,synopsis,add_time');
        $this->db->from('cc_inherit');
        $this->db->where('user_id',$user_id);
        $this->db->where_in('is_open',$is_open);
        $this->db->order_by('add_time', 'DESC');
        $this->db->limit($limit, $offset);
        $query = $this->db->get();
        $inherit = $query -> result_array();

        $inherit_arr = array();
        foreach ($inherit as $key => $value) {
            $pic1 = $inh_content = $inh_stage = '';
            if(empty($value['thumbnail'])&&empty($value['picture'])){
                $inh_content = $this->get_inherit_contents_str($value['id']);
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
                    $inh_content = $this->get_inherit_contents_str($value['id']);
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
        return $inherit_arr;
    }


    //插入传承权限信息
    public function insert_inherit_power($data)
    {
        if($this->db->insert('cc_inherit_power', $data)){
            return TRUE;
        }
        return FALSE;
    }

    //插入传承权限补充表
    public function insert_inherit_power_tbd($data)
    {
        if($this->db->insert('cc_inherit_power_tbd', $data)){
            return TRUE;
        }
        return FALSE;
    }

    //通过传承内容ID查询是否有编辑的权限
    public function get_inherit_power_id($user_id,$inh_content_id)
    {
        $this->db->select('cc_inherit_power.id');
        $this->db->from('cc_inherit_power');
        $this->db->join('cc_inherit_content', 'cc_inherit_content.inh_id = cc_inherit_power.inh_id','left');
        $this->db->where('cc_inherit_power.user_id',$user_id);
        $this->db->where('cc_inherit_content.id',$inh_content_id);
        $query = $this->db->get();
        return $query -> row();
    }

    //获取评论内容
    public function get_inh_comment($inh_id,$page='1')
    {
        $limit = 10;
        $offset = ($page - 1) * 10;
        $this->db->select('cc_comment.id,cc_comment.type,cc_comment.cc_id,cc_comment.cc_user_id,cc_comment.user_id,cc_comment.user_name,cc_comment.content,cc_comment.time,cc_comment.comment_id,cc_user.avatar');
        $this->db->from('cc_comment');
        $this->db->join('cc_user', 'cc_user.id = cc_comment.user_id','left');
        $this->db->where('cc_comment.is_deleted','0');
        $this->db->where('cc_comment.cc_id',$inh_id);
        $this->db->order_by('cc_comment.time', 'DESC');
        $this->db->limit($limit,$offset);
        $query = $this->db->get();
        return $query -> result_array();
    }


    //我的页面信息
    public function get_mine_info($uid)
    {
        //头像 昵称 个性签名
        $this->db->select('gender,avatar,nickname,personality_note');
        $this->db->where('id', $uid);
        $query  = $this->db->get('cc_user');
        $user_data = $query ->row_array();
        $avatar = $user_data['avatar'];//头像
        $nickname = $user_data['nickname'];//昵称
        $personality_note = $user_data['personality_note'];//个性签名
        $gender = $user_data['gender'];//性别

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
        $comment_num = $this->select_comment_num($uid);//$comment_num = $this->user_model->select_comment_num($uid);

        //用户余额
        $user_point = $this->get_user_point($uid);

        //我的传记
        $my_inherit = $this->select_user_inherit($uid,array('0','1'),'1');//$my_inherit = $this->user_model->select_user_inherit($uid,array('0','1'),'1');
        return array('gender' => $gender, 'avatar' => $avatar, 'nickname' => $nickname, 'personality_note' => $personality_note, 'total_inh_num' => $total_inh_num, 'access_log_num' => $access_log_num, 'user_follow_num' => $user_follow_num, 'user_fans_num' => $user_fans_num, 'comment_num' => $comment_num, 'my_inherit' => $my_inherit, 'user_point' => $user_point);

    }

    //获取用户余额
    public function get_user_point($uid)
    {   
        $this->db->select('sum(point) as user_point');
        $this->db->from('cc_money_log');
        $this->db->where('user_id',$uid);
        $query = $this->db->get();
        $item = $query->row();
        if(!empty($item->user_point)){
            return $item->user_point;
        }else{
            return 0;
        }
            
    }


    //获取传记的访问记录
    public function get_inh_access_log($uid)
    {   
        $now = time();
        $begintime  = strtotime(date('Y-m-d', $now));

        $this->db->select('cc_access_log.access_time,cc_user.nickname,cc_user.avatar,cc_inherit.title');
        $this->db->from('cc_access_log');
        $this->db->join('cc_user', 'cc_user.id = cc_access_log.user_id','left');
        $this->db->join('cc_inherit', 'cc_inherit.id = cc_access_log.access_page','left');
        $this->db->where('cc_access_log.type','inherit');
        $this->db->where('cc_access_log.visitor_id',$uid);
        $this->db->where('cc_access_log.access_time >',$begintime);
        $query = $this->db->get();
        return $query->result_array();
    }

    //获取传记总浏览量
    public function get_count_inh_access_log($uid)
    {
        $this->db->select('id');
        $this->db->from('cc_access_log');
        $this->db->where('visitor_id',$uid);
        $this->db->where('type','inherit');
        return $this->db->count_all_results();
    }

    //获取关注列表
    public function get_user_follow($uid)
    {
        $this->db->select('cc_user.id,cc_user.nickname,cc_user.avatar,cc_user.personality_note');
        $this->db->from('cc_fans');
        $this->db->join('cc_user', 'cc_user.id = cc_fans.follower_id','left');
        $this->db->where('user_id',$uid);
        $this->db->where('cancel','0');
        $this->db->order_by('follow_time', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }

    //获取粉丝列表
    public function get_user_fans($uid)
    {
        $this->db->select('cc_user.id,cc_user.nickname,cc_user.avatar,cc_user.personality_note,cc_fans.follow_time');
        $this->db->from('cc_fans');
        $this->db->join('cc_user', 'cc_user.id = cc_fans.user_id','left');
        $this->db->where('follower_id',$uid);
        $this->db->where('cancel','0');
        $this->db->order_by('follow_time', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }

    //插入评论内容
    public function insert_cc_comment($data)
    {
        if($this->db->insert('cc_comment', $data)){
            return $this->db->insert_id();
        }
        return FALSE;
    }

    //获取留言内容
    public function get_note($stele_id,$offset)
    {
        if (is_int($offset)) {
            $offset = $offset;
        }else{
            $offset = 0;
        }
        $limit = 1;//每次select 行数
        $this->db->select('cc_note.content,(select count(ci_cc_note_zan.id) from ci_cc_note_zan where ci_cc_note_zan.note_id = ci_cc_note.id and ci_cc_note_zan.zan = 1 and ci_cc_note_zan.is_true = 1) zan_num');
        $this->db->from('cc_note');
        $this->db->where('cc_note.stele_id',$stele_id);
        $this->db->where('cc_note.is_first','1');
        $this->db->order_by('zan_num', 'DESC');
        $this->db->order_by('cc_note.time', 'DESC');
        $this->db->limit($limit, $offset);
        $query = $this->db->get();
        $inherit = $query -> row_array();
        if(empty($inherit)){
            $inherit['content'] = '';
        }
        $inherit['offset'] = $offset+1;
        return $inherit;
    }

    //获取留言 通过 分页
    public function get_note_page($stele_id,$page)
    {
        if ( is_int($page) && $page > 0) {
            $page = $page;
        }else{
            $page = 1;
        }
        $offset = ($page - 1) * 10;
        $limit = 10;//每次select 行数
        $this->db->select('cc_note.id,cc_user.nickname,cc_user.avatar,cc_note.picture,cc_note.content,cc_note.time,(select count(ci_cc_note_zan.id) from ci_cc_note_zan where ci_cc_note_zan.note_id = ci_cc_note.id and ci_cc_note_zan.zan = 1 and ci_cc_note_zan.is_true = 1) zan_num');
        $this->db->from('cc_note');
        $this->db->join('cc_user', 'cc_user.id = cc_note.user_id','left');
        $this->db->where('cc_note.stele_id',$stele_id);
        $this->db->where('cc_note.is_first','1');
        $this->db->order_by('zan_num', 'DESC');
        $this->db->order_by('cc_note.time', 'DESC');
        $this->db->limit($limit, $offset);
        $query = $this->db->get();
        return $query -> result_array();
    }

    //获取自己有没有赞
    public function get_is_my_zan($user_id,$note_id)
    {
        $this->db->select('zan,is_true');
        $this->db->from('cc_note_zan');
        $this->db->where('user_id',$user_id);
        $this->db->where('note_id',$note_id);
        $query = $this->db->get();
        $zan = $query -> row_array();
        if(!empty($zan)&&$zan['is_true']=='1'){
            return $zan['zan'];//return 1为赞 | return 2为踩
        }elseif(!empty($zan)&&$zan['is_true']=='0'){
            return -1;//点赞或者踩后取消
        }else{
            return 0;//没有记录
        }
    }

    //给用户点赞
     public function insert_note_zan($data)
    {
        if($this->db->insert('cc_note_zan', $data)){
            return $this->db->insert_id();
        }
        return FALSE;
    }

    //创建传承碑
    public function insert_cc_stele($data)
    {
        if($this->db->insert('cc_stele', $data)){
            return $this->db->insert_id();
        }
        return FALSE;
    }

    //获取传承碑内容
    public function get_stele($stele_id)
    {
        $this->db->select('id,title,my_words,synopsis,inh_id,picture');
        $this->db->from('cc_stele');
        $this->db->where('id',$stele_id);
        $this->db->where('is_del','0');
        $query = $this->db->get();
        return $query -> row_array();
    }

    //插入留言内容
    public function insert_cc_note($data)
    {
        if($this->db->insert('cc_note', $data)){
            return $this->db->insert_id();
        }
        return FALSE;
    }

    //获取传承碑相册信息
    public function get_stele_album($stele_id)
    {
        $this->db->select('id,title,album_img,time,user_id');
        $this->db->from('cc_stele_album');
        $this->db->where('stele_id',$stele_id);
        $this->db->where('is_del','0');
        $this->db->order_by('time', 'DESC');
        $query = $this->db->get();
        return $query -> result_array();
    }

    //获取传承碑相册第一张图片
    public function get_stele_album_pic1($album_id)
    {
        $this->db->select('pic_url,title');
        $this->db->from('cc_stele_album_space');
        $this->db->where('album_id',$album_id);
        $this->db->limit(1);
        $query = $this->db->get();
        return $query -> row_array();
    }

    //获取传承碑相册图片
    public function get_stele_album_pic_all($album_id,$page)
    {   
       if ( is_int($page) && $page > 0) {
            $page = $page;
        }else{
            $page = 1;
        }
        $offset = ($page - 1) * 15;
        $limit = 15;//每次select 行数
        $this->db->select('nickname,pic_url,title');
        $this->db->from('cc_stele_album_space');
        $this->db->where('album_id',$album_id);
        $this->db->order_by('time', 'DESC');
        $this->db->limit($limit, $offset);
        $query = $this->db->get();
        return $query -> result_array();
    }

    //新建传承碑相册名称
    public function insert_stele_album($data)
    {
        if($this->db->insert('cc_stele_album', $data)){
            return $this->db->insert_id();
        }
        return FALSE;
    }

    //插入图片到传承碑相册空间
    public function insert_album_space($data)
    {
        if($this->db->insert('cc_stele_album_space', $data)){
            return $this->db->insert_id();
        }
        return FALSE;
    }

    //获取传承碑列表
    public function get_stele_list($page,$user_id)
    {   
       if ( is_int($page) && $page > 0) {
            $page = $page;
        }else{
            $page = 1;
        }
        $offset = ($page - 1) * 10;
        $limit = 10;//每次select 行数
        $this->db->select("id,title,synopsis,picture,case when user_id = '$user_id' then '1' else '2' end as code");//判断是否为创建人，是则code为1，否则code为2
        $this->db->from('cc_stele');
        $this->db->where('is_del','0');
        $where = "(is_ste_open = 1 OR id in (select stele_id from ci_cc_stele_connect where user_id = '$user_id'))";
        $this->db->where($where);
        $this->db->order_by('is_hot', 'DESC');
        $this->db->order_by('add_time', 'DESC');
        $this->db->limit($limit, $offset);
        $query = $this->db->get();
        return $query -> result_array();
    }

    //获取个人留言
    public function get_stele_note($stele_id,$user_id)
    {
        $this->db->select('content,time,(select count(ci_cc_note_zan.id) from ci_cc_note_zan where ci_cc_note_zan.note_id = ci_cc_note.id and ci_cc_note_zan.zan = 1 and ci_cc_note_zan.is_true = 1) zan_num');
        $this->db->from('cc_note');
        $this->db->where('stele_id',$stele_id);
        $this->db->where('user_id',$user_id);
        $this->db->order_by('time', 'DESC');
        $query = $this->db->get();
        return $query -> result_array();
    }

    //通过inh_id传记id 获取创建人open_id
    public function get_user_open_id($inh_id)
    {
        $this->db->select('cc_user.open_id');
        $this->db->from('cc_user');
        $this->db->join('cc_inherit', 'cc_inherit.user_id = cc_user.id','left');
        $this->db->where('cc_inherit.id',$inh_id);
        $this->db->limit(1);
        $query = $this->db->get();
        return $query -> row_array();
    }

    //通过stele_id传承碑id 获取创建人open_id
    public function get_user_open_id_by_ste($stele_id)
    {
        $this->db->select('cc_user.open_id');
        $this->db->from('cc_user');
        $this->db->join('cc_stele', 'cc_stele.user_id = cc_user.id','left');
        $this->db->where('cc_stele.id',$stele_id);
        $this->db->limit(1);
        $query = $this->db->get();
        return $query -> row_array();
    }

    //通过类别获取产品 cat_id = 1为充值产品
    public function get_goods_by_catid($cat_id='0')
    {
        $this->db->select('*');
        $this->db->from('cc_goods');
        $this->db->where('cat_id',$cat_id);
        $this->db->where('shop_price !=','0');
        $query = $this->db->get();
        return $query -> result_array();
    }

    //通过good_id获取产品 
    public function get_goods_by_id($id='0')
    {
        $this->db->select('*');
        $this->db->from('cc_goods');
        $this->db->where('id',$id);
        $this->db->where('shop_price !=','0');
        $query = $this->db->get();
        return $query -> row_array();
    }

    //插入订单详请
    public function insert_order_info($data='')
    {
        if($this->db->insert('cc_order_info', $data)){
            return $this->db->insert_id();
        }
        return FALSE;
    }

    //计算该传记的总礼物数量
    public function sum_stele_give($stele_id='0')
    {
        $this->db->select('sum(total_gift_price)');
        $this->db->from('cc_stele_give');
        $this->db->where('stele_id',$stele_id);
        $query = $this->db->get();
        $sum_stele_give = $query -> row_array();
        return intval($sum_stele_give['sum(total_gift_price)']);
    }

    //查询该传记送礼物最多的前10个人和他们送的礼物数量
    public function stele_give_top_10($stele_id='0')
    {
        /*$this->db->select('cc_user.nickname,cc_user.avatar,(SELECT sum(total_gift_price) FROM `ci_cc_stele_give` WHERE ci_cc_stele_give.user_id = ci_cc_user.id and ci_cc_stele_give.stele_id = $stele_id) user_gives');
        $this->db->from('cc_user');
        $this->db->join('cc_stele_connect', 'cc_stele_connect.user_id = cc_user.id','left');
        $this->db->where('cc_stele_connect.stele_id',$stele_id);
        $this->db->order_by('user_gives', 'DESC');
        $this->db->limit(10);
        $query = $this->db->get();
        */
        $sql = "SELECT ci_cc_user.nickname, ci_cc_user.avatar, (SELECT sum(total_gift_price) FROM ci_cc_stele_give WHERE ci_cc_stele_give.user_id = ci_cc_user.id and ci_cc_stele_give.stele_id = $stele_id) user_gives FROM ci_cc_user LEFT JOIN ci_cc_stele_connect ON ci_cc_stele_connect.user_id = ci_cc_user.id WHERE ci_cc_stele_connect.stele_id = '$stele_id' ORDER BY user_gives DESC LIMIT 10";
        $query = $this->db->query($sql);
        return $query -> result_array();
    }

    //查询所有礼物种类ID
    public function get_stele_gift_all_id()
    {
        $this->db->select('id');
        $this->db->from('cc_stele_gift');
        $this->db->where('price !=','0');
        $query = $this->db->get();
        return $query -> result_array();

    }

    //插入cc_stele_connect用户传承碑关联表
    public function insert_stele_connect($data)
    {
        if($this->db->insert('cc_stele_connect', $data)){
            return $this->db->insert_id();
        }
        return FALSE;
    }

    //插入cc_stele_give礼物记录表
    public function insert_stele_give($data)
    {
        if($this->db->insert('cc_stele_give', $data)){
            return $this->db->insert_id();
        }
        return FALSE;
    }

    //获取某传承碑的礼物赠送记录
    public function get_stele_give_by_ste($stele_id,$page)
    {   
        if ( is_int($page) && $page > 0) {
            $page = $page;
        }else{
            $page = 1;
        }
        $limit = 10;
        $offset = ($page - 1) * 10;
        $this->db->select('cc_stele_give.user_id,cc_stele_give.gift_id,cc_stele_give.gift_price,cc_stele_give.gift_count,cc_stele_give.time,cc_user.nickname,cc_stele_gift.gift_action,cc_stele_gift.gift_unit,cc_stele_gift.name');
        $this->db->from('cc_stele_give');
        $this->db->join('cc_user', 'cc_user.id = cc_stele_give.user_id','left');
        $this->db->join('cc_stele_gift', 'cc_stele_gift.id = cc_stele_give.gift_id','left');
        $this->db->where('stele_id',$stele_id);
        $this->db->where('total_gift_price !=','0');
        $this->db->order_by('time', 'DESC');
        $this->db->limit($limit, $offset);
        $query = $this->db->get();
        $stele_give_arr = $query -> result_array();
        $stele_give_arr_today = array();
        $stele_give_arr_yesterday = array();
        $stele_give_arr_lastday = array();
        //今天开始的时间戳
        $beginToday=mktime(0,0,0,date('m'),date('d'),date('Y'));
        //昨天开始的时间戳
        $beginYesterday=mktime(0,0,0,date('m'),date('d')-1,date('Y'));
        foreach ($stele_give_arr as $key => $value) {
            if ($value['time']>=$beginToday) {
                $stele_give_arr_today[] = $value;
            }elseif ($value['time']>=$beginYesterday) {
                $stele_give_arr_yesterday[] = $value;
            }else{
                $stele_give_arr_lastday[] = $value;
            }
        }
        return array('today' => $stele_give_arr_today, 'yesterday' => $stele_give_arr_yesterday, 'lastday' => $stele_give_arr_lastday);
    }

    //获取最新的3条赠送记录
    public function get_stele_give_new_3($stele_id)
    {
        $this->db->select('cc_stele_give.gift_count,cc_user.nickname,cc_stele_gift.gift_action,cc_stele_gift.gift_unit,cc_stele_gift.name');
        $this->db->from('cc_stele_give');
        $this->db->join('cc_user', 'cc_user.id = cc_stele_give.user_id','left');
        $this->db->join('cc_stele_gift', 'cc_stele_gift.id = cc_stele_give.gift_id','left');
        $this->db->where('stele_id',$stele_id);
        $this->db->where('total_gift_price !=','0');
        $this->db->order_by('time', 'DESC');
        $this->db->limit(3);
        $query = $this->db->get();
        return $query -> result_array();
    }

    //查询用户有多少余额
    public function total_user_point($user_id)
    {
        $this->db->select('sum(point)');
        $this->db->from('cc_money_log');
        $this->db->where('user_id',$user_id);
        $query = $this->db->get();
        $sum_user_point = $query -> row_array();
        return $sum_user_point['sum(point)'];
    }

    //插入cc_money_log用户余额表
    public function insert_money_log($data)
    {
        if($this->db->insert('cc_money_log', $data)){
            return $this->db->insert_id();
        }
        return FALSE;
    }

    //获取充值记录
    public function select_recharge_record($user_id)
    {
        $this->db->select('time,point,note');
        $this->db->from('cc_money_log');
        $this->db->where('user_id',$user_id);
        $this->db->where('order_id !=','0');
        $query = $this->db->get();
        return $query -> result_array();
    }

    //插入cc_access_log用户操作记录表
    public function insert_access_log($data)
    {
        if($this->db->insert('cc_access_log', $data)){
            return $this->db->insert_id();
        }
        return FALSE;
    }

    public function get_user_inh($user_id='0')
    {
        $this->db->select('cc_inherit.title,cc_inherit_power.inh_id');
        $this->db->from('cc_inherit_power');
        $this->db->join('cc_inherit', 'cc_inherit.id = cc_inherit_power.inh_id','left');
        $this->db->where('cc_inherit_power.user_id',$user_id);
        $this->db->where('cc_inherit.stele_id','0');
        $query = $this->db->get();
        return $query -> result_array();
    }

    //查询某个传记的展示内容  
    public function get_inherit_identify($inh_id)
    {
        $this->db->select('id,thumbnail,picture,title,synopsis,add_time');
        $this->db->from('cc_inherit');
        $this->db->where('id',$inh_id);
        $this->db->order_by('add_time', 'DESC');
        $query = $this->db->get();
        $inherit = $query -> row_array();

        $pic1 = $inh_content = $inh_stage = '';
        if(empty($inherit['thumbnail'])&&empty($inherit['picture'])){
            $inh_content = $this->get_inherit_contents_str($inherit['id']);
            if(preg_match("/src=\"(.*?)\"/s",$inh_content,$matche)){
                $pic1 = $matche['1'];
            }else{
                $pic1 = '';
            }
            $inh_content = htmlspecialchars_decode($inh_content);//把一些预定义的 HTML 实体转换为字符
            $inh_content = strip_tags($inh_content);//函数剥去字符串中的 HTML、XML 以及 PHP 的标签,获取纯文本内容
            $inh_content = str_replace("&nbsp;","",$inh_content);//将空格替换成空
            $inh_stage = mb_substr($inh_content, 0, 60,"utf-8");//返回字符串中的前100字符串长度的字符

        }else{
            if(empty($inherit['synopsis'])){
                $inh_content = $this->get_inherit_contents_str($inherit['id']);
                $inh_content = htmlspecialchars_decode($inh_content);//把一些预定义的 HTML 实体转换为字符
                $inh_content = str_replace("&nbsp;","",$inh_content);//将空格替换成空
                $inh_content = strip_tags($inh_content);//函数剥去字符串中的 HTML、XML 以及 PHP 的标签,获取纯文本内容
                $inh_stage = mb_substr($inh_content, 0, 60,"utf-8");//返回字符串中的前100字符串长度的字符
            }
            $pic1 = !empty($inherit['thumbnail']) ? $inherit['thumbnail'] : $inherit['picture'];
        }
        $inherit['pic1'] = $pic1;
        $inherit['inh_stage'] = $inh_stage;
        return $inherit;
    }


    //插入cc_suggestion用户意见建议表
    public function insert_suggestion($data)
    {
        if($this->db->insert('cc_suggestion', $data)){
            return $this->db->insert_id();
        }
        return FALSE;
    }
}
?>