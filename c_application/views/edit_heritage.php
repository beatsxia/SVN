<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0" charset="UTF-8">
		<title>新建传承碑</title>
	</head>
	
	<link rel="stylesheet" href="<?=$inc_url?>css/new_heritage.css" />
	
	<body>
		<?php echo form_open_multipart('identify/edit',array('name' => 'myForm', 'onsubmit' => 'return check()'));?>
			<input type="hidden" name="stele_id" value="<?=$stele['id']?>" />
			<div class="top_bg"></div>
			<div class="nickname">
				<span style="color: #B70000;">*</span>
				<span>被纪念人姓名</span>
				<div style="float: right;width: 60%;"><input type="text" name="nickname" value="<?=$stele['title']?>" max="16" /></div>
			</div>
			<div class="sex">
				<span style="color: #B70000;">*</span>
				<span>性别</span>
				<div style="float: right;width: 60%;text-align: right;">
				    <select name="sex" style="border: 0;outline: none;text-align-last:right;-webkit-appearance:none;appearance:none;">
					    <option value="0" <?php if($stele['sex']=='0'){echo 'selected="selected"';}?>>请选择</option>
					    <option value="1" <?php if($stele['sex']=='1'){echo 'selected="selected"';}?>>男</option>
					    <option value="2" <?php if($stele['sex']=='2'){echo 'selected="selected"';}?>>女</option>
				    </select>
				</div>
			</div>
			<div class="intro_yourself">
				<span style="color: #B70000;">*</span>
				<span>个人介绍（年谱）</span>
				<div style="float: right;width: 58%;">
					<input type="text" name="intro_yourself" value="<?=$stele['synopsis']?>" />
				</div>
			</div>
			<div class="cover_pic">
				<span>头像</span>
				<div id="photo_cover_bg">
					<img src="<?=$stele['picture']?>" class="imgs" width="40" height="40" />
				</div>
				<div id="inputFile">
					<input type="file" id="myFile0" name="userhead" style="display: none;" />
				</div>
			</div>
			<div class="write_date">
				<span>出生日</span>
				<div>
					<input type="text" name="birthday" value="<?=$stele['birthday_time']?>" />
				</div>
				<span>逝世日</span>
				<div>
					<input type="text" name="day_of_death" value="<?=$stele['death_time']?>" />
				</div>
				<span style="color: #D7D7D7;">(可不填)</span>
			</div>
			<div class="associated_bioraphy">
				<span>关联传记</span>
				<div style="float: right;width: 50%;">
				    <select dir="rtl" class="inh_select" name="link_inh_id">
				    	<?php if($stele['inh_id']!='0'){?>
							<option value="<?=$stele_link_inh['id']?>"><?=$stele_link_inh['title']?></option>
				    	<?php }else{?>
					    	<option value="">请选择</option>
					    <?php }?>
				    </select>
				</div>
			</div>
			<div class="vip_code">
				<span>VIP激活码兑换<span style="color: #D7D7D7;">（没有请忽略）</span></span>
				<div style="float: right;width: 20%;height:50px;display: flex;align-items: center;justify-content: flex-end;">
				    <img style="width: 40%;" src="<?=$inc_url?>img/goRight.png" />
				</div>
			</div>
			<p style="color: #B70000;font-size: 12px;width: 94%;margin: 0 auto;line-height: 22px;">* 为必填</p>
			
			
			<!--<div class="anima_espe">
				<div class="xianghuo fl_lf">
					<input class="fl_val" type="hidden" value="1" />
					<img src="<?=$inc_url?>img/xianghuo_logo.gif" />
					<p>上香</p>
					<span></span>
				</div>
				<div class="send_flower fl_lf">
					<input class="fl_val" type="hidden" value="2" />
					<img src="<?=$inc_url?>img/flower_logo.png" />
					<p>送花</p>
					<span></span>
				</div>
			</div>-->
			
			<div class="temp_recom">
				<div class="recom_intro">
					<strong>模板推荐</strong>
					<p>一大波模版前来报到</p>
				</div>
				<div class="recom_photos">
					<div class="mypho">
					    <div class="recom_pho canclic">
						    <img src="<?=$inc_url?>img/inh_mmt_bg2.jpg" />
						    <input type="hidden" class="bg_val" value="inh_stele_second" />
						    <span><input type="radio" value="inh_stele_second" name="myTemplate" checked="checked" style="display: none;"  /></span>
						    <img src="<?=$inc_url?>img/yes.png"  />
					    </div>
					    <p>传承碑<img src="<?=$inc_url?>img/free_logo.png" /></p>
					</div>
					<div class="mypho">
					    <div class="recom_pho canclic">
						    <img src="<?=$inc_url?>img/inh_mmt_bg.jpg" />
					    	<input type="hidden" class="bg_val" value="kongzi" />
						    <span><input type="radio" value="kongzi" name="myTemplate"  style="display: none;"  /></span>
						    <img src="<?=$inc_url?>img/no.png"  />
					    </div>
					    <p>碑<img src="<?=$inc_url?>img/free_logo.png" /></p>
					</div>
					<div class="mypho">
					    <div class="recom_pho">
						    <img src="" />
						    <span></span>
						    <img src="<?=$inc_url?>img/no.png"  />
					    </div>
					    <p>敬请期待</p>
					</div>
				</div>
			</div>
			<p class="subm_btn">
				<button type="submit" class="btn">确定</button>
			</p>
		</form>
	</body>
	
	<script type="text/javascript" src="<?=$inc_url?>js/jquery-2.2.3.min.js"></script>
	<script>
		var i = 0;
		$(function() {
			$("#photo_cover_bg").click(function() {
				$("#myFile" + i).trigger("click");

				$(this).empty().append(
					"<img src='' name='userhead' class='imgs' id='img" + i + "' width='40' height='40' />"
				);


				get(i);
				i++;

				$("#inputFile").append("<input type='file'  id='myFile" + i + "' style='display:none' />")
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
			if(myForm.nickname.value==''){
				alert("请输入姓名！");
				myForm.nickname.focus();
				return false;
			}
			if($(".sex select option:selected").val()==""){
				alert("请输入性别！");
				return false;
			}
			if(myForm.intro_yourself.value==''){
				alert("请输入个人年谱！");
				myForm.intro_yourself.focus();
				return false;
			}
			if(!oCbox.checked){
				alert("请先阅读并同意用户服务协议！")
				return false;
			}
//			if($(".xianghuo").children("span").html()==''&&$(".send_flower").children("span").html()==''){
//				alert("请选择上香/送花");
//				return false;
//			}
			return true;
		}
		
		
		$(function(){
//			$(".fl_lf").click(function(){
//              var flVal = $(this).children(".fl_val").val();
//				$(this).children("p").css("color","#683432");
//				$(".fl_lf").not($(this)).children("p").css("color","#949494");
//				$(this).children("span").empty().append(
//					"<input type='radio' value=" + flVal + " checked='checked' name='mychoice' />"
//				);
//				
//			});
			
			var imgHgt = $(".xianghuo img").height();
			$(".fl_lf img").height(imgHgt);
			
			var winHgt = $(window).height()*0.012;
			$(".top_bg").css("height",winHgt);
			
			var rpwth = $(".recom_pho").width();
			$(".recom_pho").css({
			    "line-height": "" + rpwth + "px"
			});
			
			$(".vip_code").click(function(){
				window.location="activation_converbility?s=<?=$stele['id']?>"
			});
			
			
			$(".canclic").click(function(){
				var temVal = $(this).children(".bg_val").val();
				$(this).children("span").empty().append(
					"<input type='radio' value=" + temVal + " name='myTemplate' checked='checked' style='display:none' />"
				);
				$(this).children("img:last-child").attr("src","<?=$inc_url?>img/yes.png");
				$(".canclic").not($(this)).children("img:last-child").attr("src","<?=$inc_url?>img/no.png");
			})
		});
		var tn = new Date();
		$.ajax({
　　        url:"<?=base_url()?>index.php/init/inh_select",
　　           type:"post",
　　           data: {
						now_time : tn
					},
			   dataType: "json",
			   async: true,
　　           success:function(data){
　　                for(var i =0; i<data.length; i++){
　　                    $(".inh_select").append("<option value='" + data[i].inh_id + "'>" + data[i].title + "</option>")
　　                }
　　            }
　　    });
		
		
	</script>
	
</html>
