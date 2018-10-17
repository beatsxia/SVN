var Page;/*申明页面中介函数*/

/*================== [	事件监听及数据渲染构造类    ] ==================*/
!(function(){
	/*定义各事件在标签的属性名称*/
	var EventList = 
	{
		click          : "@click",
		dblclick       : "@dblclick",
		touchstart     : "@touchstart",
		touchmove      : "@touchmove",
		touchend       : "@touchend",
		mousedown      : "@mousedown",
		mouseup        : "@mouseup",
		mouseover      : "@mouseover",
		mouseout       : "@mouseout",
		mousemove      : "@mousemove",
		mousewheel     : "@mousewheel",
		DOMMouseScroll : "@DOMMouseScroll",
		focusin        : "@focusin",
		focus          : "@focus",
		focusout       : "@focusout",
		blur           : "@blur",
		input          : "@input",
		change         : "@change",
		submit         : "@submit",
		keydown        : "@keydown"
	}
	
	var Main = function()
	{
		var page = this;
		
		window.onload = function()
		{
			/* 监听各种事件 */
			for(var Key in EventList)
			{
				document.addEventListener(Key, EventFn.bind(page), false);
			}
			
			if(!!page.onLoad && typeof(page.onLoad)=="function")
			{
				page.onLoad();
			}
		}

		/**将各函数的this指针指向page对象 */
		for(var pageKey in page)
		{
			if(typeof(page[pageKey]) == "function")
			{
				page[pageKey] = page[pageKey].bind(page);
			}
		}
		/*一些辅助函数*/
		Object.defineProperties(page, {
		    setData: {
		        configurable : false,
		        writable     : false,
		        value        : function(data){
					SetData.call(page.data, data);
				}
		    }
		});
	}
	
	/* 事件调用解析函数 */
	function EventFn(e)
	{
		e = e || window.event;//兼容问题
		var target = e.target || e.srcElement;
		if(!!target)
		{
			var clickObj = target;
			while( (clickObj.getAttribute(EventList[e.type]) == undefined) && (clickObj.tagName.toLowerCase() != "body") )
			{
				clickObj = clickObj.parentNode;
			}
			
			var fnName  = clickObj.getAttribute(EventList[e.type]);
			if(fnName == undefined || !isNaN(fnName))
			{
				return;
			}
			/* e.obj  = clickObj; */
			Object.defineProperty(e, "obj", {value:clickObj,writable:false});/*定义不可写属性*/
			
			var fn      = this[fnName];/* eval("this." + fnName); */
			
			(typeof(fn) == "function") ? fn.call(this, e) : console.log("没有找到定义的方法");
		}
	}
	
	function SetData(data)
	{
		for (var datakey in data) 
		{
			(typeof(this[datakey])=="object") ? SetData.call(this[datakey], data[datakey]) : this[datakey] = data[datakey];/* 数据递归处理 */
		}
	}
	
	function RenderData()
	{
		
	}
	
	/*页面中介函数*/
	Page = function(param)
	{
		Main.call(param);
	}
})();

function showMsg(msg)
{
	var remind    = document.createElement("div");
	var remindMsg = document.createElement("span");
	
	remind.setAttribute("style", "width:100%;height:auto;position:fixed;bottom:1.3rem;z-index:999;text-align:center;");
	remindMsg.setAttribute("style", "height: 0.5rem;display: inline-block;background-color:black;padding:0.15rem 0.25rem;font-size:0.35rem;color:white;border-radius:6px;opacity:0;transition:1.5s;line-height: 0.5rem;");
	
	remindMsg.innerHTML = msg;
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
};
var $_GET = (function(){
    var url = window.document.location.href.toString();
    var u = url.split("?");
    if(typeof(u[1]) == "string"){
        u = u[1].split("&");
        var get = {};
        for(var i in u){
            var j = u[i].split("=");
            get[j[0]] = j[1];
        }
        return get;
    } else {
        return {};
    }
})();

//循环处理dom函数
function setDomList(domList,modeList,len)
{
    if(!!len && len == 1)
    {
        for(var mKey in modeList)
        {
            if(typeof modeList[mKey]  == "object")
            {
                setDomList(domList[mKey], modeList[mKey], 1);
            }
            else
            {
                domList[mKey] = modeList[mKey];
            }
        }
    }
    else
    {
        for(var i=0; i<domList.length; i++)
        {
            for(var mKey in modeList)
            {
                if(typeof modeList[mKey]  == "object")
                {
                    setDomList(domList[i][mKey], modeList[mKey], 1);
                }
                else
                {
                    domList[i][mKey] = modeList[mKey];
                }
            }
        }
    }
}