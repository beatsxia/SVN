<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0" charset="UTF-8">
		<title>关注人数</title>
	</head>
	
	<link rel="stylesheet" href="<?php echo $inc_url;?>css/concern_num.css" />
	
	<body>
		<div class="all_concern">全部关注</div>
		<?php if(!empty($user_follow_arr)){?>
			<?php foreach ($user_follow_arr as $item): ?>
				<div class="concern_info">
					<div class="concern_head"><img src="<?=$item['avatar']?>" /></div>
					<div class="concern">
						<div class="concern_name"><?=$item['nickname']?></div>
						<div class="concern_trends"><?=$item['personality_note']?></div>
					</div>
					<div class="add_concern" href = "<?=$item['id']?>">
						<?php if($item['is_mutual']=='1'){?>
							<img src="<?php echo $inc_url;?>img/mutual_concern.png" />
							<p class="mutual_concern">相互关注</p>
						<?php }else{?>
							<img src="<?php echo $inc_url;?>img/concerned.png" />
							<p class="concerned">已关注</p>
						<?php }?>
					</div>
				</div>
			<?php endforeach; ?>
		<?php }else{?>
			<div class="tips">
			    <p>暂无粉丝</p>
		    </div>
		<?php }?>
	</body>
	<script type="text/javascript" src="<?php echo $inc_url;?>js/jquery-2.1.1.min.js" ></script>
	<script>
		$(".add_concern").click(function(){
			var href = $(this).attr("href");
			$.ajax({
		        type: "POST",
		        url: "init/follow",
		        data: {
			            user_id : href
			         },
		        dataType: "json",
				async: true,
				success: function(result) {
					var x;
					switch (result)
					{
					case 0:
					  x="操作失败";
					  break;
					case 1:
					  x="关注成功";
					  break;
					case 2:
					  x="取消关注成功";
					  break;
					default :
					  x="操作失败"; 
					}
					alert(x);
					window.location = "concern_num";
				}
		    });
		});
	</script>
</html>