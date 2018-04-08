<!DOCTYPE html>
<html>

	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0" charset="UTF-8">
		<title>常見問題與反饋</title>
	</head>
	
	<link rel="stylesheet" href="<?php echo $inc_url;?>css/suggestions.css" />

	<body>
		<?php echo form_open_multipart('suggestions/new_sug',array('method' => 'post','id' => 'myForm', 'name' => 'form1'));?>
			<h2>问题和意见</h2>
			<textarea name="suggestion" id="txt" placeholder="请填写10个字以上的问题描述以便我们提供更好的帮助"></textarea>
			<h3 id="show">0/200</h3>
			<h2>联系电话或QQ号</h2>
			<input name="phone_num" id="ipt" placeholder="选填，便于我们与你联系" />
			<button type="submit" id="sub">提交</button>
		</form>
	</body>

	<script type="text/javascript" src="<?php echo $inc_url;?>js/jquery-2.1.1.min.js"></script>
	<script type="text/javascript" src="<?php echo $inc_url;?>js/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?php echo $inc_url;?>js/suggestions.js"></script>

</html>