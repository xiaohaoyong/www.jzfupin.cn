<?php include $this->admin_tpl('header');?>
<script type="text/javascript">
top.document.getElementById('position').innerHTML = '采集';
</script>
<div class="subnav">
	<div class="content-menu">
		<a href="index.php?c=spider" class="on"><em>列表规则</em></a>
	</div>
	<div class="bk10"></div>
	
	<div class="col-tab">
		<ul class="tabBut cu-li">
			<li onClick="SwapTab('spider','on','',7,1);" class="on" id="tab_spider_1">导入列表规则</li>
			<li onClick="SwapTab('spider','on','',7,2);" id="tab_spider_2">导入内容规则</li>
		</ul>
		<div class="contentList pad-10" id="div_spider_1" style="display: none;">
			<form name="" action="index.php?c=spider&a=import" method="POST">
			<table width="100%" class="table_form">
				<tbody>
					<tr>
						<td><textarea style="width:90%;height:120px" name="data[value]"></textarea></td>
					</tr>
				</tbody>	
			</table>
			<div class="bk15"></div>
			<input type="submit" class="button" value="添加" name="submit">
			</form>
		</div>
		<div class="contentList pad-10" id="div_spider_2" style="display: none;">
			<form name="" action="index.php?c=spider&a=importc" method="POST">
			<table width="100%" class="table_form">
				<tbody>
					<tr>
						<td><textarea style="width:90%;height:120px" name="data[value]"></textarea></td>
					</tr>
				</tbody>	
			</table>
			<div class="bk15"></div>
			<input type="submit" class="button" value="导入" name="submit" onclick="$('#load').show()">
			<span id="load" style="display:none"><img src="./img/loading.gif"></span>
			</form>
		</div>
		
	</div>
	
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