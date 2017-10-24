<?php include $this->admin_tpl('header');?>
<script type="text/javascript">
top.document.getElementById('position').innerHTML = '工具';
</script>
<div class="subnav">
	<form method="post" action="" id="myform" name="myform">
	<div class="pad-10">
		<div class="col-tab">
			<ul class="tabBut cu-li">
				<li onClick="SwapTab('setting','on','',7,1);" class="on" id="tab_setting_1">批量替换数据库</li>
			</ul>
			<div class="contentList pad-10" id="div_setting_1">
			<table width="100%" class="table_form">
				<tr>
					<th width="100">网站名称： </th>
					<td>
						<select class="select" name="data[modelid]">
							<option value="0">单页&栏目</option>
							<?php foreach ($model as $t) {?>
								<option value="<?php echo $t[modelid] ?>"><?php echo $t[modelname] ?></option>
							<?php }?>
						</select>
						<div class="onShow">选择要替换的模型</div>
					</td>
				</tr>
				<tr>
					<th width="100">网站名称： </th>
					<td>
						<textarea style="width:80%;height:240px" name="data[rule]"></textarea>
						<div class="onShow">
						格式：数据库的词|替换词 一行一个 <br />
						如： 把数据库中所有“百度”替换成“谷歌”就输入: 百度|谷歌
						</div>
					</td>
				</tr>
			</table>
			</div>
			<div class="bk15"></div>
			<input type="submit" class="button" value="提交" name="submit">
		</div>
	</div>
	</form>
</div>
</body>
</html>