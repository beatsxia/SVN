<!DOCTYPE html>
<html>

	<head>
		<meta charset="UTF-8">
		<title></title>
	</head>
	<style>
		* {
			padding: 0;
			margin: 0;
		}
		
		.index_bg img {
			width: 100%;
			min-height: 1024px;
		}
		
		.foot {
			font-size: 20px;
			text-align: center;
			line-height: 1.7;
			width: 100%;
			position: absolute;
			bottom: -300px;
		}
		
		.foot div {
			color: #65292B;
		}
		
		.foot span {
			color: #8A8A8A;
			display: block;
		}
		
		.record {
			text-align: center;
		}
		
		.record a {
			text-decoration: none;
			/*line-height: 80px;*/
			/*font-size: 22px;*/
		}
	</style>

	<body>
		<div class="index_bg"><img src="<?=base_url()?>include/img/index_logo.jpg" /> </div>
		<div class="foot">
			<div>广州传承网络科技有限公司</div>
			<div class="record">
				<a href="http://www.miitbeian.gov.cn" target="_blank">粤ICP备17082923号-1</a>
			</div>
			<span>传承公司&nbsp;版权所有</span>
			<span>Copyright &copy;2011-2017Inheritance All Rights Reserved</span>
		</div>
	</body>

</html>