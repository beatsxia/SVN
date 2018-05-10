<!DOCTYPE html>
<html>

	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0" charset="UTF-8">
		<title>编辑传承碑</title>
	</head>

	<link rel="stylesheet" href="<?=$inc_url ?>css/identify.css" />
	<style>
		#date_begin,#date_end{
			width: 26%;
			text-align: center;
			font-size: 14px;
			color: #B8B8B8;
			height: 20px;
			border: 0;
			outline: none;
		}
	</style>

	<body>
		<div class="personal_header">
			<img src="<?=$inc_url ?>img/personal_header_bg.jpg" />
		</div>
		<div class="user_header">
			<img class="user_header" src="<?=$stele['picture']?>" />
		</div>
		<div class="user_info">
			<!--<div class="user_name">
				<?=$stele['title']?>
			</div>-->
			<!--
			<div class="sex_ima">
				<img src="<?=$inc_url ?>img/female.png" />
			</div>
			-->
		</div>
		<div class="mine_sign">
			<img src="<?=$inc_url ?>img/revise.png" />
			<span><?=$stele['my_words']?></span>
		</div>
		<div class="usrnam">
			<div class="fl_lf">
				<span></span>被纪念人姓名:
			</div>
			<input type="text" class="fl_rg" name="commemorative_name" value="<?=$stele['title']?>" onchange="changeName()" />
		</div>
		<div class="intro_yourself">
			<span></span>个人介绍（年谱）<strong>></strong>
		</div>
		<div class="intro_content">
			<!--这里展示个人介绍:-->
			<?=$stele['synopsis']?>
		</div>
		<div class="sex">
			<div class="float_left">
				<span></span>性别：
				<select name="sex" onchange="changeSex()">
					<option value="0" <?php if($stele['sex']=='0'){echo 'selected="selected"';}?>>请选择</option>
					<option value="1" <?php if($stele['sex']=='1'){echo 'selected="selected"';}?>>男</option>
					<option value="2" <?php if($stele['sex']=='2'){echo 'selected="selected"';}?>>女</option>
				</select>
			</div>
			<div class="float_right">
				<div class="head_second">头像：</div>
				<div class="head_second_cover">
				     <img id="preview" src="<?=$stele['picture']?>" />
				     <!--<input type="file" name="userfile" id="myFile" onchange="imgPreview(this)" />-->
				</div>
			</div>
		</div>
		<div class="inh_ste">
			<span></span>生平：
			<!--<input type="text" value="<?=$stele['birthday_time']?>" placeholder="出生日期" name="date_begin" id="date_begin" size="10" maxlength="10" onClick="new Calendar().show(this);" readonly="readonly" onchange="changeBirthday()" />-->
			<input type="text" value="<?=$stele['birthday_time']?>" placeholder="出生日期" name="date_begin" id="date_begin" size="10" maxlength="10" onchange="changeBirthday()" />
			—
			<!--<input type="text" value="<?=$stele['death_time']?>" placeholder="逝世日期" name="date_end" id="date_end" size="10" maxlength="10" onClick="new Calendar().show(this);" readonly="readonly" onchange="changeDeath()" />-->
			<input type="text" value="<?=$stele['death_time']?>" placeholder="逝世日期" name="date_end" id="date_end" size="10" maxlength="10" onchange="changeDeath()" />
		</div>
		<div class="inh_ste">
			<span></span>传记
		</div>
		<!--选择/新建传记-->
		<?php if(!empty($stele_link_inh)){ ?>
		<div class="biography_info">
		    <div class="info_section">
			    <div class="info_cover" style="background: url(<?=!empty($stele_link_inh['pic1'])?$stele_link_inh['pic1']:$inc_url.'img/need_upload.jpg'?>) no-repeat;background-size: cover;background-position: center center;"></div>
			    <div class="info_words">
				    <h4><?=$stele_link_inh['title']?></h4>
				    <p class="inh_descri"><?=$stele_link_inh['inh_stage']?></p>
			    </div>
		    </div>
		</div>
		<?php }elseif($power=='1'){?>
			<div class="no_biogra">
				<div class="choose_heri">
				    <select class="inh_select" name="link_inh_id" onchange="chanOpt()">
						<option value="">选择已有传记</option>
					</select>
				</div>
				<div class="new_heri">新建传记</div>
			</div>
		<?php }?>
	</body>

