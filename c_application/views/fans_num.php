<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0" charset="UTF-8">
		<title>粉絲人數</title>
	</head>
	
	<link rel="stylesheet" href="<?php echo $inc_url;?>css/fans_num.css" />
	
	<body>
		<div class="page_fans">全部粉丝</div>
			<?php if(!empty($user_fans_arr)){?>
				<?php foreach ($user_fans_arr as $item): ?>
					<div class="fans_info">
						<div class="fans_head"><img src="<?=$item['avatar']?>" /></div>
						<div class="fans">
							<div class="fans_name"><?=$item['nickname']?></div>
							<div class="fans_style"><?=date('Y-m-d h:i:s',$item['follow_time'])?></div>
							<div class="fans_trends"><?=$item['personality_note']?></div>
						</div>
						<div class="add_fans" href="<?=$item['id']?>">
							<?php if($item['is_mutual']=='1'){?>
								<div class="mutual_concern">
								    <img src="<?php echo $inc_url;?>img/mutual_concern.png" />
								    <p><input value="相互关注" readonly="readonly" unselectable="on"/></p>
								</div>
							<?php }else{?>
								<div class="add_att">
								    <img src="<?php echo $inc_url;?>img/attention.png" />
								    <p><input value="加关注" readonly="readonly" unselectable="on"/></p>
								</div>
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
	
	<script type="text/javascript" src="<?php echo $inc_url; ?>js/jquery-2.1.1.min.js"></script>
	<script>
		$(function(){
            $(".add_fans").click(function(){
            	var href = $(this).attr("href");
            	var addFans = $(this);
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
						if(x=="关注成功"){
							addFans.children(".add_att").remove();
							addFans.html(
								"<div class='mutual_concern'>"+
								"<img src='<?php echo $inc_url;?>img/mutual_concern.png' />"+
								"<p><input value='相互关注' readonly='readonly' unselectable='on'/></p>"+
								"</div>"
							);
						}
						if(x=="取消关注成功"){
							addFans.children(".mutual_concern").remove();
							addFans.html(
								"<div class='add_att'>"+
								"<img src='<?php echo $inc_url;?>img/attention.png' />"+
								"<p><input value='加关注' readonly='readonly' unselectable='on'/></p>"+
								"</div>"
							);
						}
					}
			    });
			});
            
            
            
            
            
            
			
			
			
		});

	</script>
</html>
