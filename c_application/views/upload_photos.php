<!DOCTYPE html>
<html>

	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0" charset="UTF-8">
		<title>上傳圖片</title>
	</head>

	<link rel="stylesheet" href="<?=$inc_url?>css/upload_photos.css" />

	<body>
		<?php echo form_open_multipart('upload_photos/album_upload',array('method' => 'post', 'name' => 'upload_pic_form', 'onsubmit' => 'return check()'));?>
			<input type="hidden" name="album_id" value="<?=$album_id?>" />
			<input type="hidden" name="stele_id" value="<?=$stele_id?>" />
			<div class="upload_pics">
				<!--用来存放图片-->
				<div id="show_pics"></div>
				
				<div class="upload_tips">
				    <span>+</span>
			    </div>
			

			    <div id="inputFile">
					<input type="file" id="myFile0" name="pic" style="display: none;" />
				</div>
			</div>
			<div class="submit_btn"><button type="submit" class="btn_align_right">确定上传</button></div>
		</form>
	</body>

	<script type="text/javascript" src="<?=$inc_url?>js/jquery-2.2.3.min.js"></script>
	<script>
		var i = 0;
		$(function() {
			$(".upload_tips").click(function() {
			    //限制img按钮的隐藏
			    if(i == 0) {
			        $(".upload_tips").css("display","none");
			    }
			    
				$("#myFile" + i).trigger("click");

				$("#show_pics").append(
					"<div class='pics_area'>" +
					"<img src='' name='img" + i + "' class='imgs' id='img" + i + "' />" +
					"</div>"
				);
				
				var cvwth = $(".pics_area").width();
				$(".imgs").attr("height", cvwth);

				get(i);
				i++;

				$("#inputFile").append("<input type='file'  id='myFile" + i + "' name='pic" + i + "'   style='display:none' />")
			});

		})

		function get(j) {
			$("#myFile" + j).on("change", function() {
				var $file = $(this);
				var fileObj = $file[0];

				var windowURL = window.URL || window.webkitURL;
				var dataURL;
				var $img = $("#img" + j);
				if(fileObj && fileObj.files && fileObj.files[0]) {
					dataURL = windowURL.createObjectURL(fileObj.files[0]);
					$img.attr('src', dataURL);
				} else {
					dataURL = $file.val();
					var imgObj = document.getElementById("img" + j);
					imgObj.style.filter = "progid:DXImageTransform.Microsoft.AlphaImageLoader(sizingMethod=scale)";
					imgObj.filters.item("DXImageTransform.Microsoft.AlphaImageLoader").src = dataURL;

				}
				return dataURL;
			});
		};
		
		function check(){
			return true;
		}
		
	</script>

</html>