<!DOCTYPE html>
<html>

	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0" charset="UTF-8">
		<title>传承碑</title>
	</head>
	<style>
		* {
			padding: 0;
			margin: 0;
		}
		/*.back{
            position: fixed;
            width: 100%;
            height: 100%;
            display: block;
            z-index: -100;	
        }*/
        .content{
        	position: fixed;
        	width: 100%;
        	height: 100%;
        	top: 0;
        	bottom: 0;
        	left: 0;
        	right: 0;
        	overflow: hidden;
        	opacity: 0.1;
        	background: url(<?=$inc_url?>img/stele_bg.jpg) no-repeat;
			background-size: 100% 100%;
        }
		
		body {
			width: 100%;
			overflow: hidden;
		}
		/*.stele_header begin*/
		
		.stele_header {
			background-color: #FFE8BC;
			position: absolute;
			bottom: 0;
			width: 100%;
			overflow: hidden;
			padding: 3px 0;
		}
		
		.stele_header span,
		.stele_header marquee {
			float: left;
			font-size: 14px;
			letter-spacing: 0.8px;
		}
		
		.stele_header span {
			margin-left: 8px;
			color: #EA130F;
		}
		
		.stele_header marquee {
			color: #535353;
		}
		/*.stele_header end*/
		/*.user_info begin*/
		
		.user_info {
			position: absolute;
			/*top: 8.26667%;*/
			top: 17.5%;
			/*left: 6.63507%;*/
			/*width: 23.22275%;*/
			width: 11%;
			right: 5.6872%;
			background: #FFE8BB;
			/*overflow: hidden;*/
		}
		
		.userhead {
			/*width: 51.02041%;*/
			width: 96%;
			background: #FFFFFF;
			text-align: center;
			border: 1px black solid;
			/*float: left;*/
		}
		
		.userhead img {
			border: 1px black solid;
			margin-top: 2px;
		}
		
		.user_level {
			/*width: 21.42857%;
			margin-left: 11.77551%;*/
			width: 42%;
			margin-left: 29%;
			/*float: left;*/
		}
		
		.user_level img {
			width: 100%;
			display: inline-block;
			vertical-align: middle;
		}
		/*user_info end*/
		/*.stele_navbar_left begin*/
		
		.stele_navbar_left {
			overflow: hidden;
			position: absolute;
			/*top: 8.26667%;*/
			/*top: 33.6%;*/
			top: 18%;
			right: 5.6872%;
			width: 10.9005%;
		}
		
		.navbar4,.navbar5{
			width: 100%;
			float: left;
			margin-bottom: 31.95252%;
		}
		/*.stele_navbar_left end*/
		
		.paopao{
			position: absolute;
			top: 6%;
			width: 76%;
			left: 12%;
			z-index: -99;
		}
		.paopao img{
			width: 100%;
		}
		
		/*.inheritor_info begin*/
		
		.inheritor_info {
			position: absolute;
			width: 100%;
			/*top: 26.66667%;*/
			top: 20%;
			text-align: center;
			z-index: -1;
		}
		
		.inheritor_head {
			/*width: 14.45498%;*/
			width: 28%;
			margin-left: 36%;
			/*margin-left: 42.77251%;*/
			height: 0;
			padding-bottom: 28%;
			/*padding-bottom: 16.11374%;*/
			overflow: hidden;
			box-shadow: 1px 1px 5px #888888;
			/*box-shadow: 2px 2px 5px #888888;*/
			text-align: center;
			border-radius: 50%;
		}
		
		/*.inheritor_head img{
			width: 100%;
		}*/
		
		.inheritor_name {
			text-align: center;
			font-size: 16px;
			letter-spacing: 0.8px;
			margin-top: 6px;
		}
		.inheritor_name strong,.inheritor_name img{
			display: inline-block;
			vertical-align: middle;
		}
		.inheritor_name img{
			width: 4%;
			margin-left: 1%;
		}
		/*.inheritor_info end*/
		
		.insence_burner {
			position: absolute;
			width: 100%;
			text-align: center;
			bottom: 10.1%;
		}
		
		.insence_burner img {
			width: 24.17062%;
		}
		.inc_look{
			bottom: 19%;
		}
		
		.inc_look img{
			width: 3.31754%;
		}
		.inc_look,.insences{
			position: fixed;
			width: 100%;
			text-align: center;
			z-index: 3;
		}
		
		
		.insences {
			bottom: -200%;
		}
		.insences img,.insences span{
			display: inline-block;
			vertical-align: middle;
		}
		
		.insences img{
			width: 25.31754%;
		}
		.insences span{
			font-size: 150px;
			color: #ECB20E;
		}
		
		.send_flower{
			opacity: 0;
		}
		.send_flower,.seen_flower {
			position: absolute;
			width: 9.24171%;
			z-index: -1;
		}
		
		.send_flower img,.seen_flower img {
			width: 100%;
		}
		
		.big_flower{
			position: fixed;
			width: 100%;
			text-align: center;
			bottom: -200%;
			opacity: 0;
			z-index: 3;
		}
		.big_flower img,.big_flower span{
			display: inline-block;
			vertical-align: middle;
		}
		.big_flower img{
			width: 43%;
		}
		.big_flower span{
			font-size: 100px;
			color: #ECB20E;
		}
		
		.send_flower_right_one {
			bottom: 11.2%;
			right: 27.96209%;
		}
		
		.send_flower_right_two {
			bottom: 10.26667%;
			right: 18.2464%;
		}
		
		.send_flower_right_three {
			bottom: 9.33333%;
			right: 9.00474%;
		}
		
		.send_flower_left_one {
			left: 28.673%;
			bottom: 10.93333%;
		}
		
		.send_flower_left_two {
			left: 19.5%;
			bottom: 9.9185%;
		}
		
		.send_flower_left_three {
			left: 9.71%;
			bottom: 8.83%;
		}
		/*stele_navbar_footer begin*/
		
		.stele_navbar_footer {
			position: absolute;
			bottom: 4.6%;
			width: 100%;
			z-index: 2;
		}
		
		.stele_navbar_footer img {
			width: 13.75%;
			margin-left: 5.21327%;
		}
		
		.navbar1 {
			margin-left: 8.53081% !important;
		}
		/*stele_navbar_footer end*/
		
		.pillar_right {
			position: absolute;
			width: 4.5%;
			bottom: 9.45%;
			right: 30%;
			z-index: 1;
		}
		
		.pillar_right img,
		.pillar_left img {
			width: 100%;
		}
		
		.pillar_left {
			position: absolute;
			width: 4.5%;
			bottom: 10.3%;
			left: 27.725%;
			z-index: 1;
		}
		
		.list_logo,.contribution_logo {
			position: absolute;
			width: 100%;
			text-align: center;
			top: -8.5%;
		}
		
		.list_logo img,.contribution_logo img {
			width: 17.7%;
		}
		
		.cli_bg {
			height: 0;
		}
		
		.lists {
			background: url(<?=$inc_url?>img/cli_bg.png) no-repeat;
			background-size: 100% 100%;
			width: 100%;
			position: absolute;
			bottom: 0;
			z-index: 99;
			display: none;
		}
		
		.lists span {
			font-size: 13px;
			font-weight: bold;
			letter-spacing: 0.8px;
			position: absolute;
			left: 5.2%;
		}
		.tit{
			position: absolute;
			left: 5.2%;
			top: 8.5%;
		}
		
		.closed {
			position: absolute;
			width: 5.9%;
			right: 3.066%;
			top: 2.41%;
		}
		
		
		.list_cont{
			margin-top: 16.8%;
			height: 80%;
			overflow-y: auto;
			border-top: 1px #F0F0F0 solid;
		}
		.cont_ul li{
			list-style: none;
			overflow: hidden;
			border-bottom: 1px #f0f0f0 solid;
		}
		.top_logo,.donator_head,.donator_name{
			float: left;
		}
		.top_logo{
			width: 6.13208%;
			margin-left: 7.31133%;
			text-align: center;
		}
		.top_logo img{
			width: 100%;
		}
		.donator_head{
			width: 12.0283%;
			overflow: hidden;
			margin-left: 2.8302%;
		}
		.donator_head img{
			height: 100%;
		}
		.donator_name{
			letter-spacing: 1.24px;
			margin-left: 2.59434%;
			line-height: 20px;
			height: 40px;
		}
		.donator_name strong{
			font-size: 15px;
		}
		.donator_name p{
			color: #a6a6a6;
			font-size: 13px;
		}
		
		
		
		
		.incense,.flower,.wait{
			width: 94.811%;
			margin: 0 auto;
			overflow: hidden;
			border-radius: 12px;
			margin-top: 3.73%;
		}
		.incense{
			background: #d5c18e;
			box-shadow: 0px 4px 1px #ebebeb;
		}
		.flower{
			background: #f5b146;
			box-shadow: 0px 4px 1px #ecebe7;
		}
		.wait{
			background: #91dbff;
			box-shadow: 0px 4px 1px #efebea;
		}
		.incense_logo,.flower_logo,.wait_logo{
			width: 17.413%;
			margin-left: 5.721%;
			float: left;
		}
		.incense_logo img,.flower_logo img,.wait_logo img{
			width: 100%;
			margin-top: 26%;
		}
		.incense_intro,.flower_intro,.wait_intro{
			float: left;
			margin-left: 5.97%;
			margin-top: 5.5%;
		}
		.incense_intro p,.flower_intro p,.wait_intro p{
			font-size: 13px;
			line-height: 23px;
			letter-spacing: 0.8px;
		}
		.incense_intro p{
			color: #feffff;
		}
		.flower_intro p{
			color: #fffdfc;
		}
		.wait_intro p{
			color: #fffeff;
		}
		.incense button,.flower button,.wait button{
			background: #FFFFFF;
			border: 0;
			outline: none;
			position: absolute;
			right: 6.66%;
			width: 17.04%;
			height: 4.81%;
			border-radius: 10px;
			font-size: 12px;
			letter-spacing: 0.8px;
		}
		.incense button{
			color: #d8c18f;
			top: 22.64%;
		}
		.flower button{
			color: #f6ab4e;
			top: 48.28%;
		}
		.wait button{
			color: #80dfff;
			top: 73.92%;
		}
		
		
		
		
		
		
		
		
		.mask_bg{
			width: 100%;
			background-color: rgba(9, 9, 9, 0.25);
			position: absolute;
			top: 0;
			left: 0;
			display: none;
			z-index: 100;
		}
		.mask_cont_bg{
			width: 85.83%;
			margin: 0 auto;
			background: white;
			margin-top: 81.74%;
			border-radius: 8px;
		}
		.mask_tips{
			width: 93.333%;
			margin: 0 auto;
			border-bottom: 1px #cccccc solid;
			overflow: hidden;
		}
		.mask_tips span:first-child{
			font-size: 16px;
			float: left;
			margin-top: 8.75%;
		}
		.choose_cont{
			width: 39.8%;
			border: 1px #d9d9d9 solid;
			float: right;
			margin-top: 6.75%;
			margin-bottom: 2%;
			overflow: hidden;
		}
		.minus,.choose_num{
			float: left;
		}
		.minus,.choose_num,.plus{
			height: 100%;
			text-align: center;
		}
		.minus{
			border-right: 1px #d9d9d9 solid;
			color: #ebebeb;
			font-size: 20px;
		}
		.plus{
			float: right;
			border-left: 1px #d9d9d9 solid;
			color: #979797;
			background: #f7f7f7;
			font-size: 20px;
		}
		.choose_num{
			border: 0;
			outline: none;
			font-size: 14px;
		}
		.rest_num{
			clear: both;
			text-align: right;
			font-size: 12px;
			margin-bottom: 2%;
			color: #68312a;
		}
		.rest_num img{
			width: 12px;
			margin-right: 5px;
		}
		.rest_num img,.rest_num span{
			display: inline-block;
			vertical-align: middle;
		}
		
		.mask_btns{
			width: 93.333%;
			margin: 3.75% auto;
			overflow: hidden;
			text-align: center;
		}
		.cancel,.sure{
			border: none;
			outline: none;
			color: #68312a;
			font-size: 16px;
			background: white;
		}
		.cancel{
			float: left;
			width: 49.5%;
			border-right: 1px #CCCCCC solid;
		}
		.sure{
			float: right;
			width: 50%;
		}
		.to_recharge{
			width: 25.796%;
			border: 1px #CCCCCC solid;
			outline: none;
			font-size: 16px;
			background: white;
			color: #68312a;
			margin-bottom: 3.75%;
		}
		.al_num{
			bottom: 0;
			font-size: 0;
			opacity: 0;
			color: #ECB20E;
			position: fixed;
			width: 100%;
			text-align: center;
		}
		
		
		
	
	
	
	
	.clouds_one,
