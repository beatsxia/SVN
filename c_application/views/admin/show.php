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
		function editUser(){
			var row = $('#dg').datagrid('getSelected');
			if (row){
				$('#dlg').dialog('open').dialog('setTitle','Edit User');
				$('#fm').form('load',row);
				url = 'show/edit_user?id='+row.id;
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
			<table id="dg" title="用户列表" class="easyui-datagrid" style="width:960px;height:600px"
					url="show/get_users"
					toolbar="#toolbar" pagination="true"
					rownumbers="true" fitColumns="true" singleSelect="true">
				<thead>
					<tr>
						<th field="nickname" width="50">昵称</th>
						<th field="mobile" width="50">手机号</th>
						<th field="gender" width="50">性别</th>
						<th field="avatar" width="50">头像</th>
					</tr>
				</thead>
			</table>
			<div id="toolbar">
				<a href="#" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editUser()">编辑</a>
			</div>
			
			<div id="dlg" class="easyui-dialog" style="width:400px;height:280px;padding:10px 20px"
					closed="true" buttons="#dlg-buttons">
				<div class="ftitle">修改信息</div>
				<form id="fm" method="post" novalidate>
					<div class="fitem">
						<label>性别</label>
						<div style="">
							<input type="radio" name="gender" value="0"><span>保密</span><br/>
							<input type="radio" name="gender" value="1"><span>男</span><br/>
							<input type="radio" name="gender" value="2"><span>女</span><br/>
						</div>
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