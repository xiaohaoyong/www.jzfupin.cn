<?php include $this->admin_tpl('header');?>
<script type="text/javascript">
top.document.getElementById('position').innerHTML = '采集';
</script>
<div class="subnav">
	<div class="content-menu">
		<a href="index.php?c=spider" class="on"><em>列表规则</em></a>
		<a href="index.php?c=spider&a=addlist" class="add"><em>添加规则</em></a>
		<a href="index.php?c=spider&a=import" class="on2"><em>导入规则</em></a>
	</div>
	<div class="bk10"></div>
	<table width="100%" class="m-table m-table-row">
		<thead class="m-table-thead s-table-thead">
		<tr>
			<th width="35">ID</th>
			<th align="left">名称</th>
			<th align="left">预览</th>
			<th align="left">立即采集</th>
			<th align="left">导出</th>
			<th align="left">删除</th>
		</tr>
		</thead>
		<tbody>
		
		<?php if (is_array($list)) foreach ($list as $t) { ?>
		<?php $value = unserialize($t['value']);?>
		<tr>
			<td align="center"><?php echo $t['id'];?></td>
			<td><a href="<?php echo url('spider/editlist',array('id'=>$t['id'])); ?>"><?php echo $value['name'];?></a></td>
			<td><a href="<?php echo url('spider/previewlist',array('id'=>$t['id'])); ?>">预览</a></td>
			<td><a href="<?php echo url('spider/spiderlist',array('id'=>$t['id'])); ?>">立即采集</a></td>
			<td><a href="<?php echo url('spider/exportlist',array('id'=>$t['id'])); ?>">导出</a></td>
			<td><a href="<?php echo url('spider/delelist',array('id'=>$t['id'])); ?>">删除</a></td>
		</tr>
		<?php }?>
		</tbody>
	</table>
	<div class="bk10"></div>
	<div class="content-menu">
		<a href="index.php?c=spider" class="on"><em>内容规则</em></a>
		<a href="index.php?c=spider&a=addcontent" class="add"><em>添加规则</em></a>
		<a href="index.php?c=spider&a=import" class="on2"><em>导入规则</em></a>
	</div>
	<div class="bk10"></div>
	<table width="100%" class="m-table m-table-row">
		<thead class="m-table-thead s-table-thead">
		<tr>
			<th width="35">ID</th>
			<th align="left">名称</th>
			<th align="left">预览</th>
			<th align="left">导出</th>
			<th align="left">删除</th>
		</tr>
		</thead>
		<tbody>
		
		<?php if (is_array($content)) foreach ($content as $t) { ?>
		<?php $value = unserialize($t['value']);?>
		<tr>
			<td align="center"><?php echo $t['id'];?></td>
			<td><a href="<?php echo url('spider/editcontent',array('id'=>$t['id'])); ?>"><?php echo $value['name'];?></a></td>
			<td><a href="<?php echo url('spider/previewcontent',array('id'=>$t['id'])); ?>">预览</a></td>
			<td><a href="<?php echo url('spider/exportcontent',array('id'=>$t['id'])); ?>">导出</a></td>
			<td><a href="<?php echo url('spider/delcontent',array('id'=>$t['id'])); ?>">删除</a></td>
		</tr>
		<?php }?>
		</tbody>
	</table>
</div>
</body>
</html>