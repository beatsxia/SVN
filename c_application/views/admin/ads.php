<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta name="keywords" content="">
	<meta name="description" content="">
	<title>首页栏</title>
	<link rel="stylesheet" type="text/css" href="http://www.jeasyui.net/Public/js/easyui/themes/default/easyui.css">
	<link rel="stylesheet" type="text/css" href="http://www.jeasyui.net/Public/js/easyui/themes/icon.css">
	<link rel="stylesheet" type="text/css" href="http://www.jeasyui.net/Public/js/easyui/demo/demo.css">
	<style type="text/css">
		#fm{
			margin:0;
			padding:10px 30px;
		}
		.ftitle{
			font-size:14px;
			font-weight:bold;
			color:#666;
			padding:5px 0;
			margin-bottom:10px;
			border-bottom:1px solid #ccc;
		}
		.fitem{
			margin-bottom:5px;
		}
		.fitem label{
			display:inline-block;
			width:80px;
		}
	</style>
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.6.min.js"></script>
	<script type="text/javascript" src="http://www.jeasyui.net/Public/js/easyui/jquery.easyui.min.js"></script>
	<script type="text/javascript">
		var url;
		function newUser(){
			$('#dlg').dialog('open').dialog('setTitle','添加');
			$('#fm').form('clear');
			url = 'ads/ins_ads';
		}
		function editUser(){
			var row = $('#dg').datagrid('getSelected');
			if (row){
				$('#dlg').dialog('open').dialog('setTitle','编辑');
				$('#fm').form('load',row);
				url = 'ads/edit_ads?id='+row.id;
			}
		}
		function saveUser(){
			$('#fm').form('submit',{
				url: url,
				onSubmit: function(){
					return $(this).form('validate');
				},
				success: function(result){
					var result = eval('('+result+')');
					if (result.success){
						$('#dlg').dialog('close');		// close the dialog
						$('#dg').datagrid('reload');	// reload the user data
					} else {
						$.messager.show({
							title: 'Error',
							msg: result.msg
						});
					}
				}
			});
		}
		function removeUser(){
			var row = $('#dg').datagrid('getSelected');
			if (row){
				$.messager.confirm('Confirm','确定删除是吗？',function(r){
					if (r){
						$.post('ads/del_ads',{id:row.id},function(result){
							if (result.success){
								$('#dg').datagrid('reload');	// reload the user data
							} else {
								$.messager.show({	// show error message
									title: 'Error',
									msg: result.msg
								});
							}
						},'json');
					}
				});
			}
		}
	</script>
</head>
<body>
	<div class="easyui-layout" style="width:1200px;height:960px;">
		<div region="west" split="true" title="菜单" style="width:150px;">
			<p style="padding:5px;margin:0;">菜单栏目</p>
			<ul>
				<li><a href="show" >用户</a></li>
				<li><a href="inh" >传记</a></li>
				<li><a href="ste" >传承碑</a></li>
				<li><a href="ads" >首页推广</a></li>
			</ul>
		</div>
		<div id="content" region="center" title="内容" style="padding:5px;">
			<table id="dg" title="传记列表" class="easyui-datagrid" style="width:960px;height:600px"
					url="ads/get_ads"
					toolbar="#toolbar" pagination="true"
					rownumbers="true" fitColumns="true" singleSelect="true">
				<thead>
					<tr>
						<th field="inh_id" width="50">推荐的传记ID</th>
						<th field="title" width="50">标题</th>
						<th field="describe" width="50">描述</th>
						<th field="sort" width="50">排序(越大越靠前)</th>
						<th field="picture" width="50">图片</th>
						<th field="add_time" width="50">添加时间</th>
						<th field="link" width="50">访问链接</th>
						<th field="alt" width="50">图片描述</th>
					</tr>
				</thead>
			</table>
			<script>
				var cardview = $.extend({}, $.fn.datagrid.defaults.view, {
					renderRow: function(target, fields, frozen, rowIndex, rowData){
						var cc = [];
						cc.push('<td colspan=' + fields.length + ' style="padding:10px 5px;border:0;">');
						if (!frozen){
							var picture = rowData.picture;
							cc.push('<img src="' + picture + '" style="width:150px;float:left">');
							cc.push('<div style="float:left;margin-left:20px;">');
							for(var i=0; i<fields.length; i++){
								var copts = $(target).datagrid('getColumnOption', fields[i]);
								if(copts.title=='添加时间'){
									cc.push('<p><span class="c-label">' + copts.title + ':</span> ' + formatDateTime(rowData[fields[i]]) + '</p>');
								}else{
									cc.push('<p><span class="c-label">' + copts.title + ':</span> ' + rowData[fields[i]] + '</p>');
								}
							}
							cc.push('</div>');
						}
						cc.push('</td>');
						return cc.join('');
					}
				});
				function formatDateTime(timeStamp) {   
				    var date = new Date();  
				    date.setTime(timeStamp * 1000);  
				    var y = date.getFullYear();      
				    var m = date.getMonth() + 1;      
				    m = m < 10 ? ('0' + m) : m;      
				    var d = date.getDate();      
				    d = d < 10 ? ('0' + d) : d;      
				    var h = date.getHours();    
				    h = h < 10 ? ('0' + h) : h;    
				    var minute = date.getMinutes();    
				    var second = date.getSeconds();    
				    minute = minute < 10 ? ('0' + minute) : minute;      
				    second = second < 10 ? ('0' + second) : second;     
				    return y + '-' + m + '-' + d+' '+h+':'+minute+':'+second;      
				};
				$(function(){
					$('#dg').datagrid({
						view: cardview
					});
				});
			</script>

			<div id="toolbar">
				<a href="#" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newUser()">添加</a>
				<a href="#" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editUser()">编辑</a>
				<a href="#" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="removeUser()">删除</a>
			</div>
			
			<div id="dlg" class="easyui-dialog" style="width:600px;height:480px;padding:10px 20px"
					closed="true" buttons="#dlg-buttons">
				<div class="ftitle">编辑</div>
				<form id="fm" method="post" novalidate>
					<div class="fitem">
						<label>推荐的传记ID</label>
						<input name="inh_id" class="easyui-validatebox" required="true">
					</div>
					<div class="fitem">
						<label>标题</label>
						<input name="title" class="easyui-validatebox" required="true" style="width:360px">
					</div>
					<div class="fitem">
						<label>描述</label>
						<input name="describe" class="easyui-validatebox" required="true" style="width:360px">
					</div>
					<div class="fitem">
						<label>图片</label>
						<input name="picture" class="easyui-validatebox" required="true" style="width:360px">
					</div>
					<div class="fitem">
						<label>排序(数字越大越靠前)</label>
						<input name="sort" class="easyui-validatebox" required="true" >
					</div>
					<div class="fitem">
						<label>访问链接</label>
						<input name="link" class="easyui-validatebox" required="true" style="width:360px">
					</div>
					<div class="fitem">
						<label>图片描述</label>
						<input name="alt" class="easyui-validatebox" >
					</div>
				</form>
			</div>
			<div id="dlg-buttons">
				<a href="#" class="easyui-linkbutton" iconCls="icon-ok" onclick="saveUser()">添加</a>
				<a href="#" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg').dialog('close')">取消</a>
			</div>
		</div>
	</div>

		
</body>
</html>