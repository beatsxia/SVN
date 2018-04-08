<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0" charset="UTF-8">
		<title>新建傳承碑</title>
	</head>
	
	<link rel="stylesheet" href="<?=$inc_url?>css/new_heritage.css" />
	
	<body>
		<?php echo form_open_multipart('new_heritage/new_heritage',array('name' => 'myForm', 'onsubmit' => 'return check()'));?>
			<div class="top_bg"></div>
			<div class="nickname">
				<span>昵称</span>
				<div style="float: right;width: 82%;"><input type="text" name="nickname" value="" max="16" /></div>
			</div>
			<div class="intro_yourself">
				<span>个人介绍</span>
				<div style="float: right;width: 80%;">
					<input type="text" name="intro_yourself" value="" />
				</div>
			</div>
			<div class="cover_pic">
				<div class="head_lf">
					<span>头像</span>
					<div id="photo_cover_bg">
					</div>
					<div id="inputFile">
						<input type="file" id="myFile0" name="userhead" style="display: none;" />
					</div>
				</div>
				<div class="head_rg">
					<span><a>没有头像→</a>&nbsp;传承牌</span>
					<!--<img src="<?=$inc_url?>img/head_root.jpg" />-->
					<img  />
				</div>
			</div>
			<div class="write_date">
				<span>出生日</span>
				<div>
					<input type="text" name="birthday" value="" />
				</div>
				<span>逝世日</span>
				<div>
					<input type="text" name="day_of_death" value="" />
				</div>
				<span style="color: #D7D7D7;">(可不填)</span>
			</div>
			<div class="associated_bioraphy">
				<span>关联传记</span>
				<div style="float: right;width: 50%;">
				    <select dir="rtl" class="inh_select" name="link_inh_id">
					    <option>请选择</option>
				    </select>
				</div>
			</div>
			
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
						    <span><input type="radio" value="kongzi" name="myTemplate" checked="checked" style="display: none;"  /></span>
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
			<div class="heritage_card">
				<div style="position: fixed;bottom: 3%;width: 100%;">
				    <div class="card_cont">
					    <div class="card_one">
					        <img src="<?=$inc_url?>img/head_root.jpg" />
						    <input type="hidden" class="bg_val" value="userHead1" />
						    <span><input type="radio" value="userHead1" name="myTemplate" checked="checked" style="display: none;"  /></span>
						    <!--<img src="<?=$inc_url?>img/yes.png"  />-->
					    </div>
				    </div>
				    <div class="card_dele">取消</div>
				</div>
			</div>
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
				alert("请输入昵称！");
				myForm.nickname.focus();
				return false;
			}
			if(myForm.intro_yourself.value==''){
				alert("请输入个人介绍！");
				myForm.intro_yourself.focus();
				return false;
			}
			if($("#photo_cover_bg").html()==''){
				alert("请上传头像！");
				return false;
			}
			if(myForm.birthday.value==''){
				alert("请输入出生日！");
				myForm.birthday.focus();
				return false;
			}
			if($(".xianghuo").children("span").html()==''&&$(".send_flower").children("span").html()==''){
				alert("请选择上香/送花");
				return false;
			}
			return true;
		}
		
		
		$(function(){
			$(".fl_lf").click(function(){
                var flVal = $(this).children(".fl_val").val();
				$(this).children("p").css("color","#683432");
				$(".fl_lf").not($(this)).children("p").css("color","#949494");
				$(this).children("span").empty().append(
					"<input type='radio' value=" + flVal + " checked='checked' name='mychoice' />"
				);
				
			});
			
			var imgHgt = $(".xianghuo img").height();
			$(".fl_lf img").height(imgHgt);
			
			var winHgt = $(window).height()*0.012;
			$(".top_bg").css("height",winHgt);
			
			var rpwth = $(".recom_pho").width();
			$(".recom_pho").css({
			    "line-height": "" + rpwth + "px"
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
　　               url:"init/inh_select",
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

//      $(".heritage_card").height($(window).height()*0.482143);
		
		
		$(".head_rg img").click(function(){
			$(".heritage_card").css("opacity","1");
			$(".heritage_card").css("height",$(window).height()*0.482143);
		})
		$(".card_dele").click(function(){
			$(".heritage_card").css("opacity","0");
		});
		$(".card_one").click(function(){
			var $this = $(this);
			$this.append(
				"<img src='<?=$inc_url?>img/yes.png'  />"
			);
			$(".heritage_card").css("opacity","0");
			$(".head_rg img").attr("src","<?=$inc_url?>img/head_root.jpg")
		})
        $(".card_one").height($(".card_one").width());
	</script>
	
</html>
