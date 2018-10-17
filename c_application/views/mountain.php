<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0" charset="UTF-8">
		<title>风水山</title>
		<script src="../include/js/flexible.js"></script><!--http://g.tbcdn.cn/mtb/lib-flexible/0.3.4/flexible.js-->
		<link rel="stylesheet" type="text/css" href="../include/css/family_public.css"/>
		<link rel="stylesheet" type="text/css" href="../include/css/mountain.css"/>
		<script src="../include/js/main.js"></script>
		<script src="../include/js/mountain.js"></script>
	</head>
	<!--<link rel="stylesheet" href="<?php echo $inc_url; ?>css/user_ercode.css" />-->
	<body>
		<div class="bgimg">
			<div id="viewBtn" data-on="0" @click="chanView">（点击切换）</div>
			<!--风水山视图容器-->
			<section class="hill-view">
				<div id="slideHill">
					<img id="slideBg" src="../include/img/family/mountain/bigBg1.jpg"/>
					<?php foreach($hilllist as $key => $val){ ?>
					<a href="javascript:void(0);" class="hill-item hill-<?= $val['sort'];?>" style="background-image: url('../include/img/family/mountain/item/<?= $val['sort'];?>.png');" data-id="<?= (($val['price'] !=0) && (empty($val['mid']))) ? $val['id'] : -1;?>" data-name="<?=$val['name'];?>" data-level="<?=$val['level'];?>" data-price="<?=$val['price'];?>" data-on="1" @click="chanMask">
					<?php if( ($val['price'] !=0) && (empty($val['mid'])) ){ ?>
						<span class="lock"></span>
					</a>
					<img src="../include/img/family/mountain/cloud/c<?= $val['sort'];?>.png" class="cloud cloud-<?= $val['sort'];?>"/>
					<?php }else{ ?>
					</a>	
					<?php } } ?>
				</div>
				<div id="fixedHill">
					<?php foreach($hilllist as $key2 => $val2){ ?>
					<a href="javascript:void(0);" class="hill-item hill-<?= $val2['sort'];?>" style="background-image: url('../include/img/family/mountain/item/<?= $val2['sort'];?>.png');" data-id="<?= (($val2['price'] !=0) && (empty($val2['mid']))) ? $val2['id'] : -1;?>" data-name="<?=$val2['name'];?>" data-level="<?=$val2['level'];?>" data-price="<?=$val2['price'];?>" data-on="1"  @click="chanMask">
					<?php if( ($val2['price'] !=0) && (empty($val2['mid'])) ){ ?>
						<span class="lock"></span>
					</a>
					<img src="../include/img/family/mountain/cloud/cloud2/c<?= $val2['sort'];?>.png" class="cloud cloud2 cloud-<?= $val2['sort'];?>"/>
					<?php }else{ ?>
					</a>	
					<?php } } ?>
				</div>
			</section>
			<!--风水山视图容器-->
			<!--按钮组-->
			<div class="left-btn">
				<a href="javascript:void(0);" class="dynamic-icon"></a>
				<a href="javascript:void(0);" class="invite-icon"></a>
				<a href="javascript:void(0);" class="collection-icon"></a>
			</div>
			<div class="bottom-btn">
				<a href="javascript:void(0);" class="list-icon"></a>
				<a href="http://www.ccb.hd/index.php/ancestral_temple?id=<?=$info['id']?>" class="at-icon"></a>
				<div class="roll-area">
					<marquee class="roll-text" scrollamount="1">
						<?php foreach($dynamic as $dyKey => $dyVal){ ?>
						<span>
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						</span>
						<span><?php echo $dyVal["nickname"] . " 于" . date("Y年m月d日", $dyVal["givetime"]) . "献上了贡品 : " . (empty($dyVal["moral"]) ? "灵石x" . $dyVal["num"] : $dyVal["moral"]);?></span>
						<span>
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						</span>
						<?php } ?>
					</marquee>
					<div class="stone">
						<span class="stone-icon"></span>
						<span class="stone-val" style="font-family: '黑体';"> X<?=$userinfo["stone"]?></span>
					</div>
				</div>
			</div>
			<!--按钮组-->
		</div>
		<div id="mask">
			<span class="shadow"  data-on="0"  @click="chanMask"></span>
			<div class="mask-con">
				<span id="levelText">等级到达 0级 可激活</span>
				<span id="hillName">【】</span>
				<a href="javascript:void(0);" id="hillPrice" @click="buyRequest" data-id="-1">0</a>
			</div>
		</div>
	</body>
</html>