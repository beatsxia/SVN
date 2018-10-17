<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0" charset="UTF-8">
		<title>个人中心</title>
	</head>
	
	<!--<link rel="stylesheet" href="<?php echo $inc_url; ?>css/bootstrap.min.css" />-->
	<link rel="stylesheet" href="<?php echo $inc_url; ?>css/mine_info.css" />

	<body>
		<?php $this -> load -> view('navbar'); ?>
		<div class="mine_bg">
			<img class="bg" src="<?php echo $inc_url; ?>img/mine_bg.png" />
			<div class="user_head">
			    <img src="<?=$avatar ?>" />
			</div>
			<div class="user_name">
				<img src="<?php echo $inc_url; ?><?=$gender < 2 ? 'img/male.png' : 'img/female.png' ?>" />
				<?=$nickname ?>
			</div>
			<div class="mine_sign">
				<img src="<?php echo $inc_url; ?>img/revise.png" />
				<!--<span>编辑</span>-->
				<span><?=$personality_note ?></span>
				<!--<input type="text" value="" />-->
			</div>
		</div>
		<!--<div class="nums">
			<div class="num row">
				<div class="col-xs-3 visit">
					<div class="sam_sty">
						<span><?=($access_log_num > 99) ? '99' : $access_log_num; ?><a><?=$access_log_num > 99 ? '+' : ''; ?></a></span>
					</div>
					<span>访问人数</span>
				</div>
				<div class="col-xs-3 fans">
					<div class="sam_sty">
						<span><?=($user_fans_num > 99) ? '99' : $user_fans_num; ?><a><?=$user_fans_num > 99 ? '+' : ''; ?></a></span>
					</div>
					<span>粉丝人数</span>
				</div>
				<div class="col-xs-3 reply_me">
					<div class="sam_sty">
						<span><?=($comment_num > 99) ? '99' : $comment_num; ?><a><?=$comment_num > 99 ? '+' : ''; ?></a></span>
					</div>
					<span>回复我的</span>
				</div>
				<div class="col-xs-3 my_balance">
					<div>
						<span><?=$user_point?><a></a></span>
					</div>
					<span class="deff_col"><img style="width: 13px;" src="<?php echo $inc_url; ?>img/RMBLogo2.png" />余额</span>
				</div>
			</div>
		</div>-->
		<div class="stone_and_recharge">
			<div class="spirit_stone">
				<div class="common_first">
				    <img style="width: 14%;" src="<?php echo $inc_url; ?>img/spirit_stone.png" />
					<span>灵石数</span>
				</div>
				<div class="common_second">0</div>
			</div>
			<div class="recharge">
				<div class="common_first">
				    <img style="width: 12%;" src="<?php echo $inc_url; ?>img/recharge.png" />
				    <span>充值</span>
				</div>
				<div class="common_second">余额<?=$user_point?></div>
			</div>
		</div>
		
		
		<div class="my_biography inheritance_monument">
			<span></span>我的传承碑
			<div>
				<img src="<?php echo $inc_url; ?>img/goRight.png" />
			</div>
		</div>
		<div class="my_biography biography">
			<span></span>我的传记
			<div>
				<img src="<?php echo $inc_url; ?>img/goRight.png" />
			</div>
		</div>
		<div class="my_biography collection">
			<span></span>我的收藏
			<div>
				<img src="<?php echo $inc_url; ?>img/goRight.png" />
			</div>
		</div>
		<div class="my_biography common_problem">
			<span></span>常见问题
			<div>
				<img src="<?php echo $inc_url; ?>img/goRight.png" />
			</div>
		</div>
		<!--<div class="wrapper biography_info">
			<input type="hidden" id="page_now" value="1"  />
			<div id="thelist">
			<?php foreach ($my_inherit as $item): ?>
				<div class="info_section" href="<?=$item['id'] ?>">
					<div class="info_cover" href="<?=$item['id'] ?>" style="background: url(<?=!empty($item['pic1'])?$item['pic1']:$inc_url.'img/need_upload.jpg'?>) no-repeat;background-size: cover;background-position: center center;">
					</div>
					<div class="info_words" href="<?=$item['id'] ?>">
						<div class="mywords">
						    <h4><?=$item['title'] ?></h4>
						    <p><?php echo !empty($item['synopsis']) ? $item['synopsis'] : $item['inh_stage']; ?></p>
						</div>
					</div>
					<div class="btns">
						<button class="edit" href="<?=$item['id']?>">编辑</button>
						<button class="delete" href="<?=$item['id'] ?>">删除</button>
					</div>
				</div>
			<?php endforeach; ?>
			</div>
		</div>-->
		<div class="setting">
			<img src="<?php echo $inc_url; ?>img/setting.png" />
		</div>
		<!--<div class="setting_info">
			<div class="link_to notice" style="display: none;">
				<img src="<?php echo $inc_url; ?>img/notice.png" />
				<div><span>通知</span></div>
			</div>
			<div class="link_to invite" style="display: none;">
				<img src="<?php echo $inc_url; ?>img/invite.png" />
				<div><span>邀请亲友</span></div>
			</div>
			<div class="link_to bind" style="display: none;">
				<img src="<?php echo $inc_url; ?>img/bind.png" />
				<div><span>账户绑定与设置</span></div>
			</div>
			<div class="link_to suggestions">
				<img src="<?php echo $inc_url; ?>img/suggestions.png" />
				<div><span>常见问题与反馈</span></div>
			</div>
			<div class="link_to system">
				<img src="<?php echo $inc_url; ?>img/system.png" />
				<div><span>关于系统版本</span></div>
			</div>
			<div class="link_to quit">
				<img src="<?php echo $inc_url; ?>img/quit.png" />
				<div id="last_child"><span>退出当前账户</span></div>
			</div>
		</div>-->
		
        <div style="width: 100%;height: 100px;"></div>
        

	</body>
	<script type="text/javascript" src="<?php echo $inc_url; ?>js/jquery-2.1.1.min.js"></script>
	<script type="text/javascript" src="<?php echo $inc_url; ?>js/dropload.min.js"></script>
