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
	<form name="value[myform" id="myform" action="" method="POST">
	<div class="col-tab">
		<ul class="tabBut cu-li">
			<li onClick="SwapTab('spider','on','',7,1);" class="on" id="tab_spider_1">内容分页规则</li>
			<li onClick="SwapTab('spider','on','',7,2);" id="tab_spider_2">内容采集规则</li>
		</ul>
		<div class="contentList pad-10" id="div_spider_1">
			<table width="100%" class="table_form">
				<tr>
				<td width="100">名称</td>
				<td><input type="text" value="<?php echo @$variables['name']; ?>" name="value[name]" class="mustoffer"></td>
				</tr>
				<tr>
					<td>网址举例</td>
					<td><input type="text" value="<?php echo @$variables['url']; ?>" size="64" name="value[url]"></td>
				</tr>
				<tr>
					<td>过滤器 ID</td>
					<td><input type="text" value="<?php echo @$variables['htmlfilter']; ?>" size="10" name="value[htmlfilter]" /></td>
				</tr>
				<tr>
					<td>跳过 SQL Where</td>
					<td><textarea name="value[skipwhere]" cols="80" rows="3"><?php echo $variables['skipwhere'];?></textarea></td>
				</tr>
			</table>
			<div class="bk10"></div>
			<table width="80%" class="table_form">
				<tr>
					<td width="100">开始标志</td>
					<td><input type="text" name="value[pagebreakstart]" value="<?php echo @$variables['pagebreakstart']; ?>" size="50" class="mustoffer"></td>
				</tr>
				<tr>
					<td>结束标志</td>
					<td><input type="text" name="value[pagebreakend]" value="<?php echo @$variables['pagebreakend']; ?>" size="50"></td>
				</tr>
				<tr>
					<td>分页URL过滤器ID</td>
					<td><input type="text" name="value[pagebreakurlfilter]" value="<?php echo @$variables['pagebreakurlfilter']; ?>" size="5"></td>
				</tr>
				<tr>
					<td>分页题目过滤器ID</td>
					<td><input type="text" name="value[pagebreaktitlefilter]" value="<?php echo @$variables['pagebreaktitlefilter']; ?>" size="5"></td>
				</tr>
				<tr>
					<td>内容页分页采集规则</td>
					<td><select id="pagerule" name="value[pagerule]">
					'.@$variables['pageruleselect'].'
					</select>
					<!--script>if("<?php echo @$variables['pagerule']; ?>" != "") {$("#pagerule").val('.@$variables['pagerule'].');}</script--></td>
				</tr>
			</table>
		</div>
		<div class="contentList pad-10" id="div_spider_2" style="display: none;">
			<table width="50%" class="table_form" style="float:left">
				<tr>
					<td width="15">ID</td>
					<td>备注</td>
					<td>开始标志</td>
					<td>结束标志</td>
					<td>过滤器</td>
					<td>图</td>
					<td>重复</td>
				</tr>
				<?php echo $tmphtml;?>
			</table>
			<table width="30%" class="table_form"  style="float:left">
				<tr>
					<td><b>字段</b></td>
					<td><b>内容</b></td>
					<td><b>过滤器</b></td>
				</tr>
				<?php echo $saveto1 ?>
				<tr>
					<td colspan="3"><b>额外</b></td>
				</tr>
				<?php echo $saveto2 ?>
			</table>
		</div>
		<div class="bk15"></div>
		<input type="submit" class="button" value="保存" name="submit" onclick="$('#load').show()">
		<span id="load" style="display:none"><img src="./img/loading.gif"></span>
	</div>
	</form>
	
</div>

<script type="text/javascript">
$('#div_spider_1').show();
function SwapTab(name,cls_show,cls_hide,cnt,cur){
	for(i=1;i<=cnt;i++){
		if(i==cur){
			$('#div_'+name+'_'+i).show();
			$('#tab_'+name+'_'+i).attr('class',cls_show);
		}else{
			$('#div_'+name+'_'+i).hide();
			$('#tab_'+name+'_'+i).attr('class',cls_hide);
		}
	}
}
</script>
</body>
</html>