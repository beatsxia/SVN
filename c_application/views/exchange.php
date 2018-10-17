<?php $this -> load -> view('header'); ?>
		<title>兑换</title>
		<!--<link rel="stylesheet" href="<?php echo $inc_url; ?>css/mine_info.css" />-->
	</head>
	<style type="text/css">
		*{
			font-size: 0.43rem;
			color: #000;
			background-size: 100%;
			background-repeat: no-repeat;
		}
		body{
			min-height: 100%;
			background: none;
			background-color: white;
		}
		section{
			width: 90%;
			height: auto;
			margin: 0 auto;
		}
		.code>*{
			float: left;
		}
		.code>label{
			display: block;
			font-size: 0.46rem;
			width: 20%;
			line-height: 0.88rem;
			text-align: right;
		}
		#code{
			display: block;
			border-radius: 5px;
			border: 1px solid #959595;
			height: 0.88rem;
			line-height: 0.88rem;
			color: #cdcdcd;
			padding:0 0.5rem;
			width: calc(80% - 1rem - 2px);
		}
		
		#subBtn{
			display: block;
			width: 2.65rem;
			height: 0.9rem;
			margin: 0.5rem auto;
			line-height: 0.9rem;
			background-color: #700001;
			color: #fff;
			text-align: center;
			border-radius: 5px;
		}
		.void{
			background-color: #5c5c5c !important;
		}
		.stele-list>ul>li{
			height: 1.63rem;
			background-image: url("<?=$inc_url?>img/exchange/steleBg.png");
			padding:0 0.5rem;
			margin-top: 0.5rem;
			line-height: 1.63rem;
			position: relative;
			white-space: nowrap;
			overflow: hidden;
		}
		.stele-list>ul>li>a{
			display: block;
			width: 0.5rem;
			height: 0.5rem;
			background-image: url("<?=$inc_url?>img/exchange/blur.png");
			position: absolute;
			top: 0;
			bottom: 0;
			margin:auto 0;
			right: 0.5rem;
		}
		.focus{
			background-image: url("<?=$inc_url?>img/exchange/focus.png") !important;
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
		<h2 class="page-title"><a href="javascript:history.back(-1)"><span></span></a>兑换</h2>
		<img class="title-pic" src="<?php echo $inc_url; ?>img/edit_top.jpg"/>
		<?php $this -> load -> view('navbar'); ?>
		<section class="code clearfloat">
			<label for="code">激活码:&nbsp;&nbsp;</label>
			<input type="text" id="code" value="" placeholder="输入激活码" @input="valLen" />
		</section>
		<section class="stele-list">
			<ul>
				<?php foreach($stelelist as $k=>$v){ ?>
				<li><?=$v["title"]?><a href="javascript:void(0);" @click="checked" data-id="<?=$v['id']?>"></a></li>
				<?php } ?>
			</ul>
		</section>
		<a href="javascript:void(0);" id="subBtn" class="void" @click="subCode">确定激活</a>
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
	subCode:function()
	{
		var code = document.getElementById("code").value;
		if(!!this.data.steleId && code.length > 0)
		{
			$.ajax({
				type:"post",
				url:"exchange/ajaxCode",
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
