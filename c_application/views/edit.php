<!DOCTYPE html>
<html>

	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0" charset="UTF-8">
		<meta http-equiv="Access-Control-Allow-Origin" content="*">
		<title>編輯</title>
		<style type="text/css">
			#content{
				width:100%;
				height:100%;
			}
			img {
                max-width: 100%;
            }
            #edui5_body{
            	width: auto;
            	height: auto;
            }
            #edui3_iframe{
            	height: auto !important;
            }
            #edui4_body{
            	height: auto !important;
            }
            #edui10_body,#edui15_body{
            	width: 300px !important;
            	height: auto !important;
            }
            #edui15_body{
            	bottom: 70px;
            }
		</style>
	</head>

	<link rel="stylesheet" href="<?php echo $inc_url; ?>css/send_biography.css" />
	<link rel="stylesheet" href="<?php echo $inc_url; ?>css/shijian.css" />
	<!--<link rel="stylesheet" type="text/css" href="http://cdn.bootcss.com/font-awesome/4.6.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo $inc_url; ?>css/froala_editor.min.css">-->

	<body class="layout-scroll-fixed">
		<?php echo form_open('edit/main', array('name' => "upload_form", 'id' => "send_form", 'class' => "send_form", 'onsubmit' => "return check()", 'enctype' => "multipart/form-datas"));?>
		<input type="hidden"  name="inherit_content_id" value="<?=$inherit_content['id']?>">
		<input type="hidden"  name="inherit_id" value="<?=$inherit_content['inh_id']?>">
		<button type="submit" class="sub" onclick="getContent()" >
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
			<div id="content">
				<script id="editor" type="text/plain" style="width:100%;"></script>
				<div class="footer">
			        <!--<div class="emotion_div">
				        <img class="emotion face" src="<?php echo $inc_url; ?>img/emotion.png" />
			        </div>-->
			        <div class="lock_input">
				        <img src="<?php echo $inc_url; ?>img/Lock-Close.png" class="lock" id="1" style="display: none;" />
				        <img src="<?php echo $inc_url; ?>img/Lock-Open.png" class="lock" id="0" />
				        <input type="hidden" name="lock_open" id="lock" value="0" />
			        </div>
		        </div>
			</div>
			<input type="hidden" id="header" class="add" name="content" value="">
		</div>
		<!--<div style="margin-bottom: 60px;"></div>-->
		</form>
	</body>

	<script type="text/javascript" src="<?php echo $inc_url; ?>js/jquery-2.1.1.min.js"></script>
	<script type="text/javascript" src="<?php echo $inc_url; ?>js/send_biography.js"></script>
	<script type="text/javascript" src="<?php echo $inc_url; ?>js/jquer_shijian.js?ver=1"></script>
	
	<script type="text/javascript" charset="utf-8" src="<?php echo $inc_url; ?>ueditor/ueditor.config.js"></script>
	<script type="text/javascript" charset="utf-8" src="<?php echo $inc_url; ?>ueditor/ueditor.all.min.js"> </script>
	<!--建议手动加在语言，避免在ie下有时因为加载语言失败导致编辑器加载失败-->
	<!--这里加载的语言文件会覆盖你在配置项目里添加的语言类型，比如你在配置项目里配置的是英文，这里加载的中文，那最后就是中文-->
	<script type="text/javascript" charset="utf-8" src="<?php echo $inc_url; ?>ueditor/lang/zh-cn/zh-cn.js"></script>

	<script>
	//content最小高度
//	$("#content").css("min-height",)
		
	//实例化编辑器
	var ue = UE.getEditor('editor',{    
		//这里可以选择自己需要的工具按钮名称,此处仅选择如下
		toolbars:[['insertimage','music','insertvideo','justifyleft','justifycenter','justifyright',  'fullscreen','bold',"undo",'redo','forecolor']],    
		//focus时自动清空初始化时的内容    
		autoClearinitialContent:true,    
		//关闭字数统计    
		wordCount:false,    
		//关闭elementPath    
		elementPathEnabled:false,
		//默认的编辑区域高度    
		initialFrameHeight:290
		//更多其他参数，请参考ueditor.config.js中的配置项    
	});

	function getContent() {
		$("#header").val(UE.getEditor('editor').getContent()); //设置
    }
	
	$(function(){
        //判断ueditor 编辑器是否创建成功
        UE.getEditor('editor').addListener("ready", function () {
        　　// editor准备好之后才可以使用
		    UE.getEditor('editor').setContent('<?=$inherit_content['content']?>');

        });
    });

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
		
		if($("#title").val().length>30){
			alert("标题不能超过30个字符");
			return false;
		}
		
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