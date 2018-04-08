<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0" charset="UTF-8">
		<title>訪問人數</title>
	</head>
	
	<link rel="stylesheet" href="<?php echo $inc_url;?>css/visitor_num.css" />
	
	<body>
		<div class="page_view">
		    总浏览量：<a><?=$inh_access_log_totle?></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;今日浏览量：<a><?=$inh_access_log_num?></a>
		</div>
		<div class="which_day">今天</div>
		<?php if(!empty($inh_access_log)){?>
		    <?php foreach ($inh_access_log as $item): ?>
			    <div class="visitor_info">
				    <div class="visitor_head"><img src="<?=$item['avatar']?>" /></div>
				    <div class="visitor">
					    <div class="visitor_name"><?=$item['nickname']?></div>
					    <div class="visited_time"><?=date('H:i',$item['access_time'])?> 查看 <?=$item['title']?></div>
				    </div>
			    </div>
		    <?php endforeach; ?>
		<?php }else{?>
			<div class="tips">
			    <p>暂无访客</p>
		    </div>
		<?php }?>
	</body>
</html>

