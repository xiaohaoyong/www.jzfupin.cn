<!--div class="weui_cells weui_panel_access nomtop">
<?php $n=0;  if ($member) {  $return = $this->_listdata("table=diy_message userid=$member[id] status=0"); extract($return); if (is_array($return))  foreach ($return as $key=>$v) {  $n++; ?>
	<div class="weui_panel_bd">
		<div class="weui_media_box weui_media_text">
			<p class="weui_media_desc"><?php echo $v[msg]; ?></p>
			<ul class="weui_media_info">
				<li class="weui_media_info_meta"><?php echo date('Y-m-d',$v['time']); ?></li>
				<li class="pull-right"><a href="/?c=api&a=message&id=<?php echo $v[id]; ?>">展开 <i class="ion-ios-arrow-down"></i></a></li>
			</ul>
		</div>
	</div>
<?php }  } ?>
</div-->
<?php if ($n>0) { ?>
<div class="weui_cells weui_cells_access nomtop top_message" id="message_box">
	<a class="weui_cell" href="<?php echo $cats[26][url]; ?>">
		<div class="weui_cell_bd weui_cell_primary">
				<p style="color:#4e64d3;">你有 <?php echo $n; ?> 条消息需要处理！</p>
		</div>
		<div class="weui_cell_ft"></div>
	</a>
</div>
<?php } ?>