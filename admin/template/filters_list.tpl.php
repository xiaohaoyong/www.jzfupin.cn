<?php include $this->admin_tpl('header');?>
<script type="text/javascript">
top.document.getElementById('position').innerHTML = '<?php echo '过滤工具';?>';
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

		<form action="" method="post" name="myform" id="myform" >
		<input name="status" id="list_form" type="hidden" value="">
		<input name="catid" type="hidden" value="<?php echo $catid; ?>">
		<table width="100%"  class="m-table m-table-row">
		<thead class="m-table-thead s-table-thead">
		<tr>
			<th width="20" align="left"><input id="deletec" type="checkbox" onClick="setC()"></th>
			<th width="25" align="left">ID </th>
			<th align="left">名称</th>
			<th width="*" align="left">内容</th>
			<th width="160" align="left">操作</th>
		</tr>
		</thead>
		<tbody>
		<?php if (is_array($date)) foreach ($date as $t) { ?>
		<tr>
			<td align="left">
				<input name="batch[]" value="<?php echo $t['id']; ?>" type="checkbox" class="deletec">
			</td>
			<td align="left"><?php echo $t['id']; ?></td>
			<td align="left">
			<a href="<?php echo url('tool/editfilters',array('id'=>$t['id'])); ?>"><?php echo $t['title']; ?></a>
			</td>

			<td align="left">
				<?php echo $t['data']; ?></a>
			</td>
			
			<td align="操作">
				<a href="<?php echo url('tool/editfilters',array('id'=>$t['id'])); ?>" >编辑</a> | 
				<a href="javascript:confirmurl('<?php echo url('tool/delfilters/',array('id'=>$t['id'])); ?>','确定删除 『 <?php echo $t['title']; ?> 』吗？ ')" >删除</a> 
			</td>
		</tr>
		<?php } ?>
		<tr >
			<td colspan="5"  align="left" style="border-bottom:0px;">
				<div  class="pageleft">
					<input type="submit"  class="button" value="删除" name="delete" onClick="confirm_delete()" >&nbsp;
				</div>
				<div class="pageright"><?php echo $pagelist; ?></div>
			</td>
		</tr>	

		</tbody>
		</table>
		</form>
</div>

</body>
</html>