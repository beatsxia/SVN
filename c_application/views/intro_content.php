<!DOCTYPE html>
<html>

	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0" charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<title>設置個人介紹</title>
	</head>

	<style type="text/css">
		* {
			padding: 0;
			margin: 0;
		}
		
		body {
			min-height: 100%;
			background: #F3F3F3;
		}
		
		.write_intro {
			width: 91.5%;
			margin: 2% 0;
		}
		
		.write_intro textarea {
			resize: none;
			outline: none;
			color: #B8B8B8;
			width: 100%;
			min-height: 200px;
			line-height: 20px;
			letter-spacing: 0.5px;
			font-size: 14px;
			border: none;
			padding: 2% 4.5%;
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
		
		.btn_sure {
			width: 100%;
			max-width: 94%;
			margin: 0 auto;
			text-align: right;
		}
		
		.btn_sure button {
			background: #FB6362;
			color: #FFF8FC;
			padding: 5px 11px;
			border: 0;
			font-size: 13px;
			letter-spacing: 0.5px;
			border-radius: 7px;
			outline: none;
			cursor: pointer;
		}
	</style>

	<body>
		<?php echo form_open('intro_content/update',array('name' => 'myForm', 'onsubmit' => 'return check()'));?>
			<input type="hidden" name="stele_id" value="<?=$stele_id?>">
			<div class="write_intro">
				<textarea class="intro_txta" name="intro_txta" placeholder="请输入个人介绍"><?=$synopsis?></textarea>
			</div>
			<div class="btn_sure">
				<button type="submit">完成</button>
			</div>
		</form>
	</body>

	<script src="<?=$inc_url?>js/jquery-2.2.3.min.js"></script>
	<script>
		function check() {
			if(myForm.intro_txta.value == '') {
				alert("个人介绍不能为空！");
				myForm.intro_txta.focus();
				return false;
			} else {
				return true;
			}

		}
	</script>

</html>