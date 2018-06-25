<!DOCTYPE html>
<html>

	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0" charset="UTF-8">
		<title>设置昵称</title>
	</head>

	<style>
		* {
			padding: 0;
			margin: 0;
		}
		
		body {
			min-height: 100%;
			background: #EFEFF4;
		}
		
		input {
			width: 96%;
			border: 1px #DEDEDE solid;
			outline: none;
			line-height: 35px;
			font-size: 14px;
			color: #000000;
			letter-spacing: 0.5px;
			margin: 4% 0;
			padding: 0 2%;
		}
		
		.btn {
			background: #FB6362;
			color: #FFF8FC;
			padding: 5px 11px;
			border: 0;
			font-size: 13px;
			letter-spacing: 0.5px;
			border-radius: 7px;
			outline: none;
			cursor: pointer;
			float: right;
			margin-right: 4%;
		}
		
		::-webkit-input-placeholder {
			color: #B8B8B8;
		}
		
		:-moz-placeholder {
			color: #B8B8B8;
		}
		
		::-moz-placeholder {
			color: #B8B8B8;
		}
		
		:-ms-input-placeholder {
			color: #B8B8B8;
		}
		
		::placeholder {
			color: #B8B8B8;
		}
	</style>

	<body>
		<form action="#" method="post" name="myForm" onsubmit="return check()">
			<input type="text" name="setNicname" value="" placeholder="请输入您的昵称" maxlength="18" />
			<button type="submit" class="btn">确定</button>
		</form>
	</body>

	<script type="text/javascript" src="<?=$inc_url?>js/jquery-2.2.3.min.js"></script>
	<script>
		myForm.setNicname.focus();
		function check(){
			if(myForm.setNicname.value==''){
				alert("昵称不能为空！");
				myForm.setNicname.focus();
				return false;
			}else{
				return true;
			}
		}
	</script>

</html>