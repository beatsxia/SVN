<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0" charset="UTF-8">
		<title>激活兑换</title>
	</head>
	<style>
		*{
			padding: 0;
			margin: 0;
		}
		body{
			background: url(<?=$inc_url ?>img/activation_bg.jpg) no-repeat;
			background-position: center center;
			background-size: 100% 100%;
		}
		.activation_code{
			/*margin-top: 27%;*/
			margin-bottom: 2.85%;
			background: #fff;
			width: 85.867%;
			margin-left: 7.0665%;
			position: absolute;
		}
		.activation_is_ok{
			position: absolute;
			background: #fff;
			width: 85.867%;
			margin-left: 7.0665%;
			border-radius: 5px;
			text-align: center;
			letter-spacing: 0.8px;
			color: #592521;
			border: 0;
			outline: none;
			font-size: 16px;
		}
		.activation_code input{
			display: block;
			height: 100%;
			width: 97%;
			margin: 0 auto;
			border: 0;
			outline: none;
			color: #592521;
		}
		::-webkit-input-placeholder {
            color: #592521;
        }
        :-moz-placeholder {
            color: #592521;
        }
        ::-moz-placeholder {
            color: #592521;
        }
        :-ms-input-placeholder {
            color: #592521;
        }
        ::placeholder {
            color: #592521;
        }
	</style>
	<body>
			<input type="hidden" id="stele_id" name="stele_id" value="<?=empty($stele_id)?'':$stele_id;?>" />
		    <div class="activation_code">
			    <input type="text" placeholder="输入激活码" id="activation_code" name="activation_code" value="" />
		    </div>
		    <button type="submit" id="activation_form" class="activation_is_ok">立即激活</button>
	</body>
	<script type="text/javascript" src="<?php echo $inc_url; ?>js/jquery-2.1.1.min.js"></script>
	<script>
	    $("body").height($(window).height());
	    $(".activation_code").height($(window).height()*0.04975);
	    $(".activation_code").css("top",$(window).height()*0.2985);
	    $(".activation_is_ok").height($(window).height()*0.04975);
	    $(".activation_is_ok").css("top",$(window).height()*0.37977);
	    $(".activation_is_ok").css("line-height",$(".activation_is_ok").height()+"px");
	    
	    $("#activation_form").click(function(){
	    	if($(".activation_code input").val()==''){
	    		alert("请输入激活码！")
	    	}else{
	    		var activation_code = $("#activation_code").val();
	    		$.ajax({
	    			type:"post",
	    			url:"activation_converbility/use_card",
	    			async:true,
	    			data:{
	    				stele_id:<?=empty($stele_id)?'0':$stele_id;?>,
	    				activation_code:activation_code
	    			},
	    			success:function(data){
	    				console.log(data);
	    				alert(data.hint)
	    			}
	    		});
	    	}
	    });
	</script>
</html>