.clouds_two {
	background: url(<?=$inc_url?>img/cloud_one.png) no-repeat;
	background-position: right;
	position: absolute;
	-webkit-transform: translate3d(0, 0, 0);
	-ms-transform: translate3d(0, 0, 0);
	-o-transform: translate3d(0, 0, 0);
	transform: translate3d(0, 0, 0);
	-webkit-animation-fill-mode: forwards !important;
	-ms-animation-fill-mode: forwards !important;
	-o-animation-fill-mode: forwards !important;
	animation-fill-mode: forwards !important;
}

.clouds_one {
	height: 100%;
	width: 185%;
	display: none;
	left: 0;
	top: 0;
	-webkit-animation: cloud_one 50s linear 1;
	-moz-animation: cloud_one 50s linear 1;
	-o-animation: cloud_one 50s linear 1;
	animation: cloud_one 50s linear 1;
}

.clouds_two {
	height: 100%;
	width: 180%;
	display: none;
	right: 0;
	top: 0;
	-webkit-animation: cloud_two 40s linear 1;
	-moz-animation: cloud_two 40s linear 1;
	-o-animation: cloud_two 40s linear 1;
	animation: cloud_two 40s linear 1;
}

@keyframes sky_background {
	from {
		opacity: 0.1
	}
	to {
		opacity: 1
	}
}

