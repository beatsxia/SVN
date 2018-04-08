$(function(){
	$(".lock").click(function(){
		$(".lock").toggle();
		var i = 1-$(this).attr("id");
		$("#lock").attr("value",i);
		console.log(i);	
		
		if($("#lock").val()==0){
    	    alert("该文章所有人可见");
        }else{
    	    alert("该文章仅自己可见");
        }
        
	});
});







