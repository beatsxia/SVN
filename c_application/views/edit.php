<?php $this -> load -> view('header'); ?>
		<title>编辑</title>
		<link rel="stylesheet" href="<?php echo $inc_url; ?>css/send_biography.css" />
		<link rel="stylesheet" href="<?php echo $inc_url; ?>css/shijian.css" />
		<link rel="stylesheet" href="<?php echo $inc_url; ?>css/edit.css" />
	</head>
	<body class="layout-scroll-fixed">
		<h2 class="page-title">我的传记<a href="javascript:history.back(-1)"><span></span></a></h2>
		<img class="title-pic" src="<?php echo $inc_url; ?>img/edit_top.jpg"/>
		<?php echo form_open('edit/main', array('name' => "upload_form", 'id' => "send_form", 'class' => "send_form", 'onsubmit' => "return check()", 'enctype' => "multipart/form-datas"));?>
		<input type="hidden"  name="inherit_content_id" value="<?=$inherit_content['id']?>">
		<input type="hidden"  name="inherit_id" value="<?=$inherit_content['inh_id']?>">
		<div class="area" style="margin-top: 0;">
			<div class="title">
				<input type="text" id="title" class="add" name="title" placeholder="点击此处输入传记标题" onfocus="this.placeholder=''" onblur="this.placeholder='点击此处输入传记标题'" value="<?=$inherit_content['con_title']?>" />
			</div>
			<div class="date" style="display: none;">
				<input id="appDate" class="add" type="text" value="<?=$inherit_content['content_time']=='0'?date('Y-m-d',time()):date('Y-m-d',$inherit_content['content_time'])?>" name="appDate" readonly="readonly" placeholder="选择时间" onfocus="this.placeholder=''" onblur="this.placeholder='选择时间'" />
				<input type="text" id="location" class="location add" name="location" placeholder="事件地点" onfocus="this.placeholder=''" onblur="this.placeholder='事件地点'" value="<?=$inherit_content['creation_address']?>" />
			</div>
			<div id="content">
		        <ul id="conList">
		        	<?php if(empty($inherit_content["content"])){?>
		        	<li class="inh-item">
		        		<div class="inh-con">
		        			<a href="javascript:void(0);" class="item-remove" @click="removeItem">×</a>
		        			<textarea @input="textInput" class="inh-content inh-text" placeholder="写下您的个人传记....."></textarea>
		        		</div>
		        		<ol class="op-list">
		        			<li><a href="javascript:void(0);" @click="newText">+新建段落</a></li>
		        			<li><a href="javascript:void(0);" @click="newImg" >添加图片</a></li>
		        			<li class="move" style="display: none;">
		        				<a href="javascript:void(0);" @click="editPos" data-on = "-1" class="move-up" style="display: none;">&and;</a>
		        				<a href="javascript:void(0);" @click="editPos" data-on = "1" class="move-down" style="display: none;">&or;</a>
		        			</li>
		        		</ol>
		        	</li>
		        	<?php }else{ foreach($inherit_content["content"] as $ck => $cv){ ?>
		        	<li class="inh-item">
		        		<div class="inh-con">
		        			<a href="javascript:void(0);" class="item-remove" @click="removeItem">×</a>
		        			<?php if($cv["type"] == "text"){ ?>
		        			<textarea class="inh-content inh-text" placeholder="写下您的个人传记....."><?=$cv["con"]?></textarea>
		        			<?php }else{ ?>
		        			<img class="inh-content inh-pic" src="<?=$cv['con']?>"/>	
		        			<?php } ?>
		        		</div>
		        		<ol class="op-list">
		        			<li><a href="javascript:void(0);" @click="newText">+新建段落</a></li>
		        			<li><a href="javascript:void(0);" @click="newImg" >添加图片</a></li>
		        			<li class="move" <?php if(count($inherit_content["content"]) == 1){ ?>style="display: none;"<?php } ?> >
		        				<a href="javascript:void(0);" @click="editPos" data-on = "-1" class="move-up" <?php if($ck == 0){ ?>style="display: none;"<?php } ?> >&and;</a>
		        				<a href="javascript:void(0);" @click="editPos" data-on = "1" class="move-down" <?php if( $ck == (count($inherit_content["content"]) - 1) ){ ?>style="display: none;"<?php } ?> >&or;</a>
		        			</li>
		        		</ol>
		        	</li>	
		        	<?php }} ?>
		        </ul>
		        <div class="footer">
		        	<button type="button" class="sub" onclick="subContent()" >保存</button>
			        <div class="lock_input">
				        <a href="javascript:void(0);" class="lock" id="1" style="display: none;width: 100%;height: 100%;">发布</a>
				        <a href="javascript:void(0);" class="lock" id="0" style="display: block;width: 100%;height: 100%;">私人</a>
				        <input type="hidden" name="lock_open" id="lock" value="0" />
			        </div>
		        </div>
			</div>
			<input type="hidden" id="header" class="add" name="content" value="">
		</div>
		</form>
		<input type="file" id="newImg" value="" @change="imgChan" style="display: none;" />
	</body>
	<script type="text/javascript" src="<?php echo $inc_url; ?>js/send_biography.js"></script>
	<script type="text/javascript" src="<?php echo $inc_url; ?>js/jquer_shijian.js?ver=1"></script>
	
	<script type="text/javascript" charset="utf-8" src="<?php echo $inc_url; ?>ueditor/ueditor.config.js"></script>
	<script type="text/javascript" charset="utf-8" src="<?php echo $inc_url; ?>ueditor/ueditor.all.min.js"> </script>
	<!--建议手动加在语言，避免在ie下有时因为加载语言失败导致编辑器加载失败  <-手机端哪来的IE~-->
	<!--这里加载的语言文件会覆盖你在配置项目里添加的语言类型，比如你在配置项目里配置的是英文，这里加载的中文，那最后就是中文-->
	<script type="text/javascript" charset="utf-8" src="<?php echo $inc_url; ?>ueditor/lang/zh-cn/zh-cn.js"></script>
	<script>
	function getContent() {
		var childArr = document.getElementById("conList").children;
		var str      = new Array();
		var arrIndex = 0;
		var title    = document.getElementById("title").value;
		
		for (var index = 0; index < childArr.length; index++) {
			var itemCon;
			var type;
			if(childArr[index].getElementsByClassName("inh-content")[0].src != undefined)
			{
				itemCon = childArr[index].getElementsByClassName("inh-content")[0].src;
				type    = "img";
			}else{
				itemCon = childArr[index].getElementsByClassName("inh-content")[0].value;
				type    = "text";
			}
			
			if(itemCon != undefined && itemCon != "")
			{
				str[arrIndex] = {"type" : type, "con" : itemCon};
				arrIndex++;
			}
		}
		if(str != undefined && str.length >0 && title.length > 0)
		{
			str = JSON.stringify(str);
			return str;
		}else{
			return false;
		}
    }
    
    function subContent()
    {
    	var valStr = getContent();
    	if(!!valStr)
    	{
    		$("#header").val(valStr); //设置
			$("#send_form").submit();
    	}
    	else
    	{
    		showMsg("请先输入标题和内容");
    	}
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
    Page({
    	data:
    	{
    		Dom :
    		{
    			conList : document.getElementById("conList"),
    			imgFile : document.getElementById("newImg")
    		},
    		Create :
    		{
    			start   : '<div class="inh-con">',
    			textCon : '<a href="javascript:void(0);" class="item-remove" @click="removeItem">×</a><textarea class="inh-content inh-text" placeholder="写下您的个人传记....." style=""></textarea></div>',
    			end     : '<ol class="op-list"><li><a href="javascript:void(0);" @click="newText">+新建段落</a></li><li><a href="javascript:void(0);" @click="newImg" >添加图片</a></li><li class="move"><a href="javascript:void(0);" @click="editPos" data-on = "-1" class="move-up">&and;</a><a href="javascript:void(0);" @click="editPos" data-on = "1" class="move-down" style="display: none;">&or;</a></li></ol>'
    		},
    		stepNum : 0,
    		stepMax : 200,
    		inhId : $_GET["id"]
    	},
    	onLoad:function()
    	{
    		
    	},
    	newText:function()
    	{
    		var dom      = this.data.Dom;
    		var cre      = this.data.Create;
    		var childArr = dom.conList.children;
    		var item     = document.createElement("li");
    		
    		item.className = "inh-item";
    		item.innerHTML = cre.start + cre.textCon + cre.end;
    		
    		childArr[childArr.length - 1].getElementsByClassName("move")[0].style.display = "flex";
    		childArr[childArr.length - 1].getElementsByClassName("move-down")[0].style.display = "block";
    		dom.conList.appendChild(item);
    	},
    	newImg:function()
    	{
    		var dom      = this.data.Dom;
    		dom.imgFile.click();
    	},
    	imgChan:function(e)
    	{
    		var dom      = this.data.Dom;
    		var cre      = this.data.Create;
    		var childArr = dom.conList.children;
    		var ajaxEdit = this.ajaxEdit;
    		
    		if(!!e.obj.files[0])
    		{
    			var imgType = e.obj.files[0].type;
	    		if(imgType != "image/jpeg" && imgType != "image/png" && imgType != "image/gif" && imgType != "image/bmp")
	    		{
	    			showMsg("请选择jpg png gif bmp格式的图片");
	    			return;
	    		}
	    		var src;
	    		var ext = e.obj.files[0].name.split(".");
	    		ext     = ext[ext.length - 1];
	    		var read=new FileReader() // 创建FileReader对像;
				read.readAsDataURL(e.obj.files[0])  // 调用readAsDataURL方法读取文件;
	            read.onload=function(){
	                src=read.result.split(",")[1];  // 拿到读取结果;
	                $.ajax({
	                	type:"post",
	                	url:"edit/ajaxImg",
	                	data:{
	                		"ext" : ext,
	                		"img" : src
	                	},
	                	datatype:"json",
	                	async:true,
	                	cache:false,
	                	success:function(msg)
	                	{
	                		var result = JSON.parse(msg);
	                		if(result.status == "ok")
	                		{
	                			var item     = document.createElement("li");
	                			item.className = "inh-item";
					    		item.innerHTML = cre.start + '<a href="javascript:void(0);" class="item-remove" @click="removeItem">×</a><img class="inh-content inh-pic" src="' + result.msg + '"/></div>' + cre.end;
					    		
					    		childArr[childArr.length - 1].getElementsByClassName("move")[0].style.display = "flex";
					    		childArr[childArr.length - 1].getElementsByClassName("move-down")[0].style.display = "block";
					    		dom.conList.appendChild(item);
					    		
					    		ajaxEdit();//自动保存
	                		}
	                	},
	                	error:function()
	                	{
	                		showMsg("系统繁忙");
	                	}
	                });
				}
    		}
    	},
    	editPos:function(e)
    	{
    		var num      = e.obj.dataset.on*1;
    		var dom      = this.data.Dom;
    		var childArr = dom.conList.children;
    		var inhItem  = e.obj.parentNode.parentNode.parentNode;
    		var inhHtml  = inhItem.outerHTML
    		var i        = $(inhItem).index();
    		var conVal   = (inhItem.getElementsByClassName("inh-content")[0].value == undefined) ? inhItem.getElementsByClassName("inh-content")[0].src : inhItem.getElementsByClassName("inh-content")[0].value;
    		var conVal2  = (childArr[i + num].getElementsByClassName("inh-content")[0].value == undefined) ? childArr[i + num].getElementsByClassName("inh-content")[0].src :childArr[i + num].getElementsByClassName("inh-content")[0].value;
    		
    		childArr[i].outerHTML   = childArr[i + num].outerHTML;
    		childArr[i].getElementsByClassName("inh-content")[0].value   = conVal2;
    		
    		childArr[i + num].outerHTML = inhHtml;
    		childArr[i + num].getElementsByClassName("inh-content")[0].value = conVal;
    		
    		childArr[i].getElementsByClassName("move-up")[0].style.display         = "block"; 
    		childArr[i].getElementsByClassName("move-down")[0].style.display       = "block";
    		childArr[i + num].getElementsByClassName("move-up")[0].style.display   = "block"; 
    		childArr[i + num].getElementsByClassName("move-down")[0].style.display = "block";
    		
    		this.setHT();
    	},
    	removeItem:function(e)
    	{
    		var dom     = this.data.Dom;
    		var len     = dom.conList.children.length;
    		if(len > 1)
    		{
    			e.obj.parentNode.parentNode.remove();
    			this.setHT();
    		}else{
    			var imgstr = "<img style='height:100%;float:right;' src='<?php echo $inc_url; ?>arclist/i_f16.png'/>";
    			showMsg("嗯 哼&nbsp;&nbsp;"+imgstr);
    		}
    		
    	},
    	setHT:function()
    	{
    		var dom      = this.data.Dom;
    		var childArr = dom.conList.children;
    		childArr[0].getElementsByClassName("move-up")[0].style.display = "none";
    		childArr[childArr.length - 1].getElementsByClassName("move-down")[0].style.display = "none";
    		if(childArr.length == 1)
    		{
    			childArr[0].getElementsByClassName("move")[0].style.display = "none";
    		}
    	},
    	ajaxEdit:function()//自动保存函数
    	{
			return;
    		var inhId  = this.data.inhId*1;
    		var conStr = subContent();
    		if(!!conStr)
    		{
    			$.ajax({
	    			type:"post",
	    			url:"edit/ajaxContent",
	    			async:true,
	    			data:{
	    				"id"      : inhId,
	    				"content" : conStr
	    			},
	    			datatype:"json",
	    			cache:false,
	    			success:function(msg)
	            	{
	            		var result = JSON.parse(msg);
	            		if(result.status == "ok")
	            		{
	            			this.data.stepNum = 0;
	            			showMsg("已自动保存");
	            		}
	            	}.bind(this),
	            	error:function()
	            	{
	            		showMsg("系统繁忙");
	            	}
	    		});
    		}
    	},
    	textInput:function(e)
    	{
    		this.data.stepNum++;
    		if(this.data.stepNum == this.data.stepMax)
    		{
    			this.ajaxEdit();
    		}
    	}
    });
	</script>
</html>