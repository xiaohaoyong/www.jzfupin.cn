<?php include $this->admin_tpl('header');?>
<script type="text/javascript">
top.document.getElementById('position').innerHTML = '增加过滤';
</script>
<div class="subnav">
	<div class="content-menu">
		<div class="left">
		<a href="<?php echo url('tool/filters'); ?>" class="on2"><em>全部过滤</em></a>
		<a href="<?php echo url('tool/addfilters'); ?>" class="add"><em>增加过滤</em></a>
		</div>
		<div class="right">
		</div>
	</div>
	<div class="bk10"></div>
	<div class="col-tab">
		<form method="post" action="" id="myform" name="myform">
		<div class="contentList pad-10">
			<table width="100%" class="table_form">
				<tbody>
					<tr>
						<th><font color="red">*</font>&nbsp;标题：</th>
						<td><input type="text" class="input-text" size="60" id="title" value="<?php echo $data[title] ?>" name="data[title]"></td>
					</tr>
					<tr>
						<th> 内容：</th>
						<td>
							<textarea style="width:490px;height:72px;"  id="data" name="data[data]"><?php echo $data[data] ?></textarea>
						</td>
					</tr>
					<tr>
						<th> 备注：</th>
						<td>
							<textarea style="width:490px;height:44px;"  id="data" name="data[ext]"><?php echo $data[ext] ?></textarea>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
		<div class="bk15"></div>
		<input type="submit" class="button" value="保存" name="submit" onclick="$('#load').show()">
		</form>
	</div>
</div>
</body>
</html>
