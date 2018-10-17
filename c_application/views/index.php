<?php $this -> load -> view('header'); ?>
		<title>傳承碑</title>
		<link rel="stylesheet" href="<?php echo $inc_url; ?>css/bootstrap.min.css" />
		<link rel="stylesheet" href="<?php echo $inc_url; ?>css/index.css" />
	</head>

	

	<body>
		<div id="page">
			<?php $this -> load -> view('navbar'); ?>
			<section class="top"></section>
			<section id="banner">
				<a href="javascript:void(0);" class="ban-item">
					<img class="ban-pic" src="<?php echo $inc_url; ?>img/index/banner1.jpg" alt="" />
				</a>
			</section>
			<a id="switch" @click="chanList" href="javascript:void(0);" class="pub" data-on = "pub"></a>
			<section class="list">
				<div id="pubLife" class="clearfloat">
					<?php foreach($rolling_content_arr as $k => $v){?>
					<div class="list-item">
						<a href="javascript:void(0);" class="item-info" inhId="<?=$v['article']['id']?>">
							<img class="item-pic" src="<?=$v['picture'];?>"/>
							<span class="item-title"><?=$v["title"];?></span>
						</a>
						<ul class="icon-list">
							<li class="icon-item"><a href="javascript:void(0);" class="inh-msg" inhId="<?=$v['inh_id']?>" style="background-image: url('<?php echo $inc_url; ?>img/index/icon/msg.png');"></a></li>
							<li class="icon-item"><a href="javascript:void(0);" style="background-image: url('<?php echo $inc_url; ?>img/index/icon/live.png');"></a></li>
							<li class="icon-item"><a href="javascript:void(0);" class="inh-collect" id="inhId<?=$v['inh_id']?>" inhId="<?=$v['inh_id']?>" style="background-image: url('<?php echo $inc_url; ?>img/index/icon/<?=$v['collect_img']?>');"></a></li>
							<li class="icon-item"><a href="javascript:void(0);" style="background-image: url('<?php echo $inc_url; ?>img/index/icon/share.png');"></a></li>
						</ul>
					</div>
					<?php } ?>
				</div>
				<div id="priLife" class="clearfloat" style="display: none;">
					<?php if(empty($uid)){?>
					<div style="width: 100%;color: #ccc;font-size: 1rem;text-align: center;">请先登录</div>	
					<?php }else{?>
					<div class="list-item" style="color: #c3c3c3;text-align: center;font-size: 0.5rem;">
						<a class="new-life" href="javascript:void(0);">+</a>
						新建传记
					</div>
					<?php foreach($private_inherit as $k2 => $v2){?>
					<div class="list-item">
						<a href="javascript:void(0);" class="item-info" inhId="<?=$v2['article']['id']?>">
							<img class="item-pic" src="<?=$v2['picture'];?>"/>
							<span class="item-title"><?=$v2["title"];?></span>
						</a>
						<ul class="icon-list">
							<li class="icon-item"><a href="javascript:void(0);" class="inh-msg" inhId="<?=$v2['id']?>" style="background-image: url('<?php echo $inc_url; ?>img/index/icon/msg.png');" ></a></li>
							<li class="icon-item"><a href="javascript:void(0);" style="background-image: url('<?php echo $inc_url; ?>img/index/icon/live.png');"></a></li>
							<li class="icon-item"><a href="javascript:void(0);" class="inh-collect" id="inhId<?=$v['inh_id']?>" inhId="<?=$v2['id']?>" style="background-image: url('<?php echo $inc_url; ?>img/index/icon/<?=$v2['collect_img']?>');"></a></li>
							<li class="icon-item"><a href="javascript:void(0);" style="background-image: url('<?php echo $inc_url; ?>img/index/icon/share.png');"></a></li>
						</ul>
					</div>
					<?php }} ?>
				</div>
			</section>
		</div>
	</body>

	<script type="text/javascript" src="<?php echo $inc_url; ?>js/jquery-2.1.1.min.js"></script>
	<script type="text/javascript" src="<?php echo $inc_url; ?>js/bootstrap.min.js"></script>
	<script>
		$(function() {
            $(".item-info").click(function(){
	            var href = $(this).attr("inhId");
	            //window.location = "root_new_set?inh_id="+href;
	            window.location = "show_content?cid="+href;
            });
            $(".inh-msg").click(function(){
	            var href = $(this).attr("inhId");
	            window.location = "comment?inh_id="+href;
            });
		});
		$(function(){
			$(".dynamics").click(function(){
				window.location = "more";
			});
		});
		$(function(){
			$(".inh-collect").click(function(){
				var inhId = $(this).attr("inhId");
				$.ajax({
		            url: "service/main/inh_collection",
		            type: "POST",
		            dataType: "json",
		            data: {
		            	inh_id:inhId,
		            },
		            async: true,
		            success: function (data) {
		                alert(data.hint); 
						if(data.code=='1'){
							$('#inhId'+inhId).css("background-image","url(<?php echo $inc_url;?>img/index/icon/" + data.return.img + ")");
						}
		            },
		            error:function(){
		                alert('收藏失败');
		            }
		        });
			});
		});
		$(function(){
			$(".new-life").click(function(){
				//window.location = "edit_new_heritage";
				window.location = "edit?id=-1";
			});
		});
		Page({
			data:
			{
				Dom:
				{
					pubLife : document.getElementById("pubLife"),
					priLife : document.getElementById("priLife")
				}
			},
			onLoad:function()
			{
				
			},
			chanList:function(e)
			{
				var target = e.obj;
				var dom    = this.data.Dom;
				var on     = (target.dataset.on == "pub") ? "pri" : "pub";
				target.className = on;
				dom.pubLife.style.display = (on == "pub") ? "block" : "none";
				dom.priLife.style.display = (on == "pri") ? "block" : "none";
				target.dataset.on = on;
			}
		});
	</script>
</html>