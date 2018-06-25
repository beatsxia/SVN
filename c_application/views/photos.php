<!DOCTYPE html>
<html>

	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0" charset="UTF-8">
		<title>新建相册</title>
	</head>

	<link rel="stylesheet" href="<?=$inc_url?>css/photos.css" />
	<style>
		.photo_cover_bg{
			background-size: cover;
			background-position: center center;
		}
	</style>

	<body>
		<div class="personal_header">
			<img src="<?=$inc_url?>img/personal_header_bg.png" />
		</div>
		<div class="main_photos">
			<?php if(!empty($stele_album_arr)){foreach ($stele_album_arr as $item): ?>
				<div class="photo_cover photo_cover_bg" style="background: url(<?=$item['pic_url']?>) no-repeat;"></div>
			<?php endforeach; }?>
			<div class="photo_cover photo_cover_new_add">
				<img src="<?=$inc_url?>img/new_add_pic.jpg" />
			</div>
		</div>
	</body>

	<script type="text/javascript" src="<?=$inc_url?>js/jquery-2.2.3.min.js"></script>
	<script>
		$(function(){
			$(".photo_cover_new_add").click(function(){
				window.location = "photos_second_page?s=<?=$stele_id?>"
			});
		});
	</script>

</html>