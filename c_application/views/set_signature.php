<!DOCTYPE html>
<html>

	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0" charset="UTF-8">
		<title>設置個性簽名</title>
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
		<?php echo form_open('set_signature/update',array('name' => 'myForm', 'onsubmit' => 'return check()'));?>
			<input type="hidden" name="user_id" value="<?=$user_id?>">
			<input type="text" name="setSign" value="<?=$my_words?>" placeholder="请输入您的个性签名" maxlength="18" />
			<button type="submit" class="btn">确定</button>
		</form>
	</body>

	<script type="text/javascript" src="<?=$inc_url?>js/jquery-2.2.3.min.js"></script>
	<script>
		myForm.setSign.focus();
		function check(){
			if(myForm.setSign.value==''){
				alert("个性签名不能为空！");
				myForm.setSign.focus();
				return false;
			}else{
				return true;
			}
		}
	</script>

</html>