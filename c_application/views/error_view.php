<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0" charset="UTF-8">
		<title>出错了</title>
		<script src="http://g.tbcdn.cn/mtb/lib-flexible/0.3.4/flexible.js"></script>
	</head>
	<style>
		*
		{
			margin: 0;
			padding: 0;
		}
		a
		{
			text-decoration: none;
		}
		a:hover
		{
			text-decoration: none;
		}
		.left
		{
			float: left;
		}
		.right
		{
			float: right;
		}
		.clearfloat::after
		{
			display: block;
			content: '';
			height: 0;
			visibility: hidden;
			clear: both;
		}
		html,body
		{
			height: 100%;
			background-color: #ededed;
		}
		.back
		{
			width: 100%;
			height: auto;
			position: relative;
			background-color: #ededed;
		}
		.back>span
		{
			display: block;
			font-size: 1.5rem;
			text-align: center;
			height: 3rem;
			line-height: 3rem;
			font-weight: 100;
			color: #888;
		}
		.back>.msg
		{
			text-align: center;
			font-size: 0.6rem;
			color: #666;
		}
		.downtext
		{
			text-align: center;
			font-size: 0.5rem;
			margin-top: 0.5rem;
			color: #b3bad1;
		}
		#times
		{
			color: #b3bad1;
		}
		#jump
		{
			display:block;
			width: 3rem;
			height: 1rem;
			margin: 1rem auto;
			line-height: 1rem;
			text-align: center;
			font-size: 0.4rem;
			background-color: white;
			box-shadow: 0 1px 6px #999;
			color: #cbcdd5;
			border-radius: 10px;
		}
	</style>

	<body style="">
		<div class="back">
			<span>╮(╯▽╰)╭</span>
			<p class="msg"><?=$msg;?></p>
			<p class="downtext"><span id="times">5</span> 秒后为你跳转到上一页</p>
			<a href="javascript:void(0);" onclick="jump()" id="jump">立即跳转</a>
		</div>
	</body>
	<script type="text/javascript">
		window.onload = function(){
			var times = 5;
			var t1 = setInterval(function(){
				document.getElementById("times").innerText = times;
				times--;
				if(times == -1){
					window.clearInterval(t1);
					window.history.go(-1);
				}
			},1000);
			
		}
		function jump()
		{
			window.history.go(-1);
		}
		
	</script>
</html>