<!--//	<script type="text/javascript" src="<?php echo $inc_url; ?>js/bootstrap.min.js"></script>-->
	<script type="text/javascript" src="<?php echo $inc_url; ?>js/mine_info.js"></script>
	<script type="text/javascript">
var $num =<?=$comment_num ?>;
$(function() {
	$(".reply_me").click(function() {
		if($num == 0) {
			window.location = "reply_me_1";
		} else {
			window.location = "reply_me";
		}
	});
	
	$(".setting img").click(function(){
		window.location="about_system"
	});
	
	$(".inheritance_monument").click(function(){
		window.location="my_inher_monument"
	});
	
	$(".biography").click(function(){
		window.location="my_biogrophy"
	});
	
	$(".collection").click(function(){
		window.location="my_collection"
	});
});

    
    
    
    
//          var expansion = null; //是否存在展开的contents
//			var container = document.querySelectorAll('.info_section'); //找到所有的左滑盒子
//			for(var index = 0; index < container.length; index++) {
//				var x, y, X, Y, swipeX, swipeY;
//				//监听左滑盒子的触摸事件
//				container[index].addEventListener('touchstart', function(event) {
//					//获取触摸点的坐标targetTouches[0].pageX,Y 
//					x = event.changedTouches[0].pageX;
//					y = event.changedTouches[0].pageY;
//					swipeX = true;
//					swipeY = true;
//					if(expansion) {
//						//判断是否展开，如果展开则收起
//						expansion.className = "swiperight";
//					}
//				});
//				//监听左滑盒子的屏幕上滑动事件 touchmove事件：当手指在屏幕上滑动的时候连续地触发。在这个事件发生期间，调用preventDefault()事件可以阻止滚动。
//				container[index].addEventListener('touchmove', function(event) {
//					X = event.changedTouches[0].pageX;
//					Y = event.changedTouches[0].pageY;
////					console.log(X,Y);
//					//判断左右滑动
//					if(swipeX && Math.abs(X - x) - Math.abs(Y - y) > 0) {
//						// 阻止事件冒泡
//						event.stopPropagation();
//						if(X - x > 10) { //右滑
//							event.preventDefault(); // 取消事件的默认动作
//							this.className = "swiperight";
//						}
//						if(x - X > 10) { //左滑
//							event.preventDefault();
//							this.className = "swipeleft"; //左滑展开
//							expansion = this;
//						}
//						swipeY = false;
//					}
//					// 上下滑动
//					if(swipeY && Math.abs(X - x) - Math.abs(Y - y) < 0) {
//						swipeX = false;
//					}
//				})
//			}
    
    





