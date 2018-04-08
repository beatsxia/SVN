<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Inh_ercode extends CI_Controller {
    
     public function index()
    {	
    	if(empty($_SESSION['uid'])){
    		redirect('WechatOauthLogin');exit();
    	}

        //引入lib
        $this->load->library('CI_Wechat');
        //引入模块文件 user_model.php
        $this->load->model('user_model');
        $inh_id = intval($this->input->get('inh_id'));
        if(empty($inh_id)||$inh_id=='0'){
            show_error('访问出现错误');
            exit();
            //待补充提示框和跳转
        }
        //$this->ci_wechat->valid();
        //$uid = $_SESSION['uid'];  //uid为当事人的ID
        $uid = $this->user_model->select_info('cc_inherit','user_id',array('id' => $inh_id));//uid为传记创建人的ID
    	//获取图片空间url
        $inc_url = $this->user_model->get_picture_space_info('url');
        $img_url = $this->user_model->get_picture_space_info('img_url');

        $inh_title = $this->user_model->select_info('cc_inherit','title',array('id' => $inh_id));
        //生成邀请函开始

        $current_time = time();
        //查询用户是否有二维码ticket
        $ercode = $this->user_model->get_inh_ticket($inh_id);
        if (empty($ercode)) {
            //获取二维码
            $ercode = $this->ci_wechat->getQRCode('12'.$inh_id,'0','604800');//前面12表明为传记邀请函
            //存储ticket
            $date = array('inh_id' => $inh_id, 'stele_id' => '0', 'ticket' => $ercode['ticket'], 'url' => $ercode['url'], 'expire_seconds' => isset($ercode['expire_seconds']) ? trim($ercode['expire_seconds']) : '604800', 'end_time' => $current_time+604800);
            if(!empty($ercode['ticket'])){
                $this->user_model->save_inh_ticket($date);
            }else{
                show_error('访问出现错误');
                return;
                //待补充提示框和跳转
            }
        }elseif($ercode['end_time']<=$current_time){
            //获取二维码
            $ercode = $this->ci_wechat->getQRCode('12'.$inh_id,'0','604800');//前面12表明为传记邀请函
            if(!empty($ercode['ticket'])){
                $date = array('ticket' => $ercode['ticket'], 'url' => $ercode['url'], 'expire_seconds' => isset($ercode['expire_seconds']) ? trim($ercode['expire_seconds']) : '604800', 'end_time' => $current_time+604800);
                $this->user_model->update_info('wechat_inh_ticket', $date, array('inh_id' => $inh_id));
            }else{
                show_error('访问出现错误');
                return;
                //待补充提示框和跳转
            }
        }
        //引入获取图片函数
        $this->load->helper('getimg');
        //引入图片圆角处理函数
        $this->load->helper('avatar.class');
        //引入图像处理类
        $this->load->library('image_lib');

        //定义所需变量
        $bottom_img = 'img/qcode/inh_bottom.jpg';//底图
        $er_code_img = 'img/qcode/inh_er_code_img/'.$inh_id.'_'.$current_time.'.png';//二维码
        $full_img = 'img/qcode/inh_full_img/'.$inh_id.'_'.$current_time.'.jpg';//完整邀请码图片

        //获取获取二维码存到本地
        $url = 'https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket='.$ercode['ticket'];
        $save_dir = 'img/qcode/inh_er_code_img/';
        $filename = $inh_id.'_'.$current_time.'.png';
        $er_code = getImage($url,$save_dir,$filename);//存储二维码

        //对二维码进行调整PX
        $config['image_library'] = 'gd2';
        $config['source_image'] = $er_code_img;
        $config['maintain_ratio'] = TRUE;
        $config['width']     = 270;
        $config['height']   = 270;
        $config['new_image'] = $er_code_img;
        $this->image_lib->initialize($config);
        $this->image_lib->resize();

        //函数重置所有之前用于处理图片的值
        $this->image_lib->clear();

        //获取用户的信息
        $user_member_info = $this->user_model->select_info('cc_user','open_id,nickname',array('id' => $_SESSION['uid']));

        //添加水印（二维码）
        // $config['source_image'] = $bottom_img;
        // $config['wm_type'] = 'overlay';
        // $config['wm_vrt_alignment'] = 'top';
        // $config['wm_hor_alignment'] = 'left';
        // $config['wm_hor_offset'] = '185';
        // $config['wm_vrt_offset'] = '330';
        // $config['wm_overlay_path'] = $er_code_img;
        // $config['new_image'] = $full_img;
        // $this->image_lib->initialize($config);
        // $this->image_lib->watermark();
        // $this->image_lib->clear();//重置所有之前用于处理图片的值
        
        //创建图片的实例
        $dst = imagecreatefromstring(file_get_contents($bottom_img));

        //二维码加水印
        $src_er = imagecreatefromstring(file_get_contents($er_code_img));
        //获取水印图片的宽高
        list($src_w_er, $src_h_er) = getimagesize($er_code_img);
        //将水印二维码复制到目标图片上，最后个参数100(全透明)是设置透明度，这里实现全透明效果
        imagecopymerge($dst, $src_er, 185, 470, 0, 0, $src_w_er, $src_h_er, 100);

        #设置水印字体颜色
        $color = imagecolorallocatealpha($dst,'000','000','000',20);
        #设置字体文件路径
        $fontfile = "img/qcode/msyh.ttf";

        #水印名字
        $encode = 'UTF-8';
        if(!empty($user_member_info['nickname'])){
            $fontstr = $user_member_info['nickname'];
        }else{
            $fontstr = "您的好友";
        }
        $str_num = mb_strlen($fontstr, $encode);//echo  "这个字符串的长度是：" . $str_num; 
        $j = 0;
        for($i=0; $i < $str_num; $i++) 
        {
            if(ord(mb_substr($fontstr, $i, 1, $encode))> 0xa0) 
            { 
                $j++;//echo   "有".$j. "个汉字 "; 
            }
        }
        $fontstr_lang=$j+$str_num;
        if($fontstr_lang<=16){
            $fontstr_x=265-($fontstr_lang*6);
        }else{
            $fontstr=substr($fontstr,0,16);
            $fontstr_x=175;
        }
        //打印名字结束

        //水印标题开始
        $inh_title_num = mb_strlen($inh_title, $encode);//echo  "标题的长度是：" . $inh_title_num; 
        $j = 0;
        for($i=0; $i < $inh_title_num; $i++) 
        {
            if(ord(mb_substr($inh_title, $i, 1, $encode))> 0xa0) 
            { 
                $j++;//echo   "有".$j. "个汉字 "; 
            }
        }
        $inh_title_lang=$j+$inh_title_num;
        if($inh_title_lang<=20){
            $inh_title_x=320-($inh_title_lang*8);
            imagettftext($dst,24,0,$inh_title_x,210,$color,$fontfile,$inh_title);
        }else{
            $inh_title=substr($inh_title,0,30);
            $inh_title_x=170;
            imagettftext($dst,24,0,$inh_title_x,210,$color,$fontfile,$inh_title);
        }
        //水印标题结束

        /* add 有效期 Start */
        $valid_time  = $current_time+7*24*3600;
        $fontstr1  = date('Y-m-d',$current_time)." ~ ".date('Y-m-d',$valid_time);
        $str_num1 = mb_strlen($fontstr1, $encode);
        $k = 0;
        for($a=0; $a < $str_num1; $a++) 
        {
            if(ord(mb_substr($fontstr1, $i, 1, $encode))> 0xa0) 
            { 
                $k++;
            }
        }
        /* add 有效期 End */

        #打文字水印
        imagettftext($dst,20,0,$fontstr_x,330,$color,$fontfile,$fontstr);
        imagettftext($dst,16,0,250,1008,$color,$fontfile,$fontstr1);

        //保存图片
        imagejpeg($dst,$full_img);
        //清除图片
        imagedestroy($dst);
        imagedestroy($src_er);

        //生成邀请函结束
        $part_img_url = 'qcode/inh_full_img/'.$inh_id.'_'.$current_time.'.jpg';//完整邀请码图片地址（配合图片空间，去掉了前面img文件夹）;

        //将图片存入图片空间
        //获取图片空间 信息
        $img_url = $this->user_model->get_picture_space_info('img_url');
        $accessKey = $this->user_model->get_picture_space_info('accessKey');
        $secretKey = $this->user_model->get_picture_space_info('secretKey');
        $img_name = $this->user_model->get_picture_space_info('img_name');

        
        //引入上传类库
        require_once('include/qiniu/autoload.php');
        $this->load->helper('qiniu_putfile');
        if(qiniu_putfile($accessKey,$secretKey,$img_name,"img/" . $part_img_url,"img/" . $part_img_url)){
            $img_url = $img_url."img/";
        }else{
            $img_url = 'http://www.chuancheng1.com/';//此处为网站域名
        }

        $full_img_url = $img_url.$part_img_url;
        //将邀请函存入数据库
        $date = array('url' => $full_img_url );
        $where = array('id' => $inh_id);
        $this->user_model->update_info('cc_inherit',$date,$where);
        
        //$data = array('inc_url' => $inc_url, 'full_img' => $full_img_url);
		//$this->load->view('inh_ercode',$data);

        //微信给用户发送图片开始
        //微信上传临时图片素材
        $result = $this->ci_wechat->uploadMedia(array('media'=>'@'.realpath($full_img)),'image');
        //echo $result['media_id'];
        $open_id = $user_member_info['open_id'];
        $data = array('touser' => $open_id, 'msgtype' => 'image', 'image' => array('media_id' => $result['media_id']));
        //$data = array('touser' => 'oLCmewGaydDe-lO48nQq4DV0Omv8', 'msgtype' => 'image', 'image' => array('media_id' => '_ZiO_NyogNDq5BnR3QU1HC2A4JnVaP68ywgD6-ghLdApV75aI4z-oTLzmyOXu2zk'));
        $this->ci_wechat->sendCustomMessage($data);//发信息给用户
        //微信给用户发送图片结束
    }
}
?>