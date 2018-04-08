<!DOCTYPE html>
<html>

	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0" charset="UTF-8">
		<title>充值</title>
	</head>
	<style>
		* {
			padding: 0;
			margin: 0;
		}
		
		.this_bg {
			width: 100%;
			margin-bottom: 12.327%;
		}
		
		.recharge_cash {
			width: 100%;
			max-width: 87.466%;
			margin: 0 auto;
			overflow: hidden;
			list-style: none;
		}
		
		.cash_area {
			width: 47.664%;
			font-size: 28px;
			text-align: center;
			color: #F1B422;
			margin-bottom: 4%;
		}
		
		.not_yet {
			background: url(<?=$inc_url?>img/not_yet_clicked.png) no-repeat;
			background-size: 100% 100%;
		}
		
		.clicked {
			background: url(<?=$inc_url?>img/clicked.png) no-repeat;
			background-size: 100% 100%;
		}
		
		.fl_lf {
			float: left;
		}
		
		.fl_rg {
			float: right;
		}
		
		.recharge_cash span {
			font-size: 12px;
			margin-left: 2px;
		}
		
		.sure_btn {
			text-align: center;
			width: 100%;
		}
		
		.sure_btn button {
			width: 44.14%;
			background: #65292B;
			color: #E5DADD;
			border: none;
			outline: none;
			border-radius: 5px;
			font-size: 20px;
			letter-spacing: 0.8px;
			margin: 8% 0 6% 0;
		}
		
		.recharge_record {
			text-align: center;
		}
		
		.recharge_record span {
			border-bottom: 1px #65292B solid;
			letter-spacing: 0.8px;
			color: #65292B;
			font-size: 14px;
		}
		.tips{
			font-size: 12px;
			margin-top: 1%;
			text-align: center;
			color: #a1a1a1;
			letter-spacing: 0.8px;
		}
	</style>

	<body>
		<img class="this_bg" src="<?=$inc_url?>img/recharge_bg1.png" />
		<form class="send_form" action="recharge/main" method="post" enctype="multipart/form-datas" onsubmit="return check()">
			<ul class="recharge_cash">
				<?php foreach ($recharge_goods as $key => $item): ?>
					<li class="cash_area <?=$key%2=='0'?'fl_lf':'fl_rg';?> <?=$key=='0'?'clicked':'not_yet';?> " href = "<?=$item['id']?>">
						<a><?=$item['shop_price']?></a><span>元</span>
						<span class="inp_aed"><?php if($key=='0'){echo '<input type="radio" value="'.$item['id'].'" name="good_id" checked="checked" style="display: none;" />';}?></span>
					</li>
				<?php endforeach; ?>
			</ul>
			<div class="sure_btn">
				<button class="submit">充值</button>
			</div>
			<p class="recharge_record"><span>充值记录</span></p>
			<p class="tips">温馨提示：余额充值后不支持提现</p>
		</form>
	</body>

	<script type="text/javascript" src="<?=$inc_url?>js/jquery-2.2.3.min.js"></script>
	<script>
        var checked;
		$(function() {
			var areWth = $(".cash_area").width() * 0.4194;
			$(".cash_area").height(areWth);
			$(".cash_area").css({
				"line-height": "" + areWth + "px"
			});

			$(".cash_area").click(function() {
				var $this = $(this);
				var $thA = $(this).attr("href");
				checked = $this.children(".inp_aed").empty().append(
					"<input type='radio' value=" + $thA + " name='good_id' checked='checked' style='display:none;' />"
				);
				$(this).removeClass("not_yet").addClass("clicked");
				$(".cash_area").not($(this)).removeClass("clicked").addClass("not_yet");
			});

			var btnWth = $(".sure_btn button").width() * 0.3333;
			$(".sure_btn button").height(btnWth);

			$(".recharge_record span").click(function() {
				window.location = "recharge_record";
			})

		})
		
		function check(){
			return true;
		}
	</script>

</html>