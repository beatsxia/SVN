<!DOCTYPE html>
<html>

	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0" charset="UTF-8">
		<title>傳承動態</title>
	</head>

	<link rel="stylesheet" href="<?=$inc_url; ?>css/more.css" />

	<body>
		<div class="wrapper">
			<div id="thelist">
				<input type="hidden" id="page_now" value="1"  />
		        <?php foreach ($inherit_arr as $item): ?>
		            <div class="dynamics">
			            <div class="dynamic">
				            <div class="user_head" href="<?=$item['user_id'] ?>">
					            <img src="<?=$item['avatar'] ?>" />
					            <div class="p_att" href="<?=$item['user_id'] ?>">
					                <?php echo $item['is_follow']==1 ? '<p class="al_att">已关注</p>' : '<p class="add_att">+关注</p>'?>
					            </div>
				            </div>
				            <div class="content" >
					            <div class="contents user_info" href="<?=$item['id'] ?>">
						            <a class="user_name"><?=$item['nickname'] ?></a>
						            <a class="time"><?php echo date('H:i', $item['add_time']); ?></a>
					            </div>
					            <div class="contents publish" href="<?=$item['id'] ?>"><?php echo date('m', $item['add_time']) . '月' . date('d', $item['add_time']) . '号'; ?> 发布</div>
				                <p class="contents content_words" href="<?=$item['id'] ?>" ><?=$item['title'] ?></p>
				                <div class="contents content_pics" href="<?=$item['id'] ?>" >
				    	            <?php
						            if (!empty($item['pic1'])) {echo '<div class="pic1"><img src=' . $item['pic1'] . ' /></div>';
						            }
						            ?>
				    	            <?php
						            if (!empty($item['pic2'])) {echo '<div class="pic2"><img src=' . $item['pic2'] . ' /></div>';
						            }
						            ?>
				                </div>
				                <div class="discuss" href="<?=$item['id'] ?>" >
				                    <a href="comment?inh_id=<?=$item['id'] ?>"><img src="<?=$inc_url; ?>img/message.png" /></a>
				                    <a href="comment?inh_id=<?=$item['id'] ?>"><?=$item['comment_num'] ?></a>
				                </div>
				            </div>
			            </div>
		            </div>
		        <?php endforeach; ?>
			</div>
		</div>
	</body>
	
	<script type="text/javascript" src="<?=$inc_url; ?>js/jquery-2.1.1.min.js" ></script>
	<script type="text/javascript" src="<?php echo $inc_url; ?>js/dropload.min.js"></script>
	<script>
    var pageNow = 1;
    var pst =parseInt(pageNow);
    
    $('.wrapper').dropload({
	    scrollArea: window,
		loadDownFn: function(me) {
			var appendHtml = "";
			$.ajax({
						type: "post",
						url: "init/getMorePage",
						data: {"page": pst+1}, //第2页
						dataType: "json",
						async: true,
						success: function(result) {
								var appendHtml = "";
								var jslength = 0;
                                $.each(result, function(k, v) {
                                	var timer = v.add_time;
									var newTimer = new Date(parseInt(timer) * 1000);
									var dataStr1 = (newTimer.getMonth() + 1 < 10 ? '0' + (newTimer.getMonth() + 1) : newTimer.getMonth() + 1) + '月' + (newTimer.getDate() < 10 ? '0' + (newTimer.getDate()) : newTimer.getDate()) + '号';
									var dataStr2 = (newTimer.getHours() < 10 ? '0' + newTimer.getHours() : newTimer.getHours()) + ':' + (newTimer.getMinutes() < 10 ? '0' + newTimer.getMinutes() : newTimer.getMinutes());
									
									if(v.is_follow=="1"){
										if(v.pic1=='' && v.pic2==''){//不显示图
											appendHtml+=
									        "<div class='dynamics'>"+
			                                    "<div class='dynamic'>"+
				                                    "<div class='user_head' href='"+v.user_id+"' >"+
					                                    "<img src='"+v.avatar+"' />"+
					                                    "<div class='p_att' href='"+v.user_id+"'>"+
					                                        "<p class='al_att'>已关注</p>"+
					                                    "</div>"+
				                                    "</div>"+
				                                    "<div class='content' >"+
					                                    "<div class='contents user_info' href='"+v.id+"' >"+
						                                    "<a class='user_name'>"+v.nickname+"</a>"+
						                                    "<a class='time'>"+dataStr2+"</a>"+
					                                    "</div>"+
					                                    "<div class='contents publish' href='"+v.id+"'>"+dataStr1+" 发布</div>"+
				                                        "<p class='contents content_words' href='"+v.id+"' >"+v.title+"</p>"+
				                                        "<div class='discuss' href='"+v.id+"' >"+
				                                            "<a href='comment?inh_id="+v.id+"'>"+
				                                                "<img src='<?=$inc_url; ?>img/message.png' style='padding-right:8px' />"+
				                                            "</a>"+
				                                            "<a href='comment?inh_id="+v.id+"'> "+v.comment_num+"</a>"+
				                                        "</div>"+
				                                    "</div>"+
			                                    "</div>"+
			                                "</div>"
										}else if(v.pic1!='' && v.pic2!=''){//显示全部图
											appendHtml+=
									        "<div class='dynamics'>"+
			                                    "<div class='dynamic'>"+
				                                    "<div class='user_head' href='"+v.user_id+"' >"+
					                                    "<img src='"+v.avatar+"' />"+
					                                    "<div class='p_att' href='"+v.user_id+"'>"+
					                                        "<p class='al_att'>已关注</p>"+
					                                    "</div>"+
				                                    "</div>"+
				                                    "<div class='content' >"+
					                                   "<div class='contents user_info' href='"+v.id+"' >"+
						                                    "<a class='user_name'>"+v.nickname+"</a>"+
						                                    "<a class='time'>"+dataStr2+"</a>"+
					                                    "</div>"+
					                                    "<div class='contents publish' href='"+v.id+"'>"+dataStr1+" 发布</div>"+
				                                        "<p class='contents content_words' href='"+v.id+"' >"+v.title+"</p>"+
				                                
				    	                                "<div class='contents content_pics' href='"+v.id+"' >"+
				    	                                    "<div class='pic1'><img src='"+v.pic1+"' /></div>"+
				    	                                    "<div class='pic2'><img src='"+v.pic2+"' /></div>"+
				    	                                "</div>"+    
				                                
				                                        "<div class='discuss' href='"+v.id+"' >"+
				                                            "<a href='comment?inh_id="+v.id+"'>"+
				                                                "<img src='<?=$inc_url; ?>img/message.png' style='padding-right:8px' />"+
				                                            "</a>"+
				                                            "<a href='comment?inh_id="+v.id+"'> "+v.comment_num+"</a>"+
				                                        "</div>"+
				                                    "</div>"+
			                                    "</div>"+
			                                "</div>"
										}else{//显示第一张图
											appendHtml+=
									        "<div class='dynamics'>"+
			                                    "<div class='dynamic'>"+
				                                    "<div class='user_head' href='"+v.user_id+"' >"+
					                                    "<img src='"+v.avatar+"' />"+
					                                    "<div class='p_att' href='"+v.user_id+"'>"+
					                                        "<p class='al_att'>已关注</p>"+
					                                    "</div>"+
				                                    "</div>"+
				                                    "<div class='content' >"+
					                                   "<div class='contents user_info' href='"+v.id+"' >"+
						                                    "<a class='user_name'>"+v.nickname+"</a>"+
						                                    "<a class='time'>"+dataStr2+"</a>"+
					                                    "</div>"+
					                                    "<div class='contents publish' href='"+v.id+"'>"+dataStr1+" 发布</div>"+
				                                        "<p class='contents content_words' href='"+v.id+"' >"+v.title+"</p>"+
				                                
				    	                                "<div class='contents content_pics' href='"+v.id+"' >"+
				    	                                    "<div class='pic1'><img src='"+v.pic1+"' /></div>"+
				    	                                "</div>"+    
				                                
				                                        "<div class='discuss' href='"+v.id+"' >"+
				                                            "<a href='comment?inh_id="+v.id+"'>"+
				                                                "<img src='<?=$inc_url; ?>img/message.png' style='padding-right:8px' />"+
				                                            "</a>"+
				                                            "<a href='comment?inh_id="+v.id+"'> "+v.comment_num+"</a>"+
				                                        "</div>"+
				                                    "</div>"+
			                                    "</div>"+
			                                "</div>"
										}
									}else{
										if(v.pic1=='' && v.pic2==''){//不显示图
											appendHtml+=
									        "<div class='dynamics'>"+
			                                    "<div class='dynamic'>"+
				                                    "<div class='user_head' href='"+v.user_id+"' >"+
					                                    "<img src='"+v.avatar+"' />"+
					                                    "<div class='p_att' href='"+v.user_id+"'>"+
					                                        "<p class='add_att'>+关注</p>"+
					                                    "</div>"+
				                                    "</div>"+
				                                    "<div class='content' >"+
					                                    "<div class='contents user_info' href='"+v.id+"' >"+
						                                    "<a class='user_name'>"+v.nickname+"</a>"+
						                                    "<a class='time'>"+dataStr2+"</a>"+
					                                    "</div>"+
					                                    "<div class='contents publish' href='"+v.id+"'>"+dataStr1+" 发布</div>"+
				                                        "<p class='contents content_words' href='"+v.id+"' >"+v.title+"</p>"+
				                                        "<div class='discuss' href='"+v.id+"' >"+
				                                            "<a href='comment?inh_id="+v.id+"'>"+
				                                                "<img src='<?=$inc_url; ?>img/message.png' style='padding-right:8px' />"+
				                                            "</a>"+
				                                            "<a href='comment?inh_id="+v.id+"'> "+v.comment_num+"</a>"+
				                                        "</div>"+
				                                    "</div>"+
			                                    "</div>"+
			                                "</div>"
										}else if(v.pic1!='' && v.pic2!=''){//显示全部图
											appendHtml+=
									        "<div class='dynamics'>"+
			                                    "<div class='dynamic'>"+
				                                    "<div class='user_head' href='"+v.user_id+"' >"+
					                                    "<img src='"+v.avatar+"' />"+
					                                    "<div class='p_att' href='"+v.user_id+"'>"+
					                                        "<p class='add_att'>+关注</p>"+
					                                    "</div>"+
				                                    "</div>"+
				                                    "<div class='content' >"+
					                                   "<div class='contents user_info' href='"+v.id+"' >"+
						                                    "<a class='user_name'>"+v.nickname+"</a>"+
						                                    "<a class='time'>"+dataStr2+"</a>"+
					                                    "</div>"+
					                                    "<div class='contents publish' href='"+v.id+"'>"+dataStr1+" 发布</div>"+
				                                        "<p class='contents content_words' href='"+v.id+"' >"+v.title+"</p>"+
				                                
				    	                                "<div class='contents content_pics' href='"+v.id+"' >"+
				    	                                    "<div class='pic1'><img src='"+v.pic1+"' /></div>"+
				    	                                    "<div class='pic2'><img src='"+v.pic2+"' /></div>"+
				    	                                "</div>"+    
				                                
				                                        "<div class='discuss' href='"+v.id+"' >"+
				                                            "<a href='comment?inh_id="+v.id+"'>"+
				                                                "<img src='<?=$inc_url; ?>img/message.png' style='padding-right:8px' />"+
				                                            "</a>"+
				                                            "<a href='comment?inh_id="+v.id+"'> "+v.comment_num+"</a>"+
				                                        "</div>"+
				                                    "</div>"+
			                                    "</div>"+
			                                "</div>"
										}else{//显示第一张图
											appendHtml+=
									        "<div class='dynamics'>"+
			                                    "<div class='dynamic'>"+
				                                    "<div class='user_head' href='"+v.user_id+"' >"+
					                                    "<img src='"+v.avatar+"' />"+
					                                    "<div class='p_att' href='"+v.user_id+"'>"+
					                                        "<p class='add_att'>+关注</p>"+
					                                    "</div>"+
				                                    "</div>"+
				                                    "<div class='content' >"+
					                                   "<div class='contents user_info' href='"+v.id+"' >"+
						                                    "<a class='user_name'>"+v.nickname+"</a>"+
						                                    "<a class='time'>"+dataStr2+"</a>"+
					                                    "</div>"+
					                                    "<div class='contents publish' href='"+v.id+"'>"+dataStr1+" 发布</div>"+
				                                        "<p class='contents content_words' href='"+v.id+"' >"+v.title+"</p>"+
				                                
				    	                                "<div class='contents content_pics' href='"+v.id+"' >"+
				    	                                    "<div class='pic1'><img src='"+v.pic1+"' /></div>"+
				    	                                "</div>"+    
				                                
				                                        "<div class='discuss' href='"+v.id+"' >"+
				                                            "<a href='comment?inh_id="+v.id+"'>"+
				                                                "<img src='<?=$inc_url; ?>img/message.png' style='padding-right:8px' />"+
				                                            "</a>"+
				                                            "<a href='comment?inh_id="+v.id+"'> "+v.comment_num+"</a>"+
				                                        "</div>"+
				                                    "</div>"+
			                                    "</div>"+
			                                "</div>"
										}
									}
										
                                    jslength++;
                                });
                                if(jslength=10&&result!=''){
                                	var appendPage = $("#page_now").attr("value", pst+1);
                                	pageNow = appendPage.val();//2
	                                pst = parseInt(pageNow);
	                                console.log(pageNow);
	                                console.log(pst);
				                    $("#thelist").append(appendHtml);
				                    me.resetload();
                                }else{
                                    $(".loading").html("没有数据了")
                                }
                                
                                $(".contents").each(function(){
		                            var $this = $(this);
		                            var href = $(this).attr("href");
		                            $this.click(function(){
			                            window.location = "root_new_set?inh_id=" + href 
		                            });
	                            });
	                            
	                            var cvwth1 = $(".pic1").width()/106*83;
	                            var cvwth2 = $(".pic2").width()/106*83;
				                $(".pic1").css("height", cvwth1+"px");
				                $(".pic2").css("height", cvwth2+"px");
				                
	                            checkConcern();
	                            
		                },
		                error:function(xhr, type){
                            alert('ajax error!');
                            me.resetload();
                        }
	        });
        }

	})
	
	
	
