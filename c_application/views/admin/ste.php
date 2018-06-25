<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta name="keywords" content="">
	<meta name="description" content="">
	<title>编辑</title>
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
			$('#dlg').dialog('open').dialog('setTitle','添加传记');
			$('#fm').form('clear');
			url = 'save_user.php';
		}
		function editUser(){
			var row = $('#dg').datagrid('getSelected');
			if (row){
				$('#dlg').dialog('open').dialog('setTitle','编辑传承碑');
				$('#fm').form('load',row);
				url = 'ste/edit_ste?id='+row.id;
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
				$.messager.confirm('Confirm','Are you sure you want to remove this user?',function(r){
					if (r){
						$.post('remove_user.php',{id:row.id},function(result){
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
					url="ste/get_stes"
					toolbar="#toolbar" pagination="true"
					rownumbers="true" fitColumns="true" singleSelect="true">
				<thead>
					<tr>
						<th field="nickname" width="50">创建人</th>
						<th field="title" width="50">标题</th>
						<th field="synopsis" width="50">简介</th>
						<th field="picture" width="50">图片</th>
						<th field="sex" width="50">性别</th>
						<th field="birthday_time" width="50">出生时间</th>
						<th field="death_time" width="50">死亡时间</th>
						<th field="is_ste_open" width="50">是否公开</th>
						<th field="style" width="50">风格</th>
						<th field="add_time" width="50">添加时间</th>
						<th field="inh_id" width="50">关联传记</th>
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
								cc.push('<p><span class="c-label">' + copts.title + ':</span> ' + rowData[fields[i]] + '</p>');
							}
							cc.push('</div>');
						}
						cc.push('</td>');
						return cc.join('');
					}
				});
				$(function(){
					$('#dg').datagrid({
						view: cardview
					});
				});
			</script>

			<div id="toolbar">
				<!-- <a href="#" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newUser()">添加</a> -->
				<a href="#" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editUser()">编辑</a>
			</div>
			
			<div id="dlg" class="easyui-dialog" style="width:400px;height:280px;padding:10px 20px"
					closed="true" buttons="#dlg-buttons">
				<div class="ftitle">User Information</div>
				<form id="fm" method="post" novalidate>
					<div class="fitem">
						<label>标题</label>
						<input name="title" class="easyui-validatebox" required="true">
					</div>
					<div class="fitem">
						<label>简介</label>
						<input name="synopsis" class="easyui-validatebox" >
					</div>
					<div class="fitem">
						<label>图片</label>
						<input name="picture" class="easyui-validatebox" >
						
					</div>
					<div class="fitem">
						<label>性别</label>
						<input type="radio" name="sex" value="0"><span>隐藏</span>
						<input type="radio" name="sex" value="1"><span>男</span>
						<input type="radio" name="sex" value="2"><span>女</span>
					</div>
					<div class="fitem">
						<label>是否公开</label>
						<input type="radio" name="is_ste_open" value="0"><span>隐藏</span>
						<input type="radio" name="is_ste_open" value="1"><span>公开</span>
					</div>
				</form>
			</div>
			<div id="dlg-buttons">
				<a href="#" class="easyui-linkbutton" iconCls="icon-ok" onclick="saveUser()">Save</a>
				<a href="#" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg').dialog('close')">Cancel</a>
			</div>
		</div>
	</div>

		
</body>
</html>