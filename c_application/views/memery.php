<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0" charset="UTF-8">
		<title>传承：为南京大屠杀死难者同胞献花</title>
	</head>
	
	<link rel="stylesheet" href="<?=$inc_url?>css/memery.css" />
	
	<body>
		<img src="<?=$inc_url?>img/memery_bg.jpg" style="width: 0;height: 0;" />
		<div class="present_flowers">
			<img src="<?=$inc_url?>img/present_flowers_btn.png" />
		</div>
		<div class="flowers">
			<img src="<?=$inc_url?>img/flowers_active.png" />
		</div>
		<div class="write_intro">
			<p>为抗战遇难同胞献花的人，</p>
			<p>牢记历史，勿忘国耻。</p>
			<button>点击这里 献花接力</button>
		</div>
		<div class="mask_tips">
			<img src="<?=$inc_url?>img/fly_tips.png"/>
			<p>点击右上角，分享到朋友圈</p>
		</div>
	</body>
	
	<script type="text/javascript" src="<?=$inc_url?>js/jquery-2.2.3.min.js" ></script>
	<script>
		$(function(){
			var winHgt = $(window).height();
			$("body").css("height",winHgt);
			
			$(".present_flowers img").click(function(){
				$(this).fadeOut(2000);
				$(".flowers img").css("animation","myfirst 2s");
				$(".flowers img").css("-webkit-animation","myfirst 2s");
				$(".flowers img").css("-moz-animation","myfirst 2s");
				$(".flowers img").css("-o-animation","myfirst 2s");
				$(".flowers img").css("animation-fill-mode","forwards");
				
				$.ajax({
			        type: "POST",
			        url: "give",
			        data: {
				            stele_id : <?=$stele_id?>,
				            gift_id : 1
				         },
			        dataType: "json",
					async: true,
					success: function(result) {
						$(".write_intro").prepend("<p>我是第&nbsp;<span>"+ result +"</span>&nbsp;个</p>");
						$(".write_intro").fadeIn(2000);
					}
			    });

			});
			
			$(".write_intro button").click(function(){
				$(".mask_tips").fadeIn(100);
			});
		})
	</script>
</html>
