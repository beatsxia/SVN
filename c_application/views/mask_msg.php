<!DOCTYPE html>
<html>

	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0" charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<title>留言板</title>
	</head>
	<style>
		* {
	padding: 0;
	margin: 0;
}

body {
	background: url(<?php echo $inc_url; ?>img/mask_dusk_bg.jpg) no-repeat;
	background-size: 100% 100%;
	min-height: 100%;
	background-attachment: fixed;
}

.mask_bg {
	position: absolute;
	top: 0;
	left: 0;
	z-index: 1000;
	background-color: rgba(9, 9, 9, 0.33);
	width: 100%;
}

.zoom {
	position: absolute;
	-moz-transform: translate(-150px, -120px);
	-webkit-transform: scale(1.1) translate(-150px, -120px) skew(15deg, -30deg);
	-ms-transform: scale(1.1) translate(-150px, -120px) skew(15deg, -30deg);
	-o-transform: scale(1.1) translate(-150px, -120px) skew(15deg, -30deg);
	transform: scale(1.1) translate(-150px, -120px) skew(15deg, -30deg);
}

.mask_msg {
	width: 308px;
	height: 309px;
	margin: 0 auto;
	margin-top: 30%;
	background: url(<?php echo $inc_url; ?>img/msg_board_bg.png) no-repeat;
	background-size: 100% 100%;
	background-position: center center;
}

.mask_msg_bg {
	width: 308px;
	height: 309px;
	margin: 0 auto;
	margin-top: 30%;
	background: url(<?php echo $inc_url; ?>img/msg_board_bg.png) no-repeat;
	background-size: 100% 100%;
	background-position: center center;
	-webkit-transition: 0.1s;
	-moz-transition: 0.1s;
	-o-transition: 0.1s;
	transition: 0.1s;
}

.textarea {
	width: 94%;
	height: 44%;
	margin: 0 auto;
	display: block;
	resize: none;
	position: relative;
	top: 38%;
	outline: none;
	font-size: 14px;
	border: 0;
	line-height: 20px;
	letter-spacing: 0.5px;
	word-wrap: break-word;
	color: #535353;
	text-align: center;
}

.sure_btn {
	position: relative;
	top: 43%;
	text-align: center;
}

.sure_btn button {
	background: #FB6362;
	color: #FFF8FC;
	padding: 5px 11px;
	border: 0;
	font-size: 13px;
	letter-spacing: 0.5px;
	border-radius: 7px;
	outline: none;
	cursor: pointer;
}

.mask_msg_navbar {
	width: 100%;
	max-width: 88%;
	margin: 0 auto;
	overflow: hidden;
	text-align: center;
	margin-top: 3%;
}

.mask_msg_navbar img {
	width: 44%;
}

.fl_lt {
	width: 33.33%;
	float: left;
}

.nav_center {
	width: 33.34%;
	float: left;
}

.fl_rg {
	width: 33.33%;
	float: right;
}

.back_btn {
	width: 100%;
	max-width: 82%;
	margin: 24% auto;
	overflow: hidden;
	outline: none;
}

.btn_align_left {
	float: left;
	background: #FB6362;
	color: #FFF8FC;
	padding: 5px 8px;
	border: 2px #FDFFFA solid;
	font-size: 12px;
	letter-spacing: 0.5px;
	border-radius: 7px;
	margin-top: 1px;
}

.btn_align_right {
	float: right;
	background: #FB6362;
	color: #FFF8FC;
	padding: 5px 14px;
	border: 2px #FDFFFA solid;
	font-size: 14px;
	letter-spacing: 0.5px;
	border-radius: 7px;
}</style>

	<body>
		<div class="mask_bg">
			<input type="hidden" id="offset" value="0"  />
			<div class="mask_msg">
			    <div class="mask_msg_bg">
				    <textarea name="msg_board_textarear" class="textarea" readonly="readonly"></textarea>
			    </div>
			</div>
			<div class="mask_msg_navbar">
				<div class="fl_lt"><img src="<?php echo $inc_url; ?>img/the_best_msg.png" /></div>
				<div class="nav_center"><img src="<?php echo $inc_url; ?>img/new_msg.png" /></div>
				<div class="fl_rg"><img src="<?php echo $inc_url; ?>img/next_msg.png" /></div>
			</div>
			<div class="back_btn"><button class="btn_align_left">我的留言</button><button class="btn_align_right">返回</button></div>
		</div>
	</body>

	<script type="text/javascript" src="<?php echo $inc_url; ?>js/jquery-2.1.1.min.js"></script>
	<script>
	var offsetVal = '';
	window.onload = function() {	
		var wdw_hgt = $(window).height();
		console.log(wdw_hgt)
		$("body").css({
			"height": "" + wdw_hgt + "px"
		});
	}
		
		offsetVal = $("#offset").val();
		$.ajax({
	        type: "POST",
	        url: "mask_msg/note",
	        data: {
		            stele_id : <?=$stele_id?>,
		            offset : offsetVal
		        },
	        dataType: "json",
			async: true,
			success: function(result) {
				$(".btn_align_right").click(function(){
					window.location = "cloud?s=<?=$stele_id?>"
				});
				$(".nav_center img").click(function(){
					window.location="new_board?s=<?=$stele_id?>"
				});
				$("#offset").val(result.offset);
				$("textarea").empty().append(result.content);
				if(result.content==''){
					$("textarea").empty().append(
						"没有更多留言了！"
					);
					$("#offset").removeAttr("value");
				}
		    }
	    });
		
		
		
		
		$(".fl_rg img").click(function(){
		    offsetVal = $("#offset").val();
		    $.ajax({
	            type: "POST",
	            url: "mask_msg/note",
	            data: {
		            stele_id : <?=$stele_id?>,
		            offset : offsetVal
		        },
	            dataType: "json",
			    async: true,
			    success: function(result) {
				    $("#offset").val(result.offset);
				    $("textarea").empty().append(result.content);
				    $(".mask_msg_bg").addClass("zoom").fadeOut(200, append);
		            function append() {
			            $(".mask_msg_bg").removeClass("zoom").appendTo(".mask_msg").show();
		            }
				    console.log(result)
				    if(result.content==''){
					    $("textarea").empty().append(
						    "没有更多留言了！"
					    );
					    $("#offset").removeAttr("value");
				    }
		        }
		    });
		});
		$(".btn_align_left").click(function(){
			window.location="my_msg?s=<?=$stele_id?>"
		});
		
		
		
		
	</script>

</html>