<!--//	<script type="text/javascript" src="<?php echo $inc_url; ?>js/calendar.js"></script>-->
	<script type="text/javascript" src="<?php echo $inc_url; ?>js/jquery-2.1.1.min.js"></script>
	<script>
		$(function(){
			$(".alr_chio").height($(".alr_chio").width()/3);
			$(".new_bio").height($(".new_bio").width()/3);
			$(".alr_chio").css("line-height",$(".alr_chio").height()-2+"px");
			$(".new_bio").css("line-height",$(".new_bio").height()-2+"px");
			$(".intro_yourself").click(function(){
				window.location="intro_content?s=<?=$stele['id']?>"
			});
			<?php if(!empty($stele_link_inh)){ ?>
				$(".info_section").click(function(){
					window.location= "root_new_set?inh_id=<?=$stele_link_inh['id']?>"
				});
			<?php }?>
			$(".mine_sign img").click(function(){
				window.location = "identify/edit_heritage/<?=$stele['id']?>"
			});
			$(".no_biogra div").height($(".choose_heri").width()*0.344);
			$(".no_biogra div").css("line-height",$(".no_biogra div").height()-2+"px");
			$(".new_heri").click(function(){
				window.location = "edit_new_heritage?stele_id=<?=$stele['id']?>";
			});
			
			$(".fl_rg").width($(".usrnam").width()-$(".fl_lf").width()-8+"px");
			
			<?php if(empty($stele_link_inh)){?>
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
			<?php }?>
			
			
		});
		function chanOpt(){
            var seleVal = $(".inh_select option:selected").val();
            console.log(seleVal);
			$.ajax({
				url:"init/identify_update_inh_id",
				type:"post",
				async:true,
				dataType:"json",
				data:{
					inh_id:seleVal,
                    stele_id:<?=$stele['id']?>
				},
				success:function(data){
					var pstCode = JSON.parse(data.code);
					console.log(data)
				    console.log(pstCode);
				    console.log(data.hint);
				    if(pstCode=="1"){
				    	window.location = "identify?s=<?=$stele['id']?>";
				    }else{
				    	alert(data.hint);
				    }
				}
			});
		}
		
		
//		function imgPreview(fileDom) {
//			//判断是否支持FileReader
//			if(window.FileReader) {
//				var reader = new FileReader();
//			} else {
//				alert("您的设备不支持图片预览功能，如需该功能请升级您的设备！");
//			}
//
//			//获取文件
//			var fl = fileDom.files[0];
//			var imageType = /^image\//;
//			//是否是图片
//			if(!imageType.test(fl.type)) {
//				alert("请选择图片！");
//				return;
//			}
//			//读取完成
//			reader.onload = function(e) {
//				//获取图片dom
//				var img = document.getElementById("preview");
//				console.log(img.naturalWidth)
//				console.log(img.naturalHeight)
//				//图片路径设置为读取的图片
//				img.src = e.target.result;
//				if(img.naturalWidth<img.naturalHeight){
//			        img.style.height="100%"
//			        img.style.width="auto"
//		        }else{
//			        img.style.width="100%"
//			        img.style.height="auto"
//		        }
//			};
//			reader.readAsDataURL(fl);
//		}
		
		
		function changeName(){
			var nameContent = $(".fl_rg").val();
			$.ajax({
				type:"post",
				url:"init/update",
				async:true,
				dataType:"json",
				data:{
					type:"identify_name",
					value:<?=$stele['id']?>,
                    content:nameContent
				},
				success:function(data){
					console.log(data)
					console.log(data.hint)
					console.log(data.content)
					var pstCode = JSON.parse(data.code);
					if(pstCode=="0"){
						alert(data.hint);
					}
				}
			});
		}
		
		function changeSex(){
			var sexContent = $(".float_left select option:selected").val();
			var sexText = $(".float_left select option:selected").text();
            console.log(sexContent);
            console.log(sexText);
			$.ajax({
				type:"post",
				url:"init/update",
				async:true,
				dataType:"json",
				data:{
					type:"identify_sex",
					value:<?=$stele['id']?>,
                    content:sexContent
				},
				success:function(data){
					console.log(data)
					console.log(data.hint)
					console.log(data.content)
					var pstCode = JSON.parse(data.code);
					if(pstCode=="0"){
						$(".float_left select option:eq(0)").attr("selected","selected");
					}
					if(pstCode=="1"){
						$(".float_left select option:eq(1)").attr("selected","selected");
					}
					if(pstCode=="2"){
						$(".float_left select option:eq(2)").attr("selected","selected");
					}
				}
			});
		}
		
		function changeBirthday(){
			var birthdayContent = $("#date_begin").val();
			console.log(birthdayContent)
			$.ajax({
				type:"post",
				url:"init/update",
				async:true,
				dataType:"json",
				data:{
					type:"identify_birthday",
					value:<?=$stele['id']?>,
                    content:birthdayContent
				},
				success:function(data){
					console.log(data)
					console.log(data.hint)
					console.log(data.content)
					var pstCode = JSON.parse(data.code);
					if(pstCode=="0"){
						alert(data.hint);
						$("#date_begin").val('');
					}
				}
			});
		}
		
		function changeDeath(){
			var deathContent = $("#date_end").val();
			console.log(deathContent)
			$.ajax({
				type:"post",
				url:"init/update",
				async:true,
				dataType:"json",
				data:{
					type:"identify_death",
					value:<?=$stele['id']?>,
                    content:deathContent
				},
				success:function(data){
					console.log(data)
					console.log(data.hint)
					console.log(data.content)
					var pstCode = JSON.parse(data.code);
					if(pstCode=="0"){
						alert(data.hint);
						$("#date_end").val('');
					}
				}
			});
		}
		
		
		
    </script>  

</html>