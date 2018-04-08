<!DOCTYPE html>
<html>
	
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0" charset="UTF-8">
		<title>我的留言</title>
	</head>
	
	<link rel="stylesheet" href="<?=$inc_url?>css/my_msg.css" />
	
	<body>
		<div class="all_msg">
			<?php if(!empty($stele_note)){?>
				<?php foreach ($stele_note as $item): ?>
					<div class="msg_list">
						<div class="fl_lf">
							<span class="bg_color"></span>
							<span class="msg_date"><?=date('Y.m.d',$item['time'])?></span>
						</div>
						<div class="fl_rg">
							<img src="<?=$inc_url?>img/zan.png" />
							<span class="zan_num"><?=$item['zan_num']?></span>
						</div>
						<div class="msg_info"><?=$item['content']?></div>
					</div>
				<?php endforeach; ?>
			<?php }else{?>
				<p class="no_msg">暂无留言</p>
			<?php }?>
		</div>
	</body>
	
	<script type="text/javascript" src="<?=$inc_url?>js/jquery-2.2.3.min.js" ></script>
	<script>
		
	</script>
	
</html>
