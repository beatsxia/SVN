<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0" charset="UTF-8">
		<title>我的传承碑</title>
	</head>
	<style type="text/css">
		*{
			padding: 0;
			margin: 0;
		}
		#contents{
			width: 92%;
			margin: 0 auto;
		}
		.content{
		   width: 100%;
		   display: flex;
		   align-items: center;
		   border-bottom: 1px #DCDCDC solid;
		   padding: 4% 0;
		   
		   
	overflow: hidden;
	position: relative;
	-webkit-transition: all 0.3s linear;
	transition: all 0.3s linear;
		}
		.monu_head{
			width: 22%;
			overflow: hidden;
			margin: 0 5% 0 3%;
		}
		.monu_head img{
		}
		.monu_info{
			width: 70%;
		}
		.monu_info p{
			overflow: hidden;
            text-overflow:ellipsis;
            white-space: nowrap;
		}
		.monu_name{
			font-size: 18px;
		}
		.monu_intro{
			font-size: 14px;
		}
		
		
.btns {
	position: absolute;
	top: 0;
	margin-top: 4%;
	width: 50%;
	right: -54.2%;
	font-size: 20px;
	text-align: center;
	-webkit-transition: all 0.3s linear;
	transition: all 0.3s linear;
	pointer-events: none;
	/*display: inline-flex;*/
	overflow: hidden;
}

.delete {
	width: 50%;
	background: #EB4D3D;
	float: right;
	pointer-events:auto;
}

.edit {
	width: 50%;
	background: #C7C7CC;
	float: left;
	pointer-events:auto;
}

.delete,
.edit {
	border: 0;
	/*height: 120px;*/
	color: #FFFFFF;
	letter-spacing: 0.8px;
	outline: none;
	
}

.swipeleft {
	transform: translateX(-50%);
	-webkit-transform: translateX(-50%);
}

.swiperight {
	transform: translateX(0%);
	-webkit-transform: translateX(0%);
}

