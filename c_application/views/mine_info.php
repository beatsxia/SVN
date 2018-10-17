<?php $this -> load -> view('header'); ?>
		<title>个人中心</title>
		<link rel="stylesheet" href="<?php echo $inc_url; ?>css/mine_info.css" />
	</head>
	<body>
		<h2 class="page-title">传承碑</h2>
		<img class="title-pic" src="<?php echo $inc_url; ?>img/edit_top.jpg"/>
		<?php $this -> load -> view('navbar'); ?>
		<section class="user-info">
			<a href="javascript:void(0);" class="user-avatar">
				<img src="<?=$avatar?>" alt="" />
			</a>
			<div class="user-right">
				<h3 class="user-name"><?=$nickname?>&nbsp;<span>(已建传承碑)</span></h3>
				<div class="user-property">
					<span class="user-stone">灵石数&nbsp;:&nbsp;0</span>
					<span class="user-money">零钱&nbsp;:&nbsp;<?=$user_point?></span>
				</div>
			</div>
		</section>
		<section class="add-property">
			<a href="javascript:void(0);" @click="locaTo" data-link="recharge"><span class="add-money"></span>充值</a>
			<a href="javascript:void(0);" @click="locaTo" data-link="getstone"><span class="add-stone"></span>领取灵石</a>
		</section>
		<section class="menu">
			<ul>
				<li>
					<a href="javascript:void(0);" @click="locaTo" data-link = "exchange"><span>●</span>&nbsp;兑换</a>
				</li>
				<li>
					<a href="javascript:void(0);" @click="locaTo" data-link = "suggestions"><span>●</span>&nbsp;常见问题</a>
				</li>
				<li>
					<a href="javascript:void(0);" @click="locaTo" data-link = "about"><span>●</span>&nbsp;关于我们</a>
				</li>
			</ul>
		</section>
		<section style="height: 3rem;"></section>
	</body>
	<script type="text/javascript" src="<?php echo $inc_url; ?>js/dropload.min.js"></script>
	<script type="text/javascript" src="<?php echo $inc_url; ?>js/mine_info.js"></script>
	<script type="text/javascript">
var $num =<?=$comment_num ?>;
$(function() {
	$(".reply_me").click(function() {
		if($num == 0) {
			window.location = "reply_me_1";
		} else {
			window.location = "reply_me";
		}
	});
	
	$(".setting img").click(function(){
		window.location="about_system"
	});
	
	$(".inheritance_monument").click(function(){
		window.location="my_inher_monument"
	});
	
	$(".biography").click(function(){
		window.location="my_biogrophy"
	});
	
	$(".collection").click(function(){
		window.location="my_collection"
	});
});


$(function() {
	$(".mine_sign").click(function(){
		window.location = "set_signature?uid=<?=$uid?>";
	});
	
	$(".common_problem").click(function(){
		window.location = "suggestions";
	});
});
Page({
	data:{
		
	},
	onLoad:function()
	{
		
	},
	locaTo:function(e)
	{
		var href = e.obj.dataset.link;
		window.location = href;
	}
});



</script>
</html>
