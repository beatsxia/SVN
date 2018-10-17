Page({
    data:{
        removeId  : undefined,
        removeObj : undefined,
        prevY     : 0,
        deviation : 0,
        loading   : false,
        slideX    : undefined
    },
    onLoad:function()
    {
        
    },
    switchType:function(e)
    {
        var tar     = e.obj;
        var btnList = document.getElementById("switchList").children;
        var tabList = document.getElementsByClassName("stele-tab");
        var showTab = document.getElementsByClassName(tar.dataset.tab + "-stele");

        setDomList(btnList,{"className" : ""});
        setDomList(tabList,{"style" : {"display" : "none"}});
        setDomList(showTab,{"style" : {"display" : "block"}});
        tar.className = "on";
    },
    addStele:function()
    {
        window.location = "new_heritage";
    },
    loadDetails:function(e)
    {
        var tar = e.obj;
        window.location = "stele_detail?s=" + tar.dataset.id;
    },
    removeStele:function()
    {
        var App = this;
        if(!!this.data.removeId)
        {
            $.ajax({
                url:"init/delete_info",
                type:"post",
                async:true,
                dataType:"json",
                data:{
                    type : "stele",
                    value : this.data.removeId
                },
                success:function(data){
                    var pst = JSON.parse(data.code);
                    if(pst=="0"){
                        //删除失败
                        showMsg(data.hint);
                    }

                    if(pst=="1"){
                        //删除成功
                        showMsg(data.hint);
                        App.data.removeObj.remove();
                        App.closeMask();
                    }

                    if(pst=="2"){
                        //退出成功
                        showMsg(data.hint);
                        App.remove();
                    }
                },
                error:function(e){
                    showMsg("操作失败！");
                }
            });
        }
    },
    closeMask:function()
    {
        document.getElementById("mask").style.display = "none";
        this.data.removeId  = undefined;
        this.data.removeObj = undefined;
    },
    showMask:function(e)
    {
        var tar = e.obj;
        this.data.removeId  = tar.dataset.id * 1;
        this.data.removeObj = tar.parentNode;
        document.getElementById("mask").style.display = "block";
    },
    endPull:function(e)/*上拉结束*/
    {
        var tar = e.obj;
        window.scrollTo(0,window.scrollY - 2);
        document.body.style.overflow = "auto";
        if(!!this.data.loading || tar.dataset.page == "over")
        {
            return;
        }
        
        var App = this;
        var closeLoad = this.closeLoad;
        this.data.prevY = 0;
        
        if(this.data.deviation >=1.1)
        {
            this.data.loading = true;
            tar.getElementsByClassName("moreTips")[0].innerText =  "--------正在加载--------";
            document.getElementById("loading").getElementsByTagName("span")[0].style.animationName = "loading";
            $.ajax({
                url      : "init/getMoreStele",
                type     : "post",
                async    :true,
                dataType :"json",
                cache    : false,
                data : {
                    "page" : tar.dataset.page * 1 + 1
                },
                success : function(result)
                {
                    App.addItem(result, e.obj);
                    document.getElementById("loading").getElementsByTagName("span")[0].style.animationName = "none";
                    document.getElementById("loading").getElementsByTagName("span")[0].style.backgroundImage    = "url('../include/img/load_ok.png')";
                    closeLoad.call(App, tar, 800);
                },
                error : function()
                {
                    closeLoad.call(App, tar);
                    showMsg("加载超时！");
                }
            });
        }
        else
        {
            closeLoad.call(App, tar);
        }
    },
    pullUp:function(e)/*上拉中*/
    {
        var tar   = e.obj;
        if(!!this.data.loading || tar.dataset.page == "over")
        {
            return;
        }
        
        var range = tar.offsetHeight + tar.offsetTop - window.screen.height;
        if(window.scrollY - range >= 0 && this.data.prevY == 0)
        {
            document.getElementById("loading").style.transition = "none";
            this.data.prevY = e.changedTouches[0].clientY;
            document.body.style.overflow = "hidden";
        }

        if(this.data.prevY != 0)
        {
            var deviation = ((this.data.prevY - e.changedTouches[0].clientY) / 80 >= 1.15) ? 1.15 : (this.data.prevY - e.changedTouches[0].clientY) / 80;
            this.data.deviation = deviation;
            
            document.getElementById("loading").style.bottom = (0.6 + deviation) + "rem";
            if(deviation >= 1.1)
            {
                tar.getElementsByClassName("moreTips")[0].innerText =  "--------释放手指以加载--------";
            }
            else
            {
                tar.getElementsByClassName("moreTips")[0].innerText =  "----------上拉加载更多----------";
            }
        }
    },
    closeLoad:function(tar, timeOut)
    {
        this.data.deviation = 0;
        timeOut = timeOut || 40;
        var App = this;
        document.getElementById("loading").style.transition = "0.6s";
        setTimeout(function(){
            document.getElementById("loading").style.bottom = "0.6rem";
            setTimeout(function(){
                document.getElementById("loading").getElementsByTagName("span")[0].style.backgroundImage    = "url('../include/img/loading.png')";
                tar.getElementsByClassName("moreTips")[0].innerText =  "----------上拉加载更多----------";
                if(tar.dataset.page == "over")
                {
                    tar.getElementsByClassName("moreTips")[0].innerText =  "----------暂无更多内容----------";
                }
                else
                {
                    tar.getElementsByClassName("moreTips")[0].innerText =  "----------上拉加载更多----------";
                }
                App.data.loading = false;
            },600);
        }, timeOut);
    },
    addItem:function(result, obj)
    {
        var datas = result.content;
        if(datas.length < 10)
        {
            obj.dataset.page = "over";
        }
        else
        {
            obj.dataset.page = obj.dataset.page * 1 + 1;
        }
        var itemStr = '';
        for (var index = 0; index < datas.length; index++) {
            itemStr    += '<li class="stele-item clearfloat"><span class="remove-stele" data-id="' + datas[index].id + '" @click="showMask"></span>';
            itemStr    += '<h3 class="stele-title">' + datas[index].title + '</h3><div class="text-info left"><p>姓名 : ' + datas[index].title + '</p>';
            itemStr    += '<p>性别 : 男</p>';
            itemStr    += '<p>生平 : ???-???</p></div>';
            itemStr    += '<div class="img-info right"><a href="javascript:void(0);" data-id="' + datas[index].id + '" @click="loadDetails">';
            itemStr    += '<img src="' + datas[index].picture + '" alt="头像"></a></div></li>';
        }
        obj.getElementsByClassName("stele-list")[0].innerHTML += itemStr;
    },
    slideStart:function(e)/*左滑取消收藏*/
    {
        var slideTar = e.obj.getElementsByClassName("cancel-collect")[0];
        slideTar.style.transition = "none";
        this.data.slideX = e.changedTouches[0].clientX;
    },
    slideIng:function(e)/*左滑取消收藏*/
    {
        var tar      = e.obj;
        var slideTar = tar.getElementsByClassName("cancel-collect")[0];
        var sWid     = slideTar.offsetWidth;

        var slideRange = -sWid + (this.data.slideX - e.changedTouches[0].clientX);

        if(slideRange < 0)
        {
            slideTar.style.right = slideRange + "px";
        }
        else
        {
            slideTar.style.right = "0px";
        }
    },
    slideEnd:function(e)/*左滑取消收藏*/
    {
        var slideTar = e.obj.getElementsByClassName("cancel-collect")[0];
        slideTar.style.transition = "0.2s";
        var sWid     = slideTar.offsetWidth / 2;

        var slideRange = -sWid + (this.data.slideX - e.changedTouches[0].clientX);
        if(slideRange > 0)
        {
            slideTar.style.right = "0px";
        }
        else
        {
            slideTar.style.right = "-2.2rem";
        }
    }
});