.swipeleft,
.swiperight {
	/*width: 100%;*/
	/*height: 120px;*/
	/*margin-bottom: 15px;*/
	/*padding: 4% 0;
	position: relative;
	-webkit-transition: all 0.3s linear;
	transition: all 0.3s linear;*/
	/*overflow: hidden;*/
	
	
	
	
	width: 100%;
	display: flex;
	align-items: center;
	border-bottom: 1px #DCDCDC solid;
	padding: 4% 0;
		   
		   
	/*overflow: hidden;*/
	position: relative;
	-webkit-transition: all 0.3s linear;
	transition: all 0.3s linear;
}
.dropload-load,
.dropload-refresh {
	line-height: 40px;
	text-align: center;
	font-size: 12px;
	color: #979595;
}
	</style>
	<body>
		<input type="hidden" id="page_now" value="1"  />
		<div class="thelist">
		<div id="contents">
		<?php foreach ($stele as $item): ?>	
			<div class="content" href="<?=$item['id'] ?>">
				<div class="monu_head" href="<?=$item['id'] ?>">
					<img src="<?=!empty($item['picture'])?$item['picture']:$inc_url.'img/user_head.png'?>" />
				</div>
				<div class="monu_info" href="<?=$item['id'] ?>">
					<p class="monu_name"><?=$item['title']?></p>
					<p class="monu_intro"><?=$item['synopsis']?></p>
				</div>
				<div class="btns">
					<button class="edit" href="<?=$item['id']?>">编辑</button>
					<button class="delete" href="<?=$item['id'] ?>">删除</button>
					<input type="hidden" id="dele_num" value="<?=$item['code']?>" />
				</div>
			</div>
		<?php endforeach; ?>	
		</div>
		</div>
	</body>
	<script type="text/javascript" src="<?php echo $inc_url; ?>js/jquery-2.1.1.min.js"></script>
	<script type="text/javascript" src="<?php echo $inc_url; ?>js/dropload2.min.js"></script>
	<script type="text/javascript">
		var conf;
		
		if($(".monu_head img").width()>$(".monu_head img").height()){
			$(".monu_head img").css("height","100%");
		}else{
			$(".monu_head img").css("width","100%");
		}
		
		$(".monu_head").height($(".monu_head").width());
		$(".monu_head").css("border-radius",$(".monu_head").width()+"px");
		$(".monu_name").css("margin-top",($(".monu_head").width()-18-14-12)/4+"px");
		$(".monu_name").css("margin-bottom",($(".monu_head").width()-18-14-12)/4+"px");
		$(".monu_intro").css("margin-top",($(".monu_head").width()-18-14-12)/4+"px");
		$(".monu_intro").css("margin-bottom",($(".monu_head").width()-18-14-12)/4+"px");
		
		$(".delete").height($(".monu_head").width());
		$(".edit").height($(".monu_head").width());
		$(".swiperight ").height($(".monu_head").width());
		$(".swipeleft").height($(".monu_head").width());
		
		
		$(".monu_head").click(function(){
    	    var $this = $(this);
    	    var href = $this.attr("href");
			window.location = "cloud?s="+href ;
        });
        $(".monu_info").click(function(){
    	    var $this = $(this);
    	    var href = $this.attr("href");
			window.location = "cloud?s="+href ;
        });
        
        
    $(".delete").click(function(){
		var $this = $(this);
		var $thisId = $(this).attr("href");
		if($("#dele_num").val()=="1"){
			conf = confirm("您确定删除该传承碑吗？");
		}
		if($("#dele_num").val()=="2"){
			conf = confirm("您确定退出该传承碑吗？");
		}
		if(conf==true){
		    $.ajax({
			    url:"init/delete_info",
			    type:"post",
			    async:true,
			    dataType:"json",
			    data:{
				    type : "stele",
				    value : $thisId
			    },
			    success:function(data){
				    console.log(data);
				    console.log(data.code);
				    console.log(data.hint);
				    var pst = JSON.parse(data.code);
				    console.log(pst);
				    if(pst=="0"){
				    	//删除失败
					    alert(data.hint);
				    }
			    
				    if(pst=="1"){
				    	//删除成功
				        $this.parent().parent().remove();
				        alert(data.hint);
				    }
				
				    if(pst=="2"){
				    	//退出成功
				    	$this.parent().parent().remove();
					    alert(data.hint);
				    }
			    },
			    error:function(e){
				    console.log("操作失败！");
			    }
		    });
		}
	});
	
	
	$(".edit").click(function(){
		var edId = $(this).attr("href");
		window.location = "identify?s="+edId;
	});
		
		
		    var expansion = null; //是否存在展开的contents
			var container = document.querySelectorAll('.content'); //找到所有的左滑盒子
			for(var index = 0; index < container.length; index++) {
				var x, y, X, Y, swipeX, swipeY;
				//监听左滑盒子的触摸事件
				container[index].addEventListener('touchstart', function(event) {
					//获取触摸点的坐标targetTouches[0].pageX,Y 
					x = event.changedTouches[0].pageX;
					y = event.changedTouches[0].pageY;
					swipeX = true;
					swipeY = true;
					if(expansion) {
						//判断是否展开，如果展开则收起
						expansion.className = "swiperight";
					}
				});
				//监听左滑盒子的屏幕上滑动事件 touchmove事件：当手指在屏幕上滑动的时候连续地触发。在这个事件发生期间，调用preventDefault()事件可以阻止滚动。
				container[index].addEventListener('touchmove', function(event) {
					X = event.changedTouches[0].pageX;
					Y = event.changedTouches[0].pageY;
//					console.log(X,Y);
					//判断左右滑动
					if(swipeX && Math.abs(X - x) - Math.abs(Y - y) > 0) {
						// 阻止事件冒泡
						event.stopPropagation();
						if(X - x > 10) { //右滑
							event.preventDefault(); // 取消事件的默认动作
							this.className = "swiperight";
						}
						if(x - X > 10) { //左滑
							event.preventDefault();
							this.className = "swipeleft"; //左滑展开
							expansion = this;
						}
						swipeY = false;
					}
					// 上下滑动
					if(swipeY && Math.abs(X - x) - Math.abs(Y - y) < 0) {
						swipeX = false;
					}
				})
			}
			
			
			
			
			
			
			
			
			    var pageNow = 1;
                var pst =parseInt(pageNow);
    
                //异步获取
                $('.thelist').dropload({
	                scrollArea: window,
		            loadDownFn: function(me) {
			        var appendHtml = "";
			        $.ajax({
						type: "post",
						url: "init/getMyMonument",
						data: {"page": pst+1}, //第2页
						dataType: "json",
						async: true,
						success: function(result) {
								var appendHtml = "";
								var jslength = 0;
								console.log(result);
                                $.each(result, function(k, v) {
                                	console.log(k)
                                	console.log(v)
                                	if(v.code=='1'){
                                		appendHtml += 
                                        "<div class='content' href='" + v.id + "'>"+    
                                    	    "<div class='monu_head' href='" + v.id + "'>"+
                                    	        "<img src='"+v.picture+"' />"+
					                        "</div>"+  
					                        "<div class='monu_info' href='" + v.id + "'>"+
						                        "<div class='mywords'>"+
						                            "<p class='monu_name'>" + v.title + "</p>"+
						                            "<p class='monu_intro'>" + v.synopsis + "</p>"+
						                        "</div>"+
					                        "</div>"+
					                        "<div class='btns'>"+
						                        "<button class='edit' href='" + v.id + "'>编辑</button>"+
						                        "<button class='delete' href='" + v.id + "'>删除</button>"+
						                        "<input type='hidden' id='dele_num' value='1' />"+
					                        "</div>"+
				                        "</div>"
				                    }
				                    if(v.code=='2'){
				                    	appendHtml += 
				                    	"<div class='content' href='" + v.id + "'>"+    
                                    	    "<div class='monu_head' href='" + v.id + "'>"+
                                    	        "<img src='"+v.picture+"' />"+
					                        "</div>"+  
					                        "<div class='monu_info' href='" + v.id + "'>"+
						                        "<div class='mywords'>"+
						                            "<p class='monu_name'>" + v.title + "</p>"+
						                            "<p class='monu_intro'>" + v.synopsis + "</p>"+
						                        "</div>"+
					                        "</div>"+
					                        "<div class='btns'>"+
						                        "<button class='edit' href='" + v.id + "'>编辑</button>"+
						                        "<button class='delete' href='" + v.id + "'>删除</button>"+
						                        "<input type='hidden' id='dele_num' value='2' />"+
					                        "</div>"+
				                        "</div>"
				                    }
                                    jslength++;
                                });
                                if(jslength=10 && result!=''){
                                	var appendPage = $("#page_now").attr("value", pst+1);
                                	pageNow = appendPage.val();//2
	                                pst = parseInt(pageNow);
	                                console.log(pageNow);
	                                console.log(pst);
				                    $("#contents").append(appendHtml);
				                    me.resetload();
                                }else{
                                    $(".loading").html("没有数据了")
                                }
                                
                                $(".monu_head").click(function(){
    	                            var $this = $(this);
    	                            var href = $this.attr("href");
			                        window.location = "cloud?s="+href ;
                                });
                                $(".monu_info").click(function(){
    	                            var $this = $(this);
    	                            var href = $this.attr("href");
			                        window.location = "cloud?s="+href ;
                                });
	                            
	                            
	                           
	                            if($(".monu_head img").width()>$(".monu_head img").height()){
			                        $(".monu_head img").css("width","100%");
		                        }else{
		                        	$(".monu_head img").css("height","100%");
		                        }
		
		                        $(".monu_head").height($(".monu_head").width());
		                        $(".monu_head").css("border-radius",$(".monu_head").width()+"px");
		                        $(".monu_name").css("margin-top",($(".monu_head").width()-18-14-12)/4+"px");
		                        $(".monu_name").css("margin-bottom",($(".monu_head").width()-18-14-12)/4+"px");
		                        $(".monu_intro").css("margin-top",($(".monu_head").width()-18-14-12)/4+"px");
		                        $(".monu_intro").css("margin-bottom",($(".monu_head").width()-18-14-12)/4+"px");
		
		                        $(".delete").height($(".monu_head").width());
		                        $(".edit").height($(".monu_head").width());
		                        $(".swiperight ").height($(".monu_head").width());
		                        $(".swipeleft").height($(".monu_head").width());
		
		
		
	                            var expansion = null; //是否存在展开的contents
			                    var container = document.querySelectorAll('.content'); //找到所有的左滑盒子
			                    for(var index = 0; index < container.length; index++) {
				                    var x, y, X, Y, swipeX, swipeY;
				                    //监听左滑盒子的触摸事件
				                    container[index].addEventListener('touchstart', function(event) {
					                    //获取触摸点的坐标targetTouches[0].pageX,Y 
					                    x = event.changedTouches[0].pageX;
					                    y = event.changedTouches[0].pageY;
					                    swipeX = true;
					                    swipeY = true;
					                    if(expansion) {
						                    //判断是否展开，如果展开则收起
						                    expansion.className = "swiperight";
					                    }
				                    });
				                    //监听左滑盒子的屏幕上滑动事件 touchmove事件：当手指在屏幕上滑动的时候连续地触发。在这个事件发生期间，调用preventDefault()事件可以阻止滚动。
				                    container[index].addEventListener('touchmove', function(event) {
					                    X = event.changedTouches[0].pageX;
					                    Y = event.changedTouches[0].pageY;
//					                    console.log(X,Y);
					                    //判断左右滑动
					                    if(swipeX && Math.abs(X - x) - Math.abs(Y - y) > 0) {
						                    // 阻止事件冒泡
						                    event.stopPropagation();
						                    if(X - x > 10) { //右滑
							                    event.preventDefault(); // 取消事件的默认动作
							                    this.className = "swiperight";
						                    }
						                    if(x - X > 10) { //左滑
							                    event.preventDefault();
							                    this.className = "swipeleft"; //左滑展开
							                    expansion = this;
						                    }
						                    swipeY = false;
					                    }
					                    // 上下滑动
					                    if(swipeY && Math.abs(X - x) - Math.abs(Y - y) < 0) {
						                    swipeX = false;
					                    }
				                    })
			                    }
			                    
			                    
			                    
			                    
			                    $(".delete").click(function(){
		var $this = $(this);
		var $thisId = $(this).attr("href");
		if($("#dele_num").val()=="1"){
			conf = confirm("您确定删除该传承碑吗？");
		}
		if($("#dele_num").val()=="2"){
			conf = confirm("您确定退出该传承碑吗？");
		}
		if(conf==true){
		    $.ajax({
			    url:"init/delete_info",
			    type:"post",
			    async:true,
			    dataType:"json",
			    data:{
				    type : "stele",
				    value : $thisId
			    },
			    success:function(data){
				    console.log(data);
				    console.log(data.code);
				    console.log(data.hint);
				    var pst = JSON.parse(data.code);
				    console.log(pst);
				    if(pst=="0"){
				    	//删除失败
					    alert(data.hint);
				    }
			    
				    if(pst=="1"){
				    	//删除成功
				        $this.parent().parent().remove();
				        alert(data.hint);
				    }
				
				    if(pst=="2"){
				    	//退出成功
				    	$this.parent().parent().remove();
					    alert(data.hint);
				    }
			    },
			    error:function(e){
				    console.log("操作失败！");
			    }
		    });
		}
	});
	
	
	$(".edit").click(function(){
		var edId = $(this).attr("href");
		window.location = "identify?s="+edId;
	});
		                },
		                error:function(xhr, type){
                            alert('ajax error!');
                            me.resetload();
                        }
	                });
	            }
            })
    
	</script>
</html>
