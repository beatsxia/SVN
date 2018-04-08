<!DOCTYPE html>
<html>

	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0" charset="UTF-8">
		<title>傳承新建</title>
	</head>

	<link rel="stylesheet" href="<?=$inc_url?>css/root_new_set.css" />

	<body>
		<img class="root_new_set_bg" src="<?=$inc_url?>img/root_new_set_bg.jpg" />
		<p class="organizer"><span><?=$inherit['title']?></span></p>
		<div class="invite_background">邀请</div>
		<?php foreach ($inherit_contents_arr as $item): ?>
			<?php if($item['is_show']=='1'||$item['is_power']=='1'){?>
				<div class="new_set_main">
					<div class="heritage_title_info">
						<div class="heritage_num" href="<?=$item['id'] ?>">
							<input type="text" name="heritage_num" value="<?=$item['con_num']?>" readonly="readonly" />
						</div>
						<div class="heritage_section_title" href="<?=$item['id'] ?>">
							<input type="text" name="heritage_section_title" value="<?=$item['con_title']?>" readonly="readonly" />
						</div>
					</div>
					<div class="organizer_info">
						<div class="edit" href="<?=$item['id'] ?>">
							<img src="<?=!empty($item['avatar'])?$item['avatar']:$inc_url.'img/user_head.png'?>" class="organizer_head" /><span><?=$item['nickname']?></span>
							<?php if($item['is_power']=='1'){?>
								<img src="<?=$inc_url?>img/edit.png" class="edit_sign" /><span>编辑</span>
							<?php }else{?>
								<?php echo date('m-d H:i',$item['content_time']);?>
							<?php }?>
						</div>
					</div>
				</div>
			<?php }?>
		<?php endforeach; ?>
		<?php if($inh_power =='1'){?>
			<div class="heritage_add_btn">添加</div>
		<?php }?>
	</body>

	<script type="text/javascript" src="<?=$inc_url?>js/jquery-2.2.3.min.js"></script>
	<script>
	    $(function(){
	    	$(".edit span").click(function(){
	    		var href = $(".edit").attr("href");
	    		window.location="edit?id="+href;
	    	});
	    	
	    	$(".heritage_add_btn").click(function(){
	    		window.location="edit_new_heritage?inh_id=<?=$inherit['id']?>"
	    	});
	    	$(".heritage_num").click(function(){
	    	    var href = $(this).attr("href");
	    	    window.location = "show_content?cid=" + href;
	    	});
	    	$(".heritage_section_title").click(function(){
	    	    var href = $(this).attr("href");
	    	    window.location = "show_content?cid=" + href;
	    	});
		    $(".invite_background").click(function(){
		    	$.get("inh_ercode?inh_id=<?=$inherit['id']?>",function(){
		    		alert(" 邀请函已通过公众号发送至您的微信，请返回公众号查看");
		    	});
		    });
	    })	
	</script>

</html>