<!DOCTYPE html>
<html>

	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0" charset="UTF-8">
		<title>留言相册</title>
	</head>
	<style>
		* {
			padding: 0;
			margin: 0;
		}
		
		body {
			width: 100%;
		}
		
		.msg_cont {
			width: 94%;
			margin: 0 auto;
		}
		
		.msg_cont:not(:first-child){
			border-top: 1px solid #cdcdcd;
		}
		
		.cont_head {
			overflow: hidden;
			margin-top: 6%;
			margin-bottom: 2%;
		}
		
		.writer_head {
			float: left;
			overflow: hidden;
			margin-right: 2%;
		}
		
		.writer_head img {
			width: 30px;
			height: 30px;
			border-radius: 30px;
			margin-top: 6px;
		}
		
		.writer_info {
			float: left;
			line-height: 22px;
		}
		
		.writer_name {
			font-size: 15px;
		}
		
		.write_time {
			font-size: 12px;
			color: #a1a1a1;
		}
		
		.write_time span{
			color: #65332a !important;
		}
		
		.msg_pic {
			background: #737373;
			width: 100%;
			overflow: hidden;
			position: relative;
		}
		
		.show_pic,.show_pic2 {
			text-align: center;
			color: #FCFCFC;
			font-size: 70px;
			display: flex;
			justify-content: center;
			align-content: center;
			background: #737373;
		}
		
		
		.zan{
			width: 100%;
			height: 14.286%;
			background-color: rgba(9, 9, 9, 0.35);
			position: absolute;
			z-index: 1;
			bottom: 0;
		}
		.zan img{
			position: absolute;
			width: 18px;
			left: 3%;
		}
		
		.zan span{
			position: absolute;
			font-size: 15px;
			color: white;
			left: 10.63%;
		}
		.msg_word{
			font-size: 15px;
			letter-spacing: 0.8px;
			line-height: 22px;
			margin: 2% 0;
		}
		.msg_word span{
			width: 2px;
			height: 2px;
			border-radius: 2px;
			background: black;
			margin-right: 2%;
			display: inline-block;
			vertical-align: middle;
		}
		.give_like{
			width: 100%;
			margin-bottom: 2%;
		}
		.give_like img,.give_like span{
			display: inline-block;
			vertical-align: middle;
		}
		.give_like img{
			margin-left: 3%;
			width: 18px;
		}
		.cont_middle textarea{
			width: 94%;
			margin: 0 auto;
			display: block;
			line-height: 22px;
			border-radius: 5px;
			outline: none;
			resize: none;
			padding: 1% 2%;
			margin-top: 3%;
			border: 1px #d3d3d3 solid;
			letter-spacing: 0.8px;
			font-size: 13px;
		}
		::-webkit-input-placeholder {
			color: #B8B8B8;
		}
		
		:-moz-placeholder {
			color: #B8B8B8;
		}
		
		::-moz-placeholder {
			color: #B8B8B8;
		}
		
		:-ms-input-placeholder {
			color: #B8B8B8;
		}
		
		::placeholder {
			color: #B8B8B8;
		}
		.btn_sub{
			background: #65332a;
			color: #FEF9F3;
			font-size: 12px;
			border: 0;
			outline: none;
			width: 25.127%;
			letter-spacing: 3px;
			border-radius: 5px;
			display: block;
			margin: 5% auto;
			text-align: center;
		}
	</style>

	<body>
		<div class="msg_cont">
			<div class="cont_head">
				<div class="writer_head">
					<img src="<?=$user_info['avatar']?>" />
				</div>
				<div class="writer_info">
					<p class="writer_name"><?=$user_info['nickname']?></p>
					<p class="write_time"><?=date('Y年m月d日  H:i',time())?></p>
				</div>
			</div>
			<?php echo form_open_multipart('msg_alb/new_msg',array('method' => 'post', 'name' => 'msg_form', 'class' => 'msg_form', 'onsubmit' => 'return check()'));?>
				<input type="hidden" name="stele_id" value="<?=$stele_id?>" />
				<div class="cont_middle">
					<div class="msg_pic">
						<div class="show_pic">
							<span>+</span>
							<img id="preview" src="" />
						</div>
						<div class="zan">
							<img class="like_logo" src="<?=$inc_url?>img/like_logo1.png" href="1" />
						</div>
						<input type="file" name="file" id="myFile" onchange="imgPreview(this)" style="display: none;" />
						<!-- <input type="hidden" id="pic_data" name="pic_data" value="" /> -->
					</div>
					<textarea name="msg_word" rows="4" wrap="hard" maxlength="100" autofocus="autofocus" placeholder="点击输入内容，100字以内。"></textarea>
				</div>
				<button type="submit" class="btn_sub">提交</button>
			</form>
		</div>
		<?php if(!empty($get_note_info)){?>
			<?php foreach ($get_note_info as $item): ?>
				<?php if(!empty($item['picture'])){?>
					<div class="msg_cont">
						<div class="cont_head">
							<div class="writer_head">
								<img src="<?=$item['avatar']?>" />
							</div>
							<div class="writer_info">
								<p class="writer_name"><?=$item['nickname']?></p>
								<p class="write_time"><?=date('Y年m月d日  H:i',$item['time'])?>&nbsp;&nbsp;&nbsp;<?php if($item['power']!='0'){?><span href="<?=$item['id']?>">删除</span><?php }?></p>
							</div>
						</div>
						<div class="cont_middle">
							<div class="msg_pic">
								<div class="show_pic2">
									<img src="<?=$item['picture']?>" />
								</div>
								<div class="zan">
									<?php if($item['is_zan']=='0'||$item['is_zan']=='-1'){?>
										<img class="like_logo lk_or_not like_logo1" src="<?=$inc_url?>img/like_logo1.png" href="<?=$item['id']?>" />
									<?php }elseif($item['is_zan']=='1'){?>
										<img class="like_logo lk_or_not like_logo3"  src="<?=$inc_url?>img/like_logo3.png" href="<?=$item['id']?>" />
									<?php }?>
									<span><?=$item['zan_num']?></span>
								</div>
							</div>
							<p class="msg_word"><span></span><?=$item['content']?></p>
						</div>
					</div>
				<?php }else{?>
					<div class="msg_cont">
						<div class="cont_head">
							<div class="writer_head">
								<img src="<?=$item['avatar']?>" />
							</div>
							<div class="writer_info">
								<p class="writer_name"><?=$item['nickname']?></p>
								<p class="write_time"><?=date('Y年m月d日  H:i',$item['time'])?>&nbsp;&nbsp;&nbsp;<?php if($item['power']!='0'){?><span href="<?=$item['id']?>">删除</span><?php }?></p>
							</div>
						</div>
						<p class="msg_word"><span></span><?=$item['content']?></p>
						<div class="give_like">
							<?php if($item['is_zan']=='0'||$item['is_zan']=='-1'){?>
							    <img class="like_logo lk_lg like_logo2" src="<?=$inc_url?>img/like_logo2.png" href="<?=$item['id']?>" />
							<?php }elseif($item['is_zan']=='1'){?>
							    <img class="like_logo lk_lg like_logo3" src="<?=$inc_url?>img/like_logo3.png" href="<?=$item['id']?>" />
							<?php }?>
							<span><?=$item['zan_num']?></span>
						</div>
					</div>
				<?php }?>
			<?php endforeach; ?>	
		<?php }?>
	</body>
	<script type="text/javascript" src="<?=$inc_url?>js/jquery-2.2.3.min.js"></script>
	<script>
		var i = 0;
		$(".msg_pic").height($(window).height() * 0.3173);
		$(".show_pic img").height($(window).height() * 0.3173);
		$(".show_pic2 img").height($(window).height() * 0.3173);
		$(".show_pic span").css("line-height", $(".msg_pic").height() + "px");
		$(".show_pic2 span").css("line-height", $(".msg_pic").height() + "px");
		$(".zan img").css("top", ($(".zan").height()-$(".zan img").height())/2 + "px");
		$(".btn_sub").height($(window).height()*0.0467);
		
		$(".zan span").css("line-height", $(".zan").height()-2 + "px");
		$(".lk_or_not").click(function(){
			var $this = $(this);
			var href = $(this).attr("href");
			$.ajax({
				type:"post",
				url:"init/note_star",
				async:true,
				data:{
					note_id:href
				},
				success:function(data){
					if(data=="1"){
						alert("点赞成功！");
						$this.removeClass("like_logo1").addClass("like_logo3").attr("src","<?=$inc_url?>img/like_logo3.png");
						var txt = $this.parent(".zan").children("span").text();
						var txtps = parseInt(txt);
						$this.parent(".zan").children("span").text('').append(txtps+1);
					}
					if(data=="2"){
						alert("取消赞成功！");
						$this.removeClass("like_logo3").addClass("like_logo1").attr("src","<?=$inc_url?>img/like_logo1.png");
						var txt = $this.parent(".zan").children("span").text();
						var txtps = parseInt(txt);
						$this.parent(".zan").children("span").text('').append(txtps-1);
					}
					if(data=="0"){
						alert("操作失败！");
					}
				},
				error:function(e){
					console.log("操作失败！")
				}
			});
		});
		$(".lk_lg").click(function(){
			var $this = $(this);
			var href = $(this).attr("href");
			$.ajax({
				type:"post",
				url:"init/note_star",
				async:true,
				data:{
					note_id:href
				},
				success:function(data){
					if(data=="1"){
						alert("点赞成功！");
						$this.removeClass("like_logo2").addClass("like_logo3").attr("src","<?=$inc_url?>img/like_logo3.png");
						var txt = $this.parent(".give_like").children("span").text();
						var txtps = parseInt(txt);
						$this.parent(".give_like").children("span").text('').append(txtps+1);
					}
					if(data=="2"){
						alert("取消赞成功！");
						$this.removeClass("like_logo3").addClass("like_logo2").attr("src","<?=$inc_url?>img/like_logo2.png");
						var txt = $this.parent(".give_like").children("span").text();
						var txtps = parseInt(txt);
						$this.parent(".give_like").children("span").text('').append(txtps-1);
					}
					if(data=="0"){
						alert("操作失败！");
					}
				},
				error:function(e){
					console.log("操作失败！")
				}
			});
		});
		
		
		
		$(".write_time span").click(function(){
			var $this = $(this);
			var val = $(this).attr("href");
//			console.log(val)
			$.ajax({
				type:"post",
				url:"init/delete_info",
				async:true,
				dataType:"json",
				data:{
					type : "note",
					value : val
				},
				success:function(data){
					console.log(data.code);
					var pst = JSON.parse(data.code);
					console.log(pst);
					if(pst=="0"){
						alert("删除失败！")
					}
					if(pst=="1"){
						$this.parent().parent().parent().parent().remove();
						alert("删除成功！")
					}
				},
				error:function(e){
					console.log("操作失败！")
				}
			});
		});
		
		
		
		

		function imgPreview(fileDom) {
			//判断是否支持FileReader
			if(window.FileReader) {
				var reader = new FileReader();
			} else {
				alert("您的设备不支持图片预览功能，如需该功能请升级您的设备！");
			}

			//获取文件
			var file = fileDom.files[0];
			var imageType = /^image\//;
			//是否是图片
			if(!imageType.test(file.type)) {
				alert("请选择图片！");
				return;
			}
			//读取完成
			reader.onload = function(e) {
				//获取图片dom
				var img = document.getElementById("preview");
				//图片路径设置为读取的图片
				img.src = e.target.result;
//				$("#pic_data").val(e.target.result)
			};
			reader.readAsDataURL(file);
			$(".msg_pic").css("background","white");
			$(".show_pic span").text('');
		}
		$(".show_pic").click(function() {
			$("#myFile").trigger("click");
		});
		function check(){
			if($("#myFile").val()!=''|| $(".cont_middle textarea").val()!=""){
				return true;
            }else{
            	alert("请上传图片/输入内容！");
            	return false;
            }
		}
	</script>

</html>