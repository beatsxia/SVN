<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0" charset="UTF-8">
		<title>评论</title>
	</head>
	
	<link rel="stylesheet" href="<?php echo $inc_url;?>css/comment.css" />
	
	<body>
		<div class="comments"><span>评论</span><a><?=$comment_num?></a></div>
		<?php foreach ($comments as $item): ?>
		<div class="comments_info_bg">
				<div class="comments_info">
					<div class="comments_info_left">
						<img src="<?=$item['avatar']?>" />
					</div>
					<div class="comments_info_right">
						<div class="username">
							<div class="fl_lf"><?=$item['user_name']?></div> 
						    <div class="fl_rg"><img class="comment_top" href="<?=$item['id']?>" src="<?php echo $inc_url;?>img/message1.png" /></div>
						</div>
						<div class="time"><?=date('m-d H:s',$item['time'])?></div>
						<?php if($item['comment_id']!='0'){?>
							<div class="info">回复 <a href="#"><?=$item['comment_id_name']?></a>：<?=$item['content']?></div>
						<?php }else{?>
							<div class="info"><?=$item['content']?></div>
						<?php }?>
					</div>
				</div>
		</div>
		<?php endforeach; ?>

		<?php echo form_open('comment/main', array('id' => "comment_bottom", 'onsubmit' => "return check()", 'enctype' => "multipart/form-datas")); ?>
			<textarea class="txt" name="comment" maxlength="80"></textarea>
			<button type="submit">发送</button>
			<input type="hidden" name="comment_type" id="comment_type" value="" />
			<input type="hidden" name="comment_cc_id" id="" value="<?=$inh_id?>" />
			<input type="hidden" name="comment_father_id" id="comment_father_id" value="" />
		</form>
		
		<div class="bottom">
	    	<img src="<?php echo $inc_url;?>img/message1.png" />
	    	<span>点击评论</span>
	    </div>
	    
	    <div style="height: 52px;"></div>
	</body>

	<script type="text/javascript" src="<?=$inc_url; ?>js/jquery-2.1.1.min.js" ></script>
	<script type="text/javascript">
		window.onload = function(){
			
			document.querySelector(".bottom").onclick = function(){
				var comment = document.getElementById("comment_bottom");
				var infos = document.getElementsByClassName("comments_info_bg");
     			comment.style.display="block";
     			if(infos.length>2){
     				document.querySelector("#comment_bottom").scrollIntoView(true);
     			}else{
     				document.querySelector("#comment_bottom").scrollIntoView(false);
     			}
     			
     			$(".txt").attr("placeholder","评论").focus();

     			
     			$("#comment_type").val('0'); //评论传记  设置comment_type 为 0
     			$("#comment_father_id").val('0');//评论传记  重置comment_father_id 为 0
			}
			$(".comment_top").click(function(){
				var href = $(this).attr("href");
				var comment = document.getElementById("comment_bottom");
				var infos = document.getElementsByClassName("comments_info_bg");
     			comment.style.display="block";
     			if(infos.length>2){
     				document.querySelector("#comment_bottom").scrollIntoView(true);
     			}else{
     				document.querySelector("#comment_bottom").scrollIntoView(false);
     			}
                $(".txt").attr("placeholder","回复小明:").focus();

     			$("#comment_type").val('1'); //评论其他用户评论  设置comment_type 为 1
     			var comment_father_id = $(this).attr("href"); //获取被用户评论的id
     			$("#comment_father_id").val(comment_father_id);//评论其他用户评论  设置comment_father_id 
			});

		}
		
		function check(){
			if($(".txt").val()==""){
				alert("评论框不能为空！");
				return false;
			}else{
				return true;
			}
		}
	</script> 
</html>
