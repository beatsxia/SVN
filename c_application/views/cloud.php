<?php $this -> load -> view('header'); ?>
		<title>传承碑</title>
		<link rel="stylesheet" href="<?php echo $inc_url; ?>css/cloud.css" />
	</head>
	<body>
		<div class="sky">
			<div class="msg_board">
				<img src="<?php echo $inc_url;?>img/msg_board.png"  />
			</div>
			<div class="clouds_one"></div>
			<div class="clouds_two"></div>
			<div class="cli_tips">
				<div class="personal_id">
					<img src="<?php echo $inc_url;?>img/identify.png" />
				</div>
				<div class="photo">
					<img src="<?php echo $inc_url;?>img/photo.png" />
				</div>
				<?php if(!empty($stele_inh_id)&&$stele_inh_id!='0'){?>
					<div class="turn_back_heritage">
						<img src="<?php echo $inc_url;?>img/turn_back_heritage.png" />
					</div>
				<?php }?>
			</div>
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

	<script type="text/javascript" src="<?php echo $inc_url; ?>js/jquery-2.1.1.min.js"></script>
	<script>
var offsetVal = '';
window.onload = function() {
	if($(".sky").css("display", "none")) {
		$(".sky").css("display", "block");
	} else {
		$(".sky").css("display", "none");
	}
	$(".photo").click(function(){
		window.location="photos?s=<?=$stele_id?>"
	});
	$(".personal_id").click(function(){
		window.location="identify?s=<?=$stele_id?>"
	});
	$(".turn_back_heritage").click(function(){
		window.location="show_article?inh_id=<?=$stele_inh_id?>"
	});
	$(".msg_board").click(function(){
		window.location = "mask_msg?s=<?=$stele_id?>"
	})
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
	$(".sky").css("-webkit-animation","sky_background 6s ease-out 1");
	$(".sky").css("-moz-animation","sky_background 6s ease-out 1");
	$(".sky").css("-o-animation","sky_background 6s ease-out 1");
	$(".sky").css("animation","sky_background 6s ease-out 1");
	$(".sky").css("-webkit-transform","translate3d(0, 0, 0)");
	$(".sky").css("-moz-transform","translate3d(0, 0, 0)");
	$(".sky").css("-o-transform","translate3d(0, 0, 0)");
	$(".sky").css("transform","translate3d(0, 0, 0)");
	$(".sky").css("opacity","1");
	
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


</script>
</html>