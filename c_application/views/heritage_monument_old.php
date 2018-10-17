<?php $this -> load -> view('header'); ?>
		<title>传承碑</title>
	</head>
	
	<link rel="stylesheet" href="<?php echo $inc_url;?>css/heritage_monument.css" />
	<style>
		.user_head{
	        width: 15%;
	        height: 0;
	        padding-bottom: 15%;
	        
	        background-size: cover;
	        background-position: center center;
	        border-radius: 100px;
	        float: left;
        }
        .all_cont{
        	overflow-y: scroll;
        }
        .all_cont::-webkit-scrollbar{
	        display: none;
        }
        .all_cont::-moz-scrollbar{
	        display: none;
        }
        .all_cont::-o-scrollbar{
	        display: none;
        }
        .all_cont::scrollbar{
	        display: none;
        }
        .scroll_me{
        	/*overflow: hidden;*/
        	/*border: 1px red solid;*/
        	/*height: 72.5%;*/
        	margin-top: 53%;
        	width: 100%;
        	z-index: -99;
        }
	</style>
	
	<body>
		<h2 class="page-title">传承碑</h2>
		<img class="title-pic" src="<?php echo $inc_url; ?>img/edit_top.jpg"/>
		<?php $this -> load -> view('navbar'); ?>
	  <div class="all_cont">
	  	<div class="scroll_me">
		<div class="add_msg">
			<div class="msg_lf">
				<img src="<?php echo $inc_url;?>img/add.png" />
			</div>
			
			<div class="msg_rg">
				<div class="username"><span>点击创建传承碑</span></div>
				<div class="heritage_info"><span>点击新建传承碑，用于纪念心中的人。</span></div>
			</div>
		</div>
		<div class="wrapper">
			<input type="hidden" id="page_now" value="1"  />
			<div id="the_list">
		        <?php foreach ($stele as $item): ?>
			        <div class="user_info list_item" href="<?=$item['id']?>">
				        <div class="user_head" href="<?=$item['id']?>" style="background: url(<?=!empty($item['picture'])?$item['picture']:$inc_url.'img/user_head.png'?>) no-repeat;background-size: cover;background-position: center center;"></div>
				        <div class="user_msg" href="<?=$item['id']?>">
					        <div class="username"><span><?=$item['title']?></span></div>
					        <div class="heritage_info"><span><?=$item['synopsis']?></span></div>
				        </div>
				        <div class="btns">
					        <button class="edit" href="<?=$item['id']?>">编辑</button>
					        <button class="delete" href="<?=$item['id'] ?>"><?=$item['code']=='1'?'删除':'退出'?></button>
					        <input type="hidden" id="dele_num" value="<?=$item['code']?>" />
				        </div>
			        </div>
		        <?php endforeach; ?>
			</div>
			<div class="load_more">加载更多...</div>
		</div>
	  	</div>
	  </div>
	</body>
	
	<script type="text/javascript" src="<?php echo $inc_url; ?>js/dropload.min.js"></script>
	<script>
		    var conf;
		    
		    var pageNow = 1;
            var pst = parseInt(pageNow);
            
            
    var startx, starty;
    //获得角度
    function getAngle(angx, angy) {
        return Math.atan2(angy, angx) * 180 / Math.PI;
    };
 
    //根据起点终点返回方向 1向上 2向下 3向左 4向右 0未滑动
    function getDirection(startx, starty, endx, endy) {
        var angx = endx - startx;
        var angy = endy - starty;
        var result = 0;
 
        //如果滑动距离太短
        if (Math.abs(angx) < 2 && Math.abs(angy) < 2) {
            return result;
        }
 
        var angle = getAngle(angx, angy);
        if (angle >= -135 && angle <= -45) {
            result = 1;
        } else if (angle > 45 && angle < 135) {
            result = 2;
        } else if ((angle >= 135 && angle <= 180) || (angle >= -180 && angle < -135)) {
            result = 3;
        } else if (angle >= -45 && angle <= 45) {
            result = 4;
        }
 
        return result;
    }
    //手指接触屏幕
    document.addEventListener("touchstart", function(e) {
        startx = e.touches[0].pageX;
        starty = e.touches[0].pageY;
    }, false);
    //手指离开屏幕
    document.addEventListener("touchend", function(e) {
        var endx, endy;
        endx = e.changedTouches[0].pageX;
        endy = e.changedTouches[0].pageY;
        var direction = getDirection(startx, starty, endx, endy);
        switch (direction) {
            case 0:
//              alert("未滑动！");
                break;
            case 1:
//              alert("向上！")
                $.ajax({
			        type: "post",
					url: "init/getMoreStele",
					data: {"page": pst+1}, //第2页
					async: true,
					success: function(result) {
						var jslength = 0;
						var appendHtml = "";
						console.log(result);
						console.log(result.content);
						console.log(result.content.length);
						if(result.content.length != "0"){
							var appendPage = $("#page_now").attr("value", pst+1);
                            pageNow = appendPage.val();//2
	                        pst = parseInt(pageNow);
	                        for(var i=0;i<result.content.length;i++){
	                        	console.log(result.content[i]);
	                        	if(result.content[i].code=="1"){
	                        		appendHtml += 
	                        		"<div class='user_info list_item' href='"+result.content[i].id+"'>"+
				                        "<div class='user_head' href='"+result.content[i].id+"' style='background: url("+ result.content[i].picture +") no-repeat;background-size: cover;background-position: center center;'></div>"+
				                        "<div class='user_msg' href='"+result.content[i].id+"'>"+
					                        "<div class='username'><span>"+result.content[i].title+"</span></div>"+
					                        "<div class='heritage_info'><span>"+result.content[i].synopsis+"</span></div>"+
				                        "</div>"+
				                        "<div class='btns'>"+
					                        "<button class='edit' href='"+result.content[i].id+"'>编辑</button>"+
					                        "<button class='delete' href='"+result.content[i].id+"'>删除</button>"+
					                        "<input type='hidden' id='dele_num' value='1' />"+
				                        "</div>"+
			                        "</div>"
	                        	}
	                        	if(result.content[i].code=="2"){
	                        		appendHtml += 
	                        		"<div class='user_info list_item' href='"+result.content[i].id+"'>"+
				                        "<div class='user_head' href='"+result.content[i].id+"' style='background: url("+ result.content[i].picture +") no-repeat;background-size: cover;background-position: center center;'></div>"+
				                        "<div class='user_msg' href='"+result.content[i].id+"'>"+
					                        "<div class='username'><span>"+result.content[i].title+"</span></div>"+
					                        "<div class='heritage_info'><span>"+result.content[i].synopsis+"</span></div>"+
				                        "</div>"+
				                        "<div class='btns'>"+
					                        "<button class='edit' href='"+result.content[i].id+"'>编辑</button>"+
					                        "<button class='delete' href='"+result.content[i].id+"'>退出</button>"+
					                        "<input type='hidden' id='dele_num' value='2' />"+
				                        "</div>"+
			                        "</div>"
	                        	}
	                        }
				            $("#the_list").append(appendHtml);
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
						}
						if(result.content.length<10){
							$(".load_more").html("没有数据了");
						}
						
						var expansion = null; //是否存在展开的contents
			            var container = document.querySelectorAll('.user_info'); //找到所有的左滑盒子
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
						            expansion.className = "swiperight list_item";
					            }
				            });
				            //监听左滑盒子的屏幕上滑动事件 touchmove事件：当手指在屏幕上滑动的时候连续地触发。在这个事件发生期间，调用preventDefault()事件可以阻止滚动。
				            container[index].addEventListener('touchmove', function(event) {
					            X = event.changedTouches[0].pageX;
					            Y = event.changedTouches[0].pageY;
//					            console.log(X,Y);
					            //判断左右滑动
					            if(swipeX && Math.abs(X - x) - Math.abs(Y - y) > 0) {
						            // 阻止事件冒泡
						            event.stopPropagation();
						            if(X - x > 10) { //右滑
							            event.preventDefault(); // 取消事件的默认动作
							            this.className = "swiperight list_item";
						            }
						            if(x - X > 10) { //左滑
							            event.preventDefault();
							            this.className = "swipeleft list_item"; //左滑展开
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
			            
			            
			            
			            $(".user_info").height($(".user_head").width());
	    	            $(".edit").height($(".user_info").height());
	    	            $(".delete").height($(".user_info").height());
	    	            $(".swipeleft").height($(".user_info").height());
	    	            $(".swiperight").height($(".user_info").height());
	    	
	    	            $(".user_msg").css("line-height",$(".user_info").height()/2+"px");
	    	            
	    	            $(".user_head").click(function(){
	    		            var href = $(this).attr("href");
	    		            window.location = "cloud?s="+href;
	    	            });
	    	            $(".user_msg").click(function(){
	    		            var href = $(this).attr("href");
	    		            window.location = "cloud?s="+href;
	    	            });
	    	            
	    	            
					},
					error:function(xhr,type){
                        alert('ajax error!');
//                      me.resetload();
                    }
			    });
                break;
            case 2:
//              alert("向下！")
                break;
            case 3:
//              alert("向左！")
                break;
            case 4:
//              alert("向右！")
                break;
            default:
        }
    }, false);
            
            
            
		    //异步获取
//          $('.wrapper').scroll(function(){
//		    	
//		    });
		    $(".load_more").click(function(){
		    	$.ajax({
			        type: "post",
					url: "init/getMoreStele",
					data: {"page": pst+1}, //第2页
					async: true,
					success: function(result) {
						var jslength = 0;
						var appendHtml = "";
						console.log(result);
						console.log(result.content);
						console.log(result.content.length);
						if(result.content.length != "0"){
							var appendPage = $("#page_now").attr("value", pst+1);
                            pageNow = appendPage.val();//2
	                        pst = parseInt(pageNow);
	                        for(var i=0;i<result.content.length;i++){
	                        	console.log(result.content[i]);
	                        	if(result.content[i].code=="1"){
	                        		appendHtml += 
	                        		"<div class='user_info list_item' href='"+result.content[i].id+"'>"+
				                        "<div class='user_head' href='"+result.content[i].id+"' style='background: url("+ result.content[i].picture +") no-repeat;background-size: cover;background-position: center center;'></div>"+
				                        "<div class='user_msg' href='"+result.content[i].id+"'>"+
					                        "<div class='username'><span>"+result.content[i].title+"</span></div>"+
					                        "<div class='heritage_info'><span>"+result.content[i].synopsis+"</span></div>"+
				                        "</div>"+
				                        "<div class='btns'>"+
					                        "<button class='edit' href='"+result.content[i].id+"'>编辑</button>"+
					                        "<button class='delete' href='"+result.content[i].id+"'>删除</button>"+
					                        "<input type='hidden' id='dele_num' value='1' />"+
				                        "</div>"+
			                        "</div>"
	                        	}
	                        	if(result.content[i].code=="2"){
	                        		appendHtml += 
	                        		"<div class='user_info list_item' href='"+result.content[i].id+"'>"+
				                        "<div class='user_head' href='"+result.content[i].id+"' style='background: url("+ result.content[i].picture +") no-repeat;background-size: cover;background-position: center center;'></div>"+
				                        "<div class='user_msg' href='"+result.content[i].id+"'>"+
					                        "<div class='username'><span>"+result.content[i].title+"</span></div>"+
					                        "<div class='heritage_info'><span>"+result.content[i].synopsis+"</span></div>"+
				                        "</div>"+
				                        "<div class='btns'>"+
					                        "<button class='edit' href='"+result.content[i].id+"'>编辑</button>"+
					                        "<button class='delete' href='"+result.content[i].id+"'>退出</button>"+
					                        "<input type='hidden' id='dele_num' value='2' />"+
				                        "</div>"+
			                        "</div>"
	                        	}
	                        }
				            $("#the_list").append(appendHtml);
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
						}
						if(result.content.length<10){
							$(".load_more").html("没有数据了");
						}
						
						var expansion = null; //是否存在展开的contents
			            var container = document.querySelectorAll('.user_info'); //找到所有的左滑盒子
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
						            expansion.className = "swiperight list_item";
					            }
				            });
				            //监听左滑盒子的屏幕上滑动事件 touchmove事件：当手指在屏幕上滑动的时候连续地触发。在这个事件发生期间，调用preventDefault()事件可以阻止滚动。
				            container[index].addEventListener('touchmove', function(event) {
					            X = event.changedTouches[0].pageX;
					            Y = event.changedTouches[0].pageY;
//					            console.log(X,Y);
					            //判断左右滑动
					            if(swipeX && Math.abs(X - x) - Math.abs(Y - y) > 0) {
						            // 阻止事件冒泡
						            event.stopPropagation();
						            if(X - x > 10) { //右滑
							            event.preventDefault(); // 取消事件的默认动作
							            this.className = "swiperight list_item";
						            }
						            if(x - X > 10) { //左滑
							            event.preventDefault();
							            this.className = "swipeleft list_item"; //左滑展开
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
			            
			            
			            
			            $(".user_info").height($(".user_head").width());
	    	            $(".edit").height($(".user_info").height());
	    	            $(".delete").height($(".user_info").height());
	    	            $(".swipeleft").height($(".user_info").height());
	    	            $(".swiperight").height($(".user_info").height());
	    	
	    	            $(".user_msg").css("line-height",$(".user_info").height()/2+"px");
	    	            
	    	            $(".user_head").click(function(){
	    		            var href = $(this).attr("href");
	    		            window.location = "cloud?s="+href;
	    	            });
	    	            $(".user_msg").click(function(){
	    		            var href = $(this).attr("href");
	    		            window.location = "cloud?s="+href;
	    	            });
	    	            
	    	            
					},
					error:function(xhr,type){
                        alert('ajax error!');
//                      me.resetload();
                    }
			    });
		    });
		    


		    
		    
		    
		    
		    
		    
		
		    var expansion = null; //是否存在展开的contents
			var container = document.querySelectorAll('.user_info'); //找到所有的左滑盒子
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
						expansion.className = "swiperight list_item";
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
							this.className = "swiperight list_item";
						}
						if(x - X > 10) { //左滑
							event.preventDefault();
							this.className = "swipeleft list_item"; //左滑展开
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
		
		
	    $(function(){
	    	var winHgh = $(window).height();
	    	$("body").height(winHgh);
	    	$(".all_cont").height(winHgh);
	    	
	    	$(".add_msg").click(function(){
	    		window.location = "new_heritage";
	    	});
	    	$(".user_head").click(function(){
	    		var href = $(this).attr("href");
	    		window.location = "cloud?s="+href;
	    	});
	    	$(".user_msg").click(function(){
	    		var href = $(this).attr("href");
	    		window.location = "cloud?s="+href;
	    	});
	    	
	    	$(".user_info").height($(".user_head").width());
	    	$(".edit").height($(".user_info").height());
	    	$(".delete").height($(".user_info").height());
	    	$(".swipeleft").height($(".user_info").height());
	    	$(".swiperight").height($(".user_info").height());
	    	
	    	$(".user_msg").css("line-height",$(".user_info").height()/2+"px");
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
	    
	        
	</script>
	
</html>
