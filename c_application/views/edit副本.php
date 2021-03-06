﻿<!DOCTYPE html>
<html>

	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0" charset="UTF-8">
		<meta http-equiv="Access-Control-Allow-Origin" content="*">
		<title>编辑</title>
	</head>

	<link rel="stylesheet" href="<?php echo $inc_url; ?>css/send_biography.css" />
	<link rel="stylesheet" href="<?php echo $inc_url; ?>css/shijian.css" />
	<link rel="stylesheet" type="text/css" href="http://cdn.bootcss.com/font-awesome/4.6.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo $inc_url; ?>css/froala_editor.min.css">

	<body class="layout-scroll-fixed">
		<?php echo form_open('edit/main', array('name' => "upload_form", 'id' => "send_form", 'class' => "send_form", 'onsubmit' => "return check()", 'enctype' => "multipart/form-datas"));?>
		<input type="hidden"  name="inherit_content_id" value="<?=$inherit_content['id']?>">
		<input type="hidden"  name="inherit_id" value="<?=$inherit_content['inh_id']?>">
		<button type="submit" class="sub" onclick="getInnerHTML()" >
		发表
		</button>
		<div class="area">
			<div class="title">
				<input type="text" id="title" class="add" name="title" placeholder="输入标题" onfocus="this.placeholder=''" onblur="this.placeholder='输入标题'" value="<?=$inherit_content['con_title']?>" />
			</div>
			<div class="date">
				<input id="appDate" class="add" type="text" value="<?=$inherit_content['content_time']=='0'?date('Y-m-d',time()):date('Y-m-d',$inherit_content['content_time'])?>" name="appDate" readonly="readonly" placeholder="选择时间" onfocus="this.placeholder=''" onblur="this.placeholder='选择时间'" />
				<input type="text" id="location" class="location add" name="location" placeholder="事件地点" onfocus="this.placeholder=''" onblur="this.placeholder='事件地点'" value="<?=$inherit_content['creation_address']?>" />
			</div>
			<div id='edit' class="add" ><?=$inherit_content['content']?></div>
			<input type="hidden" id="header" class="add" name="content" value="">
		</div>
		<div style="margin-bottom: 60px;"></div>
		<div class="footer">
			<div class="emotion_div">
				<img class="emotion face" src="<?php echo $inc_url; ?>img/emotion.png" />
			</div>
			<div class="lock_input">
				<img src="<?php echo $inc_url; ?>img/Lock-Close.png" class="lock" id="1" style="display: none;" />
				<img src="<?php echo $inc_url; ?>img/Lock-Open.png" class="lock" id="0" />
				<input type="hidden" name="lock_open" id="lock" value="0" />
			</div>
		</div>
		</form>
	</body>

	<script type="text/javascript" src="<?php echo $inc_url; ?>js/jquery-2.1.1.min.js"></script>
	<script type="text/javascript" src="<?php echo $inc_url; ?>js/send_biography.js"></script>
	<script type="text/javascript" src="<?php echo $inc_url; ?>js/jquer_shijian.js?ver=1"></script>

	<!--文本编辑器JS-->
	<script src="<?php echo $inc_url; ?>js/froala_editor.min.js"></script>
	<script src="<?php echo $inc_url; ?>js/langs/zh_cn.js"></script>
	<script>$(function() {
		var myedit =null;
	$('#edit').editable({
		inlineMode: false,
		alwaysBlank: true,
		language: "zh_cn",
		imageUploadURL: 'upload/imgupload', //上传到本地服务器
		imageUploadParams: {
			id: "edit"
		},
		imageDeleteURL: 'lib/delete_image.php', //删除图片
		imagesLoadURL: 'lib/load_images.php' //管理图片
	}).on('editable.afterRemoveImage', function(e, editor, $img) {
		editor.options.imageDeleteParams = {
			src: $img.attr('src')
		};
		editor.deleteImage($img);
	});
});

function getInnerHTML() {
	var content = $("#edit .froala-element").eq(0)[0].innerHTML; //获取
	$("#header").val(content); //设置
}

$(function() {
	$("#appDate").shijian({
		startYear: 1989,
//		val: 1989,
		endYear: 2017,
		Hour: false, //是否显示小时
		Minute: false, //是否显分钟
	});
});

function check() {
	
			if($("#title").val().length<0){
				alert("标题不能为空");
				return false;
			}
			
			if($("#title").val().length>20){
				alert("标题不能超过20个字符");
				return false;
			}
			
//			if($("#header").val().length<30){
//				alert("内容不能少于30个字符");
//				return false;
//			}
			
			return true;
			
}
    
    $(function() {
        // 解决输入法遮挡
        var timer = null;
        $('#content').on('focus', function() {
        	var conHgt = $("#content").css("height");
        	console.log(conHgt);
        	if(conHgt<180){
        		clearInterval(timer);
        		timer = setInterval(function() {
        			$('body').scrollTop(conHgt);
        			clearInterval(timer);
        		}, 50)
        	}else{
        		clearInterval(timer);
        		timer = setInterval(function() {
        			$('body').scrollTop(10000);
        			clearInterval(timer);
        		}, 50)
        	}
            
            
        })
    });
    
    
	</script>

</html>