<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class More extends CI_Controller {
    
     public function index()
    {	
    	if(empty($_SESSION['uid'])){
    		redirect('WechatOauthLogin');exit();
    	}
    	//引入模块文件 user_model.php
        $this->load->model('user_model');
        //获取图片空间url
        $inc_url = $this->user_model->get_picture_space_info('url');
        //获取传承动态推荐内容
        $uid = $_SESSION['uid'];
        $is_open = '1';
        $is_boutique = '0';
        $is_recommend = '0';
        $page = '1';
        $inherit = $this->user_model->get_inherit($is_open,$is_boutique,$is_recommend,$page);
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
        $data = array('inc_url' => $inc_url, 'inherit_arr' => $inherit_arr);
		$this->load->view('more',$data);
    }
    
}
?>