//              var pageNow = 1;
//              var pst =parseInt(pageNow);
//  
//              //异步获取
//              $('.wrapper').dropload({
//	                scrollArea: window,
//		            loadDownFn: function(me) {
//			        var appendHtml = "";
//			        $.ajax({
//						type: "post",
//						url: "init/getUserInheritPage",
//						data: {"page": pst+1}, //第2页
//						dataType: "json",
//						async: true,
//						success: function(result) {
//								var appendHtml = "";
//								var jslength = 0;
//								console.log(result);
//                              $.each(result, function(k, v) {
//                              	if(v.pic1==''){
//                              		appendHtml += 
//                                      "<div class='info_section' href='" + v.id + "'>"+    
//                                  	    "<div class='info_cover' href='" + v.id + "' style='background: url(<?=base_url('include/img/need_upload.jpg')?>) no-repeat;background-size: cover;background-position: center center;'>"+
//					                        "</div>"+  
//					                        "<div class='info_words' href='" + v.id + "'>"+
//						                        "<div class='mywords'>"+
//						                            "<h4>" + v.title + "</h4>"+
//						                            "<p>" + v.inh_stage + "</p>"+
//						                        "</div>"+
//					                        "</div>"+
//					                        "<div class='btns'>"+
//						                        "<button class='edit' href='" + v.id + "'>编辑</button>"+
//						                        "<button class='delete' href='" + v.id + "'>删除</button>"+
//					                        "</div>"+
//				                        "</div>"
//				                    }else{
//				                    	appendHtml += 
//				                    	"<div class='info_section' href='" + v.id + "'>"+    
//                                  		"<div class='info_cover' href='" + v.id + "' style='background: url("+ v.pic1 +") no-repeat;background-size: cover;background-position: center center;'>"+
//					                        "</div>"+  
//					                        "<div class='info_words' href='" + v.id + "'>"+
//						                        "<div class='mywords'>"+
//						                            "<h4>" + v.title + "</h4>"+
//						                            "<p>" + v.inh_stage + "</p>"+
//						                        "</div>"+
//					                        "</div>"+
//					                        "<div class='btns'>"+
//						                        "<button class='edit' href='" + v.id + "'>编辑</button>"+
//						                        "<button class='delete' href='" + v.id + "'>删除</button>"+
//					                        "</div>"+
//				                        "</div>"
//				                    }
//                                  jslength++;
//                              });
//                              if(jslength=10 && result!=''){
//                              	var appendPage = $("#page_now").attr("value", pst+1);
//                              	pageNow = appendPage.val();//2
//	                                pst = parseInt(pageNow);
//	                                console.log(pageNow);
//	                                console.log(pst);
//				                    $("#thelist").append(appendHtml);
//				                    me.resetload();
//                              }else{
//                                  $(".loading").html("没有数据了")
//                              }
//                              
//                              $(".info_cover").each(function(){
//  	                            var $this = $(this);
//  	                            var href = $(this).attr("href");
//		                            $this.click(function(){
//			                            window.location = "root_new_set?inh_id="+href ;
//		                            });
//                              });
//                              $(".info_words").each(function(){
//  	                            var $this = $(this);
//  	                            var href = $(this).attr("href");
//		                            $this.click(function(){
//			                            window.location = "root_new_set?inh_id="+href ;
//		                            });
//                              });
//	                            
//	                            var expansion = null; //是否存在展开的contents
//			                    var container = document.querySelectorAll('#thelist .info_section'); //找到所有的左滑盒子
//			                    for(var index = 0; index < container.length; index++) {
//				                    var x, y, X, Y, swipeX, swipeY;
//				                    //监听左滑盒子的触摸事件
//				                    container[index].addEventListener('touchstart', function(event) {
//					                    //获取触摸点的坐标targetTouches[0].pageX,Y 
//					                    x = event.changedTouches[0].pageX;
//					                    y = event.changedTouches[0].pageY;
//					                    swipeX = true;
//					                    swipeY = true;
//					                    if(expansion) {
//						                    //判断是否展开，如果展开则收起
//						                    expansion.className = "swiperight";
//					                    }
//				                    });
//				                    //监听左滑盒子的屏幕上滑动事件 touchmove事件：当手指在屏幕上滑动的时候连续地触发。在这个事件发生期间，调用preventDefault()事件可以阻止滚动。
//				                    container[index].addEventListener('touchmove', function(event) {
//					                    X = event.changedTouches[0].pageX;
//					                    Y = event.changedTouches[0].pageY;
////					                    console.log(X,Y);
//					                    //判断左右滑动
//					                    if(swipeX && Math.abs(X - x) - Math.abs(Y - y) > 0) {
//						                    // 阻止事件冒泡
//						                    event.stopPropagation();
//						                    if(X - x > 10) { //右滑
//							                    event.preventDefault(); // 取消事件的默认动作
//							                    this.className = "swiperight";
//						                    }
//						                    if(x - X > 10) { //左滑
//							                    event.preventDefault();
//							                    this.className = "swipeleft"; //左滑展开
//							                    expansion = this;
//						                    }
//						                    swipeY = false;
//					                    }
//					                    // 上下滑动
//					                    if(swipeY && Math.abs(X - x) - Math.abs(Y - y) < 0) {
//						                    swipeX = false;
//					                    }
//				                    })
//			                    }
//			                    
//			                    
//			                    
//			                    
//			                    $(".delete").click(function(){
//		                            var $this = $(this);
//		                            var $thisId = $(this).attr("href");
//		                            $.ajax({
//			                            type:"post",
//			                            url:"init/delete_info",
//			                            async:true,
//			                            dataType:"json",
//			                            data:{
//				                            type : "inherit",
//				                            value : $thisId
//			                            },
//			                            success:function(data){
//				                            console.log(data.code);
//				                            var pst = JSON.parse(data.code);
//				                            console.log(pst);
//			                                if(pst=="0"){
//					                            alert("删除失败！")
//				                            }
//				                            if(pst=="1"){
//				                            	var conf = confirm("您确定删除该传记吗？");
//				                            	if(conf==true){
//				                            		$this.parent().parent().remove();
//				                            		alert("删除成功！");
//				                            	}else{
//				                            		alert("退出删除！");
//				                            	}
//				                            }
//			                            },
//			                            error:function(e){
//				                            console.log("操作失败！");
//			                            }
//		                            });
//	                            });
//	                            
//	                            
//	                            $(".edit").click(function(){
//		                            var edId = $(this).attr("href");
//		                            window.location = "root_new_set?inh_id="+edId;
//	                            });
//			                    
////			                    
//		                },
//		                error:function(xhr, type){
//                          alert('ajax error!');
//                          me.resetload();
//                      }
//	                });
//	        
//	        
//	        
//	        
//      }
//
//	})
	
