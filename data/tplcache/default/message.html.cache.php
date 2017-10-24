<?php include $this->_include('header.html');  if ($member) {  $n=0;  $return = $this->_listdata("table=diy_message order=id_desc userid=$member[id] status=0"); extract($return); if (is_array($return))  foreach ($return as $key=>$v) {  if ($n==0) { ?><div class="weui_cells_title">待处理</div><?php }  $n++; ?>
	<div class="weui_cells weui_panel_access nomtop">
		<div class="weui_panel_bd">
			<div class="weui_media_box weui_media_text">
				<span class="ui-badge" style="top:5px;left: 5px; zoom:0.8"></span>
				<p class="weui_media_desc"><?php echo $v[msg]; ?></p>
				<ul class="weui_media_info">
					<li class="weui_media_info_meta"><?php echo date('Y-m-d',$v['time']); ?></li>
					<li class="pull-right"><a href="/?c=api&a=message&id=<?php echo $v[id]; ?>">点击处理 <i class="ion-ios-arrow-right"></i></a></li>
				</ul>
			</div>
		</div>
	</div>
	<?php }  $j=0;  $return = $this->_listdata("table=diy_message order=id_desc userid=$member[id] status=1"); extract($return); if (is_array($return))  foreach ($return as $key=>$v) {  if ($j==0) { ?><div class="weui_cells_title">消息历史</div><?php }  $j++; ?>
	<div class="weui_cells weui_panel_access nomtop">
		<div class="weui_panel_bd">
			<div class="weui_media_box weui_media_text">
				<p class="weui_media_desc"><?php echo $v[msg]; ?></p>
				<ul class="weui_media_info">
					<li class="weui_media_info_meta"><?php echo date('Y-m-d',$v['time']); ?></li>
					<li class="pull-right">
						<a href="javascript:;" class="a_showinfo">
							<span class="show_btn">展开 <i class="ion-ios-arrow-down"></i></span>
							<span class="hide_btn">收起 <i class="ion-ios-arrow-up"></i></span>
						</a>
					</li>
				</ul>
			</div>
		</div>
	</div>
	<?php }  if ($n+$j == 0) { ?>
	<div class="msg">
		<div class="weui_msg">
		    <div class="weui_icon_area"><i class="weui_icon_msg weui_icon_info"></i></div>
		    <div class="weui_text_area">
		        <p class="weui_msg_desc">您暂无消息</p>
		    </div>
		</div>
	</div>
	<?php }  }  include $this->_include('footer.html'); ?>