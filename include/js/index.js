$(document).ready(function(){
	$("#index_cont_1").click(function(){
		$.ajax({
			url:"index_info.html",
			success:function(result){
				$("#index").html(result);
			}
		});
	});
});

