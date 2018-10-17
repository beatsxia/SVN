<?php $this -> load -> view('header'); ?>
		<title>充值</title>
	</head>
	<style>
		* {
			padding: 0;
			margin: 0;
		}
		body{
			background: none;
			background-color: white;
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
			height: 2.5rem !important;
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
			margin-bottom: 8%;
			text-align: center;
			color: #a1a1a1;
			letter-spacing: 0.8px;
		}
		.cash{
			margin:0.4rem 0 !important;
			height: 0.75rem !important;
		}
		.cash>a{
			display: block;
			height: 100%;
			text-align: center;
			line-height: 0.75rem;
		}
		.cash_area img{
			height: 100%;
		}
		.imag_{
			display: flex;
			align-items: center;
			justify-content: center;
			height: 23%;
		}
		.vip{
			width: 100%;
			height: 2.8rem !important;
			background: url("<?=$inc_url?>img/recharge/vipBg.png") no-repeat;
			background-size: 100% 100%;
			position: relative;
		}
		#vipOn{
			display: none;
			background-image: url("<?=$inc_url?>img/yes.png");
			width: 0.75rem;
			height: 1rem;
			background-size: 100% 100%;
			position:absolute;
			bottom: 0;
			right: 0;
		}
		.tips{
			display: block;
			width: 5.4rem;
			margin: 0 auto;
		}
		.stone-num{
			height: 0.5rem;
			display: inline-block;
			background-color: #fbce8b;
			border-radius: 8px;
			padding-left: calc(9px + 0.5rem);
			padding-right: 9px;
			line-height: 0.5rem;
			border: 1px solid #630002;
			box-shadow: 0 0 3px #fff inset;
			color: #000;
			background-image: url("<?=$inc_url?>img/index/stone_s.png");
			background-size: 0.5rem;
			background-repeat: no-repeat;
			background-position: 8px center;
			font-size: 0.31rem;
		}
	</style>

	<body>
		<h2 class="page-title"><a href="javascript:history.back(-1)"><span></span></a>充值</h2>
		<img class="title-pic" src="<?php echo $inc_url; ?>img/edit_top.jpg"/>
		<form class="send_form" action="recharge/main" method="post" enctype="multipart/form-datas" onsubmit="return check()">
			
			<ul class="recharge_cash">
				<li class="cash_area vip not_yet" href = "6">
					<div class="cash">
							<span class="inp_aed"></span>
					</div>
					<p class="imag_">
					</p>
					<span id="vipOn"></span>
				</li>
				<?php foreach ($recharge_goods as $key => $item): ?>
					<li class="cash_area <?=$key%2=='0'?'fl_lf':'fl_rg';?> <?=$key=='0'?'clicked':'not_yet';?> " href = "<?=$item['id']?>">
						<div class="cash">
							<a><?=$item['shop_price']?><span>元</span></a>
							<span class="inp_aed"><?php if($key=='0'){echo '<input type="radio" value="'.$item['id'].'" name="good_id" checked="checked" style="display:none;" />';}?></span>
						</div>
						<p class="imag_">
							<!--<img src="<?=$inc_url?>img/48.png" />-->
							<span class="stone-num">X48</span>
						</p>
					</li>
				<?php endforeach; ?>
			</ul>
			<img class="tips" src="<?php echo $inc_url; ?>img/recharge/tips.png"/>
			<div class="sure_btn">
				<button class="submit">充值</button>
			</div>
			<p class="recharge_record"><span>充值记录</span></p>
			<!--<p class="tips">温馨提示：余额充值后不支持提现</p>-->
		</form>
		<section style="height: 2rem;"></section>
	</body>
	<script>
        var checked;
		$(function() {
//			var areWth = $(".cash_area").width() * 0.4194;
			var areWth = $(".cash_area").width() * 0.5851;
			$(".cash_area").height(areWth);
			$(".cash").css({
				"margin-top": "" + areWth/6.5 + "px"
			});
//			$(".cash_area").css({
//				"line-height": "" + areWth + "px"
//			});

			$(".cash_area").click(function() {
				var $this = $(this);
				var $thA = $(this).attr("href");
				checked = $this.children(".cash").children(".inp_aed").empty().append(
					"<input type='radio' value=" + $thA + " name='good_id' checked='checked' style='display:none;' />"
				);
				$(this).removeClass("not_yet").addClass("clicked");
				$(".cash_area").not($(this)).removeClass("clicked").addClass("not_yet");
				if($thA*1 == 6)
				{
					$("#vipOn").css({"display":"block"});
				}
				else
				{
					$("#vipOn").css({"display":"none"});
				}
			});

			var btnWth = $(".sure_btn button").width() * 0.3333;
			$(".sure_btn button").height(btnWth);

			$(".recharge_record span").click(function() {
				window.location = "recharge_record";
			});

		})
		
		function check(){
			return true;
		}
	</script>

</html>