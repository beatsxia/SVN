$(document).ready(function(){
	$("#pullUp").click(function(){
        var pageNow = $("#page_now").val();
		var pst = parseInt(pageNow);//1
		console.log(pst);
	    $.ajax({
		    type:"post",
            url:"http://beatsxia.s1.natapp.cc/SVN/index.php/init/getUserCommentPage2",
            data:{"page":pst+4},
		    dataType:"json",
		    async:true,
		    success:function(data){
			    console.log(data);
			    console.log(data.length);
			    var appendHtml="";
			    
                for(var i in data){
		            var timer = data[i]['time'];
//		            console.log(timer);
		            var newTimer = new Date(parseInt(timer) * 1000);
//		            console.log(newTimer);
		            var dateStr = (newTimer.getMonth()+1 < 10 ? '0'+(newTimer.getMonth()+1) : newTimer.getMonth()+1)+'月'+(newTimer.getDate() < 10 ? '0'+(newTimer.getDate()) : newTimer.getDate())+'日&nbsp;' + (newTimer.getHours()< 10 ? '0'+newTimer.getHours() : newTimer.getHours())+':'+(newTimer.getMinutes()< 10 ? '0'+newTimer.getMinutes() : newTimer.getMinutes());
//                  console.log(dateStr);
                    appendHtml+= 
                    "<div class='item_info' style='border-bottom: 1px #D3D3D3 solid;width: 100%;margin: 0 auto;cursor: pointer;'>"+
                        "<div class='main'>"+
                            "<div class='user_head'>"+
                                "<img class='head_img' src='"+data[i]['avatar']+"' />"+
                            "</div>"+
                            "<div class='reply_info'>"+
                                "<div class='username'>"+data[i]['user_name']+"</div>"+
                                "<div class='content'>"+data[i]['content']+"</div>"+
                                "<div class='replyday'>"+dateStr+"</div>"+
                            "</div>"+
                            "<div class='handle_cover'>"+
					            "<?php if(!empty($item['thumbnail'])){?>"+
						            "<img class='cover_img' src='"+data[i]['thumbnail']+"' />"+
					            "<?php }else{ ?>"+
						            "<span class='cover_title'>"+data[i]['title']+"</span>"+
					            "<?php } ?>"+
				            "</div>"+
                        "</div>"+
                    "</div>"
                }
			    $("#thelist").append(appendHtml);
		    }
	    });
	});
});





