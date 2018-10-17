<?php $this -> load -> view('header'); ?>
		<title>传记</title>
		<link rel="stylesheet" href="<?php echo $inc_url;?>css/show_article.css" />
	</head>
	<style>
		.link_to_inh_ste{
			width: 32%;
			letter-spacing: 0.8px;
			font-size: 14px;
			border: 0;
			outline: none;
			background: #fece24;
			border-radius: 5px;
			text-align: center;
			margin-left: 34%;
			margin-bottom: 16px;
		}
		
	</style>
	
	
	<body @touchend="getMsg">
		<h2 class="page-title"><?=$inh_content['con_title']?><a href="javascript:history.back(-1)"><span></span></a></h2>
		<img class="title-pic" src="<?php echo $inc_url; ?>img/edit_top.jpg"/>
		<?php $this -> load -> view('navbar'); ?>
				<?php if($inh_content['is_power']=='1'){?>
					<div class="edit">
			            <img src="<?php echo $inc_url;?>img/edit.png" /><span><a href="edit?id=<?=$inh_content['id']?>">编辑</a></span>
			        </div>
		        <?php }?>
    	<?php if($inh_content['is_show']=='1'||$inh_content['is_power']=='1'){?>
			<div class="content">
				<?php if(!empty($inh_content['content'])){?>
					<?php foreach($inh_content['content'] as $ck => $cv){ if($cv["type"] == "img"){ ?>
					<img class="inh-pic" src="<?=$cv['con']?>"/>
					<?php }else{ ?>	
					<p class="inh-text"><?=$cv['con']?></p>
					<?php }} ?>
					<?php if($stele_id!='0'){?>
						<button type="button" class="link_to_inh_ste">进入传承碑</button>
					<?php }?>
				<?php }?>	
			</div>
		<?php }?>
		<!--评论-->
		<div class="msg-board">
			<h3 class="msg-top">留言/评论&nbsp;&nbsp;&nbsp;&nbsp;<span id="comNum"><?=$com_num?></span> <a href="javascript:void(0);" @click="showMsg" data-on = "1" class="set-msg" inhId="<?=$inh_content['inh_id']?>">写留言</a></h3>
			<div id="msgList">
				<?php foreach($comment as $mk=>$mv){ ?>
				<div class="msg-item clearfloat">
					<img class="user-pic" src="<?=$mv['avatar']?>"/>
					<div class="msg-block">
						<span class="user-name"><?=$mv['user_name']?></span>
						<p class="msg-con"><?=$mv['content']?></p>
						<?php if(!empty($mv["sub"])){ foreach($mv["sub"] as $msk=>$msv){ ?>
						<span class="user-name" style="border-left: 3px solid #6f0205;text-indent: 0.2rem;"><?=$msv['user_name']?></span>
						<p class="msg-con" style="text-indent: 0.2rem;"><?=$msv['content']?></p>
						<?php }} ?>
					</div>
					<span class="msg-help" @click="msgType" data-on="<?=$mv['id']?>" data-name = "<?=$mv['user_name']?>"></span>
				</div>
				<?php } ?>
			</div>
		</div>
		<div id="bomLine" <?php if($com_num > 10){ ?>style="display: none;"><?php } ?></div>
	    <div style="height: 2rem;"></div>
	    <section class="msg-text" id="msgBlock">
			<span class="msg-shadow" @click="showMsg" data-on = "0"></span>
			<div class="msg-container">
				<a href="javascript:void(0);" class="msg-reply"><span></span><span href="javascript:void(0);" id="noReply" @click="msgType" data-on = "0">×</span></a>
				<div class="msg-bor">
					<p id="msgText" contenteditable="true" @input="cursorPos" @click="cursorPos" @keydown="cursorPos"></p>
					<a href="javascript:void(0);" class="msg-look" @click="showArc" data-on = "0"></a>
					<span class="look-top" id="lookTop">
						<span></span>
					</span>
					<ul class="look-list" id="arcList">
						<?php foreach($arclist as $ik => $iv){ ?>
						<li class="look-item">
							<img src="<?=$inc_url . 'arclist/' . $iv?>" @click="getImg" />
						</li>
						<?php } ?>
					</ul>
				</div>
				<a href="javascript:void(0);" id="sendMsg" class="msg-send msg-void" @click="sendMsg">发送</a>
			</div>
		</section>
	</body>
	<script src="<?php echo $inc_url; ?>js/show_content.js"></script>
