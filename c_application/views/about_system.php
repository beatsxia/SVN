<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0" charset="UTF-8">
		<title>關於系統版本</title>
	</head>
	
	<link rel="stylesheet" href="<?php echo $inc_url;?>css/about_system.css" />
	
	<body>
		<div class="logo">
			<img src="<?php echo $inc_url;?>img/logo1.png" />
			<h4>传承 Inheritance 1.0</h4>
		</div>
		<div class="main">
		    <h4>功能介绍</h4>
		    <div class="sections">
		    	<p class="section_one">传承是人类对于文化（包括技能，知识，科学，历史，宗教，思想，学说，生活方式，道德观念等）通过传授和继承的方式而使之得以延续、发展和演变的行为。</p>
		    	<p  class="section_two">传承是一种历史行为和社会现象，既存在于单个的人与人之间，更存在于家族、社团、民族乃至更广泛的社会群体之中。传承是人类延续文明、推进并提高文明程度的必不可少的条件之一。传承与动物的本能延续具有质的区别，是人类的自觉行为。传承通常需要借助教育和学习方能实现。</p>
		    </div>
		</div>
		<div class="foot">
			<div>广州传承网络科技有限公司</div>
			<span>传承公司&nbsp;版权所有</span>
			<span>Copyright &copy;2017 All Rights Reserved</span>
		</div>
	</body>
	<script type="text/javascript" src="<?php echo $inc_url; ?>js/jquery-2.1.1.min.js"></script>
	<script>
		$(".sections").height($(window).height()-$(".logo").height()-$("h4").height()-174);
	</script>
</html>
