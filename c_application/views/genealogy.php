<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0" charset="UTF-8">
		<title>家谱</title>
		<script src="../include/js/flexible.js"></script>
		<link rel="stylesheet" type="text/css" href="../include/css/family_public.css"/>
		<link rel="stylesheet" type="text/css" href="../include/css/genealogy.css"/>
	</head>
	<!--<link rel="stylesheet" href="<?php echo $inc_url; ?>css/user_ercode.css" />-->
	<body>
		<div class="bgimg">
			<!--头部-->
			<nav>
				<a href="javascript:void(0);" class="nav-item" style="background-image: url('../include/img/family/icon/返回.png');"></a>
				<a href="javascript:void(0);" class="nav-item" style="background-image: url('../include/img/family/icon/B编辑2.png');"></a>
				<a href="javascript:void(0);" class="nav-item" style="background-image: url('../include/img/family/icon/J家谱2.png');"></a>
				<a href="javascript:void(0);" class="nav-item" style="background-image: url('../include/img/family/icon/S删除.png');"></a>
			</nav>
			<!--双亲的信息-->
			<section class="parents">
				<div class="info left">
					<span class="name">♂xxx</span>
					<a href="javascript:void(0);" class="btn"></a>
				</div>
				<div class="info right">
					<span class="name">♀xxx</span>
					<a href="javascript:void(0);" class="btn"></a>
				</div>
			</section>
			<!--本人的信息-->
			<section class="self">
				<div class="info left self-info">
					<span class="name">♂xxx</span>
					<a href="javascript:void(0);" class="btn"></a>
				</div>
				<div class="info right">
					<span class="name">♀xxx</span>
					<a href="javascript:void(0);" class="btn"></a>
				</div>
			</section>
			
			
		</div>
		
		<div class="mask-right">
			<a href="javascript:void(0);" class="right-btn" style="background-image: url('../include/img/family/icon/D动态.png');"></a>
			<a href="javascript:void(0);" class="right-btn" style="background-image: url('../include/img/family/icon/Y邀请.png');"></a>
			<a href="javascript:void(0);" class="right-btn" style="background-image: url('../include/img/family/icon/S收藏.png');"></a>
		</div>
		<div class="mask-bottom">
			<div class="btm-btn">
				<a href="javascript:void(0);" class="btm-btn-item" style="background-image: url('../include/img/family/icon/J家祠.png');"></a>
				<a href="javascript:void(0);" class="btm-btn-item" style="background-image: url('../include/img/family/icon/F风水山.png');"></a>
				<a href="javascript:void(0);" class="btm-btn-item" style="background-image: url('../include/img/family/icon/B榜单.png');"></a>
			</div>
			<div class="btm-text"></div>
		</div>
		<div class="mask">
			<div class="info self-info" style="margin: 0 auto;box-shadow: none;margin-top: 1.1rem;">
				<span class="name">♂xxx</span>
				<a href="javascript:void(0);" class="btn"></a>
			</div>
			<span class="add-line">— 添加 —</span>
			<div class="add-list">
				<a href="javascript:void(0);" class="add-item">父亲</a>
				<a href="javascript:void(0);" class="add-item">母亲</a>
				<a href="javascript:void(0);" class="add-item">配偶</a>
				<a href="javascript:void(0);" class="add-item">子女</a>
			</div>
			<a href="javascript:void(0);" id="closeMask">关闭</a>
		</div>
	</body>
</html>