<script type="text/javascript">
$(function(){
	$("bottom").click(function(){
		var href = $(this).attr("inhId");
		window.location = "comment?inh_id="+href;
	});
	$(".link_to_inh_ste").height($(".link_to_inh_ste").width()*0.3358);
	$(".link_to_inh_ste").click(function(){
		window.location = "cloud?s=<?=$stele_id?>";
	});
});
Page({
	data :
	{
		Dom:
		{
			arcList : document.getElementById("arcList"),
			msgText : document.getElementById("msgText"),
			sendMsg : document.getElementById("sendMsg"),
			msgList : document.getElementById("msgList"),
			comNum  : document.getElementById("comNum"),
			lookTop : document.getElementById("lookTop"),
			msgBlock: document.getElementById("msgBlock"),
			noReply : document.getElementById("noReply"),
			msgAgent: undefined
		},
		cursor : undefined,
		Msg:
		{
			type    : 0,
			agentid : -1
		},
		msgNum : "<?=$com_num?>" * 1,
		page   : 2,
		loadStatus : true
	},
	showMsg:function(e)
	{
		var dom = this.data.Dom;
		var on  = e.obj.dataset.on*1;
		if(on == 0)
		{
			document.body.style.overflow = "auto"
			dom.msgBlock.style.display   = "none";
		}
		else
		{
			document.body.style.overflow = "hidden"
			dom.msgBlock.style.display = "block";
		}
	},
	showArc:function(e)
	{
		var dom = this.data.Dom;
		var on = e.obj.dataset.on*1;
		if(on == 0)
		{
			dom.lookTop.style.display = "block";
			dom.arcList.style.display = "block";
			e.obj.dataset.on = 1;
		}
		else
		{
			dom.lookTop.style.display = "none";
			dom.arcList.style.display = "none";
			e.obj.dataset.on = 0;
		}
	},
	getImg:function(e)
	{
		var dom = this.data.Dom;
		var cur = this.data.cursor;
		var imgSrc = e.obj.src;
		var inner  = dom.msgText.innerHTML;
		if(cur == undefined)
		{
			dom.msgText.innerHTML += "<img src='" + imgSrc + "'/>";
		}
		else if(cur.type == "img" && cur.index == -1)
		{
			dom.msgText.innerHTML  = "<img src='" + imgSrc + "'/>" + inner;
			this.data.cursor.index = 0;
		}
		else
		{
			var htmlStr = "";
			
			for (var Mkey in dom.msgText.childNodes) {
				if(Mkey == cur.index && cur.type == "img")
				{
					htmlStr += dom.msgText.childNodes[Mkey].outerHTML + "<img src='" + imgSrc + "'/>";
				}
				else if(Mkey == cur.nodeIndex && cur.type == "text")
				{
					htmlStr += dom.msgText.childNodes[Mkey].data.substr(0, cur.index) + "<img src='" + imgSrc + "'/>" + dom.msgText.childNodes[Mkey].data.substr(cur.index);
				}
				else
				{
					var nodeStr = dom.msgText.childNodes[Mkey].data || dom.msgText.childNodes[Mkey].outerHTML;
					htmlStr += (nodeStr !== undefined) ? nodeStr : "";
				}
			}
			
			if(cur.type == "text")
			{
				if(this.data.cursor.nodeIndex*1 == 0 && this.data.cursor.index*1 == 0)
				{
					this.data.cursor.index  = this.data.cursor.nodeIndex*1;
				}
				else
				{
					this.data.cursor.index  = this.data.cursor.nodeIndex*1 + 1;
				}
				this.data.cursor.type   = "img";
			}else if(cur.type == "img")
			{
				this.data.cursor.index += 1;
			}
			
			dom.msgText.innerHTML = htmlStr;
		}
		dom.sendMsg.className = dom.sendMsg.classList[0];
	},
	cursorPos:function(e)
	{
		//console.log(e);
		var dom     = this.data.Dom;
		var msgData = dom.msgText.innerHTML;
		
		//光标位置
		var caretOffset = 0;
		var doc = e.obj.ownerDocument || e.obj.document;
		var win = doc.defaultView || doc.parentWindow;
		var sel;
		if (typeof win.getSelection != "undefined") {//谷歌、火狐
		sel = win.getSelection();
	    if (sel.rangeCount > 0) {//选中的区域
	      var range = win.getSelection().getRangeAt(0);
	      var preCaretRange = range.cloneRange();//克隆一个选中区域
	      preCaretRange.selectNodeContents(e.obj);//设置选中区域的节点内容为当前节点
	      preCaretRange.setEnd(range.endContainer, range.endOffset);  //重置选中区域的结束位置
	      caretOffset = preCaretRange.endOffset;//preCaretRange.toString().length;
	    }
		} else if ((sel = doc.selection) && sel.type != "Control") {//IE
		    var textRange = sel.createRange();
		    var preCaretTextRange = doc.body.createTextRange();
		    preCaretTextRange.moveToElementText(e.obj);
		    preCaretTextRange.setEndPoint("EndToEnd", textRange);
		    caretOffset = preCaretTextRange.text.length;
		}
		
		if(preCaretRange.endContainer == dom.msgText)
		{
			this.setData({
				cursor : {
					type  : "img",
					index : ((e.type == "keydown") ? caretOffset - 2 : caretOffset - 1)
				}
			});
		}
		else
		{
			var nodes = preCaretRange.commonAncestorContainer.childNodes;
			var i;
			for (var nodeKey in nodes) {
				if(preCaretRange.endContainer == nodes[nodeKey])
				{
					i = nodeKey;
				}
			}
			this.setData({
				cursor : {
					type  : "text",
					index : ((e.type == "keydown" && caretOffset != 0) ? caretOffset - 1 : caretOffset),
					nodeIndex : i
				}
			});
		}
		
		//光标位置
		if(msgData <= 0)
		{
			dom.sendMsg.className = dom.sendMsg.classList[0] + " msg-void";
			this.data.cursor = undefined;
		}
		else
		{
			dom.sendMsg.className = dom.sendMsg.classList[0];
		}
	},
	sendMsg:function()
	{
		var dom     = this.data.Dom;
		var msgData = dom.msgText.innerHTML;
		var msgInfo = this.data.Msg;
		if(msgData <= 0)
		{
			return;
		}
		else
		{
			$.ajax({
				type  : "post",
				url   : "show_content/ajaxMsg",
				async : true,
				cache : false,
				data  : {
					"msgdata"           : msgData,
					"comment_cc_id"     : "<?=$inh_content['inh_id']?>",
					"comment_type"      : msgInfo.type,
					"comment_father_id" : msgInfo.agentid
				},
				datatype:"json",
				success:function(msg)
				{
					var result = JSON.parse(msg);
					if(result.status == "ok")
					{
						dom.sendMsg.className = dom.sendMsg.classList[0] + " msg-void";
						dom.msgText.innerHTML = "";
						if(dom.msgAgent == undefined)
						{
							dom.msgList.innerHTML = '<div class="msg-item clearfloat"><img class="user-pic" src="' + result.avatar + '"/><div class="msg-block"><span class="user-name">' + result.user_name + '</span><p class="msg-con">' + msgData + '</p></div><span class="msg-help" @click="msgType" data-on="' + result.id + '" data-name="' + result.user_name + '"></span></div>' + dom.msgList.innerHTML;
							dom.comNum.innerText  = dom.comNum.innerText*1 + 1;
						}
						else
						{
							dom.msgAgent.innerHTML += '<span class="user-name" style="border-left: 3px solid #6f0205;text-indent: 0.2rem;">' + result.user_name + '</span><p class="msg-con" style="text-indent: 0.2rem;">' + msgData + '</p>';
						}
						
						this.msgType();
						dom.msgBlock.style.display = "none";
					}
					showMsg(result.msg);
				}.bind(this),
				error:function()
				{
					showMsg("系统繁忙");
				}
			});
		}
	},
	getMsg:function(e)
	{
		var dom     = this.data.Dom;
		var rangeB  = document.body.clientHeight - window.scrollY - window.screen.height;
		if(rangeB <= 3 && this.data.msgNum > 10 && this.data.page != 0 && !!this.data.loadStatus)
		{
			this.data.loadStatus = false;
			$.ajax({
				type  : "post",
				url   : "show_content/ajaxGetMsg",
				async : true,
				data  : {
					"inhId" : "<?=$inh_content['inh_id']?>",
					"num"   : this.data.msgNum,
					"page"  : this.data.page
				},
				datatype:"json",
				success:function(msg)
				{
					var result = JSON.parse(msg);
					if(result.status == "ok")
					{
						this.data.page += 1;
						if(result.len == "end")
						{
							this.data.page = 0;
							document.getElementById("bomLine").style.display = "block";
						}
						var htmlStr = "";
						var msgData = result.data;
						for (var Mkey in msgData) {
							var str1 = '<div class="msg-item clearfloat"><img class="user-pic" src="' + msgData[Mkey].avatar + '"/><div class="msg-block"><span class="user-name">' + msgData[Mkey].user_name + '</span><p class="msg-con">' + msgData[Mkey].content + '</p>';
							var str2 = "";
							var str3 = '</div><span class="msg-help" @click="msgType" data-on="' + msgData[Mkey].id + '" data-name="' + msgData[Mkey].user_name + '"></span></div>';
							for (var SKey in msgData[Mkey].sub) {
								str2 += '<span class="user-name" style="border-left: 3px solid #6f0205;text-indent: 0.2rem;">' + msgData[Mkey].sub[SKey].user_name + '</span><p class="msg-con" style="text-indent: 0.2rem;">' + msgData[Mkey].sub[SKey].content + '</p>'
							}
							htmlStr += str1 + str2 + str3;
						}
						dom.msgList.innerHTML += htmlStr;
						document.body.style.overflow = "auto"
					}
					showMsg(result.msg);
				}.bind(this),
				error:function()
				{
					showMsg("系统繁忙");
				},
				complete : function()
				{
					this.data.loadStatus = true;
				}.bind(this)
			});
		}
		else
		{
			return;
		}
	},
	msgType:function(e)
	{
		var dom     = this.data.Dom;
		var msgInfo = this.data.Msg;
		var paren   = dom.noReply.parentNode;
		
		uid = (e != undefined) ? e.obj.dataset.on*1 : 0;
		
		if(uid == 0)
		{
			msgInfo.type    = 0;
			msgInfo.agentid = -1;
			paren.style.display = "none";
			dom.noReply.previousElementSibling.innerText = "";
			dom.msgAgent = undefined;
		}
		else
		{
			msgInfo.type    = 1;
			msgInfo.agentid = uid;
			dom.msgBlock.style.display = "block";
			paren.style.display = "block";
			dom.noReply.previousElementSibling.innerText = "@" + e.obj.dataset.name;
			dom.msgAgent = e.obj.previousElementSibling;
			document.body.style.overflow = "hidden"
		}
	}
});
</script>
</html>