$(function() {
//	$(".info_section").each(function(){
//		var $this = $(this);
//		var href = $(this).attr("href");
//		$this.click(function(){
//			window.location = "root_new_set?inh_id="+href ;
//		})
//	})
//  $(".info_cover").each(function(){
//  	var $this = $(this);
//  	var href = $(this).attr("href");
//		$this.click(function(){
//			window.location = "root_new_set?inh_id="+href ;
//		});
//  });
//  $(".info_words").each(function(){
//  	var $this = $(this);
//  	var href = $(this).attr("href");
//		$this.click(function(){
//			window.location = "root_new_set?inh_id="+href ;
//		});
//  });
	$(".mine_sign").click(function(){
		window.location = "set_signature?uid=<?=$uid?>";
	});
	
	$(".common_problem").click(function(){
		window.location = "suggestions";
	});
	
//	$(".delete").click(function(){
//		var $this = $(this);
//		var $thisId = $(this).attr("href");
//		var conf = confirm("您确定删除该传记吗？");
//		if(conf==true){
//			$.ajax({
//				url:"init/delete_info",
//			    type:"post",
//			    async:true,
//			    dataType:"json",
//			    data:{
//				    type : "inherit",
//				    value : $thisId
//			    },
//			    success:function(data){
//				    console.log(data.code);
//				    var pst = JSON.parse(data.code);
//				    console.log(pst);
//			        if(pst=="0"){
//					    alert("删除失败！");
//				    }
//				    if(pst=="1"){
//				        $this.parent().parent().remove();
//				        alert("删除成功！");
//				    }
//			    },
//			    error:function(e){
//				    console.log("操作失败！");
//			    }
//		    });
//		}else{
//			alert("退出删除！")
//		}
//	});
	
	
//	$(".edit").click(function(){
//		var edId = $(this).attr("href");
//		window.location = "root_new_set?inh_id="+edId;
//	});
});




</script>
</html>
