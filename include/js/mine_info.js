$(function(){
	$(".visit").click(function(){
		window.location = "visitor_num";
	});
	$(".concern").click(function(){
		window.location = "concern_num";
	});
	$(".fans").click(function(){
		window.location = "fans_num";
	});
	$(".recharge").click(function(){
		window.location = "my_balance";
	});
	
	
	$(".notice").click(function(){
		window.location = "notice";
	});
//	$(".invite").click(function(){
//		window.location = "user_ercode";
//	});
	$(".bind").click(function(){
		window.location = "accout_safety";
	});
	$(".suggestions").click(function(){
		window.location = "suggestions";
	});
	$(".system").click(function(){
		window.location = "about_system";
	});
	$(".quit").click(function(){
		window.location = "init/quit";
	});
	
	
	
	
	$(".setting").click(function(){
		$(".setting_info").fadeToggle(1000);
	});
});
