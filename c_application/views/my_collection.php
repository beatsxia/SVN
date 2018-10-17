<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0" charset="UTF-8">
		<title>我的收藏</title>
	</head>
	<style type="text/css">
		*{
			padding: 0;
			margin: 0;
		}
		#contents{
			width: 88%;
			margin: 0 auto;
			padding: 3% 0;
			display: flex;
			align-items: center;
			justify-content: flex-start;
			flex-wrap:wrap;
		}
		.content{
			width: 23%;
			text-align: center;
		    margin: 4% 0 0 0;
		    border-right: 1px #ccc solid;
		}
		.content:nth-child(3n+3) {
			border: 0 !important;
		}
		.con_item{
			width: 100%;
			overflow: hidden;
		}
		.con_item img{
			height: 100%;
		}
		.name{
			font-size: 12px;
			color: #949494;
			line-height: 22px;
		}
	</style>
	<body>
		<div id="contents">
			<?php foreach ($user_collection['content'] as $item): ?>
			<div class="content">
				<div class="con_item" inhId="<?=$item['page_id']?>" >
					<img src="<?=!empty($item['picture'])?$item['picture']:$inc_url.'img/seaside.png'?>" />
				</div>
				<p class="name"><?=$item['title']?></p>
			</div>
			<?php endforeach; ?>

			
		</div>
	</body>
	<script type="text/javascript" src="<?php echo $inc_url; ?>js/jquery-2.1.1.min.js"></script>
	<script type="text/javascript">
		$(".con_item").height($(".content").width());
		$(".con_item").css("border-radius",$(".content").width()+"px");
//		$(".content").height($(".content").width());
		$(".content").css("padding-left",($("#contents").width()-$(".content").width()*3)/6-0.5+"px");
		$(".content").css("padding-right",($("#contents").width()-$(".content").width()*3)/6-0.5+"px");

		$(function() {
            $(".con_item").click(function(){
	            var href = $(this).attr("inhId");
	            window.location = "root_new_set?inh_id="+href;
            });
		});
	</script>
</html>
