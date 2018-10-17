Page({
    data : {
        form : {
            nickname       : undefined,
            intro_yourself : undefined,
            sex            : 1,
            birthday       : undefined,
            day_of_death   : undefined,
            userhead       : undefined
        }
    },
    onLoad : function()
    {
        
    },
    setAvatar:function()
    {
        document.getElementById("avatar").click();
    },
    imgReader:function(e)
    {
        var formData = this.data.form;
        var tar      = e.obj;
        var imgFile  = tar.files[0];
        var imgType  = imgFile.type;

        if(imgType != "image/jpeg" && imgType != "image/png" && imgType != "image/gif" && imgType != "image/bmp")
        {
            showMsg("请选择jpg png gif bmp格式的图片");
            return;
        }
        var read = new FileReader();
        read.readAsDataURL(imgFile);
        read.onload = function()
        {
            var src = read.result;
            document.getElementById("imgBtn").style.backgroundImage = "url(" + src + ")";
            formData.userhead = tar.files[0];
        }
    },
    setSex:function(e)
    {
        var formData = this.data.form;
        var tar      = e.obj;
        var sexList  = tar.parentNode.children;
        setDomList(sexList, {"className":""});
        tar.className = "on";
        formData.sex  = tar.dataset.val*1;
    },
    valChange:function(e)
    {
        var formData = this.data.form;
        var tar      = e.obj;
        formData[tar.dataset.name] = tar.value;
        if(tar.dataset.name == "nickname")
        {
            (tar.value.length > 0) ? (document.getElementById("submitBtn").className = "submit-btn") : (document.getElementById("submitBtn").className = "submit-btn void");
        }
    },
    submitForm:function(e)
    {
        var data     = this.data;
        var formData = new FormData();
        for (var key in data.form) {
            if (!!data.form[key]) {
                formData.append(key, data.form[key]);
            }
        }
        
        $.ajax({
            url        : "new_heritage/add_heritage",
            type       : "post",
            data       : formData,
            processData:false,
            contentType:false,
            success : function(result)
            {
                showMsg(result);
            },
            error : function()
            {
                showMsg("系统繁忙！");
            }
        });
    }
});