@-webkit-keyframes cloud_one {
	from {
		left: -50%;
	}
	to {
		left: -2000%;
	}
}

@-moz-keyframes cloud_one {
	from {
		left: -50%;
	}
	to {
		left: -2000%;
	}
}

@keyframes cloud_one {
	from {
		left: -50%;
	}
	to {
		left: -2000%;
	}
}

@-webkit-keyframes cloud_two {
	from {
		right: -50%;
	}
	to {
		right: -2000%;
	}
}

@-moz-keyframes cloud_two {
	from {
		right: -50%;
	}
	to {
		right: -2000%;
	}
}

@keyframes cloud_two {
	from {
		right: -50%;
	}
	to {
		right: -2000%;
	}
}	
		
		
		
		
		#scrollBox {
	position: absolute;
	bottom: 17%;
	font-size: 18px;
	overflow: hidden;
	text-align: center;
	width: 100%;
	height: 420px;
	line-height: 30px;
	z-index: 1001;
}

ul,
li {
	list-style: none;
	display: block;
	padding: 0;
	margin: 0;
	color: #65282A;
}


#con1 {
	position: absolute;
	bottom: -420px;
	width: 100%;
}

#con2 {
	display: none;
}

.delete {
	position: absolute;
	bottom: 11%;
	right: 2%;
	border: 1px #65282A solid;
	border-radius: 5px;
	padding: 3px 9px 5px 9px;
	font-size: 14px;
}

