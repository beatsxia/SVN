<!DOCTYPE html>
<html>

	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0" charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<title>新建留言</title>
	</head>

	<link rel="stylesheet" href="<?=$inc_url?>css/new_board.css" />

	<body>
		<?php echo form_open('new_board/insert',array('name' => 'myForm', 'onsubmit' => 'return check()'));?>
			<input type="hidden" name="stele_id" value="<?=$stele_id?>">
			<div class="write_board">
				<textarea class="board_txta" name="board_txta" placeholder="请输入留言"></textarea>
			</div>
			<div class="btn_sure">
				<button type="submit">完成</button>
			</div>
		</form>
	</body>

	<script src="<?=$inc_url?>js/jquery-2.2.3.min.js"></script>
	<script>
		function check(){
			if(myForm.board_txta.value==''){
				alert("留言不能为空！");
				myForm.board_txta.focus();
				return false;
			}else{
				return true;
			}
			
		}
	</script>

</html>