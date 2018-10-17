<?php $this -> load -> view('header'); ?>
		<title>传承碑</title>
        <link rel="stylesheet" href="<?php echo $inc_url;?>css/heritage_monument.css" />
        <script src="<?php echo $inc_url;?>js/heritage_monument.js"></script>
	</head>

	<body>
		<h2 class="page-title">传承碑</h2>
		<img class="title-pic" src="<?php echo $inc_url; ?>img/edit_top.png"/>
		<?php $this -> load -> view('navbar'); ?>
		<section class="page-top" id="switchList">
			<a href="javascript:void(0);" @click="switchType" data-tab="my" class="on">我的传承碑</a>
			<a href="javascript:void(0);" @click="switchType" data-tab="collect">我的收藏</a>
		</section>
		<section class="my-stele stele-tab" data-page="1" @touchend="endPull" @touchmove="pullUp">
			<a href="javascript:void(0);" class="add-stele" @click="addStele">新建传承碑卡</a>
            <ul class="stele-list">
                <?php foreach($stele as $item){ ?>
                <li class="stele-item clearfloat">
                    <?php if($item["is_open"] != 1){?>
                    <span class="remove-stele" data-id="<?=$item['id']?>" @click="showMask"></span>
                    <?php } ?>
                    <h3 class="stele-title"><?=$item["title"]?></h3>
                    <div class="text-info left">
                        <p>姓名 : <?=$item["title"]?></p>
                        <p>性别 : <?=($item["sex"]==1)? "男" : (($item["sex"]==2) ? "女" : "未知")?></p>
                        <p>生平 : <?=($item["birthday_time"]) ? $item["birthday_time"] : "???"?>-<?=($item["death_time"]) ? $item["death_time"] : "???"?></p>
                    </div>
                    <div class="img-info right">
                        <a href="javascript:void(0);" data-id="<?=$item['id']?>" @click="loadDetails">
                            <img src="<?=!empty($item['picture'])?$item['picture']:$inc_url.'img/user_head.png'?>" alt="头像">
                        </a>
                    </div>
                </li>
                <?php } ?>
            </ul>
            <p class="moreTips">----------上拉加载更多----------</p>
		</section>
		<section class="collect-stele stele-tab" style="display:none;">
            <ul class="stele-list">
                <?php foreach($stele_collection["content"] as $item2){ ?>
                <li class="collection-item clearfloat" @touchstart="slideStart" @touchmove="slideIng" @touchend="slideEnd">
                    <?=$item2["title"]?>
                    <img src="<?=!empty($item2['picture'])?$item2['picture']:$inc_url.'img/user_head.png'?>" alt="头像">
                    <span class="cancel-collect" @click="gg">取消收藏</span>
                </li>
                <?php } ?>    
            </ul>
            <p class="moreTips">----------上拉加载更多----------</p>
        </section>
        <div id="mask">
            <div class="mask-con clearfloat">
                <p>确定删除?</p>
                <a href="javascript:void(0);" class="left" @click="removeStele">确定</a>
                <a href="javascript:void(0);" class="right" @click="closeMask">取消</a>
            </div>
        </div>
        <div id="loading" class="loading">
            <span></span>
        </div>
	</body>

	<script type="text/javascript" src="<?php echo $inc_url; ?>js/dropload.min.js"></script>
</html>