.delete img {
	width: 100%;
	display: block;
}

	</style>
	<style id="chan_top"></style>
	<link rel="stylesheet" href="<?=$inc_url?>css/component.css" />

	<body>
		<!--<img src="<?=$inc_url?>img/stele_bg.jpg" class="back"/>-->
		<div class="content">
		<div class="clouds_one"></div>
		<div class="clouds_two"></div>	
			
		<div class="stele_header">
			<span>动态：</span>
			<marquee loop="-1" scrolldelay="100" direction="left"><?php foreach ($give_list_3 as $item): echo $item['nickname'].$item['gift_action'].$item['gift_count'].$item['gift_unit'].$item['name'].'&nbsp;&nbsp;'; endforeach;?></marquee>
		</div>
		
		<div class="stele_navbar_left">
			<img src="<?=$inc_url?>img/navbar4.png" class="navbar4" />
			<img src="<?=$inc_url?>img/navbar5.png" class="navbar5" />
			
		</div>
		<!--<div class="user_info">
			<div class="userhead">
				<img href="identify?s=<?=$stele_id?>" src="<?=$stele_info['picture']?>" />
			</div>
			<div class="user_level">
				<img href="identify?s=<?=$stele_id?>" src="<?=$inc_url?>img/noLevel.png" />
			</div>
		</div>-->
		
		<div class="paopao">
			<img src="<?=$inc_url?>img/paopao.png" />
		</div>
		<div class="inheritor_info">
			<div class="inheritor_head">
				<img src="<?=$stele_info['picture']?>" />
				<!--<img src="<?=$inc_url?>img/123.jpg" />-->
			</div>
			<p class="inheritor_name"><strong><?=$stele_info['title']?></strong><img href="identify?s=<?=$stele_id?>" src="<?=$inc_url?>img/noLevel.png" /></p>
		</div>
		<div class="insence_burner">
			<img src="<?=$inc_url?>img/incense_burner.png" />
		</div>
		<div class="inc_look">
			<img src="<?=$inc_url?>img/insences.gif" />
		</div>
		<div class="insences seen">
			<img src="<?=$inc_url?>img/insences.gif" />
			<span></span>
		</div>
		<div class="insences not_seen">
			<img src="<?=$inc_url?>img/insences.gif" />
			<span></span>
		</div>
		<p class="al_num"></p>
		<!--左边三束花-->
		<div class="send_flower_right_one send_flower">
			<img src="<?=$inc_url?>img/flower_right.png" />
		</div>
		<div class="send_flower_right_two send_flower">
			<img src="<?=$inc_url?>img/flower_right.png" />
		</div>
		<div class="send_flower_right_three send_flower">
			<img src="<?=$inc_url?>img/flower_right.png" />
		</div>
		<!--右边三束花-->
		<div class="send_flower_left_one send_flower">
			<img src="<?=$inc_url?>img/flower_left.png" />
		</div>
		<div class="send_flower_left_two send_flower">
			<img src="<?=$inc_url?>img/flower_left.png" />
		</div>
		<div class="send_flower_left_three send_flower">
			<img src="<?=$inc_url?>img/flower_left.png" />
		</div>
		
		
		<!--左边三束花-->
		<div class="send_flower_right_one seen_flower">
			<img src="<?=$inc_url?>img/flower_right.png" />
		</div>
		<div class="send_flower_right_two seen_flower">
			<img src="<?=$inc_url?>img/flower_right.png" />
		</div>
		<div class="send_flower_right_three seen_flower">
			<img src="<?=$inc_url?>img/flower_right.png" />
		</div>
		<!--右边三束花-->
		<div class="send_flower_left_one seen_flower">
			<img src="<?=$inc_url?>img/flower_left.png" />
		</div>
		<div class="send_flower_left_two seen_flower">
			<img src="<?=$inc_url?>img/flower_left.png" />
		</div>
		<div class="send_flower_left_three seen_flower">
			<img src="<?=$inc_url?>img/flower_left.png" />
		</div>
		
		<div class="big_flower show">
			<img src="<?=$inc_url?>img/big_flower.png" /><span></span>
		</div>
		<div class="big_flower not_show">
			<img src="<?=$inc_url?>img/big_flower.png" /><span></span>
		</div>

		<div class="stele_navbar_footer">
			<img src="<?=$inc_url?>img/navbar1.png" class="navbar1" />
			<img src="<?=$inc_url?>img/navbar2.png" class="navbar2" />
			<img src="<?=$inc_url?>img/navbar3.png" class="navbar3" />
		</div>
		<div class="pillar_right">
			<img src="<?=$inc_url?>img/pillar_right.png" />
		</div>
		<div class="pillar_left">
			<img src="<?=$inc_url?>img/pillar_left.png" />
		</div>

		<!--榜单-->
		<div class="lists cli_bg">
			<div class="list_logo">
				<img src="<?=$inc_url?>img/list_logo.png" />
			</div>
			<span class="tit">榜单</span>
			<img class="closed" src="<?=$inc_url?>img/closed.png" />
			<div class="list_cont">
				<ul class="cont_ul">
					<!--第一名-->
					<li>
						<div class="top_logo">
							<img src="<?=$inc_url?>img/top_one.png" />
						</div>
						<div class="donator_head">
							<img src="<?=$inc_url?>img/seaside.png" />
						</div>
						<div class="donator_name">
							<strong>小小明</strong>
							<p>累计XXX点贡献值</p>
						</div>
					</li>
				</ul>
			</div>
		</div>
		<!--蒙板-->
		<div class="mask_bg"></div>
		</div>
		<div id="scrollBox">

			<ul id="con1">
				<li>
					现代物理学中
				</li>
				<li>
					平行世界或许真的存在。
				</li>
				<li>
					人的灵魂
				</li>
				<li>
					或许亦存在于此！
				</li>
				<li>
					我们将对过往的人、事
				</li>
				<li>
					深深的思念
				</li>
				<li>
					追寻、追忆
				</li>
				<li>
					这种状态就像量子纠缠
				</li>
				<li>
					都会有随之存在的路径传递与传达
				</li>
				<li>
					我们的信仰
				</li>
				<li>
					通过无处不在的网络
				</li>
				<li>
					与平行世界的灵魂共振
				</li>
				<li>
					这，便是永恒
				</li>
				<li>
					这，便是传承碑
				</li>
			</ul>
			<ul id="con2"></ul>
		</div>
		<div class="delete">
			跳过
		</div>
	</body>
	<script type="text/javascript" src="<?=$inc_url?>js/jquery-2.2.3.min.js"></script>
	<script type="text/javascript">
		var sx_top ;
		var gtv;
		var gtv1;
		var gtv2;
		var cnv;
		var dmcs;
		var dmcs=null;
		var x;
		
		
		
		var offsetVal = '';
window.onload = function() {
	if($(".content").css("display", "none")) {
		$(".content").css("display", "block");
	} else {
		$(".content").css("display", "none");
	}
}
     
     
            if($(".inheritor_head img").width()>$(".inheritor_head img").height()){
            	$(".inheritor_head img").height($(".inheritor_head").width());
            }else{
            	$(".inheritor_head img").css("width","100%");
            }
            
            
            
            var txt = document.getElementById('scrollBox');
			var con1 = document.getElementById('con1');
			var con2 = document.getElementById('con2');
			con2.innerHTML = con1.innerHTML;

			function scrollUp() {
				if(txt.scrollTop >= con1.offsetHeight) {
					txt.scrollTop = 0;
				} else{
					txt.scrollTop++;
					console.log(txt.scrollTop)
					if(txt.scrollTop==420){
						clearInterval(mytimer);
					}
				}
			}
			var time = 50;
			var mytimer = setInterval(scrollUp, time);



$(".delete").click(function(){
	$("#scrollBox").css("display","none");
	$(this).css("display","none");
	$(".content").css("-webkit-animation","sky_background 7s ease-out 1");
	$(".content").css("-moz-animation","sky_background 7s ease-out 1");
	$(".content").css("-o-animation","sky_background 7s ease-out 1");
	$(".content").css("animation","sky_background 7s ease-out 1");
	$(".content").css("-webkit-transform","translate3d(0, 0, 0)");
	$(".content").css("-moz-transform","translate3d(0, 0, 0)");
	$(".content").css("-o-transform","translate3d(0, 0, 0)");
	$(".content").css("transform","translate3d(0, 0, 0)");
	$(".content").css("opacity","1");
	
	if($(".clouds_one").css("display", "none")) {
		$(".clouds_one").css("display", "block");
	} else {
		$(".clouds_one").css("display", "none");
	}

	if($(".clouds_two").css("display", "none")) {
		$(".clouds_two").css("display", "block");
	} else {
		$(".clouds_two").css("display", "none");
	}
	
})
		
		
		
		
		
		
		//榜单
		var wth = $(window).width()*0.120283;
		var culh = $(window).height()*0.106525;
		var cullh = $(window).height()*0.127358;
		$(".cont_ul li").css({
			"height":"" + culh + "px"
		});
		var lgt = $(".cont_ul li").height();
		var tlh = $(".top_logo").width();
		var dnd = $(".donator_name").height();
		$(".top_logo").css("line-height",lgt);
		$(".donator_head").height(wth);
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		$(".inheritor_head img").click(function(){
			window.location = "identify?s=<?=$stele_id?>";
		});
		
		$("body").height($(window).height());
		$(".mask_bg").height($(window).height());

		var shs = $(".stele_header span").width();
		$(".stele_header marquee").width($(window).width() - shs - 16 - 0.8);

		var uhw = $(".userhead").width();
		$(".userhead").height(uhw);
		$(".user_level").css({
			"line-height": "" + uhw + "px"
		});
		$(".user_info").css({
			"border-radius": "" + uhw + "px"
		});
		$(".userhead").css({
			"border-radius": "" + uhw + "px"
		});
		$(".userhead img").css({
			"border-radius": "" + uhw - 6 + "px"
		});
		$(".userhead img").height(uhw - 6);
		$(".userhead img").width(uhw - 6);

