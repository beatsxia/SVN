<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0" charset="UTF-8">
		<title>我的传记</title>
	</head>
	<style type="text/css">
		*{
			padding: 0;
			margin: 0;
		}
		#contents{
			width: 90%;
			margin: 0 auto;
		}
		.content{
			width: 100%;
			display: flex;
		    align-items: center;
		    margin: 4% 0;
		    position: relative;
		    
		    
    /*overflow: hidden;*/
	/*position: relative;*/
	-webkit-transition: all 0.3s linear;
	transition: all 0.3s linear;
		}
		.cont_cover{
			width: 35%;
			margin-right: 5%;
			overflow: hidden;
			border-radius: 3px;
			text-align: center;
		}
		.cont_cover img{
			height: 100%;
		}
		.cont_info{
			width: 60%;
		}
		.cont_info p{
			letter-spacing: 0.8px;
		}
		.biog_title{
			overflow: hidden;
            text-overflow:ellipsis;
            white-space: nowrap;
            font-size: 16px;
            color: #A5A5A5;
		}
		.biog_intro{
			display: -webkit-box;
            -webkit-box-orient: vertical;
            -webkit-line-clamp: 2;
            overflow: hidden;
            font-size: 12px;
            margin-top: 10.4px;
            line-height: 18px;
		}
		
		.btns {
	position: absolute;
	top: 0;
	width: 50%;
	right: -55.5%;
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
	width: 100%;
	display: flex;
	align-items: center;
	margin: 4% 0;
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
		<div class="wrapper">
		<div id="contents">
		<?php foreach ($my_inherit as $item): ?>
			<div class="content" href="<?=$item['id'] ?>">
				<div class="cont_cover" href="<?=$item['id'] ?>">
					<img src="<?=!empty($item['pic1'])?$item['pic1']:$inc_url.'img/need_upload.jpg'?>" />
				</div>
				<div class="cont_info" href="<?=$item['id'] ?>">
					<p class="biog_title"><?=$item['title'] ?></p>
					<p class="biog_intro"><?php echo !empty($item['synopsis']) ? $item['synopsis'] : $item['inh_stage']; ?></p>
				</div>
				<div class="btns">
					<button class="edit" href="<?=$item['id']?>">编辑</button>
					<button class="delete" href="<?=$item['id'] ?>">删除</button>
				</div>
			</div>
		<?php endforeach; ?>
		</div>
		</div>
	</body>
	<script type="text/javascript" src="<?php echo $inc_url; ?>js/jquery-2.1.1.min.js"></script>
	<script type="text/javascript" src="<?php echo $inc_url; ?>js/dropload.min.js"></script>
	<script type="text/javascript">
		$(".cont_cover").height($(".cont_cover").width());
		$(".edit").height($(".cont_cover").height());
		$(".delete").height($(".cont_cover").height());
		
		
		
		
		
		
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
			
			
			
			                    $(".cont_cover").each(function(){
    	                            var $this = $(this);
    	                            var href = $(this).attr("href");
		                            $this.click(function(){
			                            window.location = "root_new_set?inh_id="+href ;
		                            });
                                });
                                $(".cont_info").each(function(){
    	                            var $this = $(this);
    	                            var href = $(this).attr("href");
		                            $this.click(function(){
			                            window.location = "root_new_set?inh_id="+href ;
		                            });
                                });
                                
                                
                                
                                
                                
                                
                                $(".delete").click(function(){
		                            var $this = $(this);
		                            var $thisId = $(this).attr("href");
		                            $.ajax({
			                            type:"post",
			                            url:"init/delete_info",
			                            async:true,
			                            dataType:"json",
			                            data:{
				                            type : "inherit",
				                            value : $thisId
			                            },
			                            success:function(data){
				                            console.log(data.code);
				                            var pst = JSON.parse(data.code);
				                            console.log(pst);
			                                if(pst=="0"){
					                            alert("删除失败！")
				                            }
				                            if(pst=="1"){
				                            	var conf = confirm("您确定删除该传记吗？");
				                            	if(conf==true){
				                            		$this.parent().parent().remove();
				                            		alert("删除成功！");
				                            	}else{
				                            		alert("退出删除！");
				                            	}
				                            }
			                            },
			                            error:function(e){
				                            console.log("操作失败！");
			                            }
		                            });
	                            });
	                            
	                            
	                            $(".edit").click(function(){
		                            var edId = $(this).attr("href");
		                            window.location = "root_new_set?inh_id="+edId;
	                            });



                var pageNow = 1;
                var pst =parseInt(pageNow);
    
                //异步获取
                $('.wrapper').dropload({
	                scrollArea: window,
		            loadDownFn: function(me) {
			        var appendHtml = "";
			        $.ajax({
						type: "post",
						url: "init/getUserInheritPage",
						data: {"page": pst+1}, //第2页
						dataType: "json",
						async: true,
						success: function(result) {
								var appendHtml = "";
								var jslength = 0;
								console.log(result);
                                $.each(result, function(k, v) {
                                	if(v.pic1==''){
                                		appendHtml += 
                                        "<div class='content' href='" + v.id + "'>"+    
                                    	    "<div class='cont_cover' href='" + v.id + "'>"+
					                             "<img src='<?=base_url('include/img/need_upload.jpg')?>' />"+
					                        "</div>"+ 
					                        "<div class='cont_info' href='" + v.id + "'>"+
					                            "<p class='biog_title'>"+v.title+"</p>"+
					                            "<p class='biog_intro'>"+v.inh_stage+"</p>"+
					                        "</div>"+
					                        "<div class='btns'>"+
						                        "<button class='edit' href='" + v.id + "'>编辑</button>"+
						                        "<button class='delete' href='" + v.id + "'>删除</button>"+
					                        "</div>"+
				                        "</div>"
				                    }else{
				                    	appendHtml += 
				                    	"<div class='content' href='" + v.id + "'>"+    
                                    	    "<div class='cont_cover' href='" + v.id + "'>"+
					                             "<img src='"+v.pic1+"' />"+
					                        "</div>"+ 
					                        "<div class='cont_info' href='" + v.id + "'>"+
					                            "<p class='biog_title'>"+v.title+"</p>"+
					                            "<p class='biog_intro'>"+v.inh_stage+"</p>"+
					                        "</div>"+
					                        "<div class='btns'>"+
						                        "<button class='edit' href='" + v.id + "'>编辑</button>"+
						                        "<button class='delete' href='" + v.id + "'>删除</button>"+
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
                                
                                $(".cont_cover").each(function(){
    	                            var $this = $(this);
    	                            var href = $(this).attr("href");
		                            $this.click(function(){
			                            window.location = "root_new_set?inh_id="+href ;
		                            });
                                });
                                $(".cont_info").each(function(){
    	                            var $this = $(this);
    	                            var href = $(this).attr("href");
		                            $this.click(function(){
			                            window.location = "root_new_set?inh_id="+href ;
		                            });
                                });
                                
                                
		
		$(".cont_cover").height($(".cont_cover").width());
		$(".edit").height($(".cont_cover").height());
		$(".delete").height($(".cont_cover").height());
	                            
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
		                            $.ajax({
			                            type:"post",
			                            url:"init/delete_info",
			                            async:true,
			                            dataType:"json",
			                            data:{
				                            type : "inherit",
				                            value : $thisId
			                            },
			                            success:function(data){
				                            console.log(data.code);
				                            var pst = JSON.parse(data.code);
				                            console.log(pst);
			                                if(pst=="0"){
					                            alert("删除失败！")
				                            }
				                            if(pst=="1"){
				                            	var conf = confirm("您确定删除该传记吗？");
				                            	if(conf==true){
				                            		$this.parent().parent().remove();
				                            		alert("删除成功！");
				                            	}else{
				                            		alert("退出删除！");
				                            	}
				                            }
			                            },
			                            error:function(e){
				                            console.log("操作失败！");
			                            }
		                            });
	                            });
	                            
	                            
	                            $(".edit").click(function(){
		                            var edId = $(this).attr("href");
		                            window.location = "root_new_set?inh_id="+edId;
	                            });
			                    
//			                    
		                },
		                error:function(xhr, type){
                            alert('ajax error!');
                        }
	                });
                    }
	            })
	</script>
</html>
