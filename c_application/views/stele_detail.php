<?php $this -> load -> view('header'); ?>
		<title>传承碑</title>
		<link rel="stylesheet" href="<?php echo $inc_url; ?>css/stele_detail.css" />
		<script src="<?php echo $inc_url;?>js/stele_detail.js"></script>
	</head>
	<body>
		<h2 class="page-title">传承碑<a href="javascript:history.back(-1)"><span></span></a></h2>
		<img class="title-pic" src="<?php echo $inc_url; ?>img/edit_top.jpg"/>
		<section class="info">
			<div class="stele-item clearfloat">
				<h3 class="stele-title"><?=$stele_info['title']?></h3>
				<div class="text-info left">
					<p>姓名 : <?=$stele_info['title']?></p>
					<p>性别 : <?php if($stele_info['sex']==1){echo '男';}elseif($stele_info['sex']==2){echo '女';}else{echo '未公开';}?></p>
					<p>生平 : <?=$stele_info['birthday_time']?> - <?=$stele_info['death_time']?></p>
				</div>
				<div class="img-info right">
					<a href="javascript:void(0);" data-id="23" @click="loadDetails">
						<img src="<?=$stele_info['picture']?>" alt="头像">
					</a>
				</div>
			</div>
			<div class="toMountain">
				<a href="javascript:void(0);" class="btn">进入碑谷</a>
			</div>
			<div class="num-info">
				<div class="num-text">
					<a href="javascript:void(0);" @click="jumpTo" data-href="level_explain">等级</a>
					<a href="javascript:void(0);" @click="showEnergyList">能量榜</a>
				</div>
				<div class="num-right">
					<div class="level">
						<span class="now">LV0</span>
						<span class="ex"></span>
						<span class="next">LV1</span>
						<span class="btn">+能量</span>
					</div>
					<div class="energy">
						<a href="javascript:void(0);"></a>
					</div>
				</div>
			</div>
		</section>
		<section class="inh clearfloat">
			<div class="inh-left left">
				<img src="<?=$stele_link_inh['picture']?>" alt="">
				<time datetime="<?=date('Y-m-d',$stele_link_inh['add_time'])?>">
					<?=date('Y年m月d日',$stele_link_inh['add_time'])?>
				</time>
			</div>
			<div class="inh-right right">
				<h3 class="title">
					<?=$stele_link_inh['title']?>
					<a href="javascript:void(0);">进入传记&gt;</a>
				</h3>
				<p class="inh-text">
					<?=$stele_link_inh['inh_stage']?>
				</p>
			</div>
		</section>
		<section class="file">
			<h3 class="title">
				图片和影像
				<a href="javascript:void(0);">查看全部&gt;</a>
			</h3>
			<ul class="file-list clearfloat">
				<li></li>
				<li></li>
				<li></li>
				<li></li>
				<li></li>
				<li></li>
				<li></li>
				<li></li>
			</ul>
		</section>
		<div class="energy-list" id="energyList">
			<span class="close" @click="closeEnergyList"></span>
			<h3 class="title">能量榜</h3>
			<ul class="energy-head">
				<li>
					<span>排名</span>
					<span>用户</span>
					<span>贡献值</span>
				</li>
			</ul>
			<ol class="energy-body">
				<?php foreach ($top_10 as $key => $item): ?>
					<li <?php if($item['id'] == $uid){echo 'class="me"';}?>>
						<span class="<?php if($key<3){echo 'ranking'.($key+1);}?>"><?=$key+1?></span>
						<span><?=$item['nickname']?></span>
						<span><?=$item['user_gives']?></span>
					</li>
				<?php endforeach; ?>
				</li>
			</ol>
		</div>

		<div style="height:2rem;"></div>
		<nav class="page-nav">
			<a href="javascript:void(0);" class="nav-edit">编辑</a>
			<a href="javascript:void(0);" class="nav-add" @click="showBtnList" data-type="hide">
				<span class="photo-btn"></span>
				<span class="inh-btn"></span>
				<span class="video-btn"></span>
			</a>
			<a href="javascript:void(0);" class="nav-share">分享</a>
		</nav>
	</body>
</html>