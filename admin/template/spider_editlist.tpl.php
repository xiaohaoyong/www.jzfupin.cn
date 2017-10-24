<?php include $this->admin_tpl('header');?>
<script type="text/javascript">
top.document.getElementById('position').innerHTML = '采集';
</script>
<div class="subnav">
	<div class="content-menu">
		<a href="index.php?c=spider" class="on"><em>列表规则</em></a>
		<a href="index.php?c=spider&a=import" class="on"><em>导入规则</em></a>
	</div>
	<div class="bk10"></div>
	
	<div class="col-tab">
		<ul class="tabBut cu-li">
			<li>添加规则</li>
		</ul>
		<div class="contentList pad-10">
			<form name="myform" id="myform" action="" method="POST">
			<table width="100%" class="table_form">
				<tbody>
					<tr>
						<th width="100">规则名称</th>
						<td><input class="input-text" type="text" name="value[name]" value="<?php echo $variables['name']; ?>" size="30"></td>
					</tr>
					<tr>
						<th width="100">内容页采集规则</th>
						<td>
							<select class="select" id="rule" name="value[rule]">
								<?php echo $variables['select']?>
							</select>
							<script>$("#rule").val('<?php echo $variables['rule']?>');</script>
						</td>
					</tr>
					
					<tr>
						<th>如果已采集</th>
						<td>
							<select id="update" name="value[update]">
							<option value='0'>跳过</option>
							<option value='1'>更新</option>
							</select>
							<script>$("#update").val('<?php echo $variables['update']; ?>');</script>
						</td>
					</tr>
					
					<tr>
						<th>入库栏目</th>
						<td>
							<select class="select" name="value[category]" id="category">
								<?php echo $category; ?>
							</select>
							</td>
					</tr>
					<tr>
						<th width="100">URL</th>
						<td>
							<input class="input-text" type="text" name="value[listurl]" value="<?php echo $variables['listurl']; ?>" size="80">
						</td>
					</tr>
					
					<tr>
						<th>开始ID</th>
						<td><input value="<?php echo $variables['startid']; ?>" name="value[startid]" size="5" class="input-text"> 
						结束ID <input value="<?php echo $variables['endid']; ?>" name="value[endid]" size="5" class="input-text"> 
						步长 <input value="<?php echo $variables['step']; ?>" name="value[step]" size="5" class="input-text"></td>
					</tr>
					
					<tr>
						<th>HTML过滤器</th>
						<td><input value="<?php echo $variables['filter']; ?>" name="value[filter]" size="5" class="input-text"></td>
					</tr>
					
					<tr>
						<th>开始标志</th>
						<td><input value="<?php echo $variables['start']; ?>" name="value[start]" size="50" class="input-text">
						</td>
						
					</tr>
					<tr>
						<th>结束标志</th>
						<td><input value="<?php echo $variables['end']; ?>" name="value[end]" size="50" class="input-text"> 
						
						<select id="appendloophtml" name="value[appendloophtml]">
							<option value='1'>是</option>
							<option value='0'>否</option>
						</select>
						<script>$("#appendloophtml").val('<?php echo $variables['appendloophtml']; ?>');</script>

						附上循环体HTML
						
						</td>
					</tr>
					<tr>
						<th>URL  过滤器</th>
						<td><input value="<?php echo $variables['urlfilter']; ?>" name="value[urlfilter]" size="5"></td>
					</tr>
					<tr>
						<th>Title  过滤器</th>
						<td><input value="<?php echo $variables['titlefilter']; ?>" name="value[titlefilter]" size="5"></td>
					</tr>
				</tbody>	
			</table>
			<div class="bk15"></div>
			<input type="submit" class="button" value="保存" name="submit" onclick="$('#load').show()">
			<span id="load" style="display:none"><img src="./img/loading.gif"></span>
			</form>
		</div>
		
	</div>
	
</div>
</body>
</html>