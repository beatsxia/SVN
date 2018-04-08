window.onload = function() {
	//1
	var div1 = document.getElementById("div1");
	var div2 = document.getElementById("div2");
	div2.onclick = function() {
		div1.className = (div1.className == "close1") ? "open1" : "close1";
		div2.className = (div2.className == "close2") ? "open2" : "close2";
	}
	//2
	var div3 = document.getElementById("div3");
	var div4 = document.getElementById("div4");
	div4.onclick = function() {
		div3.className = (div3.className == "close3") ? "open3" : "close3";
		div4.className = (div4.className == "close4") ? "open4" : "close4";
	}
	//3
	var div5 = document.getElementById("div5");
	var div6 = document.getElementById("div6");
	div6.onclick = function() {
		div5.className = (div5.className == "close5") ? "open5" : "close5";
		div6.className = (div6.className == "close6") ? "open6" : "close6";
	}
	//4
	var div7 = document.getElementById("div7");
	var div8 = document.getElementById("div8");
	div8.onclick = function() {
		div7.className = (div7.className == "close7") ? "open7" : "close7";
		div8.className = (div8.className == "close8") ? "open8" : "close8";
	}
}