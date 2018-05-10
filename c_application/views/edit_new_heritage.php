<!DOCTYPE html>
<html>

	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0" charset="UTF-8">
		<title>編輯傳記</title>
	</head>

	<link rel="stylesheet" href="<?=$inc_url?>css/edit_new_heritage.css" />

	<body>
		<?php echo form_open_multipart('edit_new_heritage/add',array('name' => 'myForm','class' => 'myForm', 'onsubmit' => 'return check()'));?>
			<input type="hidden" id="arr_count" name="arr_count" value="1">
			<input type="hidden"  name="stele_id" value="<?=$this->input->get('stele_id');?>">
			<div class="heritage_title">
				<?php if(!empty($inherit)){?>
					<input type="text" class="tit_left" name="heritage_title" value="<?=$inherit['title']?>" />
					<input type="hidden"  name="inherit_id" value="<?=$inherit['id']?>" />
					<div class="tit_right">
						<img id="preview" src="<?=!empty($inherit['picture'])?$inherit['picture']:$inc_url.'img/upl_heri_cov.png';?>" />
						<input type="file" name="userfile" id="myFile" onchange="imgPreview(this)" />
						<!-- <input type="hidden" id="pic_data" name="pic_data" value="" /> -->
					</div>
				<?php }else{?>
					<input type="text" class="tit_left" name="heritage_title" maxlength="20" value="" placeholder="输入标题" />
					<input type="hidden"  name="inherit_id" value="0" />
					<div class="tit_right">
						<img id="preview" src="<?=$inc_url?>img/upl_heri_cov.png" />
						<input type="file" name="userfile" id="myFile" onchange="imgPreview(this)" />
						<!-- <input type="hidden" id="pic_data" name="pic_data" value="" /> -->
					</div>
				<?php }?>
			</div>
			<div class="infos">
				<?php if(!empty($inherit_contents)){foreach ($inherit_contents as $item):?>
					<div class="im_hti">
					    <div class="heritage_title_info">
						    <div class="heritage_num">
							    <input type="text"  value="<?=$item['con_num']?>" readonly="readonly" />
						    </div>
						    <div class="heritage_section_title">
							    <input type="text"  value="<?=$item['con_title']?>" readonly="readonly" />
						    </div>
						    <div class="btns">
					            <button type="button" class="delete delete_have" href="<?=$item['id']?>">删除</button>
				            </div>
					    </div>
					</div>
				<?php endforeach;}?>
				<div id="the_list">
				    <div class="heritage_title_info">
					    <div class="heritage_num">
						    <input type="text" name="heritage_num" id="num1" value="" placeholder="序号" />
					    </div>
					    <div class="heritage_section_title">
						    <input type="text" name="heritage_section_title" maxlength="13" id="section_title1" value="" placeholder="章节标题" />
					    </div>
					    <div class="btns">
					        <button type="button" class="delete delete_append">删除</button>
				        </div>
				    </div>
				</div>
			</div>
			<div class="heritage_add_btn">新增</div>
			<button class="my_btn" type="submit">完成</button>
		</form>
	</body>

	<script type="text/javascript" src="<?=$inc_url?>js/jquery-2.2.3.min.js"></script>
	<script>
		function imgPreview(fileDom) {
			//判断是否支持FileReader
			if(window.FileReader) {
				var reader = new FileReader();
			} else {
				alert("您的设备不支持图片预览功能，如需该功能请升级您的设备！");
			}

			//获取文件
			var fl = fileDom.files[0];
			var imageType = /^image\//;
			//是否是图片
			if(!imageType.test(fl.type)) {
				alert("请选择图片！");
				return;
			}
			//读取完成
			reader.onload = function(e) {
				//获取图片dom
				var img = document.getElementById("preview");
				console.log(img.naturalWidth)
				console.log(img.naturalHeight)
				//图片路径设置为读取的图片
				img.src = e.target.result;
				if(img.naturalWidth<img.naturalHeight){
			        img.style.height="100%"
			        img.style.width="auto"
		        }else{
			        img.style.width="100%"
			        img.style.height="auto"
		        }
			};
			reader.readAsDataURL(fl);
		}
		
		
		
		var i = 2; 
		var conf;
		
		
		$(".tit_left").width($(".heritage_title").width()-55+"px");
		
		$(".heritage_add_btn").click(function(){
			$("#the_list").append(
				"<div class='heritage_title_info'>"+
				    "<div class='heritage_num'>"+
					    "<input type='text' name='heritage_num"+ i +"' id='num"+ i +"' value='' placeholder='序号' />"+
				    "</div>"+
				    "<div class='heritage_section_title'>"+
					    "<input type='text' name='heritage_section_title"+ i +"' id='section_title"+ i +"' value='' placeholder='章节标题' />"+
				    "</div>"+
				    "<div class='btns'>"+
					    "<button type='button' class='delete delete_append'>删除</button>"+
				    "</div>"+
				"</div>"
			);
			$("#arr_count").val(i);
			i++;
			
			
			var expansion = null; //是否存在展开的contents
			var container = document.querySelectorAll('.heritage_title_info'); //找到所有的左滑盒子
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
			
			
			
			$(".delete_append").click(function(){
				var $this = $(this);
				conf = confirm("您确定删除该章节吗？");
				if(conf==true){
					$this.parent().parent().remove();
					alert("已删除！");
				}else{
					alert("取消操作！");
				}
			});
		});
		
		
		
		
		
		
		    var expansion = null; //是否存在展开的contents
			var container = document.querySelectorAll('.heritage_title_info'); //找到所有的左滑盒子
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
			
			
			$(".delete_append").click(function(){
				var $this = $(this);
				conf = confirm("您确定删除该章节吗？");
				if(conf==true){
					$this.parent().parent().remove();
					alert("已删除！");
				}else{
					alert("取消操作！");
				}
			});
			
			
//			$(".edit").c
			
			
			
	$(".delete_have").click(function(){
		var $this = $(this);
		var $thisId = $(this).attr("href");
        conf = confirm("您确定删除该章节吗？");
		if(conf==true){
		    $.ajax({
			    url:"init/delete_info",
			    type:"post",
			    async:true,
			    dataType:"json",
			    data:{
				    type : "inherit_content",
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
		
		

		function check(){
			var b = 1;
			if(myForm.heritage_title.value==""){
				alert("请输入标题!");
				myForm.heritage_title.focus();
			    return false;
			}
			// if(myForm.heritage_num.value==""){
			// 	alert("请输入序号!");
			// 	myForm.heritage_num.focus();
			//     return false;
			// }
			// if(myForm.heritage_section_title.value==""){
			// 	alert("请输入章节标题!");
			// 	myForm.heritage_section_title.focus();
			//     return false;
			// }
//		    $(".heritage_title_info").each(function() {
//			    var $this = $(this);
//			    var numVal = $this.children(".heritage_num").children("input").val();
//			    var sectionVal = $this.children(".heritage_section_title").children("input").val();
//			    if(null == numVal || "" == numVal) {
//				    alert("请输入序号！");
//				    b = 0;
//                  return false;
//			    }
//			    if(null == sectionVal || "" == sectionVal) {
//				    alert("请输入章节标题！");
//				    b = 0;
//				    return false;
//			    }
//		    });
		    if(b == 1) {
			    return true;
		    };
			return false;
	    }
	</script>

</html>