<!DOCTYPE html>
<html>

	<head>
		<meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0" charset="UTF-8">
		<title>回覆我的</title>
	</head>

	<link rel="stylesheet" href="<?php echo $inc_url; ?>css/reply_me.css" />
	<link rel="stylesheet" href="<?php echo $inc_url; ?>css/bootstrap.min.css" />

	<body style="height: 100%;">
	    <div class="wrapper" id="wrapper">
	            <div id="thelist" class="lists">
		            <input type="hidden" id="page_now" value="1"  />
		            <?php foreach ($comment_data as $item): ?>
			        <div class="item_info" style="border-bottom: 1px #EEEEEE solid;width: 100%;margin: 0 auto;cursor: pointer;">
			            <div class="main">
				            <div class="user_head"><img class="head_img" src="<?=$item['avatar'] ?>" /></div>
				            <div class="reply_info">
					            <div class="username"><?=$item['user_name'] ?></div>
					            <div class="content"><?=$item['content'] ?></div>
					            <div class="replyday"><?=date("m月d日 H:i", $item['time']) ?></div>
				            </div>
				            <div class="handle_cover">
					            <?php if(!empty($item['thumbnail'])){?>
						            <img class="cover_img" src="<?=$item['thumbnail'] ?>" />
					            <?php }else{ ?>
						            <span class="cover_title"><?=$item['title'] ?></span>
					            <?php } ?>
				            </div>
			            </div>
		            </div>
		            <?php endforeach; ?>
	            </div>
        </div>
	</body>

	<script type="text/javascript" src="<?php echo $inc_url; ?>js/jquery-2.2.3.min.js"></script>
	<script type="text/javascript" src="<?php echo $inc_url; ?>js/bootstrap.min.js"></script>
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
						url: "init/getUserCommentPage2",
						data: {"page": pst+1}, //第2页
						dataType: "json",
						async: true,
						success: function(result) {
							console.log(result)
								var appendHtml = "";
								var jslength = 0;
                                $.each(result, function(k, v) {
                                	console.log(v)
                                	var timer = v.time;
									var newTimer = new Date(parseInt(timer) * 1000);
									var dataStr = (newTimer.getMonth() + 1 < 10 ? '0' + (newTimer.getMonth() + 1) : newTimer.getMonth() + 1) + '月' + (newTimer.getDate() < 10 ? '0' + (newTimer.getDate()) : newTimer.getDate()) + '日&nbsp;' + (newTimer.getHours() < 10 ? '0' + newTimer.getHours() : newTimer.getHours()) + ':' + (newTimer.getMinutes() < 10 ? '0' + newTimer.getMinutes() : newTimer.getMinutes());
									appendHtml +=
										"<div class='item_info' style='border-bottom: 1px #D3D3D3 solid;width: 100%;margin: 0 auto;cursor: pointer;'>" +
										"<div class='main'>" +
										"<div class='user_head'>" +
										"<img class='head_img' src='" + v.avatar + "' />" +
										"</div>" +
										"<div class='reply_info'>" +
										"<div class='username'>" + v.user_name + "</div>" +
										"<div class='content'>" + v.content + "</div>" +
										"<div class='replyday'>" + dataStr + "</div>" +
										"</div>" + 
										"<div class='handle_cover'>" +
										"<?php if(!empty($item['thumbnail'])){?>"+
                                        "<img class='cover_img' src='" + v.thumbnail + "' />" +
	                                    "<?php }else{ ?>"+
                                        "<span class='cover_title'>" + v.title + "</span>" +
	                                    "<?php } ?>"+
				                        "</div>"+
                                        "</div>"+
                                        "</div>";
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



