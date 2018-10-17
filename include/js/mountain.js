//定义各山的位置信息
var pos = [
	{"x":5.21,"y":0.20},//主山
	{"x":3.24,"y":0.77},//祖宗山
	{"x":4.24,"y":1.00},//穴位
	{"x":3.01,"y":1.15},//龙脉
	{"x":2.25,"y":1.41},//外青龙
	{"x":7.76,"y":1.41},//外白虎
	{"x":3.41,"y":1.90},//内青龙
	{"x":6.25,"y":1.90},//内白虎
	{"x":4.79,"y":2.19},//明堂
	{"x":2.66,"y":2.50},//虾须水
	{"x":3.75,"y":2.71},//案山
	{"x":6.98,"y":2.79},//龙虎水
	{"x":0.54,"y":2.91},//朱雀水
	{"x":9.22,"y":4.16},//水口山
	{"x":7.71,"y":4.37},//水口
	{"x":4.79,"y":4.53},//朝山
];

//位置设置函数
function setPos(objArr, unit)
{
	for(var i = 0; i < objArr.length; i++)
	{
		objArr[i].style.left = (pos[i].x - 0.10) * unit + "px";
		objArr[i].style.top  = (pos[i].y - 0.05) * unit + "px";
	}
}
Page({
	data:
	{
		
	},
	request:function(ask = {})
	{
		let str = "";
		for (let index in ask.data) 
		{
			str += "&" + index + "=" + ask.data[index];
		}
		str = (str.length > 0) ? str.substring(1) : str;
		ask.url = (ask.type.toUpperCase() == "GET") ? ask.url + "?" + str : ask.url;
		
		var xmlHttp = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject("Microsoft.XMLHTTP");
		xmlHttp.onreadystatechange = function()
		{
			if(xmlHttp.status ==200 && xmlHttp.readyState ==4)
			{
				let result;
				switch (ask.datatype.toUpperCase()){
					case "JSON":
						result = JSON.parse(xmlHttp.responseText);
						break;
					default:
						result = xmlHttp.responseText;
						break;
				}
				(!!ask.success && typeof(ask.success)=="function") ? ask.success(result) : console.log("未定义回调函数");
			}else if(xmlHttp.status ==404 && xmlHttp.readyState ==4)
			{
				(!!ask.error && typeof(ask.error)=="function") ? ask.error() : console.log("请求不到相应的页面");
			}
		}
		
		xmlHttp.open(ask.type.toUpperCase(), ask.url, true);
		if (ask.type.toUpperCase() == "POST") {
			xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			xmlHttp.send(str);
		} else{
			xmlHttp.send();
		}
	},
	onLoad:function()
	{
		this.setData({
			Dom:
			{
				viewBtn   : document.getElementById("viewBtn"),//视图切换按钮
				slideHill : document.getElementById("slideHill"),//大视图容器
				fixedHill : document.getElementById("fixedHill"),//小视图容器
				mask      : document.getElementById("mask"),//兑换遮罩层
				levelText : document.getElementById("levelText"),//等级文本
				hillName  : document.getElementById("hillName"),//山名
				hillPrice : document.getElementById("hillPrice")//价格
			}
		});
		
		var bgObj = document.getElementById("slideBg");//获取背景元素
		bgObj.parentNode.scrollLeft = (bgObj.clientWidth*1 - document.documentElement.clientWidth*1) / 2;
		
		var rem     = bgObj.clientWidth*1 / 10;
		var hillArr = slideHill.getElementsByTagName("a");
		setPos(hillArr ,rem);
	},
	chanView:function(e)//新版浏览器可以直接写成chanView(){}
	{
		var target  = e.obj;
		var onStyle = (target.dataset.on*1 == 0) ? 1 : 0;
		
		var dom = this.data.Dom;
		dom.slideHill.style.display = (onStyle == 0) ? "block" : "none";
		dom.fixedHill.style.display = (onStyle == 1) ? "block" : "none";
		target.dataset.on = onStyle;
	},
	chanMask:function(e)
	{
		var target  = e.obj;
		var dom = this.data.Dom;
		var onStyle = (target.dataset.on*1 == 0) ? "none" : "block";
		
		dom.mask.style.display = onStyle;
		
		dom.levelText.innerText = "等级到达 " + target.dataset.level + "级 可激活" || dom.levelText.innerText;
		dom.hillName.innerText  = "【" + target.dataset.name + "】" || dom.hillName.innerText;
		dom.hillPrice.innerText = (target.dataset.price != undefined && target.dataset.id*1 != -1) ? target.dataset.price : "已激活";
		dom.hillPrice.dataset.id = target.dataset.id || -1;
	},
	buyRequest:function(e)
	{
		var dom = this.data.Dom;
		var hid = dom.hillPrice.dataset.id;
		if(hid == -1)
		{
			dom.mask.style.display = "none";
			this.showMsg("你已激活该山脉");
			return;
		}
		this.request({
			type:"get",
			url :"http://www.ccb.hd/index.php/mountain/ajaxBuy",
			datatype:"json",
			data:{
				hid : hid,
				sid : $_GET["id"]
			},
			success:function(result)
			{
				dom.mask.style.display = "none";
				this.showMsg(result.msg);
				if(result.status == "ok")
				{
					let el = document.getElementsByClassName("hill-" + result.sort);
					for (let i =0; i < el.length; i++) {
						el[i].innerHTML  = "";
						el[i].dataset.id = -1;
					}
					let cel = document.getElementsByClassName("cloud-" + result.sort);
					for (let i2 =0; i2 < cel.length; i2++) {
						cel[i2].style.opacity = 0;
					}
				}
			}.bind(this),
			error:function()
			{
				this.showMsg("服务器繁忙");
			}.bind(this)
		});
	},
	showMsg:function(msg)
	{
		var remind    = document.createElement("div");
		var remindMsg = document.createElement("span");
		
		remind.setAttribute("style", "width:100%;height:auto;position:fixed;bottom:1.3rem;z-index:999;text-align:center;");
		remindMsg.setAttribute("style", "background-color:black;padding:0.15rem 0.2rem;font-size:0.35rem;color:white;border-radius:6px;opacity:0;transition:1.5s;");
		
		remindMsg.innerText = msg;
		remind.appendChild(remindMsg);
		document.body.appendChild(remind);
		
		setTimeout(function(){
			remindMsg.style.opacity = 0.9;
		},50);
		setTimeout(function(){
			remindMsg.style.opacity = 0;
		},1800);
		setTimeout(function(){
			remind.remove();
		},3000);
	}
});
