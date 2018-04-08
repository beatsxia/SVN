<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class User_ercode extends CI_Controller {
    
     public function index()
    {	
    	if(empty($_SESSION['uid'])){
    		redirect('WechatOauthLogin');exit();
    	}
        $uid = $_SESSION['uid'];
        //引入lib
        $this->load->library('CI_Wechat');
        //引入模块文件 user_model.php
        $this->load->model('user_model');

    	//获取图片空间url
        $inc_url = $this->user_model->get_picture_space_info('url');
        $img_url = $this->user_model->get_picture_space_info('img_url');

        //判断是否已经有邀请函
        $full_img_url = $this->user_model->select_info('cc_user','full_img',array('id' => $uid));
        if(!empty($full_img_url)){
            $full_img_url = $full_img_url;
        }else{
            //生成邀请函开始

            $current_time = time();
            //查询用户是否有二维码ticket
            $ercode = $this->user_model->get_user_er_ticket($uid);
            if (empty($ercode)) {
                //获取二维码
                $ercode = $this->ci_wechat->getQRCode($uid,'0','604800');
                //存储ticket
                $date = array('member_id' => $this->user_model->get_user_member_id($uid), 'ticket' => $ercode['ticket'], 'url' => $ercode['url'], 'expire_seconds' => isset($ercode['expire_seconds']) ? trim($ercode['expire_seconds']) : '604800', 'end_time' => $current_time+604800);
                if(!empty($ercode['ticket'])){
                    $this->user_model->save_user_er_ticket($date);
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
            $bottom_img = 'img/qcode/bottom.jpg';//底图
            $head_img = 'img/qcode/head_img/'.$uid.'_'.$current_time.'.png';//头像
            $er_code_img = 'img/qcode/er_code_img/'.$uid.'_'.$current_time.'.png';//二维码
            $full_img = 'img/qcode/full_img/'.$uid.'_'.$current_time.'.jpg';//完整邀请码图片

            //获取获取二维码存到本地
            $url = 'https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket='.$ercode['ticket'];
            $save_dir = 'img/qcode/er_code_img/';
            $filename = $uid.'_'.$current_time.'.png';
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

            //获取用户的微信头像
            $user_member_info = $this->user_model->get_user_member_info($uid);
            if(preg_match('/https/', $user_member_info['avatar'])){
                $url = $user_member_info['avatar'];
            }else{
                $url = str_replace('http','https',$user_member_info['avatar']);
            }
            $save_dir = 'img/qcode/head_img/';
            $filename = $uid.'_'.$current_time.'.png';
            $avatar = getImage($url,$save_dir,$filename);//存储头像

            //对头像进行调整PX
            $config['image_library'] = 'gd2';
            $config['source_image'] = $head_img;
            $config['maintain_ratio'] = TRUE;
            $config['width']     = 140;
            $config['height']   = 140;
            $config['new_image'] = $head_img;
            $this->image_lib->initialize($config);
            $this->image_lib->resize();
            $this->image_lib->clear();//重置所有之前用于处理图片的值

            //对头像进行圆边处理
            $round_head = new avatar($head_img, '#fff', 140);//头像直径为140px
            $round_head -> show($head_img);

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
            
            //添加水印（头像）
            $head_img_size=getimagesize($head_img);
            if($head_img_size[0]!=140){
                $head_img='img/qcode/himg.png';//获取统一头像
            }
            //创建图片的实例
            $dst = imagecreatefromstring(file_get_contents($bottom_img));
            $src = imagecreatefromstring(file_get_contents($head_img));
            //获取水印头像图片的宽高
            list($src_w, $src_h) = getimagesize($head_img);
            //将水印头像图片复制到目标图片上，最后个参数100(全透明)是设置透明度，这里实现全透明效果
            imagecopy($dst, $src, 250, 62, 0, 0, $src_w, $src_h);

            //二维码加水印
            $src_er = imagecreatefromstring(file_get_contents($er_code_img));
            //获取水印图片的宽高
            list($src_w_er, $src_h_er) = getimagesize($er_code_img);
            //将水印二维码复制到目标图片上，最后个参数100(全透明)是设置透明度，这里实现全透明效果
            imagecopymerge($dst, $src_er, 185, 332, 0, 0, $src_w_er, $src_h_er, 100);

            #设置水印字体颜色
            $color = imagecolorallocatealpha($dst,'000','000','000',20);
            #设置字体文件路径
            $fontfile = "img/qcode/msyh.ttf";
            #水印文字
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
            if($fontstr_lang<=32){
                $fontstr_x=320-($fontstr_lang*6);
            }else{
                $sub_lang=48+$j-$str_num;
                $fontstr=substr($fontstr,0,$sub_lang);
                $fontstr_x=128;
            }
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
            imagettftext($dst,20,0,$fontstr_x,247,$color,$fontfile,$fontstr);
            imagettftext($dst,16,0,280,910,$color,$fontfile,$fontstr1);

            //保存图片
            imagejpeg($dst,$full_img);
            //清除图片
            imagedestroy($dst);
            imagedestroy($src);
            imagedestroy($src_er);

            //生成邀请函结束
            $part_img_url = 'qcode/full_img/'.$uid.'_'.$current_time.'.jpg';//完整邀请码图片地址（配合图片空间，去掉了前面img文件夹）;

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
                $img_url = 'http://beatsxia.s1.natapp.cc/SVN/img/';//此处为网站域名
            }

            $full_img_url = $img_url.$part_img_url;
            //将邀请函存入数据库
            $date = array('full_img' => $full_img_url );
            $where = array('id' => $uid);
            $this->user_model->update_info('cc_user',$date,$where);

        }
        
        $data = array('inc_url' => $inc_url, 'full_img' => $full_img_url);
		$this->load->view('user_ercode',$data);
    }
}
?>