<!DOCTYPE html>
<html>

	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0" charset="UTF-8">
		<title>留言相册</title>
	</head>
	<style>
		* {
			padding: 0;
			margin: 0;
		}
		
		body {
			width: 100%;
		}
		
		.msg_cont {
			width: 94%;
			margin: 0 auto;
		}
		.msg_cont:not(:first-child){
			border-top: 1px solid #cdcdcd;
		}
		
		.cont_head {
			overflow: hidden;
			margin-top: 6%;
			margin-bottom: 2%;
		}
		
		.writer_head {
			float: left;
			overflow: hidden;
			margin-right: 2%;
		}
		
		.writer_head img {
			width: 30px;
			height: 30px;
			border-radius: 30px;
			margin-top: 6px;
		}
		
		.writer_info {
			float: left;
			line-height: 22px;
		}
		
		.writer_name {
			font-size: 15px;
		}
		
		.write_time {
			font-size: 12px;
			color: #a1a1a1;
		}
		
		.msg_pic {
			background: #737373;
			width: 100%;
			overflow: hidden;
			position: relative;
		}
		
		.show_pic {
			text-align: center;
			color: #FCFCFC;
			font-size: 70px;
		}
		
		.show_pic img {
			width: 100%;
			max-height: 100%;
		}
		
		.zan {
			width: 100%;
			height: 14.286%;
			background-color: rgba(9, 9, 9, 0.35);
			position: absolute;
			z-index: 1;
			bottom: 0;
		}
		
		.zan img {
			position: absolute;
			width: 18px;
			left: 3%;
		}
		.zan span{
			position: absolute;
			font-size: 15px;
			color: white;
			left: 10.63%;
		}
		.msg_word{
			font-size: 15px;
			letter-spacing: 0.8px;
			line-height: 22px;
			margin: 2% 0 5% 0;
		}
		.msg_word span{
			width: 2px;
			height: 2px;
			border-radius: 2px;
			background: black;
			margin-right: 2%;
			display: inline-block;
			vertical-align: middle;
		}
		.give_like{
			width: 100%;
		}
		.give_like img,.give_like span{
			display: inline-block;
			vertical-align: middle;
		}
		.give_like img{
			margin-left: 3%;
			width: 18px;
		}
	</style>

	<body>
		<div class="msg_cont">
			<div class="cont_head">
				<div class="writer_head">
					<img src="<?=$inc_url?>img/seaside.png" />
				</div>
				<div class="writer_info">
					<p class="writer_name">Happy</p>
					<p class="write_time">2017年01月01日&nbsp;&nbsp;16:29</p>
				</div>
			</div>
			<div class="cont_middle">
				<div class="msg_pic">
					<div class="show_pic">
						<img src="<?=$inc_url?>img/seaside.png" />
					</div>
					<div class="zan">
						<img class="like_logo like_logo1" src="<?=$inc_url?>img/like_logo1.png" href="1" />
						<img class="like_logo like_logo2" style="display: none;" src="<?=$inc_url?>img/like_logo2.png" href="2" />
						<input type="hidden" name="like_logo" value="1" />
						<span>1</span>
					</div>
				</div>
				<p class="msg_word"><span></span>今天天气真好！</p>
			</div>
		</div>
		<div class="msg_cont">
			<div class="cont_head">
				<div class="writer_head">
					<img src="<?=$inc_url?>img/seaside.png" />
				</div>
				<div class="writer_info">
					<p class="writer_name">Happy</p>
					<p class="write_time">2017年01月01日&nbsp;&nbsp;16:29</p>
				</div>
			</div>
			<p class="msg_word"><span></span>今天天气真好！</p>
			<div class="give_like">
				<img class="like_logo like_logo2" src="<?=$inc_url?>img/like_logo2.png" href="2" />
				<span>5</span>
			</div>
		</div>
	</body>
	<script type="text/javascript" src="<?=$inc_url?>js/jquery-2.2.3.min.js"></script>
	<script>
		var i = 0;
		$(".msg_pic").height($(window).height() * 0.3173);
		$(".msg_pic").css("line-height", $(".msg_pic").height() * 0.8491 + "px");
		$(".zan img").css("top", ($(".zan").height() - $(".zan img").height()) / 2 + "px");
		$(".zan span").css("line-height", $(".zan").height()-1 + "px");
		$(".like_logo").click(function(){
			$(".like_logo").toggle();
		});
	</script>

</html>