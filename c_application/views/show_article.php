<!DOCTYPE html>
<html>

	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0" charset="UTF-8">
		<title>傳記</title>
	</head>

	<link rel="stylesheet" href="<?php echo $inc_url;?>css/show_article.css" />
	
	
	<body>
		<div class="author_info">
			<img src="<?=$avatar?>" />
			<div class="about_author">
				<div class="author_name"><?=$nickname;?></div>
				<div class="date"><?php echo date('Y-m-d H:i',$inherit['add_time']);?></div>
			</div>
		</div>
		<h2 class="title"><?=$inherit['title']?></h1>
	    <?php foreach ($inherit_contents_arr as $item): ?>
	    	<?php if($item['is_show']=='1'||$item['is_power']=='1'){?>
				<div class="content"><?=$item['content'];?>
					<!--编辑从这里开始-->
					<?php if($item['is_power']=='1'){?>
						<div class="edit">
				            <img src="<?php echo $inc_url;?>img/edit.png" /><span><a href="edit?id=<?=$item['id']?>">编辑</a></span>
				        </div>
			        <?php }?>
				</div>
			<?php }?>
	    <?php endforeach; ?>
	    
	    
	    <div class="bottom" href="<?=$inherit['id']?>" >
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
		});

		var second = 0;
		window.setInterval(function () {
		    second ++;
		}, 1000);
		window.onbeforeunload = function() {
			$.ajax({
		        type: "POST",
		        url: "show_article/log",
		        data: {
			            inh_url : location.href,
			            access_page : <?=$inherit['id']?>,
			            time : second,
			            inh_uid : <?=$inh_uid?>,
			            refer_url : getReferrer(),
			            timeIn : (Date.parse(new Date()))/1000,
			            timeOut : (Date.parse(new Date()) + (second * 1000))/1000
			         },
		        cache: false
		    });
		};
		function getReferrer() {
		    var referrer = '';
		    try {
		        referrer = window.top.document.referrer;
		    } catch(e) {
		        if(window.parent) {
		            try {
		                referrer = window.parent.document.referrer;
		            } catch(e2) {
		                referrer = '';
		            }
		        }
		    }
		    if(referrer === '') {
		        referrer = document.referrer;
		    }
		    return referrer;
		}
	</script>

</html>