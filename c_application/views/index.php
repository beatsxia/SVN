<!DOCTYPE html>
<html lang="zh-CN">

	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0" charset="UTF-8">
		<title>傳承碑</title>
	</head>

	<link rel="stylesheet" href="<?php echo $inc_url; ?>css/bootstrap.min.css" />
	<link rel="stylesheet" href="<?php echo $inc_url; ?>css/index.css" />

	<body>
		<?php $this -> load -> view('navbar'); ?>
		<div class="tab-content">
			<div class="tab-pane fade in active" id="index">
				<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
					<!-- Indicators -->
					<ol class="carousel-indicators">
						<li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
						<li data-target="#carousel-example-generic" data-slide-to="1"></li>
						<li data-target="#carousel-example-generic" data-slide-to="2"></li>
					</ol>

					<!-- Wrapper for slides -->
					<div class="carousel-inner" role="listbox">
						<div class="carousel-inner">
							<?php foreach($advertisement as $key =>$value){ ?>
								<div class="item <?php echo ($key == '0')?'active':''; ?> ">
									<a href="<?=$value['link']?>"><img src="<?php echo $inc_url; ?><?=$value['picture']?>" alt="<?=$value['title']?>"></a>
								</div>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
			<!--tab-content-->
		</div>
		
		<div class="new_send">
			新建传记
		</div>
		
		<div class="dynamics">
			<span class="root_dynamics">传承碑动态</span>
			<span class="all_dynamics">查看全部动态</span>
		</div>
		
		
		<div class="biography_info">
			<?php foreach ($rolling_content_arr as $item): ?>
			<div class="info_section" href="<?=$item['inh_id']?>">
				<div class="info_cover" style="background: url(<?=$item['picture']?>) no-repeat;background-size: cover;background-position: center center;">
				</div>
				<div class="info_words">
					<h4><?=$item['title']?></h4>
					<p><?=$item['describe']?></p>
					<div class="author_info">
						<img src="<?=$item['avatar']?>" />
						<span><?=$item['nickname']?></span>
					</div>
				</div>
			</div>
			<?php endforeach; ?>
		</div>
		
		
		<div class="bottom" style="width: 100%;height: 50px;"></div>
	</body>

	<script type="text/javascript" src="<?php echo $inc_url; ?>js/jquery-2.1.1.min.js"></script>
	<script type="text/javascript" src="<?php echo $inc_url; ?>js/bootstrap.min.js"></script>
	<script>
		$(function() {
            $(".info_section").click(function(){
	            var href = $(this).attr("href");
	            window.location = "root_new_set?inh_id="+href;
            });
		});
		$(function(){
			$(".dynamics").click(function(){
				window.location = "more";
			});
		});
		$(function(){
			$(".new_send").click(function(){
				window.location = "edit_new_heritage";
			});
		});
	</script>
</html>