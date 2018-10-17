<?php $this -> load -> view('header'); ?>
		<title>充值记录</title>
	</head>
	<style>
		.tips{
			color: #000;
			font-size: 0.43rem;
			width: 90%;
			margin: 0 auto;
			border-bottom: 1px solid #ededed;
			font-weight: 100;
			padding-bottom: 0.3rem;
		}
		.record_cont{
			width: 90%;
			margin: 0 auto;
			overflow: hidden;
			margin-bottom: 2%;
			border-bottom: 1px solid #ededed;
			padding: 0.3rem 0;
		}
		.record_cont>div{
			height: 0.5rem;
			margin: 0.1rem 0;
		}
		.fl_top>span{
			display: block;
			font-size: 0.43rem;
			height: 100%;
			color: #000;
		}
		.fl_bom>span{
			display: block;
			font-size: 0.43rem;
			height: 100%;
			color: #ff0000;
		}
		.fl_le{
			float: left;
			text-align: left;
		}
		.fl_ri{
			float: right;
			text-align: right;
		}
	</style>
	<body>
		<h2 class="page-title"><a href="javascript:history.back(-1)"><span></span></a>充值记录</h2>
		<img class="title-pic" src="<?php echo $inc_url; ?>img/edit_top.jpg"/>
		<h3 class="tips">你在过去7天的消费记录如下:</h3>
		<?php if(!empty($select_recharge_record)){ ?>
			<?php foreach ($select_recharge_record as $item): ?>
				<div class="record_cont">
					<div class="fl_top">
						<span class="fl_le"><?=$item['note']?></span>
						<span class="fl_ri"><?=date('Y/m/d H:i:s',$item['time'])?></span>
					</div>
					<div class="fl_bom">
						<span class="fl_le">￥<?=$item['point']?></span>
						<span class="fl_ri">支付成功</span>
					</div>
				</div>
			<?php endforeach; ?>
		<?php }else{ ?>
			<p style="text-align: left;font-size: 0.43rem;width: 90%;margin: 0.5rem auto;">暂无记录</p>
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
