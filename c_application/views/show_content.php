<!DOCTYPE html>
<html>

	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0" charset="UTF-8">
		<title>传记</title>
	</head>

	<link rel="stylesheet" href="<?php echo $inc_url;?>css/show_article.css" />
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
		.content img{
			height: auto !important;
		}
	</style>
	
	
	<body>
		<div class="author_info">
			<img src="<?=$inh_content['avatar']?>" />
			<div class="about_author">
				<div class="author_name"><?=$inh_content['nickname']?></div>
				<div class="date"><?php echo date('Y-m-d H:i',$inh_content['creation_time']);?></div>
			</div>
		</div>
		<!--编辑从这里开始-->
				<?php if($inh_content['is_power']=='1'){?>
					<div class="edit">
			            <img src="<?php echo $inc_url;?>img/edit.png" /><span><a href="edit?id=<?=$inh_content['id']?>">编辑</a></span>
			        </div>
		        <?php }?>
		<h2 class="title"><?=$inh_content['con_num']?> - <?=$inh_content['con_title']?></h1>
    	<?php if($inh_content['is_show']=='1'||$inh_content['is_power']=='1'){?>
			<div class="content"><?=$inh_content['content'];?>
				<?php if($stele_id!='0'){?>
					<button type="button" class="link_to_inh_ste">进入传承碑</button>
				<?php }?>
				
			</div>
		<?php }?>
	    
	    
	    <div class="bottom" href="<?=$inh_content['inh_id']?>" >
	    	<img src="<?php echo $inc_url;?>img/message1.png" />
	    	<span>点击评论</span>
	    </div>
	    
	    <div style="height: 52px;"></div>
	    
	</body>
	
	<script type="text/javascript" src="<?php echo $inc_url;?>js/jquery-2.1.1.min.js" ></script>
	<script>
		$(function(){
			$(".bottom").click(function(){
				var href = $(this).attr("href");
				window.location = "comment?inh_id="+href;
			});
			$(".link_to_inh_ste").height($(".link_to_inh_ste").width()*0.3358);
			$(".link_to_inh_ste").click(function(){
				window.location = "cloud?s=<?=$stele_id?>";
			});
		});
	</script>

</html>