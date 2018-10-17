<?php $this -> load -> view('header'); ?>
		<title>新建传承碑</title>
		<link rel="stylesheet" href="<?=$inc_url?>css/new_heritage.css" />
		<script src="<?php echo $inc_url;?>js/new_heritage.js"></script>
	</head>
	<body>
		<h2 class="page-title">填写基本资料<a href="javascript:history.back(-1)"><span></span></a></h2>
		<img class="title-pic" src="<?php echo $inc_url; ?>img/edit_top.png"/>
		<?php $this -> load -> view('navbar'); ?>
		<section class="page-content clearfloat">
		<form id="commentForm" name="comment-form" novalidate="novalidate">
			<div class="info-text left">
				<div class="info-item info-must">
					<input type="text" class="info-name" placeholder="点击输入姓名" data-name="nickname" @change="valChange">
				</div>
				<div class="info-item info-must">
					<span class="left">性别：</span>
					<ul class="sex-list left">
						<li class="on" data-val="1" @click="setSex">男</li>
						<li @click="setSex" data-val="2">女</li>
					</ul>
				</div>
				<div class="info-item">
					<span>生平：</span>
					<input type="text" placeholder="1960.1.1" style="text-align:center" data-name="birthday" @change="valChange">
					<span>-</span>
					<input type="text" placeholder="2018.1.1" style="text-align:center" data-name="day_of_death" @change="valChange">
				</div>
				<div class="info-item">
					<span>个人简介：</span>
					<input type="text" id="" placeholder="说点啥…" data-name="birthday" @change="intro_yourself">
				</div>
			</div>
			<div class="info-img right">
				<a href="javascript:void(0);" class="img-btn" @click="setAvatar" id="imgBtn"></a>
				<input type="file" name="aa" id="avatar" @change="imgReader" style="display:none;">
			</div>
		</form>
		</section>
		<section class="page-submit">
			<a href="javascript:void(0);" class="submit-btn void" id="submitBtn" @click="submitForm">提交</a>
			<span>(“*” 为必填项)</span>
		</section>
		<div class="mask" id="mask">
			<div class="mask-shadow"></div>
			<div class="mask-con">
				<p>√已成功建立碑卡</p>
				<span>(页面将自动跳转…)</span>
			</div>
		</div>
	</body>
</html>
