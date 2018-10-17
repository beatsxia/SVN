Page({
    data:{
        
    },
    onLoad:function()
    {
        
    },
    jumpTo:function(e)
    {
        var href = e.obj.dataset.href;
        window.location.href = href;
    },
    showBtnList:function(e)
    {
        var tar    = e.obj;
        var wid    = tar.offsetWidth;
        var r      = wid * 1.6;
        var x0     = wid / 2,
            y0     = wid / 2;
        var wid2   = wid * 1.1;

        var widDiffer = (wid2 - wid) / 2;

        var child   = tar.children;
        var deg     = 60;
        var moreDeg = (180 - deg * (child.length - 1)) / 2;

        var type    = tar.dataset.type;

        (type == "hide") ? setDomList(child, {"style":{"display" : "block"}}) : setTimeout(function(){setDomList(child, {"style":{"display" : "none"}})},350);

        for(var i = 0; i < child.length; i++)
        {
            if(type == "hide")
            {
                var x1 = -(x0 + r * Math.cos((deg * i + moreDeg) * Math.PI / 180)) + x0 - widDiffer;
                var y1 = -(y0 + r * Math.sin((deg * i + moreDeg) * Math.PI / 180)) + y0 - widDiffer;
            }
            else{
                var x1 = 0;
                var y1 = 0;
                wid2   = wid;
            }
            

            /*child[i].style.width  = wid2 + "px";
            child[i].style.height = wid2 + "px";
            child[i].style.left = x1 + "px";
            child[i].style.top  = y1 + "px";*/

            this.setTimeout2(child[i], i, wid2, x1, y1);
        }
        tar.dataset.type = (type == "hide") ? "show" : "hide";
    },
    setTimeout2:function(obj, i, wid, x, y)
    {
        window.setTimeout(function(){
            obj.style.width  = wid + "px";
            obj.style.height = wid + "px";
            obj.style.left   = x + "px";
            obj.style.top    = y + "px";
        },100*i+30);
    },
    showEnergyList:function(e)
    {
        document.getElementById("energyList").style.bottom = "0";
    },
    closeEnergyList:function()
    {
        var energy = document.getElementById("energyList");
        var hei    = energy.offsetHeight;
        energy.style.bottom = -(hei + 30) + "px";
    }
});
