<?php $this -> load -> view('header'); ?>
		<title>传承碑等级说明</title>
		<script src="https://cdn.bootcss.com/react/16.4.0/umd/react.development.js"></script>
		<script src="https://cdn.bootcss.com/react-dom/16.4.0/umd/react-dom.development.js"></script>
		<!-- 生产环境中不建议使用 -->
		<script src="https://cdn.bootcss.com/babel-standalone/6.26.0/babel.min.js"></script>
		<link rel="stylesheet" href="<?php echo $inc_url; ?>css/level_explain.css" />
		<script type="text/babel" src="<?php echo $inc_url;?>js/level_explain.js"></script>
	</head>
	<body>
		<h2 class="page-title"><a href="javascript:history.back(-1)"><span></span></a>传承碑等级说明</h2>
		<img class="title-pic" src="<?php echo $inc_url; ?>img/edit_top.jpg"/>
		<section id="content1"></section>
		<section id="content2"></section>
		<section id="content3"></section>
	</body>
</html>