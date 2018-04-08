function check() {
	var flag1 = true;
	var flag2 = true;
	var flag3 = true;
	var flag4 = true;
	ipt1 = $("#input1").val();
	ipt3 = $("#input3").val();
	ipt4 = $("#input4").val();
	if(!(checkMobile(ipt1))) { //校验手机
		flag1 = false;
	}

//	console.log(ipt1);console.log(ipt3);console.log(ipt4);console.log(ipt3==ipt4)
	//检验新密码
	if(ipt3 == null || ipt3 == "") {
		$("#p3").empty().append("请输入新密码!");
		flag3 = false;
	} else {
		$("#p3").empty();
		flag3 = true;
	}

	//检验再次输入新密码
	if(ipt4 != ipt3 || ipt4 == "" || ipt4 == null) {
		$("#p4").empty().append("请再次输入新密码!");
		flag4 = false;
	} else {
		$("#p4").empty();
		flag4 = true;
	}

	if(!flag1 || !flag2 || !flag3 || !flag4) {
		return false;
	}
}


//检验手机号码
function checkMobile(ipt1) {
	var re = /^1[34578]\d{9}$/;

	if(!(re.test(ipt1))) {
		$("#p1").empty().append("请输入正确使用的手机号码!");
		return false;
	} else {
		$("#p1").empty();
		return true;
	}
}