$(function(){
	$(".contents").each(function(){
		var $this = $(this);
		var href = $(this).attr("href");
		$this.click(function(){
			window.location = "root_new_set?inh_id=" + href 
		});
	});
	
	var cvwth1 = $(".pic1").width()/5*4;
	var cvwth2 = $(".pic2").width()/5*4;
	$(".pic1").css("height", cvwth1+"px");
	$(".pic2").css("height", cvwth2+"px");
});
	
	
	
	
$(function() {
            $(".p_att").click(function(){
				var href = $(this).attr("href");
				var attFans = $(this);
                $.ajax({
                    type: "POST",
                    url: "init/follow",
                    data: {
                        user_id: href
                    },
                    dataType: "json",
                    async: true,
                    success: function(result) {
                        var x;
                        switch(result) {
	                        case 0:
		                        x = "操作失败";
		                        break;
	                        case 1:
		                        x = "关注成功";
		                        break;
	                        case 2:
		                        x = "取消关注成功";
		                        break;
	                        default:
		                        x = "操作失败";
                        }
                        alert(x);
                        if(x == "关注成功") {
	                        attFans.children(".add_att").remove();
	                        attFans.prepend("<p class='al_att'>已关注</p>");
	                        window.location.reload();
                        }
                        if(x == "取消关注成功") {
	                        attFans.children(".al_att").remove();
	                        attFans.prepend("<p class='add_att'>+关注</p>");
	                        window.location.reload();
                        }
                    }
                });
            });

});


function checkConcern(){
	        $(".p_att").click(function(){
				var href = $(this).attr("href");
				var attFans = $(this);
                $.ajax({
                    type: "POST",
                    url: "init/follow",
                    data: {
                        user_id: href
                    },
                    dataType: "json",
                    async: true,
                    success: function(result) {
                        var x;
                        switch(result) {
	                        case 0:
		                        x = "操作失败";
		                        break;
	                        case 1:
		                        x = "关注成功";
		                        break;
	                        case 2:
		                        x = "取消关注成功";
		                        break;
	                        default:
		                        x = "操作失败";
                        }
                        alert(x);
                        if(x == "关注成功") {
	                        attFans.children(".add_att").remove();
	                        attFans.prepend("<p class='al_att'>已关注</p>");
	                        window.location.reload();
                        }
                        if(x == "取消关注成功") {
	                        attFans.children(".al_att").remove();
	                        attFans.prepend("<p class='add_att'>+关注</p>");
	                        window.location.reload();
                        }
                    }
                });
            });
}

</script>

</html>