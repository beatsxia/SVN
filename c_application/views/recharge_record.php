<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0" charset="UTF-8">
		<title>充值记录</title>
	</head>
	<style>
		*{
			padding: 0;
			margin: 0;
		}
		.this_bg {
			width: 100%;
			margin-bottom: 2.327%;
		}
		.record_cont{
			width: 100%;
			max-width: 96%;
			margin: 0 auto;
			overflow: hidden;
			margin-bottom: 2%;
		}
		.record_cont strong{
			font-size: 16px;
			letter-spacing: 0.8px;
		}
		.fl_lf{
			float: left;
			line-height: 30px;
		}
		.recharge_time{
			color: #CECECE;
			font-size: 12px;
		}
		.fl_rg{
			float: right;
		}
		.fl_rg span{
			display: inline-block;
			vertical-align: middle;
		}
	</style>
	<body>
		<img class="this_bg" src="<?=$inc_url?>img/recharge_bg2.png" />
		<?php if(!empty($select_recharge_record)){ ?>
			<?php foreach ($select_recharge_record as $item): ?>
				<div class="record_cont">
					<div class="fl_lf">
						<strong><?=$item['note']?></strong>
						<div class="recharge_time"><?=date('Y/m/d H:i:s',$item['time'])?></div>
					</div>
					<div class="fl_rg">
						<span>+ <?=$item['point']?></span>
					</div>
				</div>
			<?php endforeach; ?>
		<?php }else{ ?>
			<p style="text-align: center">暂无记录</p>
		<?php }?>
		
	</body>
	<script type="text/javascript" src="<?=$inc_url?>js/jquery-2.2.3.min.js" ></script>
	<script>
		$(function(){
			var contHgt = $(".fl_lf").height();
			$(".fl_rg").css({
				"line-height":""+contHgt+"px"
			});
		});
	</script>
</html>
