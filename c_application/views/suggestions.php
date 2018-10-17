<?php $this -> load -> view('header'); ?>
		<title>常见问题</title>
		<link rel="stylesheet" href="<?php echo $inc_url;?>css/suggestions.css" />
	</head>
	<body>
		<h2 class="page-title"><a href="javascript:history.back(-1)"><span></span></a>常见问题</h2>
		<img class="title-pic" src="<?php echo $inc_url; ?>img/edit_top.jpg"/>
		<img class="content" src="<?php echo $inc_url; ?>img/index/suggestions.png"/>
		<!--<div style="display: none;">
			<?php echo form_open_multipart('suggestions/new_sug',array('method' => 'post','id' => 'myForm', 'name' => 'form1'));?>
				<h2>问题和意见</h2>
				<textarea name="suggestion" id="txt" placeholder="请填写10个字以上的问题描述以便我们提供更好的帮助"></textarea>
				<h3 id="show">0/200</h3>
				<h2>联系电话或QQ号</h2>
				<input name="phone_num" id="ipt" placeholder="选填，便于我们与你联系" />
				<button type="submit" id="sub">提交</button>
			</form>
		</div>-->
	</body>

	<script type="text/javascript" src="<?php echo $inc_url;?>js/jquery-2.1.1.min.js"></script>
	<script type="text/javascript" src="<?php echo $inc_url;?>js/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?php echo $inc_url;?>js/suggestions.js"></script>

</html>