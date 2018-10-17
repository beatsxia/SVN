<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0" charset="UTF-8">
		<title>贡品</title>
		<script src="../include/js/flexible.js"></script>
		<link rel="stylesheet" type="text/css" href="../include/css/family_public.css"/>
		<link rel="stylesheet" type="text/css" href="../include/css/tribute.css"/>
	</head>
	
	<!--<link rel="stylesheet" href="<?php echo $inc_url; ?>css/user_ercode.css" />-->
	<body style="">
		<div class="back">
			<nav>
				<a href="javascript:void(0);" class="nav-item nav-on" title="1">祭奠</a>
				<?php foreach($group as $gk => $gv){?>
				<a href="javascript:void(0);" class="nav-item" title="<?=$gv["id"];?>"><?=$gv["name"];?></a>
				<?php };?>
				<a href="javascript:void(0);" class="nav-item" title="-1">（待开发）</a>
			</nav>
			<section class="content clearfloat">
				<!--直接赠送灵石-->
				<div class="tribute-item group-stone">
					<div class="big-stone">
						<img src="../include/img/family/tribute/stone.png"/>
						<span>【灵石赐福】</span>
					</div>
					<div class="num-edit right">
						<span>(直接赠送灵石)</span>
						<a href="javascript:void(0);" class="num-btn" data-on="-1">-</a>
						<input type="text" id="stoneNum" value="1" maxlength="2" />
						<a href="javascript:void(0);" class="num-btn" data-on="1">+</a>
						<a  href="javascript:void(0);" id="giveStone" class="exchange" data-price="1" data-name="灵石赐福" onclick="judge(0,this)">确定</a>
					</div>
				</div>
				<?php foreach($list as $key => $val){?>
				<div class="tribute-item group<?=$val["groupid"];?>">
					<div class="pic-bor">
						<img src="../include/<?=$val['pic'];?>" alt="" class="tribute-pic" />
					</div>
					<span class="tribute-time">有效期:<?=($val["aging"] > 3600*24)? ($val["aging"]/86400)."天" : ($val["aging"]/3600)."小时";?></span>
					<h3 class="tribute-name">[<?=$val["name"];?>]<?=$val["moral"];?></h3>
					<div class="tribute-info">
						<span class="stone-icon"></span>
						<span class="stone-num">X<?=$val["price"];?></span>
						<a  href="javascript:void(0);" class="exchange" data-price="<?=$val['price'];?>" data-name="<?=$val['moral'];?>" onclick="judge(<?=$val['id'];?>,this)">兑换</a>
					</div>
				</div>
				<?php };?>
				<div class="tribute-item group-1">敬请期待</div>
			</section>
		</div>
		<!--弹窗-->
		<div id="judge">
			<div id="shadow"></div>
			<div class="con">
				<p id="judName">兑换: </p>
				<div class="isok">
					<span class="stone-icon"></span>
					<span id="judNum" class="stone-num">X15</span>
					<a  href="javascript:void(0);" class="exchange" id="judOK">确定</a>
				</div>
			</div>
		</div>
		<!--提醒消息闪动-->
		<div id="remind">
			<span id="remindMsg"></span>
		</div>
	</body>
	<script type="text/javascript">
		var tributeId,stoneNum,numVal = 1;
		
		window.onload = function(){
			var navArr     = document.getElementsByClassName("nav-item");
			var tributeArr = document.getElementsByClassName("tribute-item");
			var closeJud   = document.getElementById("shadow");
			var judOK      = document.getElementById("judOK");
			
			document.getElementById("stoneNum").onchange = function()
			{
				var setNum = (this.value*1 > 99 || this.value*1 < 1) ? numVal : this.value;
				this.value = setNum;
				numVal     = setNum;
				document.getElementById("giveStone").setAttribute("data-price", setNum);
			}
			
			document.addEventListener("click", function(e = e || event){
				var target = e.target || e.srcElement;
				if (!!target) {
					if (target == closeJud) {
						var judgeobj = document.getElementById("judge");
						judgeobj.style.display = "none";
					}
					else if(target == judOK)
					{
						var xmlHttp = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject("Microsoft.XMLHTTP");
						
						xmlHttp.onreadystatechange = function()
						{
							if (xmlHttp.status == 200 && xmlHttp.readyState == 4) {
								//接收数据后
								var result = JSON.parse(xmlHttp.responseText);
								var judgeobj = document.getElementById("judge");
								judgeobj.style.display = "none";
								showMsg(result.msg);
							}
						}
						
						xmlHttp.open("GET", "http://www.ccb.hd/index.php/tribute/ajaxExchange?id=" + tributeId + "&sid=<?php echo $this->input->get('id');?>&num=" + stoneNum, true);
						xmlHttp.send();
					}
					else if(target.classList[0] == "num-btn")
					{
						
						var numObj   = document.getElementById("stoneNum");
						var setNum   = (numObj.value * 1) + (target.getAttribute("data-on") * 1);
						if (setNum < 100 && setNum >0) {
							numObj.value = setNum;
							document.getElementById("giveStone").setAttribute("data-price", setNum);
							numVal = setNum;
						}
					}
				}
				
			});
			
			for (var i = 0;i<navArr.length;i++) 
			{
				var groupItem;
				navArr[i].onclick = function()
				{
					groupItem = this.getAttribute("title");
					setArrClass(navArr,"nav-item");
					if(groupItem == 1)
					{
						setArrStyle(tributeArr,{"display":"block"});
						setArrStyle(document.getElementsByClassName("group-1"),{"display":"none"});
					}
					else
					{
						setArrStyle(tributeArr,{"display":"none"});
						var showArr = document.getElementsByClassName("group"+groupItem);
						setArrStyle(showArr,{"display":"block"});
					}
					this.className = "nav-item nav-on";
				}
			}
			
			function setArrStyle(objArr,styleArr)
			{
				for(var skey=0; skey<objArr.length; skey++)
				{
					objArr[skey].style.display = (styleArr.display !== undefined)? styleArr.display : objArr[skey].style.display;
				}
			}
			
			function setArrClass(objArr,className)
			{
				for(var skey=0; skey<objArr.length; skey++)
				{
					objArr[skey].className = className;
				}
			}
		}
		
		function judge(tid, self)
		{
			tributeId = tid*1;
			stoneNum  = (tid*1 == 0) ? self.getAttribute("data-price")*1 : 1;
			var judgeobj = document.getElementById("judge");
			document.getElementById("judName").innerText = "兑换 : " + self.getAttribute("data-name");
			document.getElementById("judNum").innerText  = "X" + self.getAttribute("data-price");
			judgeobj.style.display = "block";
		}
		
		function showMsg(msg)
		{
			var remind    = document.getElementById("remind");
			var remindMsg = document.getElementById("remindMsg");
			remindMsg.innerText = msg;
			remind.style.display = "block";
			setTimeout(function(){
				remindMsg.style.opacity = 0.7;
			},50);
			setTimeout(function(){
				remindMsg.style.opacity = 0;
			},1500);
			setTimeout(function(){
				remind.style.display = "none";
			},2500);
		}
	</script>
</html>
