<?php include $this->admin_tpl('header');?>
<script type="text/javascript">
top.document.getElementById('position').innerHTML = '采集';
</script>
<div class="subnav">
	<div class="content-menu">
		<a href="index.php?c=spider" class="on"><em>规则列表</em></a>
	</div>
	<div class="bk10"></div>
	<div class="col-tab">
		<ul class="tabBut cu-li">
			<li>导出规则</li>
		</ul>
		<div class="contentList pad-10">
			<table width="100%" class="table_form">
				<tbody>
					<tr>
						<td><textarea style="width:90%;height:120px" name="data[value]"><?php echo $rule; ?></textarea></td>
					</tr>
				</tbody>	
			</table>
		</div>
	</div>
</div>
</body>
</html>