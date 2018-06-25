window.onload = function() {
	if($(".content").css("display", "none")) {
		$(".content").css("display", "block");
	} else {
		$(".content").css("display", "none");
	}
}




if($(".inheritor_head img").width() > $(".inheritor_head img").height()) {
	$(".inheritor_head img").height($(".inheritor_head").width());
} else {
	$(".inheritor_head img").css("width", "100%");
}




var txt = document.getElementById('scrollBox');
var con1 = document.getElementById('con1');
var con2 = document.getElementById('con2');
con2.innerHTML = con1.innerHTML;

function scrollUp() {
	if(txt.scrollTop >= con1.offsetHeight) {
		txt.scrollTop = 0;
	} else {
		txt.scrollTop++;
		console.log(txt.scrollTop)
		if(txt.scrollTop == 420) {
			clearInterval(mytimer);
		}
	}
}

var time = 50;
var mytimer = setInterval(scrollUp, time);





$(".delete").click(function() {
	$("#scrollBox").css("display", "none");
	$(this).css("display", "none");
	$(".content").css("-webkit-animation", "sky_background 7s ease-out 1");
	$(".content").css("-moz-animation", "sky_background 7s ease-out 1");
	$(".content").css("-o-animation", "sky_background 7s ease-out 1");
	$(".content").css("animation", "sky_background 7s ease-out 1");
	$(".content").css("-webkit-transform", "translate3d(0, 0, 0)");
	$(".content").css("-moz-transform", "translate3d(0, 0, 0)");
	$(".content").css("-o-transform", "translate3d(0, 0, 0)");
	$(".content").css("transform", "translate3d(0, 0, 0)");
	$(".content").css("opacity", "1");

	if($(".clouds_one").css("display", "none")) {
		$(".clouds_one").css("display", "block");
	} else {
		$(".clouds_one").css("display", "none");
	}

	if($(".clouds_two").css("display", "none")) {
		$(".clouds_two").css("display", "block");
	} else {
		$(".clouds_two").css("display", "none");
	}

});

//榜单
var wth = $(window).width() * 0.120283;
var culh = $(window).height() * 0.106525;
var cullh = $(window).height() * 0.127358;
$(".cont_ul li").css({
	"height": "" + culh + "px"
});
var lgt = $(".cont_ul li").height();
var tlh = $(".top_logo").width();
var dnd = $(".donator_name").height();
$(".top_logo").css("line-height", lgt);
$(".donator_head").height(wth);

$(".inheritor_head img").click(function() {
	window.location = "identify?s=<?=$stele_id?>";
});

$("body").height($(window).height());
$(".mask_bg").height($(window).height());

var shs = $(".stele_header span").width();
$(".stele_header marquee").width($(window).width() - shs - 16 - 0.8);

var uhw = $(".userhead").width();
$(".userhead").height(uhw);
$(".user_level").css({
	"line-height": "" + uhw + "px"
});
$(".user_info").css({
	"border-radius": "" + uhw + "px"
});
$(".userhead").css({
	"border-radius": "" + uhw + "px"
});
$(".userhead img").css({
	"border-radius": "" + uhw - 6 + "px"
});
$(".userhead img").height(uhw - 6);
$(".userhead img").width(uhw - 6);


$(".closed").click(function() {
	$(".cli_bg").animate({
		height: "0"
	}, 500);

	$(".lists").fadeOut(500);
});

$(".navbar5").click(function() {
	alert("正在生成邀请函，请稍候！");
	$(".navbar5").removeClass();
	$.get("ste_ercode?stele_id=<?=$stele_id?>", function() {
		alert("邀请函已通过公众号发送至您的微信，请返回公众号查看");
	});
});