//		var ihthpb = $(".inheritor_head").css("padding-bottom");
//		$(".inheritor_head img").css("height", ihthpb)

		var ltiw = $(".list_logo img").height();
		var bot = ltiw + 10;
		$(".navbar1").click(function() {
			$(".lists").css("display","block");
			
			$(".cli_bg").animate({
				height: "70.3564%"
			}, 500);
			
			$(".cli_bg span").empty().append("榜单");
			$(".list_logo").empty().append("<img src='<?=$inc_url?>img/list_logo.png' >");
			
			
			$(".list_cont").empty().append(
				"<ul class='cont_ul'>"+
					"<?php if(!empty($top_10)){?>"+
						"<?php foreach ($top_10 as $key => $item): ?>"+
							"<li style='height:" + culh + "px;'>"+
						        "<div class='top_logo' style='line-height:"+cullh+"px;'>"+
						        	"<?php if($key=='0'){?>"+
						            	"<img src='<?=$inc_url?>img/top_one.png' />"+
						            "<?php }elseif($key=='1'){?>"+
						            	"<img src='<?=$inc_url?>img/top_two.png' />"+
						            "<?php }elseif($key=='2'){?>"+
						            	"<img src='<?=$inc_url?>img/top_three.png' />"+
						            "<?php }else{?>"+
						            	"<?=$key++?>"+
						            "<?php }?>"+
						        "</div>"+
						        "<div class='donator_head' style='height:"+wth+"px;margin-top:"+(lgt-wth)/2+"px;border-radius:"+wth+"px;'>"+
						            "<img src='<?=$item['avatar']?>' />"+
						        "</div>"+
						        "<div class='donator_name' style='margin-top:"+(lgt-40)/2+"px;'>"+
						            "<strong><?=$item['nickname']?></strong>"+
						            "<p>累计<?=$item['user_gives']?>点贡献值</p>"+
						        "</div>"+
						    "</li>"+
						"<?php endforeach; ?>"+
					"<?php }?>"+
				"</ul>"
			);
			
		});
		
		$(".navbar2").click(function() {
			$(".lists").css("display","block");
			
			$(".cli_bg").animate({
				height: "70.3564%"
			}, 500);
			
			
			$(".cli_bg span").empty().append("贡献(每8个小时可获取一次免费道具)");
			$(".list_logo").empty().append("<img src='<?=$inc_url?>img/contribution_logo.png' >");
			
			
			
			
			$(".list_cont").empty().append(
				"<ul class='contri_ul'>"+
				    "<li class='incense'>"+
				        "<div class='incense_logo'>"+
				            "<img src='<?=$inc_url?>img/incense.png' />"+
				        "</div>"+
				        "<div class='incense_intro'>"+
				            "<p>点香</P>"+
				            "<p>心到即是，香由心生，心诚则灵。</P>"+
				        "</div>"+
				        "<button class='go_to_inc' href='1'><?php if($is_free_good == '1'){echo '免费点';}else{echo '去点香';}?></button>"+
				        "<input type='hidden' class='gift_type' name='gift_type' value='' />"+
		    		    "<input type='hidden' name='stele_id' value='<?=$stele_id?>' />"+
				    "</li>"+
				    "<li class='flower'>"+
				        "<div class='flower_logo'>"+
				            "<img src='<?=$inc_url?>img/flower.png' />"+
				        "</div>"+
				        "<div class='flower_intro'>"+
				            "<p>献花</P>"+
				            "<p>惋惜，怀念，敬重，松柏长青。</P>"+
				        "</div>"+
				        "<button class='go_to_flo' href='2'><?php if($is_free_good == '1'){echo '免费献';}else{echo '去献花';}?></button>"+
				        "<input type='hidden' class='gift_type' name='gift_type' value='' />"+
		    		    "<input type='hidden' name='stele_id' value='<?=$stele_id?>' />"+
				    "</li>"+
				    "<li class='wait'>"+
				        "<div class='wait_logo'>"+
				            "<img src='<?=$inc_url?>img/wait.png' />"+
				        "</div>"+
				        "<div class='wait_intro'>"+
				            "<p>稍后开放</P>"+
				        "</div>"+
				        "<button>待开放</button>"+
				    "</li>"+
				"</ul>"
			);
			
			
			$.ajax({
				type:"post",
				url:"init/cloud_free_time",
				dataType: "json",
				data:{
            	    stele_id: <?=$stele_id?>
				},
				async:true,
				success: function(data) {
					console.log(data)
					if(data=="0"){
						$(".go_to_inc").text("去点香");
						$(".go_to_flo").text("去献花");
					}
					if(data=="1"){
						$(".go_to_inc").text("免费点");
						$(".go_to_flo").text("免费献");
					}
				}
			});
			
			
			
			
			//贡献
		    $(".contri_ul li").height($(window).height()*0.156915);
		    $(".go_to_inc").click(function(){
		    	//去点香
		    	if($(".go_to_inc").text()=="免费点"){
		    		gtv1 = $(".go_to_inc").attr("href");
		    		console.log(gtv1);
			        $.ajax({
				        type:"post",
				        url:"cloud/prop",
				        dataType: "json",
				        data:{
					        gift_type: gtv1,
            	            stele_id: <?=$stele_id?>
				        },
				        async:true,
				        success: function(data) {
					        console.log(data);
					        console.log(data.code);
                            if(data.code == '-1'){
                            	alert("温馨提示：未到免费领取时间，请稍后领取！");
                            }
                            if(data.code == '1'){
                            	$(".lists").css("display","none");
                                $(".seen").css("animation","myfirst 2s");
	                            $(".seen").css("-webkit-animation","myfirst 2s");
		                        $(".seen").css("-moz-animation","myfirst 2s");
		                        $(".seen").css("-o-animation","myfirst 2s");
		                        $(".seen").css("animation-fill-mode","forwards");
		                        sx_top = document.getElementById("chan_top");
                                sx_top.innerHTML = '@keyframes myfirst {0%{bottom: 0%;} 20%{bottom: 35%;} 100%{bottom: 20%;;}}'+
                                '@-webkit-keyframes myfirst {0%{bottom: 0%;} 20%{bottom: 30%;} 100%{bottom: 20%;}}'+
                                '@-moz-keyframes myfirst {0%{bottom: 0%;} 20%{bottom: 35%;} 100%{bottom: 20%;}}'+
                                '@-o-keyframes myfirst {0%{bottom: 0%;} 20%{bottom: 35%;} 100%{bottom: 20%;}}'
			                    $(".seen").animate({
				                    opacity: "0"
			                    }, 4000);
		                        $(".seen img").animate({
				                    width: "3.31754%"
			                    }, 2000);
			                    $(".seen img").width("10.31754%");
		                        $(".insences").removeClass("not_seen").addClass("seen");
                            }
					
				        }
			        });
			    }
		    	
		    	if($(".go_to_inc").text()=="去点香"){
		    		
		    	$(".lists").height(0);
		    	$(".mask_bg").css("display","block");
		    	$(".mask_bg").empty().append(
		    		"<div class='mask_cont_bg'>"+
		    		    	"<input type='hidden' class='gift_type' name='gift_type' value='1' />"+
		    		    	"<input type='hidden' name='stele_id' value='<?=$stele_id?>' />"+
		    		        "<div class='mask_tips'>"+
		    		            "<span>点香数量</span>"+
		    		            "<div class='choose_cont'>"+
		    		                "<div class='minus'>-</div>"+
		    		                "<input type='number' name='choose_num' class='choose_num' value='1' />"+
		    		                "<div class='plus'>+</div>"+
		    		            "</div>"+
		    		            "<div class='rest_num'>"+
		    		                "<img src='<?=$inc_url?>img/sm_inc.png' />"+
		    		                "<span><?=$total_user_point/1;?></span>"+
		    		            "</div>"+
		    		        "</div>"+
		    		        "<div class='mask_btns'>"+
		    		            "<button type='button' class='cancel'>取消</button>"+
		    		            "<button type='submit' class='sure'>确定</button>"+
		    		        "</div>"+
		    		        "<p style='text-align: center;'><button type='button' class='to_recharge'>去充值</button></p>"+
		    		"</div>"
		    	);
		    	$(".choose_cont").height($(".mask_cont_bg").height()*0.1818);
		    	$(".minus").width($(".choose_cont").height());
		    	$(".minus").css("line-height",$(".choose_cont").height()+"px");
		    	$(".plus").width($(".choose_cont").height());
		    	$(".plus").css("line-height",$(".choose_cont").height()+"px");
		    	$(".choose_num").width($(".choose_cont").width()-$(".choose_cont").height()*2-3);
		    	$(".plus").click(function(){
		    		var i = $('.choose_num').val();
			        i++;
			        $('.choose_num').val(i);
		    	});
		    	$(".minus").click(function(){
		    		var i = $('.choose_num').val();
			        i--;
			        $('.choose_num').val(i);
			        if(i<1){
			        	$('.choose_num').val("1");
			        }
		    	});
		    	$(".sure").click(function(){
		    		gtv = $(".mask_cont_bg .gift_type").val();
		    		cnv  = $(".choose_num").val();
		    		$.ajax({
		    			type:"post",
		    			url:"cloud/propp",
		    			async:true,
		    			data:{
		    				gift_type: gtv,
            	            stele_id: <?=$stele_id?>,
            	            choose_num: cnv
                        },
		    			success:function(data){
		    				console.log(data)
		    				var dt = data;
                            var dtToObject=JSON.parse(dt);
                            console.log(dtToObject.code)
                            if(dtToObject.code == '-1'){
                	            alert("温馨提醒：您的余额不足，请充值！");
                            }
                            if(dtToObject.code == '2'){
//                          	alert("我进来了")
                            	$(".mask_bg").css("display","none");
                                $(".seen").css("animation","myfirst 2s");
	                            $(".seen").css("-webkit-animation","myfirst 2s");
		                        $(".seen").css("-moz-animation","myfirst 2s");
		                        $(".seen").css("-o-animation","myfirst 2s");
		                        $(".seen").css("animation-fill-mode","forwards");
		                        sx_top = document.getElementById("chan_top");
                                sx_top.innerHTML = '@keyframes myfirst {0%{bottom: 0%;} 20%{bottom: 35%;} 100%{bottom: 20%;}}'+
                                '@-webkit-keyframes myfirst {0%{bottom: 0%;} 20%{bottom: 30%;} 100%{bottom: 20%;}}'+
                                '@-moz-keyframes myfirst {0%{bottom: 0%;} 20%{bottom: 35%;} 100%{bottom: 20%;}}'+
                                '@-o-keyframes myfirst {0%{bottom: 0%;} 20%{bottom: 35%;} 100%{bottom: 20%;}}'
                                if(cnv=="1"){
                                	$(".al_num").text('');
                                }else{
                                	$(".al_num").text('').append(""+"X"+cnv);
                                }
                                
		                        $(".seen").animate({
				                    opacity: "0"
			                    }, 5000);
		                        $(".seen img").animate({
				                    width: "3.31754%"
			                    }, 2000);
			                    $(".al_num").animate({
			                    	bottom:"30%",
				                    "font-size": "110px",
				                    opacity:"1"
			                    }, 2000);
			                    $(".al_num").animate({
				                    opacity:"0"
			                    }, 5000);
			                    $(".al_num").animate({
			                    	bottom:"0",
				                    "font-size":"0"
			                    }, 1000);
			                    $(".seen img").width("10.31754%");
		                        $(".insences").removeClass("not_seen").addClass("seen");
                                $("body").append("<div class='insences not_seen'><img src='<?=$inc_url?>img/insences.gif' /><span></span></div>");
                            }
		    			},
		    			error:function(e){
				            alert("出现错误！！");
                        }
		    		});
		    		
		    		
		    		
                  
                        	$.ajax({
				                type:"post",
				                dataType: "json",
				                url:"init/cloud_give_list_3",
				                async:true,
				                data:{
					                stele_id:<?=$stele_id?>
				                },
				                success:function(data1){
				                	for(var i =0;i<data1.length;i++){
				                		$(".stele_header marquee").html('').append(
				                			''+data1[0]+''+data1[1]+''+data1[2]+''
				                		);
				                	}
				                },
				                error:function(e){
				                    alert("出现错误！！!");
                                }
			                });
		    	});
		    	
		    	$(".to_recharge").click(function(){
		    		window.location="recharge";
		    	});
		    	$(".to_recharge").height($(".mask_cont_bg").height()*0.17647);
		    	$(".cancel").click(function(){
		    		$(".mask_bg").css("display","none");
		    	});
		    	}
		    });
		    $(".go_to_flo").click(function(){
		    	//去献花
		    	if($(".go_to_flo").text()=="免费献"){
		    		gtv2 = $(".go_to_flo").attr("href");
		    		console.log(gtv2);
			        $.ajax({
				        type:"post",
				        url:"cloud/prop",
				        dataType: "json",
				        data:{
					        gift_type: gtv2,
            	            stele_id: <?=$stele_id?>
				        },
				        async:true,
				        success: function(data) {
					        console.log(data);
					        console.log(data.code);
                            if(data.code == '-1'){
                            	alert("温馨提示：未到免费领取时间，请稍后领取！");
                            }
                            if(data.code == '1'){
                            	$(".lists").css("display","none");
                                $(".show").css("animation","mysecond 1s");
	                            $(".show").css("-webkit-animation","mysecond 1s");
		                        $(".show").css("-moz-animation","mysecond 1s");
		                        $(".show").css("-o-animation","mysecond 1s");
		                        $(".show").css("animation-fill-mode","forwards");
		                        sx_top = document.getElementById("chan_top");
                                sx_top.innerHTML = '@keyframes mysecond {0%{bottom: 20%;} 100%{bottom: 30%;}}'+
                                '@-webkit-keyframes mysecond {0%{bottom: 20%;}  100%{bottom: 30%;}}'+
                                '@-moz-keyframes mysecond {0%{bottom: 20%;} 100%{bottom: 30%;}}'+
                                '@-o-keyframes mysecond {0%{bottom: 20%;} 100%{bottom: 30%;}}'
		                        $(".show").animate({
				                    opacity: "1"
			                    }, 2500);
			                    $(".show").animate({
				                    opacity: "0"
			                    }, 6000);
		                        $(".big_flower").removeClass("not_show").addClass("show");
                            }
					
				        }
			        });
		    	}
		    	if($(".go_to_flo").text()=="去献花"){
		    		$(".lists").height(0);
		    		$(".mask_bg").css("display","block");
		    	$(".mask_bg").empty().append(
		    		"<div class='mask_cont_bg'>"+
		    		    	"<input type='hidden' class='gift_type' name='gift_type' value='2' />"+
		    		    	"<input type='hidden' name='stele_id' value='<?=$stele_id?>' />"+
		    		        "<div class='mask_tips'>"+
		    		            "<span>献花数量</span>"+
		    		            "<div class='choose_cont'>"+
		    		                "<div class='minus'>-</div>"+
		    		                "<input type='number' name='choose_num' class='choose_num' value='1' />"+
		    		                "<div class='plus'>+</div>"+
		    		            "</div>"+
		    		            "<div class='rest_num'>"+
		    		                "<img src='<?=$inc_url?>img/sm_flo.png' />"+
		    		                "<span><?=$total_user_point/1;?></span>"+
		    		            "</div>"+
		    		        "</div>"+
		    		        "<div class='mask_btns'>"+
		    		            "<button type='button' class='cancel'>取消</button>"+
		    		            "<button type='submit' class='sure'>确定</button>"+
		    		        "</div>"+
		    		        "<p style='text-align: center;'><button type='button' class='to_recharge'>去充值</button></p>"+
		    		"</div>"
		    	);
		    	$(".choose_cont").height($(".mask_cont_bg").height()*0.1818);
		    	$(".minus").width($(".choose_cont").height());
		    	$(".minus").css("line-height",$(".choose_cont").height()+"px");
		    	$(".plus").width($(".choose_cont").height());
		    	$(".plus").css("line-height",$(".choose_cont").height()+"px");
		    	$(".choose_num").width($(".choose_cont").width()-$(".choose_cont").height()*2-3);
		    	$(".plus").click(function(){
		    		var i = $('.choose_num').val();
			        i++;
			        $('.choose_num').val(i);
		    	});
		    	$(".minus").click(function(){
		    		var i = $('.choose_num').val();
			        i--;
			        $('.choose_num').val(i);
			        if(i<1){
			        	$('.choose_num').val("1");
			        }
		    	});
		    	$(".sure").click(function(){
		    		gtv = $(".mask_cont_bg .gift_type").val();
		    		cnv  = $(".choose_num").val();
		    		$.ajax({
		    			type:"post",
		    			url:"cloud/propp",
		    			async:true,
		    			data:{
		    				gift_type: gtv,
            	            stele_id: <?=$stele_id?>,
            	            choose_num: cnv
                        },
		    			success:function(data){
		    				var dt = data;
                            var dtToObject=JSON.parse(dt);
//                          alert(dtToObject.code)
                            if(dtToObject.code == '-1'){
                	            alert("温馨提醒：您的余额不足，请充值！");
                            }
                                
                            if(dtToObject.code == '2'){
                            	$(".mask_bg").css("display","none");
                            	if(cnv=="1"){
                                	$(".show span").text('');
                                }else{
                                	$(".show span").text(""+"X"+cnv);
                                }
                                $(".show").css("animation","mysecond 1s");
	                            $(".show").css("-webkit-animation","mysecond 1s");
		                        $(".show").css("-moz-animation","mysecond 1s");
		                        $(".show").css("-o-animation","mysecond 1s");
		                        $(".show").css("animation-fill-mode","forwards");
		                        sx_top = document.getElementById("chan_top");
                                sx_top.innerHTML = '@keyframes mysecond {0%{bottom: 20%;} 100%{bottom: 30%;}}'+
                                '@-webkit-keyframes mysecond {0%{bottom: 20%;}  100%{bottom: 30%;}}'+
                                '@-moz-keyframes mysecond {0%{bottom: 20%;} 100%{bottom: 30%;}}'+
                                '@-o-keyframes mysecond {0%{bottom: 20%;} 100%{bottom: 30%;}}'
		                        $(".show").animate({
				                    opacity: "1"
			                    }, 2500);
			                    $(".show").animate({
				                    opacity: "0"
			                    }, 6000);
		                        $(".big_flower").removeClass("not_show").addClass("show");
                                $("body").append("<div class='big_flower not_show'><img src='<?=$inc_url?>img/big_flower.png' /><span></span></div>");
//              	            alert("赠送成功！");
                            }
		    			},
		    			error:function(e){
				            alert("出现错误！！");
                        }
		    		});
		    		
		    		
		    		        $.ajax({
				                type:"post",
				                dataType: "json",
				                url:"init/cloud_give_list_3",
				                async:true,
				                data:{
					                stele_id:<?=$stele_id?>
				                },
				                success:function(data1){
				                	for(var i =0;i<data1.length;i++){
				                		$(".stele_header marquee").html('').append(
				                			''+data1[0]+''+data1[1]+''+data1[2]+''
				                		);
				                	}
				                },
				                error:function(e){
				                    alert("出现错误！！!");
                                }
			                });
		    	});
		    	$(".to_recharge").click(function(){
		    		window.location="recharge";
		    	});
		    	$(".to_recharge").height($(".mask_cont_bg").height()*0.17647);
		    	$(".cancel").click(function(){
		    		$(".mask_bg").css("display","none");
		    	});
		    		
		    	}
		    });
		});
		
		$(".navbar3").click(function(){
			window.location="msg_alb?s=<?=$stele_id?>";
		});
		$(".navbar4").click(function() {
			$(".lists").css("display","block");
			
			$(".cli_bg").animate({
				height: "70.3564%"
			}, 500);
			
			$(".cli_bg span").empty().append("动态");
			$(".list_logo").empty().append("<img src='<?=$inc_url?>img/trends_logo.png' >");
			
			$(".list_cont").empty().append(
				"<ul class='cbp_tmtimeline'>" +
				<?php if(!empty($give_list['today'])){?>
					"<li class='today_li'>" +
					"<time class='cbp_tmtime' datetime='今天'>" +
					"<span>今天</span></time>" +
//					"<div class='labels'>"+
					<?php foreach ($give_list['today'] as $today_item): ?>
						"<div class='cbp_tmlabel'>" +
						"<p class='date'><?=date('m月d日  H:i',$today_item['time'])?></p>" +
						"<p class='info'><?=$today_item['nickname'].$today_item['gift_action'].$today_item['gift_count'].$today_item['gift_unit'].$today_item['name']?></p>" +
						"</div>" +
					<?php endforeach; ?>
//					"</div>"+
					"</li>" +
				<?php }?>
				<?php if(!empty($give_list['yesterday'])){?>
					"<li class='yesterday_li'>" +
					"<time class='cbp_tmtime' datetime='昨天'>" +
					"<span>昨天</span></time>" +
					<?php foreach ($give_list['yesterday'] as $yesterday_item): ?>
						"<div class='cbp_tmlabel'>" +
						"<p class='date'><?=date('m月d日  H:i',$yesterday_item['time'])?></p>" +
						"<p class='info'><?=$yesterday_item['nickname'].$yesterday_item['gift_action'].$yesterday_item['gift_count'].$yesterday_item['gift_unit'].$yesterday_item['name']?></p>" +
						"</div>" +
					<?php endforeach; ?>
					"</li>" +
				<?php }?>
				<?php if(!empty($give_list['lastday'])){?>
					"<li class='lastday_li'>" +
					"<time class='cbp_tmtime' datetime='更早'>" +
					"<span>更早</span></time>" +
					<?php foreach ($give_list['lastday'] as $lastday_item): ?>
						"<div class='cbp_tmlabel'>" +
						"<p class='date'><?=date('m月d日  H:i',$lastday_item['time'])?></p>" +
						"<p class='info'><?=$lastday_item['nickname'].$lastday_item['gift_action'].$lastday_item['gift_count'].$lastday_item['gift_unit'].$lastday_item['name']?></p>" +
						"</div>" +
					<?php endforeach; ?>
					"</li>" +
				<?php }?>
				"</ul>"
			);
			
			
			
			$(".cbp_tmtime span").height($(".cbp_tmtime span").width());
			$(".cbp_tmtime span").css("line-height", $(".cbp_tmtime span").width() + "px");
            var ctpt = parseInt($(".cbp_tmlabel").css("padding-top"));
			$(".cbp_tmtime span").css("margin-top", ($(".cbp_tmlabel").height()+ctpt*2-$(".cbp_tmtime span").height())/2-2)+"px";
		});
		
		
		$(".closed").click(function() {
			$(".cli_bg").animate({
				height: "0"
			}, 500);
			
			$(".lists").fadeOut(500);
		});
		
		$(".navbar5").click(function() {
			alert("正在生成邀请函，请稍候！");
			$(".navbar5").removeClass();
			$.get("ste_ercode?stele_id=<?=$stele_id?>",function(){
	    		alert("邀请函已通过公众号发送至您的微信，请返回公众号查看");
	    	});
		});
		
		
		
		
		
	</script>

</html>