<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0" charset="UTF-8">
		<title>我的余额</title>
	</head>
	<style>
		*{
			padding: 0;
			margin: 0;
		}
		.this_bg{
			width: 100%;
			text-align: center;
		}
		.this_bg img{
			width: 49.5%;
		}
		.balance{
			width: 100%;
			text-align: center;
			margin-top: 20%;
		}
		.balance img{
			width: 28px;
			padding-bottom: 7px;
		}
		.balance strong{
			color: #EFB10D;
			font-size: 45px;
		}
		.mine{
			width: 100%;
			text-align: center;
			font-size: 18px;
			letter-spacing: 0.8px;
		}
		.link_to_rechart,.recharge_record{
			text-align: center;
			width: 100%;
		}
		.link_to_rechart button{
			width: 44.14%;
			background: #65292B;
			color: #E5DADD;
			border: none;
			outline: none;
			font-size: 18px;
			letter-spacing: 6px;
			margin: 40% 0 4% 0;
			border-radius: 5px;
		}
		.recharge_record span {
			border-bottom: 1px #65292B solid;
			letter-spacing: 1.14px;
			color: #65292B;
			font-size: 14px;
		}
	</style>
	<body>
		<div class="this_bg">
			<img src="<?=$inc_url?>img/my_balance_bg.png" />
		</div>
		<p class="balance">
			<img src="<?=$inc_url?>img/RMBLogo.png" />
			<strong><?=$get_user_point?></strong>
		</p>
		<p class="mine">我的余额</p>
		<div class="link_to_rechart">
			<button>去充值</button>
		</div>
		<p class="recharge_record"><span>充值记录</span></p>
	</body>
	<script type="text/javascript" src="<?=$inc_url?>js/jquery-2.2.3.min.js" ></script>
	<script>
		var btnWth = $(".link_to_rechart button").width() * 0.3333;
		$(".link_to_rechart button").height(btnWth);
		
		$(".link_to_rechart button").click(function(){
			window.location="recharge"
		});
		$(".recharge_record span").click(function(){
			window.location="recharge_record"
		});
	</script>
</html>
