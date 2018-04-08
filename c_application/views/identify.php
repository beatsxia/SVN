<!DOCTYPE html>
<html>

	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0" charset="UTF-8">
		<title>身份牌</title>
	</head>

	<link rel="stylesheet" href="<?=$inc_url ?>css/identify.css" />

	<body>
		<div class="personal_header">
			<img src="<?=$inc_url ?>img/personal_header_bg.jpg" />
		</div>
		<div class="user_header">
			<img class="user_header" src="<?=$stele['picture']?>" />
		</div>
		<div class="user_info">
			<div class="user_name">
				<?=$stele['title']?>
			</div>
			<!--
			<div class="sex_ima">
				<img src="<?=$inc_url ?>img/female.png" />
			</div>
			-->
		</div>
		<div class="mine_sign">
			<img src="<?=$inc_url ?>img/revise.png" />
			<span><?=$stele['my_words']?></span>
		</div>
		<div class="intro_yourself">
			<span></span>个人介绍 <strong>></strong>
		</div>
		<div class="intro_content">
			<!--这里展示个人介绍:-->
			<?=$stele['synopsis']?>
		</div>
		<div class="inh_ste">
			<span></span>传记
		</div>
		<?php if(!empty($stele_link_inh)){ ?>
		<div class="biography_info">
		    <div class="info_section">
			    <div class="info_cover" style="background: url(<?=!empty($stele_link_inh['pic1'])?$stele_link_inh['pic1']:$inc_url.'img/need_upload.jpg'?>) no-repeat;background-size: cover;background-position: center center;"></div>
			    <div class="info_words">
				    <h4><?=$stele_link_inh['title']?></h4>
				    <p class="inh_descri"><?=$stele_link_inh['inh_stage']?></p>
			    </div>
		    </div>
		</div>
		<?php }?>
	</body>

	<script type="text/javascript" src="<?php echo $inc_url; ?>js/jquery-2.1.1.min.js"></script>
	<script>
$(function(){
	$(".mine_sign").click(function(){
		window.location="set_sign?s=<?=$stele['id']?>"
	});
	$(".intro_yourself").click(function(){
		window.location="intro_content?s=<?=$stele['id']?>"
	});
	$(".info_section").click(function(){
		window.location= "root_new_set?inh_id=<?=$stele_link_inh['id']?>"
	});
});
    </script>  

</html>