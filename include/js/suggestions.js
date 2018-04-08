var timer;
var data;
window.onload = function() {
	$("#txt").focus(function() {
		timer = setInterval(function() {
			data = $("#txt").val();
			if(data.length > 200) {
				$("#txt").empty();
				$("#txt").val(data.substring(0, 200));
			}
			$("#show").empty();
			$("#show").append(data.length + "/200");
		}, 300);
	});
	$("#txt").blur(function() {
		window.clearInterval(timer);
	});
}
$("#myForm").submit(function(){
	if($("#txt").val()==""||$("#txt").val()=="null"){
		return false;
	}else{
		alert("提交成功！");
		return true;
	}
})
