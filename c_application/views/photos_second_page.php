<!DOCTYPE html>
<html>

	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0" charset="UTF-8">
		<title>传承相册</title>
	</head>

	<link rel="stylesheet" href="<?=$inc_url ?>css/photos_second_page.css" />

	<body>
		<?php echo form_open('upload_photos',array('name' => 'upload_pic_form', 'method' => 'post'));?>
			<input type="hidden" name="album_id" value="<?=$album_id?>" />
			<input type="hidden" name="stele_id" value="<?=$stele_id?>" />
			<div class="upload_tips">
				<img src="<?=$inc_url ?>img/upload_img_sign.png" />
				<span>上传图片</span>
			</div>
			<?php if(!empty($album_pic)){?>
				<div class="mypics">
					<span></span>你的相片
				</div>
				<div class="upload_pics">
					<!--用来存放图片-->
					<div id="show_pics">
						<?php foreach ($album_pic as $item): ?>
							<div class="photo_cover">
							    <img src="<?=$item['pic_url']?>" />
							</div>
						<?php endforeach; ?>
					</div>
				</div>
			<?php }else{?>
				<div class="nopics_tip">
					<p>
						暂无照片
					</p>
				</div>
			<?php }?>
		<div class="photo-mask"></div>
		<div class="photo-panel">
			<div class="photo-div">
				<div class="photo-left">
					<img src="<?=$inc_url ?>img/turn_left.png" />
				</div>
			    <div class="photo-img">
			    	<div class="photo-close">
						<img src="<?=$inc_url ?>img/close_ch.png" />
					</div>
			        <div class="photo-view-h">
						<img class="mask_close_btn" src="" />
					</div>
				</div>
				<div class="photo-right">
					<img src="<?=$inc_url ?>img/turn_right.png" />
				</div>
			</div>
		</div>	
		</form>
	</body>

	<script type="text/javascript" src="<?=$inc_url ?>js/jquery-2.2.3.min.js"></script>
	<script>
	    $(function(){
            $(".upload_tips").click(function(){
			    $("form").trigger("submit");
            });
            
            
                //图片垂直居中
                var cvwth = $(".photo_cover").width();
				console.log(cvwth)
			    $(".photo_cover").css({
			    	"line-height": "" + cvwth + "px"
			    });
				var wdw_hgt = $(window).height();
				var lf_rg_btn = wdw_hgt/2;
		        console.log(wdw_hgt);
		        console.log(lf_rg_btn);
		        $(".photo-view-h").css({
			        "line-height": "" + wdw_hgt + "px"
		        });
		        $(".photo-view-w").css({
			        "line-height": "" + wdw_hgt + "px"
		        });
		        $(".photo-left").css({
			        "top": "" + lf_rg_btn + "px"
		        });
		        $(".photo-right").css({
			        "top": "" + lf_rg_btn + "px"
		        });
		        //关闭蒙板按钮的显示与隐藏
		        $(".mask_close_btn").click(function(){
		        	$(".photo-close").fadeToggle("fast");
		        	$(".photo-left").fadeToggle("fast");
		        	$(".photo-right").fadeToggle("fast");
		        });
		        //关闭蒙板
		        $(".photo-close img").click(function() {
					$(".photo-mask").hide();
					$(".photo-panel").hide();
				});
				//下一张
				$(".photo-right").click(function() {
					img_index++;
					if(img_index >= $(".photo_cover img").length) {
						img_index = 0;
					}
					img_src = $(".photo_cover img").eq(img_index).attr("src");
					photoView($(".photo_cover img"));
				});
				//上一张
				$(".photo-left").click(function() {
					img_index--;
					if(img_index < 0) {
						img_index = $(".photo_cover img").length - 1;
					}
					img_src = $(".photo_cover img").eq(img_index).attr("src");
					photoView($(".photo_cover img"));
				});
				//如何调用
				$(".photo_cover img").click(function() {
					$(".photo-mask").show();
					$(".photo-panel").show();
                    img_src = $(this).attr("src");
					console.log(img_src);
					img_index = $(this).index();
					photoView($(this));
				});
				
		});
		
		
		//自适应预览
			function photoView(obj) {
				if($(obj).width() >= $(obj).height()) {
					$(".photo-view-h").attr("class", "photo-view-w");
					$(".photo-view-w img").attr("src", img_src);
				} else {
					$(".photo-view-w").attr("class", "photo-view-h");
					$(".photo-view-h img").attr("src", img_src);
				}
			}
	</script>

</html>