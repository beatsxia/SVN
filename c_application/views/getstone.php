<?php $this -> load -> view('header'); ?>
		<title>领取灵石</title>
		<!--<link rel="stylesheet" href="<?php echo $inc_url; ?>css/mine_info.css" />-->
	</head>
	<style type="text/css">
		section{
			width: 7.1rem;
			margin:0 auto;
			height: auto;
		}
		section>a{
			display: block;
			width: 100%;
			height: 1.4rem;
			margin-top:0.8rem;
			background-color: #fff000;
			border-radius: 0.6rem;
			color: #000;
			text-align: center;
			line-height:1.4rem;
			font-size: 0.6rem;
			box-shadow:-2px -2px 2px rgba(0,0,0,0.3) inset;
			position: relative;
		}
		section>a:before{
			display: block;
			content: '';
			width: 100%;
			height: 100%;
			box-shadow:2px 2px 2px rgba(255,255,255,0.6) inset;
			position: absolute;
			top: 0;
			left: 0;
		}
		section>a:after{
			background-image: url('<?php echo $inc_url; ?>img/index/stone_s.png');
			display:inline-block;
			content: '';
			width:0.68rem;
			height:100%;
			background-size: 100%;
			background-repeat: no-repeat;
			background-position: center;
			vertical-align: top;
		}
		.void{
			background-color: #ededed !important;
		}
		section>p{
			text-align: center;
			font-size: 0.4rem;
		}
		#mask{
			position: fixed;
			top: 0;
			left: 0;
			width: 100%;
			height: 100%;
			background-color: rgba(0,0,0,0.2);
			text-align: center;
			display: none;
		}
		#mask>span{
			display: inline-block;
			margin-top: 3.5rem;
			background-color: white;
			padding: 0.5rem;
			font-weight: bold;
			border-radius: 10px;
		}
	</style>
	<body>
		<h2 class="page-title"><a href="javascript:history.back(-1)"><span></span></a>领取灵石</h2>
		<img class="title-pic" src="<?php echo $inc_url; ?>img/edit_top.jpg"/>
		<?php $this -> load -> view('navbar'); ?>
		<section>
			<a href="javascript:void(0);">领取灵石 </a>
			<a href="javascript:void(0);" class="void">VIP领取灵石</a>
			<p>(成为VIP，额外领取)</p>
		</section>
		<div id="mask">
			<span>激活成功！</span>
		</div>
	</body>
<script type="text/javascript">
Page({
	data:{
		steleId : undefined
	},
	onLoad:function()
	{
		
	},
	checked:function(e)
	{
		(!!document.getElementsByClassName("focus")[0]) ? document.getElementsByClassName("focus")[0].className = "" : "";
		e.obj.className   = "focus";
		this.data.steleId = e.obj.dataset.id*1;
	},
	valLen:function(e)
	{
		if(e.obj.value.length > 0)
		{
			document.getElementById("subBtn").className = "";
		}
		else
		{
			document.getElementById("subBtn").className = "void";
		}
	},
	subAdd:function()
	{	
		var code = document.getElementById("code").value;
		if(!!this.data.steleId && code.length > 0)
		{
			$.ajax({
				type:"post",
				url:"getstone/ajaxAddStone",
				data:{
            		"id"   : this.data.steleId,
            		"code" : code
            	},
            	datatype:"json",
            	async:true,
            	cache:false,
            	success:function(msg)
            	{
            		var result = msg;
            		if(result.code == 1)
            		{
            			document.getElementById("mask").style.display = "block";
            			setTimeout(function(){
            				window.location.href = "mine_info";
            			},3000);
            		}
            		else
            		{
            			showMsg(result.hint);
            		}
            	},
            	error:function()
            	{
            		showMsg("系统繁忙");
            	}
			});
		}
		else
		{
			showMsg("请输入激活码和选择相应的碑");
		}
	}
});
</script>
</html>
